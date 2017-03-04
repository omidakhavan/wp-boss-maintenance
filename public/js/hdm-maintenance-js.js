/**
 * @link              http://omidakhavan.ir
 * @since             1.0.0
 * @package           boss-maintenance
 *
 * */

 (function( $ ) {
 	'use strict';

$.fn.bossCountdown = function(options, callBack)
{
        // Default Options
        var settings = $.extend(
        {
            // These are the defaults.
            date: null,
            format: null
        }, options);

        var callback = callBack;
        var selector = $(this);
        
        startCountdown();
        var interval = setInterval(startCountdown, 1000);
        
        function startCountdown()
        {
        	var eventDate = Date.parse(settings.date) / 1000;
        	var currentDate = Math.floor($.now() / 1000);

        	if(eventDate <= currentDate)
        	{
        		callback.call(this);
        		clearInterval(interval);
        	}

        	var seconds = eventDate - currentDate;

        	var days = Math.floor(seconds / (60 * 60 * 24)); 
        	seconds -= days * 60 * 60 * 24; 

        	var hours = Math.floor(seconds / (60 * 60));
        	seconds -= hours * 60 * 60; 

        	var minutes = Math.floor(seconds / 60);
        	seconds -= minutes * 60;

        	if(days == 1) selector.find(".timeRefDays").text(hdm.day);
        	else selector.find(".timeRefDays").text(hdm.days);

        	if(hours == 1) selector.find(".timeRefHours").text(hdm.hour);
        	else selector.find(".timeRefHours").text(hdm.hours);

        	if(minutes == 1) selector.find(".timeRefMinutes").text(hdm.minute);
        	else selector.find(".timeRefMinutes").text(hdm.minutes);

        	if(seconds == 1) selector.find(".timeRefSeconds").text(hdm.second);
        	else selector.find(".timeRefSeconds").text(hdm.seconds);

        	if(settings.format === "on")
        	{
        		days = (String(days).length >= 2) ? days : "0" + days;
        		hours = (String(hours).length >= 2) ? hours : "0" + hours;
        		minutes = (String(minutes).length >= 2) ? minutes : "0" + minutes;
        		seconds = (String(seconds).length >= 2) ? seconds : "0" + seconds;
        	}

        	if(!isNaN(eventDate))
        	{
        		selector.find(".days").text(days);
        		selector.find(".hours").text(hours);
        		selector.find(".minutes").text(minutes);
        		selector.find(".seconds").text(seconds);
        	}
        	else
        	{
        		clearInterval(interval);
        	}
        }
    };

	$(document).ready(function() {
		$("#countdown").bossCountdown({
			date: hdm.hdm_date , 
			format: "off" 
		},
		function() { 
		});
	});


})( jQuery );


