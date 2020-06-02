/**
 * This script contains embed functions for common plugins. This scripts are complety free to use for any purpose.
 */

function writeFlash(p) {
	writeEmbed(
		'D27CDB6E-AE6D-11cf-96B8-444553540000',
		'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0',
		'application/x-shockwave-flash',
		p
	);
}

function writeShockWave(p) {
	writeEmbed(
	'166B1BCA-3F9C-11CF-8075-444553540000',
	'http://download.macromedia.com/pub/shockwave/cabs/director/sw.cab#version=8,5,1,0',
	'application/x-director',
		p
	);
}

function writeQuickTime(p) {
	writeEmbed(
		'02BF25D5-8C17-4B23-BC80-D3488ABDDC6B',
		'http://www.apple.com/qtactivex/qtplugin.cab#version=6,0,2,0',
		'video/quicktime',
		p
	);
}

function writeRealMedia(p) {
	writeEmbed(
		'CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA',
		'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0',
		'audio/x-pn-realaudio-plugin',
		p
	);
}

function writeWindowsMedia(p) {
	p.url = p.src;
	writeEmbed(
		'6BF52A52-394A-11D3-B153-00C04F79FAA6',
		'http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701',
		'application/x-mplayer2',
		p
	);
}

function writeEmbed(cls, cb, mt, p) {
	
	
	
	/*
	
	<object data="../js/tinymce/jscripts/tiny_mce/plugins/media/moxieplayer.swf" type="application/x-shockwave-flash" height="240" width="320">
	
	
	<param name="src" value="../js/tinymce/jscripts/tiny_mce/plugins/media/moxieplayer.swf">
	
	<param name="flashvars" value="url=http%3A//www.crbch.com/web_media/Welcomemessage2012.flv&amp;poster=/tryit/">
	<param name="allowfullscreen" value="true">
	<param name="allowscriptaccess" value="true">
	
	</object>
	
	
	
	
	-----------
	
	
	
	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" height="240" width="320">
	
	<param name="flashvars" value="http://www.crbch.com/web_media/Welcomemessage2012.flv">
	<param name="src" value="../_page/tiny_mce/plugins/media/moxieplayer.swf">
	
	<param name="width" value="320">
	<param name="height" value="240">
	
	<embed type="application/x-shockwave-flash" src="../_page/tiny_mce/plugins/media/moxieplayer.swf" height="240" width="320">
	</object>
	
	
	*/
	
	//alert(ext)
	
	var h = '', n, ext='';
	
	if(typeof(p.src) != "undefined"){
		
		var fileName=p.src;
		ext = fileName.substr(fileName.lastIndexOf('.') + 1);
		
		var moxiePlayer='tiny_mce/plugins/media/moxieplayer.swf';
		
		if(typeof(tinyMcePath) != "undefined")
			moxiePlayer = tinyMcePath+moxiePlayer;

	}
	

	
		if(ext=='flv'){

			h += '<object data="' + moxiePlayer + '"';

		} else {
			
			h += '<object classid="clsid:' + cls + '" codebase="' + cb + '"';


		}
			
		h += typeof(p.id) != "undefined" ? 'id="' + p.id + '"' : '';
		h += typeof(p.name) != "undefined" ? 'name="' + p.name + '"' : '';
		h += typeof(p.width) != "undefined" ? 'width="' + p.width + '"' : '';
		h += typeof(p.height) != "undefined" ? 'height="' + p.height + '"' : '';
		h += typeof(p.align) != "undefined" ? 'align="' + p.align + '"' : '';
		h += '>';
	

			
			
	for (n in p){
		
		if(n == 'src' && ext=='flv'){
			
			h += '<param name="flashvars" value="url=' + encodeURIComponent(p[n]) + '">';//&poster=someimage.png - but it's not working.
			h += '<param name="' + n + '" value="' + moxiePlayer + '">';
			p[n] = moxiePlayer;
			
			h += '<param name="allowscriptaccess" value="true"><param name="allowfullscreen" value="true">';


		} else
		h += '<param name="' + n + '" value="' + p[n] + '">';


	}
	
	h += '<embed type="' + mt + '"';

	for (n in p)
		h += n + '="' + p[n] + '" ';

	h += '></embed>';
	h += '</object>';

	document.write(h);
}
