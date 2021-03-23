/**
 *
 *
 * @author Josh Lobe
 * http://ultimatetinymcepro.com
 */
 
jQuery(document).ready(function($) {


	tinymce.PluginManager.add('youTube', function(editor, url) {
		
		
		editor.addButton('youTube', {
			
			image: url + '/images/youtube.png',
			tooltip: 'Vidéo YOUTUBE',
			onclick: open_youTube
		});
		
		function open_youTube() {
			
			editor.windowManager.open({
					
				title: 'Choisir une vidéo YOUTUBE',
				width: 800,
				height: 500,
				url: url+'/youTube.php'
			})
		}
		
	});
});