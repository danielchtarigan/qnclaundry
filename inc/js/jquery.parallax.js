// Adapted from https://gist.github.com/paulirish/1579671 which derived from
// http://paulirish.com/2011/requestanimationframe-for-smart-animating/
// http://my.opera.com/emoller/blog/2011/12/20/requestanimationframe-for-smart-er-animating

// requestAnimationFrame polyfill by Erik Möller.
// Fixes from Paul Irish, Tino Zijdel, Andrew Mao, Klemen Slavič, Darius Bacon

// MIT license

if (!Date.now)
    Date.now = function() { return new Date().getTime(); };

(function() {
    'use strict';

    var vendors = ['webkit', 'moz'];
    for (var i = 0; i < vendors.length && !window.requestAnimationFrame; ++i) {
        var vp = vendors[i];
        window.requestAnimationFrame = window[vp+'RequestAnimationFrame'];
        window.cancelAnimationFrame = (window[vp+'CancelAnimationFrame']
                                   || window[vp+'CancelRequestAnimationFrame']);
    }
    if (/iP(ad|hone|od).*OS 6/.test(window.navigator.userAgent) // iOS6 is buggy
        || !window.requestAnimationFrame || !window.cancelAnimationFrame) {
        var lastTime = 0;
        window.requestAnimationFrame = function(callback) {
            var now = Date.now();
            var nextTime = Math.max(lastTime + 16, now);
            return setTimeout(function() { callback(lastTime = nextTime); },
                              nextTime - now);
        };
        window.cancelAnimationFrame = clearTimeout;
    }
}());

/*
Plugin: jQuery Parallax
Version 1.1.3
Author: Ian Lunn
Twitter: @IanLunn
Author URL: http://www.ianlunn.co.uk/
Plugin URL: http://www.ianlunn.co.uk/plugins/jquery-parallax/

UPDATED: mobirise devs:
  added support for requestAnimationFrame

Dual licensed under the MIT and GPL licenses:
http://www.opensource.org/licenses/mit-license.php
http://www.gnu.org/licenses/gpl.html
*/
(function( $ ){
	var $window = $(window);
	var windowHeight = $window.height();

	$window.on('resize', function () {
		windowHeight = $window.height();
	});

    var uniqNum = 123;

    // init parallax
    var parallax = function($this, xpos, speedFactor, outerHeight) {
        uniqNum += 68;
        var instanceName = 'jqueryparallax' + uniqNum;
        $this.data('jquery-parallax-instance', instanceName);

        // function to be called whenever the window is scrolled or resized
        function update(){
            //get the starting position of each element to have parallax applied to it
            var firstTop = $this.offset().top;
            var pos = $window.scrollTop();
            var top = $this.offset().top;
            var height = outerHeight ? $this.outerHeight(true) : $this.height();

            // Check if totally above or totally below viewport
            if (top + height < pos || top > pos + windowHeight) {
                return;
            }

            $this.css('backgroundPosition', xpos + " " + Math.round((firstTop - pos) * speedFactor) + "px");
        }

        $window.on('scroll.' + instanceName + ' resize.' + instanceName + ' load.' + instanceName + '', function() {
            window.requestAnimationFrame(update);
        });
        update();
    };

    // destroy parallax
    var destroy = function($this) {
        var instance = $this.data('jquery-parallax-instance');
        if(instance) {
            $window.off('.' + instance);
            $this.removeData('jquery-parallax-instance')
            $this.css('backgroundPosition', 'center center');
        }
    };

	$.fn.parallax = function(xpos, speedFactor, outerHeight) {
        $(this).each(function() {
            if(xpos == 'destroy') {
                destroy($(this));
            } else {
                parallax(
                    $(this),
                    typeof xpos !== 'undefined' ? xpos : '50%',
                    typeof speedFactor !== 'undefined' ? speedFactor : 0.1,
                    typeof outerHeight !== 'undefined' ? outerHeight : true
                );
            }
        })
	};
})(jQuery);


// Kopage Video Lightbox



(function($) {
    $.fn.kopageVideoLightbox = function(o) {

        o = $.extend({

			autoplay:true,
			button:true // show "play" button above object

        }, o);

		// prepare lightbox layout
		var lt='<div id="kopageVideoModal" class="kelement" style=";"><div>';

		lt+='<a id="kopageVideoModalClose" href="javascript:void(null)">&times;</a>';
		lt+='<iframe id="kopageVideoModalFrame" width="870" height="489" frameborder="0" allowfullscreen></iframe>';
		lt+='</div></div>';

		// add some style
		lt+='<style>#kopageVideoModal{box-sizing:border-box;position:fixed;z-index:65600;left:0;top:0;bottom:0;height:100vh;width:100vw;display: flex; align-items: center; justify-content: center;	    background-color: rgba(0,0,0,0);	    background-image: radial-gradient(circle at center,rgba(127,127,127,0.5) 0%,rgba(0,0,0,0.7) 100%);transition: opacity 0.2s linear;opacity:0;pointer-events: none;}';
		lt+='#kopageVideoModal.modalActive{opacity:1;pointer-events: auto}';
		lt+='#kopageVideoModalFrame{border:5px solid #fff;box-shadow:2px 2px 66px rgba(0,0,0,0.5);background:black;max-width:85vw;;max-height: 100%;}';
		lt+='#kopageVideoModal div{position:relative; }';
		lt+='#kopageVideoModalClose{position:absolute;top:0;right:-50px;width:50px;height:50px;background:rgba(255,255,255,1);text-align:center;line-height:45px;font-size:30px;text-decoration:none;color:#666;}';
		lt+='#kopageVideoModalClose:hover{background:rgba(255,255,255,1);color:#111;}';


        lt+='.kopageVideoPlay { font-size: 45px; width: 106px; height: 106px;position: absolute;top: 50%;left: 50%;z-index: 2;transform: translate(-50%, -50%);background-color: rgba(0, 0, 0, 0.5);border: 3px solid #000;border-radius: 50%;outline: none;cursor: pointer;box-shadow: 0px 0px 0px 2px rgba(0, 0, 0, 0.25),0 0 70px rgba(0,0,0,0.7);transition: transform .5s ease;}';

        lt+='.videoLightbox:hover .kopageVideoPlay {background-color: rgba(0, 0, 0, 1);transform: translate(-50%, -50%) scale(1.2, 1.2) ;transition: transform .3s ease,opacity .3s ease;opacity:1;}';

		lt+='</style>';


		$("body").append(lt);

		$("#kopageVideoModalClose,#kopageVideoModal").click(function(){$('#kopageVideoModal').removeClass('modalActive');
						$('#kopageVideoModalFrame').attr('src',null);})


        return this.each(function(i, that) {

			var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
    		var match = $(that).attr('href').match(regExp);

		    if (match && match[2].length == 11) {
		        var embedUrl='https://www.youtube.com/embed/'+match[2];
		    } else {
		        return 'error';
		    }



			$(that).click(function(e){

				e.preventDefault();

				embedUrl+='?showinfo=0&amp;rel=0&amp;autohide=1&amp;disablekb=1&amp;modestbranding=1';

				if(o.autoplay == true)
					embedUrl+='&amp;autoplay=1';

				$('#kopageVideoModalFrame').attr('src',embedUrl);
				setTimeout(function(){$('#kopageVideoModal').addClass('modalActive');},200)

				//alert($(that).attr('href'));

			}).css({'outline':'none','overflow':'auto','position':'relative','text-align':'center','display':'inline-block'/*,'align-items':'center','justify-content':'center'*/,//'border':'1px solid blue'
        });


			if(o.button == true)

			$(that).append('<span class="kopageVideoPlay kelement" style=""><svg height=\"100px\" version=\"1.1\" viewBox=\"0 0 20 20\" width=\"100px\" xmlns=\"http:\/\/www.w3.org\/2000\/svg\" xmlns:xlink=\"http:\/\/www.w3.org\/1999\/xlink\"><title\/><desc\/><defs\/><g fill=\"none\" stroke=\"none\"><g fill=\"#ffffff\" transform=\"translate(-168.000000, -85.000000)\"><g transform=\"translate(168.000000, 85.000000)\"><path d=\"M8,14.5 L14,10 L8,5.5 L8,14.5 L8,14.5 Z M10,0 C4.5,0 0,4.5 0,10 C0,15.5 4.5,20 10,20 C15.5,20 20,15.5 20,10 C20,4.5 15.5,0 10,0 L10,0 Z M10,18 C5.6,18 2,14.4 2,10 C2,5.6 5.6,2 10,2 C14.4,2 18,5.6 18,10 C18,14.4 14.4,18 10,18 L10,18 Z\" \/><\/g><\/g><\/g><\/svg></span>');

        });
    };
})(jQuery);
