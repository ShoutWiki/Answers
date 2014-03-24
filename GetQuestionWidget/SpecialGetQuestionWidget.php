<?php

class GetQuestionWidget extends UnlistedSpecialPage {

	/**
	 * Constructor -- set up the new special page
	 */
	public function __construct() {
		parent::__construct( 'GetQuestionWidget' );
	}

	/**
	 * Show the special page
	 *
	 * @param $par Mixed: parameter passed to the special page or null
	 */
	public function execute( $par ) {
		global $wgServer, $wgSitename, $wgScriptPath, $wgScript;

		$out = $this->getOutput();
		$out->setPageTitle( wfMessage( 'getquestionwidget-page-title' )->text() );

		// Add CSS
		$out->addExtensionStyle( $wgScriptPath . '/extensions/Answers/GetQuestionWidget/GetQuestionWidget.css' );
		// ...and JS
		//$out->addScriptFile( $wgScriptPath . '/extensions/Answers/GetQuestionWidget/GetQuestionWidget.js' );

		$out->addHTML("
			<script type=\"text/javascript\">
			function updatePreview() {
				var category, ask_category;
				if ( document.getElementById( 'category_type' ).value == 'custom' ) {
					category = document.getElementById( 'category' ).value;
					ask_category = category;
				} else {
					category = document.getElementById( 'category_type' ).value;
					ask_category = '';
				}
				var ask_box = '';
				if ( document.getElementById( 'askbox' ).checked ) {
					ask_box = \"<input type='text' value='" . wfMsg( 'ask_a_question' ) . "' id='ask' style='width:\" + ( document.getElementById( 'widget_width' ).value - 50 ) +  \"px' onfocus=this.value=''> <input type='button' value='" .
						wfMsg( 'ask_button' ) . "' onclick=javascript:ask_question()><scr\" + \"ipt>function ask_question(){window.location=\'" . $wgServer . $wgScriptPath . "/index.php?title=Special:CreateQuestionPage&questiontitle=' + document.getElementById( 'ask' ).value + '&categories=\" + ask_category + \"'}</scr\" + \"ipt>\";
				}
				var preview = \"<scr\" + \"ipt>answers_background_color = '\" + document.getElementById( 'backgroundcolor' ).value + \"';answers_width = '\" + document.getElementById( 'widget_width' ).value + \"';answers_border = '1px solid #000000';answers_link_color = '\" + document.getElementById( 'linkcolor' ).value + \"';</scr\" + \"ipt><scr\" + \"ipt type='text/javascript' src='" .
				$wgServer . $wgScript . "?action=ajax&rs=wfGetQuestionsWidget&rsargs[]=\" + document.getElementById( 'widget_title' ).value + \"&rsargs[]=\" + category + \"&rsargs[]=\" + document.getElementById('number').value + \"&rsargs[]=\" + document.getElementById( 'order' ).value + \"'></scri\" + \"pt><noscript><a href='" .
				$wgServer . "'>" . $wgSitename . "</a></noscript>\";

				doc.open();
				doc.write( ask_box + preview );
				doc.close();

				if ( !window.opera && !document.mimeType && document.all && document.getElementById ) {
					i.style.height = ( 185 + ( document.getElementById( 'number' ).value * 55 ) ) + \"px\";
				} else if( document.getElementById ) {
					i.style.height = ( 185 + ( document.getElementById( 'number' ).value * 55 ) ) + \"px\";
				}

				preview = ask_box + preview
				document.getElementById( 'code' ).value = preview.replace( '/</g', '&lt;' ).replace( '/>/g', '&gt;' ).replace( /'/g, '\"' );
			}

			function updateCategorySettings() {
				if ( document.getElementById( 'category_type' ).value == 'custom' ) {
					jQuery( '#custom_category' ).show();
				} else {
					updatePreview();
					jQuery( '#custom_category' ).hide();
				}
			}
			</script>"
		);

		$out->addHTML(
			'<div class="get-widget-settings" style="float: left">
				<b>' . wfMsg( 'getquestionwidget-widget-settings' ) . '</b>
					<div>
					<label for="number">' . wfMsg( 'getquestionwidget-number-of-items' ) . '</label>
					<select id="number" onchange="updatePreview()">
						<option value="5">5</option>
						<option value="10">10</option>
						<option value="15">15</option>
						<option value="20">20</option>
					</select>
					</div>
					<div>
						<label for="category">' . wfMsg( 'getquestionwidget-widget-category') . '</label>
						<select id="category_type" onchange="updateCategorySettings();">
							<option value="' . wfMsg( 'unanswered_category' ) . '">' .
								wfMsg( 'getquestionwidget-category-type-unanswered' ) .
							'</option>
							<option value="' . wfMsg( 'answered_category' ) . '">' .
								wfMsg( 'getquestionwidget-category-type-answered' ) .
							'</option>
							<option value="custom">' .
								wfMsg( 'getquestionwidget-custom-category' ) .
							'</option>
						</select>
					</div>
					<div id="custom_category" style="display: none; margin-bottom: 10px;">
						<div class="yui-skin-sam">
							<label for="category">' . wfMsg( 'getquestionwidget-category' ) . '</label>
							<input type="text" id="category" value="" style="width: 175px" onchange="updatePreview()" />
							<div id="category_suggest"></div>
						</div>
					</div>
					<div style="clear:both"></div>
					<div>
						<label for="order">' . wfMsg( 'getquestionwidget-widget-order' ) . '</label>
						<select id="order" onchange="updatePreview();">
							<option value="">' .
								wfMsg( 'getquestionwidget-order-recent' ) .
							'</option>
							<option value="edit">' .
								wfMsg( 'getquestionwidget-order-edited' ) .
							'</option>
							<option value="random">' .
								wfMsg( 'getquestionwidget-order-random' ) .
							'</option>
						</select>
					</div>
					<div>
						<label for="askbox">' . wfMsg( 'widget_ask_box' ) . '</label>
						<input type="checkbox" id="askbox" value="1" onchange="updatePreview()" checked="checked" />
					</div>
					<b>' . wfMsg( 'getquestionwidget-style-settings' ) . '</b>
					<div>
						<label for="widget_title">' .
							wfMsg( 'getquestionwidget-title' ) .
						'</label>
						<input type="text" id="widget_title" value="' . wfMsg( 'getquestionwidget-recent-questions' ) . '" onchange="updatePreview()" />
					</div>
					<div>
						<label for="widget_width">' . wfMsg( 'getquestionwidget-width' ) . '</label>
						<input type="text" id="widget_width" value="175" style="width: 100px" onchange="updatePreview()" />
					</div>
					<div>
						<label for="backgroundcolor">' . wfMsg( 'getquestionwidget-background-color' ) . '</label>
						<input type="text" id="backgroundcolor" value="#FFFFFF" onchange="updatePreview()" />
					</div>
					<div>
						<label for="linkcolor">' . wfMsg( 'getquestionwidget-link-color' ) . '</label>
						<input type="text" id="linkcolor" value="#000000" onchange="updatePreview()" />
					</div>
					<div class="get-widget-code">
						<b>' . wfMsg( 'getquestionwidget-get-code' ) . "</b><br />
						<textarea onclick=\"javascript:this.focus();this.select();\" readonly name=\"code\" id=\"code\" rows=\"8\" cols=\"35\" style=\"width:350px;overflow:hidden\"></textarea>
					</div>
				</div>

				<div style=\"padding-left: 25px; float: left\">
				<iframe id=\"widget-frame\" frameborder=\"0\" scrolling=\"no\" style=\"height: 400px; width: 355px; overflow: hidden\"></iframe>
				<script type=\"text/javascript\">
				var i = document.getElementById( 'widget-frame' );

				var doc = null;
				if ( i.contentDocument ) {
					// Firefox, Opera
					doc = i.contentDocument;
				} else if ( i.contentWindow ) {
					// Internet Explorer
					doc = i.contentWindow.document;
				} else if ( i.document ) {
					// Others?
					doc = i.document;
				}
				updatePreview();

				var oDS = new YAHOO.util.XHRDataSource( '' );
				// Set the responseType
				oDS.responseType = YAHOO.util.XHRDataSource.TYPE_JSON;
				// Define the schema of the JSON results
				oDS.responseSchema = {
					resultsList: 'ResultSet.Result',
					fields: ['category', 'count']
				};
				var myAutoComp = new YAHOO.widget.AutoComplete( 'category', 'category_suggest', oDS );
				myAutoComp.maxResultsDisplayed = 5;
				myAutoComp.minQueryLength = 3;
				myAutoComp.queryQuestionMark = false;
				myAutoComp.generateRequest = function( query ) {
					return \"{$wgScriptPath}/index.php?action=ajax&rs=wfGetCategoriesSuggest&rsargs[]=\" + query + \"&rsargs[]=5\";
				};

				// Don't highlight the first result
				myAutoComp.autoHighlight = false;
				myAutoComp.resultTypeList = false;
				myAutoComp.formatResult = function( resultData, query, resultMatch ) {
					return ( '<b>' + resultMatch + '</b> - <span style=\"color:green\">' + resultData.count + ' page(s)</span> ' );
				};
				var itemSelectHandler = function( type, args ) {
					updatePreview();
				};
				myAutoComp.itemSelectEvent.subscribe( itemSelectHandler );
				</script>
			</div>"
		);
	}

}