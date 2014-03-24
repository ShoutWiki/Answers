<?php
/**
 * Maintenance script for Answers
 * Sends out e-mails to the specified group.
 * E-mails include links to new pages and the links to edit/move/delete them.
 *
 * @file
 * @ingroup Maintenance
 * @author David Pean <david.pean@gmail.com>
 * @author Jack Phoenix <jack@countervandalism.net>
 * @copyright Copyright © 2009, Wikia, Inc.
 * @date 31 July 2012
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 */

/**
 * Set the correct include path for PHP so that we can run this script from
 * $IP/extensions/Answers/maintenance and we don't need to move this file to
 * $IP/maintenance/.
 */
ini_set( 'include_path', dirname( __FILE__ ) . '/../../../maintenance' );

require_once( 'Maintenance.php' );

class AnswersMailQuestions extends Maintenance {
	public function __construct() {
		parent::__construct();
		$this->mDescription = 'Send users of a group an e-mail containing newest created questions.';
		$this->addOption( 'group', 'Wiki group name you want to send e-mails to', true, true, 'g' );
		#$this->addOption( 'time', 'Wiki group name you want to send e-mails to', true, true, 'g' );
	}

	public function execute() {
		global $wgSitename;

		$this->output( "E-mail questions start...\n\n" );

		$dbr = wfGetDB( DB_SLAVE );

		$group = $this->getOption( 'group' );
		if ( !$group ) {
			$this->error( "The 'group' parameter is mandatory!", true );
		}
		$days = 1;
		$subject = "New Questions on $wgSitename";
		$edits_subject = "Edited Questions on $wgSitename";

		$time_start = microtime( true );

		// calculate cutoff time
		$cutoff_unixtime_start = time() - ( $days * 86400 );
		$cutoff_unixtime_start = $cutoff_unixtime_start - ( $cutoff_unixtime_start % 86400 );
		$cutoff_unixtime_end = $cutoff_unixtime_start + ( $days * 86400 );

		$cutoff_start = $dbr->timestamp( $cutoff_unixtime_start );
		$cutoff_end = $dbr->timestamp( $cutoff_unixtime_end );

		// Get pages for e-mail body
		// New questions
		$res = $dbr->select(
			array( 'page', 'recentchanges' ),
			array( 'page_title', 'rc_timestamp' ),
			array(
				'page_id = rc_cur_id',
				'rc_new' => 1,
				'rc_timestamp >= ' . $dbr->addQuotes( $cutoff_start ),
				'rc_timestamp <= ' . $dbr->addQuotes( $cutoff_end ),
				'page_namespace' => NS_MAIN,
				'page_is_redirect' => 0
			),
			__METHOD__,
			array( 'ORDER BY' => 'rc_timestamp DESC' )
		);

		$body = '<table cellpadding="5"><tr><td><b>New Questions on {{SITENAME}}</b><br /><br /></td></tr>
			<tr><td><a href="' . SpecialPage::getTitleFor( 'Recentchanges' )->escapeFullURL() . '">' .
			wfMsg( 'see_all_changes' ) . '</a><br /><br /></td></tr>';

		foreach ( $res as $row ) {
			$title = Title::newFromDBKey( $row->page_title );
			$body .= '<tr><td height="30" style="border-bottom:1px solid #eeeeee">* <b><a href="' .
				$title->escapeFullURL() . '">' . $title->getText() . '</a></b> | <a href="' .
				$title->escapeFullURL( 'action=edit' ) . '">' . wfMsg( 'answer_this_question' ) .
				'</a> | <a href="' . SpecialPage::getTitleFor( 'Movepage', $title->getText() )->escapeFullURL() . '">' .
				wfMsg( 'movepagebtn' ) . '</a> | <a href="' . $title->escapeFullURL( 'action=delete' ) . '">' .
				wfMsg( 'delete' ) . "</a></td></tr>\n";
		}
		$body .= '</table>';

		// All edits
		$res = $dbr->select(
			array( 'page', 'recentchanges' ),
			array( 'page_title', 'rc_timestamp' ),
			array(
				'page_id = rc_cur_id',
				'rc_new' => 0,
				'rc_timestamp >= ' . $dbr->addQuotes( $cutoff_start ),
				'rc_timestamp <= ' . $dbr->addQuotes( $cutoff_end ),
				'page_namespace' => NS_MAIN,
				'page_is_redirect' => 0
			),
			__METHOD__,
			array( 'ORDER BY' => 'rc_timestamp DESC' )
		);

		$edits_body = '<table cellpadding="5"><tr><td><b>Edited Questions on {{SITENAME}}</b><br /><br /></td></tr>
			<tr><td><a href="' . SpecialPage::getTitleFor( 'Recentchanges' )->escapeFullURL() . '">' .
			wfMsg( 'see_all_changes' ) . '</a><br /><br /></td></tr>';

		$edits = array();
		foreach ( $res as $row ) {
			$title = Title::newFromDBKey( $row->page_title );
			if ( in_array( $row->page_title, $edits ) ) {
				continue;
			}
			$edits_body .= '<tr><td height="30" style="border-bottom:1px solid #eeeeee">* <b><a href="' .
				$title->escapeFullURL() . '">' . $title->getText() . '</a></b> | <a href="' .
				$title->escapeFullURL( 'action=edit' ) . '">' . wfMsg( 'answer_this_question' ) .
				'</a> | <a href="' . SpecialPage::getTitleFor( 'Movepage', $title->getText() )->escapeFullURL() . '">' .
				wfMsg( 'movepagebtn' ) . '</a> | <a href="' . $title->escapeFullURL( 'action=delete' ) . '">' .
				wfMsg( 'delete' ) . "</a></td></tr>\n";
			$edits[] = $row->page_title;
		}
		$edits_body .= '</table>';

		// Build list of all users in this group
		$groups = User::getAllGroups();
		/*
		if( !in_array( $group, $groups ) ) {
			$this->error( "Group '$group' does not exist!\n", true );
		}
		*/

		$res = $dbr->select(
			array( 'user_groups', 'user' ),
			array( 'user_name', 'user_id' ),
			array( 'ug_group' => $group ),
			__METHOD__,
			array(),
			array( 'user' => array( 'LEFT JOIN', 'user_id = ug_user' ) )
		);

		$emailsSent = 0;
		foreach ( $res as $row ) {
			$user = User::newFromName( $row->user_name );
			$user->load();
			if ( $user->getEmail() ) {
				$this->mailQuestions( $user, $subject, $body );
				$this->mailQuestions( $user, $edits_subject, $edits_body );
				$emailsSent++;
			}
			//$this->output( $row->user_name . ' (' . $user->getEmail(). ")\n" );
		}

		$time = microtime( true ) - $time_start;
		$this->output( "Sent $emailsSent e-mail(s). Execution time: $time seconds\n" );
	}

	function mailQuestions( $user, $subject, $body ) {
		global $wgEmailFrom;

		$to = new MailAddress( $user->getEmail() );
		$from = $replyTo = new MailAddress( $wgEmailFrom );

		UserMailer::send( $to, $from, $subject, $body, $replyTo,
			'text/html; charset=UTF-8' );

		return 1;
	}
}

$maintClass = 'AnswersMailQuestions';
require_once( RUN_MAINTENANCE_IF_MAIN );