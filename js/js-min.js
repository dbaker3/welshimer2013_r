jQuery(document).ready(function(){

//**************** matchMedia() polyfill *****************//

window.matchMedia = window.matchMedia || (function(doc, undefined){

  var bool,
      docElem  = doc.documentElement,
      refNode  = docElem.firstElementChild || docElem.firstChild,
      // fakeBody required for <FF4 when executed in <head>
      fakeBody = doc.createElement('body'),
      div      = doc.createElement('div');

  div.id = 'mq-test-1';
  div.style.cssText = "position:absolute;top:-100em";
  fakeBody.style.background = "none";
  fakeBody.appendChild(div);

  return function(q){

    div.innerHTML = '&shy;<style media="'+q+'"> #mq-test-1 { width: 42px; }</style>';

    docElem.insertBefore(fakeBody, refNode);
    bool = div.offsetWidth === 42;
    docElem.removeChild(fakeBody);

    return { matches: bool, media: q };
  };

}(document));

// ************** Adaptive Menu Scripts****************//
	var tabletWidth = '600px';
	var desktopWidth = '800px';
	var tablet = matchMedia('(min-width:' + tabletWidth + ')');
	var desktop = matchMedia('(min-width:' + desktopWidth + ')');
	var device = getDeviceSize();

adapt(device); //Do first adapt on load
	
	// On document Resize for Expanding sidebar
	jQuery( window ).resize( function() {
		if (device !== getDeviceSize()) { //if window crosses MQ
			//console.log("Device change");
			device = getDeviceSize();
			adapt(device);
		}
	});

	jQuery( '#menu-toggle' ).click( function() {
		if (device !== 'desktop') {
		jQuery( '.main-navigation' ).toggleClass('display-toggle');
		jQuery( '.sub-menu' ).removeClass('display-toggle');
		jQuery( '.menu-item' ).removeClass('open-item');
    jQuery("html").scrollTop(0);
		}
	});

	jQuery( '.parent' ).click( function() {
		if (device !== 'desktop' ) {
			jQuery( this ).children('.sub-menu').toggleClass('display-toggle');
			jQuery ( this ).toggleClass('open-item');
		}
	});

	jQuery(".side-expand").click(function(){
		if (device !== 'desktop') {
			jQuery('.widget-area').toggleClass('side-expand-open', 300);
		}
	});

	jQuery( '#eds-more-toggle' ).click( function() {
		jQuery( '#eds-more' ).toggleClass('eds-more-open');
		jQuery( this ).toggleClass('eds-more-toggle-open');
	});

jQuery('.acc-sublist').toggleClass('hidden'); //For Onload // dbaker 8-28-14 changed addClass method on this line to toggleClass method.
                                                           // This will initially hide sublists on page load so my tabbed searchbox plugin will unhide 

jQuery( '.acc-list-category' ).click( function() {
		jQuery( this ).parent().children('.acc-sublist').toggleClass('hidden');
		jQuery( this ).parent().toggleClass('open-item');
	});

function getDeviceSize(){
	tablet = matchMedia('(min-width:' + tabletWidth + ')');
	desktop = matchMedia('(min-width:' + desktopWidth + ')');
	if (desktop.matches === true) {
		return 'desktop';
		} else if (tablet.matches === true) {
		return 'tablet';
		} else {
		return 'mobile';
		}
	}

function adapt(deviceVar){ //console.log(deviceVar);
	if (deviceVar !== 'desktop'){
		jQuery('#menu-navigation').addClass('display-toggle');
	} else {
		jQuery('.display-toggle').removeClass('display-toggle');
		//jQuery('.open-item').removeClass('open-item');            // dbaker 10-2-14 commented so that my tabbed searchbox would display minus when jumping to topic.
		jQuery('.side-expand-open').removeClass('side-expand-open')
	}
}
//************* SELECT MENU SCRIPTS ******************//

	jQuery(".secondary-menu-main a").each(function() {
	 var el = jQuery(this);
	 jQuery("<option />", {
	     "value"   : el.attr("href"),
	     "text"    : el.text()
	 }).appendTo(".secondary-menu-select select");
	});

	jQuery(".secondary-menu-select select").change(function() {
	  window.location = jQuery(this).find("option:selected").val();
	});

  //******************Relative dates***********************//

  jQuery('a.timestamp').timeago()

  });

//********************Chat Service JS*********************//
  (function() {
    var x = document.createElement("script"); x.type = "text/javascript"; x.async = true;
    x.src = (document.location.protocol === "https:" ? "https://" : "http://") + "libraryh3lp.com/js/libraryh3lp.js?3752";
    var y = document.getElementsByTagName("script")[0]; y.parentNode.insertBefore(x, y);
  })();


/**
 * Timeago is a jQuery plugin that makes it easy to support automatically
 * updating fuzzy timestamps (e.g. "4 minutes ago" or "about 1 day ago").
 *
 * @name timeago
 * @version 0.11.4
 * @requires jQuery v1.2.3+
 * @author Ryan McGeary
 * @license MIT License - http://www.opensource.org/licenses/mit-license.php
 *
 * For usage and examples, visit:
 * http://timeago.yarp.com/
 *
 * Copyright (c) 2008-2012, Ryan McGeary (ryan -[at]- mcgeary [*dot*] org)
 */
(function($) {
  $.timeago = function(timestamp) {
    if (timestamp instanceof Date) {
      return inWords(timestamp);
    } else if (typeof timestamp === "string") {
      return inWords($.timeago.parse(timestamp));
    } else if (typeof timestamp === "number") {
      return inWords(new Date(timestamp));
    } else {
      return inWords($.timeago.datetime(timestamp));
    }
  };
  var $t = $.timeago;

  $.extend($.timeago, {
    settings: {
      refreshMillis: 60000,
      allowFuture: false,
      strings: {
        prefixAgo: null,
        prefixFromNow: null,
        suffixAgo: "ago",
        suffixFromNow: "from now",
        seconds: "less than a minute",
        minute: "about a minute",
        minutes: "%d minutes",
        hour: "about an hour",
        hours: "%d hours",
        day: "a day",
        days: "%d days",
        month: "a month",
        months: "%d months",
        year: "a year",
        years: "%d years",
        wordSeparator: " ",
        numbers: []
      }
    },
    inWords: function(distanceMillis) {
      var $l = this.settings.strings;
      var prefix = $l.prefixAgo;
      var suffix = $l.suffixAgo;
      if (this.settings.allowFuture) {
        if (distanceMillis < 0) {
          prefix = $l.prefixFromNow;
          suffix = $l.suffixFromNow;
        }
      }

      var seconds = Math.abs(distanceMillis) / 1000;
      var minutes = seconds / 60;
      var hours = minutes / 60;
      var days = hours / 24;
      var years = days / 365;

      function substitute(stringOrFunction, number) {
        var string = $.isFunction(stringOrFunction) ? stringOrFunction(number, distanceMillis) : stringOrFunction;
        var value = ($l.numbers && $l.numbers[number]) || number;
        return string.replace(/%d/i, value);
      }

      var words = seconds < 45 && substitute($l.seconds, Math.round(seconds)) ||
        seconds < 90 && substitute($l.minute, 1) ||
        minutes < 45 && substitute($l.minutes, Math.round(minutes)) ||
        minutes < 90 && substitute($l.hour, 1) ||
        hours < 24 && substitute($l.hours, Math.round(hours)) ||
        hours < 42 && substitute($l.day, 1) ||
        days < 30 && substitute($l.days, Math.round(days)) ||
        days < 45 && substitute($l.month, 1) ||
        days < 365 && substitute($l.months, Math.round(days / 30)) ||
        years < 1.5 && substitute($l.year, 1) ||
        substitute($l.years, Math.round(years));

      var separator = $l.wordSeparator === undefined ?  " " : $l.wordSeparator;
      return $.trim([prefix, words, suffix].join(separator));
    },
    parse: function(iso8601) {
      var s = $.trim(iso8601);
      s = s.replace(/\.\d+/,""); // remove milliseconds
      s = s.replace(/-/,"/").replace(/-/,"/");
      s = s.replace(/T/," ").replace(/Z/," UTC");
      s = s.replace(/([\+\-]\d\d)\:?(\d\d)/," $1$2"); // -04:00 -> -0400
      return new Date(s);
    },
    datetime: function(elem) {
      var iso8601 = $t.isTime(elem) ? $(elem).attr("datetime") : $(elem).attr("title");
      return $t.parse(iso8601);
    },
    isTime: function(elem) {
      // jQuery's `is()` doesn't play well with HTML5 in IE
      return $(elem).get(0).tagName.toLowerCase() === "time"; // $(elem).is("time");
    }
  });

  $.fn.timeago = function() {
    var self = this;
    self.each(refresh);

    var $s = $t.settings;
    if ($s.refreshMillis > 0) {
      setInterval(function() { self.each(refresh); }, $s.refreshMillis);
    }
    return self;
  };

  function refresh() {
    var data = prepareData(this);
    if (!isNaN(data.datetime)) {
      $(this).text(inWords(data.datetime));
    }
    return this;
  }

  function prepareData(element) {
    element = $(element);
    if (!element.data("timeago")) {
      element.data("timeago", { datetime: $t.datetime(element) });
      var text = $.trim(element.text());
      if (text.length > 0 && !($t.isTime(element) && element.attr("title"))) {
        element.attr("title", text);
      }
    }
    return element.data("timeago");
  }

  function inWords(date) {
    return $t.inWords(distance(date));
  }

  function distance(date) {
    return (new Date().getTime() - date.getTime());
  }

  // fix for IE6 suckage
  document.createElement("abbr");
  document.createElement("time");
}(jQuery));
