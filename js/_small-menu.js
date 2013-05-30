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

jQuery('.acc-sublist').addClass('hidden'); //For Onload
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
		jQuery('.open-item').removeClass('open-item');
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
