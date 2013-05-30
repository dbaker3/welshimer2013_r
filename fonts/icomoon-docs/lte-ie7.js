/* Use this script if you need to support IE 7 and IE 6. */

window.onload = function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'icomoon\'">' + entity + '</span>' + html;
	}
	var icons = {
			'icon-untitled' : '&#xe000;',
			'icon-untitled-2' : '&#xe001;',
			'icon-untitled-3' : '&#xe002;',
			'icon-untitled-4' : '&#xe003;',
			'icon-untitled-5' : '&#xe004;',
			'icon-untitled-6' : '&#xe005;',
			'icon-untitled-7' : '&#xe006;',
			'icon-untitled-8' : '&#xe007;',
			'icon-untitled-9' : '&#xe008;',
			'icon-untitled-10' : '&#xe009;',
			'icon-untitled-11' : '&#xe00a;',
			'icon-untitled-12' : '&#xe00b;',
			'icon-untitled-13' : '&#xe00c;',
			'icon-untitled-14' : '&#xe00d;',
			'icon-untitled-15' : '&#xe00e;',
			'icon-untitled-16' : '&#xe00f;',
			'icon-untitled-17' : '&#xe010;',
			'icon-untitled-18' : '&#xe011;',
			'icon-untitled-19' : '&#xe012;',
			'icon-untitled-20' : '&#xe013;',
			'icon-untitled-21' : '&#xe014;',
			'icon-untitled-22' : '&#xe015;',
			'icon-untitled-23' : '&#xe016;',
			'icon-untitled-24' : '&#xe017;',
			'icon-facebook' : '&#xe018;',
			'icon-facebook-2' : '&#xe019;',
			'icon-facebook-3' : '&#xe01a;',
			'icon-facebook-4' : '&#xe01b;',
			'icon-twitter' : '&#xe01c;',
			'icon-twitter-2' : '&#xe01d;',
			'icon-twitter-3' : '&#xe01e;',
			'icon-feed' : '&#xe01f;',
			'icon-feed-2' : '&#xe020;',
			'icon-feed-3' : '&#xe021;',
			'icon-github' : '&#xe022;',
			'icon-github-2' : '&#xe023;',
			'icon-github-3' : '&#xe024;',
			'icon-github-4' : '&#xe025;',
			'icon-github-5' : '&#xe026;',
			'icon-github-6' : '&#xe027;',
			'icon-git' : '&#xe028;',
			'icon-github-7' : '&#xe029;',
			'icon-wordpress' : '&#xe02a;',
			'icon-wordpress-2' : '&#xe02b;',
			'icon-amazon' : '&#xe02c;',
			'icon-amazon-2' : '&#xe02d;',
			'icon-apple' : '&#xe02e;',
			'icon-finder' : '&#xe02f;',
			'icon-android' : '&#xe030;',
			'icon-windows' : '&#xe031;',
			'icon-skype' : '&#xe032;',
			'icon-html5' : '&#xe033;',
			'icon-html5-2' : '&#xe034;',
			'icon-css3' : '&#xe035;',
			'icon-chrome' : '&#xe036;',
			'icon-firefox' : '&#xe037;',
			'icon-IE' : '&#xe038;',
			'icon-opera' : '&#xe039;',
			'icon-safari' : '&#xe03a;',
			'icon-IcoMoon' : '&#xe03b;'
		},
		els = document.getElementsByTagName('*'),
		i, attr, html, c, el;
	for (i = 0; i < els.length; i += 1) {
		el = els[i];
		attr = el.getAttribute('data-icon');
		if (attr) {
			addIcon(el, attr);
		}
		c = el.className;
		c = c.match(/icon-[^\s'"]+/);
		if (c) {
			addIcon(el, icons[c[0]]);
		}
	}
};