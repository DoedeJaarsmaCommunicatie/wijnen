(window.webpackJsonp=window.webpackJsonp||[]).push([[5],{28:function(e,t,n){"use strict";var i=n(25),r=function(){window["top-bar-slider"]=Object(i.a)({container:".header-usps",items:1,autoplay:!0,nav:!1,controls:!1,autoplayTimeout:5e3,autoplayButtonOutput:!1,loop:!0,mode:"gallery"})},o=function(){window["product-usp-slider"]=Object(i.a)({container:".product-usp-carousel",items:1,autoplay:!0,nav:!1,controls:!1,autoplayTimeout:3e3,autoplayButtonOutput:!1,loop:!0})};n.d(t,"a",(function(){return r})),n.d(t,"b",(function(){return o}))},31:function(e,t,n){"use strict";n.r(t);var i=n(28),r=n(3),o=n.n(r);function a(e,t,n,i,r,o,a){try{var s=e[o](a),u=s.value}catch(e){return void n(e)}s.done?t(u):Promise.resolve(u).then(i,r)}function s(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function u(e,t){for(var n=0;n<t.length;n++){var i=t[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(e,i.key,i)}}function c(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}var l=function(){function e(t){var n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null;s(this,e),c(this,"elements",void 0),this.selector=t,this.slug=n||t}var t,n,i,r,l;return t=e,(n=[{key:"init",value:function(){if(this.setElements(),this.elementsExist())return this.loop(),this}},{key:"setElements",value:function(){this.elements=document.querySelectorAll("[data-attribute=".concat(this.selector,"]"))}},{key:"elementsExist",value:function(){return!!this.elements&&this.elements.length>=1}},{key:"loop",value:(r=o.a.mark((function e(){var t,n,i,r,a;return o.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:e.t0=o.a.keys(this.elements);case 1:if((e.t1=e.t0()).done){e.next=21;break}if(t=e.t1.value,!this.elements.hasOwnProperty(t)){e.next=19;break}return n=this.elements[t],i=void 0,e.prev=6,e.next=9,fetch("/wp-json/wp/v2/".concat(this.slug,"?slug=").concat(n.dataset.value));case 9:i=e.sent,e.next=14;break;case 12:e.prev=12,e.t2=e.catch(6);case 14:return e.next=16,i.json();case 16:r=e.sent,a=n.innerHTML.endsWith(", ");try{n.innerHTML='<a href="'.concat(r[0].link,'">').concat(r[0].title.rendered,"</a>").concat(a?", ":"")}catch(e){}case 19:e.next=1;break;case 21:case"end":return e.stop()}}),e,this,[[6,12]])})),l=function(){var e=this,t=arguments;return new Promise((function(n,i){var o=r.apply(e,t);function s(e){a(o,n,i,s,u,"next",e)}function u(e){a(o,n,i,s,u,"throw",e)}s(void 0)}))},function(){return l.apply(this,arguments)})}])&&u(t.prototype,n),i&&u(t,i),e}();t.default={init:function(){new l("streek").init(),new l("domein","producent").init(),new l("druif").init(),new l("regio","streek").init()},finalize:function(){Object(i.b)()}}}}]);