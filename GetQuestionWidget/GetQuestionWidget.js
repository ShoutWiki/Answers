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
	var width = document.getElementById( 'widget_width' ).value;
	if ( document.getElementById( 'askbox' ).checked ) {
		ask_box = '<input type="text" value="' + wfMsg( 'ask_a_question' ) + '" id="ask" style="width:' +
			( width - 50 ) +
			'px" onfocus="this.value=\'\'"> <input type="button" value="' +
				wfMsg( 'ask_button' ) + '" onclick="javascript:ask_question()"><scr' +
					'ipt>function ask_question(){window.location=\'' +
					wgServer + wgScriptPath + '/index.php?title=Special:CreateQuestionPage&questiontitle=' +
					document.getElementById( 'ask' ).value + '&categories=' + ask_category + '\'}</scr' + 'ipt>';
	}
	var preview = '<scr' + 'ipt>answers_background_color = "' +
		document.getElementById( 'backgroundcolor' ).value + '\";answers_width = "' +
			width + '";answers_border = "1px solid #000000";answers_link_color = "' +
			document.getElementById( 'linkcolor' ).value + '";</scr' + 'ipt><scr' + 'ipt type="text/javascript" src="' +
			wgServer + wgScript + '?action=ajax&rs=wfGetQuestionsWidget&rsargs[]=' +
			document.getElementById( 'widget_title' ).value + '&rsargs[]=' + category +
			'&rsargs[]=' + document.getElementById( 'number' ).value + '&rsargs[]=' +
			document.getElementById( 'order' ).value + '"></scri' + 'pt><noscript><a href="' +
			wgServer + '">' + wgSitename + '</a></noscript>';

	doc.open();
	doc.write( ask_box + preview );
	doc.close();

	if ( !window.opera && !document.mimeType && document.all && document.getElementById ) {
		i.style.height = ( 185 + ( document.getElementById( 'number' ).value * 55 ) ) + 'px';
	} else if( document.getElementById ) {
		i.style.height = ( 185 + ( document.getElementById( 'number' ).value * 55 ) ) + 'px';
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