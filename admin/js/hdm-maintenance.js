(function( $ ) {
	'use strict';
$(document).ready(function(){
	//counter
	$( '#wpuf-general_tab_hdm_count_active_' ).click(function(){
			$( '#datetimepicker' ).closest( 'tr' ).show();
			$( '#general_tab_hdm_counter_color_' ).closest( 'tr' ).show();	
	});
	$( '#wpuf-general_tab_hdm_count_deactive_').click(function(){
			$( '#datetimepicker' ).closest( 'tr' ).hide();
			$( '#general_tab_hdm_counter_color_' ).closest( 'tr' ).hide();	
	});
	// if active counter
	var ss = $('#wpuf-general_tab_hdm_count_active_').prop( 'checked' );
	if ( ss == true ){
			$( '#datetimepicker' ).closest( 'tr' ).show();
			$( '#general_tab_hdm_counter_color_' ).closest( 'tr' ).show();
	}else{
			$( '#datetimepicker' ).closest( 'tr' ).hide();
			$( '#general_tab_hdm_counter_color_' ).closest( 'tr' ).hide();
	};

	// background selection
	$( '#design_tab_hdm_bg_select_' ).on( 'change',function(){
		if ( this.value == 'color'){
			$( '#design_tab_hdm_bg_').closest('tr').hide();
			$('#design_tab_hdm_bg_webm_').closest('tr').hide();
			$('#design_tab_hdm_bg_mp4_').closest('tr').hide();
			$( '#design_tab_hdm_bg_video_' ).closest('tr').hide();
			$( '#design_tab_hdm_bg_color_' ).closest('tr').show();
			$( '#wpuf-design_tab_hdm_bg_option_stretch_' ).closest('tr').hide();
		};
		if ( this.value == 'image'){
			$( '#design_tab_hdm_bg_color_' ).closest('tr').hide();
			$( '#design_tab_hdm_bg_video_' ).closest('tr').hide();
			$( '#design_tab_hdm_bg_webm_' ).closest('tr').hide();
			$( '#design_tab_hdm_bg_mp4_' ).closest('tr').hide();
			$( '#design_tab_hdm_bg_' ).closest('tr').show();
			$( '#wpuf-design_tab_hdm_bg_option_stretch_' ).closest('tr').show();
		};
		if ( this.value == 'video' ) {
			$('#design_tab_hdm_bg_webm_').closest('tr').show();
			$('#design_tab_hdm_bg_mp4_').closest('tr').show();
			$( '#design_tab_hdm_bg_video_' ).closest('tr').show();
			$( '#design_tab_hdm_bg_').closest('tr').hide();
			$( '#design_tab_hdm_bg_color_' ).closest('tr').hide();
			$( '#wpuf-design_tab_hdm_bg_option_stretch_' ).closest('tr').hide();
		};
	});
	
	// background recgnazation
	var sr = $( '#design_tab_hdm_bg_select_ option:selected' ).text();
	if ( sr  == 'Color' ){
		$('#design_tab_hdm_bg_color_').closest('tr').show();
		$('#design_tab_hdm_bg_').closest('tr').hide();
		$( '#design_tab_hdm_bg_video_' ).closest('tr').hide();
		$('#design_tab_hdm_bg_webm_').closest('tr').hide();
		$('#design_tab_hdm_bg_mp4_').closest('tr').hide();
		$( '#wpuf-design_tab_hdm_bg_option_stretch_' ).closest('tr').hide();
	}else if ( sr == 'User Image' ){
		$('#design_tab_hdm_bg_').closest('tr').show();
		$( '#wpuf-design_tab_hdm_bg_option_stretch_' ).closest('tr').show();
		$('#design_tab_hdm_bg_color_').closest('tr').hide();
		$( '#design_tab_hdm_bg_video_' ).closest('tr').hide();
		$('#design_tab_hdm_bg_webm_').closest('tr').hide();
		$('#design_tab_hdm_bg_mp4_').closest('tr').hide();
	 }else{
	 	$('#design_tab_hdm_bg_').closest('tr').hide();
	 	$( '#wpuf-design_tab_hdm_bg_option_stretch_' ).closest('tr').hide();
		$('#design_tab_hdm_bg_color_').closest('tr').hide();
		$('#design_tab_hdm_bg_webm_').closest('tr').show();
		$('#design_tab_hdm_bg_mp4_').closest('tr').show();
		$('#design_tab_hdm_bg_video_').closest('tr').show();
	 };


	//contact form
	$( '#wpuf-com_tab_hdm_contact_active_Active_' ).click(function(){
		$( '#com_tab_hdm_contact_email_' ).closest( 'tr' ).show();
	});
	$( '#wpuf-com_tab_hdm_contact_active_Deactive_').click(function(){
		$( '#com_tab_hdm_contact_email_' ).closest( 'tr' ).hide();
	});
	// if active contact form
	var cf = $('#wpuf-com_tab_hdm_contact_active_Active_').prop( 'checked' );
	if ( cf == true ){
		$( '#com_tab_hdm_contact_email_' ).closest( 'tr' ).show();
	}else{
		$( '#com_tab_hdm_contact_email_' ).closest( 'tr' ).hide();
	};

	//newsletter
	$( '#wpuf-com_tab_hdm_newsle_active_active_' ).on('click',function(){
		$( '#com_tab_hdm_news_select_' ).closest( 'tr' ).show();
		var fb = $( '#com_tab_hdm_news_select_ option:selected' ).text();
		if ( fb  == 'FeedBurner' ){
			$('#com_tab_hdm_sub_feed_').closest('tr').show();
			$('#com_tab_hdm_sub_feed_btn_').closest('tr').show();
			$('#com_tab_hdm_sub_feed_txt_').closest('tr').show();
			$('#com_tab_hdm_chimp_api_').closest('tr').hide();
			$('#com_tab_hdm_chimp_list_').closest('tr').hide();
		}else{
			$('#com_tab_hdm_sub_feed_btn_').closest('tr').show();
			$('#com_tab_hdm_sub_feed_txt_').closest('tr').show();
			$('#com_tab_hdm_chimp_api_').closest('tr').show();
			$('#com_tab_hdm_chimp_list_').closest('tr').show();
			$('#com_tab_hdm_sub_feed_').closest('tr').hide();
		 };

	});
	$( '#wpuf-com_tab_hdm_newsle_active_deactive_').click(function(){
			$( '#com_tab_hdm_news_select_' ).closest( 'tr' ).hide();
			$('#com_tab_hdm_sub_feed_').closest('tr').hide();
			$('#com_tab_hdm_sub_feed_btn_').closest('tr').hide();
			$('#com_tab_hdm_sub_feed_txt_').closest('tr').hide();
			$('#com_tab_hdm_chimp_api_').closest('tr').hide();
			$('#com_tab_hdm_chimp_list_').closest('tr').hide();
			$('#com_tab_hdm_chimp_api_').closest('tr').hide();
			$('#com_tab_hdm_chimp_list_').closest('tr').hide();
			$('#com_tab_hdm_sub_feed_').closest('tr').hide();
	});
	//feed burner or mailchimp on select
	$( '#com_tab_hdm_news_select_' ).on('change',function(){
		if ( this.value == 'FeedBurner' ){
			$('#com_tab_hdm_sub_feed_').closest('tr').show();
			$('#com_tab_hdm_sub_feed_btn_').closest('tr').show();
			$('#com_tab_hdm_sub_feed_txt_').closest('tr').show();
			$('#com_tab_hdm_chimp_api_').closest('tr').hide();
			$('#com_tab_hdm_chimp_list_').closest('tr').hide();
		};
		if ( this.value == 'mailchimp' ){
			$('#com_tab_hdm_chimp_api_').closest('tr').show();
			$('#com_tab_hdm_chimp_list_').closest('tr').show();
			$('#com_tab_hdm_sub_feed_').closest('tr').hide();
		};
	});
	var nde = $('#wpuf-com_tab_hdm_newsle_active_deactive_').prop( 'checked' );
	if ( nde == true ){
			$( '#com_tab_hdm_news_select_' ).closest( 'tr' ).hide();
			$('#com_tab_hdm_sub_feed_').closest('tr').hide();
			$('#com_tab_hdm_sub_feed_btn_').closest('tr').hide();
			$('#com_tab_hdm_sub_feed_txt_').closest('tr').hide();
			$('#com_tab_hdm_chimp_api_').closest('tr').hide();
			$('#com_tab_hdm_chimp_list_').closest('tr').hide();
			$('#com_tab_hdm_chimp_api_').closest('tr').hide();
			$('#com_tab_hdm_chimp_list_').closest('tr').hide();
			$('#com_tab_hdm_sub_feed_').closest('tr').hide();
	};
	var aact = $('#wpuf-com_tab_hdm_newsle_active_active_').prop( 'checked' );
	if ( aact == true ){
		var act = $( '#com_tab_hdm_news_select_ option:selected' ).text();
		if ( act  == 'FeedBurner' ){
			$('#com_tab_hdm_sub_feed_').closest('tr').show();
			$('#com_tab_hdm_sub_feed_btn_').closest('tr').show();
			$('#com_tab_hdm_sub_feed_txt_').closest('tr').show();
			$('#com_tab_hdm_chimp_api_').closest('tr').hide();
			$('#com_tab_hdm_chimp_list_').closest('tr').hide();
		}else{
			$('#com_tab_hdm_sub_feed_btn_').closest('tr').show();
			$('#com_tab_hdm_sub_feed_txt_').closest('tr').show();
			$('#com_tab_hdm_chimp_api_').closest('tr').show();
			$('#com_tab_hdm_chimp_list_').closest('tr').show();
			$('#com_tab_hdm_sub_feed_').closest('tr').hide();
		 };
	};


	//Social 
	//active
	$( '#wpuf-com_tab_hdm_social_active_' ).on( 'click',function(){
		$('#com_tab_hdm_social_fa_').closest('tr').show();
		$('#com_tab_hdm_social_tw_').closest('tr').show();
		$('#com_tab_hdm_social_in_').closest('tr').show();
		$('#com_tab_hdm_social_yo_').closest('tr').show();
		$('#com_tab_hdm_social_g_' ).closest('tr').show();
		$('#com_tab_hdm_social_pi_').closest('tr').show();
		$('#com_tab_hdm_social_li_').closest('tr').show();
		$('#com_tab_hdm_social_dr_').closest('tr').show();
		$('#com_tab_hdm_social_gi_').closest('tr').show();
		$('#com_tab_hdm_so_color_' ).closest('tr').show();
	});

	//diactive
	$( '#wpuf-com_tab_hdm_social_Deactive_' ).on( 'click',function(){
		$('#com_tab_hdm_social_fa_').closest('tr').hide();
		$('#com_tab_hdm_social_tw_').closest('tr').hide();
		$('#com_tab_hdm_social_in_').closest('tr').hide();
		$('#com_tab_hdm_social_yo_').closest('tr').hide();
		$('#com_tab_hdm_social_g_' ).closest('tr').hide();
		$('#com_tab_hdm_social_pi_').closest('tr').hide();
		$('#com_tab_hdm_social_li_').closest('tr').hide();
		$('#com_tab_hdm_social_dr_').closest('tr').hide();
		$('#com_tab_hdm_social_gi_').closest('tr').hide();
		$('#com_tab_hdm_so_color_' ).closest('tr').hide();
	});

	//if activate
	var so = $('#wpuf-com_tab_hdm_social_active_').prop( 'checked' );
	if ( so == true ){
		$('#com_tab_hdm_social_fa_').closest('tr').show();
		$('#com_tab_hdm_social_tw_').closest('tr').show();
		$('#com_tab_hdm_social_in_').closest('tr').show();
		$('#com_tab_hdm_social_yo_').closest('tr').show();
		$('#com_tab_hdm_social_g_' ).closest('tr').show();
		$('#com_tab_hdm_social_pi_').closest('tr').show();
		$('#com_tab_hdm_social_li_').closest('tr').show();
		$('#com_tab_hdm_social_dr_').closest('tr').show();
		$('#com_tab_hdm_social_gi_').closest('tr').show();
		$('#com_tab_hdm_so_color_' ).closest('tr').show();
	}else{
		$('#com_tab_hdm_social_fa_').closest('tr').hide();
		$('#com_tab_hdm_social_tw_').closest('tr').hide();
		$('#com_tab_hdm_social_in_').closest('tr').hide();
		$('#com_tab_hdm_social_yo_').closest('tr').hide();
		$('#com_tab_hdm_social_g_' ).closest('tr').hide();
		$('#com_tab_hdm_social_pi_').closest('tr').hide();
		$('#com_tab_hdm_social_li_').closest('tr').hide();
		$('#com_tab_hdm_social_dr_').closest('tr').hide();
		$('#com_tab_hdm_social_gi_').closest('tr').hide();
		$('#com_tab_hdm_so_color_' ).closest('tr').hide();
	};

});
})( jQuery );
