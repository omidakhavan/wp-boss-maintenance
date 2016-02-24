(function( $ ) {
	'use strict';
$(document).ready(function(){
			$( '#design_tab_avma_bg_').closest('tr').hide();
			$('#com_tab_avma_chimp_api_').closest('tr').hide();
			$('#com_tab_avma_chimp_list_').closest('tr').hide();
	$( '#wpuf-general_tab_avma_count_active_' ).live('change',function(){
		if ( '#wpuf-general_tab_avma_count_active_'.value == 'active' ){
				$( 'datetimepicker' ).closest( 'tr' ).show();
				console.log('asdasd');
				$( 'general_tab_avma_counter_color_' ).closest( 'tr' ).show();	
		}else{
					$( 'datetimepicker' ).closest( 'tr' ).hide();
		$( 'general_tab_avma_counter_color_' ).closest( 'tr' ).hide();
		}
	});	
	$( 'input#wpuf-wpuf-general_tab_avma_count_deactive_.radio' ).change(function(){
	
	});			
	if ( '#com_tab_avma_news_select_'.value == 'FeedBurner' ){
			$('#com_tab_avma_sub_feed_').closest('tr').show();
			$('#com_tab_avma_sub_feed_btn_').closest('tr').show();
			$('#com_tab_avma_sub_feed_txt_').closest('tr').show();
			$('#com_tab_avma_chimp_api_').closest('tr').hide();
			$('#com_tab_avma_chimp_list_').closest('tr').hide();
	};
	$( '#com_tab_avma_news_select_' ).on('change',function(){
		if ( this.value == 'FeedBurner' ){
			$('#com_tab_avma_sub_feed_').closest('tr').show();
			$('#com_tab_avma_sub_feed_btn_').closest('tr').show();
			$('#com_tab_avma_sub_feed_txt_').closest('tr').show();
			$('#com_tab_avma_chimp_api_').closest('tr').hide();
			$('#com_tab_avma_chimp_list_').closest('tr').hide();
		};
		if ( this.value == 'mailchimp' ){
			$('#com_tab_avma_chimp_api_').closest('tr').show();
			$('#com_tab_avma_chimp_list_').closest('tr').show();
			$('#com_tab_avma_sub_feed_').closest('tr').hide();
		};
	});

	$( '#design_tab_avma_bg_select_' ).on( 'change',function(){
		if ( this.value == 'color'){
			$( '#design_tab_avma_bg_').closest('tr').hide();
			$( '#design_tab_avma_bg_color_' ).closest('tr').show();
		};
		if ( this.value == 'image'){
			$( '#design_tab_avma_bg_color_' ).closest('tr').hide();
			$( '#design_tab_avma_bg_').closest('tr').show();
		};
	});

});
})( jQuery );
