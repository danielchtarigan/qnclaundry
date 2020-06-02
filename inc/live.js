
var refreshWithSave=1,ktempCode,ktempCodeId=null,moveType,featherEditor;

function showYouTube(video){

	// create overlay:
	$("body").prepend('<div id="videoFrame" style="background:rgba(0,0,0,0.5);text-align:center;position:fixed;left:0;right:0;top:0;bottom:0;height:100vw;z-index:77770;vertical-align:middle"><iframe style="box-shadow:5px 5px 35px rgba(0,0,0,0.5);position:fixed;left:15vw;right:15vw;top:8%;display:block;margin:0;padding:10px;background:#fff;width:70vw;height:40vw;max-height:90%;z-index:77771;border:0;" src="'+video+'?autoplay=1&showinfo=0&rel=0&autohide=1&disablekb=1&modestbranding=1"></iframe><a href="javascript:void(null)" onclick="$(\'#videoFrame\').remove();" style="display:block;height:8vw;width:8vw;line-height:8vw;font-size:4vw;padding:0;text-align:center;color:#fff;background:#333;position:fixed;top:5%;right:5vw;border-radius:10vw;box-shadow:5px 5px 35px rgba(0,0,0,0.8);"><i class="fa fa-close"></i></a></div>')
	
}

function kopage_showLoading(opt){

	if(opt != 'unload')$("#k_spinner").addClass('kopageLoading');
	$("#spinnerHolder").show();
	
}
function kopage_hideLoading(){

	$("#k_spinner").removeClass('kopageLoading');
	$("#spinnerHolder").fadeOut();
	
}

/*! head.load - v1.0.3 */
(function(n,t){"use strict";function w(){}function u(n,t){if(n){typeof n=="object"&&(n=[].slice.call(n));for(var i=0,r=n.length;i<r;i++)t.call(n,n[i],i)}}function it(n,i){var r=Object.prototype.toString.call(i).slice(8,-1);return i!==t&&i!==null&&r===n}function s(n){return it("Function",n)}function a(n){return it("Array",n)}function et(n){var i=n.split("/"),t=i[i.length-1],r=t.indexOf("?");return r!==-1?t.substring(0,r):t}function f(n){(n=n||w,n._done)||(n(),n._done=1)}function ot(n,t,r,u){var f=typeof n=="object"?n:{test:n,success:!t?!1:a(t)?t:[t],failure:!r?!1:a(r)?r:[r],callback:u||w},e=!!f.test;return e&&!!f.success?(f.success.push(f.callback),i.load.apply(null,f.success)):e||!f.failure?u():(f.failure.push(f.callback),i.load.apply(null,f.failure)),i}function v(n){var t={},i,r;if(typeof n=="object")for(i in n)!n[i]||(t={name:i,url:n[i]});else t={name:et(n),url:n};return(r=c[t.name],r&&r.url===t.url)?r:(c[t.name]=t,t)}function y(n){n=n||c;for(var t in n)if(n.hasOwnProperty(t)&&n[t].state!==l)return!1;return!0}function st(n){n.state=ft;u(n.onpreload,function(n){n.call()})}function ht(n){n.state===t&&(n.state=nt,n.onpreload=[],rt({url:n.url,type:"cache"},function(){st(n)}))}function ct(){var n=arguments,t=n[n.length-1],r=[].slice.call(n,1),f=r[0];return(s(t)||(t=null),a(n[0]))?(n[0].push(t),i.load.apply(null,n[0]),i):(f?(u(r,function(n){s(n)||!n||ht(v(n))}),b(v(n[0]),s(f)?f:function(){i.load.apply(null,r)})):b(v(n[0])),i)}function lt(){var n=arguments,t=n[n.length-1],r={};return(s(t)||(t=null),a(n[0]))?(n[0].push(t),i.load.apply(null,n[0]),i):(u(n,function(n){n!==t&&(n=v(n),r[n.name]=n)}),u(n,function(n){n!==t&&(n=v(n),b(n,function(){y(r)&&f(t)}))}),i)}function b(n,t){if(t=t||w,n.state===l){t();return}if(n.state===tt){i.ready(n.name,t);return}if(n.state===nt){n.onpreload.push(function(){b(n,t)});return}n.state=tt;rt(n,function(){n.state=l;t();u(h[n.name],function(n){f(n)});o&&y()&&u(h.ALL,function(n){f(n)})})}function at(n){n=n||"";var t=n.split("?")[0].split(".");return t[t.length-1].toLowerCase()}function rt(t,i){function e(t){t=t||n.event;u.onload=u.onreadystatechange=u.onerror=null;i()}function o(f){f=f||n.event;(f.type==="load"||/loaded|complete/.test(u.readyState)&&(!r.documentMode||r.documentMode<9))&&(n.clearTimeout(t.errorTimeout),n.clearTimeout(t.cssTimeout),u.onload=u.onreadystatechange=u.onerror=null,i())}function s(){if(t.state!==l&&t.cssRetries<=20){for(var i=0,f=r.styleSheets.length;i<f;i++)if(r.styleSheets[i].href===u.href){o({type:"load"});return}t.cssRetries++;t.cssTimeout=n.setTimeout(s,250)}}var u,h,f;i=i||w;h=at(t.url);h==="css"?(u=r.createElement("link"),u.type="text/"+(t.type||"css"),u.rel="stylesheet",u.href=t.url,t.cssRetries=0,t.cssTimeout=n.setTimeout(s,500)):(u=r.createElement("script"),u.type="text/"+(t.type||"javascript"),u.src=t.url);u.onload=u.onreadystatechange=o;u.onerror=e;u.async=!1;u.defer=!1;t.errorTimeout=n.setTimeout(function(){e({type:"timeout"})},7e3);f=r.head||r.getElementsByTagName("head")[0];f.insertBefore(u,f.lastChild)}function vt(){for(var t,u=r.getElementsByTagName("script"),n=0,f=u.length;n<f;n++)if(t=u[n].getAttribute("data-headjs-load"),!!t){i.load(t);return}}function yt(n,t){var v,p,e;return n===r?(o?f(t):d.push(t),i):(s(n)&&(t=n,n="ALL"),a(n))?(v={},u(n,function(n){v[n]=c[n];i.ready(n,function(){y(v)&&f(t)})}),i):typeof n!="string"||!s(t)?i:(p=c[n],p&&p.state===l||n==="ALL"&&y()&&o)?(f(t),i):(e=h[n],e?e.push(t):e=h[n]=[t],i)}function e(){if(!r.body){n.clearTimeout(i.readyTimeout);i.readyTimeout=n.setTimeout(e,50);return}o||(o=!0,vt(),u(d,function(n){f(n)}))}function k(){r.addEventListener?(r.removeEventListener("DOMContentLoaded",k,!1),e()):r.readyState==="complete"&&(r.detachEvent("onreadystatechange",k),e())}var r=n.document,d=[],h={},c={},ut="async"in r.createElement("script")||"MozAppearance"in r.documentElement.style||n.opera,o,g=n.head_conf&&n.head_conf.head||"head",i=n[g]=n[g]||function(){i.ready.apply(null,arguments)},nt=1,ft=2,tt=3,l=4,p;if(r.readyState==="complete")e();else if(r.addEventListener)r.addEventListener("DOMContentLoaded",k,!1),n.addEventListener("load",e,!1);else{r.attachEvent("onreadystatechange",k);n.attachEvent("onload",e);p=!1;try{p=!n.frameElement&&r.documentElement}catch(wt){}p&&p.doScroll&&function pt(){if(!o){try{p.doScroll("left")}catch(t){n.clearTimeout(i.readyTimeout);i.readyTimeout=n.setTimeout(pt,50);return}e()}}()}i.load=i.js=ut?lt:ct;i.test=ot;i.ready=yt;i.ready(r,function(){y()&&u(h.ALL,function(n){f(n)});i.feature&&i.feature("domloaded",!0)})})(window);
/*
//# sourceMappingURL=head.load.min.js.map
*/

// there are some things to do, when page is loaded,
// show loading to make not ready items not-breakable.


var faIcons=new Array("500px","address-book","address-book-o","address-card","address-card-o","adjust","adn","align-center","align-justify","align-left","align-right","amazon","ambulance","american-sign-language-interpreting","anchor","android","angellist","angle-double-down","angle-double-left","angle-double-right","angle-double-up","angle-down","angle-left","angle-right","angle-up","apple","archive","area-chart","arrow-circle-down","arrow-circle-left","arrow-circle-o-down","arrow-circle-o-left","arrow-circle-o-right","arrow-circle-o-up","arrow-circle-right","arrow-circle-up","arrow-down","arrow-left","arrow-right","arrow-up","arrows","arrows-alt","arrows-h","arrows-v","asl-interpreting","assistive-listening-systems","asterisk","at","audio-description","automobile","backward","balance-scale","ban","bandcamp","bank","bar-chart","bar-chart-o","barcode","bars","bath","bathtub","battery","battery-0","battery-1","battery-2","battery-3","battery-4","battery-empty","battery-full","battery-half","battery-quarter","battery-three-quarters","bed","beer","behance","behance-square","bell","bell-o","bell-slash","bell-slash-o","bicycle","binoculars","birthday-cake","bitbucket","bitbucket-square","bitcoin","black-tie","blind","bluetooth","bluetooth-b","bold","bolt","bomb","book","bookmark","bookmark-o","braille","briefcase","btc","bug","building","building-o","bullhorn","bullseye","bus","buysellads","cab","calculator","calendar","calendar-check-o","calendar-minus-o","calendar-o","calendar-plus-o","calendar-times-o","camera","camera-retro","car","caret-down","caret-left","caret-right","caret-square-o-down","caret-square-o-left","caret-square-o-right","caret-square-o-up","caret-up","cart-arrow-down","cart-plus","cc","cc-amex","cc-diners-club","cc-discover","cc-jcb","cc-mastercard","cc-paypal","cc-stripe","cc-visa","certificate","chain","chain-broken","check","check-circle","check-circle-o","check-square","check-square-o","chevron-circle-down","chevron-circle-left","chevron-circle-right","chevron-circle-up","chevron-down","chevron-left","chevron-right","chevron-up","child","chrome","circle","circle-o","circle-o-notch","circle-thin","clipboard","clock-o","clone","close","cloud","cloud-download","cloud-upload","cny","code","code-fork","codepen","codiepie","coffee","cog","cogs","columns","comment","comment-o","commenting","commenting-o","comments","comments-o","compass","compress","connectdevelop","contao","copy","copyright","creative-commons","credit-card","credit-card-alt","crop","crosshairs","css3","cube","cubes","cut","cutlery","dashboard","dashcube","database","deaf","deafness","dedent","delicious","desktop","deviantart","diamond","digg","dollar","dot-circle-o","download","dribbble","drivers-license","drivers-license-o","dropbox","drupal","edge","edit","eercast","eject","ellipsis-h","ellipsis-v","empire","envelope","envelope-o","envelope-open","envelope-open-o","envelope-square","envira","eraser","etsy","eur","euro","exchange","exclamation","exclamation-circle","exclamation-triangle","expand","expeditedssl","external-link","external-link-square","eye","eye-slash","eyedropper","fa","facebook","facebook-f","facebook-official","facebook-square","fast-backward","fast-forward","fax","feed","female","fighter-jet","file","file-archive-o","file-audio-o","file-code-o","file-excel-o","file-image-o","file-movie-o","file-o","file-pdf-o","file-photo-o","file-picture-o","file-powerpoint-o","file-sound-o","file-text","file-text-o","file-video-o","file-word-o","file-zip-o","files-o","film","filter","fire","fire-extinguisher","firefox","first-order","flag","flag-checkered","flag-o","flash","flask","flickr","floppy-o","folder","folder-o","folder-open","folder-open-o","font","font-awesome","fonticons","fort-awesome","forumbee","forward","foursquare","free-code-camp","frown-o","futbol-o","gamepad","gavel","gbp","ge","gear","gears","genderless","get-pocket","gg","gg-circle","gift","git","git-square","github","github-alt","github-square","gitlab","gittip","glass","glide","glide-g","globe","google","google-plus","google-plus-circle","google-plus-official","google-plus-square","google-wallet","graduation-cap","gratipay","grav","group","h-square","hacker-news","hand-grab-o","hand-lizard-o","hand-o-down","hand-o-left","hand-o-right","hand-o-up","hand-paper-o","hand-peace-o","hand-pointer-o","hand-rock-o","hand-scissors-o","hand-spock-o","hand-stop-o","handshake-o","hard-of-hearing","hashtag","hdd-o","header","headphones","heart","heart-o","heartbeat","history","home","hospital-o","hotel","hourglass","hourglass-1","hourglass-2","hourglass-3","hourglass-end","hourglass-half","hourglass-o","hourglass-start","houzz","html5","i-cursor","id-badge","id-card","id-card-o","ils","image","imdb","inbox","indent","industry","info","info-circle","inr","instagram","institution","internet-explorer","intersex","ioxhost","italic","joomla","jpy","jsfiddle","key","keyboard-o","krw","language","laptop","lastfm","lastfm-square","leaf","leanpub","legal","lemon-o","level-down","level-up","life-bouy","life-buoy","life-ring","life-saver","lightbulb-o","line-chart","link","linkedin","linkedin-square","linode","linux","list","list-alt","list-ol","list-ul","location-arrow","lock","long-arrow-down","long-arrow-left","long-arrow-right","long-arrow-up","low-vision","magic","magnet","mail-forward","mail-reply","mail-reply-all","male","map","map-marker","map-o","map-pin","map-signs","mars","mars-double","mars-stroke","mars-stroke-h","mars-stroke-v","maxcdn","meanpath","medium","medkit","meetup","meh-o","mercury","microchip","microphone","microphone-slash","minus","minus-circle","minus-square","minus-square-o","mixcloud","mobile","mobile-phone","modx","money","moon-o","mortar-board","motorcycle","mouse-pointer","music","navicon","neuter","newspaper-o","object-group","object-ungroup","odnoklassniki","odnoklassniki-square","opencart","openid","opera","optin-monster","outdent","pagelines","paint-brush","paper-plane","paper-plane-o","paperclip","paragraph","paste","pause","pause-circle","pause-circle-o","paw","paypal","pencil","pencil-square","pencil-square-o","percent","phone","phone-square","photo","picture-o","pie-chart","pied-piper","pied-piper-alt","pied-piper-pp","pinterest","pinterest-p","pinterest-square","plane","play","play-circle","play-circle-o","plug","plus","plus-circle","plus-square","plus-square-o","podcast","power-off","print","product-hunt","puzzle-piece","qq","qrcode","question","question-circle","question-circle-o","quora","quote-left","quote-right","ra","random","ravelry","rebel","recycle","reddit","reddit-alien","reddit-square","refresh","registered","remove","renren","reorder","repeat","reply","reply-all","resistance","retweet","rmb","road","rocket","rotate-left","rotate-right","rouble","rss","rss-square","rub","ruble","rupee","s15","safari","save","scissors","scribd","search","search-minus","search-plus","sellsy","send","send-o","server","share","share-alt","share-alt-square","share-square","share-square-o","shekel","sheqel","shield","ship","shirtsinbulk","shopping-bag","shopping-basket","shopping-cart","shower","sign-in","sign-language","sign-out","signal","signing","simplybuilt","sitemap","skyatlas","skype","slack","sliders","slideshare","smile-o","snapchat","snapchat-ghost","snapchat-square","snowflake-o","soccer-ball-o","sort","sort-alpha-asc","sort-alpha-desc","sort-amount-asc","sort-amount-desc","sort-asc","sort-desc","sort-down","sort-numeric-asc","sort-numeric-desc","sort-up","soundcloud","space-shuttle","spinner","spoon","spotify","square","square-o","stack-exchange","stack-overflow","star","star-half","star-half-empty","star-half-full","star-half-o","star-o","steam","steam-square","step-backward","step-forward","stethoscope","sticky-note","sticky-note-o","stop","stop-circle","stop-circle-o","street-view","strikethrough","stumbleupon","stumbleupon-circle","subscript","subway","suitcase","sun-o","superpowers","superscript","support","table","tablet","tachometer","tag","tags","tasks","taxi","telegram","television","tencent-weibo","terminal","text-height","text-width","th","th-large","th-list","themeisle","thermometer","thermometer-0","thermometer-1","thermometer-2","thermometer-3","thermometer-4","thermometer-empty","thermometer-full","thermometer-half","thermometer-quarter","thermometer-three-quarters","thumb-tack","thumbs-down","thumbs-o-down","thumbs-o-up","thumbs-up","ticket","times","times-circle","times-circle-o","times-rectangle","times-rectangle-o","tint","toggle-down","toggle-left","toggle-off","toggle-on","toggle-right","toggle-up","trademark","train","transgender","transgender-alt","trash","trash-o","tree","trello","tripadvisor","trophy","truck","try","tty","tumblr","tumblr-square","turkish-lira","tv","twitch","twitter","twitter-square","umbrella","underline","undo","universal-access","university","unlink","unlock","unlock-alt","unsorted","upload","usb","usd","user","user-circle","user-circle-o","user-md","user-o","user-plus","user-secret","user-times","users","vcard","vcard-o","venus","venus-double","venus-mars","viacoin","viadeo","viadeo-square","video-camera","vimeo","vimeo-square","vine","vk","volume-control-phone","volume-down","volume-off","volume-up","warning","wechat","weibo","weixin","whatsapp","wheelchair","wheelchair-alt","wifi","wikipedia-w","window-close","window-close-o","window-maximize","window-minimize","window-restore","windows","won","wordpress","wpbeginner","wpexplorer","wpforms","wrench","xing","xing-square","y-combinator","y-combinator-square","yahoo","yc","yc-square","yelp","yen","yoast","youtube","youtube-play","youtube-square");

var swatches = [{
      name: 'Red',
      camel: 'red',
      colors: [
        { name: '50', hex: 'FFEBEE' },
        { name: '100', hex: 'FFCDD2' },
        { name: '200', hex: 'EF9A9A' },
        { name: '300', hex: 'E57373' },
        { name: '400', hex: 'EF5350' },
        { name: '500', hex: 'F44336' },
        { name: '600', hex: 'E53935' },
        { name: '700', hex: 'D32F2F' },
        { name: '800', hex: 'C62828' },
        { name: '900', hex: 'B71C1C' },
        { name: 'A100', hex: 'FF8A80' },
        { name: 'A200', hex: 'FF5252' },
        { name: 'A400', hex: 'FF1744' },
        { name: 'A700', hex: 'D50000' }
      ]
    }, {
      name: 'Pink',
      camel: 'pink',
      colors: [
        { name: '50', hex: 'FCE4EC' },
        { name: '100', hex: 'F8BBD0' },
        { name: '200', hex: 'F48FB1' },
        { name: '300', hex: 'F06292' },
        { name: '400', hex: 'EC407A' },
        { name: '500', hex: 'E91E63' },
        { name: '600', hex: 'D81B60' },
        { name: '700', hex: 'C2185B' },
        { name: '800', hex: 'AD1457' },
        { name: '900', hex: '880E4F' },
        { name: 'A100', hex: 'FF80AB' },
        { name: 'A200', hex: 'FF4081' },
        { name: 'A400', hex: 'F50057' },
        { name: 'A700', hex: 'C51162' }
      ]
    }, {
      name: 'Purple',
      camel: 'purple',
      colors: [
        { name: '50', hex: 'F3E5F5' },
        { name: '100', hex: 'E1BEE7' },
        { name: '200', hex: 'CE93D8' },
        { name: '300', hex: 'BA68C8' },
        { name: '400', hex: 'AB47BC' },
        { name: '500', hex: '9C27B0' },
        { name: '600', hex: '8E24AA' },
        { name: '700', hex: '7B1FA2' },
        { name: '800', hex: '6A1B9A' },
        { name: '900', hex: '4A148C' },
        { name: 'A100', hex: 'EA80FC' },
        { name: 'A200', hex: 'E040FB' },
        { name: 'A400', hex: 'D500F9' },
        { name: 'A700', hex: 'AA00FF' }
      ]
    }, {
      name: 'Deep Purple',
      camel: 'deepPurple',
      colors: [
        { name: '50', hex: 'EDE7F6' },
        { name: '100', hex: 'D1C4E9' },
        { name: '200', hex: 'B39DDB' },
        { name: '300', hex: '9575CD' },
        { name: '400', hex: '7E57C2' },
        { name: '500', hex: '673AB7' },
        { name: '600', hex: '5E35B1' },
        { name: '700', hex: '512DA8' },
        { name: '800', hex: '4527A0' },
        { name: '900', hex: '311B92' },
        { name: 'A100', hex: 'B388FF' },
        { name: 'A200', hex: '7C4DFF' },
        { name: 'A400', hex: '651FFF' },
        { name: 'A700', hex: '6200EA' }
      ]
    }, {
      name: 'Indigo',
      camel: 'indigo',
      colors: [
        { name: '50', hex: 'E8EAF6' },
        { name: '100', hex: 'C5CAE9' },
        { name: '200', hex: '9FA8DA' },
        { name: '300', hex: '7986CB' },
        { name: '400', hex: '5C6BC0' },
        { name: '500', hex: '3F51B5' },
        { name: '600', hex: '3949AB' },
        { name: '700', hex: '303F9F' },
        { name: '800', hex: '283593' },
        { name: '900', hex: '1A237E' },
        { name: 'A100', hex: '8C9EFF' },
        { name: 'A200', hex: '536DFE' },
        { name: 'A400', hex: '3D5AFE' },
        { name: 'A700', hex: '304FFE' }
      ]
    }, {
      name: 'Blue',
      camel: 'blue',
      colors: [
        { name: '50', hex: 'E3F2FD' },
        { name: '100', hex: 'BBDEFB' },
        { name: '200', hex: '90CAF9' },
        { name: '300', hex: '64B5F6' },
        { name: '400', hex: '42A5F5' },
        { name: '500', hex: '2196F3' },
        { name: '600', hex: '1E88E5' },
        { name: '700', hex: '1976D2' },
        { name: '800', hex: '1565C0' },
        { name: '900', hex: '0D47A1' },
        { name: 'A100', hex: '82B1FF' },
        { name: 'A200', hex: '448AFF' },
        { name: 'A400', hex: '2979FF' },
        { name: 'A700', hex: '2962FF' }
      ]
    }, {
      name: 'Light Blue',
      camel: 'lightBlue',
      colors: [
        { name: '50', hex: 'E1F5FE' },
        { name: '100', hex: 'B3E5FC' },
        { name: '200', hex: '81D4FA' },
        { name: '300', hex: '4FC3F7' },
        { name: '400', hex: '29B6F6' },
        { name: '500', hex: '03A9F4' },
        { name: '600', hex: '039BE5' },
        { name: '700', hex: '0288D1' },
        { name: '800', hex: '0277BD' },
        { name: '900', hex: '01579B' },
        { name: 'A100', hex: '80D8FF' },
        { name: 'A200', hex: '40C4FF' },
        { name: 'A400', hex: '00B0FF' },
        { name: 'A700', hex: '0091EA' }
      ]
    }, {
      name: 'Cyan',
      camel: 'cyan',
      colors: [
        { name: '50', hex: 'E0F7FA' },
        { name: '100', hex: 'B2EBF2' },
        { name: '200', hex: '80DEEA' },
        { name: '300', hex: '4DD0E1' },
        { name: '400', hex: '26C6DA' },
        { name: '500', hex: '00BCD4' },
        { name: '600', hex: '00ACC1' },
        { name: '700', hex: '0097A7' },
        { name: '800', hex: '00838F' },
        { name: '900', hex: '006064' },
        { name: 'A100', hex: '84FFFF' },
        { name: 'A200', hex: '18FFFF' },
        { name: 'A400', hex: '00E5FF' },
        { name: 'A700', hex: '00B8D4' }
      ]
    }, {
      name: 'Teal',
      camel: 'teal',
      colors: [
        { name: '50', hex: 'E0F2F1' },
        { name: '100', hex: 'B2DFDB' },
        { name: '200', hex: '80CBC4' },
        { name: '300', hex: '4DB6AC' },
        { name: '400', hex: '26A69A' },
        { name: '500', hex: '009688' },
        { name: '600', hex: '00897B' },
        { name: '700', hex: '00796B' },
        { name: '800', hex: '00695C' },
        { name: '900', hex: '004D40' },
        { name: 'A100', hex: 'A7FFEB' },
        { name: 'A200', hex: '64FFDA' },
        { name: 'A400', hex: '1DE9B6' },
        { name: 'A700', hex: '00BFA5' }
      ]
    }, {
      name: 'Green',
      camel: 'green',
      colors: [
        { name: '50', hex: 'E8F5E9' },
        { name: '100', hex: 'C8E6C9' },
        { name: '200', hex: 'A5D6A7' },
        { name: '300', hex: '81C784' },
        { name: '400', hex: '66BB6A' },
        { name: '500', hex: '4CAF50' },
        { name: '600', hex: '43A047' },
        { name: '700', hex: '388E3C' },
        { name: '800', hex: '2E7D32' },
        { name: '900', hex: '1B5E20' },
        { name: 'A100', hex: 'B9F6CA' },
        { name: 'A200', hex: '69F0AE' },
        { name: 'A400', hex: '00E676' },
        { name: 'A700', hex: '00C853' }
      ]
    }, {
      name: 'Light Green',
      camel: 'lightGreen',
      colors: [
        { name: '50', hex: 'F1F8E9' },
        { name: '100', hex: 'DCEDC8' },
        { name: '200', hex: 'C5E1A5' },
        { name: '300', hex: 'AED581' },
        { name: '400', hex: '9CCC65' },
        { name: '500', hex: '8BC34A' },
        { name: '600', hex: '7CB342' },
        { name: '700', hex: '689F38' },
        { name: '800', hex: '558B2F' },
        { name: '900', hex: '33691E' },
        { name: 'A100', hex: 'CCFF90' },
        { name: 'A200', hex: 'B2FF59' },
        { name: 'A400', hex: '76FF03' },
        { name: 'A700', hex: '64DD17' }
      ]
    }, {
      name: 'Lime',
      camel: 'lime',
      colors: [
        { name: '50', hex: 'F9FBE7' },
        { name: '100', hex: 'F0F4C3' },
        { name: '200', hex: 'E6EE9C' },
        { name: '300', hex: 'DCE775' },
        { name: '400', hex: 'D4E157' },
        { name: '500', hex: 'CDDC39' },
        { name: '600', hex: 'C0CA33' },
        { name: '700', hex: 'AFB42B' },
        { name: '800', hex: '9E9D24' },
        { name: '900', hex: '827717' },
        { name: 'A100', hex: 'F4FF81' },
        { name: 'A200', hex: 'EEFF41' },
        { name: 'A400', hex: 'C6FF00' },
        { name: 'A700', hex: 'AEEA00' }
      ]
    }, {
      name: 'Yellow',
      camel: 'yellow',
      colors: [
        { name: '50', hex: 'FFFDE7' },
        { name: '100', hex: 'FFF9C4' },
        { name: '200', hex: 'FFF59D' },
        { name: '300', hex: 'FFF176' },
        { name: '400', hex: 'FFEE58' },
        { name: '500', hex: 'FFEB3B' },
        { name: '600', hex: 'FDD835' },
        { name: '700', hex: 'FBC02D' },
        { name: '800', hex: 'F9A825' },
        { name: '900', hex: 'F57F17' },
        { name: 'A100', hex: 'FFFF8D' },
        { name: 'A200', hex: 'FFFF00' },
        { name: 'A400', hex: 'FFEA00' },
        { name: 'A700', hex: 'FFD600' }
      ]
    }, {
      name: 'Amber',
      camel: 'amber',
      colors: [
        { name: '50', hex: 'FFF8E1' },
        { name: '100', hex: 'FFECB3' },
        { name: '200', hex: 'FFE082' },
        { name: '300', hex: 'FFD54F' },
        { name: '400', hex: 'FFCA28' },
        { name: '500', hex: 'FFC107' },
        { name: '600', hex: 'FFB300' },
        { name: '700', hex: 'FFA000' },
        { name: '800', hex: 'FF8F00' },
        { name: '900', hex: 'FF6F00' },
        { name: 'A100', hex: 'FFE57F' },
        { name: 'A200', hex: 'FFD740' },
        { name: 'A400', hex: 'FFC400' },
        { name: 'A700', hex: 'FFAB00' }
      ]
    }, {
      name: 'Orange',
      camel: 'orange',
      colors: [
        { name: '50', hex: 'FFF3E0' },
        { name: '100', hex: 'FFE0B2' },
        { name: '200', hex: 'FFCC80' },
        { name: '300', hex: 'FFB74D' },
        { name: '400', hex: 'FFA726' },
        { name: '500', hex: 'FF9800' },
        { name: '600', hex: 'FB8C00' },
        { name: '700', hex: 'F57C00' },
        { name: '800', hex: 'EF6C00' },
        { name: '900', hex: 'E65100' },
        { name: 'A100', hex: 'FFD180' },
        { name: 'A200', hex: 'FFAB40' },
        { name: 'A400', hex: 'FF9100' },
        { name: 'A700', hex: 'FF6D00' }
      ]
    }, {
      name: 'Deep Orange',
      camel: 'deepOrange',
      colors: [
        { name: '50', hex: 'FBE9E7' },
        { name: '100', hex: 'FFCCBC' },
        { name: '200', hex: 'FFAB91' },
        { name: '300', hex: 'FF8A65' },
        { name: '400', hex: 'FF7043' },
        { name: '500', hex: 'FF5722' },
        { name: '600', hex: 'F4511E' },
        { name: '700', hex: 'E64A19' },
        { name: '800', hex: 'D84315' },
        { name: '900', hex: 'BF360C' },
        { name: 'A100', hex: 'FF9E80' },
        { name: 'A200', hex: 'FF6E40' },
        { name: 'A400', hex: 'FF3D00' },
        { name: 'A700', hex: 'DD2C00' }
      ]
    }, {
      name: 'Brown',
      camel: 'brown',
      colors: [
        { name: '50', hex: 'EFEBE9' },
        { name: '100', hex: 'D7CCC8' },
        { name: '200', hex: 'BCAAA4' },
        { name: '300', hex: 'A1887F' },
        { name: '400', hex: '8D6E63' },
        { name: '500', hex: '795548' },
        { name: '600', hex: '6D4C41' },
        { name: '700', hex: '5D4037' },
        { name: '800', hex: '4E342E' },
        { name: '900', hex: '3E2723' }
      ]
    }, {
      name: 'Grey',
      camel: 'grey',
      colors: [
        { name: '50', hex: 'FAFAFA' },
        { name: '100', hex: 'F5F5F5' },
        { name: '200', hex: 'EEEEEE' },
        { name: '300', hex: 'E0E0E0' },
        { name: '400', hex: 'BDBDBD' },
        { name: '500', hex: '9E9E9E' },
        { name: '600', hex: '757575' },
        { name: '700', hex: '616161' },
        { name: '800', hex: '424242' },
        { name: '900', hex: '212121' }
      ]
    }, {
      name: 'Blue Grey',
      camel: 'blueGrey',
      colors: [
        { name: '50', hex: 'ECEFF1' },
        { name: '100', hex: 'CFD8DC' },
        { name: '200', hex: 'B0BEC5' },
        { name: '300', hex: '90A4AE' },
        { name: '400', hex: '78909C' },
        { name: '500', hex: '607D8B' },
        { name: '600', hex: '546E7A' },
        { name: '700', hex: '455A64' },
        { name: '800', hex: '37474F' },
        { name: '900', hex: '263238' }
      ]
    }, {
      name: 'Misc',
      camel: '',
      colors: [
        { name: 'white', hex: 'FFFFFF', x: 19, y: 0 },
        { name: 'black', hex: '000000', x: 19, y: 1 }
      ]
    }];

function escapeHtml(text) {
	if(typeof text == 'undefined')return '';
	return text
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
}

function guidGenerator() {
    var S4 = function() {
       return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
    };
    return (S4()+S4());
}

var ID = function () {
  // Math.random should be unique because of its seeding algorithm.
  // Convert it to base 36 (numbers + letters), and grab the first 9 characters
  // after the decimal.
  return /*'_' + */Math.random().toString(36).substr(2, 9);
};

// Removing Content Block. Ask before removing

function kopage_blockRemovePrompt(i){
	
	// if there's menu opened, hide it:
	keditableToolbar('hide');
	
	basicModal.show({
		body: '<p>'+langPhrase.blockRemoving+'</p>',
		closable: true,
		buttons: {
			cancel: {
				title: langPhrase.cancel,
				fn: basicModal.close
			},
			action: {
				title: langPhrase.continue,
				fn:  function(){$('#blockId').val(i);kopage_blockRemove();basicModal.close();
				
				
						
	
			}
	
			}
		}
	})



	
}

// Init. Add toolbox to each conten block (.kedit)
// Function k_EditInit is called by keditPrepare() when page is loaded.

//headerMenu

		
var headerSectionEdit='<a contenteditable="false" href="javascript:void(null)" onClick="kopageToolbarTabs(\'Block\',\'HomeHeader\')"  style="position:absolute;" data-balloon="'+langPhrase.headerSettings+'" data-balloon-pos="downright" class="koBg2 koBgHover-3 k_EditHeader kelement"><i class="fa fa-cog"></i></a>';
var footerSectionEdit='<a contenteditable="false" href="javascript:void(null)" onClick="kopageToolbarTabs(\'Block\',\'Footer\')"  style="position:absolute;" data-balloon="'+langPhrase.footerSettings+'" data-balloon-pos="downright" class="koBg2 koBgHover-3 k_EditHeader kelement"><i class="fa fa-cog"></i></a>';	
$("#headerMenu").attr('data-label',langPhrase.headerEl)
function k_EditInit(e,i,w){
	
	
	var koparsedContent=0;
	// in some cases, content is just not editable...
	//if(typeof koparsedNotEditable!=='undefined'){
	if(koparsedNotEditable != false){
		
		if(koparsedNotEditable == 'SEARCH')
			return;
		else 
			var koparsedContent=1;
		
	}
	
	if($("#kEdit_"+i).length > 0) return; 
	
	if(w == 'h'){
	var $keditControls=headerSectionEdit;
	$(e).attr('data-label',langPhrase.headerEl);
	}else if(w == 'f'){
	var $keditControls=footerSectionEdit;
	$(e).attr('data-label',langPhrase.footerEl);
	}else{
	var $keditControls='';
	$(e).attr('data-label',langPhrase.contentEl);
	}



	
	var theRel=$(e).attr('rel');
	var moveButton=1;
	var removeButton=1;
	var k_EditClass='';
	var editButton='';
	var addButton='';
	
	if(typeof theRel!=='undefined'
	
		||
		
		$(e).hasClass('keditFooter') 
		
		|| 
		
		$(e).hasClass('keditHeader')){

		// it's sidebar/splash/footer
		moveButton=0;
		removeButton=0;
		
	}
	

	// don't allow editing for blocks which are column layout only,
	// just move or remove.
	
	if($(e).hasClass('keditRow')){
		
		k_EditClass=' keditLayout';
		
	}
	
	if($(e).hasClass('keditNoEdit'))return;
		

		$keditControls+='<div contenteditable="false" class="kelement k_Edit'+k_EditClass+'" id="kEdit_'+i+'">';
	
	
		$keditControls+='<span class="k_EditMore">';
		
		
		if(removeButton == 1){
		$keditControls+='<a href="javascript:void(null)" class="koBg5 koBgHover-3 k_Remove" data-balloon="'+langPhrase.blockRemove+'" data-balloon-pos="downleft" onclick="kopage_blockRemovePrompt(\''+i+'\')"><i class="fa fa-trash"></i></a>';
		}
		
		$keditControls+='<a href="javascript:void(null)" class="koBg3 koBgHover-3" data-balloon="'+langPhrase.blockSettings+'" data-balloon-pos="downleft" onclick="kopageToolbarTabs(\'Block\',\''+i+'\')"><i class="fa fa-cog"></i></a>';
	
		$keditControls+='</span>';
	
	
	if(koparsedContent==0){
	
		
	
		if(moveButton == 1){
		
				$keditControls+='<a href="javascript:void(null)" class="koBg1 koBgHover-1 k_Move" data-balloon="'+langPhrase.blockMove+'" data-balloon-pos="downleft"><i class="fa fa-arrows"></i></a>';
		
		}


	
	}
	
	$keditControls+='</div>';
						
	$keditControls=$($keditControls);
	$(e).prepend($keditControls);
	
	return true;
	
	
}

function keditSeparatorCode(theId,theClass){
	
	if(!theId)var theId=ID();
	if(!theClass)var theClass=''
	
	return '<div class="keditSeparator kelement '+theClass+'" id="'+theId+'"><div><a href="javascript:void(null)" onclick="kopage_showFrame(\'content\',\''+theId+'\')" data-balloon="Add new content here" data-balloon-pos="down"><span><i class="fa fa-plus"></i></span></a></div></div>';

}

function keditPrepare(w,ns){
	
	var w_type='',toInit;
	
	if(typeof w === "object"){
		
		toInit=w;
		
	}else{

		w_type=w.substring(1,2);
		toInit=w;
		
	}
	
	if(ns == 'header' || ns == 'footer'){
		w_type=ns.substring(0,1);
	}
	
	var initCounter=0;
	$(toInit).each(function(i) {

		initCounter++;
		
		var newId = 'kpg_';
		
		if(typeof $(this).attr('rel') !== 'undefined')
		newId += $(this).attr('rel');
		
		if(newId == 'kpg_')
			var newId='kpg_'+Math.floor(Math.random()*100)+i;
		
		var oldId=$(this).attr('id');
		
		if(typeof oldId === "undefined"){
			$(this).attr('id',newId);
			oldId=newId;
		}
			
		initKeditable(this);
		k_EditInit(this,oldId,w_type);
		
		if(w=='#footerContent'){
			$(this).attr('data-label',"Footer Element");
		}
		
		//keditSeparators(this,"k"+oldId,w_type) // we should use this one, but it's not 100% reliable
		
	});
	
	if(ns!='noSeparators'){
		keditSeparators();
	}
	
}

// INIT. Find each ".kedit" block on this page,
// (or use one provided from variable)
// make ".keditable" elements contentEditable

function initKeditable(i){
	
	
	var setupInlineEdits=false;
	var i_type=typeof i;
	
	if(i_type === "undefined"){
		var kedits=$('.kedit');
	}else if(i_type === "object"){
		var kedits=$(i);
		i=$(i).attr('id');
		var setupInlineEdits=true;
	}else{
		var kedits=$('#'+i);
		var setupInlineEdits=true;
	}
	kedits.each(function(index,el){
	
	// skip if it's column block, 
	// there will be kedits inside
	//if($(el).hasClass('keditRow'))return true;
	
	// skip if this is just a parsed module
	if($(el).find('.koparsed').length>0)return true;
	
	var keditables=$(el).find('.keditable');
	if(keditables.length>0){
		
		// make .keditable editable:
		$(keditables).each(function(){
			
			keditableToolbar(this);
			
		})
		
	} else {
		
		// no editables in this kedit? Make entire div editable.			
		$(el).html('<div class="keditable keditable-auto">'+$(el).html()+'</div>');//addClass('keditable');
		keditableToolbar(el);

	}
	
	if(setupInlineEdits){
		
		// setup inline helpers, but only if this is new item,
		// there's no need to repeat it each time

		$('#'+i+' a').editableLinks();
		$('#'+i+' img').editableImages();
		$('#'+i+' i.fa').editableIcons();
		$('#'+i+' .kvideo-centered').editableVideos();
	
		
	}
	
	
	});
	
}

function hideModalManager(){
	
	$('a.kopageToolbarTabsClose,a.kopageToolbarTabsApply,a.kopageToolbarTabsRemove').css({'left':''})
	
	// make BODY scrollable again.
	$("html, body").css('overflow','auto');
	
	$("#kopageFManager").attr({'class':null});
	$("#kopageFManager").hide();//addClass('animated fadeOutLeft');

}


function showModalManager(option,optionalType,optionOption){
	
	
	var whichFrame='';
		
	if(optionOption == 'img'){
		
		$("#managerApplyToImage").val(option);
		$("#managerApplyTo").val('');
		
	} else if(optionOption=='tinymce'){
		
		window.tinymceCallback=option;
		
	}else{
		$("#managerApplyTo").val(option);
		$("#managerApplyToImage").val('');
		
	}

	
	// hide close/save/remove buttons:
	$('a.kopageToolbarTabsClose,a.kopageToolbarTabsApply,a.kopageToolbarTabsRemove').css({'left':'-1000px'});
	
	// make BODY not-scrollable
	$("html, body").css({'overflow':'hidden'});

	$("#kopageToolbarMoreSettings,.kopageMoreFrameClose_HTML,.kopageMoreFrameSave_HTML").hide();
		

	$("#kopageFManager").hide().attr({'class':null,'style':null});//removeClass('animated fadeInLeft flipOutY flipInY');
	$("#kopageFManager").show().addClass('animated tdFadeInRight');

	
	if(optionOption=='tinymce' || optionOption == 'img')
		$('#kopageFManager').css({'left':'0px'});
	else
		$('#kopageFManager').css({'left':'250px'});



	if(managerMode == "guide"){
		
		$("#fileManagerUploadToFolder").val("guide");
		showFolder(dataPath+"data/files/guide","guide");
		
	} else {
		
		showFolder(true);
		
	}
	
}

function kAssetManager(callback, value, meta){
	
	showModalManager(callback,meta,"tinymce");
	return;
		
}


var tinyMceMoreOptionsStatus=1;

function k_EditCancel(){
	
	if(ktempCodeId != null){
		
		// there was some temporary ID set, and editing wasn't cancelled...
		
		$("#k_Edit").hide();
		$("#k_EditActive").remove();
		
		// and "un-init" live editor
		//tinymce.execCommand('mceRemoveEditor', false, ktempCodeId);
		
		
		$("#"+ktempCodeId).html(ktempCode).removeClass('keditActive');
		ktempCodeId=null;
		
	}
	
}

function kopage_infoNotice(msg){
	
	kopage_hideLoading();

	new jBox('Notice', {
	
		theme: 'NoticeBorder',color:'green',
		content: msg,
		stack:true,fixed:true,animation:'tada',color:'green',
		position:{x:'right',y:'top'},offset:{x: -15, y: 15},
	
	});
	
}

// when all is loaded...

$(function(){
	
	// for admin only, set background to color-value fields 
	//$('.kopageColor').each(function(){
	//	$(this).css('background',$(this).val())
	//});
	
	$('.jBoxTooltip').jBox('Tooltip',{theme:'TooltipBorder',zIndex:'65601',animation:'zoomIn'});
	$('.jBoxTooltipRight').jBox('Tooltip',{theme:'TooltipBorder',zIndex:'65601',animation:'move',position: {x: 'right',y: 'center'},outside: 'x'});
	


	
$('#contentArea').attr('data-label','Content Area');
$('#footerContent').attr('data-label','Footer Area');
$('#header').attr('data-label','Header Area');
});

function k_htmlApply(){
	
	var theID=$('#blockId').val();
	$("#"+theID).html($("#k_htmlEditor").val());
	k_EditSave();
	
}

// generate some list.



//document.getElementById('headerContent').appendChild(makeSubpagesList());

function k_RawHTML(el){
	
		
	// #1 - If there are modules on page, 
	// "unparse" them, so there are tags only...
	
	$("body").append('<div id="k_TempSave"></div>');
	
	// are there any elements with missing id?
	$(el).find('#newKeditItem').each(function( key, value ) {
	  //alert( key + ": " + value );
		$(this).attr('id','kedit_'+ID());
	});

	
	$("#k_TempSave").html($(el).html())
	
	$("#k_TempSave .koparsed").each(function() {
		var koparsedRel=$( this ).attr( "rel" );
		if(typeof koparsedRel !== 'undefined'){
			
			var koparsedAddon=$( this ).attr( "data-kopased-addon" )
				
			
				if(typeof koparsedAddon!== "undefined" && 
					koparsedAddon!='')
						koparsedRel+=','+koparsedAddon;	
			
			
			
			
		$( this ).replaceWith('{%'+koparsedRel+'%}');
		
		
		
		
		
		
		
		}else
		$( this ).replaceWith($( this ).html());
		
	});
	
	$("#k_TempSave .kedit").removeAttr('style').removeAttr('data-label').removeAttr('contenteditable').removeAttr('spellcheck').removeClass('noedit kedit_fw blockKeditActive ui-sortable-helper ui-sortable')
	.removeAttr('ondrag').removeAttr('ondrop').removeAttr('onpaste');

	$('#k_TempSave .keditable').removeAttr('spellcheck').removeAttr('contenteditable')
	.removeAttr('ondrag').removeAttr('ondrop').removeAttr('onpaste');
	

	// remove separators ("Add content here" buttons)
	
	$("#k_TempSave .kelement,#k_TempSave .keditLinkEdit, #k_TempSave #keditSeparatorAdd,#k_TempSave .keditPlaceholderEdit,#k_TempSave grammarly-btn").remove()
	
	keditImageTags=$("#k_TempSave .kedit img");
	
	// if images were made editable, undo it before TinyMCE starts:
	var keditImageClear=$('#k_TempSave .keditImage').remove();
	if(keditImageClear.length > 0){
	
		$('#k_TempSave span.keditImageWrap').each(function(){
			$(this).replaceWith($(this).find('img'))
		})
		
		
		
	}
	
	// replace iframes/videos
	$('#k_TempSave div.keditImageWrap').each(function(){
		
		$(this).replaceWith('<div class="kvideo-centered">'+$(this).find('iframe').parent().html()+'</div>');
		
	})
		

	$('#k_TempSave span.keditIconWrap').each(function(){
		$(this).replaceWith($(this).find('i:not(.systemicon)'))
	})
	
	$("#k_TempSave .keditInlineEdit").remove();
	  
	$("#k_TempSave .kedit").each(function() {
		var keditBg=$( this ).attr( "data-background" );
		var keditBgColor=$( this ).attr( "data-bgcolor" );
		if(typeof keditBgColor == 'undefined')keditBgColor='';
		if(typeof keditBg != 'undefined' && keditBg.length > 0)
			keditBgColor+=' url('+keditBg+') no-repeat center center;background-size:cover';
			
		$( this ).attr('style','background:'+keditBgColor);
		
		//$( this ).replaceWith('{%'+$( this ).attr( "rel" )+'%}');
		//else
		//$( this ).replaceWith($( this ).html());
		
	});
	
	// any modules templrary placeholders?
	$("#k_TempSave .keditPlaceholder").each(function() {
		
		// what's real module's code?
		var keditModule=$(this).find('span').text();
		$( this ).replaceWith(keditModule);
		
	});

	// #2 - remove all helpers
	
	$("#k_TempSave #k_EditActive").remove();
	//$("#k_TempSave .k_Edit").remove(); // removed by .kelement already
	
	// #3 - remove template's helpers:
	
	$("#k_TempSave .adminTip").remove();
	
	// #4 - remove additional (system's) JavaScript
	
	$("#k_TempSave #jsMenusSetup").remove();
	
	$("#k_TempSave .kedit-drag-widget,#k_TempSave .kedit-data-widget").remove()
	
	var tempSave=$("#k_TempSave").html();
	$("#k_TempSave").remove();
	
	tempSave=tempSave.replace(' style="background:"','');
	
	return tempSave.trim();
	
	
	
}
function k_EditSave(refreshOption,loadingOption){
	
	keditableToolbar('hide'); // hide WYSIWYG toolbar.
	if($(".WxEditableArea").hasClass('WxNoSave'))return true;
	
	// if there's any "don't leave" warning, remove it.
	
	$(window).unbind('beforeunload');
	$(window).on('beforeunload', function(){
         kopage_showLoading('unload');
	});
	
	
	$("#dragHelper").attr('rel','');
	
	// first cancel any block, which is currently being edited:
	k_EditCancel();
	
	// save new content & refresh page.
	
	if(loadingOption!='noloading')
	kopage_showLoading();
	
	// make it not sortable anymore...
	//$( ".WxEditableArea" ).sortable( "destroy" );

	$('.blockKeditActive').removeClass('blockKeditActive');
	$('.keditModuleEditPlaceholder').removeClass('keditModuleEditPlaceholder');
	
	var postNewContent=new Object(),tempSave=null;
	
	
	$("#contentArea,#footerContent,#headerContent").each(function() {
		
		// load filtered content (no admin helpers)
		tempSave=k_RawHTML(this);
	
		//alert('yay' + tempSave)
		
		if(tempSave.trim() == '' && this.id=='contentArea')
			tempSave='<div class="kedit">{%sitemap%}</div>';

		
		postNewContent[this.id]=tempSave.trim();
		tempSave=null;
		
	});
	
	
var tempData="supermode=configUpdate&liveEdit=1&liveOption=subpage&pageMenuId="+menuMenuId+"&pageId="+menuPageId
	 //+"&content="+encodeURIComponent(postNewContent.trim()),//
	 +"&contentJSON="+encodeURIComponent(JSON.stringify(postNewContent));
		//alert(tempData)
	jQuery.ajax({
	 type: "POST",
	 url: "admin.php",
	 data: tempData,
	 success: function(data){
		
			if(loginFirst(data)){
				
				
				// user isn't logged in, try to restore this content.
				
				return;
				
			}
			
			if(data == 'OK'){
			
				if(refreshOption=='norefresh'){
					// don't refresh, just hide loading page
					kopage_hideLoading();
				}else{
				
					refreshWindow();
				
				}
				
		 	}else if(data == 'OK-REFRESH'){
			
				refreshWindow();
				
				
		 	}else {
			
			
				if(data.length < 2000)
					alert(data);
				else
					alert('ERROR when saving.')
				
			}
			
		}
	});
	
	postNewContent=new Object();tempData=null;
	
	
	
}

$.extend($.expr[':'], {
  'containsi': function(elem, i, match, array)
  {
    return (elem.textContent || elem.innerText || '').toLowerCase()
    .indexOf((match[3] || "").toLowerCase()) >= 0;
  }
});

function kopage_keyFilter(i,j){
	
	var ph=$(i).val();
	
	if(ph == '')
	$(j+' li').show();
	else {
		
	$(j+' li').hide();
	$(j+' li:containsi('+ph+')').show();
	
	}
	
	// 
	
}

function kopageToolbarTabs_newContent(w){
	
	var keditSeparatorId=ID();
		
	if(typeof w === "undefined"){
		
		var keditSeparatorSelector=$('.WxEditableArea');
		keditSeparatorSelector.prepend('<div class="keditSeparator kelement" id="'+keditSeparatorId+'"></div>');
	
	} else {
	
		var keditSeparatorSelector=$('.WxEditableArea #'+w);
		keditSeparatorSelector.before('<div class="keditSeparator kelement" id="'+keditSeparatorId+'"></div>');
	
	}
	keditSeparatorMore(keditSeparatorId)
}

function keditSeparatorAdd(t,i){
	
	if(inlineAdd.indexOf('contentArea')>-1){
		
		if(inlineAdd.indexOf('/')>-1){
		$("#contentArea").append('<div class=keditItem></div>');
		}else{
		$("#contentArea").prepend('<div class=keditItem></div>');
		}
	} else 
	$("#"+inlineAdd).replaceWith('<div class=keditItem></div>');
	$("html, body").animate({ scrollTop:$(".keditItem").offset().top-100 });
	keditExtraAdd(t);keditSeparators();
	
	$('body').removeClass('kopageEditingMode');
	kopageToolbar('hide');
	kopage_hideFrame();
	
}

function keditSeparatorModal_add(i,ii){
	
	
	if(ii == 'gallery'){
			
		var galleryEffect=$("input[name=galleryEffect]:checked").val();
		var galleryId=$("#galleryId_"+i).val();
		
		if(galleryEffect == 2)
		galleryId+=',slideshow';
		else if(galleryEffect == 3)
		galleryId+=',collage';
		
		// now subpages options
		else if(galleryEffect == 20)
		galleryId+=',vertical';
		else if(galleryEffect == 21)
		galleryId+=',horizontal';
		
			
		if(inlineAdd.indexOf('contentArea')>-1){
			
			if(inlineAdd.indexOf('/')>-1){
			$("#contentArea").append('<div class=keditItem></div>');
			}else{
			$("#contentArea").prepend('<div class=keditItem></div>');
			}
		} else 
		$("#"+inlineAdd).replaceWith('<div class=keditItem></div>');
		
		
		//$("#keditSeparatorAdd").replaceWith('<div class=keditItem></div>');
		//koZeroPadding alert('{%gallery_'+galleryId+'%}');//return true;
		updateNewKeditItem('{%'+galleryId+'%}','save');
		keditSeparators();
	
	}
	
}
		
function keditSeparatorModal(i){
	
	
	$('#keditSeparatorAdd').append('<div id="keditSeparatorModal" style="z-index:999;position:absolute;top:50px;left:0;bottom:0;right:0;background:#fff;padding:0;"><span style="padding:30px;">'+_langPreloading+'</span></div>');
	
	$(".keditMoreContent").css('opacity',0)

	var mcontents='';
	
	if(i=='gallery'){
		

		jQuery.ajax({
				 type: "POST",
				 url: "admin.php",
				 data: "supermode=moduleInfo&liveEdit="+encodeURIComponent(i),
				 success: function(data){
					 
					 if(loginFirst(data))return;
	  
						  if(loginFirst(data)){
							$("#keditSeparatorModal").remove();
							return;
						  }
					 
						  var addNewModule='';
						  var modulesCount=0;
						  if(data.indexOf('|') == 0){
							  
							  var d=data.split('|');
							  var dlist='';
							  var dd='';
							  var ii=d.length;
							  var c=0; // count items
							  
							  
							  for(i=0;i<ii;i++){
								  
								  if(d[i].length>0){
									  
									c++; 
									dd=d[i].split('#');
									
									if(typeof dd[1] === 'undefined')
										dd[1]=dd[0];
										
									if(dd[1] == 'gallery')
									continue;
									
									dlist+='<input type="radio" name="galleryId" id="galleryId_'+i+'" value="'+dd[1]+'"><label class="koBg2Hover" onclick="keditSeparatorModal_add('+i+',\'gallery\')" for="galleryId_'+i+'"><span>'+dd[0]+'</span></label>';

									modulesCount++;
									
								  } 
								  
							  } 
							  							  
						
								mcontents+='<h3 class="koBg3" style="text-align:left;">'+langPhrase.galleryAdd+'</h3>';
								mcontents+='<div style="padding:30px;overflow:auto"><h4>'+langPhrase.galleryEffect+'</h4>';
								
								mcontents+='<input type="radio" name="galleryEffect" id="galleryEffect1" value="1" checked="checked"><label class="koBg2Hover"" for="galleryEffect1"><span>'+langPhrase.galleryDefault+'</span></label>';
								mcontents+='<input type="radio" name="galleryEffect" id="galleryEffect2" value="2"><label class="koBg2Hover"" for="galleryEffect2"><span>'+langPhrase.gallerySlideshow+'</span></label>';
								mcontents+='<input type="radio" name="galleryEffect" id="galleryEffect3" value="3"><label class="koBg2Hover" for="galleryEffect3"><span>'+langPhrase.galleryCollage+'</span></label>';
								
								mcontents+='</div>';
								mcontents+='<div style="padding:0 30px 30px;overflow:auto"><h4>'+langPhrase.galleryChoose+'</h4>';
								mcontents+=dlist;
								mcontents+='</div>';
								
								
								
							  jQuery("#keditSeparatorModal").html(mcontents);
							  
						  } else alert(data)
					}
				});

		
	}
	else if(i=='submenu'){
		

		jQuery.ajax({
				 type: "POST",
				 url: "admin.php",
				 data: "supermode=moduleInfo&liveEdit="+encodeURIComponent(i),
				 success: function(data){
					 
					 if(loginFirst(data))return;
	  
						  if(loginFirst(data)){
							$("#keditSeparatorModal").remove();
							return;
						  }
					 
						  var addNewModule='';
						  var modulesCount=0;
						  if(data.indexOf('|') == 0){
							  
							  var d=data.split('|');
							  var dlist='';
							  var dd='';
							  var ii=d.length;
							  var c=0; // count items
							  
							  
							  for(i=0;i<ii;i++){
								  
								  if(d[i].length>0){
									  
									c++; 
									dd=d[i].split('#');
									
									if(typeof dd[1] === 'undefined')
										dd[1]=dd[0];
										
									if(dd[1] == 'menu')
									continue;
									
									dlist+='<input type="radio" name="galleryId" id="galleryId_'+i+'" value="'+dd[1]+'"><label class="koBg2Hover" onclick="keditSeparatorModal_add('+i+',\'gallery\')" for="galleryId_'+i+'"><span>'+dd[0]+'</span></label>';

									modulesCount++;
									
								  } 
								  
							  } 
							  
						////MOD_MENU_MENU SubpagesMenu
								mcontents+='<h3 class="koBg3" style="text-align:left;">'+langPhrase.menuAdd+'</h3>';
								mcontents+='<div style="padding:30px;overflow:auto"><h4>'+langPhrase.displayMenu+'</h4>';
								
								mcontents+='<input type="radio" name="galleryEffect" id="galleryEffect1" value="20" checked="checked"><label class="koBg2Hover"" for="galleryEffect1"><span>'+langPhrase.vertical+'</span></label>';
								mcontents+='<input type="radio" name="galleryEffect" id="galleryEffect2" value="21"><label class="koBg2Hover"" for="galleryEffect2"><span>'+langPhrase.horizontal+'</span></label>';
								
								mcontents+='</div>';
								mcontents+='<div style="padding:0 30px 30px;overflow:auto"><h4>'+langPhrase.menuChoose+'</h4>';
								mcontents+=dlist;
								
								mcontents+='<input type="radio" name="galleryId" id="galleryId_'+i+'" value="'+dd[1]+'"><label class="koBg1Hover" onclick="keditSeparatorMore(0);kopage_showFrame(null,\'admin.php?e=menu\')" for="galleryId_'+i+'"><span><i class="fa fa-plus"></i> '+langPhrase.menuAdd+'</span></label>';


								mcontents+='</div>';
								
								
								
							  jQuery("#keditSeparatorModal").html(mcontents);
							  
						  } else alert(data)
					}
				});

		
	}
	
	
	
}


/* REMOVED since 3.1: function keditSeparatorMore(t){}
 but it's still called in some places...  */
function keditSeparatorMore(t){
	
	kopageToolbar('hide');
	kopage_hideFrame();
	
	if(t === 0){
		
		$('body').removeClass('kopageEditingMode');
		$("#keditSeparatorAdd").remove();
		//$("#keditSeparatorAdd").slideUp(function(){$("#keditSeparatorAdd").remove();keditSeparators();$('.kopageStartGears').animate({'margin-left':0,'opacity':1},200);})
		
		
		return;
		
	}	

}

function keditSeparators(kedit,theId,w){


	var allSetup=false;
	if(typeof kedit === "undefined"){
		
		// first, remove any existing separators,
		// so there's space for new.
		$(".keditSeparator").remove();
		
		kedit=$(".kedit");
		allSetup=true;
		
	}
		
	$(kedit).each(function(i){
	
		var theId=ID();
		$(this).before(keditSeparatorCode(theId));//keditSeparatorMore(this)
		
	});
	
	
	
	if(allSetup){
	
		$('.k_EditEmpty').remove();
		if($('#headerContent .kedit').length == 0)
		$('#headerContent').append(keditSeparatorCode(null,'k_EditEmpty'));
		
		if($('#footerContent .kedit').length == 0)
		$('#footerContent').append(keditSeparatorCode(null,'k_EditEmpty'));
		
		if($('#contentArea .kedit').length == 0)
		$('#contentArea').append(keditSeparatorCode(null,'k_EditEmpty'));
		
		//if(w_type == 'h')
		//$('#headerContent').append('<div class="kelement k_EditEmpty">'+keditSeparatorCode()+'</div>');
		//else if(w_type == 'f')
		//$('#footerContent').append('<div class="kelement k_EditEmpty">'+keditSeparatorCode()+'</div>');

	}
	
	
		
		//keditSeparatorMore
		//kopageToolbarTabs_newContent
		
	
	
	
}




function keditAddItem(k,t){
	
	if($("#"+_id).length>0){
	$("#"+_id).replaceWith('<div class="keditItem"></div>');
	} else {
	$('.WxEditableArea').prepend('<div class="keditItem"></div>');
	}
	
	
}



// function called when new object is added,
// via updateNewKeditItem() function.

function keditDraggable(kedit,kedit_opt){

	var i = 'kpg_'+Math.round(1000000*Math.random());
	
	var co = $(kedit).html();
	$(kedit).attr("id",i);co='';
	
	if(typeof kedit_opt !== 'undefined' && kedit_opt == 'noedit'){
		
		// only cancel editor if it was initiated already...
		k_EditCancel();
		
	}else {
		
		if($(kedit).parents('#headerContent').length>0)
		keditPrepare(kedit,'header');
		else if($(kedit).parents('#headerContent').length>0)
		keditPrepare(kedit,'footer');
		else
		keditPrepare(kedit);
			
		if($("#"+i).hasClass('keditRow')){
			
			// instead editing, refresh sortables & draggables.
			setupDraggableAndSortable();
			keditPrepare(kedit.find('.kedit'));
			
		}
		
		kopage_hideLoading();
			//keditPrepare("#"+i);
			// new editing, setup content-editables
			//initKeditable(i);
			
			// update separators
			//keditSeparators();
			
			
			// this function will make contents editable,
			// then setup k_EditInit() function, which creates toobaox for each .kedit,
			// then setup keditSeparators()
			//keditPrepare("#"+i);//keditPrepare(kedit);
			
			/*setTimeout(function(){
				$('.k_Edit').remove();
				keditPrepare('#contentArea .kedit');
				keditPrepare('#footerContent .kedit');
				keditPrepare('#header .kedit');
			},500);*/
		
		
	}
	
	// and now close the contents window...
	//kopage_openSettings('Content');

	$('#k_Content,#k_Modules').removeClass('k_slideIn');
	$("#kopageLeftToolbar a").removeClass('kt_slideIn');
	//$("#kopageLeftToolbar").removeClass('kopageLeftToolbarOpen');
	
}


// user is no longer logged in,
// cancel what he was trying to do
// and open LOGIN modal

function loginFirst(data){
	
	if(data == '<!--LOGIN-->'){
		
		// user isn't logged in.
		
		basicModal.show(modalLogin);
		kopage_hideLoading();
		
		// now hide all opened windows, popups, etc.
		
		// if user tried to drag a module/content:
		$('#kedit_modulePromptClose').trigger('click');
		
		// if user tried to open files manager
		jQuery('#modal-FManager').modal('hide')
		
		// if anything was dragged here, cancel it
		updateNewKeditItem(null,"cancel");
		
		// if user was editing some content block (TinyMCE is active),
		// cancel this, so it's inactive & modals are gone.
		// ...or maybe not.
		
		return true;
		
			
	} else
		return false;
	
}

// refresh user's session, so it'll not expire too soon,
// simply make an ajax request every 5 minutes,
// as long as user has this window opened.

function refreshSession(){
	
	// function will refresh user's session, so he is not logged in automatically.
	
	// clear timeout in case if this function was called twice
	// - here and from an iframe
	clearTimeout(refreshTimeout);
	
	if($("#k_FrameOverlay").is(":visible")){
		
		// frame is already visible. Just reset timeout to try again later...
		refreshTimeout=setTimeout('refreshSession()',sessionRefreshRepeat);
		return;
		
		
	}
		
	// show small "loading" on bottom-left corner
	$("#kopageSessionRefresh").fadeIn();
	
	// Make an AJAX request:
	// check if user is still logged in. If now: open login window.
	jQuery.ajax({
		type: "POST",
		url: "admin.php",
		data: "supermode=configUpdate&alive=1",
	 	success: function(data){
			
			$("#kopageSessionRefresh").fadeOut();
			
			if(data=='OK'){
				
				// All is fine. User is logged in.
				// Set timeout to make sure, this function 
				// is going to be called soon again.
				
				refreshTimeout=setTimeout('refreshSession()',sessionRefreshRepeat); // repeat every 5 minutes.
				 
			} else {
				
				// user isn't logged in anymore.
				
				loginFirst('<!--LOGIN-->');
				
			}
			
		}
	});
	
	
	
}


// this function is called when page is loaded,
// but also when new items are added to content areas.
// 
// it makes ".kedit" blocks sortable.

function setupDraggableAndSortable(){
	
	
	jQuery( "#contentArea,.keditColumn,#headerContent,#footerContent" ).sortable({
					
			items: ".kedit",
			handle: ".k_Move",
			opacity: 1,   
			helper: "clone", 
			
			forceHelperSize:true,
			forcePlaceholderSize:true,	
			
			placeholder: "wxSortPlaceholder",	
			connectWith: sortablesConnectedTo,
			tolerance: "pointer",
			
			zIndex: 65558,
			start: function(event, ui) {
				
				//$(this).sortable( "refreshPositions" );
				$("body").addClass('kopageEditableActive');
				
			},
			//:
			//:
			stop: function(event, ui) {
				
				$("body").removeClass('kopageEditableActive');
				$(".kopageEditableActiveItem").removeClass('kopageEditableActiveItem');
				
			},
			update: function(event, ui) {
				

				// when done, make sure user will know 
				// he has to save changes...
				
				if(draggableType == 'new'){
					draggableType = '';
				} else {
					setTimeout("k_EditSave('norefresh')",300);
				}
				
				// hide toolbar if opened
				kopageToolbar('hide');
				
				// setup block separators 
				// - they allow adding content above blocks
				
				keditSeparators();
			}
		
	});
	
	$('body').removeClass('keditLoading');
	
}

function kopage_addNewModule(module,modulesCount){

  var newModuleName=$("#newModuleName").val();
  
  // make an AJAX call to create a new module:
  jQuery.ajax({
		 type: "POST",
		 url: "admin.php",
		 data: "supermode=moduleAdd&liveEdit="+encodeURIComponent(module)+"&liveEditName="+encodeURIComponent(newModuleName),
		 success: function(data){
			 
			 if(loginFirst(data))return;
			 
			 
			 if(data.indexOf('|') > 0){
				 
				 data = data.split('|');
					 
				 if(data[0] == 'OK'){
					 
					 
					 // SUCCESS! 
					 // New module has been added.
										 
					 // Replace temporary tag with new module name received from AJAX,
					 // in case if user typed some incorrect characters or system changed name
					 // to avoid duplicates:
					 
					 updateNewKeditItem('{%'+module+'_'+data[2]+'%}','noedit'); // add our tag, but don't save just yet
					 
					 // close this prompt:
					 $('#kedit_modulePrompt').fadeOut();
					 
										 
					 // now it should open a lightbox to start editing:
					 kopage_showFrame('','admin.php?p=quickEdit&module='+data[1]+'&action=new&lmode=light&id='+data[2]+'&fid='+data[2]+'&nid='+data[2]+'&item='+data[2]);
													
													
				 }
				 
			 }
			 
			 
			 
		 }
  });
					
					
  //alert('will add '+module+' named '+newModuleName);
  
  // TEST. Let's say module is added: skipping admin's area things,
  // what happens now:
  
  
  		  
										  
						 
								 
								 
  
}

function kopageEmbedHTML(){
							
	jQuery.ajax({
	 type: "POST",
	 url: "admin.php",
	 data: "supermode=configUpdate&liveEdit=1&liveEditEmbed="+encodeURIComponent($("#kedit_EmbedHTML").val()),
	 success: function(data){
		 
		 if(loginFirst(data))return;
		 
		 
		 if(data.indexOf('|') > 0){
			 
			 data = data.split('|');
				 
			 if(data[0] == 'OK'){
				 
				updateNewKeditItem('{%'+data[1]+'%}','save');
				$("#kedit_modulePrompt").fadeOut();
				 
			 }
			 
			 
		 }else
			alert(data);
			
	 }});


}

function saveCustomThemeCode(){
		
	kopage_showLoading();
	
	// make ajax request
	jQuery.ajax({
		 type: "POST",
		 url: "admin.php",
		 data: "supermode=configUpdate&iSplashTheme="+templateId+"&iSplash=1&iSplashElement=customCode&content="+encodeURIComponent($("#customThemeCode").val()),
		 success: function(data){
			 
			 if(loginFirst(data))return;
			 
			 if(data == 'OK'){
				 
				refreshWindow('open=info-saved');
				
			 }
			 
		 }
	});
				
				
}	

function kopage_hideFrame(){
	
	$('a.kopageToolbarTabsClose,a.kopageToolbarTabsApply,a.kopageToolbarTabsRemove').css({'left':''})
	
	// make BODY scrollable again.
	$("html, body").css('overflow','auto');
	
	$("#kopageToolbarMoreSettings").attr({'class':null,'style':null});
	$("#kopageToolbarMoreSettings").hide();//addClass('animated fadeOutLeft');

	$("#kopageMoreFrame iframe").remove();
	$("#kopageMoreFrame #kopageColors").remove();
	
	$("#kopageFManager,.kopageMoreFrameClose_HTML,.kopageMoreFrameSave_HTML").hide();
	keditableToolbar('hide');
	
}

function kopage_manageModules(){
	
	kopage_showFrame('manage_modules');	
	
}

function kopage_hideSettings(){
	kopage_hideFrame();
	kopageToolbar('hide')
}

function kopage_openSettings(w){
	
	
	
	$(".kopageLeftToolbar").removeClass('k_slideIn');
	$("#kopageLeftToolbar a").removeClass('kt_slideIn');
	
	if(w == 'closeAll')
		return;

	if(w=='Fonts'){
		
		$("#ko_font1,#ko_font2").on('change',kopage_pageFonts);
	
	
	}
		
	// visible. Hide.
	if($('#k_'+w).position().left>0){
		
		
		// hide.	
		$('#k_'+w).removeClass('k_slideIn');
		
		if(w=='Colors')
			$("#colorSchemeStyle").html('')
		
	} else {
		
		$('#k_'+w).addClass('k_slideIn');
		$('#kt'+w).addClass('kt_slideIn');


		// now slide window to get the correct position:
		var ww='body',wfix=0;
		
		if(w == 'Content'||w == 'Sidebar'||w == 'Modules'){
			ww = '#content';
			wfix = 50;
		}else if(w == 'Footer')
			ww = '#footer';
		
		
		$('html, body').animate({
                        scrollTop: $(ww).offset().top-wfix
        });
					
	}
		
	
}

// Quick Save: Website Configuration (title/logo)
function kopage_pageSettings(){
	
	kopage_showLoading();
	
	// make ajax request
	
	jQuery.ajax({
	 type: "POST",
	 url: "admin.php",
	 data: "supermode=configUpdate&liveEdit=1&liveOption=config&title="+encodeURIComponent($("#k_websiteTitle").val())+"&slogan="+encodeURIComponent($("#k_websiteSlogan").val())+"&logo="+encodeURIComponent($("#k_websiteLogo").val()),
	 success: function(data){
		 
		 if(loginFirst(data))return;
		 
		 if(data == 'OK'){
			 
			refreshWindow();
			
		 }else
			alert(data);
			
		}
	});
	
}

function kopage_colorSettings(){
	
	
	kopage_showLoading();
	
	// make ajax request
	
	jQuery.ajax({
	 type: "POST",
	 url: "admin.php",
	 async: false,
	 data: "supermode=configUpdate&liveEdit=1&liveOption=colors&colorSchemeTemplate="+templateId+"&colorScheme="+encodeURIComponent($("#colorScheme").val()),
	 success: function(data){
		 
		 if(loginFirst(data))return;
		 
		 if(data == 'OK'){
			 
			refreshWindow();
						
		 }else
			alert(data);
			
		}
	});
	
	// and now hide window & apply changes for user's view
	
}

function kopage_menuSettings(){


jQuery.ajax({
	 type: "POST",
	 url: "admin.php",
	 data: "supermode=configUpdate&liveEdit=1&showInMenu="+encodeURIComponent($("#menuShowThisSubpage:checked").length)+"&pageId="+menuPageId+"&pageMenuId="+menuMenuId+"&pageName="+encodeURIComponent($("#k_subpageName").val()),
	 success: function(data){
		 
			  if(loginFirst(data))return;
			  
			  if(data == "OK"){
			
				kopage_showLoading();
				refreshWindow();
			  
			  }else{
				  
				alert(data)
				
			  }
		}
});
	
return;

}

function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function changeMenuStyle(i){
	
	// quick reset
	$('#headerMenu').removeClass('koMenu1 koMenu2 koMenu3 koMenu4 koMenu5 koMenu6 koMenu7 koMenu8 koMenu9 koMenu9');	
	
		var saveElement='menuClass';
		var saveElementValue='';
		
	if(i > 0){
	
		if(i == 10){
			
			var saveElementValue='koMenu4 koMenu10';
			
		} else
		var saveElementValue='koMenu'+i;
		$('#headerMenu').addClass(saveElementValue);	
				
	}
	saveToTheme(saveElement,saveElementValue,1);//
	
	// now hide toolbar:
	kopageToolbar('hide')

	
}

var logoAlignClass=$('#website').attr('class').toLowerCase();
	
function changeMenuLayout(i){
	
	// quick reset
	$('#website').removeClass('logoCentered logoRight logoLeft');	
	
	
		var saveElement='headerClass';
		var saveElementValue='';
		
	if(i==1){
	
		var saveElementValue='logoLeft';
		$('#website').addClass(saveElementValue);
		
	}else if(i==2){
	
		var saveElementValue='logoCentered';
		$('#website').addClass(saveElementValue);	
		
	}else if(i==3){
	
		var saveElementValue='logoRight';
		$('#website').addClass(saveElementValue);	
		
	}
	
	logoAlignClass=saveElementValue.toLowerCase();	
	
	saveToTheme(saveElement,saveElementValue);
	
	// now hide toolbar:
	kopageToolbar('hide')

	
}
	
	function kopageBlockClone(l){
	
	$('#kopageBlockCopy').hide();
	var blockObject=$("#"+keditBlockId),newId='kedit_'+ID();
	$("body").append('<div id="cloneBlock" style="display:none"></div>');
	$( blockObject ).clone().attr('id',newId).appendTo( "#cloneBlock" );
	var copyHTML=k_RawHTML($("#cloneBlock"));
	$("#cloneBlock").remove();
	
	if(typeof l === "string"){
		// copying to another page.
		
		
		var copyToPage=l.split('_');
		if(copyToPage[0]>0 && copyToPage[1]>0){
			
			// it's corrrect, continue with AJAX request
					
			jQuery.ajax({
			 type: "POST",
			 url: "admin.php",
			 data: "supermode=configUpdate&cloneToPage="+encodeURIComponent(copyToPage[0]+'-'+copyToPage[1])+"&blockHTML="+encodeURIComponent(copyHTML),//
			 success: function(data){
				 
				 if(data == 'OK'){
					
					// redirect:
					window.top.location='index.php?p='	 +copyToPage[0]+'_'+copyToPage[1];
					 
				 } else alert(data)
			 }});
			
			
		}
		
		
	} else {
			
		blockObject.before(copyHTML);
		kopageToolbar('hide');
		
		var newBlock=$("#"+newId);
		keditDraggable(newBlock);
		
		// now scroll to new element.
		var pos=newBlock.offset();
			
		if((Math.round(pos.top-60)-$(window).scrollTop()) <0){
			$("html, body").animate({ scrollTop:pos.top-100 });
		}
		
	}
			
}
	
		
function saveToTheme(saveElement,saveElementValue,refreshValue){
	
	
	jQuery.ajax({
	 type: "POST",
	 url: "admin.php",
	 data: "supermode=configUpdate&iSplashTheme="+templateId+"&iSplash=1&iSplashElement="+encodeURIComponent(saveElement)+"&pageMenuId="+menuMenuId+"&pageId="+menuPageId+"&content="+encodeURIComponent(saveElementValue.trim()),//
	 success: function(data){
		
		
			if(loginFirst(data)){
				
				// user isn't logged in, try to restore this content.
				return;
				
			}
		
			if(data == 'OK'){
			
				if(refreshValue == 1)refreshWindow();
				
			}else
				alert(data);
			
		}
	});
	
}

function changeTheme(i,ii){
	

	var forceRefresh=0;
	
	if($("html").hasClass('koTheme4') && i != 4){
		// current one was with sidebar, and it changes to topbar.
		forceRefresh=1;
	}else if (i == 4)
		forceRefresh=1;
	
		
	if(i > 0){
		
		var saveElement='htmlClass';
		var saveElementValue='koTheme'+i;
		
		$("html").attr('class',saveElementValue);
		
	}else{
		
		var saveElement='bodyClass';
		var saveElementValue='koTheme'+i;
		
		if(i == 'Dark' && ii == true)
			$("body").addClass(saveElementValue);
		if(i == 'Dark' && ii == false){
			$("body").removeClass(saveElementValue);
			saveElementValue='';
		}
	
	}
	
	saveToTheme(saveElement,saveElementValue);
	
	// now hide toolbar:
	kopageToolbar('hide');
	
	if($("ul.dropmenudiv").length > 0 && forceRefresh > 0){
		
		// refresh to re-init submenu
		refreshWindow();
		
		
	}
		
	
}

function kopage_blockRemove(){
	
	var blockID=$('#blockId').val();
	kopage_hideSettings();
	
	// hide WYSIWYG toolbar if exists:
	keditableToolbar('hide');
	
	$("#"+blockID).slideUp(function(){
		
		$("#"+blockID).remove();
		// save changes with no refresh required:
		setTimeout(function(){k_EditSave('norefresh','noloading');
		
		
					// if all items from this block were removed, 
					// add placeholders.
					
					$('.k_EditEmpty').remove();
					
						if($('#headerContent .kedit').length == 0)
						$('#headerContent').append(keditSeparatorCode(null,'k_EditEmpty'));
						
						if($('#footerContent .kedit').length == 0)
						$('#footerContent').append(keditSeparatorCode(null,'k_EditEmpty'));
						
						if($('#contentArea .kedit').length == 0)
						$('#contentArea').append(keditSeparatorCode(null,'k_EditEmpty'));
						
						},500)
	
	});
	
}
		
function kopage_videoSettings(){
	
	var videoSource=kopageEmbedVideo($('#k_videoPath').val(),1);
	
	if(!videoSource) return false;

	var im=$(inlineEditItem).parent().find('iframe');
	
	// update video's SRC
	im.attr('src',videoSource);
	
	// hide toolbars & save changes.
	k_EditSave('norefresh');
	kopage_hideSettings();
	
}

function kopage_imageSettings(){
	
	
	var im=$(inlineEditItem).parent().find('img');
	
	// update image's SRC
	im.attr('src',$('#k_imagePath').val());
	
	
	// link-related actions now.
	// check if image is already a link or not, and what user has set now,
	// to make it no link or to update link href.
	
	// is it a link now?
	var linkSwitch = $('#k_imageLinkHrefSwitch').prop('checked');
	var imlink=im.parent().parent();
	
	//alert(linkSwitch + " / " + imlink.prop('tagName') )
	if(imlink.prop('tagName') == 'A'){
		
		// yes, it's already a link. Update link href or if switch is now OFF, 
		// remove this link.
		if(linkSwitch == true){
			
			imlink.attr('href',$("#k_imageLinkHref").val())
						
		}else{
			
			$(imlink).replaceWith(imlink.html());
			
		}

		
	} else {
		
		// not a link yet. Did user switch ON link control?
		
		if(linkSwitch == true){
			
			imlink=im.parent();
			$(imlink).wrap('<a href="'+$("#k_imageLinkHref").val()+'"></a>');
						
		}
		
		
	}
	
	
	
	
	
	// hide toolbars & save changes.
	k_EditSave('norefresh');
	kopage_hideSettings();
	
}

function kopage_linkSettings(){
	
	var lk=$(inlineEditLink).parent('a');
	
	
	if($('#k_linkHrefType:checked').val()>0){
	    lk.attr('href',$("#k_linkPage").val()); 
	} else {
		
		var linkHref=$("#k_linkHref").val();
		if(linkHref.indexOf('www.') === 0){
			linkHref='http://'+linkHref;
		}
		
    	lk.attr('href',linkHref);  
	}
	
	if($('#k_linkBlank:checked').val()>0){
		lk.attr('target','_blank'); 
	} else {
		if(lk.attr('target')=='_blank')lk.attr('target',null);
	}
	
	var lkSpan=lk.find('span');
	var lkEm=lk.find('em');
	
	if($('#k_linkTitle').length>0 && lkSpan.length>0){
		
		//<a href="#"><em style="background-image:url('../_page3/editor_images/img2.svg')"></em><span><strong>Supersite</strong>Sed pede 
		lkSpan.html('<strong>'+$("#k_linkTitle").val()+'</strong>'+$("#k_linkText").val());
		
		if($('#k_linkImage').length>0 && lkEm.length>0){
			lkEm.css("background-image","url("+$('#k_linkImage').val()+")");
		}
		
	}else{
		
		// there's link title to be added
		lk.html($("#k_linkText").val());  
	
	}
	
	lk.editableLinks();
	
	
	k_EditSave('norefresh');
	kopage_hideSettings();
	
}

function kopage_blockSettings(o){
	
	// 
	
	var blockId = keditBlockId;
	//var blockId=$("#blockId").val();
	var blockBackground=$('#blockBackground').val();
	var blockImage=$('#blockBackgroundImage').val();
	
	var blockStyle='';
	var blockData='';
	var blockClass='';
	
	//alert(o+'/' + blockId);return false
	
	$("#"+blockId).css('box-shadow',null)
	if(blockBackground.length > 0){
		
		// set background color to the block;
		$("#"+blockId).attr('data-bgcolor',blockBackground)//.css('background-color',blockBackground)
		blockStyle=blockBackground;
		blockData+=' data-bgcolor="'+blockBackground+'"';
		
	}else
		$("#"+blockId).attr('data-bgcolor',null)
	
	
	if(blockImage.length > 0){

		// set background color to the block;
		$("#"+blockId).attr('data-background',blockImage);//.css({'background':blockBackground+' url('+blockImage+') no-repeat center center','background-size':'cover'})
		///background:url(2.jpg) no-repeat center center;background-size:cover
		
		blockStyle=blockStyle+' url('+blockImage+') no-repeat 50% 0px;background-size:cover';
		blockData+=' data-background="'+blockImage+'"';
		
	}else
		$("#"+blockId).attr('data-background',null);//.css({'background':'','background-size':''})

	
		if($('#blockParallax:checked').length>0){
			blockData+=' data-parallax="1" ';
			blockClass+=" parallax-window "
		}
		
		
		if($('#blockDark:checked').length>0){
			blockClass+=" keditDark "
		}
		
		if($('#blockZeroPadding:checked').length>0){
			blockClass+=" koZeroPadding "
		}
		
		
		// header auto height
		//if($('#blockSplashHeight:checked').length == 0){
		//	blockClass+=" koHeaderAutoHeight "
		//}
		
		
		// show/hide header
		//if($('#blockSplashShow:checked').length == 0){
		//	blockClass+=" koHeaderHide "
		//}
		
	if($("#"+blockId).hasClass('keditLeft') && blockId!='headerContent'){
		
		
		blockData+=' data-align="keditLeft" ';
			blockClass+=" keditLeft ";

		
	} else if($("#"+blockId).hasClass('keditRight') && blockId!='headerContent'){
		
		blockData+=' data-align="keditRight" ';
		blockClass+=" keditRight ";

		
	}


	if($('#blockFilter:checked').val()>0){
		
		blockClass+=' kfilter'+$("#blockFilterOption").val()+' ';
		
	}
	
	
	

	if(blockClass.length > 0)
	blockClass=' class="'+blockClass+'"';
	
	if(blockId != 'body')
	blockData+=blockClass;
	
		
		
	$("#"+blockId).attr('style','background:'+blockStyle);


	// if it's a template-configurable block (like splash-banner or footer),
	// send new changes to template configuration file too:
	//alert('will save headerData & headerFilter:'+"\n"+'style="background:'+blockStyle+'"'+"\n"+blockData)
	
	//alert(blockData+"\n\n"+blockClass);return;
	
	if(blockId == 'footerContent'){
		var saveElement='footerData';
		saveToTheme(saveElement,blockData+' style="background:'+blockStyle+'"')
	}else if(blockId == 'body'){
		var saveElement='bodyData';
		saveToTheme(saveElement,blockData+' style="background:'+blockStyle+'"')
	}else if(blockId == 'headerContent'){
		var saveElement='headerData';
		
		saveToTheme(saveElement,blockData+' style="background:'+blockStyle+'"')
		
		//if($('#blockFilter:checked').length>0)
			//var headerFilter='<div class="filter"></div>';
		//else
		var headerFilter=' ';
		//
		saveToTheme('headerFilter',headerFilter)

	}


	//headerContent
	
	
	// save changes to file.
	k_EditSave('norefresh');
	
	// now hide toolbar.
	if(o != 1)
	kopage_hideSettings();
		
}

function kopageBlockInit(){
	
	var blockId = keditBlockId;
	var block = $("#"+blockId);	
	
	$("#blockFilterOptions").hide();
	
	if(blockId == 'footerContent'){
		$('#footerBlockSettings').show();
	}else{
		$('#footerBlockSettings').hide();
	}
	
	if($("#blockBackgroundImage").val().length == 0 || blockId == 'body'){
		
		// hide image's settings:
		//$("#blockParallaxCheckbox,#blockFilterCheckbox").hide();
		$("#blockParallaxCheckbox").hide();
		
	}else{
		
		// hide image's settings:
		$("#blockParallaxCheckbox").show();
		
	}
	
	$("#blockFilterCheckbox").show();
	
	$('.blockKeditActive').removeClass('blockKeditActive');
	if(blockId!='headerBanner') // headerBanner is hidding menu on some themes
	$("#"+blockId).addClass('blockKeditActive');	
		
	// now slide window to get the correct position:
	
	$('html, body').animate({
		scrollTop: $("#"+blockId).offset().top-100
	});

	if(typeof $('#'+blockId).attr('data-parallax') === 'undefined')
		$( "#blockParallax" ).prop( "checked", false );
	else
		$( "#blockParallax" ).prop( "checked", true );
		
	$('#kopageBlockBody_input').hide();
	
	// "dark background" option, is it enabled?
	if($("#"+blockId).hasClass('keditDark')){
		
		$( "#blockDark" ).prop( "checked", true );	
		
	}else
		$( "#blockDark" ).prop( "checked", false );	
	
	// does this block have zero-padding class?
	if($("#"+blockId).hasClass('koZeroPadding')){
		
		$( "#blockZeroPadding" ).prop( "checked", true );	
		
	}else
		$( "#blockZeroPadding" ).prop( "checked", false );	
	
	
	$("#blockZeroPaddingCheckbox").hide();
	if(blockId.indexOf('kpg_') > -1){
		
		var kBlockPaddingAlign=$("#kopageBlockAlign_input");
		kBlockPaddingAlign.show();
		kBlockPaddingAlign.find('a').removeClass('active');
		
		if(block.hasClass('keditLeft'))
		kBlockPaddingAlign.find('a:eq(0)').addClass('active');
		else if(block.hasClass('keditRight'))
		kBlockPaddingAlign.find('a:eq(2)').addClass('active');
		else
		kBlockPaddingAlign.find('a:eq(1)').addClass('active');
		
		
		
		// now check if it's not in use already then mark left/right options.
	
	} else
	
	$("#kopageBlockAlign_input").hide();
	
		
	$("#blockZeroPaddingCheckbox,#blockEditButton_HTML").show();
		
		
	if(blockId == 'footerContent'){
		
		$("#kopageBlockBody_input").show();//#splashBlockSettings,
		
		$("#blockMoreSettings_footer,#blockEditButton_HTML,#blockZeroPaddingCheckbox").hide();
		$("#blockMoreSettings_header,#blockMoreSettings_body").show();

		
	}
	if(blockId == 'headerContent'){
		
		$("#kopageBlockBody_input").show();//#splashBlockSettings,
			
		$("#blockMoreSettings_header,#blockEditButton_HTML").hide();
		$("#blockMoreSettings_footer,#blockMoreSettings_body").show();
		
		// splash options now: show/hide and height:
		//if($("#"+blockId).hasClass('koHeaderAutoHeight')){
		//	$( "#blockSplashHeight" ).prop( "checked", false );
		//} else {
		//	$( "#blockSplashHeight" ).prop( "checked", true );
		//}
		//if($("#"+blockId).hasClass('koHeaderHide')){
//			$( "#blockSplashShow" ).prop( "checked", false );
//			$("#blockSplashHeightCheckbox").hide();
//			$("#kopageBlockSettingsHolder").hide();
//			$("#kopageBlockContentsHolder").hide();
//		} else {
			//$( "#blockSplashShow" ).prop( "checked", true );
			//$("#blockSplashHeightCheckbox").show();
			//$("#blockSplashShowCheckbox").hide();
			$("#kopageBlockSettingsHolder").show();
			$("#kopageBlockContentsHolder").show();
			
			$("#splashBlockSettings").hide();
		//}
		
		
	
	} else {
		
		$("#splashBlockSettings").hide();
		$("#kopageBlockSettingsHolder").show();
		
	}
	
	//if(blockContents)
	//	$("#kopageBlockContentsHolder").show();
	//else
	//	$("#kopageBlockContentsHolder").hide();
		

	if(blockId == 'body'){
		
		$('#blockDarkCheckbox,#blockFilterCheckbox,#blockZeroPaddingCheckbox,#blockEditButton_HTML').hide();
		$('#blockEditButton,#blockColumnsNavigation').hide();
		
		
		$("#blockMoreSettings_body").hide();
		$("#blockMoreSettings_footer,#blockMoreSettings_header,#kopageBlockBody_input").show();
			
			
		
	} else 	if($("#"+blockId).hasClass('keditRow')){
		
		$('#blockEditButton').parent().hide();
		$('#blockColumnsNavigation').show()
		
		//$('#kopageBlockAlign_input').hide()
		
		



	}else{
		$('#blockEditButton').parent().show();
		$('#blockColumnsNavigation').hide();
	
		$('#blockEditButton').show();//#kopageBlockAlign_input,
		
	}

	
	


	
	var keditFilter=$("#"+blockId).attr('class');
	
	if(typeof keditFilter === "undefined")
		keditFilter="";
		
	
	keditFilter=keditFilter.toLowerCase();
	
	
	
	if(keditFilter.indexOf("kfilter") >= 0){
		$( "#blockFilter" ).prop( "checked", true );
		
		// now check which one filter was used
		keditFilter=keditFilter.split('kfilter');
		keditFilter=keditFilter[1].split(' ');
		keditFilter=keditFilter[0];
		
		$( "#blockFilterOption_" +keditFilter ).prop( "selected", true );		
		
	} else {
		$( "#blockFilter" ).prop( "checked", false );			
	}
		
		
}

function imageFilterCheck(opt){
	
	if(opt == 'video'){
		var theId='k_videoStyle';
		var im=$(inlineEditItem).parent().find('iframe');
	} else {
		var theId='k_imageStyle';
		var im=$(inlineEditItem).parent().find('img');
	}
	
	var blockId = $('#'+theId).val();
	im.removeClass('kimgfilter kimgfilter1 kimgfilter2 kimgfilter3 kimgfilter4 kimgfilter5 kimgfilter6 kimgfilter7');
	if($("#"+theId).val() > 0)
	im.addClass('kimgfilter'+$("#"+theId).val());
	
}

function blockFilterCheck(opt){
	
	var blockId = $('#blockId').val();
	$('#'+blockId).removeClass('kfilter1 kfilter2 kfilter3 kfilter4 kfilter5 kfilter6 kfilter11 kfilter12 kfilter13 kfilter14 kfilter15 kfilter16 kfilter21 kfilter22 kfilter23 kfilter24');
	
	if(opt == 1)
		$( "#blockFilter" ).prop( "checked", true );	
		
	if($('#blockFilter:checked').val()>0){
		
		$('#'+blockId).addClass('kfilter'+$("#blockFilterOption").val());
		
		//alert('setting class "kfilter'+$("#blockFilterOption").val()+'" to element #'+blockId)
		//$('#'+blockId).append('<div class="filter"></div>');
		
	}
	if(blockId == 'headerContent' || blockId == 'footerContent')
	kopage_blockSettings();
	else
	setTimeout("k_EditSave('norefresh');",500)
	
	
}

function blockParallaxCheck(){
	
	var blockId = $('#blockId').val();
	if($('#blockParallax:checked').val()>0){

		//alert('is checked, so setting parallax to '+blockId)
		$('#'+blockId).attr({'data-parallax':1}).addClass('parallax-window').parallax();
		
	} else {
		
		//alert('is NOT checked, so removing parallax from '+blockId)
		$('#'+blockId).attr({'data-parallax':null}).removeClass('parallax-window').parallax('destroy');
		
	}
	
	if(blockId == 'headerBanner' || blockId == 'footerContent')
	kopage_blockSettings();
	else
	setTimeout("k_EditSave('norefresh');",500)

	
}

function blockDarkCheck(){
	
	var blockId = $('#blockId').val();
	if($('#blockDark:checked').val()>0){

		$('#'+blockId).addClass('keditDark');
		
	} else {
		
		$('#'+blockId).removeClass('keditDark');
		
	}
	
	kopage_blockSettings();
}

function blockZeroPadding(){
	
	var blockId = $('#blockId').val();
		
	if($('#blockZeroPadding:checked').val()>0){

		$('#'+blockId).addClass('koZeroPadding');
		
	} else {
		
		$('#'+blockId).removeClass('koZeroPadding');
		
	}
	
	kopage_blockSettings();
}

function blockSplashHeightCheck(){
	
	var blockId = $('#blockId').val();
	if($('#blockSplashHeight:checked').val()>0){

		$('#'+blockId).removeClass('koHeaderAutoHeight');
		
	} else {
		
		$('#'+blockId).addClass('koHeaderAutoHeight');
		
	}
	
	kopage_blockSettings();
}

function blockSplashShowCheck(){
	
	var blockId = $('#blockId').val();
	if($('#blockSplashShow:checked').val()>0){

		$('#'+blockId).removeClass('koHeaderHide');
		$("#blockSplashHeightCheckbox").show();
		
	} else {
		
		$('#'+blockId).addClass('koHeaderHide');
		$('#'+blockId).removeClass('koHeaderAutoHeight');
		
		$("#blockSplashHeightCheckbox").hide();
		
		
	}
	
	kopage_blockSettings();
}


// Include RGBaster - https://github.com/briangonzalez/rgbaster.js
!function(n){"use strict";var t=function(){return document.createElement("canvas").getContext("2d")},e=function(n,e){var a=new Image,o=n.src||n;"data:"!==o.substring(0,5)&&(a.crossOrigin="Anonymous"),a.onload=function(){var n=t("2d");n.drawImage(a,0,0);var o=n.getImageData(0,0,a.width,a.height);e&&e(o.data)},a.src=o},a=function(n){return["rgb(",n,")"].join("")},o=function(n){return n.map(function(n){return a(n.name)})},r=5,i=10,c={};c.colors=function(n,t){t=t||{};var c=t.exclude||[],u=t.paletteSize||i;e(n,function(e){for(var i=n.width*n.height||e.length,m={},s="",d=[],f={dominant:{name:"",count:0},palette:Array.apply(null,new Array(u)).map(Boolean).map(function(){return{name:"0,0,0",count:0}})},l=0;i>l;){if(d[0]=e[l],d[1]=e[l+1],d[2]=e[l+2],s=d.join(","),m[s]=s in m?m[s]+1:1,-1===c.indexOf(a(s))){var g=m[s];g>f.dominant.count?(f.dominant.name=s,f.dominant.count=g):f.palette.some(function(n){return g>n.count?(n.name=s,n.count=g,!0):void 0})}l+=4*r}if(t.success){var p=o(f.palette);t.success({dominant:a(f.dominant.name),secondary:p[0],palette:p})}})},n.RGBaster=n.RGBaster||c}(window);

function blockContrastCheck(hexcolor){
	
	var r,g,b;
	
	if(hexcolor.indexOf(".") > -1){
		
		// it's not a hex color, but path to image
					
		RGBaster.colors(hexcolor, {
		  success: function(payload) {
			  
			b=payload.secondary.substring(4).replace(')','').split(',');
			r=parseInt(b[0],16);
			g=parseInt(b[1],16);
			b=parseInt(b[2],16);
		
			
			var yiq = ((r*299)+(g*587)+(b*114))/1000;
			var col = (yiq >= 180) ? 'black' : 'white';//128
			
			if(col == 'white')
				$( "#blockDark" ).prop( "checked", true ).trigger('change');	
			else
				$( "#blockDark" ).prop( "checked", false ).trigger('change');	
					
		  }});
		
		
	} else {
		
		// Take off the hash
		if(hexcolor.charAt(0)=="#")
		hexcolor = hexcolor.slice(1);
	 
		// Convert it to the right length if it is the shorthand
		if(hexcolor.length === 3) {
			hexcolor = hexcolor.replace(/([0-9a-f])/ig, '$1$1');
		}
	
		r = parseInt(hexcolor.substr(0,2),16);
		g = parseInt(hexcolor.substr(2,2),16);
		b = parseInt(hexcolor.substr(4,2),16);
		
		var yiq = ((r*299)+(g*587)+(b*114))/1000;
		var col = (yiq >= 180) ? 'black' : 'white';//128
		
		if(col == 'white')
			$( "#blockDark" ).prop( "checked", true ).trigger('change');	
		else
			$( "#blockDark" ).prop( "checked", false ).trigger('change');	
		
	}
	
	
		

}

function blockTextAlign(opt){
	
	var blockId = $('#blockId').val();
	var blockAlign;
	
	$('#'+blockId).removeClass('keditLeft keditRight keditCenter');
	
	var kBlockPaddingAlign=$("#kopageBlockAlign_input");
	kBlockPaddingAlign.find('a').removeClass('active');
	
	if(opt == 1){
		blockAlign='keditLeft';
		kBlockPaddingAlign.find('a:eq(0)').addClass('active');
	}else if(opt == 2){
		blockAlign='keditRight';
		kBlockPaddingAlign.find('a:eq(2)').addClass('active');
	}else if(opt == 3){
		blockAlign='keditCenter';
		kBlockPaddingAlign.find('a:eq(1)').addClass('active');
	}
	$('#'+blockId).attr({'data-align':blockAlign}).addClass(blockAlign);


	//if(blockId == 'headerContent' || blockId == 'footerContent')
	//kopage_blockSettings();
	//else
	setTimeout("k_EditSave('norefresh');",500)

	
}


//$("#k_bPaddingTop").change(function(){
//	$('#'+$('#blockId').val()).css('padding-top',$(this).val()+'px');
//})




function launchEditor(id, src) {

//	if(typeof featherEditor === "undefined")
	

	if(src.indexOf('://')<0){
    src=src.replace(kopageUrl, '');
	src=kopageUrl + src;
	}
	
	
	featherEditor.launch({
		image: document.getElementById(id),
		url: src
	});
	//return false
}


function keditImage(t,m){

	var im=$(t).parent().find('img');
	
	if(typeof im.attr('id')==='undefined'){
		im.attr('id',ID());
	}

	if(typeof m === "undefined")
	showModalManager(im.attr('id'),null,'img');
	else if(m == "edit"){
			
		return launchEditor(im.attr('id'), im.src);
		
		
	}
	
}
function keditIcon(icon,iconSettings){
	
	var i=$(inlineEditItem).parent('i');
	
	/*var currentClass=i.attr('class');
	var newClass='';
	// need to check for size classes.
	if(currentClass.indexOf('fa-lg')>-1)
	newClass+='fa-lg ';
	else if(currentClass.indexOf('fa-2x')>-1)
	newClass+='fa-2x ';
	else if(currentClass.indexOf('fa-3x')>-1)
	newClass+='fa-3x ';
	else if(currentClass.indexOf('fa-4x')>-1)
	newClass+='fa-4x ';
	else if(currentClass.indexOf('fa-5x')>-1)
	newClass+='fa-5x ';*/
	
	//i.attr('class',newClass+'fa '+icon);kedit_iconSize
	i.attr('class',$("#kedit_iconSize").val()+' fa '+icon);
	if(typeof iconSettings !== "undefined"){
			
	}
	k_EditSave('norefresh');keditableToolbar('hide');

}


$.fn.extend({ 
	 
	editableImages: function(options) {
		var defaults = {
			wrap: '<span class="keditImageWrap"/>'     
		}         
		 
		var options = $.extend(defaults, options);
		var o = options; 
		
		return this.each(function(i) {
			
			 var e = $(this)
			 var eHeight = e.outerHeight();       
			 
			 var ee = e.closest('.kelement');if ( ee.length > 0 ) return;	
			 
			 ee = e.closest('.koSquare');
			 if ( ee.length > 0 ) return;

			 e.wrap(o.wrap);
			 e.after('<a data-balloon="'+langPhrase.imageFind+'" data-balloon-pos="in" class="keditInlineEdit keditImage koBgHover1" contenteditable="false" href="javascript:void(null)" onclick="inlineEditItem=this;kopageToolbarTabs(\'Image\')"><i class="fa fa-cog"></i></a>');

		});
  
	},
	
	editableVideos: function(options) {
		var defaults = {
			wrap: '<div class="keditImageWrap" contenteditable="false" style="display:block;"/>'     
		}         
		 
		var options = $.extend(defaults, options);
		var o = options; 
		
		return this.each(function(i) {
			
			 var e = $(this)
			 var eHeight = e.outerHeight();       
			 
			 var ee = e.closest('.kelement');if ( ee.length > 0 ) return;	
			 			 
			 e.wrap(o.wrap);
			 e.after('<a data-balloon="'+langPhrase.videoSettings+'" data-balloon-pos="in" class="keditInlineEdit keditImage koBgHover1 kelement" contenteditable="false" href="javascript:void(null)" onclick="inlineEditItem=this;kopageToolbarTabs(\'Video\')"><i class="fa fa-cog"></i></a>');

		});
  
	},
	
	editableIcons: function(options) {
		
		return this.each(function(i) {
			
			 var e = $(this)
			 var eHeight = e.outerHeight();       
			 
			 var ee = e.closest('.kelement');if ( ee.length > 0 ) return;	
			 
			 ee = e.closest('.keditInlineEdit');if ( ee.length > 0 ) return;	
			 
			 e.html('<a data-balloon="'+langPhrase.chooseIcon+'" data-balloon-pos="in" class="keditInlineEdit keditIcon koBgHover1 koBg3" contenteditable="false" href="javascript:void(null)" onclick="inlineEditItem=this;kopage_showFrame(\'inline_icon\')" ><i class="fa fa-cog systemicon"></i></a>');			 

		});
  
	},
	
	editableLinks: function(){

		return this.each(function(i) {
			
			 var e = $(this);
			 var eHeight = e.outerHeight();       
			 var baloonPos='up';
			 
			 var ee = e.closest('.kelement');if ( ee.length > 0 ) return;	
			 ee = e.find('img');if ( ee.length > 0 ) return;
				
			 ee = e.closest('.koSquare');
			 if(ee.length > 0)baloonPos='left';
			 
			 e.append('<a contenteditable="false" data-balloon="'+langPhrase.linkEditor+'" data-balloon-pos="'+baloonPos+'" class="keditInlineEdit keditLinkEdit koBg3 koBgHover1" href="javascript:void(null)" onclick="window.focus();inlineEditLink=this;kopageToolbarTabs(\'Link\')"><i class="fa fa-link"></i></a>');

		});
  
	}
	
});

//$('.kedit:not(.WxNoSave) a').editableLinks();
//$('.kedit:not(.WxNoSave) img').editableImages();
//$('.kedit:not(.WxNoSave) i.fa').editableIcons();
//$('.kedit:not(.WxNoSave) .kvideo-centered').editableVideos();

keditPrepare('#header .kedit','noSeparators');
keditPrepare('#footerContent .kedit','noSeparators');
keditPrepare('#contentArea .kedit');

setupDraggableAndSortable();
//$(function(){setupDraggableAndSortable();})
//keditSeparators

$(function(){
	var kBlockCopyDiv=$('#kopageBlockCopy div');
kBlockCopyDiv.append(subpagesList);
kBlockCopyDiv.find('ul').addClass('nav')
kBlockCopyDiv.find('li span').each(function(){
	$(this).wrap('<a href="javascript:void(null)" onclick="kopageBlockClone(\''+$(this).attr('data-id')+'\')"></a>')
})
})