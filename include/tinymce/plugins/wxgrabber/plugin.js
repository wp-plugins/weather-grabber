(function() {
	tinymce.PluginManager.add('wxgrabber', function(editor, url) {
		editor.addCommand('WXGrabber-Insert_Value', function() {
			var poll_id = jQuery.trim(prompt(pollsEdL10n.enter_poll_id));
			while(isNaN(poll_id)) {
				poll_id = jQuery.trim(prompt(pollsEdL10n.error_poll_id_numeric + "\n\n" + pollsEdL10n.enter_poll_id_again));
			}
			if (poll_id >= -1 && poll_id != null && poll_id != "") {
				editor.insertContent('[wxgrabber="' + poll_id + '"]');
			}
		});
		editor.addButton('values', {
			text: false,
			tooltip: wxgrabberEdL10n.insert_poll,
			icon: 'wxgrabber dashicons-before dashicons-chart-bar',
			onclick: function() {
				tinyMCE.activeEditor.execCommand( 'WXGrabber-Insert_Value' )
			}
		});
	});
})();