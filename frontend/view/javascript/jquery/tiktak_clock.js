/*
*
* @author Roman Solomud
* @version 0.1.0
*
* All rights resenved 
* Intelectual property of Roman Solomud
* In public use this comment is required!
*
*/
(function($, undefined) {
	$.tiktak = { version: "0.1.0", locales: {}, showDateTypes: {}, timeFormats: {} }
	$.fn.tiktak = function(options) {
		// Default options
		$.tiktak.defaults = {
			"selectors": {
				"day": "#jj-day",
				"dayNumb": "#jj-day-numb",
				"month": "#jj-month",
				"year": "#jj-year",
				"hours": "#jj-hour",
				"minutes": "#jj-minute",
				"seconds": "#jj-second"
			},
			"locale": "ua",
			"dateFormat": "digital",
			"timeFormat": "12"
		};
		// Locales
		$.tiktak.locales = {
			"ua": {
				"months": ["Січень", "Лютий", "Березень", "Квітень", "Травень", "Червень", "Липень", "Серпень", "Вересень", "Жовень", "Листопад", "Грудень"],
				"days": ["Неділя", "Понеділок", "Вівторок", "Середа", "Четвер", "П'ятниця", "Субота"]
			}
		};
		// Show date types
		$.tiktak.showDateTypes = {
			"digital": function(selectors){
				var day = newDate.getDate();
				var month = newDate.getMonth() + 1;
				$(selectors.day).text(((day < 10) ? '0' : '') + day);
				$(selectors.month).text(((month < 10) ? '0' : '') + month);
				$(selectors.year).text(newDate.getFullYear());
			},
			"symbol": function(selectors){
				// alert(locales);
				$(selectors.day).text(locales[opts.locale].days[newDate.getDay()]);
				$(selectors.dayNumb).text(newDate.getDate());
				$(selectors.month).text(locales[opts.locale].months[newDate.getMonth()]);
				$(selectors.year).text(newDate.getFullYear());
			}
		};
		// Show time formats
		$.tiktak.timeFormats = {
			"12": function(selector){
				ap = "AM ";
				if(hours > 12) { hours = hours - 12; }
				if(hours == 0) { hours = 12; }
				if(hours > 11) { ap = "PM "; }
				$(selector).text(ap + (hours < 10 ? "0" : "") + hours);
			},
			"24": function(selector){
				$(selector).text((hours < 10 ? "0" : "") + hours);
			}
		};
		var defaults = $.extend({}, $.tiktak.defaults, options);
		var opts = $.extend({}, defaults, options);
		var locales = $.tiktak.locales
		var timeFormats = $.tiktak.timeFormats;
		var showDateTypes = $.tiktak.showDateTypes;
		// Plugin's body
		var newDate = new Date();
		var hours = new Date().getHours();
		$(function(){
			var locales = $.tiktak.locales;
			newDate.setDate(newDate.getDate());
			showDateTypes[opts.dateFormat](opts.selectors);
			setInterval(function(){
				var seconds = new Date().getSeconds();
				$(opts.selectors.seconds).text((seconds < 10 ? "0" : "" ) + seconds);
				var minutes = new Date().getMinutes();
				$(opts.selectors.minutes).text((minutes < 10 ? "0" : "") + minutes);
				timeFormats[opts.timeFormat](opts.selectors.hours);
			}, 1000);
		});
	};
})(jQuery);
