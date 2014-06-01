<?php
/**
 * Internationalization file for the Answer extension.
 *
 * @file
 * @ingroup Extensions
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 * @version r57364
 * @todo FIXME: ALL languages need de-Wikiafication
 * @todo FIXME: move EditResearch msgs there and GetQuestionWidget msgs there
 */

$messages = array();

/** English */
$messages['en'] = array(
	'answers-desc' => 'Questions & answers tools, such as [[Special:GetQuestionWidget|a special page to get a question widget for your site]] and [[Special:CreateQuestionPage|a special page to create new questions]]',
	'answer_title' => 'Answer',
	'answered_by' => 'Answered by',
	'answers-no-recently-asked-questions' => "$1 hasn't asked any questions recently.",
	'answers-no-recently-edited-questions' => "$1 hasn't edited any questions recently.",
	'unregistered' => 'Unregistered',
	'anonymous_edit_points' => '$1 {{PLURAL:$1|helper|helpers}}',
	'edit_points' => '{{PLURAL:$1|edit point|edit points}}',
	'ask_a_question' => 'Ask a question...',
	'ask_a_question-widget' => 'Ask a question...',
	'in_category' => '...in category',
	'ask_button' => 'Ask',
	'ask_thanks' => 'Thanks for the rockin\' question!', // @todo maybe replace rockin'.....
	'question_asked_by' => 'Question asked by',
	'question_asked_by_anon' => 'Question asked by a {{SITENAME}} user',
	'new_question_comment' => 'new question',
	'answers_toolbox' => 'Answers toolbox',
	'improve_this_answer' => 'Improve this answer',
	'answer_this_question' => 'Answer this question',
	'notify_improved' => 'Email me when improved',
	'research_this' => 'Research this',
	'notify_answered' => 'Email me when answered',
	'recent_asked_questions' => 'Recently Asked Questions',
	'recent_answered_questions' => 'Recently Answered Questions',
	'recent_edited_questions' => 'Recently Edited Questions',
	'unanswered_category' => 'Un-answered questions',
	'answered_category' => 'Answered questions',
	'related_questions' => 'Related questions',
	'related_answered_questions' => 'Related answered questions',
	'recent_unanswered_questions' => 'Recent Unanswered Questions',
	'popular_categories' => 'Popular Categories',
	'createaccount-captcha' => 'Please type the word below',
	'inline-register-title' => 'Notify me when my question is answered!',
	'inline-welcome' => 'Welcome to Answers', // @todo See if needed - Welcome to is part of a standard wiki
	'skip_this' => 'Skip this',
	'see_all_changes' => 'See all changes',
	'toolbox_anon_message' => '<i>"Answers leverages the unique characteristics of a wiki to form the very best answers to any question."</i>',// @todo figure out where this is used - probably not needed
	'no_questions_found' => 'No questions found',
	/*'widget_settings' => 'Question Settings',
	'style_settings' => 'Style Settings',
	'get_widget_title' => 'Add Questions to your site',
	'background_color' => 'Background color',
	'widget_category' => 'Type of Questions',
	'category' => 'Category Name',
	'custom_category' => 'Custom Category',
	'number_of_items' => 'Number of items to show',
	'width' => 'Width',*/ // @todo figure out why commented out and if needed
	'next_page' => 'Next &raquo;',
	'prev_page' => '&laquo; Prev',
	'see_all' => 'See all',
	/*'get_code' => 'Grab Code',
	'link_color' => 'Question Link Color',
	'widget_order' => 'Question Order',
	'widget_ask_box' => 'Include ask box',*/ // @todo figure out why commented out and if needed
	'question_redirected_help_page' => 'Why was my question redirected here',
	'twitter_hashtag' => 'wikianswers', // @todo make site specific
	'twitter_ask' => 'Ask on Twitter',
	'facebook_ask' => 'Ask on Facebook',
	'facebook_send_request' => 'Send Directly to Friends',
	'ask_friends' => 'Ask your friends to help answer:',
	'facebook_send_request_content' => 'Can you help answer this? $1',
	'facebook_signed_in' => 'You are signed into Facebook Connect',
	'magic_answer_headline' => 'Does this answer your question?',
	'magic_answer_yes' => 'Yes, use this as a starting point',
	'magic_answer_no' => 'No, don\'t use this',
	'magic_answer_credit' => 'Provided by Yahoo Answers', // @todo where used?
	'rephrase' => 'Rephrase this question',
	'rephrase_this' => '<a href="$1" $2>Reword the question</a>',
	'question_not_answered' => 'This question has not been answered',
	'you_can' => 'You can:',
	'answer_this' => '<a href="$1">Answer this question</a>, even if you don\'t know the whole answer',
	'research_this_on_wikipedia' => '<a href="$1">Research this question</a> on Wikipedia',
	'receive_email' => '<a href="$1" $2>Receive an email</a> when this question is answered',
	'ask_friends_on_twitter' => 'Ask Friends on <a href="$1" $2>Twitter</a>',
	'quick_action_panel' => 'Quick Action Panel',
	'categorize' => 'Categorize',
	'categorize_help' => 'One category per line',
	'answers_widget_admin_note' => '<b>Admins:</b> If you\'d like to be an admin on <a href="http://answers.wikia.com" target="_blank">Wikianswers</a>, <a href="http://answers.wikia.com/wiki/Wikianswers:Become_an_admin" target="_blank">click here</a>.',// @todo where used and is it needed?
	'answers_widget_user_note' => 'Can you help by becoming a <a href="http://answers.wikia.com/wiki/Wikianswers:Sign_up_for_a_category" target="_blank">category editor</a> on <a href="http://answers.wikia.com" target="_blank">Wikianswers</a>?',// @todo where used and is it needed?
	'answers_widget_anon_note' => '<a href="http://answers.wikia.com" target="_blank">Wikianswers</a> is a Q&amp;A wiki where answers are improved, wiki-style.',//Probably not needed
	'answers-category-count-answered' => 'This category contains $1 answered {{PLURAL:$1|question|questions}}.',
	'answers-category-count-unanswered' => 'This category contains $1 unanswered {{PLURAL:$1|question|questions}}.',
	'answers_widget_no_questions' => '<a href="http://answers.wikia.com" target="_blank">Wikianswers</a> is a site where you can ask questions and contribute answers. We\'re aiming to create the best answer to any question. <a href="http://answers.wikia.com/wiki/Special:Search" target="_blank">Find</a> and answer <a href="http://answers.wikia.com/wiki/Category:Un-answered_questions">unanswered</a> questions. It\'s a wiki - so be bold!',// @todo FIXME make site specific
	'answers_widget_no_questions_askabout' => '<br><br>Get started by asking a question about "{{PAGENAME}}"',
	'reword_this' => '<a href="$1" $2>Reword this question</a> ',
	'no_related_answered_questions' => 'There are no related questions yet. Get a <a href="http://answers.wikia.com/wiki/Special:Randomincategory/answered_questions">random answered question instead</a>, or ask a new one!<br />
<div class="createbox" align="center">
<p></p><form name="createbox" action="/index.php" method="get" class="createboxForm">
<input name="action" value="create" type="hidden">
<input name="prefix" value="Special:CreateQuestionPage/" type="hidden">
<input name="editintro" value="" type="hidden">
<input class="createboxInput" name="title" value="" size="50" type="text">
<input name="create" class="createboxButton" value="Type your question and click here" type="submit"></form></div>',// @todo FIXME make site specific
	'auto_friend_request_body' => 'Will you add me as a friend?',
	'tog-hidefromattribution' => 'Hide my avatar and name from attribution list',
	'q' => '<!-- -->',
	'a' => 'Answer:',
	'question_mark' => '?', // do not translate this into other languages unless necessary
	'answering_tips' => "<h3>Tips for answering:</h3> When contributing an answer, try to be as accurate as you can. If you're getting information from another source such as Wikipedia, put a link to this in the text. And thank you for contributing to {{SITENAME}}!",
	'header_questionmark_pre' => '',
	'header_questionmark_post' => '?',
	'plus_x_more_helpers' => '... plus $1 more helpers',
	'answer_this_question' => 'Answer this question:',
	'plus_x_more_helpers' => '... plus $1 more helpers',
	'answer_this_question' => 'Answer this question:',

	'anwb-step1-headline' => 'What\'s your wiki about?',
	'anwb-step1-text' => 'Your Wikianswers site needs a <strong>tagline</strong>.<br /><br />Your tagline will help people find your site from search engines, so try to be clear about what your site is about.',
	'anwb-step1-example' => 'Answers for all your pro-wrestling questions!',
	'anwb-choose-logo' => 'Choose your logo',
	'anwb-step2-text' => 'Next, choose a logo for {{SITENAME}}. It\'s best to upload a picture that you think represents your Answers site.<br />You can skip this step if you don\'t want to do it right now.<br /><br />',
	'anwb-step2-example' => 'This would be a good logo for a skateboarding answers site.',
	'anwb-fp-headline' => 'Create some questions!',
	'anwb-fp-text' => 'Your Answers site should start off with some questions!<br /><br />Add a list of questions, and then provide the answers yourself. It\'s important to get some useful information on the site, so people can find it and ask and answer even more questions.',
	'anwb-fp-example' => '<strong>Example</strong><br /><br />For a pet care answers site:<br /><br /><ul><li>Should I buy cat litter?</li><li>What\'s the best breed of dog?</li><li>What\'s the best way to train a cat?</li><li></ul><br /><br />For a health care answers site:<br /><br /><ul><li>What are the health benefits of exercise?</li><li>How can I find a good doctor in my area?</li><li>How can I lose weight easily?</li></ul>',
	'nwb-thatisall-headline' => 'That\'s it - you\'re done!',
	'anwb-thatisall-text' => 'That\'s it - you\'re ready to roll!<br /><br />Now it\'s time to start writing more questions and answers, so that your site can be found more easily in search engines.<br /><br />The list of questions added in the last step has been put into your questions site. Head in to answer your questions, and start your own answers community!',
	'anwb-logo-preview' => 'Here\'s a preview of your logo',
	'anwb-save-tagline' => 'Save tagline',

	// toolbox
	'qa-toolbox-button' => 'Answer a random question',
	'qa-toolbox-share' => 'Share',
	'qa-toolbox-tools' => 'Advanced tools»',
	'qa-toolbox-protect' => 'Protect this question',
	'qa-toolbox-delete' => 'Delete this question',
	'qa-toolbox-history' => 'Past versions of this page',
	'qa-featured-sites' => '-',
	/*'qa-featured-sites-answers2' => '<div class="popularsidebarcats" style="margin-left:10px;">
<br />
[[:Special:MostPopularCategories|<b><big>Popular topics</big></b>]]:  [[:Category:How to|How to]], [[:Category:Cleaning|Cleaning]], [[:Category:Relationships|Relationships]], [[:Category:Jobs|Jobs]], [[:Category:Health|Health]]
<br />
[[:Category:Education|<b><big>Education</big></b>]]: [[:Category:English|English]], [[:Category:Science|Science]], [[:Category:Math|Math]],  [[:Category:History|History]],  [[:Category:Planets|Planets]]
<br />
[[:Category:Hobbies|<b><big>Hobbies</big></b>]]: [[:Category:Animals|Animals]],  [[:Category:Crossword Puzzles|Crosswords]], [[:Category:Gaming|Gaming]],  [[:Category:Internet|Internet]]
<br />
<br />
----
[[:w:c:www:Special:CreateAnswers|<b><big>Answer sites</big></b>]]
<br />
<big>Lifestyle & interests</big>: [[:w:c:pets.answers|Pets]], [[:w:c:gardening.answers|Gardening]], [[:w:c:auto.answers|Cars]], [[:w:c:recipes.answers|Cooking]], [[:w:c:inquiringmoms.answers|Moms]], [[:w:c:politics.answers|Politics]], [[:w:c:religion.answers|Religion]], [[:w:c:sports.answers|Sports]], [[:w:c:travel.answers|Travel]]
<br />
<big>Entertainment</big>: [[:w:c:celebritygossip.answers|Celebrities]], [[:w:c:harrypotter.answers|Harry Potter]], [[:w:c:drwho.answers|Dr Who]], [[:w:c:movie.answers|Movies]], [[:w:c:star-trek.answers|Star Trek]], [[:w:c:anime.answers|Anime]], [[:w:c:avatar.answers|Avatar]], [[:w:c:warriorcats.answers|Warrior Cats]]
<br />
<big>Music</big>: [[:w:c:justin-bieber.answers|Justin Bieber]], [[:w:c:lyrics.answers|Lyrics]]
<br />
<big>Gaming</big>: [[:w:c:callofduty.answers|Call of Duty]], [[:w:c:reddead.answers|Red Dead]], [[:w:c:xbox.answers|Xbox]]
<br />
<big>Other</big>: [[:w:c:finance.answers|Finance]],  [[:w:c:psychology.answers|Psychology]]
<br />
</div>
[http://www.wikia.com/Special:CreateAnswers http://images2.wikia.nocookie.net/answers/images/c/cf/Button.png]
<br />',*/ // @todo FIXME Wikia filled - do we even need?

	// Skin Chooser
	'answers_skins' => 'Answers',
	'answers-bluebell' => 'Bluebell',
	'answers-leaf' => 'Leaf',
	'answers-carnation' => 'Carnation',
	'answers-sky' => 'Sky',
	'answers-spring' => 'Spring',
	'answers-forest' => 'Forest',
	'answers-moonlight' => 'Moonlight',
	'answers-carbon' => 'Carbon',
	'answers-obsession' => 'Obsession',
	'answers-custom' => 'Custom',
);

/** Message documentation (Message documentation)
 * @author Siebrand
 */
$messages['qqq'] = array(
	'answers-category-count-answered' => 'Parameters:
* $1 is the number of answered questions.',
	'answers-category-count-unanswered' => 'Parameters:
* $1 is the number of unanswered questions.',
);

/** Afrikaans (Afrikaans) */
$messages['af'] = array(
	'research_this' => 'Vors dit na',
);

/** Azerbaijani (Azərbaycanca)
 * @author Cekli829
 * @author Melikov Memmed
 * @author Vago
 */
$messages['az'] = array(
	'answer_title' => 'Cavab',
	'question_asked_by' => 'Sualı verən',
	'question_asked_by_anon' => 'Sualı verən {{SITENAME}} istifadəçisi',
	'answer_this_question' => 'Bu suala cavab verin:',
	'see_all' => 'Həmçinin bax',
	'twitter_ask' => 'Twitterdə soruş',
	'facebook_ask' => 'Facebookda soruş',
	'facebook_send_request' => 'Birbaşa dostlarına göndər',
	'ask_friends' => 'Cavab üçün dostlarından kömək istə',
	'answers_skins' => 'Cavablar',
);

/** Breton (Brezhoneg)
 * @author Fulup
 * @author Y-M D
 */
$messages['br'] = array(
	'answer_title' => 'Respont',
	'answered_by' => 'Respontet gant',
	'unregistered' => 'Dienroll',
	'anonymous_edit_points' => '$1 {{PLURAL:$1|skoazeller|skoazeller}}',
	'ask_a_question' => 'Sevel ur goulenn...',
	'ask_a_question-widget' => 'Sevel ur goulenn...',
	'in_category' => '...er rummad',
	'ask_button' => 'Goulenn',
	'ask_thanks' => 'Trugarez evit ar goulenn dedennus-mañ !', // @todo maybe replace rockin'.....
	'question_asked_by' => 'Goulenn savet gant',
	'question_asked_by_anon' => 'Goulenn savet gant un implijer deus {{SITENAME}}',
	'new_question_comment' => 'goulenn nevez',
	'answers_toolbox' => 'Boest ostilhoù Wikirespont',
	'research_this' => 'Klask-se',
	'see_all_changes' => 'Gwelet an holl gemmoù',
	'next_page' => "War-lerc'h &raquo;",
	'prev_page' => '&laquo; Kent',
	'you_can' => 'Gallout a rit :',
	'categorize' => 'Rummata',
	'a' => 'Respont :',
	'anwb-choose-logo' => 'Dibabit ho logo',
	'anwb-fp-headline' => 'Savit un nebeud goulennoù !',
	'answers_skins' => 'Respontoù',
	'answers-sky' => 'Oabl',
	'answers-spring' => 'Nevezamzer',
	'answers-forest' => 'Koadeg',
);

/** German (Deutsch)
 * @author George Animal
 * @author Kghbln
 * @author LWChris
 * @author SVG
 * @author Tiin
 * @author Tim 'Avatar' Bartel
 */
$messages['de'] = array(
	'answer_title' => 'Antwort',
	'answered_by' => 'Beantwortet von',
	'unregistered' => 'Nicht registriert',
	'anonymous' => 'Unregistrierte(r) Benutzer',
	'anonymous_edit_points' => '$1 {{PLURAL:$1|Helfer|Helfer}}',
	'edit_points' => '{{PLURAL:$1|Bearbeitungspunkt|Bearbeitungspunkte}}',
	'ask_a_question' => 'Eine Frage stellen...',
	'ask_a_question-widget' => 'Eine Frage stellen...',
	'in_category' => '...in der Kategorie',
	'ask_button' => 'Fragen',
	'ask_thanks' => 'Danke für deine klasse Frage!', // @todo maybe replace rockin'.....
	'question_asked_by' => 'Frage gestellt von',
	'question_asked_by_anon' => 'Frage gestellt von einem {{SITENAME}} Benutzer',
	'new_question_comment' => 'neue Frage',
	#'answers_toolbox' => 'Wikianswers Werkzeuge', // @todo figure out why this is commented out
	'improve_this_answer' => 'Diese Antwort verbessern',
	'answer_this_question' => 'Diese Frage beantworten:',
	'notify_improved' => 'E-Mail bei Verbesserung',
	'research_this' => 'Das hier recherchieren',
	'notify_answered' => 'E-Mail bei Antwort',
	'recent_asked_questions' => 'Zuletzt gestellte Fragen',
	'recent_answered_questions' => 'Zuletzt gestellte Fragen',
	'recent_edited_questions' => 'Kürzlich bearbeitete Fragen',
	'unanswered_category' => 'Offene Fragen',
	'answered_category' => 'Beantwortete Fragen',
	'related_questions' => 'Ähnliche Fragen',
	'related_answered_questions' => 'Ähnliche beantwortete Fragen',
	'recent_unanswered_questions' => 'Aktuelle Offene Fragen',
	'popular_categories' => 'Beliebte Kategorien',
	'createaccount-captcha' => 'Bitte gib das Wort unten ein',
	'inline-register-title' => 'Benachrichtige mich, wenn meine Frage beantwortet wird!',
	#'inline-welcome' => 'Willkommen bei Wikianswers',
	'skip_this' => 'Überspringen',
	'see_all_changes' => 'Alle Änderungen sehen',
	#'toolbox_anon_message' => '<i>"Wikianswers nutzt die einzigartigen Merkmale eines Wikis, um die absolut besten Antworten auf alle Fragen zu finden."</i>',
	'no_questions_found' => 'Keine Fragen gefunden',
	'next_page' => 'Nächste &raquo;',
	'prev_page' => '&laquo; Vorherige',
	'see_all' => 'Alle zeigen',
	'question_redirected_help_page' => 'Warum wurde meine Frage hierhin weitergeleitet',
	'twitter_hashtag' => 'Wikianswers',
	'twitter_ask' => 'Auf Twitter fragen',
	'facebook_ask' => 'Auf Facebook fragen',
	'facebook_send_request' => 'Direkt an Freunde senden',
	'ask_friends' => 'Bitte deine Freunde beim Beantworten zu helfen:',
	'facebook_send_request_content' => 'Kannst du helfen das zu beantworten? $1',
	'facebook_signed_in' => 'Du bist bei Facebook Connect angemeldet',
	'magic_answer_headline' => 'Ist deine Frage damit beantwortet?',
	'magic_answer_yes' => 'Ja, dies als Ausgangspunkt verwenden',
	'magic_answer_no' => 'Nein, das hier nicht verwenden',
	'magic_answer_credit' => 'Bereitgestellt von Yahoo Answers',
	'rephrase' => 'Diese Frage neu formulieren',
	'rephrase_this' => '<a href="$1" $2>Die Frage umformulieren</a>',
	'question_not_answered' => 'Diese Frage wurde nicht beantwortet',
	'you_can' => 'Du kannst:',
	'answer_this' => '<a href="$1">Diese Frage beantworten</a>, auch wenn du nicht die ganze Antwort weißt',
	'research_this_on_wikipedia' => '<a href="$1">Die Frage recherchieren</a> auf Wikipedia',
	'receive_email' => '<a href="$1" $2>Eine E-Mail erhalten</a> wenn diese Frage beantwortet wird',
	'ask_friends_on_twitter' => 'Freunde bei <a href="$1" $2>Twitter</a> fragen',
	'categorize' => 'Kategorisieren',
	'categorize_help' => 'Eine Kategorie pro Zeile',
	'answers_widget_admin_note' => '<b>Administratoren:</b> Wenn du gerne ein Administrator von <a href="http://answers.wikia.com" target="_blank">Wikianswers</a> werden würdest, <a href="http://answers.wikia.com/wiki/Wikianswers:Become_an_admin" target="_blank">klicke hier</a>.',
	'answers_widget_user_note' => 'Kannst du helfen, indem du ein <a href="http://answers.wikia.com/wiki/Wikianswers:Sign_up_for_a_category" target="_blank">Kategorie-Editor</a> auf <a href="http://answers.wikia.com" target="_blank">Wikianswers</a> wirst?',
	'answers_widget_anon_note' => '<a href="http://answers.wikia.com" target="_blank">Wikianswers</a> ist ein Q&amp;A-Wiki, wo Antworten nach dem Wiki-Prinzip verbessert werden.',
	'answers-category-count-answered' => 'Diese Kategorie enthält $1 beantwortete {{PLURAL:$1|Frage|Fragen}}.',
	'answers-category-count-unanswered' => 'Diese Kategorie enthält $1 unbeantwortete {{PLURAL:$1|Frage|Fragen}}.',
	'answers_widget_no_questions' => '<a href="http://answers.wikia.com" target="_blank">Wikianswers</a> ist eine Seite, auf der du Fragen stellen und Antworten bearbeiten kannst. Wir zielen darauf ab, die beste Antwort zu jeder Frage zu geben. <a href="http://answers.wikia.com/wiki/Special:Search" target="_blank">Finde</a> und beantworte <a href="http://answers.wikia.com/wiki/Category:Un-answered_questions">unbeantwortete</a> Fragen. Dies ist ein Wiki - also traue dich!',
	'answers_widget_no_questions_askabout' => '<br /><br />Beginne, indem du eine Frage über "{{PAGENAME}}" stellst',
	'reword_this' => '<a href="$1" $2>Frage umformulieren</a>',
	'no_related_answered_questions' => 'Es gibt noch keine ähnliche Fragen. Erhalte stattdessen eine <a href="http://answers.wikia.com/wiki/Special:Randomincategory/answered_questions">zufällig beantwortete Frage</a> oder stelle eine Neue!<br />
<div class="createbox" align="center">
<p></p><form name="createbox" action="/index.php" method="get" class="createboxForm">
<input name="action" value="create" type="hidden">
<input name="prefix" value="Special:CreateQuestionPage/" type="hidden">
<input name="editintro" value="" type="hidden">
<input class="createboxInput" name="title" value="" size="50" type="text">
<input name="create" class="createboxButton" value="Frage eingeben und klicken" type="submit"></form></div>',
	'auto_friend_request_body' => 'Willst du mich als Freund hinzufügen?',
	'tog-hidefromattribution' => 'Verstecke meinen Avatar und meinen Namen auf der Namensnennung-Liste',
	'a' => 'Antwort:',
	'answering_tips' => '<h3>Tipps für das Antworten:</h3> Wenn du eine Antwort gibst, versuche so präzise wie möglich zu sein. Wenn du die Informationen aus einer anderen Quelle wie der Wikipedia beziehst, ergänze einen entsprechenden Link im Text. Und vielen Dank für den Beitrag zum {{SITENAME}}!',
	'plus_x_more_helpers' => '... sowie $1 weitere Helfer',
	'superdeduper_noise_words' => 'alle alles als am beachten bedeuten bedeutet bei beste besten bezeichnen bezeichnet bieten bietet bin bis bleiben bleibt brauchen braucht bringen circa das dein deine der die diese dieser egal eigen eigene ein eine einer er es etwa etwas fast funktionieren funktioniert für geben gehören gehört gibt gut gute haben hat heißen heißt hinter ich ihr ihre im immer in inwiefern inwieweit ist jede jeder jemand kann kommen kommt können könnte lange lassen lässt machen man mehr mein mein meine meiner möglich muss müssen müsste nach nennen nennt nicht nie noch nur oder passieren passiert plötzlich schlechte sein seine selten sie sinnvoll so tun tut über unbedingt und uns viel von vor vorher wann warum was weg weil welche welcher wenig weniger wer werden weshalb wie wieder wielange wieso wird wo zu zurück zwischen',
	'tog-questionemailedited' => 'Schicke mir täglich eine Liste mit neuen Fragen',
	'tog-questionemailnew' => 'Schicke mir täglich eine Liste mit bearbeiteten Fragen',
	/*'sidebar-popular-categories' => '<table align="center" width="100%"><tr><td width="50%">
* Kategorie:Wikianswers|<b>* Wikianswers *</b>
* Kategorie:Alltagskultur|Alltagskultur
* Kategorie:Computer|Computer
* Kategorie:Biologie|Biologie
* Kategorie:Essen|Essen
* Kategorie:Geographie|Geographie
* Kategorie:Geschichte|Geschichte
* Kategorie:Gesellschaft|Gesellschaft
* Kategorie:Gesundheit|Gesundheit
* Kategorie:Hauswirtschaft|Hauswirtschaft
</td><td width="50%">
* Kategorie:Hilfe|<b>* Hilfe *</b>
* Kategorie:Internet|Internet
* Kategorie:Kultur|Kultur
* Kategorie:Linux|Linux
* Kategorie:Personen|Personen
* Kategorie:Software|Software
* Kategorie:Soziale_Beziehung|Soziale Beziehung
* Kategorie:Technik|Technik
* Kategorie:Tiere|Tiere
* Kategorie:Wissenschaft|Wissenschaft
</td></tr></table><br />',*/
	'anwb-step1-headline' => 'Worum geht es in deinem Wiki?',
	'anwb-choose-logo' => 'Wähle dein Logo',
	'anwb-step2-text' => 'Als nächstes wähle ein Logo für {{SITENAME}}. Es empfiehlt sich, ein Bild hochzuladen, von dem du der Meinung bist, dass es Deine Antwort-Seite repräsentiert. <br /> Du kannst diesen Schritt überspringen, wenn du es nicht jetzt tun möchtest.',
	'anwb-step2-example' => 'Dies wäre ein gutes Logo für eine Skateboard-Antwort-Seite.',
	'anwb-fp-headline' => 'Erstelle ein paar Fragen!',
	'anwb-logo-preview' => 'Hier ist eine Vorschau deines Logos',
	'qa-toolbox-button' => 'Beantworte eine zufällige Frage',
	'qa-toolbox-share' => 'Teilen',
	'qa-toolbox-tools' => 'Erweiterte Optionen »',
	'qa-toolbox-protect' => 'Schütze diese Frage',
	'qa-toolbox-delete' => 'Lösche diese Frage',
	'qa-toolbox-history' => 'Frühere Versionen dieser Seite',
	'answers_skins' => 'Antworten',
	'answers-bluebell' => 'Glockenblume',
	'answers-leaf' => 'Blatt',
	'answers-carnation' => 'Nelke',
	'answers-sky' => 'Himmel',
	'answers-spring' => 'Frühling',
	'answers-forest' => 'Wald',
	'answers-moonlight' => 'Mondschein',
	'answers-carbon' => 'Karbon',
	'answers-obsession' => 'Besessenheit',
	'answers-custom' => 'Benutzerdefiniert',
);

/** German (formal address) (‪Deutsch (Sie-Form)‬)
 * @author Tiin
 */
$messages['de-formal'] = array(
	'auto_friend_request_body' => 'Wollen Sie mich als Freund hinzufügen?',
	'answering_tips' => '<h3>Tipps für das Antworten:</h3> Wenn Sie eine Antwort geben, versuchen Sie so präzise wie möglich zu sein. Wenn Sie die Informationen aus einer anderen Quelle wie der Wikipedia beziehen, ergänzen Sie einen entsprechenden Link im Text. Und vielen Dank für Ihren Beitrag zum {{SITENAME}}!',
	'qa-toolbox-button' => 'Beantworten Sie eine zufällige Frage',
	'qa-toolbox-protect' => 'Schützen Sie diese Frage',
	'qa-toolbox-delete' => 'Löschen Sie diese Frage',
);

/** Zazaki (Zazaki)
 * @author Erdemaslancan
 */
$messages['diq'] = array(
	'ask_a_question' => 'çiyê pers bike',
	'ask_a_question-widget' => 'çiyê pers bike',
	'see_all_changes' => 'vurnayışe heme',
	'see_all' => 'Bewni hemi',
);

/** Greek (Ελληνικά) */
$messages['el'] = array(
	'research_this' => 'Αναζητήστε αυτό',
);

/** Spanish (Español)
 * @author Armando-Martin
 * @author Bola
 * @author Molokaicreeper
 * @author Rodrigo Molinero
 */
$messages['es'] = array(
	'anonymous_edit_points' => '$1 {{PLURAL:$1|colaboración|colaboraciones}}',
	'answer_this' => '<a href="$1">Responde esta pregunta</a>, incluso si no sabes la respuesta completa',
	'answer_this_question' => 'Responde a esta pregunta:',
	'answer_title' => 'Respuesta',
	'answered_by' => 'Respondido por',
	'answered_category' => 'Preguntas respondidas',
	#'answers_toolbox' => 'Wikianswers toolbox',
	#'answers_widget_admin_note' => '<b>Administradores:</b> Si queréis ser administradores de <a href="http://respuestas.wikia.com" target="_blank">WikiRespuestas</a>, <a href="http://respuestas.wikia.com/wiki/WikiRespuestas:Administradores" target="_blank">haz clic aquí</a>.',
	#'answers_widget_user_note' => '¿Quieres ayudarnos <a href="http://respuestas.wikia.com/wiki/C%C3%B3mo_cambio_la_categor%C3%ADa_de_una_pregunta" target="_blank">categorizando preguntas</a> en <a href="http://respuestas.wikia.com" target="_blank">WikiRespuestas</a>?',
	#'answers_widget_anon_note' => '<a href="http://respuestas.wikia.com" target="_blank">WikiRespuestas</a> es un Q&amp;A wiki donde se pueden mejorar las respuestas a las preguntas, con un estilo wiki.',
	'answers-category-count-answered' => 'Esta categoría contiene $1 {{PLURAL:$1|pregunta respondida|preguntas respondidas}}.',
	'answers-category-count-unanswered' => 'Esta categoría contiene $1 {{PLURAL:$1|pregunta sin responder|preguntas sin responder}}.',
	#'answers_widget_no_questions' => '<a href="http://respuestas.wikia.com" target="_blank">WikiRespuestas</a> es un sitio donde puedes hacer preguntas y contribuir dando respuestas. Nuestro objetivo es crear la mejor respuesta para cada pregunta. <a href="http://respuestas.wikia.com/wiki/Special:Search" target="_blank">Busca</a> y responde <a href="http://respuestas.wikia.com/wiki/Category:Un-answered_questions">preguntas sin responder</a>. Es un wiki - ¡se valiente!',
	'answers_widget_no_questions_askabout' => '<br /><br />Comienza preguntando sobre "{{PAGENAME}}"',
	'ask_a_question' => 'Haz una pregunta...',
	'ask_a_question-widget' => 'Haz una pregunta...',
	'ask_button' => 'Preguntar',
	'ask_friends' => 'Preguntar a tus amigos para que te ayuden a responder:',
	'ask_friends_on_twitter' => 'Pregunta a tus amigos por <a href="$1" $2>Twitter</a>',
	'ask_thanks' => '¡Gracias por la magnífica pregunta!', // @todo maybe replace rockin'.....
	'auto_friend_request_body' => '¿Me añadirás como amigo?',
	'createaccount-captcha' => 'Por favor introduce la palabra descrita debajo',
	'edit_points' => '{{PLURAL:$1|punto de edición|puntos de edición}}',
	'facebook_ask' => 'Preguntar en Facebook',
	'facebook_send_request' => 'Mandar directamente a Amigos',
	'improve_this_answer' => 'Mejora esta contestación',
	'in_category' => '... en categoría',
	'inline-register-title' => 'Informame cuando mi pregunta sea contestada!',
	#'inline-welcome' => 'Bienvenido a Wikianswers',
	'magic_answer_credit' => 'Proporcionado por Yahoo Answers',
	'magic_answer_headline' => 'Contesta esto a tú pregunta?',
	'magic_answer_no' => 'No, no use esto',
	'magic_answer_yes' => 'Si, usa esto como punto de partida',
	'new_question_comment' => 'nueva pregunta',
	'next_page' => 'Siguientes &raquo;',
	'notify_answered' => 'Envíame un mail cuando seas contestado',
	'notify_improved' => 'Envíeme un email cuando la mejore',
	'no_questions_found' => 'Ningunas preguntas encontradas',
	'popular_categories' => 'Categorías populares',
	'prev_page' => '&laquo; Anteriores',
	'question_asked_by' => 'Pregunta hecha por',
	'question_not_answered' => 'La pregunta no ha sido respondida aún.',
	'question_redirected_help_page' => 'Porqué fue mi pregunta redirigida aquí?',
	'quick_action_panel' => 'Panel de acción rápida',
	#'research_this_on_wikipedia' => '<a href="$1">Investigar sobre esta pregunta</a> en Wikipedia',
	'receive_email' => '<a href="$1" $2>Recibir un correo electrónico</a> cuando se responda a esta pregunta',
	'recent_answered_questions' => 'Preguntas recién contestadas',
	'recent_asked_questions' => 'Preguntas más frecuentes',
	'recent_edited_questions' => 'Preguntas recién editadas', # @todo FIXME: actually used?
	'recent_unanswered_questions' => 'Preguntas Más Recientes',
	'related_answered_questions' => 'Preguntas relacionadas que poseen respuesta',
	'related_questions' => 'Preguntas relacionadas',
	'rephrase' => 'Rehacer la pregunta',
	#'research_this' => 'Investigar esto',
	'reword_this' => '<a href="$1" $2>Reformula esta pregunta</a>',
	'see_all' => 'Ver todos',
	'see_all_changes' => 'Ver todos los cambios',
	'sidebar-popular-categories' => 'Categoría:Animales|Animales
Categoría:Amor|Amor
Categoría:Artistas|Artistas
Categoría:Ciencia|Ciencia
Categoría:Computadoras|Computadoras
Categoría:Comida|Comida
Categoría:Entretenimiento|Entretenimiento
Categoría:Historia|Historia
Categoría:Hogar|Hogar
Categoría:Las Bellas Artes|Las Bellas Artes
Categoría:Matemática|Matemática
Categoría:Música|Música
Categoría:Naturaleza|Naturaleza
Categoría:Plantas|Plantas
Categoría:Salud|Salud
Categoría:Tecnología|Tecnología
Categoría:Telenovelas|Telenovelas
Categoría:Televisión|Televisión
Categoría:Trabajo|Trabajo
Categoría:Videojuegos|Videojuegos',
	'skip_this' => 'Omitir esto',
	#'toolbox_anon_message' => '<i>"Respuestas {{SITENAME}} mide las caracteristicas únicas de un "wiki" para encontrar la mejor respuesta para cada pregunta"</i>',
	'tog-hidefromattribution' => 'Ocultar mi avatar y nombre en la lista de atribuciones',
	'twitter_ask' => 'Preguntar en Twitter',
	'unanswered_category' => 'Preguntas sin respuesta',
	'unregistered' => 'No registrado',
	'you_can' => 'Puedes:',
	'a' => 'Respuesta:',
	'anwb-step1-headline' => 'De qué trata tí Wiki?',
	'anwb-choose-logo' => 'Elija su logo',
);

/** Finnish (Suomi)
 * @author Jack Phoenix <jack@countervandalism.net>
 */
$messages['fi'] = array(
	'answer_this' => '<a href="$1">Vastaa tähän kysymykseen</a> vaikka et tietäisi koko vastausta',
	'answer_this_question' => 'Vastaa tähän kysymykseen',
	'answer_title' => 'Vastaus',
	'answers-no-recently-asked-questions' => '$1 ei ole kysynyt mitään viime aikoina.',
	'answers-no-recently-edited-questions' => '$1 ei ole muokannut mitään kysymyksiä viime aikoina.',
	'answered_category' => 'Vastatut kysymykset',
	#'answers_toolbox' => 'Wikianswers toolbox',
	'ask_a_question' => 'Kysy kysymys',
	'ask_button' => 'Kysy',
	'ask_friends' => 'Pyydä ystäviäsi auttamaan vastaamisessa:',
	'ask_friends_on_twitter' => 'Kysy ystäviltä <a href="$1">Twitterissä</a>',
	'ask_thanks' => 'Kiitos mahtavasta kysymyksestä!', // @todo maybe replace rockin'.....
	'background_color' => 'Taustaväri',
	'categorize' => 'Luokittele',
	'categorize_help' => 'Yksi luokka riviä kohden',
	'category' => 'Luokan nimi',
	'createaccount-captcha' => 'Kirjoita alla näkyvä sana',
	'custom_category' => 'Oma luokka',
	'facebook_ask' => 'Kysy Facebookissa',
	'facebook_send_request' => 'Lähetä suoraan ystäville',
	'facebook_send_request_content' => 'Voitko auttaa vastaamaan tähän? $1',
	'facebook_signed_in' => 'Olet kirjautunut sisään Facebook Connectiin',
	'get_widget_title' => 'Lisää kysymyksiä sivustollesi',
	'improve_this_answer' => 'Paranna tätä vastausta',
	'in_category' => '...luokassa',
	'inline-register-title' => 'Ilmoita minulle kun kysymykseeni on vastattu!',
	#'inline-welcome' => 'Welcome to Wikianswers',
	'link_color' => 'Kysymyslinkin väri',
	'magic_answer_credit' => 'Palvelun tarjoaa Yahoo Answers',
	'magic_answer_headline' => 'Vastaako tämä kysymykseesi?',
	'magic_answer_no' => 'Ei, älä käytä tätä',
	'magic_answer_yes' => 'Kyllä, käytä tätä lähtökohtana',
	'new_question_comment' => 'uusi kysymys',
	'next_page' => 'Seur. &raquo;', #checkme
	'no_questions_found' => 'Kysymyksiä ei löytynyt',
	'notify_answered' => 'Lähetä sähköpostia kun kysymykseen on vastattu',
	'notify_improved' => 'Lähetä sähköpostia kun vastausta on paranneltu',
	'number_of_items' => 'Näytettävien kohteiden määrä',
	'popular_categories' => 'Suositut luokat',
	'prev_page' => '&laquo; Edell.', #checkme
	'question_asked_by' => 'Kysymyksen kysyi',
	'question_not_answered' => 'Tähän kysymykseen ei ole vastattu',
	'question_redirected_help_page' => 'Miksi kysymykseni ohjaa tänne',
	'quick_action_panel' => 'Nopeiden toimintojen paneeli',
	'receive_email' => '<a href="$1">Saa ilmoitus sähköpostiin</a> kun tähän kysymykseen vastataan',
	'recent_answered_questions' => 'Äskettäin vastatut kysymykset',
	'recent_asked_questions' => 'Äskettäin kysytyt kysymykset',
	'recent_unanswered_questions' => 'Tuoreet vastaamattomat kysymykset',
	'related_answered_questions' => 'Aiheeseen liittyvät vastatut kysymykset',
	'rephrase' => 'Uudelleenmuotoile tämä kysymys',
	'see_all' => 'Katso kaikki',
	'see_all_changes' => 'Katso kaikki muutokset',
	'sidebar-popular-categories' => '* Luokka:Elokuvat|Elokuvat
* Luokka:Historia|Historia
* Luokka:Ihmissuhteet|Ihmissuhteet
* Luokka:Lemmikkieläimet|Lemmikkieläimet
* Luokka:Musiikki|Musiikki
* Luokka:Pelaaminen|Pelaaminen
* Luokka:Politiikka|Politiikka
* Luokka:Talous|Talous
* Luokka:Terveys|Terveys
* Luokka:Urheilu|Urheilu',
	'skip_this' => 'Ohita tämä',
	'style_settings' => 'Tyyliasetukset',
	'twitter_ask' => 'Kysy Twitterissä',
	'unanswered_category' => 'Vastaamattomat kysymykset',
	'widget_settings' => 'Kysymysasetukset',
	'widget_ask_box' => 'Sisällytä kysy-laatikko',
	'widget_category' => 'Kysymysten tyyppi',
	'widget_order' => 'Kysymysjärjestys',
	'width' => 'Leveys',
	'you_can' => 'Voit:',
);

/** French (Français)
 * @author Cywil
 * @author Kevin51340
 * @author LionelMacBruSoft
 * @author Marc-Philipp Beuter
 * @author McDutchie
 * @author Wyz
 */
$messages['fr'] = array(
	'anonymous_edit_points' => '$1 {{PLURAL:$1|intervenant|intervenants}}',
	'answer_this' => '<a href="$1">Répondre à cette question</a>, même si vous ne connaissez qu’une partie de la réponse',
	'answer_this_question' => 'Répondre à cette question :',
	'answer_title' => 'Réponse',
	'answered_by' => 'Réponse de',
	'answered_category' => 'Questions répondues',
	#'answers_toolbox' => 'Boîte à outils Wikianswers',
	'answers_widget_admin_note' => '<b>Administrateurs :</b> Si vous souhaitez être administrateur sur <a href="http://reponses.wikia.com" target="_blank">Wikiréponses</a>, <a href="http://reponses.wikia.com/wiki/Wikiréponses:Devenir administrateur" target="_blank">cliquez ici</a>.',
	#'answers_widget_user_note' => 'Pouvez-vous aider en devenant un <a href="http://reponses.wikia.com/wiki/Comment_met-on_une_catégorie" target="_blank">référent de catégorie</a>  sur <a href="http://reponses.wikia.com" target="_blank">Wikiréponses</a> ?',
	#'answers_widget_anon_note' => '<a href="http://reponses.wikia.com" target="_blank">Wikiréponses</a> est un wiki de questions/réponses où les réponses sont améliorées, façon wiki.',
	'answers-category-count-answered' => 'Cette catégorie contient $1 question{{PLURAL:$1||s}} ayant reçu une réponse.',
	'answers-category-count-unanswered' => 'Cette catégorie contient $1 question{{PLURAL:$1||s}} sans réponse.',
	#'answers_widget_no_questions' => '<a href="http://reponses.wikia.com" target="_blank">Wikiréponses</a> est un site où vous pouvez poser des questions et apporter des réponses. Nous avons pour objectif de créer la meilleure réponse pour chaque question. <a href="http://reponses.wikia.com/wiki/Special:Search" target="_blank">Trouvez</a> et répondez aux <a href="http://reponses.wikia.com/wiki/Catégorie:Questions_sans_réponse">questions sans réponse</a>. C’est un wiki, faites preuve d’audace !',
	'answers_widget_no_questions_askabout' => '<br /><br />Commencez en posant une question à propos de « {{PAGENAME}} »',
	'ask_a_question' => 'Poser une question',
	'ask_a_question-widget' => 'Poser une question...',
	'ask_button' => 'Demander',
	'ask_friends' => 'Demandez à vos amis de vous aider à répondre :',
	'ask_friends_on_twitter' => 'Demander à des amis sur <a href="$1" $2>Twitter</a>',
	'ask_thanks' => 'Merci pour cette question intéressante !', // @todo maybe replace rockin'.....
	'auto_friend_request_body' => 'M’ajouterez-vous en tant qu’ami ?',
	'createaccount-captcha' => 'Veuillez saisir le mot ci-dessous',
	'edit_points' => '{{PLURAL:$1|point|points}}',
	'facebook_ask' => 'Demander sur Facebook',
	'facebook_send_request' => 'Envoyer directement à des amis',
	'facebook_send_request_content' => 'Peux-tu m’aider à répondre à cette question ? $1',
	'facebook_signed_in' => 'Vous êtes connecté(e) avec Facebook Connect',
	'improve_this_answer' => 'Améliorer cette réponse',
	'in_category' => '...dans la catégorie',
	'inline-register-title' => 'Me prévenir quand ma question reçoit une réponse !',
	'inline-welcome' => 'Bienvenue sur {{SITENAME}}',
	'magic_answer_credit' => 'Fourni par Yahoo! Questions/Réponses',
	'magic_answer_headline' => 'Cela répond-il à votre question ?',
	'magic_answer_no' => 'Non, ne pas l’utiliser',
	'magic_answer_yes' => 'Oui, l’utiliser comme point de départ',
	'new_question_comment' => 'nouvelle question',
	'next_page' => 'Suite &raquo;',
	'no_questions_found' => 'Aucune question trouvée',
	'no_related_answered_questions' => 'Il n’y a pas encore de questions connexes. Obtenez plutôt une <a href="http://reponses.wikia.com/wiki/Special:Randomincategory/questions_ayant_reçu_une_réponse">question ayant reçu une réponse</a> aléatoire, ou posez-en une nouvelle !<br />
<div class="createbox" align="center">
<p></p><form name="createbox" action="/index.php" method="get" class="createboxForm">
<input name="action" value="create" type="hidden">
<input name="prefix" value="Special:CreateQuestionPage/" type="hidden">
<input name="editintro" value="" type="hidden">
<input class="createboxInput" name="title" value="" size="50" type="text">
<input name="create" class="createboxButton" value="Saisissez votre question et cliquez ici" type="submit"></form></div>',
	'notify_answered' => 'M’envoyer un courriel quand une réponse est donnée',
	'notify_improved' => 'M’envoyer un courriel quand elle est améliorée',
	'popular_categories' => 'Catégories populaires',
	'question_asked_by' => 'Question posée par',
	#'question_asked_by_anon' => 'Question posée par un utilisateur de {{SITENAME}}',
	'question_not_answered' => 'Cette question n’a pas eu de réponse',
	'question_redirected_help_page' => 'Pourquoi ma question a-t-elle été redirigée ici',
	'quick_action_panel' => 'Panneau d’action rapide',
	'receive_email' => '<a href="$1" $2>Recevoir un courriel</a> quand cette question reçoit une réponse',
	'recent_answered_questions' => 'Questions ayant reçu une réponse récemment',
	'recent_asked_questions' => 'Questions posées récemment',
	'recent_edited_questions' => 'Questions modifiées récemment',
	'recent_unanswered_questions' => 'Questions sans réponse récentes',
	'related_questions' => 'Questions connexes',
	'related_answered_questions' => 'Questions ayant reçu une réponse connexes',
	'rephrase' => 'Reformuler cette question',
	'rephrase_this' => '<a href="$1" $2>Reformuler la question</a>',
	#'research_this' => 'Rechercher ceci',
	#'research_this_on_wikipedia' => '<a href="$1">Rechercher cette question</a> sur Wikipédia',
	'reword_this' => '<a href="$1" $2>Reformuler cette question</a>',
	'see_all' => 'Voir tout',
	'see_all_changes' => 'Voir toutes les modifications',
	'sidebar-popular-categories' => 'Catégorie:Questions répondues|Questions répondues', # lame, fixme
	'skip_this' => 'Ignorer celle-ci',
	'superdeduper_noise_words' => "le la les du de des une un mon ton son ma ta sa mes tes ses notre votre leur nos vos leurs",
	#'toolbox_anon_message' => '« <i>Wikiréponses utilise les fonctionnalités exclusives des wikis pour former la meilleure des réponses à chaque question.</i> »',
	'tog-hidefromattribution' => 'Masquer mes avatar et nom de la liste des attributions',
	'twitter_ask' => 'Demander sur Twitter',
	'unanswered_category' => 'Questions non répondues',
	'unregistered' => 'Non inscrit',
	'you_can' => 'Vous pouvez :',
	'a' => 'Réponse :',
	'answering_tips' => '<h3>Conseils pour répondre :</h3> Quand vous soumettez une réponse, essayez d’être aussi précis que possible. Si vous tenez l’information d’une autre source comme Wikipédia, placez un lien vers celle-ci dans le texte. Et merci d’avoir contribué sur {{SITENAME}} !',
	'plus_x_more_helpers' => '... ainsi que $1 intervenants en plus',
	'anwb-step1-headline' => 'De quoi parle votre wiki ?',
	'anwb-step1-text' => 'Votre site de réponses a besoin d’un <strong>slogan</strong>.<br /><br />Votre slogan permettra aux gens de trouver votre site via les moteurs de recherche, aussi essayez d’être clair sur le sujet dont traite votre wiki.',
	'anwb-step1-example' => 'Réponses pour toutes vos questions sur le catch professionnel !',
	'anwb-choose-logo' => 'Choisissez votre logo',
	'anwb-step2-text' => 'Ensuite, choisissez un logo pour {{SITENAME}}. Il est préférable d’importer une image qui représente votre wiki de réponses selon vous.<br />Vous pouvez passer cette étape si vous ne souhaitez pas le faire maintenant.<br /><br />',
	'anwb-step2-example' => 'Ce serait un bon logo pour un site de réponses à propos du skateboard.',
	'anwb-fp-headline' => 'Créez quelques questions !',
	'anwb-fp-text' => 'Votre site de réponses devrait commencer avec quelques questions !<br /><br />Ajoutez une liste de questions, puis apportez vous-même les réponses. Il est important d’avoir quleques informations utiles sur le site, pour que les gens puissent le trouver et poser et répondre à encore plus de questions.',
	'anwb-fp-example' => '<strong>Exemple</strong><br /><br />Pour un site de réponses sur les animaux domestiques :<br /><br /><ul><li>Dois-je acheter une litière pour chat ?</li><li>Quelle est la meilleure race de chien ?</li><li>Quelle est la meilleure façon d’entraîner un chat ?</li><li></ul><br /><br />Pour un site de réponses sur la santé :<br /><br /><ul><li>Quels sont les effets positifs sur la santé de faire de l’exercice ?</li><li>Comment puis-je trouver un docteur près de chez moi ?</li><li>Comment perdre du poids facilement ?</li></ul>',
	'nwb-thatisall-headline' => 'C’est fait — vous avez terminé !',
	'anwb-thatisall-text' => 'C’est fait — vous êtes fin prêt !<br /><br />Il est maintenant temps de commencer à écrire plus de questions et de réponses, afin qu’il soit plus facile de trouver votre site via les moteurs de recherche.<br /><br />Les questions ajoutée lors de la dernière étape ont été placées sur votre site de réponses. Allez répondre à vos questions et démarrez votre propre communauté de réponses !',
	'anwb-logo-preview' => 'Voici un aperçu de votre logo',
	'anwb-save-tagline' => 'Enregistrer le slogan',
	'qa-toolbox-button' => 'Répondre à une question aléatoire',
	'qa-toolbox-share' => 'Partager',
	'qa-toolbox-tools' => 'Outils avancés »',
	'qa-toolbox-protect' => 'Protéger cette question',
	'qa-toolbox-delete' => 'Supprimer cette question',
	'qa-toolbox-history' => 'Versions antérieures de cette page',
	'answers_skins' => 'Réponses',
	'answers-bluebell' => 'Campanule',
	'answers-leaf' => 'Feuille',
	'answers-carnation' => 'Œillet',
	'answers-sky' => 'Ciel',
	'answers-spring' => 'Printemps',
	'answers-forest' => 'Forêt',
	'answers-moonlight' => 'Clair de lune',
	'answers-carbon' => 'Carbone',
	'answers-obsession' => 'Obsession',
	'answers-custom' => 'Personnalisé',
);

/** Galician (Galego)
 * @author Toliño
 */
$messages['gl'] = array(
	'answer_title' => 'Resposta',
	'answered_by' => 'Respondida por',
	'unregistered' => 'Non rexistrado',
	'anonymous_edit_points' => '$1 {{PLURAL:$1|axudante|axudantes}}',
	'edit_points' => '{{PLURAL:$1|punto de edición|puntos de edición}}',
	'ask_a_question' => 'Formular unha pregunta...',
	'ask_a_question-widget' => 'Formular unha pregunta...',
	'in_category' => '...na categoría',
	'ask_button' => 'Preguntar',
	'ask_thanks' => 'Grazas por esta interesante pregunta!', // @todo maybe replace rockin'.....
	'question_asked_by' => 'Pregunta formulada por',
	'question_asked_by_anon' => 'Pregunta feita por un usuario de {{SITENAME}}',
	'new_question_comment' => 'nova pregunta',
	'answers_toolbox' => 'Caixa de ferramentas de Wikirespostas',
	'improve_this_answer' => 'Mellorar esta resposta',
	'answer_this_question' => 'Responder á pregunta:',
	'notify_improved' => 'Enviádeme un correo cando se mellore',
	'research_this' => 'Pescudar isto',
	'notify_answered' => 'Enviádeme un correo cando teña resposta',
	'recent_asked_questions' => 'Preguntas formuladas recentemente',
	'recent_answered_questions' => 'Preguntas respondidas recentemente',
	'recent_edited_questions' => 'Preguntas editadas recentemente',
	'unanswered_category' => 'Preguntas sen resposta',
	'answered_category' => 'Preguntas respondidas',
	'related_questions' => 'Preguntas relacionadas',
	'related_answered_questions' => 'Preguntas respondidas relacionadas',
	'recent_unanswered_questions' => 'Preguntas sen resposta recentes',
	'popular_categories' => 'Categorías populares',
	'createaccount-captcha' => 'Escriba a palabra a continuación',
	'inline-register-title' => 'Notificádeme cando a miña pregunta teña respostas!',
	'inline-welcome' => 'Benvido a Wikirespostas',
	'skip_this' => 'Saltar isto',
	'see_all_changes' => 'Ollar todos os cambios',
	'toolbox_anon_message' => '<i>"Wikirespostas aproveita as características únicas dun wiki para dar as mellores respostas a calquera pregunta."</i>',
	'no_questions_found' => 'Non se atopou pregunta ningunha',
	'next_page' => 'Seguinte &raquo;',
	'prev_page' => '&laquo; Anterior',
	'see_all' => 'Ollar todos',
	#'widget_ask_box' => 'Incluír unha caixa de preguntas',
	'question_redirected_help_page' => 'Por que a miña pregunta vai dar aquí',
	'twitter_hashtag' => 'wikirespostas',
	'twitter_ask' => 'Preguntar no Twitter',
	'facebook_ask' => 'Preguntar no Facebook',
	'facebook_send_request' => 'Enviar directamente aos amigos',
	'ask_friends' => 'Pida aos seus amigos axuda para responder:',
	'facebook_send_request_content' => 'Pode axudar respondendo isto? $1',
	'facebook_signed_in' => 'Está conectado con Facebook Connect',
	'magic_answer_headline' => 'Responde isto á súa pregunta?',
	'magic_answer_yes' => 'Si, utilizar isto como punto de partida',
	'magic_answer_no' => 'Non, non usar isto',
	'magic_answer_credit' => 'Proporcionado por Yahoo Answers',
	'rephrase' => 'Reformular esta pregunta',
	'rephrase_this' => '<a href="$1" $2>Reformular a pregunta</a>',
	'question_not_answered' => 'Esta pregunta non ten respostas',
	'you_can' => 'Pode:',
	'answer_this' => '<a href="$1">Responder esta pregunta</a>, mesmo se non sabe a resposta ao completo',
	'research_this_on_wikipedia' => '<a href="$1">Investigar esta pregunta</a> na Wikipedia',
	'receive_email' => '<a href="$1" $2>Recibir un correo electrónico</a> cando esta resposta obteña resposta',
	'ask_friends_on_twitter' => 'Preguntar aos amigos no <a href="$1" $2>Twitter</a>',
	'quick_action_panel' => 'Panel de acción rápida',
	'categorize' => 'Categorizar',
	'categorize_help' => 'Unha categoría por liña',
	'answers_widget_admin_note' => '<b>Administradores:</b> Se quere ser administrador de <a href="http://answers.wikia.com" target="_blank">Wikirespostas</a>, <a href="http://answers.wikia.com/wiki/Wikianswers:Become_an_admin" target="_blank">prema aquí</a>.',
	'answers_widget_user_note' => 'Quere axudar converténdose en <a href="http://answers.wikia.com/wiki/Wikianswers:Sign_up_for_a_category" target="_blank">editor de categorías</a> en <a href="http://answers.wikia.com" target="_blank">Wikirespostas</a>?',
	'answers_widget_anon_note' => '<a href="http://answers.wikia.com" target="_blank">Wikirespostas</a> é un wiki de preguntas e respostas onde se melloran as respostas, con estilo wiki.',
	'answers-category-count-answered' => 'Esta categoría contén $1 {{PLURAL:$1|pregunta respondida|preguntas respondidas}}.',
	'answers-category-count-unanswered' => 'Esta categoría contén $1 {{PLURAL:$1|pregunta non respondida|preguntas non respondidas}}.',
	'answers_widget_no_questions' => '<a href="http://answers.wikia.com" target="_blank">Wikirespostas</a> é un sitio onde pode formular preguntas e dar respostas. O noso obxectivo é crear a mellor resposta a calquera pregunta. <a href="http://answers.wikia.com/wiki/Special:Search" target="_blank">Atope</a> e responda aquelas preguntas <a href="http://answers.wikia.com/wiki/Category:Un-answered_questions">sen resposta</a>. Isto é un wiki, sexa valente!',
	'answers_widget_no_questions_askabout' => '<br /><br />Comece formulando unha pregunta acerca de "{{PAGENAME}}"',
	'reword_this' => '<a href="$1" $2>Reformular esta pregunta</a>',
	'no_related_answered_questions' => 'Aínda non hai preguntas relacionadas. Dea cunha <a href="http://answers.wikia.com/wiki/Special:Randomincategory/answered_questions">pregunta respondida ao chou</a> ou formule unha nova!<br />
	<div class="createbox" align="center">
	<p></p><form name="createbox" action="/index.php" method="get" class="createboxForm">
	<input name="action" value="create" type="hidden">
	<input name="prefix" value="Special:CreateQuestionPage/" type="hidden">
	<input name="editintro" value="" type="hidden">
	<input class="createboxInput" name="title" value="" size="50" type="text">
	<input name="create" class="createboxButton" value="Escriba a súa pregunta e prema aquí" type="submit"></form></div>',
	'auto_friend_request_body' => 'Engadiríame como amigo?',
	'tog-hidefromattribution' => 'Agochar o meu avatar e o meu nome da lista de atribucións',
	'a' => 'Resposta:',
	'answering_tips' => '<h3>Consellos para responder:</h3> Ao formular unha pregunta, intente ser o máis preciso posible. Se está recollendo a información doutra fonte como a Wikipedia, inclúa unha ligazón no texto. E grazas por colaborar en {{SITENAME}}!',
	'plus_x_more_helpers' => '...ademais de $1 axudantes máis',
	'anwb-step1-headline' => 'De que vai o seu wiki?',
	'anwb-step1-text' => 'O seu sitio de respostas necesita un <strong>slogan</strong>.<br /><br />O seu slogan axudará á xente a atopar o sitio desde os motores de procura, así que intente ser claro describindo de que vai o sitio.',
	'anwb-step1-example' => 'Respostas para todas as súas preguntas sobre a loita libre profesional!',
	'anwb-choose-logo' => 'Escolla o seu logotipo',
	'anwb-step2-text' => 'A continuación, escolla un logotipo para {{SITENAME}}. É mellor cargar unha foto que crea que representa o seu sitio de respostas.<br />Pode saltar este paso se non quere facelo agora.<br /><br />',
	'anwb-step2-example' => 'Este sería un bo logotipo para un sitio de respostas sobre monopatíns.',
	'anwb-fp-headline' => 'Cree algunhas preguntas!',
	'anwb-fp-text' => 'O seu sitio de respostas debería comezar con algunhas preguntas!<br /><br />Engada unha lista de preguntas e dea as súas propias respostas. É importante obter unha información útil sobre o sitio, que a xente poida atopalo e formular e responder aínda máis preguntas.',
	'anwb-fp-example' => '<strong>Exemplo</strong><br /><br />Para un sitio de respostas sobre mascotas:<br /><br /><ul><li>Debería mercar area para gatos?</li><li>Cal é a mellor raza de can?</li><li>Cal é o mellor xeito de adestrar un gato?</li><li></ul><br /><br />Para un sitio de respostas sobre a saúde:<br /><br /><ul><li>Cales son os beneficios sobre a saúde do exercicio?</li><li>Como podo atopar un bo médico na miña zona?</li><li>Como podo perder peso facilmente?</li></ul>',
	'nwb-thatisall-headline' => 'Xa está. Rematou!',
	'anwb-thatisall-text' => 'Xa está. Rematou!<br /><br />Agora é hora de comezar a escribir máis preguntas e respostas, de xeito que o seu sitio se poida atopar facilmente nos motores de procura.<br /><br />A lista de preguntas engadidas no último paso incluíuse no seu sitio de preguntas. Vaia responder as súas preguntas e empece a súa propia comunidade de respostas!',
	'anwb-logo-preview' => 'Aquí ten unha vista previa do seu logotipo',
	'anwb-save-tagline' => 'Gardar o slogan',
	'qa-toolbox-button' => 'Responder unha pregunta ao chou',
	'qa-toolbox-share' => 'Compartir',
	'qa-toolbox-tools' => 'Ferramentas avanzadas»',
	'qa-toolbox-protect' => 'Protexer esta pregunta',
	'qa-toolbox-delete' => 'Borrar esta pregunta',
	'qa-toolbox-history' => 'Versións anteriores desta páxina',
	'answers_skins' => 'Respostas',
	'answers-bluebell' => 'Campaíña',
	'answers-leaf' => 'Folla',
	'answers-carnation' => 'Caravel',
	'answers-sky' => 'Ceo',
	'answers-spring' => 'Primavera',
	'answers-forest' => 'Bosque',
	'answers-moonlight' => 'Luar',
	'answers-carbon' => 'Carbono',
	'answers-obsession' => 'Obsesión',
	'answers-custom' => 'Personalizado',
);

/** Hungarian (Magyar)
 * @author TK-999
 */
$messages['hu'] = array(
	'answer_title' => 'Válasz',
	'answered_by' => 'Válaszolt:',
	'unregistered' => 'Nem regisztrált',
	'anonymous_edit_points' => '$1 segítő',
	'edit_points' => 'szerkesztési pont',
	'ask_a_question' => 'Kérdés feltevése&hellip;',
	'ask_a_question-widget' => 'Kérdés feltevése&hellip;',
	'ask_button' => 'Kérdés feltevése',
	'ask_thanks' => 'Köszönjük kérdésedet!', // @todo maybe replace rockin'.....
	'question_asked_by' => 'Kérdés feltevője:',
	'question_asked_by_anon' => '{{SITENAME}}-felhasználó által feltett kérdés',
	'new_question_comment' => 'új kérdés',
	'answers_toolbox' => 'WikiAnswers eszközkészlet',
	'improve_this_answer' => 'Válasz fejlesztése',
	'answer_this_question' => 'Kérdés megválaszolása',
	'notify_improved' => 'E&ndash;mail küldése a válasz fejlesztése esetén',
	'research_this' => 'Kutatás ez után',
	'notify_answered' => 'E&ndash;mail küldése megválaszoláskor',
	'recent_asked_questions' => 'Nemrégiben feltett kérdések',
	'recent_answered_questions' => 'Nemrégiben megválaszolt kérdések',
	'recent_edited_questions' => 'Nemrégiben szerkesztett kérdések',
	'unanswered_category' => 'Megválaszolatlan kérdések',
	'answered_category' => 'Megválaszolt kérdések',
	'related_questions' => 'Kapcsolódó kérdések',
	'related_answered_questions' => 'Kapcsolódó megválaszolt kérdések',
	'recent_unanswered_questions' => 'Legutóbbi megválaszolatlan kérdések',
	'popular_categories' => 'Népszerű kategóriák',
	'createaccount-captcha' => 'Kerjük, gépelje be az alábbi szót:',
	'inline-register-title' => 'Értesítés küldése a kérdés megválaszolásakor',
	'skip_this' => 'Lépés átugrása',
	'see_all_changes' => 'Összes változás megtekintése',
	'toolbox_anon_message' => '<em>"A Wikianswers a wikik egyedi tulajdonságait kihasználva a lehető legjobb válaszokat biztosítja bármely kérdésre."</em>',
	'no_questions_found' => 'Nem található kérdés',
	'next_page' => 'Tovább »',
	'prev_page' => '&laquo; Vissza',
	'see_all' => 'Összes megjelenítése',
	#'widget_ask_box' => 'Kérdésfeltevő mező megjelenítése',
	'question_redirected_help_page' => 'Miért irányították ide a kérdésem?',
	'twitter_hashtag' => 'wikianswers',
	'twitter_ask' => 'Kérdés feltevése a Twitteren',
	'facebook_ask' => 'Kérdés feltevése a Facebookon',
	'facebook_send_request' => 'Közvetlen küldés az ismerősöknek',
	'ask_friends' => 'Kérje meg barátait, hogy segítsenek a válaszadásban:',
	'facebook_send_request_content' => 'Tudsz segíteni ennek a megválaszolásában? $1',
	'facebook_signed_in' => 'A Facebook Connect&ndash;be vagy bejelentkezve',
	'magic_answer_headline' => 'Megfelelő&ndash;e a kérdésedre adott válasz?',
	'magic_answer_yes' => 'Igen, használja ezt kiindulási pontként',
	'magic_answer_no' => 'Nem, ne használja ezt',
	'magic_answer_credit' => 'Yahoo Answers által biztosított',
	'rephrase' => 'Kérdés átfogalmazása',
	'rephrase_this' => '<a href="$1" $2>Kérdés újrafogalmazása</a>',
	'question_not_answered' => 'Ez a kérdés megválaszolatlan',
	'you_can' => 'Képes vagy:',
	'answer_this' => '<a href="$1">Kérdés megválaszolása</a>, a teljes válaszhoz szükséges tudás hiánya esetén is',
	'research_this_on_wikipedia' => '<a href="$1">Kérdéshez kapcsolódó kutatás végzése</a> a Wikipédián',
	'ask_friends_on_twitter' => 'Barátok megkérdezése a <a href="$1" $2>Twitteren</a>',
	'categorize' => 'Kategorizáció',
	'categorize_help' => 'Soronként egy kategória',
	'answers_widget_admin_note' => '<b>Adminisztrátorok:</b> Ha adminisztrátor szeretnél lenni a <a href="http://answers.wikia.com" target="_blank">Wikianswersen</a>, <a href="http://answers.wikia.com/wiki/Wikianswers:Become_an_admin" target="_blank">kattints ide</a>.',
);

/** Interlingua (Interlingua)
 * @author McDutchie
 */
$messages['ia'] = array(
	'answer_title' => 'Responsa',
	'answered_by' => 'Respondite per',
	'unregistered' => 'Non registrate',
	'anonymous_edit_points' => '$1 {{PLURAL:$1|adjutor|adjutores}}',
	'edit_points' => '{{PLURAL:$1|puncto|punctos}} de modification',
	'ask_a_question' => 'Poner un question...',
	'ask_a_question-widget' => 'Poner un question...',
	'in_category' => '...in categoria',
	'ask_button' => 'Demandar',
	'ask_thanks' => 'Gratis pro le question!', // @todo maybe replace rockin'.....
	'question_asked_by' => 'Question ponite per',
	'question_asked_by_anon' => 'Question ponite per un usator de {{SITENAME}}',
	'new_question_comment' => 'nove question',
	'answers_toolbox' => 'Instrumentario WikiResponsas',
	'improve_this_answer' => 'Meliorar iste responsa',
	'answer_this_question' => 'Responder a iste question:',
	'notify_improved' => 'Inviar me un e-mail quando es meliorate',
	'research_this' => 'Recercar isto',
	'notify_answered' => 'Inviar me un e-mail quando es respondite',
	'recent_asked_questions' => 'Questiones ponite recentemente',
	'recent_answered_questions' => 'Questiones con responsas recente',
	'recent_edited_questions' => 'Questiones modificate recentemente',
	'unanswered_category' => 'Questiones sin responsa',
	'answered_category' => 'Questiones con responsa',
	'related_questions' => 'Questiones connexe',
	'related_answered_questions' => 'Questiones connexe con responsa',
	'recent_unanswered_questions' => 'Questiones recente sin responsa',
	'popular_categories' => 'Categorias popular',
	'createaccount-captcha' => 'Entra le parola hic infra',
	'inline-register-title' => 'Notificar me quando mi question recipe un responsa!',
	'inline-welcome' => 'Benvenite a WikiResponsas',
	'skip_this' => 'Saltar isto',
	'see_all_changes' => 'Vider tote le cambiamentos',
	'toolbox_anon_message' => '<i>"Wikiresponsas utilisa le characteristicas unic de un wiki pro formar le optime responsas a omne question."</i>',
	'no_questions_found' => 'Nulle question trovate',
	'next_page' => 'Sequente &raquo;',
	'prev_page' => '&laquo; Precedente',
	'see_all' => 'Vider totes',
	#'widget_ask_box' => 'Includer quadro de demanda',
	'question_redirected_help_page' => 'Proque mi question ha essite redirigite hic',
	'twitter_hashtag' => 'wikiresponsas',
	'twitter_ask' => 'Demandar in Twitter',
	'facebook_ask' => 'Demandar in Facebook',
	'facebook_send_request' => 'Inviar directemente a amicos',
	'ask_friends' => 'Demandar a tu amicos de adjutar a responder:',
	'facebook_send_request_content' => 'Pote tu adjutar a responder a isto? $1',
	'facebook_signed_in' => 'Tu es authenticate con Facebook Connect',
	'magic_answer_headline' => 'Esque isto responde a tu question?',
	'magic_answer_yes' => 'Si, usar isto como puncto de initio',
	'magic_answer_no' => 'No, non usar isto',
	'magic_answer_credit' => 'Fornite per Yahoo Answers',
	'rephrase' => 'Reformular iste question',
	'rephrase_this' => '<a href="$1" $2>Reformular le question</a>',
	'question_not_answered' => 'Iste question non ha responsa',
	'you_can' => 'Tu pote:',
	'answer_this' => '<a href="$1">Responder a iste question</a>, mesmo si tu non cognosce tote le responsa',
	'research_this_on_wikipedia' => '<a href="$1">Recercar iste question</a> in Wikipedia',
	'receive_email' => '<a href="$1" $2>Reciper un e-mail</a> quando iste question recipe un responsa',
	'ask_friends_on_twitter' => 'Demandar lo a amicos in <a href="$1" $2>Twitter</a>',
	'quick_action_panel' => 'Pannello de action rapide',
	'categorize' => 'Categorisar',
	'categorize_help' => 'Un categoria per linea',
	'answers_widget_admin_note' => '<b>Administratores:</b> Si tu vole devenir administrator in <a href="http://answers.wikia.com" target="_blank">Wikiresponsas</a>, <a href="http://answers.wikia.com/wiki/Wikianswers:Become_an_admin" target="_blank">clicca hic</a>.',
	'answers_widget_user_note' => 'Pote tu adjutar per devenir <a href="http://answers.wikia.com/wiki/Wikianswers:Sign_up_for_a_category" target="_blank">redactor de categoria</a> in <a href="http://answers.wikia.com" target="_blank">Wikiresponsas</a>?',
	'answers_widget_anon_note' => '<a href="http://answers.wikia.com" target="_blank">Wikiresponsas</a> es un sito Q&amp;R ubi on meliora le responsas in modo wiki.',
	'answers-category-count-answered' => 'Iste categoria contine $1 {{PLURAL:$1|question|questiones}} con responsa.',
	'answers-category-count-unanswered' => 'Iste categoria contine $1 {{PLURAL:$1|question|questiones}} sin responsa.',
	'answers_widget_no_questions' => '<a href="http://answers.wikia.com" target="_blank">Wikiresponsas</a> es un sito ubi tu pote poner questiones e contribuer responsas. Nos aspira a crear le melior responsa a omne question. <a href="http://answers.wikia.com/wiki/Special:Search" target="_blank">Cerca</a> e responde a questiones <a href="http://answers.wikia.com/wiki/Category:Un-answered_questions">sin responsa</a>. Isto es un wiki - dunque sia audace!',
	'answers_widget_no_questions_askabout' => '<br /><br />Comencia per poner un question super "{{PAGENAME}}"',
	'reword_this' => '<a href="$1" $2>Reformular iste question</a>',
	'no_related_answered_questions' => 'Il non ha ancora questiones connexe. Vide un <a href="http://answers.wikia.com/wiki/Special:Randomincategory/answered_questions">question aleatori con responsa</a> in su loco, o pone un nove!<br />
	<div class="createbox" align="center">
	<p></p><form name="createbox" action="/index.php" method="get" class="createboxForm">
	<input name="action" value="create" type="hidden">
	<input name="prefix" value="Special:CreateQuestionPage/" type="hidden">
	<input name="editintro" value="" type="hidden">
	<input class="createboxInput" name="title" value="" size="50" type="text">
	<input name="create" class="createboxButton" value="Scribe tu question e clicca hic" type="submit"></form></div>',
	'auto_friend_request_body' => 'Vole tu adder me qua amico?',
	'tog-hidefromattribution' => 'Celar mi avatar e nomine del lista de attributiones',
	'a' => 'Responsa:',
	'answering_tips' => '<h3>Consilios pro responder:</h3> Quando tu contribue un responsa, tenta esser si accurate como possibile. Si tu recipe information de un altere fonte como Wikipedia, insere un ligamine verso isto in le texto. E gratias pro contribuer a {{SITENAME}}!',
	'plus_x_more_helpers' => '... e $1 altere adjutores',
	'anwb-step1-headline' => 'Que es le thema de tu wiki?',
	'anwb-step1-text' => 'Le sito Wikiresponsas require un <strong>slogan</strong>.<br /><br />Iste slogan adjutara le publico a trovar tu sito via motores de recerca, dunque describe clarmente le subjecto de tu sito.',
	'anwb-step1-example' => 'Responsas a tote tu questiones sur le lucta professional!',
	'anwb-choose-logo' => 'Selige tu logo',
	'anwb-step2-text' => 'Postea, selige un logo pro {{SITENAME}}. Es preferibile incargar un imagine que representa, secundo te, le sito de responsas.<br />Es possibile saltar iste passo si tu non vole facer lo ora.<br /><br />',
	'anwb-step2-example' => 'Isto esserea un bon logo pro un sito de responsas a proposito del skateboard.',
	'anwb-fp-headline' => 'Pone alcun questiones!',
	'anwb-fp-text' => 'Tu sito de responsas deberea comenciar con alcun questiones!<br /><br />Adde un lista de questiones, e forni tu mesme le questiones. Es importante haber alcun information utile in le sito, de sorta que le gente pote trovar lo e poner e responder a ancora plus questiones.',
	'anwb-fp-example' => '<strong>Exemplo</strong><br /><br />Pro un sito de responsas sur animales domestic :<br /><br /><ul><li>Debe io comprar gravella pro cattos?</li><li>Qual es le melior racia de can?</li><li>Qual es le melior modo de trainar un catto?</li><li></ul><br /><br />Pro un sito de responsas sur le sanitate:<br /><br /><ul><li>Quales es le effectos positive sur le sanitate de facer exercitio?</li><li>Como pote io trovar un bon medico in mi vicinitate?</li><li>Como perder peso facilemente?</li></ul>',
	'nwb-thatisall-headline' => 'Isto es toto - tu ha finite!',
	'anwb-thatisall-text' => 'Isto es toto - tu es preste a comenciar!<br /><br />Ora es tempore de comenciar a scriber plus questiones e responsas, a fin que tu sito pote esser trovate plus facilemente in motores de recerca.<br /><br />Le lista de questiones addite in le ultime passo ha essite placiate in tu sito de questiones. Va responder a iste questiones, e comencia tu proprie communitate de responsas!',
	'anwb-logo-preview' => 'Ecce un previsualisation de tu logo',
	'anwb-save-tagline' => 'Salveguardar motto',
	'qa-toolbox-button' => 'Responder a un question aleatori',
	'qa-toolbox-share' => 'Divider',
	'qa-toolbox-tools' => 'Instrumentos avantiate»',
	'qa-toolbox-protect' => 'Proteger iste question',
	'qa-toolbox-delete' => 'Deler iste question',
	'qa-toolbox-history' => 'Versiones anterior de iste pagina',
	'answers_skins' => 'Responsas',
	'answers-bluebell' => 'Campanula',
	'answers-leaf' => 'Folio',
	'answers-carnation' => 'Diantho',
	'answers-sky' => 'Celo',
	'answers-spring' => 'Primavera',
	'answers-forest' => 'Foreste',
	'answers-moonlight' => 'Claro de luna',
	'answers-carbon' => 'Carbon',
	'answers-obsession' => 'Obsession',
	'answers-custom' => 'Personalisate',
);

/** Indonesian (Bahasa Indonesia)
 * @author Aldnonymous
 */
$messages['id'] = array(
	'answer_title' => 'Jawaban',
	'answered_by' => 'Dijawab oleh',
	'unregistered' => 'Tidak terdaftar',
	'anonymous_edit_points' => '$1 {{PLURAL:$1|Helper|Helpers}}',
	'edit_points' => '{{PLURAL:$1|edit point|edit points}}',
	'ask_a_question' => 'Mengajukan pertanyaan...',
	'ask_a_question-widget' => 'Mengajukan pertanyaan...',
	'in_category' => '...di dalam kategori',
	'ask_button' => 'Tanya',
	'ask_thanks' => 'Terima kasih untuk pertanyaan yang bagus!', // @todo maybe replace rockin'.....
	'question_asked_by' => 'pertanyaan diajukan oleh',
	'question_asked_by_anon' => 'pertanyaan di ajukan oleh pengguna {{SITENAME}}',
	'new_question_comment' => 'pertanyaan baru',
	'answers_toolbox' => 'kotak peralatan Wikianswer',
	'improve_this_answer' => 'Perbaiki jawaban ini',
	'answer_this_question' => 'Jawab pertanyaan:',
	'notify_improved' => 'Email saya bila jawaban diperbaharui',
	'research_this' => 'cari ulang ini',
	'notify_answered' => 'Email saya ketika dijawab',
	'recent_asked_questions' => 'Pertanyaan yang baru baru ini di ajukan',
	'recent_answered_questions' => 'Pertanyaan yang baru baru ini dijawab',
	'recent_edited_questions' => 'Pertanyaan yang baru baru ini di sunting',
	'unanswered_category' => 'Pertanyaan yang belum di-jawab',
	'answered_category' => 'Pertanyaan yang sudah di jawab',
	'related_questions' => 'Pertanyaan terkait',
	'related_answered_questions' => 'Jawaban pertanyaan yang terkait',
	'recent_unanswered_questions' => 'Pertanyaan yang baru baru ini tidak terjawab',
	'popular_categories' => 'Kategori yang populer',
	'createaccount-captcha' => 'Ketik kata kata di bawah ini',
	'inline-register-title' => 'Beritahukan saya bila pertanyaan saya di jawab!',
	'inline-welcome' => 'Selamat datang di Wikianswers',
	'skip_this' => 'Lewatkan ini',
	'see_all_changes' => 'Lihat semua perubahan',
	'no_questions_found' => 'Tidak ada pertanyaan yang ditemukan',
	'next_page' => 'Next &raquo;',
	'prev_page' => '&laquo; Prev',
	'see_all' => 'Tampilkan semua',
	#'widget_ask_box' => 'Masukan kotak pertanyaan',
	'question_redirected_help_page' => 'Mengapa pertanyaan saya dialihkan di sini',
	'twitter_hashtag' => 'Wikianswers',
	'twitter_ask' => 'Tanya di Twitter',
	'facebook_ask' => 'Tanya di Facebook',
	'facebook_send_request' => 'Kirim langsung ke teman-teman',
	'ask_friends' => 'Tanyakan teman-teman Anda untuk membantu menjawab:',
	'facebook_send_request_content' => 'Dapatkah anda menjawab ini? $1',
	'facebook_signed_in' => 'Anda mendaftar ke Facebook Connect',
	'magic_answer_headline' => 'Apakah ini menjawab pertanyaan Anda?',
	'magic_answer_yes' => 'Ya, Gunakan ini sebagai titik awal',
	'magic_answer_no' => 'Tidak, Jangan gunakan ini',
	'magic_answer_credit' => 'Disediakan oleh Yahoo Answers',
	'rephrase' => 'Ulang kata-kata pertanyaan ini',
	'question_not_answered' => 'Pertanyaan ini belum dijawab',
	'you_can' => 'Kamu dapat:',
	'quick_action_panel' => 'Panel tindakan cepat',
	'categorize' => 'Mengkategorikan',
	'categorize_help' => 'Satu Kategori per baris',
	'answers-category-count-answered' => 'Kategori ini berisi $1 dijawab {{PLURAL:$1|question|questions}}.',
	'answers-category-count-unanswered' => 'Kategori ini berisi $1 tidak terjawab {{PLURAL:$1|question|questions}}.',
	'auto_friend_request_body' => 'Maukah anda menambahkan saya sebagai teman?',
	'tog-hidefromattribution' => 'Sembunyikan nama dan avatar dari daftar atribusi',
	'a' => 'Jawaban:',
	'plus_x_more_helpers' => '... ditambah  $1  pembantu lain',
	'anwb-step1-headline' => 'Tentang apakah wiki anda?',
	'anwb-choose-logo' => 'Pilih logo anda',
	'anwb-fp-headline' => 'Buat beberapa pertanyaan',
	'nwb-thatisall-headline' => 'itu dia -  anda telah selesai!',
	'anwb-logo-preview' => 'Ini adalah preview dari logo anda',
	'anwb-save-tagline' => 'Simpan slogan',
	'qa-toolbox-button' => 'Jawab pertanyaan acak',
	'qa-toolbox-share' => 'Bagikan',
	'qa-toolbox-tools' => 'Peralatan lanjutan>>',
	'qa-toolbox-protect' => 'Lindungi pertanyaan ini',
	'qa-toolbox-delete' => 'Hapus pertanyaan ini',
	'qa-toolbox-history' => 'Versi-versi sebelumnya dari halaman ini.',
	'answers_skins' => 'Jawaban',
	'answers-bluebell' => 'Bell biru',
	'answers-leaf' => 'Daun',
	'answers-carnation' => 'Anyelir',
	'answers-sky' => 'Langit',
	'answers-spring' => 'Musim semi',
	'answers-forest' => 'Hutan',
	'answers-moonlight' => 'Cahaya bulan',
	'answers-carbon' => 'Karbon',
	'answers-obsession' => 'Obsesi',
	'answers-custom' => 'Kustom',
);

/** Italian (Italiano)
 * @author Angros47
 * @author Leviathan 89
 * @author Nemo bis
 */
$messages['it'] = array(
	'answer_title' => 'Risposta',
	'answered_by' => 'Risposta da',
	'unregistered' => 'Non registrato',
	'anonymous_edit_points' => '$1 {{PLURAL:$1|contributore|contributori}}',
	'edit_points' => '{{PLURAL:$1|modifica punto|modifica punti}}',
	'ask_a_question' => 'Fai una domanda...',
	'ask_a_question-widget' => 'Fai una domanda...',
	'in_category' => '...nella categoria',
	'ask_button' => 'Chiedi',
	'ask_thanks' => 'Grazie per la domanda sconvolgente!', // @todo maybe replace rockin'.....
	'question_asked_by' => 'Domanda posta da',
	'question_asked_by_anon' => 'Domanda posta da un utente di {{SITENAME}}',
	'new_question_comment' => 'nuova domanda',
	'answers_toolbox' => 'Casella degli strumenti di Wikirisposte',
	'improve_this_answer' => 'Migliora questa risposta',
	'answer_this_question' => 'Rispondi a questa domanda:',
	'notify_improved' => "Mandami un'e-mail quando viene migliorata",
	'research_this' => 'Ricerca questo',
	'notify_answered' => "Mandami un'e-mail quando viene risposta",
	'recent_asked_questions' => 'Domande poste di recente',
	'recent_answered_questions' => 'Domande risolte di recente',
	'recent_edited_questions' => 'Domande modificate di recente',
	'unanswered_category' => 'Domande senza risposta',
	'answered_category' => 'Domande risolte',
	'related_questions' => 'Domande correlate',
	'related_answered_questions' => 'Domande risolte correlate',
	'recent_unanswered_questions' => 'Domande senza risposta recenti',
	'popular_categories' => 'Categorie popolari',
	'createaccount-captcha' => 'Per favore, digita la parola qui sotto',
	'inline-register-title' => 'Avvisami quando rispondono alla mia domanda!',
	'inline-welcome' => 'Benvenuti a Wikirisposte',
	'skip_this' => 'Salta questo',
	'see_all_changes' => 'Vedere tutte le modifiche',
	'toolbox_anon_message' => '<i>"Wikirisposte sfrutta le caratteristiche uniche di una wiki per formare le migliori risposte a qualsiasi domanda."</i>',
	'no_questions_found' => 'Nessuna domanda trovata',
	'next_page' => 'Successivo &raquo;',
	'prev_page' => '&laquo; Precedente',
	'see_all' => 'Vedi tutti',
	#'widget_ask_box' => 'Includi il box chiedi',
	'question_redirected_help_page' => 'Perché la mia domanda è stata reindirizzata qui',
	'twitter_hashtag' => 'Wikirisposte',
	'twitter_ask' => 'Chiedi su Twitter',
	'facebook_ask' => 'Chiedi su Facebook',
	'facebook_send_request' => 'Invia direttamente agli amici',
	'ask_friends' => 'Chiedi aiuto ai tuoi amici per rispondere:',
	'facebook_send_request_content' => 'Puoi aiutare a rispondere a questo? $1',
	'facebook_signed_in' => 'Sei connesso in Facebook Connect',
	'magic_answer_headline' => 'Questo risponde alla tua domanda?',
	'magic_answer_yes' => 'Sì, usa questo come punto di partenza',
	'magic_answer_no' => 'No, non utilizzare questo',
	'magic_answer_credit' => 'Fornito da Yahoo Answers',
	'rephrase' => 'Riformula questa domanda',
	'rephrase_this' => '<a href="$1" $2>Riformula la domanda</a>',
	'question_not_answered' => 'Questa domanda non ha avuto risposta',
	'you_can' => 'Tu puoi:',
	'answer_this' => '<a href="$1">Rispondi a questa domanda</a>, anche se non conosci la risposta completa',
	'research_this_on_wikipedia' => '<a href="$1">Cerca questa domanda</a> su Wikipedia',
	'receive_email' => '<a href="$1" $2>Ricevi una e-mail</a> quando questa domanda viene risposta',
	'ask_friends_on_twitter' => 'Chiedi agli amici su <a href="$1" $2>Twitter</a>',
	'quick_action_panel' => 'Pannello di azione rapida',
	'categorize' => 'Categorizza',
	'categorize_help' => 'Una categoria per riga',
	'answers_widget_admin_note' => '<b>Amministratori:</b> Se vuoi diventare un\'amministratore su <a href="http://answers.wikia.com" target="_blank">Wikirisposte</a>, <a href="http://answers.wikia.com/wiki/Wikianswers:Become_an_admin" target="_blank">clicca qui</a>.',
	'answers_widget_user_note' => 'Puoi aiutare diventando un <a href="http://answers.wikia.com/wiki/Wikianswers:Sign_up_for_a_category" target="_blank">editore di categorie</a> su <a href="http://answers.wikia.com" target="_blank">Wikirisposte</a>?',
	'answers_widget_anon_note' => '<a href="http://answers.wikia.com" target="_blank">Wikirisposte</a> è una D&amp;R wiki dove le risposte sono migliorate, in stile wiki.',
	'answers-category-count-answered' => 'Questa categoria contiene $1 {{PLURAL:$1|domanda|domande}} risolte.',
	'answers-category-count-unanswered' => 'Questa categoria contiente $1 {{PLURAL:$1|domanda|domande}} senza risposta.',
	'answers_widget_no_questions' => '<a href="http://answers.wikia.com" target="_blank">Wikirisposte</a> è un sito dove puoi porre domande e contribuire rispondendo. Il nostro obiettivo è fornire le risposte migliori a qualunque domanda. <a href="http://answers.wikia.com/wiki/Special:Search" target="_blank">Trova</a> e rispondi alle domande <a href="http://answers.wikia.com/wiki/Category:Un-answered_questions">senza risposta</a>. È una wiki - quindi sii audace!',
	'answers_widget_no_questions_askabout' => '<br /><br />Inizia chiedendo qualcosa su "{{PAGENAME}}"',
	'reword_this' => '<a href="$1" $2>Riformula questa domanda</a>',
	'no_related_answered_questions' => 'Non ci sono ancora domande correlate. Ottieni <a href="http://answers.wikia.com/wiki/Special:Randomincategory/answered_questions">una risposta ad una domanda casuale invece</a>, o chiedi una nuova domanda!<br />
	<div class="createbox" align="center">
	<p></p><form name="createbox" action="/index.php" method="get" class="createboxForm">
	<input name="action" value="crea" type="hidden">
	<input name="prefix" value="Special:CreateQuestionPage/" type="hidden">
	<input name="editintro" value="" type="hidden">
	<input class="createboxInput" name="title" value="" size="50" type="text">
	<input name="create" class="createboxButton" value="Digita la tua domanda e clicca qui" type="submit"></form></div>',
	'auto_friend_request_body' => 'Mi aggiungi come amico?',
	'tog-hidefromattribution' => 'Nascondi il mio avatar e il mio nome dalla lista di attribuzione',
	'a' => 'Risposta:',
	'answering_tips' => '<h3>Suggerimenti per rispondere:</h3> Quando fornisci una risposta, cerca di essere il più accurato possibile. Se le tue informazioni provengono da un altro sito come Wikipedia, aggiungi il link della fonte nel testo. Grazie per contribuire a {{SITENAME}}!',
	'plus_x_more_helpers' => '... oltre a  $1  più aiutanti',
	'anwb-step1-headline' => 'Di cosa tratta la tua wiki?',
	'anwb-step1-text' => "Il tuo sito Wikirisposte ha bisogno di una <strong>tagline</strong>.<br /><br />La tua tagline aiuterà le persone a trovare il tuo sito nei motori di ricerca, quindi cerca di essere chairo sull'argomento del tuo sito.",
	'anwb-step1-example' => 'Risposte a tutte le tue domande sul Pro-Wrestling!',
	'anwb-choose-logo' => 'Scegli il tuo logo',
	'anwb-step2-text' => "Dopo, scegli un logo per {{SITENAME}}. È meglio caricare l'immagine che pensi rappresenta al meglio il tuo sito di risposte.<br />Puoi saltare questo passo se non vuoi farlo adesso.<br /><br/ >",
	'anwb-step2-example' => 'Questo sarebbe un buon logo per un sito di risposte sullo skateboard.',
	'anwb-fp-headline' => 'Crea alcune domande!',
	'anwb-fp-text' => 'Il tuo sito di risposte dovrebbe iniziare con alcune domande!<br /><br />Aggiugni una lsita di domande, e fornisci le risposte tu stesso. È importante aggiugnere alcune informazioni importanti sul sito, cosicché le persone possano trovarlo e chiedere ancora più domande.',
	'anwb-fp-example' => "<strong>Esempio</strong><br /><br />Per un sito di risposte riguardo animali domestici:<br /><br /><ul><li>Devo comprare una lettiera per gatti?</li><li>Qual è la miglior razza di cani?</li><li>Qual è il modo migliore di addestrare un gatto?</li><li></ul><br /><br />Per un sito di salute e benessere:<br /><br /><ul><li>Quali sono i benefici dell'esercizio fisico?</li><li>Come posso trovare un buon medico nella mia zona?</li><li>Come posso perdere facilmente peso?</li></ul>",
	'nwb-thatisall-headline' => 'Questo è tutto - hai finito!',
	'anwb-thatisall-text' => "Questo è tutto - sei pronto ad iniziare!<br /><br />Adesso è ora di scrivere più domande e risposte, in modo che il tuo sito venga trovato più facilmente dai motori di ricerca.<br /><br />La lista di domande aggiunte nell'ultimo passo sono state aggiunte al tuo sito. Precipitati a rispondere alle tue domande e dai il via alla tua comunità!",
	'anwb-logo-preview' => "Ecco un'anteprima del tuo logo",
	'anwb-save-tagline' => 'Salva tagline',
	'qa-toolbox-button' => 'Rispondi ad una domanda casuale',
	'qa-toolbox-share' => 'Condividi',
	'qa-toolbox-tools' => 'Strumenti avanzati»',
	'qa-toolbox-protect' => 'Proteggi questa domanda',
	'qa-toolbox-delete' => 'Cancella questa domanda',
	'qa-toolbox-history' => 'Versioni precedenti di questa pagina',
	'answers_skins' => 'Risposte',
	'answers-bluebell' => 'Campanella',
	'answers-leaf' => 'Foglia',
	'answers-carnation' => 'Garofano',
	'answers-sky' => 'Cielo',
	'answers-spring' => 'Primavera',
	'answers-forest' => 'Foresta',
	'answers-moonlight' => 'Chiaro di luna',
	'answers-carbon' => 'Carbone',
	'answers-obsession' => 'Ossessione',
	'answers-custom' => 'Personalizzato',
);

/** Japanese (日本語) */
$messages['ja'] = array(
	'research_this' => 'この質問について調べる',
);

/** Luxembourgish (Lëtzebuergesch)
 * @author Robby
 */
$messages['lb'] = array(
	'answer_title' => 'Äntwert',
	'ask_a_question' => 'Eng Fro stellen...',
	'ask_a_question-widget' => 'Eng Fro stellen...',
	'in_category' => '...an der Kategorie',
	'ask_button' => 'Froen',
	'new_question_comment' => 'nei Fro',
	'improve_this_answer' => 'Dës Äntwert verbesseren',
	'answer_this_question' => 'Dës Fro beäntweren:',
	'research_this' => 'Dëst nosichen',
	'recent_asked_questions' => 'Rezent gestallte Froen',
	'answered_category' => 'Beäntwert Froen',
	'reword_this' => '<a href="$1" $2>Dës Fro nei formuléieren</a>',
);

/** Lithuanian (Lietuvių)
 * @author Eitvys200
 */
$messages['lt'] = array(
	'answer_title' => 'Atsakyti',
	'answered_by' => 'Atsakė',
	'unregistered' => 'Neregistruotas',
	'ask_a_question' => 'Užduoti klausimą...',
	'ask_a_question-widget' => 'Užduoti klausimą...',
	'in_category' => '...kategorija',
	'ask_button' => 'Klausti',
	'ask_thanks' => 'Ačiū už klausimą!', // @todo maybe replace rockin'.....
	'question_asked_by' => 'Klausimą uždavė',
	'question_asked_by_anon' => 'Klausymą uždavė {{SITENAME}}	naudotojas',
	'new_question_comment' => 'naujas klausimas',
	'answers_toolbox' => 'WikiAtsakymų įrankiai',
	'improve_this_answer' => 'Pagerinti šį atsakymą',
	'answer_this_question' => 'Atsakyti šį klausimą:',
	'notify_improved' => 'Atsiųskite el. laišką kaip buvo pagerintas',
	'notify_answered' => 'Siųskite el. laišką man kai bus atsakyta',
	'recent_asked_questions' => 'Neseniai Užduoti Klausymai',
	'recent_answered_questions' => 'Neseniai Atsakyti Klausymai',
	'recent_edited_questions' => 'Neseniai Redaguoti Klausymai',
	'unanswered_category' => 'Neatsakyti klausymai',
	'answered_category' => 'Atsakyti klausymai',
	'related_questions' => 'Susiję klausimai',
	'related_answered_questions' => 'Susije atsakyti klausimai',
	'recent_unanswered_questions' => 'Neseniai Neatsakyti Klausimai',
	'popular_categories' => 'Populiarios kategorijos',
	'inline-register-title' => 'Pranešti, kai į mano klausimą bus atsakyta!',
	'inline-welcome' => 'Sveiki atvykę į Wikianswers',
	'skip_this' => 'Praleisti šita',
	'see_all_changes' => 'Peržiūrėti visus pakeitimus',
	'no_questions_found' => 'Jokie klausymai nerasti',
	'see_all' => 'Žiūrėti visus',
	#'widget_ask_box' => 'Įtraukti atsakymo langelį',
	'question_redirected_help_page' => 'Kodėl mano klausymas buvo nukreiptas čia',
	'twitter_hashtag' => 'wikianswers',
	'twitter_ask' => 'Klaust Twitter',
	'facebook_ask' => 'Klausti Facebook',
	'facebook_send_request' => 'Siųsti Tiesiai Draugams',
	'ask_friends' => 'Paprašykite savo draugų, kad padėtų atsakyti:',
	'facebook_send_request_content' => 'Ar galite padėti atsakyti? $1',
	'magic_answer_headline' => 'Ar tai atsako į jūsų klausimą?',
	'magic_answer_yes' => 'Taip, naudoti tao kaip pradinį tašką',
	'magic_answer_no' => 'Ne, nenaudoti šio',
	'you_can' => 'Jūs galite:',
	'categorize_help' => 'Viena kategorija eilutėje',
	'auto_friend_request_body' => 'Ar pridėsi mane kaip draugą?',
	'a' => 'Atsakymas:',
	'anwb-step1-headline' => 'Apie ką jūsų wiki?',
	'anwb-choose-logo' => 'Pasirinkite savo logotipą',
	'anwb-fp-headline' => 'Sukurkite klausymų!',
	'nwb-thatisall-headline' => 'Štai ir baigta!',
	'anwb-logo-preview' => 'Čia yra jūsų logotipo peržiūra',
	'anwb-save-tagline' => 'Išsaugoti žymių liniją',
	'qa-toolbox-button' => 'Atsakyti į atsitiktini klausymą',
	'qa-toolbox-share' => 'Dalintis',
	'qa-toolbox-tools' => 'Išplėstiniai įrankiai»',
	'qa-toolbox-protect' => 'Apsaugoti šį klausimą',
	'qa-toolbox-delete' => 'Ištrinti šį klausimą',
	'qa-toolbox-history' => 'Ankstesnės šio puslapio versijos',
	'answers_skins' => 'Atsakymai',
	'answers-leaf' => 'Lapai',
	'answers-sky' => 'Dangus',
	'answers-spring' => 'Pavasaris',
	'answers-forest' => 'Miškas',
	'answers-moonlight' => 'Mėnesiena',
	'answers-custom' => 'Pasirinktinis',
);

/** Macedonian (Македонски)
 * @author Bjankuloski06
 */
$messages['mk'] = array(
	'answer_title' => 'Одговори',
	'answered_by' => 'Одговорено од',
	'unregistered' => 'Нерегистрирани',
	'anonymous_edit_points' => '$1 {{PLURAL:$1|помошник|помошници}}',
	'edit_points' => '{{PLURAL:$1|уреднички бод|уреднички бодови}}',
	'ask_a_question' => 'Постави прашање...',
	'ask_a_question-widget' => 'Постави прашање...',
	'in_category' => '...во категоријата',
	'ask_button' => 'Прашај',
	'ask_thanks' => 'Фала за феноменалното прашање!', // @todo maybe replace rockin'.....
	'question_asked_by' => 'Прашања го поставил',
	'question_asked_by_anon' => 'Прашањето го поставил корисник на {{SITENAME}}',
	'new_question_comment' => 'ново прашање',
	'answers_toolbox' => 'Алатник на Викиодговори',
	'improve_this_answer' => 'Подобри го одговорот',
	'answer_this_question' => 'Одогворете го прашањево:',
	'notify_improved' => 'Испрати ми е-пошта кога ќе се подобри',
	'research_this' => 'Истражи го ова',
	'notify_answered' => 'Испрати ми е-пошта кога ќе добие одговор',
	'recent_asked_questions' => 'Неодамна поставени прашања',
	'recent_answered_questions' => 'Неодамна одговорени прашања',
	'recent_edited_questions' => 'Неодамна уредени прашања',
	'unanswered_category' => 'Неодговорени прашања',
	'answered_category' => 'Одговорени прашања',
	'related_questions' => 'Поврзани прашања',
	'related_answered_questions' => 'Поврзани одговорени прашања',
	'recent_unanswered_questions' => 'Поврзани неодговорени прашања',
	'popular_categories' => 'Популарни категории',
	'createaccount-captcha' => 'Внесете го зборот подолу',
	'inline-register-title' => 'Извести ме кога моето прашање ќе добие одговор!',
	'inline-welcome' => 'Добредојдовте на Викиодговори',
	'skip_this' => 'Прескокни',
	'see_all_changes' => 'Сите промени',
	'toolbox_anon_message' => '<i>„Викиодговори ги користи уникатните карактеристики на викито за да оформи најдобри одговори на прашањата.“</i><br /><br /> <b>Џими Велс</b><br /> основач на Википедија и Викиодговори',//Jimmy Wales is mentioned here somewhere
	'no_questions_found' => 'Не пронајдов ниедно прашање',
	'next_page' => 'След &raquo;',
	'prev_page' => '&laquo; Прет',
	'see_all' => 'Сите',
	#'widget_ask_box' => 'Вклучи поле за поставање прашање',
	'question_redirected_help_page' => 'Зошто ми е преместено прашањето тука',
	'twitter_hashtag' => 'викиодговори',
	'twitter_ask' => 'Постави на Twitter',
	'facebook_ask' => 'Постави на Facebook',
	'facebook_send_request' => 'Испрати директно на пријателите',
	'ask_friends' => 'Побарајте помош од пријателите:',
	'facebook_send_request_content' => 'Можеш да ми помогнеш да го одговориме ова? $1',
	'facebook_signed_in' => 'Не сте најавени на Facebook Connect',
	'magic_answer_headline' => 'Дали ова е соодветен одговор на вашето прашање?',
	'magic_answer_yes' => 'Да, употреби го како почетна точка',
	'magic_answer_no' => 'Не, не го користи',
	'magic_answer_credit' => 'Овозможено од Yahoo Answers',
	'rephrase' => 'Преформулирај го прашањево',
	'rephrase_this' => '<a href="$1" $2>Преформулирај го прашањето</a>',
	'question_not_answered' => 'Ова прашање не е одговорено',
	'you_can' => 'Можете да:',
	'answer_this' => '<a href="$1">Одговорете го прашањето</a>, дури и да не знаете да одговорите целосно',
	'research_this_on_wikipedia' => '<a href="$1">Истражете за прашањево</a> на Википедија',
	'receive_email' => '<a href="$1" $2>Испрати е-пошта</a> кога прашањево ќе добие одговор',
	'ask_friends_on_twitter' => 'Прашај пријатели на <a href="$1" $2>Twitter</a>',
	'quick_action_panel' => 'Табла за брзи постапки',
	'categorize' => 'Категоризирај',
	'categorize_help' => 'По една категорија во секој ред',
	'answers_widget_admin_note' => '<b>Администратори:</b> Ако сакате да станете администратор на <a href="http://answers.wikia.com?uselang=mk" target="_blank">Викиодговори</a>, <a href="http://answers.wikia.com/wiki/Wikianswers:Become_an_admin?uselang=mk" target="_blank">стиснете тука</a>.',
	'answers_widget_user_note' => 'Можете ли да ни помогнете со тоа што ќе станете <a href="http://answers.wikia.com/wiki/Wikianswers:Sign_up_for_a_category?uselang=mk" target="_blank">уредник на категории</a> на <a href="http://answers.wikia.com?uselang=mk" target="_blank">Викиодговори</a>?',
	'answers_widget_anon_note' => '<a href="http://answers.wikia.com?uselang=mk" target="_blank">Викиодговори</a> е вики за прашања и одговори каде одговорите се подобруваат во вики-стил.',
	'answers-category-count-answered' => 'Оваа категорија содржи $1 {{PLURAL:$1|одговорено прашање|одговорени прашања}}.',
	'answers-category-count-unanswered' => 'Оваа категорија содржи $1 {{PLURAL:$1|неодговорено прашање|неодговорени прашања}}.',
	'answers_widget_no_questions' => '<a href="http://answers.wikia.com?uselang=mk" target="_blank">Викиодговори</a> е мрежно место кајшто можете да поставувате прашања и да давата ваши одговори. Се стремиме да дадеме најдобар одговор на било кое прашање. <a href="http://answers.wikia.com/wiki/Special:Search?uselang=mk" target="_blank">Најдете</a> <a href="http://answers.wikia.com/wiki/Category:Un-answered_questions?uselang=mk">неодговорени</a> прашања и одговорете ги. Ова е вики - бидете смели!',
	'answers_widget_no_questions_askabout' => '<br /><br />Започнете со постаување на прашање во врска со „{{PAGENAME}}“',
	'reword_this' => '<a href="$1" $2>Преформулирајте го прашањево</a>',
	'no_related_answered_questions' => 'Сè уште нема поврзани прашања. Погледајте <a href="http://answers.wikia.com/wiki/Special:Randomincategory/answered_questions?uselang=mk">случајно одговорено прашање</a>, или пак поставете ново!<br />
	<div class="createbox" align="center">
	<p></p><form name="createbox" action="/index.php" method="get" class="createboxForm">
	<input name="action" value="create" type="hidden">
	<input name="prefix" value="Special:CreateQuestionPage/" type="hidden">
	<input name="editintro" value="" type="hidden">
	<input class="createboxInput" name="title" value="" size="50" type="text">
	<input name="create" class="createboxButton" value="Внесете го прашањето и стиснете тука" type="submit"></form></div>',
	'auto_friend_request_body' => 'Сакаш да ме додадеш за пријател?',
	'tog-hidefromattribution' => 'Скриј ми го аватарот и името од списокот на заслуги',
	'q' => '<!-- -->',
	'a' => 'Одговор:',
	'answering_tips' => '<h3>Совети за одговарање:</h3> Кога давате одговор, бидете што попрецизни. Ако преземате информации од друг извор како Википедија, ставете врска до тој текст. Ви благодариме што учествувате на {{SITENAME}}!',
	'header_questionmark_post' => '?',
	'plus_x_more_helpers' => '... плус уште $1 помошници',
	'anwb-step1-headline' => 'Која е тематиката на викито?',
	'anwb-step1-text' => 'На вашата страница на Викиодговори ѝ треба <strong>гесло</strong>.<br /><br />Со помош на геслото, луѓето можат полесно да го најдат страницата во пребарувачите, и ќе дознаат на што е посветена.',
	'anwb-step1-example' => 'Одговори на сите ваши кечерски прашања!',
	'anwb-choose-logo' => 'Одберете лого',
	'anwb-step2-text' => 'Сега одберете лого за {{SITENAME}}. Подигнете слика што е претставителна за тематиката на страницата.<br />Ова можете да го прескокнете ако не сакате да го направите сега.<br /><br />',
	'anwb-step2-example' => 'Ова би било добро лого за страница посветена на скејтбордингот',
	'anwb-fp-headline' => 'Поставете прашања!',
	'anwb-fp-text' => 'Вашата страница со одговори мора да најпрвин да започне со прашања!<br /><br />Поставете список на прашања и самите напишете одговори. Важное е да внесете корисни информации на страницата, за да можат читателите да ги најдат и да поставуваат други прашања.',
	'anwb-fp-example' => '<strong>Пример</strong><br /><br />На страница за нега на миленици:<br /><br /><ul><li>Треба ли да купам песок за мачката?</li><li>Која е најдобра кучешка раса?</li><li>Како најдобро да издресирам мачка?</li><li></ul><br /><br />На страница за здравје:<br /><br /><ul><li>Како вежбањето помага на здравјето?</li><li>Каде да најдам добар доктор во околината?</li><li>Како лесно да ослабам?</li></ul>',
	'nwb-thatisall-headline' => 'Толку - готово!',
	'anwb-thatisall-text' => 'Толку - готови сте!<br /><br />Сега почнете да пишувате повеќе прашања и одговори, за да можат пребарувачите да ви ја пронајдат страницата полесно.<br /><br />Списокот на прашањата додадени во последниот чекор сега е сместен на вашето мреж. место. Појдете, одговорете ги прашањата и започнете своја заедница на прашања и одговори!',
	'anwb-logo-preview' => 'Еве преглед на вашето лого',
	'anwb-save-tagline' => 'Зачувај гесло',
	'qa-toolbox-button' => 'Одговори случајно прашање',
	'qa-toolbox-share' => 'Сподели',
	'qa-toolbox-tools' => 'Напредни алатки »',
	'qa-toolbox-protect' => 'Заштити го прашањево',
	'qa-toolbox-delete' => 'Избриши го прашањево',
	'qa-toolbox-history' => 'Претходни верзии на оваа страница.',
	'answers_skins' => 'Одговори',
	'answers-bluebell' => 'Зумбул',
	'answers-leaf' => 'Лист',
	'answers-carnation' => 'Каранфил',
	'answers-sky' => 'Небо',
	'answers-spring' => 'Пролет',
	'answers-forest' => 'Шума',
	'answers-moonlight' => 'Месечева светлина',
	'answers-carbon' => 'Јаглерод',
	'answers-obsession' => 'Опсесија',
	'answers-custom' => 'Прилагодено',
);

/** Malay (Bahasa Melayu)
 * @author Anakmalaysia
 */
$messages['ms'] = array(
	'answer_title' => 'Jawapan',
	'answered_by' => 'Dijawab oleh',
	'unregistered' => 'Tidak berdaftar',
	'anonymous_edit_points' => '$1 pembantu',
	'edit_points' => '$1 titik suntingan',
	'ask_a_question' => 'Tanya...',
	'ask_a_question-widget' => 'Tanya...',
	'in_category' => '...dalam kategori',
	'ask_button' => 'Tanya',
	'ask_thanks' => 'Terima kasih kerana bertanya!', // @todo maybe replace rockin'.....
	'question_asked_by' => 'Soalan yang ditanyakan oleh',
	'question_asked_by_anon' => 'Soalan yang ditanyakan oleh pengguna {{SITENAME}}',
	'new_question_comment' => 'soalan baru',
	'answers_toolbox' => 'Kotak alatan Wikianswers',
	'improve_this_answer' => 'Perbaiki jawapan ini',
	'answer_this_question' => 'Jawab soalan ini:',
	'notify_improved' => 'E-mel saya apabila diperbaiki',
	'research_this' => 'Selidik',
	'notify_answered' => 'E-mel saya apabila dijawab',
	'recent_asked_questions' => 'Soalan Terbaru',
	'recent_answered_questions' => 'Soalan Terjawab Terbaru',
	'recent_edited_questions' => 'Soalan Tersunting Terbaru',
	'unanswered_category' => 'Soalan yang tak terjawab',
	'answered_category' => 'Soalan yang dijawab',
	'related_questions' => 'Soalan berkaitan',
	'related_answered_questions' => 'Soalan terjawab berkaitan',
	'recent_unanswered_questions' => 'Soalan Tak Terjawab Terbaru',
	'popular_categories' => 'Kategori Popular',
	'createaccount-captcha' => 'Sila taipkan perkataan berikut',
	'inline-register-title' => 'Beritahu saya apabila soalan saya dijawab!',
	'inline-welcome' => 'Selamat datang ke Wikianswers',
	'skip_this' => 'Langkau',
	'see_all_changes' => 'Lihat semua perubahan',
	'toolbox_anon_message' => '<i>"Wikianswers memanfaarkan ciri-ciri unik wiki untuk menyampaikan jawapan yang terbaik sekali untuk sebarang soalan."',
	'no_questions_found' => 'Tiada soalan ditemui',
	'next_page' => 'Berikutnya &raquo;',
	'prev_page' => '&laquo; Sebelumnya',
	'see_all' => 'Lihat semua',
	#'widget_ask_box' => 'Sertakan kotak pertanyaan',
	'question_redirected_help_page' => 'Mengapa soalan saya dilencongkan ke sini',
	'twitter_hashtag' => 'wikianswers',
	'twitter_ask' => 'Tanya di Twitter',
	'facebook_ask' => 'Tanya di Facebook',
	'facebook_send_request' => 'Hantar Terus ke Kawan-Kawan',
	'ask_friends' => 'Minta kawan-kawan tolong jawab:',
	'facebook_send_request_content' => 'Bolehkah anda membantu menjawab soalan ini? $1',
	'facebook_signed_in' => 'Anda telah mendaftar masuk ke Facebook Connect',
	'magic_answer_headline' => 'Adakah ini menjawab soalan anda?',
	'magic_answer_yes' => 'Ya, gunakannya sebagai titik permulaan',
	'magic_answer_no' => 'Tidak, jangan gunakan ini',
	'magic_answer_credit' => 'Disediakan oleh Yahoo Answers',
	'rephrase' => 'Susun semula soalan ini',
	'rephrase_this' => '<a href="$1" $2>Tuliskan semula soalan supaya lebih mudah difahami</a>',
	'question_not_answered' => 'Soalan ini belum dijawab',
	'you_can' => 'Anda boleh:',
	'answer_this' => '<a href="$1">Jawab soalan in</a>, walaupun tak tahu seluruh jawapannya',
	'research_this_on_wikipedia' => '<a href="$1">Selidik soalan ini</a> di Wikipedia',
	'receive_email' => '<a href="$1" $2>Terima e-mel</a> apabila soalan ini dijawab',
	'ask_friends_on_twitter' => 'Tanya Kawan di <a href="$1" $2>Twitter</a>',
	'quick_action_panel' => 'Panel Tindakan Pantas',
	'categorize' => 'Kategorikan',
	'categorize_help' => 'Satu kategori sebaris',
	'answers_widget_admin_note' => '<b>Pentadbir:</b> Jika anda hendak menjadi pentadbir di <a href="http://answers.wikia.com" target="_blank">Wikianswers</a>, <a href="http://answers.wikia.com/wiki/Wikianswers:Become_an_admin" target="_blank">klik di sini</a>.',
	'answers_widget_user_note' => 'Bolehkah anda membantu dengan menjadi seorang <a href="http://answers.wikia.com/wiki/Wikianswers:Sign_up_for_a_category" target="_blank">penyunting kategori</a> di <a href="http://answers.wikia.com" target="_blank">Wikianswers</a>?',
	'answers_widget_anon_note' => '<a href="http://answers.wikia.com" target="_blank">Wikianswers</a> ialah sebuah wiki Soal Jawab di mana jawapan boleh diperbaiki seperti dalam wiki.',
	'answers-category-count-answered' => 'Kategori ini mempunyai $1 {{PLURAL:$1|soalan|soalan}} terjawab.',
	'answers-category-count-unanswered' => 'Kategori ini mempunyai $1 {{PLURAL:$1|soalan|soalan}} tak terjawab.',
	'answers_widget_no_questions' => '<a href="http://answers.wikia.com" target="_blank">Wikianswers</a> ialah tapak web di mana anda boleh menanyakan soalan dan menyumbangkan jawapan. Kami berusaha memberikan jawapan terbaik kepada sebarang soalan. <a href="http://answers.wikia.com/wiki/Special:Search" target="_blank">Cari</a> dan jawab soalan-soalan yang <a href="http://answers.wikia.com/wiki/Category:Un-answered_questions">belum dijawab</a>. Jangan segan, kan ini wiki!',
	'answers_widget_no_questions_askabout' => '<br /><br />Mulakan dengan menanyakan soalan tentang "{{PAGENAME}}"',
	'reword_this' => '<a href="$1" $2>Susun semula soalan ini</a>',
	'no_related_answered_questions' => 'Belum ada soalan yang berkaitan. Lihat pula <a href="http://answers.wikia.com/wiki/Special:Randomincategory/answered_questions">soalan terjawab secara rawak</a>, atau minta yang baru!<br />
	<div class="createbox" align="center">
	<p></p><form name="createbox" action="/index.php" method="get" class="createboxForm">
	<input name="action" value="create" type="hidden">
	<input name="prefix" value="Special:CreateQuestionPage/" type="hidden">
	<input name="editintro" value="" type="hidden">
	<input class="createboxInput" name="title" value="" size="50" type="text">
	<input name="create" class="createboxButton" value="Taipkan soalan anda dan klik di sini" type="submit"></form></div>',
	'auto_friend_request_body' => 'Boleh tak saya berkawan dengan kamu?',
	'tog-hidefromattribution' => 'Sorokkan avatar dan nama saya daripada senarai atribusi',
	'a' => 'Jawapan:',
	'answering_tips' => '<h3>Petua untuk menjawab:</h3> Pastikan jawapan yang anda sumbangkan itu adalah setepat yang boleh. Jika anda menerima maklumat dari sumber lain seperti Wikipedia, letakkan pautan kepada sumbernya dalam teks. Terima kasih atas sumbangan anda kepada {{SITENAME}}!',
	'plus_x_more_helpers' => '... serta $1 lagi pembantu',
	'anwb-step1-headline' => 'Apakah topik wiki anda?',
	'anwb-step1-text' => 'Tapak Wikianswers anda memerlukan <strong>slogan</strong>.<br /><br />Slogan anda akan membantu orang mencari laman anda dari enjin carian, jadi anda haruslah jelas akan topik untuk tapak anda.',
	'anwb-step1-example' => 'Jawapan untuk segala soalan anda tentang sukan gusti!',
	'anwb-choose-logo' => 'Pilih logo anda',
	'anwb-step2-text' => 'Kemudian, pilih satu logo untuk {{SITENAME}}. Anda sewajarnya memuat naik sebuah gambar yang anda rasai sebagai lambang yang sesuai untuk tapak Soal Jawab anda.<br />Anda boleh melangkau langkah ini jika anda tidak mahu berbuat demikian sekarang.<br /><br />',
	'anwb-step2-example' => 'Logo ini sesuai untuk tempat soal jawab papan luncur.',
	'anwb-fp-headline' => 'Buatlah soalan!',
	'anwb-fp-text' => 'Tapak Answers anda harus dimulakan dengan beberapa soalan!<br /><br />Sediakan satu senarai soalan, kemudian berikan jawapan anda sendiri. Adalah penting untuk mendapatkan maklumat yang berguna di tapak ini supaya orang ramai boleh mencarinya dan menanyakan banyak lagi soalan.',
	'anwb-fp-example' => '<strong>Contoh</strong><br /><br />Untuk tapak soal jawab haiwan belaan:<br /><br /><ul><li>Patutkah saya beli pasir kumbahan kucing?</li><li>Apakah baka anjing yang terbaik?</li><li>Apakah cara terbaik untuk melatih kucing?</li><li></ul><br /><br />Untuk tapak soal jawab jagaan kesihatan:<br /><br /><ul><li>Apakah faedah bersenam?</li><li>Di manakah doktor yang terbaik di KL?</li><li>Bagaimana untuk cepat kurangkan berat badan?</li></ul>',
	'nwb-thatisall-headline' => 'Itu saja – dah siap pun!',
	'anwb-thatisall-text' => 'Bagus, anda sudah bersedia!<br /><br />Sekarang masanya untuk mula menulis lebih banyak soalan dan jawapan supaya tapak anda lebih mudah dicari dalam enjin carian (Google dsb.).<br /><br />Senarai soalan yang disediakan dalam langkah terakhir itu telah diletakkan dalam tapak soal jawab anda. Masuklah untuk menjawab soalan anda, dan tubuhkan komuniti soal jawab anda sendiri!',
	'anwb-logo-preview' => 'Inilah pralihat logo anda',
	'anwb-save-tagline' => 'Simpan slogan',
	'qa-toolbox-button' => 'Jawab soalan rawak',
	'qa-toolbox-share' => 'Kongsi',
	'qa-toolbox-tools' => 'Peralatan lanjutan»',
	'qa-toolbox-protect' => 'Lindungi soalan ini',
	'qa-toolbox-delete' => 'Padamkan soalan ini',
	'qa-toolbox-history' => 'Versi-versi terdahulu bagi laman ini.',
	'answers_skins' => 'Answers',
	'answers-bluebell' => 'Blubel',
	'answers-leaf' => 'Daun',
	'answers-carnation' => 'Teluki',
	'answers-sky' => 'Langit',
	'answers-spring' => 'Musim Bunga',
	'answers-forest' => 'Hutan',
	'answers-moonlight' => 'Cahaya Bulan',
	'answers-carbon' => 'Karbon',
	'answers-obsession' => 'Obsesi',
	'answers-custom' => 'Tersuai',
);

/** Norwegian Bokmål (‪Norsk (bokmål)‬)
 * @author Audun
 */
$messages['nb'] = array(
	'answer_title' => 'Svar',
	'answered_by' => 'Besvart av',
	'unregistered' => 'Uregistrert',
	'anonymous_edit_points' => '$1 {{PLURAL:$1|hjelper|hjelpere}}',
	'edit_points' => '{{PLURAL:$1|redigeringspoeng|redigeringspoeng}}',
	'ask_a_question' => 'Still et spørsmål...',
	'ask_a_question-widget' => 'Still et spørsmål...',
	'in_category' => '... i kategorien',
	'ask_button' => 'Spør',
	'ask_thanks' => 'Takk for det fantastiske spørsmålet!', // @todo maybe replace rockin'.....
	'question_asked_by' => 'Spørsmål stilt av',
	'question_asked_by_anon' => 'Spørsmål stilt av en {{SITENAME}}-bruker',
	'new_question_comment' => 'nytt spørsmål',
	'answers_toolbox' => 'Verktøykasse for WikiSvar',
	'improve_this_answer' => 'Forbedre dette svaret',
	'answer_this_question' => 'Besvar dette spørsmålet:',
	'notify_improved' => 'Send meg en e-post når forbedret',
	'research_this' => 'Gransk dette',
	'notify_answered' => 'Send meg en e-post når besvart',
	'recent_asked_questions' => 'Siste stilte spørsmål',
	'recent_answered_questions' => 'Siste besvarte spørsmål',
	'recent_edited_questions' => 'Siste redigerte spørsmål',
	'unanswered_category' => 'Ubesvarte spørsmål',
	'answered_category' => 'Besvarte spørsmål',
	'related_questions' => 'Relaterte spørsmål',
	'related_answered_questions' => 'Relaterte besvarte spørsmål',
	'recent_unanswered_questions' => 'Siste ubesvarte spørsmål',
	'popular_categories' => 'Populære kategorier',
	'createaccount-captcha' => 'Vennligst skriv inn ordene under',
	'inline-register-title' => 'Varsle meg når spørsmålet mitt er besvart!',
	'inline-welcome' => 'Velkommen til WikiSvar',
	'skip_this' => 'Hopp over dette',
	'see_all_changes' => 'Se alle endringer',
	'toolbox_anon_message' => '<i>«WikiSvar utnytter den unike wiki-karakteristikken til å forme de beste svarene til ethvert spørsmål.»</i>',
	'no_questions_found' => 'Ingen spørsmål funnet',
	'next_page' => 'Neste &raquo;',
	'prev_page' => '&laquo; Forrige',
	'see_all' => 'Se alle',
	#'widget_ask_box' => 'Inkludér spørreboks',
	'question_redirected_help_page' => 'Hvorfor ble spørsmålet mitt omdirigert hit',
	'twitter_hashtag' => 'wikianswers',
	'twitter_ask' => 'Spør på Twitter',
	'facebook_ask' => 'Spør på Facebook',
	'facebook_send_request' => 'Send direkte til venner',
	'ask_friends' => 'Be vennene dine om hjelp til å svare:',
	'facebook_send_request_content' => 'Kan du hjelpe til med å besvare dette? $1',
	'facebook_signed_in' => 'Du er logget inn med Facebook Connect',
	'magic_answer_headline' => 'Besvarer dette spørsmålet ditt?',
	'magic_answer_yes' => 'Ja, bruk dette som utgangspunkt',
	'magic_answer_no' => 'Nei, ikke bruk dette',
	'magic_answer_credit' => 'Levert av Yahoo Answers',
	'rephrase' => 'Omformuler dette spørsmålet',
	'rephrase_this' => '<a href="$1" $2>Omformuler spørsmålet</a>',
	'question_not_answered' => 'Dette spørsmålet har ikke blitt besvart',
	'you_can' => 'Du kan:',
	'answer_this' => '<a href="$1">Besvar dette spørsmålet</a>, selv om du ikke vet hele svaret',
	'research_this_on_wikipedia' => '<a href="$1">Undersøk dette spørsmålet</a> på Wikipedia',
	'receive_email' => '<a href="$1" $2>Motta en e-post</a> når dette spørsmålet er besvart',
	'ask_friends_on_twitter' => 'Spør venner på <a href="$1" $2>Twitter</a>',
	'quick_action_panel' => 'Hurtighandlingspanel',
	'categorize' => 'Kategorisér',
	'categorize_help' => 'Én kategori per linje',
	'answers_widget_admin_note' => '<b>Administratorer:</b> Hvis du ønsker å bli en administrator på <a href="http://answers.wikia.com" target="_blank">WikiSvar</a>, <a href="http://answers.wikia.com/wiki/Wikianswers:Become_an_admin" target="_blank">klikk her</a>.',
	'answers_widget_user_note' => 'Kan du hjelpe til ved å bli en <a href="http://answers.wikia.com/wiki/Wikianswers:Sign_up_for_a_category" target="_blank">kategoriredaktør</a> på <a href="http://answers.wikia.com" target="_blank">WikiSvar</a>?',
	'answers_widget_anon_note' => '<a href="http://answers.wikia.com" target="_blank">WikiSvar</a> er en spør-og-svar-wiki hvor svarene forbedres på wiki-vis.',
	'answers-category-count-answered' => 'Denne kategorien inneholder $1 besvarte {{PLURAL:$1|spørsmål|spørsmål}}.',
	'answers-category-count-unanswered' => 'Denne kategorien inneholder $1 ubesvarte {{PLURAL:$1|spørsmål|spørsmål}}.',
	'answers_widget_no_questions' => '<a href="http://answers.wikia.com" target="_blank">WikiSvar</a> er en side hvor du kan stille spørsmål og bidra med svar. Vi tar sikte på å ha det beste svaret på ethvert spørsmål. <a href="http://answers.wikia.com/wiki/Special:Search" target="_blank">Finn</a> og besvar <a href="http://answers.wikia.com/wiki/Kategori:Ubesvarte_spørsmål">ubesvarte</a> spørsmål. Det er en wiki – så vær modig!',
	'answers_widget_no_questions_askabout' => '<br /><br />Kom i gang ved å stille spørsmål om «{{PAGENAME}}»',
	'reword_this' => '<a href="$1" $2>Omformuler dette spørsmålet</a>',
	'no_related_answered_questions' => 'Det er ingen relaterte spørsmål ennå. Få et <a href="http://answers.wikia.com/wiki/Special:Randomincategory/answered_questions">tilfeldig besvart spørsmål istedenfor</a>, eller still et nytt!<br />
<div class="createbox" align="center">
<p></p><form name="createbox" action="/index.php" method="get" class="createboxForm">
<input name="action" value="create" type="hidden">
<input name="prefix" value="Special:CreateQuestionPage/" type="hidden">
<input name="editintro" value="" type="hidden">
<input class="createboxInput" name="title" value="" size="50" type="text">
<input name="create" class="createboxButton" value="Skriv spørsmålet ditt og trykk her" type="submit"></form></div>',
	'auto_friend_request_body' => 'Vil du legge meg til som venn?',
	'tog-hidefromattribution' => 'Skjul avataren og navnet mitt fra henvisningslisten',
	'q' => '<!-- -->',
	'a' => 'Svar:',
	'answering_tips' => '<h3>Tips for besvaring:</h3> Når du bidrar med et svar, forsøk å være så presis som mulig. Hvis du får informasjon fra en annen kilde, slik som Wikia, legg til en lenke til denne i teksten. Og takk for ditt bidrag til {{SITENAME}}!',
	'header_questionmark_post' => '?',
	'plus_x_more_helpers' => '... pluss $1 andre hjelpere',
	'anwb-step1-headline' => 'Hva handler wikien din om?',
	'anwb-step1-text' => 'WikiSvar-siden din trenger et <strong>slagord</strong>.<br /><br />Slagordet ditt vil hjelpe folk å finne siden gjennom søkemotorer, så prøv å være tydelig på hva siden handler om.',
	'anwb-step1-example' => 'Svar på alle dine spørsmål om proffbryting!',
	'anwb-choose-logo' => 'Velg en logo',
	'anwb-step2-text' => 'Neste steg er å velge en logo for {{SITENAME}}. Det er best å laste opp et bilde som du synes representerer din Svar-side.<br />Du kan hoppe over dette trinnet hvis du ikke vil gjøre det akkurat nå.<br /><br />',
	'anwb-step2-example' => 'Dette ville vært en god logo for en svarside om skateboarding.',
	'anwb-fp-headline' => 'Still noen spørsmål!',
	'anwb-fp-text' => 'Svar-siden din bør starte opp med noen spørsmål!<br /><br />Legg til en liste med spørsmål, og så oppgi svarene selv. Det er viktig å ha litt nyttig informasjon på siden, slik at folk kan finne den og spørre og svare på enda flere spørsmål.',
	'anwb-fp-example' => '<strong>Eksempel</strong><br /><br />Til en svarside om dyrestell:<br /><br /><ul><li>Bør jeg kjøpe kattesand?</li><li>Hva er den beste hunderasen?</li><li>Hva er den beste måten å trene en katt på?</li><li></ul><br /><br />For en svarside om helse:<br /><br /><ul><li>Hva er de helsemessige fordelene ved trening?</li><li>Hvordan kan jeg finne en god doktor i mitt område?</li><li>Hvordan kan jeg enkelt gå ned i vekt?</li></ul>',
	'nwb-thatisall-headline' => 'Det var det – du er ferdig!',
	'anwb-thatisall-text' => 'Det var det – du er klar til å komme i gang!<br /><br />Nå er det på tide å begynne å skrive noen spørsmål og svar, slik at siden din lettere kan bli funnet av søkemotorer.<br /><br />Listen over spørsmål lagt til i det siste steget har blitt lagt til spørsmålssiden din. Gå og besvar spørsmålene, og start ditt eget svar-fellesskap!',
	'anwb-logo-preview' => 'Her er en forhåndsvisning av logoen din',
	'anwb-save-tagline' => 'Lagre slagord',
	'qa-toolbox-button' => 'Besvar et tilfeldig spørsmål',
	'qa-toolbox-share' => 'Del',
	'qa-toolbox-tools' => 'Avanserte verktøy»',
	'qa-toolbox-protect' => 'Beskytt dette spørsmålet',
	'qa-toolbox-delete' => 'Slett dette spørsmålet',
	'qa-toolbox-history' => 'Tidligere versjoner av denne siden',
	'answers_skins' => 'Svar',
	'answers-bluebell' => 'Blåklokke',
	'answers-leaf' => 'Blad',
	'answers-carnation' => 'Nellik',
	'answers-sky' => 'Himmel',
	'answers-spring' => 'Vår',
	'answers-forest' => 'Skog',
	'answers-moonlight' => 'Måneskinn',
	'answers-carbon' => 'Karbon',
	'answers-obsession' => 'Besettelse',
	'answers-custom' => 'Egendefinert',
);

/** Dutch (Nederlands)
 * @author Mark van Alphen
 * @author McDutchie
 * @author SPQRobin
 * @author Siebrand
 */
$messages['nl'] = array(
	'answer_title' => 'Antwoord',
	'answered_by' => 'Beantwoord door',
	'unregistered' => 'Niet-geregistreerd',
	'anonymous_edit_points' => '$1 {{PLURAL:$1|helper|helpers}}',
	'edit_points' => '{{PLURAL:$1|bewerkingspunt|bewerkingspuntent}}',
	'ask_a_question' => 'Stel een vraag...',
	'ask_a_question-widget' => 'Stel een vraag...',
	'in_category' => '...in categorie',
	'ask_button' => 'Vragen',
	'ask_thanks' => 'Bedankt voor uw vraag!', // @todo maybe replace rockin'.....
	'question_asked_by' => 'Vraag gesteld door',
	#'question_asked_by_anon' => 'Vraag gesteld door een {{SITENAME}}-gebruiker',
	'new_question_comment' => 'nieuwe vraag',
	#'answers_toolbox' => 'Wikiantwoordenpaneel',
	'improve_this_answer' => 'Dit antwoord verbeteren',
	'answer_this_question' => 'Deze vraag beantwoorden:',
	'notify_improved' => 'E-mail mij als een antwoord wordt verbeterd',
	'research_this' => 'Opzoeken',
	'notify_answered' => 'E-mail mij als een vraag wordt beantwoord',
	'recent_asked_questions' => 'Recent gestelde vragen',
	'recent_answered_questions' => 'Recent beantwoorde vragen',
	'recent_edited_questions' => 'Recent bewerkte vragen',
	'unanswered_category' => 'Onbeantwoorde vragen',
	'answered_category' => 'Beantwoorde vragen',
	'related_questions' => 'Gerelateerde vragen',
	'related_answered_questions' => 'Gerelateerde beantwoorde vragen',
	'recent_unanswered_questions' => 'Recente onbeantwoorde vragen',
	'popular_categories' => 'Populaire categorieën',
	'createaccount-captcha' => 'Typ het woord hieronder',
	'inline-register-title' => 'Laat me weten wanneer mijn vraag wordt beantwoord!',
	#'inline-welcome' => 'Welkom bij Wikiantwoorden',
	'skip_this' => 'Overslaan',
	'see_all_changes' => 'Alle wijzigingen weergeven',
	#'toolbox_anon_message' => '<i>"Wikiantwoorden borduurt voort op de unieke eigenschappen van een wiki om het beste antwoord op iedere vraag te krijgen."</i>',
	'no_questions_found' => 'Geen vragen gevonden',
	'next_page' => 'Volgende &raquo;',
	'prev_page' => '&laquo; Vorige',
	'see_all' => 'Allemaal bekijken',
	#'widget_ask_box' => 'Venster voor nieuwe vraag toevoegen',
	'question_redirected_help_page' => 'Waarom is mijn vraag hiernaar doorverwezen',
	'twitter_ask' => 'Vragen op Twitter',
	'facebook_ask' => 'Vragen op Facebook',
	'facebook_send_request' => 'Direct naar vrienden verzenden',
	'ask_friends' => 'Vraag uw vrienden te helpen met beantwoorden:',
	'facebook_send_request_content' => 'Kunt u helpen deze vraag te beantwoorden? $1',
	'facebook_signed_in' => 'U bent aangemeld via Facebook Connect.',
	'magic_answer_headline' => 'Is uw vraag beantwoord?',
	'magic_answer_yes' => 'Ja, gebruik dit als beginpunt',
	'magic_answer_no' => 'Nee, niet gebruiken',
	'magic_answer_credit' => 'Aangeboden door Yahoo Antwoorden',
	'rephrase' => 'Deze vraag herformuleren',
	'rephrase_this' => '<a href="$1" $2>Vraag herformuleren</a>',
	'question_not_answered' => 'Deze vraag is niet beantwoord',
	'you_can' => 'U kunt:',
	'answer_this' => '<a href="$1">Deze vraag beantwoorden</a>, zelfs als u niet het hele antwoord weet',
	'research_this_on_wikipedia' => '<a href="$1">Deze vraag onderzoeken</a> op Wikipedia',
	'receive_email' => '<a href="$1" $2>Een e-mail ontvangen</a> wanneer deze vraag wordt beantwoordt',
	'ask_friends_on_twitter' => 'Vraag het vrienden op <a href="$1" $2>Twitter</a>',
	'quick_action_panel' => 'Snelle handelingen',
	'categorize' => 'Categorie toewijzen',
	'categorize_help' => 'Eén categorie per regel',
	#'answers_widget_admin_note' => '<b>Beheerders:</b> als u beheerder wilt worden op <a href="http://answers.wikia.com" target="_blank">Wikiantwoorden</a>, <a href="http://answers.wikia.com/wiki/Wikianswers:Become_an_admin" target="_blank">klik hier</a>.',
	#'answers_widget_user_note' => 'Kunt u helpen door een <a href="http://answers.wikia.com/wiki/Wikianswers:Sign_up_for_a_category" target="_blank">categorieredacteur</a> te worden op <a href="http://answers.wikia.com" target="_blank">WikiAntwoorden</a>?',
	#'answers_widget_anon_note' => '<a href="http://answers.wikia.com" target="_blank">WikiAntwoorden</a> is een vraag en antwoordwiki waar antwoorden op wikiwijze worden verbeterd.',
	'answers-category-count-answered' => 'Deze categorie bevat $1 beantwoorde {{PLURAL:$1|vraag|vragen}}.',
	'answers-category-count-unanswered' => 'Deze categorie bevat $1 onbeantwoorde {{PLURAL:$1|vraag|vragen}}.',
	#'answers_widget_no_questions' => '<a href="http://answers.wikia.com" target="_blank">WikiAntwoorden</a> is een site waar u vragen kunt stellen en kunt bijdragen aan antwoorden. We willen graag het beste antwoord op iedere vraag hebben. <a href="http://answers.wikia.com/wiki/Special:Search" target="_blank">Zoek</a> en beantwoord <a href="http://answers.wikia.com/wiki/Category:Un-answered_questions">vragen</a>. Het is een wiki, dus doe het gewoon!',
	'answers_widget_no_questions_askabout' => '<br /><br />Begin door een vraag te stellen over "{{PAGENAME}}"',
	'reword_this' => '<a href="$1" $2>Vraag herformuleren</a>',
	'no_related_answered_questions' => 'Er zijn nog geen gerelateerde vragen. Bekijk in plaats daarvan <a href="http://answers.wikia.com/wiki/Special:Randomincategory/answered_questions">een willekeurige beantwoorde vraag</a> of stel een nieuwe vraag!<br />
<div class="createbox" align="center">
<p></p><form name="createbox" action="/index.php" method="get" class="createboxForm">
<input name="action" value="create" type="hidden">
<input name="prefix" value="Special:CreateQuestionPage/" type="hidden">
<input name="editintro" value="" type="hidden">
<input class="createboxInput" name="title" value="" size="50" type="text">
<input name="create" class="createboxButton" value="Stel uw vraag en klik hier" type="submit"></form></div>',
	'auto_friend_request_body' => 'Wilt u mij als vriend toevoegen?',
	'tog-hidefromattribution' => 'Mijn avatar en naam verbergen in de lijst met naamsvermeldingen',
	'a' => 'Antwoord:',
	'answering_tips' => '<h3>Tips voor het beantwoorden:</h3> Als u een antwoord geeft, probeer dan zo precies mogelijk te zijn. Als u uw informatie uit een andere bron heeft gekregen, zoals Wikipedia, plaats dan een verwijzing in de tekst. Dank u wel voor uw bijdragen aan {{SITENAME}}!',
	'plus_x_more_helpers' => '... en $1 andere hulpjes',
	'anwb-step1-headline' => 'Waar gaat uw wiki over?',
	'anwb-step1-text' => 'Uw Wikiantwoordensite heeft een <strong>slogan</strong> nodig.<br /><br />Uw slogan helpt mensen uw site te vinden via zoekmachines, dus probeer te duidelijk zijn over waar uw site over gaat.',
	'anwb-step1-example' => 'Antwoorden op al uw vragen over professioneel worstelen!',
	'anwb-choose-logo' => 'Kies uw logo',
	'anwb-step2-text' => 'Kies nu een logo voor uw site. U kunt het beste een plaatje uploaden dat in uw ogen het beste uw Antwoordensite weergeeft.<br />U kunt deze stap overslaan als u die niet nu direct wilt uitvoeren.<br /><br />',
	'anwb-step2-example' => 'Dit is een goed logo voor een Antwoordensite over skateboarden.',
	'anwb-fp-headline' => 'Stel wat vragen!',
	'anwb-fp-text' => 'Uw Antwoordensite moet beginnen met een paar vragen!<br /><br />Voeg een lijst met vragen toe en geef vervolgens de antwoorden zelf. Het is belangrijk om wat nuttige informatie op de site te krijgen, zodat mensen de site kunnen vinden en nog meer vragen kunnen stellen en antwoorden kunnen geven.',
	'anwb-fp-example' => '<strong>Voorbeeld</strong><br /><br />Voor een site met vragen over zorgen voor huisdieren:<br /><br /><ul><li>Moet ik kattenbakvulling kopen?</li><li>Wat is de best gefokte hond?</li><li>Wat is de beste manier om een kat te trainen?</li><li></ul><br /><br />Voor een site met vragen over gezondheidszorg:<br /><br /><ul><li>Wat zijn de gezondheidsvoordelen van bewegen?</li><li>Hoe vind ik een goede huisarts in de buurt?</li><li>Hoe kan ik gemakkelijk gewicht verliezen?</li></ul>',
	'nwb-thatisall-headline' => 'Dat is het. Klaar!',
	'anwb-thatisall-text' => 'Dat is het. U bent klaar om van start te gaan!<br /><br />Nu moet u meer vragen en antwoorden gaan schrijven, zodat uw site makkelijker gevonden kan worden via zoekmachines.<br /><br />De lijst met vragen uit de laatste stap is toegevoegd aan uw Antwoordensite. Ga nu uw vragen beantwoorden en begin uw Antwoordengemeenschap!',
	'anwb-logo-preview' => 'Hier is een voorbeeld van uw logo',
	'anwb-save-tagline' => 'Slogan opslaan',
	'qa-toolbox-button' => 'Een willekeurige vraag beantwoorden',
	'qa-toolbox-share' => 'Delen',
	'qa-toolbox-tools' => 'Geavanceerde hulpmiddelen»',
	'qa-toolbox-protect' => 'Deze vraag beschermen',
	'qa-toolbox-delete' => 'Deze vraag verwijderen',
	'qa-toolbox-history' => 'Eerdere versies van deze pagina',
	'answers_skins' => 'Antwoorden',
	'answers-bluebell' => 'Klokje',
	'answers-leaf' => 'Blaadje',
	'answers-carnation' => 'Anjer',
	'answers-sky' => 'Lucht',
	'answers-spring' => 'Lente',
	'answers-forest' => 'Bos',
	'answers-moonlight' => 'Maneschijn',
	'answers-carbon' => 'Koolstof',
	'answers-obsession' => 'Obsessie',
	'answers-custom' => 'Aangepast',
);

/** ‪Nederlands (informeel)‬ (‪Nederlands (informeel)‬)
 * @author Siebrand
 */
$messages['nl-informal'] = array(
	'answers_widget_user_note' => 'Kan jij helpen door een <a href="http://answers.wikia.com/wiki/Wikianswers:Sign_up_for_a_category" target="_blank">categorieredacteur</a> te worden op <a href="http://answers.wikia.com" target="_blank">WikiaAntwoorden</a>?',
	'answers_widget_no_questions' => '<a href="http://answers.wikia.com" target="_blank">WikiAntwoorden</a> is een site waar je vragen kunt stellen en kunt bijdragen aan antwoorden. We willen graag het beste antwoord op iedere vraag hebben. <a href="http://answers.wikia.com/wiki/Special:Search" target="_blank">Zoek</a> en beantwoord <a href="http://answers.wikia.com/wiki/Category:Un-answered_questions">vragen</a>. Het is een wiki, dus doe het gewoon!',
);

/** Occitan (Occitan) */
$messages['oc'] = array(
	'research_this' => 'Recercar aquò',
);

/** Polish (Polski)
 * @author Sovq
 * @author Woytecr
 */
$messages['pl'] = array(
	'answer_title' => 'Odpowiedz',
	'answered_by' => 'Odpowiedział',
	'unregistered' => 'Niezarejestrowany',
	'anonymous_edit_points' => '$1 {{PLURAL:$1|element|elementy|elementów}}',
	'ask_a_question' => 'Zadaj pytanie...',
	'ask_a_question-widget' => 'Zadaj pytanie...',
	'in_category' => '...w kategorii',
	'ask_button' => 'Zapytaj',
	'ask_thanks' => 'Dziękujemy za pytanie!', // @todo maybe replace rockin'.....
	'question_asked_by' => 'Pytanie zadał',
	'question_asked_by_anon' => 'Pytanie zadana przez użytkownika {{SITENAME}}',
	'new_question_comment' => 'nowe pytanie',
	'answers_toolbox' => 'Narzędzia Wikianswers',
	'improve_this_answer' => 'Popraw tą odpowiedź',
	'answer_this_question' => 'Odpowiedz na to pytanie:',
	'notify_improved' => 'Wyślij e-mail przy poprawie',
	'research_this' => 'Wyszukaj',
	'notify_answered' => 'Wyślij e-mail przy odpowiedzi',
	'recent_asked_questions' => 'Ostatnio zadawane pytania',
	'recent_answered_questions' => 'Ostatnie pytania na które odpowiedziano',
	'recent_edited_questions' => 'Ostatnio edytowane pytania',
	'unanswered_category' => 'Pytania bez odpowiedzi',
	'answered_category' => 'Pytania z odpowiedziami',
	'related_questions' => 'Podobne pytania',
	'related_answered_questions' => 'Odpowiedzi na powiązane pytania',
	'recent_unanswered_questions' => 'Ostatnie pytania bez odpowiedzi',
	'popular_categories' => 'Popularne Kategorie',
	'createaccount-captcha' => 'Wpisz słowo poniżej',
	'inline-register-title' => 'Powiadom mnie gdy zostanie udzielona odpowiedź',
	'inline-welcome' => 'Witamy w Wikianswers',
	'skip_this' => 'Pomiń',
	'see_all_changes' => 'Zobacz wszystkie zmiany',
	'toolbox_anon_message' => '<i>"Wikianswers wykorzystuje unikatowe rozwiązania wiki aby udzielać najlepszych odpowiedzi na każde pytanie"</i>',
	'no_questions_found' => 'Nie znaleziono pytania',
	'next_page' => 'Następne &raquo;',
	'prev_page' => '&laquo; Poprzednie',
	'see_all' => 'Zobacz wszystkie',
	'question_redirected_help_page' => 'Dlaczego moje pytanie przekierowano tutaj',
	'twitter_ask' => 'Zapytaj na Twitterze',
	'facebook_ask' => 'Zapytaj na Facebooku',
	'facebook_send_request' => 'Wyślij do Znajomych',
	'ask_friends' => 'Poproś znajomych aby pomogli odpowiedzieć:',
	'facebook_send_request_content' => 'Możesz pomóc w odpowiedzi? $1',
	'magic_answer_headline' => 'Czy to wystarczająca odpowiedź?',
	'magic_answer_yes' => 'Tak, użyj tego jako punkt wyjścia',
	'magic_answer_no' => 'Nie, nie używaj tego',
	'magic_answer_credit' => 'Dostarczone przez Yahoo Answers',
	'rephrase' => 'Sformułuj to pytanie inaczej',
	'rephrase_this' => '<a href="$1" $2>Sformułuj to pytanie inaczej</a>',
	'question_not_answered' => 'Na to pytanie nie udzielono odpowiedzi',
	'you_can' => 'Możesz:',
	'answer_this' => '<a href="$1">Odpowiedz na to pytanie</a>, nawet jeśli nie znasz pełnej odpowiedzi',
	'ask_friends_on_twitter' => 'Zapytaj znajomych na <a href="$1" $2>Twitterze</a>',
	'categorize' => 'Określ kategorię',
	'categorize_help' => 'Jedna kategoria na linię',
);

/** Piedmontese (Piemontèis) */
$messages['pms'] = array(
	'research_this' => 'Sërché sòn',
);

/** Pashto (پښتو)
 * @author Ahmed-Najib-Biabani-Ibrahimkhel
 */
$messages['ps'] = array(
	'answer_title' => 'ځواب',
	'answered_by' => 'ځوابوونکی',
	'ask_a_question' => 'يوه پوښتنه پوښتل',
	'ask_a_question-widget' => 'يوه پوښتنه پوښتل...',
	'ask_button' => 'پوښتل',
	'new_question_comment' => 'نوې پوښتنه',
	'see_all_changes' => 'ټول بدلونونه کتل',
	'see_all' => 'ټول کتل',
	'categorize' => 'په وېشنيزې وېشل',
	'a' => 'ځواب:',
	'answers_skins' => 'ځوابونه',
	'answers-sky' => 'اسمان',
	'answers-forest' => 'ځنګل',
	'answers-carbon' => 'کاربون',
);

/** Portuguese (Português) */
$messages['pt'] = array(
	'research_this' => 'Investigar isto',
);

/** Brazilian Portuguese (Português do Brasil) */
$messages['pt-br'] = array(
	'research_this' => 'Pesquisar isto',
);

/** Tarandíne (Tarandíne) */
$messages['roa-tara'] = array(
	'research_this' => 'Cerche quiste',
);

/** Russian (Русский)
 * @author Eleferen
 * @author Kuzura
 * @author Lvova
 */
$messages['ru'] = array(
	'answer_title' => 'Ответ',
	'answered_by' => 'Ответил',
	'unregistered' => 'Аноним',
	'anonymous_edit_points' => '$1 {{PLURAL:$1|помощник|помощника|помощников}}',
	'edit_points' => '{{PLURAL:$1|очко редактирования|очка редактирования|очков редактирования}}',
	'ask_a_question' => 'Задать вопрос ...',
	'ask_a_question-widget' => 'Задать вопрос ...',
	'in_category' => '...в категории',
	'ask_button' => 'Спросить',
	'ask_thanks' => 'Спасибо за хороший вопрос!', // @todo maybe replace rockin'.....
	'question_asked_by' => 'Вопрос задал',
	'question_asked_by_anon' => 'Вопрос задал {{SITENAME}}',
	'new_question_comment' => 'новый вопрос',
	'answers_toolbox' => 'Инструменты Вики Ответов',
	'improve_this_answer' => 'Улучшить этот ответ',
	'answer_this_question' => 'Ответ на этот вопрос:',
	'notify_improved' => 'Отправить мне e-mail, когда ответ улучшится',
	'research_this' => 'Исследовать это',
	'notify_answered' => 'Послать мне e-mail, когда на вопрос ответят',
	'recent_asked_questions' => 'Свежие вопросы',
	'recent_answered_questions' => 'Свежие ответы',
	'recent_edited_questions' => 'Свежие правки в вопросах',
	'unanswered_category' => 'Вопросы без ответов',
	'answered_category' => 'Вопросы с ответами',
	'related_questions' => 'Вопросы, близкие по теме',
	'related_answered_questions' => 'Ответы, близкие по теме',
	'recent_unanswered_questions' => 'Свежие вопросы без ответов',
	'popular_categories' => 'Популярные категории',
	'createaccount-captcha' => 'Пожалуйста, введите слово ниже',
	'inline-register-title' => 'Уведомить меня, когда на мой вопрос ответят.',
	'inline-welcome' => 'Добро пожаловать на Вики Ответов',
	'skip_this' => 'Пропустить это',
	'see_all_changes' => 'Просмотреть все изменения',
	'toolbox_anon_message' => '<i>"Вики Ответов использует уникальные возможности вики, чтобы получить лучшие ответы на любые вопросы."</i>',
	'no_questions_found' => 'Вопросы не найдены',
	'next_page' => 'Далее &raquo;',
	'prev_page' => '&laquo; Предыд.',
	'see_all' => 'Просмотреть всё',
	#'widget_ask_box' => 'Включить окно для вопроса',
	'question_redirected_help_page' => 'Почему мой вопрос перенаправлен сюда',
	'twitter_ask' => 'Спросить на Твиттере',
	'facebook_ask' => 'Спросить на Facebook',
	'facebook_send_request' => 'Отправить друзьям',
	'ask_friends' => 'Попросить друзей помочь ответить:',
	'facebook_send_request_content' => 'Можете ли вы помочь ответить на этот вопрос? $1',
	'facebook_signed_in' => 'Вы вошли в Facebook Connect',
	'magic_answer_headline' => 'Это действительно ответ на ваш вопрос?',
	'magic_answer_yes' => 'Да, использовать его в качестве отправной точки',
	'magic_answer_no' => 'Нет, не нужно использовать это',
	'magic_answer_credit' => 'Предоставлено Yahoo Answers',
	'rephrase' => 'Перефразировать этот вопрос',
	'rephrase_this' => '<a href="$1" $2>Изменить формулировку вопроса</a>',
	'question_not_answered' => 'Этот вопрос по прежнему без ответа',
	'you_can' => 'Вы можете:',
	'answer_this' => '<a href="$1">Ответить на этот вопрос</a>, даже если вы не знаете полный ответ',
	'research_this_on_wikipedia' => '<a href="$1">Попытаться ответить на вопрос</a> с помощью Википедии',
	'receive_email' => '<a href="$1" $2>Получить e-mail</a>, когда на этот вопрос ответят',
	'ask_friends_on_twitter' => 'Спросить друзей в <a href="$1" $2>Твиттере</a>',
	'quick_action_panel' => 'Панель быстрого действия',
	'categorize' => 'Категоризировать',
	'categorize_help' => 'Одна категория в строке',
	'answers_widget_admin_note' => '<b>Администраторы:</b> Если вы хотите стать администратором <a href="http://answers.wikia.com" target="_blank">Вики Ответов</a>, <a href="http://answers.wikia.com/wiki/Wikianswers:Become_an_admin" target="_blank">нажмите здесь</a>.',
	'answers_widget_user_note' => 'Можете ли вы помочь, став <a href="http://answers.wikia.com/wiki/Wikianswers:Sign_up_for_a_category" target="_blank">редактором категорий</a> on <a href="http://answers.wikia.com" target="_blank">Вики ответов</a>?',
	'answers_widget_anon_note' => '<a href="http://answers.wikia.com" target="_blank">Вики Ответов</a> это Q&amp;A Вики, где ответы улучшаются с помощью платформы вики.',
	'answers-category-count-answered' => 'Эта категория содержит $1 {{PLURAL:$1|вопрос|вопроса|вопросов}} с ответами.',
	'answers-category-count-unanswered' => 'Эта категория содержит $1 {{PLURAL:$1|вопрос|вопроса|вопросов}} без ответов.',
	'answers_widget_no_questions' => '<a href="http://answers.wikia.com" target="_blank">Вики Ответов</a> - это сайт, где можно задавать вопросы и отвечать на вопросы других участников. Наша цель - создать лучший ответ на любой вопрос. <a href="http://answers.wikia.com/wiki/Special:Search" target="_blank">Найти вопросы</a> и ответить на <a href="http://answers.wikia.com/wiki/Category:Un-answered_questions">вопросы без ответов</a>. Это вики, поэтому правьте смело!',
	'answers_widget_no_questions_askabout' => '<br /><br />Начните, задав вопрос о "{{PAGENAME}}"',
	'reword_this' => '<a href="$1" $2>Переформулировать этот вопрос</a>',
	'no_related_answered_questions' => 'Есть ещё не связанные с этим вопросы. Получить <a href="http://answers.wikia.com/wiki/Special:Randomincategory/answered_questions">случайный ответ вместо этого</a>, или задать новый вопрос!<br />
	<div class="createbox" align="center">
	<p></p><form name="createbox" action="/index.php" method="get" class="createboxForm">
	<input name="action" value="create" type="hidden">
	<input name="prefix" value="Special:CreateQuestionPage/" type="hidden">
	<input name="editintro" value="" type="hidden">
	<input class="createboxInput" name="title" value="" size="50" type="text">
	<input name="create" class="createboxButton" value="Type your question and click here" type="submit"></form></div>',
	'auto_friend_request_body' => 'Вы добавите меня в друзья?',
	'tog-hidefromattribution' => 'Скрыть мой аватар и моё имя из списка атрибуции',
	'a' => 'Ответ:',
	'answering_tips' => '<h3>Советы для отвечающих:</h3> При ответах старайтесь быть настолько точными, насколько это возможно. Если вы используете информацию из других источников, например, Википедии, то обязательно поставьте ссылку. Благодарим вас за вклад в {{SITENAME}}!',
	'plus_x_more_helpers' => '... плюс $1 помощников',
	'anwb-step1-headline' => 'О чём будет ваша вики?',
	'anwb-step1-text' => 'Вашей Вики Ответов необходимо <strong>краткое название</strong>.<br /><br />Оно поможет пользователям найти ваш сайт в поисковых системах, поэтому постарайтесь как можно чётче определить, о чём будет ваша вики.',
	'anwb-step1-example' => 'Ответы на все ваши вопросы!',
	'anwb-choose-logo' => 'Выберите логотип',
	'anwb-step2-text' => 'Далее, выберете логотип для {{SITENAME}}. Лучше всего загрузить картинку, которая, как вы думаете, будет идеально представлять вашу Вики Ответов.<br />Вы можете пропустить этот шаг, если вы не хотите, делать это прямо сейчас.<br /><br />',
	'anwb-step2-example' => 'Это был бы хороший логотип для сайта с ответами по скейтбордингу.',
	'anwb-fp-headline' => 'Создайте несколько вопросов!',
	'anwb-fp-text' => 'Ваша Вики Ответов начнётся всего с нескольких вопросов!<br /><br />Добавьте вопросы, а затем ответьте на них самостоятельно. Очень важно, чтобы на сайте сразу было некоторое количество полезной информации, чтобы люди могли найти её, и в дальнейшем смогли сами сформулировать вопросы и отвечать на вопросы других пользователей.',
	'anwb-fp-example' => '<strong>Пример.</strong><br /><br />Для Вики Ответов по уходу за домашними животными:<br /><br /><ul><li>Какой корм лучше подходить котёнку?</li><li>Какая пород собак лучше?</li><li>Как лучше обучить кошку?</li><li></ul><br /><br />Для Вики Ответов по здравоохранению:<br /><br /><ul><li>Каковы преимущества здорового образа жизни?</li><li>Где найти хорошего врача в моём районе?</li><li>Как легче сбросить лишний вес?</li></ul>',
	'nwb-thatisall-headline' => 'Вот и всё - готово!',
	'anwb-thatisall-text' => 'Вот и всё - вы готовы к пути!<br /><br />Теперь пришло время написать как можно больше вопросов и ответов на них, чтобы ваш сайт можно было легко найти в поисковых системах.<br /><br />Добавление нескольких вопросов - это был последний шаг во введении к этой вики. Задавайте вопросы и отвечайте на них - создавайте собственное сообщество Вики Ответов!',
	'anwb-logo-preview' => 'Предварительный просмотр логотипа',
	'anwb-save-tagline' => 'Сохранить краткое название',
	'qa-toolbox-button' => 'Ответить на случайный вопрос',
	'qa-toolbox-share' => 'Поделиться',
	'qa-toolbox-tools' => 'Расширенные инструменты»',
	'qa-toolbox-protect' => 'Защитить этот вопрос',
	'qa-toolbox-delete' => 'Удалить этот вопрос',
	'qa-toolbox-history' => 'Предыдущие версии этой страницы',
	'answers_skins' => 'Ответы',
	'answers-bluebell' => 'Колокольчик',
	'answers-leaf' => 'Лист',
	'answers-carnation' => 'Гвоздика',
	'answers-sky' => 'Небо',
	'answers-spring' => 'Весна',
	'answers-forest' => 'Лес',
	'answers-moonlight' => 'Лунный свет',
	'answers-carbon' => 'Углерод',
	'answers-obsession' => 'Одержимость',
	'answers-custom' => 'Настройка',
);

/** Serbian (Cyrillic script) (‪Српски (ћирилица)‬)
 * @author Rancher
 */
$messages['sr-ec'] = array(
	'answer_title' => 'Одговор',
	'answered_by' => 'Одговорено од',
	'unregistered' => 'Нерегистровано',
	'anonymous_edit_points' => '$1 {{PLURAL:$1|помоћник|помоћника|помоћника}}',
	'q' => '<!-- -->',
	'header_questionmark_post' => '?',
);

/** Swedish (Svenska)
 * @author WikiPhoenix
 */
$messages['sv'] = array(
	'answer_title' => 'Svar',
	'answered_by' => 'Besvarad av',
	'unregistered' => 'Oregistrerad',
	'anonymous_edit_points' => '$1 {{PLURAL:$1|hjälpare|hjälpare}}',
	'edit_points' => '{{PLURAL:$1|redigeringspoäng|redigeringspoäng}}',
	'ask_a_question' => 'Ställ en fråga...',
	'ask_a_question-widget' => 'Ställ en fråga...',
	'in_category' => '...i kategorin',
	'ask_button' => 'Fråga',
	'ask_thanks' => 'Tack för den fantastiska frågan!', // @todo maybe replace rockin'.....
	'question_asked_by' => 'Fråga som ställts av',
	'question_asked_by_anon' => 'Fråga som ställts av en {{SITENAME}}-användare',
	'new_question_comment' => 'ny fråga',
	'answers_toolbox' => 'Wikianswers verktygslåda',
	'improve_this_answer' => 'Förbättra detta svar',
	'answer_this_question' => 'Svara på denna fråga:',
	'notify_improved' => 'Skicka e-post mig när det har förbättras',
	'research_this' => 'Undersök detta',
	'notify_answered' => 'Skicka e-post när det har besvarats',
	'recent_asked_questions' => 'Nyligen ställda frågor',
	'recent_answered_questions' => 'Nyligen besvarade frågor',
	'recent_edited_questions' => 'Nyligen redigerade frågor',
	'unanswered_category' => 'Obesvarade frågor',
	'answered_category' => 'Besvarade frågor',
	'related_questions' => 'Relaterade frågor',
	'related_answered_questions' => 'Relaterade besvarade frågor',
	'recent_unanswered_questions' => 'Nyligen obesvarade frågor',
	'popular_categories' => 'Populära kategorier',
	'createaccount-captcha' => 'Var god skriv in ordet nedan',
	'inline-register-title' => 'Meddela mig när min fråga har besvarats!',
	'inline-welcome' => 'Välkommen till Wikianswers',
	'skip_this' => 'Hoppa över detta',
	'see_all_changes' => 'Se alla ändringar',
	'toolbox_anon_message' => '<i>"Wikianswers utnyttjar de unika egenskaper av en wiki för att bilda de allra bästa svaren på varje fråga."</i>',
	'no_questions_found' => 'Inga frågor hittades',
	'next_page' => 'Nästa &raquo;',
	'prev_page' => '&laquo; Föreg.',
	'see_all' => 'Se alla',
	#'widget_ask_box' => 'Inkludera frågelåda',
	'question_redirected_help_page' => 'Varför blev min fråga omdirigerad hit',
	'twitter_ask' => 'Fråga på Twitter',
	'facebook_ask' => 'Fråga på Facebook',
	'facebook_send_request' => 'Skicka direkt till vänner',
	'ask_friends' => 'Be dina vänner hjälpa till att svara:',
	'facebook_send_request_content' => 'Kan du hjälpa till och svara på detta? $1',
	'facebook_signed_in' => 'Du är inloggad på Facebook Connect',
	'magic_answer_headline' => 'Besvarar detta din fråga?',
	'magic_answer_yes' => 'Ja, använda detta som utgångspunkt',
	'magic_answer_no' => 'Nej, använd inte detta',
	'magic_answer_credit' => 'Tillhandahålls av Yahoo Answers',
	'rephrase' => 'Omformulera denna fråga',
	'rephrase_this' => '<a href="$1" $2>Omformulera frågan</a>',
	'question_not_answered' => 'Denna fråga har inte besvarats',
	'you_can' => 'Du kan:',
	'answer_this' => '<a href="$1">Svara på denna fråga</a>, även om du inte vet hela svaret',
	'research_this_on_wikipedia' => '<a href="$1">Undersök denna fråga</a> på Wikipedia',
	'receive_email' => '<a href="$1" $2>Ta emot e-post</a> när denna fråga är besvarad',
	'ask_friends_on_twitter' => 'Fråga vänner på <a href="$1" $2>Twitter</a>',
	'quick_action_panel' => 'Snabb åtgärdspanel',
	'categorize' => 'Kategorisera',
	'categorize_help' => 'En kategori per rad',
	'answers_widget_admin_note' => '<b>Administratörer:</b> Om du skulle vilja bli en administratör på <a href="http://answers.wikia.com" target="_blank">Wikianswers</a>, <a href="http://answers.wikia.com/wiki/Wikianswers:Become_an_admin" target="_blank">klicka här</a>.',
	'answers_widget_user_note' => 'Kan du hjälpa till genom att bli en <a href="http://answers.wikia.com/wiki/Wikianswers:Sign_up_for_a_category" target="_blank">kategoriredigerare</a> på <a href="http://answers.wikia.com" target="_blank">Wikianswers</a>?',
	'answers_widget_anon_note' => '<a href="http://answers.wikia.com" target="_blank">Wikianswers</a> är en wiki för frågor-och-svar där svaren förbättras på wiki-vis.',
	'answers-category-count-answered' => 'Denna kategori innehåller $1 {{PLURAL:$1|besvarad fråga|besvarade frågor}}.',
	'answers-category-count-unanswered' => 'Denna kategori innehåller $1 {{PLURAL:$1|obesvarad fråga|obesvarade frågor}}.',
	'answers_widget_no_questions' => '<a href="http://answers.wikia.com" target="_blank">Wikianswers</a> är en webbplats där du kan ställa frågor och bidra med svar. Vi siktar mot att skapa det bästa svaret på någon fråga. <a href="http://answers.wikia.com/wiki/Special:Search" target="_blank">Hitta</a> och svara på<a href="http://answers.wikia.com/wiki/Category:Un-answered_questions">obesvarade</a> frågor. Det är en wiki - så vara djärv!',
	'answers_widget_no_questions_askabout' => '<br /><br />Komma igång med att ställa en fråga om "{{PAGENAME}}"',
	'reword_this' => '<a href="$1" $2>Omformulera frågan</a>',
	'no_related_answered_questions' => 'Det finns inga relaterade frågor ännu. Skaffa en <a href="http://answers.wikia.com/wiki/Special:Randomincategory/answered_questions">slumpmässig besvarad fråga istället</a>, eller ställ en ny fråga!<br />
	<div class="createbox" align="center">
	<p></p><form name="createbox" action="/index.php" method="get" class="createboxForm">
	<input name="action" value="create" type="hidden">
	<input name="prefix" value="Special:CreateQuestionPage/" type="hidden">
	<input name="editintro" value="" type="hidden">
	<input class="createboxInput" name="title" value="" size="50" type="text">
	<input name="create" class="createboxButton" value="Skriv in din fråga och klicka här" type="submit"></form></div>',
	'auto_friend_request_body' => 'Vill du lägga till mig som vän?',
	'tog-hidefromattribution' => 'Dölj min avatar och namn från attributionslistan',
	'a' => 'Svar:',
	'answering_tips' => '<h3>Tips för att besvara:</h3> När bidrar med ett svar, försök vara så exakt som möjligt. Om du hämtar information från en annan källa, som Wikipedia, lägg till en länk till sidan i texten. Och tack för att bidrar till {{SITENAME}}!',
	'plus_x_more_helpers' => '... plus $1 mer hjälpare',
	'anwb-step1-headline' => 'Vad handlar din wiki om?',
	'anwb-step1-text' => 'Din Wikianswers-sida behöver ett <strong>motto</strong>.<br /><br />Ditt motto kommer att hjälpa folk att hitta din sida från sökmotorer, så försök att vara tydlig med vad din sida handlar om.',
	'anwb-step1-example' => 'Svar på alla dina frågor om proffsbrottning!',
	'anwb-choose-logo' => 'Välj din logotyp',
	'anwb-step2-text' => 'Nästa steg väljer du en logotyp för {{SITENAME}}. Det är bäst att ladda upp en bild som du tror representerar din Svar-sida.<br />Du kan hoppa över det här steget om du inte vill göra det nu.<br /><br />',
	'anwb-step2-example' => 'Detta skulle vara en bra logotyp för en svarsida om skateboards.',
	'anwb-fp-headline' => 'Skapa några frågor!',
	'anwb-fp-text' => 'Din svarsida bör starta upp med några frågor!<br /><br />Lägg till en lista över frågor och ge svaren sedan själv. Det är viktigt att få användbar information på webbplatsen, så att folk kan hitta den, fråga och svara på fler frågor.',
	'anwb-fp-example' => '<strong>Example</strong><br /><br />För en svarsida om skötsel för husdjur:<br /><br /><ul><li>Bör jag köpa kattsand?</li><li>Vilken är den bästa hundrasen?</li><li>Vad är det bästa sättet att träna en katt?</li><li></ul><br /><br />För en svarsida om hälsa:<br /><br /><ul><li>Vilka är hälsofördelarna med motion?</li><li>Hur kan jag hitta en bra läkare där jag bor?</li><li>Hur kan jag gå ner i vikt på ett lätt sätt?</li></ul>',
	'nwb-thatisall-headline' => 'Det var det - du är klar!',
	'anwb-thatisall-text' => 'Det var det - du är redo att komma igång!<br /><br />Nu är det dags att börja skriva fler frågor och svar, så att webbplatsen lättare kan hittas i sökmotorerna.<br /><br />Listan över frågor som lagts till i det sista steget har lagts till i din frågesida. Gå och svara på dina frågor, och starta din egen svarsgemenskap!',
	'anwb-logo-preview' => 'Här är en förhandsvisning av din logotyp',
	'anwb-save-tagline' => 'Spara slagord',
	'qa-toolbox-button' => 'Svara på en slumpmässig fråga',
	'qa-toolbox-share' => 'Dela',
	'qa-toolbox-tools' => 'Avancerade verktyg»',
	'qa-toolbox-protect' => 'Skydda denna fråga',
	'qa-toolbox-delete' => 'Radera denna fråga',
	'qa-toolbox-history' => 'Tidigare versioner av denna sida',
	'answers_skins' => 'Svar',
	'answers-bluebell' => 'Blåklocka',
	'answers-leaf' => 'Löv',
	'answers-carnation' => 'Nejlika',
	'answers-sky' => 'Himmel',
	'answers-spring' => 'Vår',
	'answers-forest' => 'Skog',
	'answers-moonlight' => 'Månsken',
	'answers-carbon' => 'Karbon',
	'answers-obsession' => 'Besatthet',
	'answers-custom' => 'Anpassad',
);

/** Tamil (தமிழ்)
 * @author Shanmugamp7
 */
$messages['ta'] = array(
	'answer_title' => 'பதில்',
	'ask_button' => 'கேள்',
);

/** Telugu (తెలుగు)
 * @author Veeven
 */
$messages['te'] = array(
	'new_question_comment' => 'కొత్త ప్రశ్న',
	'width' => 'వెడల్పు',
	'answers-sky' => 'ఆకాశం',
	'answers-forest' => 'అడవి',
);

/** Tagalog (Tagalog) */
$messages['tl'] = array(
	'research_this' => 'Saliksikin ito',
);

/** Tatar (Cyrillic script) (Татарча)
 * @author Ajdar
 */
$messages['tt-cyrl'] = array(
	'answer_title' => 'Җавап',
);

/** Ukrainian (Українська) */
$messages['uk'] = array(
	'research_this' => 'Дослідити',
);

/** Veps (Vepsän kel')
 * @author Игорь Бродский
 */
$messages['vep'] = array(
	'answer_title' => 'Vastuz',
	'you_can' => 'Tö sat:',
	'categorize' => 'Kategoriziruida',
	'a' => 'Vastuz:',
	'answers-leaf' => 'Lehtez',
	'answers-sky' => 'Taivaz',
	'answers-spring' => "Keväz'",
	'answers-forest' => 'Mec',
	'answers-moonlight' => 'Kudmavauktuz',
);

/** Simplified Chinese (‪中文(简体)‬)
 * @author Anakmalaysia
 * @author Hzy980512
 */
$messages['zh-hans'] = array(
	'answer_title' => '回答',
	'answered_by' => '作答者',
	'unregistered' => '未注册',
	'ask_a_question' => '提出一个问题…',
	'ask_a_question-widget' => '提出一个问题…',
	'ask_button' => '问',
	'unanswered_category' => '未回答的问题',
	'answered_category' => '已回答的问题',
	'related_questions' => '有关问题',
	'related_answered_questions' => '有关回答过的问题',
	'recent_unanswered_questions' => '最近的未回答问题',
	'popular_categories' => '热点分类',
	'inline-welcome' => '欢迎来到Wikianswers',
	'skip_this' => '跳过它',
	'see_all_changes' => '查看所有更改',
	'next_page' => '下一页 &raquo;',
	'prev_page' => '&laquo; 上一页',
);
