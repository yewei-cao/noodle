define(["jquery","common/breakpoints","common/jquery-sticky-kit"],function(e,t,n){
	function r(){	
	e(".basket, .open-basket").addClass("open"),
	e("body").addClass("basket-open"),
	e(".basket").attr("aria-hidden","false")
	}

function i(){
		e(".basket, .open-basket").removeClass("open"),
		e("body").removeClass("basket-open"),
		e(".basket").attr("aria-hidden","true")
	}
	
	function s(){
		e("body").hasClass("basket-open")?i():r()
		}
	e("#open-basket, .mobile-close-button, .basket-shadow")	
	.on("click touchstart",function(e){s(),e.stopPropagation(),e.preventDefault()}),

e("#place_order_fixed, #back_fixed, #place-order-button"
).filter(function(){return e(this).attr("href")!=="undefined"&&e(this).attr("href")!=null}).on("click touchstart"
,function(t){var n=e(this).attr("href");n.length>0&&(e(this).addClass("active"),t.stopPropagation(),t
.preventDefault(),window.location.href=n)}),e(".fixed-footer").on("touchmove",function(e){e.preventDefault
()}),

e(".basket").on("touchmove",function(e){e.stopPropagation()}),

e(window).setBreakpoints({distinct
:!0,breakpoints:[0,414,768,992,1200,1480]}),

e(window).on({"enterBreakpoint768 enterBreakpoint992 enterBreakpoint1200 enterBreakpoint1480"
:function(){e("html").hasClass("old-ie")||e(".basket").stick_in_parent({offset_top:10,recalc_every:50
})
,e(".basket").attr("aria-hidden","false")},"enterBreakpoint0 enterBreakpoint414":function(){e(".basket"
).trigger("sticky_kit:detach")}})})



$(window).setBreakpoints({
// use only largest available vs use all available
    distinct: true, 
// array of widths in pixels where breakpoints
// should be triggered
    breakpoints: [
        320,
        480,
        768,
        1024
    ] 
});     

$(window).bind('enterBreakpoint320',function() {
    ...
});

$(window).bind('exitBreakpoint320',function() {
    ...
});

$(window).bind('enterBreakpoint768',function() {
    ...
});

$(window).bind('exitBreakpoint768',function() {
    ...
});


$(window).bind('enterBreakpoint1024',function() {
    ...
});

$(window).bind('exitBreakpoint1024',function() {
    ...
});


.fixed-footer #add-to-order {
    margin: -3px 14px 0 0;
    font-size: 1em;
    white-space: normal;
    vertical-align: middle;
    display: inline-block;
}
.fixed-footer .btn span, .fixed-footer .scroll-to-top a span, .scroll-to-top .fixed-footer a span, .fixed-footer .mogul-menu .mogul-search-links .more-results span, .mogul-menu .mogul-search-links .fixed-footer .more-results span, .fixed-footer .mogul-menu .mogul-search-links .previous-results span, .mogul-menu .mogul-search-links .fixed-footer .previous-results span {
    line-height: 20px;
    display: inline-block;
    margin-bottom: -5px;
    position: relative;
}
html, body, div, span, applet, object, iframe, h1, h2, h3, #tracker-page .e-club .heading, #toast .toast-inner, .payment-method .call-to-action, .update-details-page .account-details-col .change-password-section .change-password-link, h4, h5, #tracker-page #tracker-block #tracker-order-status, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video {
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    font: inherit;
    vertical-align: baseline;
}
* {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
Inherited from a#place_order_fixed.btn.next
.fixed-footer .btn, .fixed-footer .scroll-to-top a, .scroll-to-top .fixed-footer a, .fixed-footer .mogul-menu .mogul-search-links .more-results, .mogul-menu .mogul-search-links .fixed-footer .more-results, .fixed-footer .mogul-menu .mogul-search-links .previous-results, .mogul-menu .mogul-search-links .fixed-footer .previous-results {
    padding: .5em;
    vertical-align: middle;
    border-radius: 3px;
    width: 100%;
    font-size: 1.2em;
}
.btn.next, .btn-next, .scroll-to-top a.next, .mogul-menu .mogul-search-links .next.more-results, .mogul-menu .mogul-search-links .next.previous-results {
    color: white;
    background-color: #e41837;
    border-color: #e41837;
    padding-right: 18px;
    position: relative;
    padding-right: 18px;
}
.btn, .scroll-to-top a, .mogul-menu .mogul-search-links .more-results, .mogul-menu .mogul-search-links .previous-results {
    color: white;
    background-color: #595959;
    border-color: transparent;
    border-radius: 3px;
    text-transform: uppercase;
    font-family: 'Oswald';
    position: relative;
    padding-left: 9px;
    padding-right: 9px;
    white-space: normal;
}
.btn {
    display: inline-block;
    margin-bottom: 0;
    font-weight: normal;
    text-align: center;
    vertical-align: middle;
    touch-action: manipulation;
    cursor: pointer;
    background-image: none;
    border: 1px solid transparent;
    white-space: nowrap;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857;
    border-radius: 3px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
a {
    text-decoration: none;
    color: #fff;
}
html, body, div, span, applet, object, iframe, h1, h2, h3, #tracker-page .e-club .heading, #toast .toast-inner, .payment-method .call-to-action, .update-details-page .account-details-col .change-password-section .change-password-link, h4, h5, #tracker-page #tracker-block #tracker-order-status, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video {
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    font: inherit;
    vertical-align: baseline;
}
user agent stylesheeta:-webkit-any-link {
    color: -webkit-link;
    text-decoration: underline;
    cursor: auto;
}
Inherited from div.col-6
html, body, div, span, applet, object, iframe, h1, h2, h3, #tracker-page .e-club .heading, #toast .toast-inner, .payment-method .call-to-action, .update-details-page .account-details-col .change-password-section .change-password-link, h4, h5, #tracker-page #tracker-block #tracker-order-status, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video {
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    font: inherit;
    vertical-align: baseline;
}
Inherited from div.row
html, body, div, span, applet, object, iframe, h1, h2, h3, #tracker-page .e-club .heading, #toast .toast-inner, .payment-method .call-to-action, .update-details-page .account-details-col .change-password-section .change-password-link, h4, h5, #tracker-page #tracker-block #tracker-order-status, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video {
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    font: inherit;
    vertical-align: baseline;
}
Inherited from div.fixed-footer.hide-for-small-up
.fixed-footer {
    position: fixed;
    z-index: 999;
    display: block;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0,0,0,0.9);
    color: #fff;
    padding: 10px;
    width: 100%;
}
html, body, div, span, applet, object, iframe, h1, h2, h3, #tracker-page .e-club .heading, #toast .toast-inner, .payment-method .call-to-action, .update-details-page .account-details-col .change-password-section .change-password-link, h4, h5, #tracker-page #tracker-block #tracker-order-status, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video {
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    font: inherit;
    vertical-align: baseline;
}
Inherited from body#productmenu-page.nz.lang-en.breakpoint-414
body {
    background: url("../../Images/bg-mobile.jpg") left top #333;
    background-size: 100% auto;
    font-family: "droid_sans",verdana,sans-serif;
    margin: 0;
    padding: 0;
    color: #fff;
    overflow-x: hidden;
    min-height: 100%;
    position: relative;
}
body {
    line-height: 1;
}
html, body, div, span, applet, object, iframe, h1, h2, h3, #tracker-page .e-club .heading, #toast .toast-inner, .payment-method .call-to-action, .update-details-page .account-details-col .change-password-section .change-password-link, h4, h5, #tracker-page #tracker-block #tracker-order-status, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video {
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    font: inherit;
    vertical-align: baseline;
}
Inherited from html.js.no-flexbox.flexbox-legacy.canvas.canvastext.webgl.touch.geolocation.postmessage.websqldatabase.indexeddb.hashchange.history.draganddrop.websockets.rgba.hsla.multiplebgs.backgroundsize.borderimage.borderradius.boxshadow.textshadow.opacity.cssanimations.csscolumns.cssgradients.cssreflections.csstransforms.csstransforms3d.csstransitions.fontface.generatedcontent.video.audio.localstorage.sessionstorage.webworkers.applicationcache.svg.inlinesvg.smil.svgclippaths
html, body, div, span, applet, object, iframe, h1, h2, h3, #tracker-page .e-club .heading, #toast .toast-inner, .payment-method .call-to-action, .update-details-page .account-details-col .change-password-section .change-password-link, h4, h5, #tracker-page #tracker-block #tracker-order-status, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video {
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    font: inherit;
    vertical-align: baseline;
}
Pseudo ::before element
*:before, *:after {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
Pseudo ::after element
*:before, *:after {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

