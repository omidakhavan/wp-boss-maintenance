(function( $ ) {
	'use strict';
$(document).ready(function(){
	$('#com_tab_avma_content_feed_').closest('tr').hide();
	$( "#com_tab_avma_news_select_" ).on('change',function(){
		if ( this.value == 'FeedBurner' ){
			$('#com_tab_avma_content_feed_').closest('tr').show();
		};
	});
});
})( jQuery );
