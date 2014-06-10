/**
 * circles - v0.0.5 - 2014-05-30
 *
 * Copyright (c) 2014 lugolabs
 * Licensed 
 */
(function(){var l=window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||window.oRequestAnimationFrame||window.msRequestAnimationFrame||function(a){setTimeout(a,1E3/60)},f=window.Circles=function(a){this._el=document.getElementById(a.id);if(null!==this._el){this._radius=a.radius||10;this._duration=void 0===a.duration?500:a.duration;this._value=0;this._maxValue=a.maxValue||100;this._text=void 0===a.text?function(a){return this.htmlifyNumber(a)}:a.text;this._strokeWidth=
a.width||10;this._colors=a.colors||["#EEE","#F00"];this._textContainer=this._wrapContainer=this._movingPath=this._svg=null;this._wrpClass=a.wrpClass||"circles-wrp";this._textClass=a.textClass||"circles-text";var b=Math.PI/180*270;this._start=-Math.PI/180*90;this._startPrecise=this._precise(this._start);this._circ=b-this._start;this._generate().update(a.value||0)}};f.prototype={VERSION:"0.0.5",_generate:function(){this._svgSize=2*this._radius;this._radiusAdjusted=this._radius-this._strokeWidth/2;this._generateSvg()._generateText()._generateWrapper();
this._el.innerHTML="";this._el.appendChild(this._wrapContainer);return this},_setPercentage:function(a){this._movingPath.setAttribute("d",this._calculatePath(a,!0));this._textContainer.innerHTML=this._getText(this.getValueFromPercent(a))},_generateWrapper:function(){this._wrapContainer=document.createElement("div");this._wrapContainer.className=this._wrpClass;this._wrapContainer.style.position="relative";this._wrapContainer.style.display="inline-block";this._wrapContainer.appendChild(this._svg);this._wrapContainer.appendChild(this._textContainer);
return this},_generateText:function(){this._textContainer=document.createElement("div");this._textContainer.className=this._textClass;var a={position:"absolute",top:0,left:0,textAlign:"center",width:"100%",fontSize:.7*this._radius+"px",height:this._svgSize+"px",lineHeight:this._svgSize+"px"},b;for(b in a)this._textContainer.style[b]=a[b];this._textContainer.innerHTML=this._getText(0);return this},_getText:function(a){if(!this._text)return"";void 0===a&&(a=this._value);a=parseFloat(a.toFixed(2));return"function"===
typeof this._text?this._text.call(this,a):this._text},_generateSvg:function(){this._svg=document.createElementNS("http://www.w3.org/2000/svg","svg");this._svg.setAttribute("xmlns","http://www.w3.org/2000/svg");this._svg.setAttribute("width",this._svgSize);this._svg.setAttribute("height",this._svgSize);this._generatePath(100,!1,this._colors[0])._generatePath(1,!0,this._colors[1]);this._movingPath=this._svg.getElementsByTagName("path")[1];return this},_generatePath:function(a,b,d){var c=document.createElementNS("http://www.w3.org/2000/svg",
"path");c.setAttribute("fill","transparent");c.setAttribute("stroke",d);c.setAttribute("stroke-width",this._strokeWidth);c.setAttribute("d",this._calculatePath(a,b));this._svg.appendChild(c);return this},_calculatePath:function(a,b){var d=this._precise(this._start+a/100*this._circ);return this._arc(d,b)},_arc:function(a,b){var d=a-.001,c=a-this._startPrecise<Math.PI?0:1;return["M",this._radius+this._radiusAdjusted*Math.cos(this._startPrecise),this._radius+this._radiusAdjusted*Math.sin(this._startPrecise),
"A",this._radiusAdjusted,this._radiusAdjusted,0,c,1,this._radius+this._radiusAdjusted*Math.cos(d),this._radius+this._radiusAdjusted*Math.sin(d),b?"":"Z"].join(" ")},_precise:function(a){return Math.round(1E3*a)/1E3},htmlifyNumber:function(a,b,d){b=b||"circles-integer";d=d||"circles-decimals";a=(a+"").split(".");b='<span class="'+b+'">'+a[0]+"</span>";1<a.length&&(b+='.<span class="'+d+'">'+a[1].substring(0,2)+"</span>");return b},updateRadius:function(a){this._radius=a;return this._generate().update(!0)},
updateWidth:function(a){this._strokeWidth=a;return this._generate().update(!0)},updateColors:function(a){this._colors=a;var b=this._svg.getElementsByTagName("path");b[0].setAttribute("stroke",a[0]);b[1].setAttribute("stroke",a[1]);return this},getPercent:function(){return 100*this._value/this._maxValue},getValueFromPercent:function(a){return this._maxValue*a/100},getValue:function(){return this._value},getMaxValue:function(){return this._maxValue},update:function(a,b){if(!0===a)return this._setPercentage(this.getPercent()),
this;if(this._value==a||isNaN(a))return this;void 0===b&&(b=this._duration);var d=this,c=d.getPercent(),g=1,e,h,f,k;this._value=Math.min(this._maxValue,Math.max(0,a));if(!b)return this._setPercentage(this.getPercent()),this;e=d.getPercent();h=e>c;g+=e%1;f=Math.floor(Math.abs(e-c)/g);k=b/f;(function m(a){c=h?c+g:c-g;if(h&&c>=e||!h&&c<=e)l(function(){d._setPercentage(e)});else{l(function(){d._setPercentage(c)});var b=Date.now();a=b-a;a>=k?m(b):setTimeout(function(){m(Date.now())},k-a)}})(Date.now());
return this}};f.create=function(a){return new f(a)}})();
