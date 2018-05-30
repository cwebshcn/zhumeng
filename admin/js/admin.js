var basefile = "#";
var ctrl_id = "c";
var func_id = "f";
var webroot = "";
var apifile = "#";
var canOpen = true;
var lang= new Array();

function get_url(ctrl,func,ext){var url = "admin.php?c="+ctrl;if(func){url+="&f="+func;};if(ext){url+="&"+ext};return url;}
function api_url(ctrl,func,ext){var url = "api.php?c="+ctrl;if(func){url+="&f="+func;};if(ext){url+="&"+ext};url+="&_noCache="+Math.random();return url;};
function api_plugin_url(id,func,ext){var url = "api.php?c=plugin&f=index&id="+id+"&exec="+func;if(ext){url+="&"+ext};url+="&_noCache="+Math.random();return url;};
/*! jQuery v1.7.1 jquery.com | jquery.org/license */
(function(a,b){function cy(a){return f.isWindow(a)?a:a.nodeType===9?a.defaultView||a.parentWindow:!1}function cv(a){if(!ck[a]){var b=c.body,d=f("<"+a+">").appendTo(b),e=d.css("display");d.remove();if(e==="none"||e===""){cl||(cl=c.createElement("iframe"),cl.frameBorder=cl.width=cl.height=0),b.appendChild(cl);if(!cm||!cl.createElement)cm=(cl.contentWindow||cl.contentDocument).document,cm.write((c.compatMode==="CSS1Compat"?"<!doctype html>":"")+"<html><body>"),cm.close();d=cm.createElement(a),cm.body.appendChild(d),e=f.css(d,"display"),b.removeChild(cl)}ck[a]=e}return ck[a]}function cu(a,b){var c={};f.each(cq.concat.apply([],cq.slice(0,b)),function(){c[this]=a});return c}function ct(){cr=b}function cs(){setTimeout(ct,0);return cr=f.now()}function cj(){try{return new a.ActiveXObject("Microsoft.XMLHTTP")}catch(b){}}function ci(){try{return new a.XMLHttpRequest}catch(b){}}function cc(a,c){a.dataFilter&&(c=a.dataFilter(c,a.dataType));var d=a.dataTypes,e={},g,h,i=d.length,j,k=d[0],l,m,n,o,p;for(g=1;g<i;g++){if(g===1)for(h in a.converters)typeof h=="string"&&(e[h.toLowerCase()]=a.converters[h]);l=k,k=d[g];if(k==="*")k=l;else if(l!=="*"&&l!==k){m=l+" "+k,n=e[m]||e["* "+k];if(!n){p=b;for(o in e){j=o.split(" ");if(j[0]===l||j[0]==="*"){p=e[j[1]+" "+k];if(p){o=e[o],o===!0?n=p:p===!0&&(n=o);break}}}}!n&&!p&&f.error("No conversion from "+m.replace(" "," to ")),n!==!0&&(c=n?n(c):p(o(c)))}}return c}function cb(a,c,d){var e=a.contents,f=a.dataTypes,g=a.responseFields,h,i,j,k;for(i in g)i in d&&(c[g[i]]=d[i]);while(f[0]==="*")f.shift(),h===b&&(h=a.mimeType||c.getResponseHeader("content-type"));if(h)for(i in e)if(e[i]&&e[i].test(h)){f.unshift(i);break}if(f[0]in d)j=f[0];else{for(i in d){if(!f[0]||a.converters[i+" "+f[0]]){j=i;break}k||(k=i)}j=j||k}if(j){j!==f[0]&&f.unshift(j);return d[j]}}function ca(a,b,c,d){if(f.isArray(b))f.each(b,function(b,e){c||bE.test(a)?d(a,e):ca(a+"["+(typeof e=="object"||f.isArray(e)?b:"")+"]",e,c,d)});else if(!c&&b!=null&&typeof b=="object")for(var e in b)ca(a+"["+e+"]",b[e],c,d);else d(a,b)}function b_(a,c){var d,e,g=f.ajaxSettings.flatOptions||{};for(d in c)c[d]!==b&&((g[d]?a:e||(e={}))[d]=c[d]);e&&f.extend(!0,a,e)}function b$(a,c,d,e,f,g){f=f||c.dataTypes[0],g=g||{},g[f]=!0;var h=a[f],i=0,j=h?h.length:0,k=a===bT,l;for(;i<j&&(k||!l);i++)l=h[i](c,d,e),typeof l=="string"&&(!k||g[l]?l=b:(c.dataTypes.unshift(l),l=b$(a,c,d,e,l,g)));(k||!l)&&!g["*"]&&(l=b$(a,c,d,e,"*",g));return l}function bZ(a){return function(b,c){typeof b!="string"&&(c=b,b="*");if(f.isFunction(c)){var d=b.toLowerCase().split(bP),e=0,g=d.length,h,i,j;for(;e<g;e++)h=d[e],j=/^\+/.test(h),j&&(h=h.substr(1)||"*"),i=a[h]=a[h]||[],i[j?"unshift":"push"](c)}}}function bC(a,b,c){var d=b==="width"?a.offsetWidth:a.offsetHeight,e=b==="width"?bx:by,g=0,h=e.length;if(d>0){if(c!=="border")for(;g<h;g++)c||(d-=parseFloat(f.css(a,"padding"+e[g]))||0),c==="margin"?d+=parseFloat(f.css(a,c+e[g]))||0:d-=parseFloat(f.css(a,"border"+e[g]+"Width"))||0;return d+"px"}d=bz(a,b,b);if(d<0||d==null)d=a.style[b]||0;d=parseFloat(d)||0;if(c)for(;g<h;g++)d+=parseFloat(f.css(a,"padding"+e[g]))||0,c!=="padding"&&(d+=parseFloat(f.css(a,"border"+e[g]+"Width"))||0),c==="margin"&&(d+=parseFloat(f.css(a,c+e[g]))||0);return d+"px"}function bp(a,b){b.src?f.ajax({url:b.src,async:!1,dataType:"script"}):f.globalEval((b.text||b.textContent||b.innerHTML||"").replace(bf,"/*$0*/")),b.parentNode&&b.parentNode.removeChild(b)}function bo(a){var b=c.createElement("div");bh.appendChild(b),b.innerHTML=a.outerHTML;return b.firstChild}function bn(a){var b=(a.nodeName||"").toLowerCase();b==="input"?bm(a):b!=="script"&&typeof a.getElementsByTagName!="undefined"&&f.grep(a.getElementsByTagName("input"),bm)}function bm(a){if(a.type==="checkbox"||a.type==="radio")a.defaultChecked=a.checked}function bl(a){return typeof a.getElementsByTagName!="undefined"?a.getElementsByTagName("*"):typeof a.querySelectorAll!="undefined"?a.querySelectorAll("*"):[]}function bk(a,b){var c;if(b.nodeType===1){b.clearAttributes&&b.clearAttributes(),b.mergeAttributes&&b.mergeAttributes(a),c=b.nodeName.toLowerCase();if(c==="object")b.outerHTML=a.outerHTML;else if(c!=="input"||a.type!=="checkbox"&&a.type!=="radio"){if(c==="option")b.selected=a.defaultSelected;else if(c==="input"||c==="textarea")b.defaultValue=a.defaultValue}else a.checked&&(b.defaultChecked=b.checked=a.checked),b.value!==a.value&&(b.value=a.value);b.removeAttribute(f.expando)}}function bj(a,b){if(b.nodeType===1&&!!f.hasData(a)){var c,d,e,g=f._data(a),h=f._data(b,g),i=g.events;if(i){delete h.handle,h.events={};for(c in i)for(d=0,e=i[c].length;d<e;d++)f.event.add(b,c+(i[c][d].namespace?".":"")+i[c][d].namespace,i[c][d],i[c][d].data)}h.data&&(h.data=f.extend({},h.data))}}function bi(a,b){return f.nodeName(a,"table")?a.getElementsByTagName("tbody")[0]||a.appendChild(a.ownerDocument.createElement("tbody")):a}function U(a){var b=V.split("|"),c=a.createDocumentFragment();if(c.createElement)while(b.length)c.createElement(b.pop());return c}function T(a,b,c){b=b||0;if(f.isFunction(b))return f.grep(a,function(a,d){var e=!!b.call(a,d,a);return e===c});if(b.nodeType)return f.grep(a,function(a,d){return a===b===c});if(typeof b=="string"){var d=f.grep(a,function(a){return a.nodeType===1});if(O.test(b))return f.filter(b,d,!c);b=f.filter(b,d)}return f.grep(a,function(a,d){return f.inArray(a,b)>=0===c})}function S(a){return!a||!a.parentNode||a.parentNode.nodeType===11}function K(){return!0}function J(){return!1}function n(a,b,c){var d=b+"defer",e=b+"queue",g=b+"mark",h=f._data(a,d);h&&(c==="queue"||!f._data(a,e))&&(c==="mark"||!f._data(a,g))&&setTimeout(function(){!f._data(a,e)&&!f._data(a,g)&&(f.removeData(a,d,!0),h.fire())},0)}function m(a){for(var b in a){if(b==="data"&&f.isEmptyObject(a[b]))continue;if(b!=="toJSON")return!1}return!0}function l(a,c,d){if(d===b&&a.nodeType===1){var e="data-"+c.replace(k,"-$1").toLowerCase();d=a.getAttribute(e);if(typeof d=="string"){try{d=d==="true"?!0:d==="false"?!1:d==="null"?null:f.isNumeric(d)?parseFloat(d):j.test(d)?f.parseJSON(d):d}catch(g){}f.data(a,c,d)}else d=b}return d}function h(a){var b=g[a]={},c,d;a=a.split(/\s+/);for(c=0,d=a.length;c<d;c++)b[a[c]]=!0;return b}var c=a.document,d=a.navigator,e=a.location,f=function(){function J(){if(!e.isReady){try{c.documentElement.doScroll("left")}catch(a){setTimeout(J,1);return}e.ready()}}var e=function(a,b){return new e.fn.init(a,b,h)},f=a.jQuery,g=a.$,h,i=/^(?:[^#<]*(<[\w\W]+>)[^>]*$|#([\w\-]*)$)/,j=/\S/,k=/^\s+/,l=/\s+$/,m=/^<(\w+)\s*\/?>(?:<\/\1>)?$/,n=/^[\],:{}\s]*$/,o=/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g,p=/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,q=/(?:^|:|,)(?:\s*\[)+/g,r=/(webkit)[ \/]([\w.]+)/,s=/(opera)(?:.*version)?[ \/]([\w.]+)/,t=/(msie) ([\w.]+)/,u=/(mozilla)(?:.*? rv:([\w.]+))?/,v=/-([a-z]|[0-9])/ig,w=/^-ms-/,x=function(a,b){return(b+"").toUpperCase()},y=d.userAgent,z,A,B,C=Object.prototype.toString,D=Object.prototype.hasOwnProperty,E=Array.prototype.push,F=Array.prototype.slice,G=String.prototype.trim,H=Array.prototype.indexOf,I={};e.fn=e.prototype={constructor:e,init:function(a,d,f){var g,h,j,k;if(!a)return this;if(a.nodeType){this.context=this[0]=a,this.length=1;return this}if(a==="body"&&!d&&c.body){this.context=c,this[0]=c.body,this.selector=a,this.length=1;return this}if(typeof a=="string"){a.charAt(0)!=="<"||a.charAt(a.length-1)!==">"||a.length<3?g=i.exec(a):g=[null,a,null];if(g&&(g[1]||!d)){if(g[1]){d=d instanceof e?d[0]:d,k=d?d.ownerDocument||d:c,j=m.exec(a),j?e.isPlainObject(d)?(a=[c.createElement(j[1])],e.fn.attr.call(a,d,!0)):a=[k.createElement(j[1])]:(j=e.buildFragment([g[1]],[k]),a=(j.cacheable?e.clone(j.fragment):j.fragment).childNodes);return e.merge(this,a)}h=c.getElementById(g[2]);if(h&&h.parentNode){if(h.id!==g[2])return f.find(a);this.length=1,this[0]=h}this.context=c,this.selector=a;return this}return!d||d.jquery?(d||f).find(a):this.constructor(d).find(a)}if(e.isFunction(a))return f.ready(a);a.selector!==b&&(this.selector=a.selector,this.context=a.context);return e.makeArray(a,this)},selector:"",jquery:"1.7.1",length:0,size:function(){return this.length},toArray:function(){return F.call(this,0)},get:function(a){return a==null?this.toArray():a<0?this[this.length+a]:this[a]},pushStack:function(a,b,c){var d=this.constructor();e.isArray(a)?E.apply(d,a):e.merge(d,a),d.prevObject=this,d.context=this.context,b==="find"?d.selector=this.selector+(this.selector?" ":"")+c:b&&(d.selector=this.selector+"."+b+"("+c+")");return d},each:function(a,b){return e.each(this,a,b)},ready:function(a){e.bindReady(),A.add(a);return this},eq:function(a){a=+a;return a===-1?this.slice(a):this.slice(a,a+1)},first:function(){return this.eq(0)},last:function(){return this.eq(-1)},slice:function(){return this.pushStack(F.apply(this,arguments),"slice",F.call(arguments).join(","))},map:function(a){return this.pushStack(e.map(this,function(b,c){return a.call(b,c,b)}))},end:function(){return this.prevObject||this.constructor(null)},push:E,sort:[].sort,splice:[].splice},e.fn.init.prototype=e.fn,e.extend=e.fn.extend=function(){var a,c,d,f,g,h,i=arguments[0]||{},j=1,k=arguments.length,l=!1;typeof i=="boolean"&&(l=i,i=arguments[1]||{},j=2),typeof i!="object"&&!e.isFunction(i)&&(i={}),k===j&&(i=this,--j);for(;j<k;j++)if((a=arguments[j])!=null)for(c in a){d=i[c],f=a[c];if(i===f)continue;l&&f&&(e.isPlainObject(f)||(g=e.isArray(f)))?(g?(g=!1,h=d&&e.isArray(d)?d:[]):h=d&&e.isPlainObject(d)?d:{},i[c]=e.extend(l,h,f)):f!==b&&(i[c]=f)}return i},e.extend({noConflict:function(b){a.$===e&&(a.$=g),b&&a.jQuery===e&&(a.jQuery=f);return e},isReady:!1,readyWait:1,holdReady:function(a){a?e.readyWait++:e.ready(!0)},ready:function(a){if(a===!0&&!--e.readyWait||a!==!0&&!e.isReady){if(!c.body)return setTimeout(e.ready,1);e.isReady=!0;if(a!==!0&&--e.readyWait>0)return;A.fireWith(c,[e]),e.fn.trigger&&e(c).trigger("ready").off("ready")}},bindReady:function(){if(!A){A=e.Callbacks("once memory");if(c.readyState==="complete")return setTimeout(e.ready,1);if(c.addEventListener)c.addEventListener("DOMContentLoaded",B,!1),a.addEventListener("load",e.ready,!1);else if(c.attachEvent){c.attachEvent("onreadystatechange",B),a.attachEvent("onload",e.ready);var b=!1;try{b=a.frameElement==null}catch(d){}c.documentElement.doScroll&&b&&J()}}},isFunction:function(a){return e.type(a)==="function"},isArray:Array.isArray||function(a){return e.type(a)==="array"},isWindow:function(a){return a&&typeof a=="object"&&"setInterval"in a},isNumeric:function(a){return!isNaN(parseFloat(a))&&isFinite(a)},type:function(a){return a==null?String(a):I[C.call(a)]||"object"},isPlainObject:function(a){if(!a||e.type(a)!=="object"||a.nodeType||e.isWindow(a))return!1;try{if(a.constructor&&!D.call(a,"constructor")&&!D.call(a.constructor.prototype,"isPrototypeOf"))return!1}catch(c){return!1}var d;for(d in a);return d===b||D.call(a,d)},isEmptyObject:function(a){for(var b in a)return!1;return!0},error:function(a){throw new Error(a)},parseJSON:function(b){if(typeof b!="string"||!b)return null;b=e.trim(b);if(a.JSON&&a.JSON.parse)return a.JSON.parse(b);if(n.test(b.replace(o,"@").replace(p,"]").replace(q,"")))return(new Function("return "+b))();e.error("Invalid JSON: "+b)},parseXML:function(c){var d,f;try{a.DOMParser?(f=new DOMParser,d=f.parseFromString(c,"text/xml")):(d=new ActiveXObject("Microsoft.XMLDOM"),d.async="false",d.loadXML(c))}catch(g){d=b}(!d||!d.documentElement||d.getElementsByTagName("parsererror").length)&&e.error("Invalid XML: "+c);return d},noop:function(){},globalEval:function(b){b&&j.test(b)&&(a.execScript||function(b){a.eval.call(a,b)})(b)},camelCase:function(a){return a.replace(w,"ms-").replace(v,x)},nodeName:function(a,b){return a.nodeName&&a.nodeName.toUpperCase()===b.toUpperCase()},each:function(a,c,d){var f,g=0,h=a.length,i=h===b||e.isFunction(a);if(d){if(i){for(f in a)if(c.apply(a[f],d)===!1)break}else for(;g<h;)if(c.apply(a[g++],d)===!1)break}else if(i){for(f in a)if(c.call(a[f],f,a[f])===!1)break}else for(;g<h;)if(c.call(a[g],g,a[g++])===!1)break;return a},trim:G?function(a){return a==null?"":G.call(a)}:function(a){return a==null?"":(a+"").replace(k,"").replace(l,"")},makeArray:function(a,b){var c=b||[];if(a!=null){var d=e.type(a);a.length==null||d==="string"||d==="function"||d==="regexp"||e.isWindow(a)?E.call(c,a):e.merge(c,a)}return c},inArray:function(a,b,c){var d;if(b){if(H)return H.call(b,a,c);d=b.length,c=c?c<0?Math.max(0,d+c):c:0;for(;c<d;c++)if(c in b&&b[c]===a)return c}return-1},merge:function(a,c){var d=a.length,e=0;if(typeof c.length=="number")for(var f=c.length;e<f;e++)a[d++]=c[e];else while(c[e]!==b)a[d++]=c[e++];a.length=d;return a},grep:function(a,b,c){var d=[],e;c=!!c;for(var f=0,g=a.length;f<g;f++)e=!!b(a[f],f),c!==e&&d.push(a[f]);return d},map:function(a,c,d){var f,g,h=[],i=0,j=a.length,k=a instanceof e||j!==b&&typeof j=="number"&&(j>0&&a[0]&&a[j-1]||j===0||e.isArray(a));if(k)for(;i<j;i++)f=c(a[i],i,d),f!=null&&(h[h.length]=f);else for(g in a)f=c(a[g],g,d),f!=null&&(h[h.length]=f);return h.concat.apply([],h)},guid:1,proxy:function(a,c){if(typeof c=="string"){var d=a[c];c=a,a=d}if(!e.isFunction(a))return b;var f=F.call(arguments,2),g=function(){return a.apply(c,f.concat(F.call(arguments)))};g.guid=a.guid=a.guid||g.guid||e.guid++;return g},access:function(a,c,d,f,g,h){var i=a.length;if(typeof c=="object"){for(var j in c)e.access(a,j,c[j],f,g,d);return a}if(d!==b){f=!h&&f&&e.isFunction(d);for(var k=0;k<i;k++)g(a[k],c,f?d.call(a[k],k,g(a[k],c)):d,h);return a}return i?g(a[0],c):b},now:function(){return(new Date).getTime()},uaMatch:function(a){a=a.toLowerCase();var b=r.exec(a)||s.exec(a)||t.exec(a)||a.indexOf("compatible")<0&&u.exec(a)||[];return{browser:b[1]||"",version:b[2]||"0"}},sub:function(){function a(b,c){return new a.fn.init(b,c)}e.extend(!0,a,this),a.superclass=this,a.fn=a.prototype=this(),a.fn.constructor=a,a.sub=this.sub,a.fn.init=function(d,f){f&&f instanceof e&&!(f instanceof a)&&(f=a(f));return e.fn.init.call(this,d,f,b)},a.fn.init.prototype=a.fn;var b=a(c);return a},browser:{}}),e.each("Boolean Number String Function Array Date RegExp Object".split(" "),function(a,b){I["[object "+b+"]"]=b.toLowerCase()}),z=e.uaMatch(y),z.browser&&(e.browser[z.browser]=!0,e.browser.version=z.version),e.browser.webkit&&(e.browser.safari=!0),j.test(" ")&&(k=/^[\s\xA0]+/,l=/[\s\xA0]+$/),h=e(c),c.addEventListener?B=function(){c.removeEventListener("DOMContentLoaded",B,!1),e.ready()}:c.attachEvent&&(B=function(){c.readyState==="complete"&&(c.detachEvent("onreadystatechange",B),e.ready())});return e}(),g={};f.Callbacks=function(a){a=a?g[a]||h(a):{};var c=[],d=[],e,i,j,k,l,m=function(b){var d,e,g,h,i;for(d=0,e=b.length;d<e;d++)g=b[d],h=f.type(g),h==="array"?m(g):h==="function"&&(!a.unique||!o.has(g))&&c.push(g)},n=function(b,f){f=f||[],e=!a.memory||[b,f],i=!0,l=j||0,j=0,k=c.length;for(;c&&l<k;l++)if(c[l].apply(b,f)===!1&&a.stopOnFalse){e=!0;break}i=!1,c&&(a.once?e===!0?o.disable():c=[]:d&&d.length&&(e=d.shift(),o.fireWith(e[0],e[1])))},o={add:function(){if(c){var a=c.length;m(arguments),i?k=c.length:e&&e!==!0&&(j=a,n(e[0],e[1]))}return this},remove:function(){if(c){var b=arguments,d=0,e=b.length;for(;d<e;d++)for(var f=0;f<c.length;f++)if(b[d]===c[f]){i&&f<=k&&(k--,f<=l&&l--),c.splice(f--,1);if(a.unique)break}}return this},has:function(a){if(c){var b=0,d=c.length;for(;b<d;b++)if(a===c[b])return!0}return!1},empty:function(){c=[];return this},disable:function(){c=d=e=b;return this},disabled:function(){return!c},lock:function(){d=b,(!e||e===!0)&&o.disable();return this},locked:function(){return!d},fireWith:function(b,c){d&&(i?a.once||d.push([b,c]):(!a.once||!e)&&n(b,c));return this},fire:function(){o.fireWith(this,arguments);return this},fired:function(){return!!e}};return o};var i=[].slice;f.extend({Deferred:function(a){var b=f.Callbacks("once memory"),c=f.Callbacks("once memory"),d=f.Callbacks("memory"),e="pending",g={resolve:b,reject:c,notify:d},h={done:b.add,fail:c.add,progress:d.add,state:function(){return e},isResolved:b.fired,isRejected:c.fired,then:function(a,b,c){i.done(a).fail(b).progress(c);return this},always:function(){i.done.apply(i,arguments).fail.apply(i,arguments);return this},pipe:function(a,b,c){return f.Deferred(function(d){f.each({done:[a,"resolve"],fail:[b,"reject"],progress:[c,"notify"]},function(a,b){var c=b[0],e=b[1],g;f.isFunction(c)?i[a](function(){g=c.apply(this,arguments),g&&f.isFunction(g.promise)?g.promise().then(d.resolve,d.reject,d.notify):d[e+"With"](this===i?d:this,[g])}):i[a](d[e])})}).promise()},promise:function(a){if(a==null)a=h;else for(var b in h)a[b]=h[b];return a}},i=h.promise({}),j;for(j in g)i[j]=g[j].fire,i[j+"With"]=g[j].fireWith;i.done(function(){e="resolved"},c.disable,d.lock).fail(function(){e="rejected"},b.disable,d.lock),a&&a.call(i,i);return i},when:function(a){function m(a){return function(b){e[a]=arguments.length>1?i.call(arguments,0):b,j.notifyWith(k,e)}}function l(a){return function(c){b[a]=arguments.length>1?i.call(arguments,0):c,--g||j.resolveWith(j,b)}}var b=i.call(arguments,0),c=0,d=b.length,e=Array(d),g=d,h=d,j=d<=1&&a&&f.isFunction(a.promise)?a:f.Deferred(),k=j.promise();if(d>1){for(;c<d;c++)b[c]&&b[c].promise&&f.isFunction(b[c].promise)?b[c].promise().then(l(c),j.reject,m(c)):--g;g||j.resolveWith(j,b)}else j!==a&&j.resolveWith(j,d?[a]:[]);return k}}),f.support=function(){var b,d,e,g,h,i,j,k,l,m,n,o,p,q=c.createElement("div"),r=c.documentElement;q.setAttribute("className","t"),q.innerHTML="   <link/><table></table><a href='/a' style='top:1px;float:left;opacity:.55;'>a</a><input type='checkbox'/>",d=q.getElementsByTagName("*"),e=q.getElementsByTagName("a")[0];if(!d||!d.length||!e)return{};g=c.createElement("select"),h=g.appendChild(c.createElement("option")),i=q.getElementsByTagName("input")[0],b={leadingWhitespace:q.firstChild.nodeType===3,tbody:!q.getElementsByTagName("tbody").length,htmlSerialize:!!q.getElementsByTagName("link").length,style:/top/.test(e.getAttribute("style")),hrefNormalized:e.getAttribute("href")==="/a",opacity:/^0.55/.test(e.style.opacity),cssFloat:!!e.style.cssFloat,checkOn:i.value==="on",optSelected:h.selected,getSetAttribute:q.className!=="t",enctype:!!c.createElement("form").enctype,html5Clone:c.createElement("nav").cloneNode(!0).outerHTML!=="<:nav></:nav>",submitBubbles:!0,changeBubbles:!0,focusinBubbles:!1,deleteExpando:!0,noCloneEvent:!0,inlineBlockNeedsLayout:!1,shrinkWrapBlocks:!1,reliableMarginRight:!0},i.checked=!0,b.noCloneChecked=i.cloneNode(!0).checked,g.disabled=!0,b.optDisabled=!h.disabled;try{delete q.test}catch(s){b.deleteExpando=!1}!q.addEventListener&&q.attachEvent&&q.fireEvent&&(q.attachEvent("onclick",function(){b.noCloneEvent=!1}),q.cloneNode(!0).fireEvent("onclick")),i=c.createElement("input"),i.value="t",i.setAttribute("type","radio"),b.radioValue=i.value==="t",i.setAttribute("checked","checked"),q.appendChild(i),k=c.createDocumentFragment(),k.appendChild(q.lastChild),b.checkClone=k.cloneNode(!0).cloneNode(!0).lastChild.checked,b.appendChecked=i.checked,k.removeChild(i),k.appendChild(q),q.innerHTML="",a.getComputedStyle&&(j=c.createElement("div"),j.style.width="0",j.style.marginRight="0",q.style.width="2px",q.appendChild(j),b.reliableMarginRight=(parseInt((a.getComputedStyle(j,null)||{marginRight:0}).marginRight,10)||0)===0);if(q.attachEvent)for(o in{submit:1,change:1,focusin:1})n="on"+o,p=n in q,p||(q.setAttribute(n,"return;"),p=typeof q[n]=="function"),b[o+"Bubbles"]=p;k.removeChild(q),k=g=h=j=q=i=null,f(function(){var a,d,e,g,h,i,j,k,m,n,o,r=c.getElementsByTagName("body")[0];!r||(j=1,k="position:absolute;top:0;left:0;width:1px;height:1px;margin:0;",m="visibility:hidden;border:0;",n="style='"+k+"border:5px solid #000;padding:0;'",o="<div "+n+"><div></div></div>"+"<table "+n+" cellpadding='0' cellspacing='0'>"+"<tr><td></td></tr></table>",a=c.createElement("div"),a.style.cssText=m+"width:0;height:0;position:static;top:0;margin-top:"+j+"px",r.insertBefore(a,r.firstChild),q=c.createElement("div"),a.appendChild(q),q.innerHTML="<table><tr><td style='padding:0;border:0;display:none'></td><td>t</td></tr></table>",l=q.getElementsByTagName("td"),p=l[0].offsetHeight===0,l[0].style.display="",l[1].style.display="none",b.reliableHiddenOffsets=p&&l[0].offsetHeight===0,q.innerHTML="",q.style.width=q.style.paddingLeft="1px",f.boxModel=b.boxModel=q.offsetWidth===2,typeof q.style.zoom!="undefined"&&(q.style.display="inline",q.style.zoom=1,b.inlineBlockNeedsLayout=q.offsetWidth===2,q.style.display="",q.innerHTML="<div style='width:4px;'></div>",b.shrinkWrapBlocks=q.offsetWidth!==2),q.style.cssText=k+m,q.innerHTML=o,d=q.firstChild,e=d.firstChild,h=d.nextSibling.firstChild.firstChild,i={doesNotAddBorder:e.offsetTop!==5,doesAddBorderForTableAndCells:h.offsetTop===5},e.style.position="fixed",e.style.top="20px",i.fixedPosition=e.offsetTop===20||e.offsetTop===15,e.style.position=e.style.top="",d.style.overflow="hidden",d.style.position="relative",i.subtractsBorderForOverflowNotVisible=e.offsetTop===-5,i.doesNotIncludeMarginInBodyOffset=r.offsetTop!==j,r.removeChild(a),q=a=null,f.extend(b,i))});return b}();var j=/^(?:\{.*\}|\[.*\])$/,k=/([A-Z])/g;f.extend({cache:{},uuid:0,expando:"jQuery"+(f.fn.jquery+Math.random()).replace(/\D/g,""),noData:{embed:!0,object:"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000",applet:!0},hasData:function(a){a=a.nodeType?f.cache[a[f.expando]]:a[f.expando];return!!a&&!m(a)},data:function(a,c,d,e){if(!!f.acceptData(a)){var g,h,i,j=f.expando,k=typeof c=="string",l=a.nodeType,m=l?f.cache:a,n=l?a[j]:a[j]&&j,o=c==="events";if((!n||!m[n]||!o&&!e&&!m[n].data)&&k&&d===b)return;n||(l?a[j]=n=++f.uuid:n=j),m[n]||(m[n]={},l||(m[n].toJSON=f.noop));if(typeof c=="object"||typeof c=="function")e?m[n]=f.extend(m[n],c):m[n].data=f.extend(m[n].data,c);g=h=m[n],e||(h.data||(h.data={}),h=h.data),d!==b&&(h[f.camelCase(c)]=d);if(o&&!h[c])return g.events;k?(i=h[c],i==null&&(i=h[f.camelCase(c)])):i=h;return i}},removeData:function(a,b,c){if(!!f.acceptData(a)){var d,e,g,h=f.expando,i=a.nodeType,j=i?f.cache:a,k=i?a[h]:h;if(!j[k])return;if(b){d=c?j[k]:j[k].data;if(d){f.isArray(b)||(b in d?b=[b]:(b=f.camelCase(b),b in d?b=[b]:b=b.split(" ")));for(e=0,g=b.length;e<g;e++)delete d[b[e]];if(!(c?m:f.isEmptyObject)(d))return}}if(!c){delete j[k].data;if(!m(j[k]))return}f.support.deleteExpando||!j.setInterval?delete j[k]:j[k]=null,i&&(f.support.deleteExpando?delete a[h]:a.removeAttribute?a.removeAttribute(h):a[h]=null)}},_data:function(a,b,c){return f.data(a,b,c,!0)},acceptData:function(a){if(a.nodeName){var b=f.noData[a.nodeName.toLowerCase()];if(b)return b!==!0&&a.getAttribute("classid")===b}return!0}}),f.fn.extend({data:function(a,c){var d,e,g,h=null;if(typeof a=="undefined"){if(this.length){h=f.data(this[0]);if(this[0].nodeType===1&&!f._data(this[0],"parsedAttrs")){e=this[0].attributes;for(var i=0,j=e.length;i<j;i++)g=e[i].name,g.indexOf("data-")===0&&(g=f.camelCase(g.substring(5)),l(this[0],g,h[g]));f._data(this[0],"parsedAttrs",!0)}}return h}if(typeof a=="object")return this.each(function(){f.data(this,a)});d=a.split("."),d[1]=d[1]?"."+d[1]:"";if(c===b){h=this.triggerHandler("getData"+d[1]+"!",[d[0]]),h===b&&this.length&&(h=f.data(this[0],a),h=l(this[0],a,h));return h===b&&d[1]?this.data(d[0]):h}return this.each(function(){var b=f(this),e=[d[0],c];b.triggerHandler("setData"+d[1]+"!",e),f.data(this,a,c),b.triggerHandler("changeData"+d[1]+"!",e)})},removeData:function(a){return this.each(function(){f.removeData(this,a)})}}),f.extend({_mark:function(a,b){a&&(b=(b||"fx")+"mark",f._data(a,b,(f._data(a,b)||0)+1))},_unmark:function(a,b,c){a!==!0&&(c=b,b=a,a=!1);if(b){c=c||"fx";var d=c+"mark",e=a?0:(f._data(b,d)||1)-1;e?f._data(b,d,e):(f.removeData(b,d,!0),n(b,c,"mark"))}},queue:function(a,b,c){var d;if(a){b=(b||"fx")+"queue",d=f._data(a,b),c&&(!d||f.isArray(c)?d=f._data(a,b,f.makeArray(c)):d.push(c));return d||[]}},dequeue:function(a,b){b=b||"fx";var c=f.queue(a,b),d=c.shift(),e={};d==="inprogress"&&(d=c.shift()),d&&(b==="fx"&&c.unshift("inprogress"),f._data(a,b+".run",e),d.call(a,function(){f.dequeue(a,b)},e)),c.length||(f.removeData(a,b+"queue "+b+".run",!0),n(a,b,"queue"))}}),f.fn.extend({queue:function(a,c){typeof a!="string"&&(c=a,a="fx");if(c===b)return f.queue(this[0],a);return this.each(function(){var b=f.queue(this,a,c);a==="fx"&&b[0]!=="inprogress"&&f.dequeue(this,a)})},dequeue:function(a){return this.each(function(){f.dequeue(this,a)})},delay:function(a,b){a=f.fx?f.fx.speeds[a]||a:a,b=b||"fx";return this.queue(b,function(b,c){var d=setTimeout(b,a);c.stop=function(){clearTimeout(d)}})},clearQueue:function(a){return this.queue(a||"fx",[])},promise:function(a,c){function m(){--h||d.resolveWith(e,[e])}typeof a!="string"&&(c=a,a=b),a=a||"fx";var d=f.Deferred(),e=this,g=e.length,h=1,i=a+"defer",j=a+"queue",k=a+"mark",l;while(g--)if(l=f.data(e[g],i,b,!0)||(f.data(e[g],j,b,!0)||f.data(e[g],k,b,!0))&&f.data(e[g],i,f.Callbacks("once memory"),!0))h++,l.add(m);m();return d.promise()}});var o=/[\n\t\r]/g,p=/\s+/,q=/\r/g,r=/^(?:button|input)$/i,s=/^(?:button|input|object|select|textarea)$/i,t=/^a(?:rea)?$/i,u=/^(?:autofocus|autoplay|async|checked|controls|defer|disabled|hidden|loop|multiple|open|readonly|required|scoped|selected)$/i,v=f.support.getSetAttribute,w,x,y;f.fn.extend({attr:function(a,b){return f.access(this,a,b,!0,f.attr)},removeAttr:function(a){return this.each(function(){f.removeAttr(this,a)})},prop:function(a,b){return f.access(this,a,b,!0,f.prop)},removeProp:function(a){a=f.propFix[a]||a;return this.each(function(){try{this[a]=b,delete this[a]}catch(c){}})},addClass:function(a){var b,c,d,e,g,h,i;if(f.isFunction(a))return this.each(function(b){f(this).addClass(a.call(this,b,this.className))});if(a&&typeof a=="string"){b=a.split(p);for(c=0,d=this.length;c<d;c++){e=this[c];if(e.nodeType===1)if(!e.className&&b.length===1)e.className=a;else{g=" "+e.className+" ";for(h=0,i=b.length;h<i;h++)~g.indexOf(" "+b[h]+" ")||(g+=b[h]+" ");e.className=f.trim(g)}}}return this},removeClass:function(a){var c,d,e,g,h,i,j;if(f.isFunction(a))return this.each(function(b){f(this).removeClass(a.call(this,b,this.className))});if(a&&typeof a=="string"||a===b){c=(a||"").split(p);for(d=0,e=this.length;d<e;d++){g=this[d];if(g.nodeType===1&&g.className)if(a){h=(" "+g.className+" ").replace(o," ");for(i=0,j=c.length;i<j;i++)h=h.replace(" "+c[i]+" "," ");g.className=f.trim(h)}else g.className=""}}return this},toggleClass:function(a,b){var c=typeof a,d=typeof b=="boolean";if(f.isFunction(a))return this.each(function(c){f(this).toggleClass(a.call(this,c,this.className,b),b)});return this.each(function(){if(c==="string"){var e,g=0,h=f(this),i=b,j=a.split(p);while(e=j[g++])i=d?i:!h.hasClass(e),h[i?"addClass":"removeClass"](e)}else if(c==="undefined"||c==="boolean")this.className&&f._data(this,"__className__",this.className),this.className=this.className||a===!1?"":f._data(this,"__className__")||""})},hasClass:function(a){var b=" "+a+" ",c=0,d=this.length;for(;c<d;c++)if(this[c].nodeType===1&&(" "+this[c].className+" ").replace(o," ").indexOf(b)>-1)return!0;return!1},val:function(a){var c,d,e,g=this[0];{if(!!arguments.length){e=f.isFunction(a);return this.each(function(d){var g=f(this),h;if(this.nodeType===1){e?h=a.call(this,d,g.val()):h=a,h==null?h="":typeof h=="number"?h+="":f.isArray(h)&&(h=f.map(h,function(a){return a==null?"":a+""})),c=f.valHooks[this.nodeName.toLowerCase()]||f.valHooks[this.type];if(!c||!("set"in c)||c.set(this,h,"value")===b)this.value=h}})}if(g){c=f.valHooks[g.nodeName.toLowerCase()]||f.valHooks[g.type];if(c&&"get"in c&&(d=c.get(g,"value"))!==b)return d;d=g.value;return typeof d=="string"?d.replace(q,""):d==null?"":d}}}}),f.extend({valHooks:{option:{get:function(a){var b=a.attributes.value;return!b||b.specified?a.value:a.text}},select:{get:function(a){var b,c,d,e,g=a.selectedIndex,h=[],i=a.options,j=a.type==="select-one";if(g<0)return null;c=j?g:0,d=j?g+1:i.length;for(;c<d;c++){e=i[c];if(e.selected&&(f.support.optDisabled?!e.disabled:e.getAttribute("disabled")===null)&&(!e.parentNode.disabled||!f.nodeName(e.parentNode,"optgroup"))){b=f(e).val();if(j)return b;h.push(b)}}if(j&&!h.length&&i.length)return f(i[g]).val();return h},set:function(a,b){var c=f.makeArray(b);f(a).find("option").each(function(){this.selected=f.inArray(f(this).val(),c)>=0}),c.length||(a.selectedIndex=-1);return c}}},attrFn:{val:!0,css:!0,html:!0,text:!0,data:!0,width:!0,height:!0,offset:!0},attr:function(a,c,d,e){var g,h,i,j=a.nodeType;if(!!a&&j!==3&&j!==8&&j!==2){if(e&&c in f.attrFn)return f(a)[c](d);if(typeof a.getAttribute=="undefined")return f.prop(a,c,d);i=j!==1||!f.isXMLDoc(a),i&&(c=c.toLowerCase(),h=f.attrHooks[c]||(u.test(c)?x:w));if(d!==b){if(d===null){f.removeAttr(a,c);return}if(h&&"set"in h&&i&&(g=h.set(a,d,c))!==b)return g;a.setAttribute(c,""+d);return d}if(h&&"get"in h&&i&&(g=h.get(a,c))!==null)return g;g=a.getAttribute(c);return g===null?b:g}},removeAttr:function(a,b){var c,d,e,g,h=0;if(b&&a.nodeType===1){d=b.toLowerCase().split(p),g=d.length;for(;h<g;h++)e=d[h],e&&(c=f.propFix[e]||e,f.attr(a,e,""),a.removeAttribute(v?e:c),u.test(e)&&c in a&&(a[c]=!1))}},attrHooks:{type:{set:function(a,b){if(r.test(a.nodeName)&&a.parentNode)f.error("type property can't be changed");else if(!f.support.radioValue&&b==="radio"&&f.nodeName(a,"input")){var c=a.value;a.setAttribute("type",b),c&&(a.value=c);return b}}},value:{get:function(a,b){if(w&&f.nodeName(a,"button"))return w.get(a,b);return b in a?a.value:null},set:function(a,b,c){if(w&&f.nodeName(a,"button"))return w.set(a,b,c);a.value=b}}},propFix:{tabindex:"tabIndex",readonly:"readOnly","for":"htmlFor","class":"className",maxlength:"maxLength",cellspacing:"cellSpacing",cellpadding:"cellPadding",rowspan:"rowSpan",colspan:"colSpan",usemap:"useMap",frameborder:"frameBorder",contenteditable:"contentEditable"},prop:function(a,c,d){var e,g,h,i=a.nodeType;if(!!a&&i!==3&&i!==8&&i!==2){h=i!==1||!f.isXMLDoc(a),h&&(c=f.propFix[c]||c,g=f.propHooks[c]);return d!==b?g&&"set"in g&&(e=g.set(a,d,c))!==b?e:a[c]=d:g&&"get"in g&&(e=g.get(a,c))!==null?e:a[c]}},propHooks:{tabIndex:{get:function(a){var c=a.getAttributeNode("tabindex");return c&&c.specified?parseInt(c.value,10):s.test(a.nodeName)||t.test(a.nodeName)&&a.href?0:b}}}}),f.attrHooks.tabindex=f.propHooks.tabIndex,x={get:function(a,c){var d,e=f.prop(a,c);return e===!0||typeof e!="boolean"&&(d=a.getAttributeNode(c))&&d.nodeValue!==!1?c.toLowerCase():b},set:function(a,b,c){var d;b===!1?f.removeAttr(a,c):(d=f.propFix[c]||c,d in a&&(a[d]=!0),a.setAttribute(c,c.toLowerCase()));return c}},v||(y={name:!0,id:!0},w=f.valHooks.button={get:function(a,c){var d;d=a.getAttributeNode(c);return d&&(y[c]?d.nodeValue!=="":d.specified)?d.nodeValue:b},set:function(a,b,d){var e=a.getAttributeNode(d);e||(e=c.createAttribute(d),a.setAttributeNode(e));return e.nodeValue=b+""}},f.attrHooks.tabindex.set=w.set,f.each(["width","height"],function(a,b){f.attrHooks[b]=f.extend(f.attrHooks[b],{set:function(a,c){if(c===""){a.setAttribute(b,"auto");return c}}})}),f.attrHooks.contenteditable={get:w.get,set:function(a,b,c){b===""&&(b="false"),w.set(a,b,c)}}),f.support.hrefNormalized||f.each(["href","src","width","height"],function(a,c){f.attrHooks[c]=f.extend(f.attrHooks[c],{get:function(a){var d=a.getAttribute(c,2);return d===null?b:d}})}),f.support.style||(f.attrHooks.style={get:function(a){return a.style.cssText.toLowerCase()||b},set:function(a,b){return a.style.cssText=""+b}}),f.support.optSelected||(f.propHooks.selected=f.extend(f.propHooks.selected,{get:function(a){var b=a.parentNode;b&&(b.selectedIndex,b.parentNode&&b.parentNode.selectedIndex);return null}})),f.support.enctype||(f.propFix.enctype="encoding"),f.support.checkOn||f.each(["radio","checkbox"],function(){f.valHooks[this]={get:function(a){return a.getAttribute("value")===null?"on":a.value}}}),f.each(["radio","checkbox"],function(){f.valHooks[this]=f.extend(f.valHooks[this],{set:function(a,b){if(f.isArray(b))return a.checked=f.inArray(f(a).val(),b)>=0}})});var z=/^(?:textarea|input|select)$/i,A=/^([^\.]*)?(?:\.(.+))?$/,B=/\bhover(\.\S+)?\b/,C=/^key/,D=/^(?:mouse|contextmenu)|click/,E=/^(?:focusinfocus|focusoutblur)$/,F=/^(\w*)(?:#([\w\-]+))?(?:\.([\w\-]+))?$/,G=function(a){var b=F.exec(a);b&&(b[1]=(b[1]||"").toLowerCase(),b[3]=b[3]&&new RegExp("(?:^|\\s)"+b[3]+"(?:\\s|$)"));return b},H=function(a,b){var c=a.attributes||{};return(!b[1]||a.nodeName.toLowerCase()===b[1])&&(!b[2]||(c.id||{}).value===b[2])&&(!b[3]||b[3].test((c["class"]||{}).value))},I=function(a){return f.event.special.hover?a:a.replace(B,"mouseenter$1 mouseleave$1")};
f.event={add:function(a,c,d,e,g){var h,i,j,k,l,m,n,o,p,q,r,s;if(!(a.nodeType===3||a.nodeType===8||!c||!d||!(h=f._data(a)))){d.handler&&(p=d,d=p.handler),d.guid||(d.guid=f.guid++),j=h.events,j||(h.events=j={}),i=h.handle,i||(h.handle=i=function(a){return typeof f!="undefined"&&(!a||f.event.triggered!==a.type)?f.event.dispatch.apply(i.elem,arguments):b},i.elem=a),c=f.trim(I(c)).split(" ");for(k=0;k<c.length;k++){l=A.exec(c[k])||[],m=l[1],n=(l[2]||"").split(".").sort(),s=f.event.special[m]||{},m=(g?s.delegateType:s.bindType)||m,s=f.event.special[m]||{},o=f.extend({type:m,origType:l[1],data:e,handler:d,guid:d.guid,selector:g,quick:G(g),namespace:n.join(".")},p),r=j[m];if(!r){r=j[m]=[],r.delegateCount=0;if(!s.setup||s.setup.call(a,e,n,i)===!1)a.addEventListener?a.addEventListener(m,i,!1):a.attachEvent&&a.attachEvent("on"+m,i)}s.add&&(s.add.call(a,o),o.handler.guid||(o.handler.guid=d.guid)),g?r.splice(r.delegateCount++,0,o):r.push(o),f.event.global[m]=!0}a=null}},global:{},remove:function(a,b,c,d,e){var g=f.hasData(a)&&f._data(a),h,i,j,k,l,m,n,o,p,q,r,s;if(!!g&&!!(o=g.events)){b=f.trim(I(b||"")).split(" ");for(h=0;h<b.length;h++){i=A.exec(b[h])||[],j=k=i[1],l=i[2];if(!j){for(j in o)f.event.remove(a,j+b[h],c,d,!0);continue}p=f.event.special[j]||{},j=(d?p.delegateType:p.bindType)||j,r=o[j]||[],m=r.length,l=l?new RegExp("(^|\\.)"+l.split(".").sort().join("\\.(?:.*\\.)?")+"(\\.|$)"):null;for(n=0;n<r.length;n++)s=r[n],(e||k===s.origType)&&(!c||c.guid===s.guid)&&(!l||l.test(s.namespace))&&(!d||d===s.selector||d==="**"&&s.selector)&&(r.splice(n--,1),s.selector&&r.delegateCount--,p.remove&&p.remove.call(a,s));r.length===0&&m!==r.length&&((!p.teardown||p.teardown.call(a,l)===!1)&&f.removeEvent(a,j,g.handle),delete o[j])}f.isEmptyObject(o)&&(q=g.handle,q&&(q.elem=null),f.removeData(a,["events","handle"],!0))}},customEvent:{getData:!0,setData:!0,changeData:!0},trigger:function(c,d,e,g){if(!e||e.nodeType!==3&&e.nodeType!==8){var h=c.type||c,i=[],j,k,l,m,n,o,p,q,r,s;if(E.test(h+f.event.triggered))return;h.indexOf("!")>=0&&(h=h.slice(0,-1),k=!0),h.indexOf(".")>=0&&(i=h.split("."),h=i.shift(),i.sort());if((!e||f.event.customEvent[h])&&!f.event.global[h])return;c=typeof c=="object"?c[f.expando]?c:new f.Event(h,c):new f.Event(h),c.type=h,c.isTrigger=!0,c.exclusive=k,c.namespace=i.join("."),c.namespace_re=c.namespace?new RegExp("(^|\\.)"+i.join("\\.(?:.*\\.)?")+"(\\.|$)"):null,o=h.indexOf(":")<0?"on"+h:"";if(!e){j=f.cache;for(l in j)j[l].events&&j[l].events[h]&&f.event.trigger(c,d,j[l].handle.elem,!0);return}c.result=b,c.target||(c.target=e),d=d!=null?f.makeArray(d):[],d.unshift(c),p=f.event.special[h]||{};if(p.trigger&&p.trigger.apply(e,d)===!1)return;r=[[e,p.bindType||h]];if(!g&&!p.noBubble&&!f.isWindow(e)){s=p.delegateType||h,m=E.test(s+h)?e:e.parentNode,n=null;for(;m;m=m.parentNode)r.push([m,s]),n=m;n&&n===e.ownerDocument&&r.push([n.defaultView||n.parentWindow||a,s])}for(l=0;l<r.length&&!c.isPropagationStopped();l++)m=r[l][0],c.type=r[l][1],q=(f._data(m,"events")||{})[c.type]&&f._data(m,"handle"),q&&q.apply(m,d),q=o&&m[o],q&&f.acceptData(m)&&q.apply(m,d)===!1&&c.preventDefault();c.type=h,!g&&!c.isDefaultPrevented()&&(!p._default||p._default.apply(e.ownerDocument,d)===!1)&&(h!=="click"||!f.nodeName(e,"a"))&&f.acceptData(e)&&o&&e[h]&&(h!=="focus"&&h!=="blur"||c.target.offsetWidth!==0)&&!f.isWindow(e)&&(n=e[o],n&&(e[o]=null),f.event.triggered=h,e[h](),f.event.triggered=b,n&&(e[o]=n));return c.result}},dispatch:function(c){c=f.event.fix(c||a.event);var d=(f._data(this,"events")||{})[c.type]||[],e=d.delegateCount,g=[].slice.call(arguments,0),h=!c.exclusive&&!c.namespace,i=[],j,k,l,m,n,o,p,q,r,s,t;g[0]=c,c.delegateTarget=this;if(e&&!c.target.disabled&&(!c.button||c.type!=="click")){m=f(this),m.context=this.ownerDocument||this;for(l=c.target;l!=this;l=l.parentNode||this){o={},q=[],m[0]=l;for(j=0;j<e;j++)r=d[j],s=r.selector,o[s]===b&&(o[s]=r.quick?H(l,r.quick):m.is(s)),o[s]&&q.push(r);q.length&&i.push({elem:l,matches:q})}}d.length>e&&i.push({elem:this,matches:d.slice(e)});for(j=0;j<i.length&&!c.isPropagationStopped();j++){p=i[j],c.currentTarget=p.elem;for(k=0;k<p.matches.length&&!c.isImmediatePropagationStopped();k++){r=p.matches[k];if(h||!c.namespace&&!r.namespace||c.namespace_re&&c.namespace_re.test(r.namespace))c.data=r.data,c.handleObj=r,n=((f.event.special[r.origType]||{}).handle||r.handler).apply(p.elem,g),n!==b&&(c.result=n,n===!1&&(c.preventDefault(),c.stopPropagation()))}}return c.result},props:"attrChange attrName relatedNode srcElement altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),fixHooks:{},keyHooks:{props:"char charCode key keyCode".split(" "),filter:function(a,b){a.which==null&&(a.which=b.charCode!=null?b.charCode:b.keyCode);return a}},mouseHooks:{props:"button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "),filter:function(a,d){var e,f,g,h=d.button,i=d.fromElement;a.pageX==null&&d.clientX!=null&&(e=a.target.ownerDocument||c,f=e.documentElement,g=e.body,a.pageX=d.clientX+(f&&f.scrollLeft||g&&g.scrollLeft||0)-(f&&f.clientLeft||g&&g.clientLeft||0),a.pageY=d.clientY+(f&&f.scrollTop||g&&g.scrollTop||0)-(f&&f.clientTop||g&&g.clientTop||0)),!a.relatedTarget&&i&&(a.relatedTarget=i===a.target?d.toElement:i),!a.which&&h!==b&&(a.which=h&1?1:h&2?3:h&4?2:0);return a}},fix:function(a){if(a[f.expando])return a;var d,e,g=a,h=f.event.fixHooks[a.type]||{},i=h.props?this.props.concat(h.props):this.props;a=f.Event(g);for(d=i.length;d;)e=i[--d],a[e]=g[e];a.target||(a.target=g.srcElement||c),a.target.nodeType===3&&(a.target=a.target.parentNode),a.metaKey===b&&(a.metaKey=a.ctrlKey);return h.filter?h.filter(a,g):a},special:{ready:{setup:f.bindReady},load:{noBubble:!0},focus:{delegateType:"focusin"},blur:{delegateType:"focusout"},beforeunload:{setup:function(a,b,c){f.isWindow(this)&&(this.onbeforeunload=c)},teardown:function(a,b){this.onbeforeunload===b&&(this.onbeforeunload=null)}}},simulate:function(a,b,c,d){var e=f.extend(new f.Event,c,{type:a,isSimulated:!0,originalEvent:{}});d?f.event.trigger(e,null,b):f.event.dispatch.call(b,e),e.isDefaultPrevented()&&c.preventDefault()}},f.event.handle=f.event.dispatch,f.removeEvent=c.removeEventListener?function(a,b,c){a.removeEventListener&&a.removeEventListener(b,c,!1)}:function(a,b,c){a.detachEvent&&a.detachEvent("on"+b,c)},f.Event=function(a,b){if(!(this instanceof f.Event))return new f.Event(a,b);a&&a.type?(this.originalEvent=a,this.type=a.type,this.isDefaultPrevented=a.defaultPrevented||a.returnValue===!1||a.getPreventDefault&&a.getPreventDefault()?K:J):this.type=a,b&&f.extend(this,b),this.timeStamp=a&&a.timeStamp||f.now(),this[f.expando]=!0},f.Event.prototype={preventDefault:function(){this.isDefaultPrevented=K;var a=this.originalEvent;!a||(a.preventDefault?a.preventDefault():a.returnValue=!1)},stopPropagation:function(){this.isPropagationStopped=K;var a=this.originalEvent;!a||(a.stopPropagation&&a.stopPropagation(),a.cancelBubble=!0)},stopImmediatePropagation:function(){this.isImmediatePropagationStopped=K,this.stopPropagation()},isDefaultPrevented:J,isPropagationStopped:J,isImmediatePropagationStopped:J},f.each({mouseenter:"mouseover",mouseleave:"mouseout"},function(a,b){f.event.special[a]={delegateType:b,bindType:b,handle:function(a){var c=this,d=a.relatedTarget,e=a.handleObj,g=e.selector,h;if(!d||d!==c&&!f.contains(c,d))a.type=e.origType,h=e.handler.apply(this,arguments),a.type=b;return h}}}),f.support.submitBubbles||(f.event.special.submit={setup:function(){if(f.nodeName(this,"form"))return!1;f.event.add(this,"click._submit keypress._submit",function(a){var c=a.target,d=f.nodeName(c,"input")||f.nodeName(c,"button")?c.form:b;d&&!d._submit_attached&&(f.event.add(d,"submit._submit",function(a){this.parentNode&&!a.isTrigger&&f.event.simulate("submit",this.parentNode,a,!0)}),d._submit_attached=!0)})},teardown:function(){if(f.nodeName(this,"form"))return!1;f.event.remove(this,"._submit")}}),f.support.changeBubbles||(f.event.special.change={setup:function(){if(z.test(this.nodeName)){if(this.type==="checkbox"||this.type==="radio")f.event.add(this,"propertychange._change",function(a){a.originalEvent.propertyName==="checked"&&(this._just_changed=!0)}),f.event.add(this,"click._change",function(a){this._just_changed&&!a.isTrigger&&(this._just_changed=!1,f.event.simulate("change",this,a,!0))});return!1}f.event.add(this,"beforeactivate._change",function(a){var b=a.target;z.test(b.nodeName)&&!b._change_attached&&(f.event.add(b,"change._change",function(a){this.parentNode&&!a.isSimulated&&!a.isTrigger&&f.event.simulate("change",this.parentNode,a,!0)}),b._change_attached=!0)})},handle:function(a){var b=a.target;if(this!==b||a.isSimulated||a.isTrigger||b.type!=="radio"&&b.type!=="checkbox")return a.handleObj.handler.apply(this,arguments)},teardown:function(){f.event.remove(this,"._change");return z.test(this.nodeName)}}),f.support.focusinBubbles||f.each({focus:"focusin",blur:"focusout"},function(a,b){var d=0,e=function(a){f.event.simulate(b,a.target,f.event.fix(a),!0)};f.event.special[b]={setup:function(){d++===0&&c.addEventListener(a,e,!0)},teardown:function(){--d===0&&c.removeEventListener(a,e,!0)}}}),f.fn.extend({on:function(a,c,d,e,g){var h,i;if(typeof a=="object"){typeof c!="string"&&(d=c,c=b);for(i in a)this.on(i,c,d,a[i],g);return this}d==null&&e==null?(e=c,d=c=b):e==null&&(typeof c=="string"?(e=d,d=b):(e=d,d=c,c=b));if(e===!1)e=J;else if(!e)return this;g===1&&(h=e,e=function(a){f().off(a);return h.apply(this,arguments)},e.guid=h.guid||(h.guid=f.guid++));return this.each(function(){f.event.add(this,a,e,d,c)})},one:function(a,b,c,d){return this.on.call(this,a,b,c,d,1)},off:function(a,c,d){if(a&&a.preventDefault&&a.handleObj){var e=a.handleObj;f(a.delegateTarget).off(e.namespace?e.type+"."+e.namespace:e.type,e.selector,e.handler);return this}if(typeof a=="object"){for(var g in a)this.off(g,c,a[g]);return this}if(c===!1||typeof c=="function")d=c,c=b;d===!1&&(d=J);return this.each(function(){f.event.remove(this,a,d,c)})},bind:function(a,b,c){return this.on(a,null,b,c)},unbind:function(a,b){return this.off(a,null,b)},live:function(a,b,c){f(this.context).on(a,this.selector,b,c);return this},die:function(a,b){f(this.context).off(a,this.selector||"**",b);return this},delegate:function(a,b,c,d){return this.on(b,a,c,d)},undelegate:function(a,b,c){return arguments.length==1?this.off(a,"**"):this.off(b,a,c)},trigger:function(a,b){return this.each(function(){f.event.trigger(a,b,this)})},triggerHandler:function(a,b){if(this[0])return f.event.trigger(a,b,this[0],!0)},toggle:function(a){var b=arguments,c=a.guid||f.guid++,d=0,e=function(c){var e=(f._data(this,"lastToggle"+a.guid)||0)%d;f._data(this,"lastToggle"+a.guid,e+1),c.preventDefault();return b[e].apply(this,arguments)||!1};e.guid=c;while(d<b.length)b[d++].guid=c;return this.click(e)},hover:function(a,b){return this.mouseenter(a).mouseleave(b||a)}}),f.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "),function(a,b){f.fn[b]=function(a,c){c==null&&(c=a,a=null);return arguments.length>0?this.on(b,null,a,c):this.trigger(b)},f.attrFn&&(f.attrFn[b]=!0),C.test(b)&&(f.event.fixHooks[b]=f.event.keyHooks),D.test(b)&&(f.event.fixHooks[b]=f.event.mouseHooks)}),function(){function x(a,b,c,e,f,g){for(var h=0,i=e.length;h<i;h++){var j=e[h];if(j){var k=!1;j=j[a];while(j){if(j[d]===c){k=e[j.sizset];break}if(j.nodeType===1){g||(j[d]=c,j.sizset=h);if(typeof b!="string"){if(j===b){k=!0;break}}else if(m.filter(b,[j]).length>0){k=j;break}}j=j[a]}e[h]=k}}}function w(a,b,c,e,f,g){for(var h=0,i=e.length;h<i;h++){var j=e[h];if(j){var k=!1;j=j[a];while(j){if(j[d]===c){k=e[j.sizset];break}j.nodeType===1&&!g&&(j[d]=c,j.sizset=h);if(j.nodeName.toLowerCase()===b){k=j;break}j=j[a]}e[h]=k}}}var a=/((?:\((?:\([^()]+\)|[^()]+)+\)|\[(?:\[[^\[\]]*\]|['"][^'"]*['"]|[^\[\]'"]+)+\]|\\.|[^ >+~,(\[\\]+)+|[>+~])(\s*,\s*)?((?:.|\r|\n)*)/g,d="sizcache"+(Math.random()+"").replace(".",""),e=0,g=Object.prototype.toString,h=!1,i=!0,j=/\\/g,k=/\r\n/g,l=/\W/;[0,0].sort(function(){i=!1;return 0});var m=function(b,d,e,f){e=e||[],d=d||c;var h=d;if(d.nodeType!==1&&d.nodeType!==9)return[];if(!b||typeof b!="string")return e;var i,j,k,l,n,q,r,t,u=!0,v=m.isXML(d),w=[],x=b;do{a.exec(""),i=a.exec(x);if(i){x=i[3],w.push(i[1]);if(i[2]){l=i[3];break}}}while(i);if(w.length>1&&p.exec(b))if(w.length===2&&o.relative[w[0]])j=y(w[0]+w[1],d,f);else{j=o.relative[w[0]]?[d]:m(w.shift(),d);while(w.length)b=w.shift(),o.relative[b]&&(b+=w.shift()),j=y(b,j,f)}else{!f&&w.length>1&&d.nodeType===9&&!v&&o.match.ID.test(w[0])&&!o.match.ID.test(w[w.length-1])&&(n=m.find(w.shift(),d,v),d=n.expr?m.filter(n.expr,n.set)[0]:n.set[0]);if(d){n=f?{expr:w.pop(),set:s(f)}:m.find(w.pop(),w.length===1&&(w[0]==="~"||w[0]==="+")&&d.parentNode?d.parentNode:d,v),j=n.expr?m.filter(n.expr,n.set):n.set,w.length>0?k=s(j):u=!1;while(w.length)q=w.pop(),r=q,o.relative[q]?r=w.pop():q="",r==null&&(r=d),o.relative[q](k,r,v)}else k=w=[]}k||(k=j),k||m.error(q||b);if(g.call(k)==="[object Array]")if(!u)e.push.apply(e,k);else if(d&&d.nodeType===1)for(t=0;k[t]!=null;t++)k[t]&&(k[t]===!0||k[t].nodeType===1&&m.contains(d,k[t]))&&e.push(j[t]);else for(t=0;k[t]!=null;t++)k[t]&&k[t].nodeType===1&&e.push(j[t]);else s(k,e);l&&(m(l,h,e,f),m.uniqueSort(e));return e};m.uniqueSort=function(a){if(u){h=i,a.sort(u);if(h)for(var b=1;b<a.length;b++)a[b]===a[b-1]&&a.splice(b--,1)}return a},m.matches=function(a,b){return m(a,null,null,b)},m.matchesSelector=function(a,b){return m(b,null,null,[a]).length>0},m.find=function(a,b,c){var d,e,f,g,h,i;if(!a)return[];for(e=0,f=o.order.length;e<f;e++){h=o.order[e];if(g=o.leftMatch[h].exec(a)){i=g[1],g.splice(1,1);if(i.substr(i.length-1)!=="\\"){g[1]=(g[1]||"").replace(j,""),d=o.find[h](g,b,c);if(d!=null){a=a.replace(o.match[h],"");break}}}}d||(d=typeof b.getElementsByTagName!="undefined"?b.getElementsByTagName("*"):[]);return{set:d,expr:a}},m.filter=function(a,c,d,e){var f,g,h,i,j,k,l,n,p,q=a,r=[],s=c,t=c&&c[0]&&m.isXML(c[0]);while(a&&c.length){for(h in o.filter)if((f=o.leftMatch[h].exec(a))!=null&&f[2]){k=o.filter[h],l=f[1],g=!1,f.splice(1,1);if(l.substr(l.length-1)==="\\")continue;s===r&&(r=[]);if(o.preFilter[h]){f=o.preFilter[h](f,s,d,r,e,t);if(!f)g=i=!0;else if(f===!0)continue}if(f)for(n=0;(j=s[n])!=null;n++)j&&(i=k(j,f,n,s),p=e^i,d&&i!=null?p?g=!0:s[n]=!1:p&&(r.push(j),g=!0));if(i!==b){d||(s=r),a=a.replace(o.match[h],"");if(!g)return[];break}}if(a===q)if(g==null)m.error(a);else break;q=a}return s},m.error=function(a){throw new Error("Syntax error, unrecognized expression: "+a)};var n=m.getText=function(a){var b,c,d=a.nodeType,e="";if(d){if(d===1||d===9){if(typeof a.textContent=="string")return a.textContent;if(typeof a.innerText=="string")return a.innerText.replace(k,"");for(a=a.firstChild;a;a=a.nextSibling)e+=n(a)}else if(d===3||d===4)return a.nodeValue}else for(b=0;c=a[b];b++)c.nodeType!==8&&(e+=n(c));return e},o=m.selectors={order:["ID","NAME","TAG"],match:{ID:/#((?:[\w\u00c0-\uFFFF\-]|\\.)+)/,CLASS:/\.((?:[\w\u00c0-\uFFFF\-]|\\.)+)/,NAME:/\[name=['"]*((?:[\w\u00c0-\uFFFF\-]|\\.)+)['"]*\]/,ATTR:/\[\s*((?:[\w\u00c0-\uFFFF\-]|\\.)+)\s*(?:(\S?=)\s*(?:(['"])(.*?)\3|(#?(?:[\w\u00c0-\uFFFF\-]|\\.)*)|)|)\s*\]/,TAG:/^((?:[\w\u00c0-\uFFFF\*\-]|\\.)+)/,CHILD:/:(only|nth|last|first)-child(?:\(\s*(even|odd|(?:[+\-]?\d+|(?:[+\-]?\d*)?n\s*(?:[+\-]\s*\d+)?))\s*\))?/,POS:/:(nth|eq|gt|lt|first|last|even|odd)(?:\((\d*)\))?(?=[^\-]|$)/,PSEUDO:/:((?:[\w\u00c0-\uFFFF\-]|\\.)+)(?:\((['"]?)((?:\([^\)]+\)|[^\(\)]*)+)\2\))?/},leftMatch:{},attrMap:{"class":"className","for":"htmlFor"},attrHandle:{href:function(a){return a.getAttribute("href")},type:function(a){return a.getAttribute("type")}},relative:{"+":function(a,b){var c=typeof b=="string",d=c&&!l.test(b),e=c&&!d;d&&(b=b.toLowerCase());for(var f=0,g=a.length,h;f<g;f++)if(h=a[f]){while((h=h.previousSibling)&&h.nodeType!==1);a[f]=e||h&&h.nodeName.toLowerCase()===b?h||!1:h===b}e&&m.filter(b,a,!0)},">":function(a,b){var c,d=typeof b=="string",e=0,f=a.length;if(d&&!l.test(b)){b=b.toLowerCase();for(;e<f;e++){c=a[e];if(c){var g=c.parentNode;a[e]=g.nodeName.toLowerCase()===b?g:!1}}}else{for(;e<f;e++)c=a[e],c&&(a[e]=d?c.parentNode:c.parentNode===b);d&&m.filter(b,a,!0)}},"":function(a,b,c){var d,f=e++,g=x;typeof b=="string"&&!l.test(b)&&(b=b.toLowerCase(),d=b,g=w),g("parentNode",b,f,a,d,c)},"~":function(a,b,c){var d,f=e++,g=x;typeof b=="string"&&!l.test(b)&&(b=b.toLowerCase(),d=b,g=w),g("previousSibling",b,f,a,d,c)}},find:{ID:function(a,b,c){if(typeof b.getElementById!="undefined"&&!c){var d=b.getElementById(a[1]);return d&&d.parentNode?[d]:[]}},NAME:function(a,b){if(typeof b.getElementsByName!="undefined"){var c=[],d=b.getElementsByName(a[1]);for(var e=0,f=d.length;e<f;e++)d[e].getAttribute("name")===a[1]&&c.push(d[e]);return c.length===0?null:c}},TAG:function(a,b){if(typeof b.getElementsByTagName!="undefined")return b.getElementsByTagName(a[1])}},preFilter:{CLASS:function(a,b,c,d,e,f){a=" "+a[1].replace(j,"")+" ";if(f)return a;for(var g=0,h;(h=b[g])!=null;g++)h&&(e^(h.className&&(" "+h.className+" ").replace(/[\t\n\r]/g," ").indexOf(a)>=0)?c||d.push(h):c&&(b[g]=!1));return!1},ID:function(a){return a[1].replace(j,"")},TAG:function(a,b){return a[1].replace(j,"").toLowerCase()},CHILD:function(a){if(a[1]==="nth"){a[2]||m.error(a[0]),a[2]=a[2].replace(/^\+|\s*/g,"");var b=/(-?)(\d*)(?:n([+\-]?\d*))?/.exec(a[2]==="even"&&"2n"||a[2]==="odd"&&"2n+1"||!/\D/.test(a[2])&&"0n+"+a[2]||a[2]);a[2]=b[1]+(b[2]||1)-0,a[3]=b[3]-0}else a[2]&&m.error(a[0]);a[0]=e++;return a},ATTR:function(a,b,c,d,e,f){var g=a[1]=a[1].replace(j,"");!f&&o.attrMap[g]&&(a[1]=o.attrMap[g]),a[4]=(a[4]||a[5]||"").replace(j,""),a[2]==="~="&&(a[4]=" "+a[4]+" ");return a},PSEUDO:function(b,c,d,e,f){if(b[1]==="not")if((a.exec(b[3])||"").length>1||/^\w/.test(b[3]))b[3]=m(b[3],null,null,c);else{var g=m.filter(b[3],c,d,!0^f);d||e.push.apply(e,g);return!1}else if(o.match.POS.test(b[0])||o.match.CHILD.test(b[0]))return!0;return b},POS:function(a){a.unshift(!0);return a}},filters:{enabled:function(a){return a.disabled===!1&&a.type!=="hidden"},disabled:function(a){return a.disabled===!0},checked:function(a){return a.checked===!0},selected:function(a){a.parentNode&&a.parentNode.selectedIndex;return a.selected===!0},parent:function(a){return!!a.firstChild},empty:function(a){return!a.firstChild},has:function(a,b,c){return!!m(c[3],a).length},header:function(a){return/h\d/i.test(a.nodeName)},text:function(a){var b=a.getAttribute("type"),c=a.type;return a.nodeName.toLowerCase()==="input"&&"text"===c&&(b===c||b===null)},radio:function(a){return a.nodeName.toLowerCase()==="input"&&"radio"===a.type},checkbox:function(a){return a.nodeName.toLowerCase()==="input"&&"checkbox"===a.type},file:function(a){return a.nodeName.toLowerCase()==="input"&&"file"===a.type},password:function(a){return a.nodeName.toLowerCase()==="input"&&"password"===a.type},submit:function(a){var b=a.nodeName.toLowerCase();return(b==="input"||b==="button")&&"submit"===a.type},image:function(a){return a.nodeName.toLowerCase()==="input"&&"image"===a.type},reset:function(a){var b=a.nodeName.toLowerCase();return(b==="input"||b==="button")&&"reset"===a.type},button:function(a){var b=a.nodeName.toLowerCase();return b==="input"&&"button"===a.type||b==="button"},input:function(a){return/input|select|textarea|button/i.test(a.nodeName)},focus:function(a){return a===a.ownerDocument.activeElement}},setFilters:{first:function(a,b){return b===0},last:function(a,b,c,d){return b===d.length-1},even:function(a,b){return b%2===0},odd:function(a,b){return b%2===1},lt:function(a,b,c){return b<c[3]-0},gt:function(a,b,c){return b>c[3]-0},nth:function(a,b,c){return c[3]-0===b},eq:function(a,b,c){return c[3]-0===b}},filter:{PSEUDO:function(a,b,c,d){var e=b[1],f=o.filters[e];if(f)return f(a,c,b,d);if(e==="contains")return(a.textContent||a.innerText||n([a])||"").indexOf(b[3])>=0;if(e==="not"){var g=b[3];for(var h=0,i=g.length;h<i;h++)if(g[h]===a)return!1;return!0}m.error(e)},CHILD:function(a,b){var c,e,f,g,h,i,j,k=b[1],l=a;switch(k){case"only":case"first":while(l=l.previousSibling)if(l.nodeType===1)return!1;if(k==="first")return!0;l=a;case"last":while(l=l.nextSibling)if(l.nodeType===1)return!1;return!0;case"nth":c=b[2],e=b[3];if(c===1&&e===0)return!0;f=b[0],g=a.parentNode;if(g&&(g[d]!==f||!a.nodeIndex)){i=0;for(l=g.firstChild;l;l=l.nextSibling)l.nodeType===1&&(l.nodeIndex=++i);g[d]=f}j=a.nodeIndex-e;return c===0?j===0:j%c===0&&j/c>=0}},ID:function(a,b){return a.nodeType===1&&a.getAttribute("id")===b},TAG:function(a,b){return b==="*"&&a.nodeType===1||!!a.nodeName&&a.nodeName.toLowerCase()===b},CLASS:function(a,b){return(" "+(a.className||a.getAttribute("class"))+" ").indexOf(b)>-1},ATTR:function(a,b){var c=b[1],d=m.attr?m.attr(a,c):o.attrHandle[c]?o.attrHandle[c](a):a[c]!=null?a[c]:a.getAttribute(c),e=d+"",f=b[2],g=b[4];return d==null?f==="!=":!f&&m.attr?d!=null:f==="="?e===g:f==="*="?e.indexOf(g)>=0:f==="~="?(" "+e+" ").indexOf(g)>=0:g?f==="!="?e!==g:f==="^="?e.indexOf(g)===0:f==="$="?e.substr(e.length-g.length)===g:f==="|="?e===g||e.substr(0,g.length+1)===g+"-":!1:e&&d!==!1},POS:function(a,b,c,d){var e=b[2],f=o.setFilters[e];if(f)return f(a,c,b,d)}}},p=o.match.POS,q=function(a,b){return"\\"+(b-0+1)};for(var r in o.match)o.match[r]=new RegExp(o.match[r].source+/(?![^\[]*\])(?![^\(]*\))/.source),o.leftMatch[r]=new RegExp(/(^(?:.|\r|\n)*?)/.source+o.match[r].source.replace(/\\(\d+)/g,q));var s=function(a,b){a=Array.prototype.slice.call(a,0);if(b){b.push.apply(b,a);return b}return a};try{Array.prototype.slice.call(c.documentElement.childNodes,0)[0].nodeType}catch(t){s=function(a,b){var c=0,d=b||[];if(g.call(a)==="[object Array]")Array.prototype.push.apply(d,a);else if(typeof a.length=="number")for(var e=a.length;c<e;c++)d.push(a[c]);else for(;a[c];c++)d.push(a[c]);return d}}var u,v;c.documentElement.compareDocumentPosition?u=function(a,b){if(a===b){h=!0;return 0}if(!a.compareDocumentPosition||!b.compareDocumentPosition)return a.compareDocumentPosition?-1:1;return a.compareDocumentPosition(b)&4?-1:1}:(u=function(a,b){if(a===b){h=!0;return 0}if(a.sourceIndex&&b.sourceIndex)return a.sourceIndex-b.sourceIndex;var c,d,e=[],f=[],g=a.parentNode,i=b.parentNode,j=g;if(g===i)return v(a,b);if(!g)return-1;if(!i)return 1;while(j)e.unshift(j),j=j.parentNode;j=i;while(j)f.unshift(j),j=j.parentNode;c=e.length,d=f.length;for(var k=0;k<c&&k<d;k++)if(e[k]!==f[k])return v(e[k],f[k]);return k===c?v(a,f[k],-1):v(e[k],b,1)},v=function(a,b,c){if(a===b)return c;var d=a.nextSibling;while(d){if(d===b)return-1;d=d.nextSibling}return 1}),function(){var a=c.createElement("div"),d="script"+(new Date).getTime(),e=c.documentElement;a.innerHTML="<a name='"+d+"'/>",e.insertBefore(a,e.firstChild),c.getElementById(d)&&(o.find.ID=function(a,c,d){if(typeof c.getElementById!="undefined"&&!d){var e=c.getElementById(a[1]);return e?e.id===a[1]||typeof e.getAttributeNode!="undefined"&&e.getAttributeNode("id").nodeValue===a[1]?[e]:b:[]}},o.filter.ID=function(a,b){var c=typeof a.getAttributeNode!="undefined"&&a.getAttributeNode("id");return a.nodeType===1&&c&&c.nodeValue===b}),e.removeChild(a),e=a=null}(),function(){var a=c.createElement("div");a.appendChild(c.createComment("")),a.getElementsByTagName("*").length>0&&(o.find.TAG=function(a,b){var c=b.getElementsByTagName(a[1]);if(a[1]==="*"){var d=[];for(var e=0;c[e];e++)c[e].nodeType===1&&d.push(c[e]);c=d}return c}),a.innerHTML="<a href='#'></a>",a.firstChild&&typeof a.firstChild.getAttribute!="undefined"&&a.firstChild.getAttribute("href")!=="#"&&(o.attrHandle.href=function(a){return a.getAttribute("href",2)}),a=null}(),c.querySelectorAll&&function(){var a=m,b=c.createElement("div"),d="__sizzle__";b.innerHTML="<p class='TEST'></p>";if(!b.querySelectorAll||b.querySelectorAll(".TEST").length!==0){m=function(b,e,f,g){e=e||c;if(!g&&!m.isXML(e)){var h=/^(\w+$)|^\.([\w\-]+$)|^#([\w\-]+$)/.exec(b);if(h&&(e.nodeType===1||e.nodeType===9)){if(h[1])return s(e.getElementsByTagName(b),f);if(h[2]&&o.find.CLASS&&e.getElementsByClassName)return s(e.getElementsByClassName(h[2]),f)}if(e.nodeType===9){if(b==="body"&&e.body)return s([e.body],f);if(h&&h[3]){var i=e.getElementById(h[3]);if(!i||!i.parentNode)return s([],f);if(i.id===h[3])return s([i],f)}try{return s(e.querySelectorAll(b),f)}catch(j){}}else if(e.nodeType===1&&e.nodeName.toLowerCase()!=="object"){var k=e,l=e.getAttribute("id"),n=l||d,p=e.parentNode,q=/^\s*[+~]/.test(b);l?n=n.replace(/'/g,"\\$&"):e.setAttribute("id",n),q&&p&&(e=e.parentNode);try{if(!q||p)return s(e.querySelectorAll("[id='"+n+"'] "+b),f)}catch(r){}finally{l||k.removeAttribute("id")}}}return a(b,e,f,g)};for(var e in a)m[e]=a[e];b=null}}(),function(){var a=c.documentElement,b=a.matchesSelector||a.mozMatchesSelector||a.webkitMatchesSelector||a.msMatchesSelector;if(b){var d=!b.call(c.createElement("div"),"div"),e=!1;try{b.call(c.documentElement,"[test!='']:sizzle")}catch(f){e=!0}m.matchesSelector=function(a,c){c=c.replace(/\=\s*([^'"\]]*)\s*\]/g,"='$1']");if(!m.isXML(a))try{if(e||!o.match.PSEUDO.test(c)&&!/!=/.test(c)){var f=b.call(a,c);if(f||!d||a.document&&a.document.nodeType!==11)return f}}catch(g){}return m(c,null,null,[a]).length>0}}}(),function(){var a=c.createElement("div");a.innerHTML="<div class='test e'></div><div class='test'></div>";if(!!a.getElementsByClassName&&a.getElementsByClassName("e").length!==0){a.lastChild.className="e";if(a.getElementsByClassName("e").length===1)return;o.order.splice(1,0,"CLASS"),o.find.CLASS=function(a,b,c){if(typeof b.getElementsByClassName!="undefined"&&!c)return b.getElementsByClassName(a[1])},a=null}}(),c.documentElement.contains?m.contains=function(a,b){return a!==b&&(a.contains?a.contains(b):!0)}:c.documentElement.compareDocumentPosition?m.contains=function(a,b){return!!(a.compareDocumentPosition(b)&16)}:m.contains=function(){return!1},m.isXML=function(a){var b=(a?a.ownerDocument||a:0).documentElement;return b?b.nodeName!=="HTML":!1};var y=function(a,b,c){var d,e=[],f="",g=b.nodeType?[b]:b;while(d=o.match.PSEUDO.exec(a))f+=d[0],a=a.replace(o.match.PSEUDO,"");a=o.relative[a]?a+"*":a;for(var h=0,i=g.length;h<i;h++)m(a,g[h],e,c);return m.filter(f,e)};m.attr=f.attr,m.selectors.attrMap={},f.find=m,f.expr=m.selectors,f.expr[":"]=f.expr.filters,f.unique=m.uniqueSort,f.text=m.getText,f.isXMLDoc=m.isXML,f.contains=m.contains}();var L=/Until$/,M=/^(?:parents|prevUntil|prevAll)/,N=/,/,O=/^.[^:#\[\.,]*$/,P=Array.prototype.slice,Q=f.expr.match.POS,R={children:!0,contents:!0,next:!0,prev:!0};f.fn.extend({find:function(a){var b=this,c,d;if(typeof a!="string")return f(a).filter(function(){for(c=0,d=b.length;c<d;c++)if(f.contains(b[c],this))return!0});var e=this.pushStack("","find",a),g,h,i;for(c=0,d=this.length;c<d;c++){g=e.length,f.find(a,this[c],e);if(c>0)for(h=g;h<e.length;h++)for(i=0;i<g;i++)if(e[i]===e[h]){e.splice(h--,1);break}}return e},has:function(a){var b=f(a);return this.filter(function(){for(var a=0,c=b.length;a<c;a++)if(f.contains(this,b[a]))return!0})},not:function(a){return this.pushStack(T(this,a,!1),"not",a)},filter:function(a){return this.pushStack(T(this,a,!0),"filter",a)},is:function(a){return!!a&&(typeof a=="string"?Q.test(a)?f(a,this.context).index(this[0])>=0:f.filter(a,this).length>0:this.filter(a).length>0)},closest:function(a,b){var c=[],d,e,g=this[0];if(f.isArray(a)){var h=1;while(g&&g.ownerDocument&&g!==b){for(d=0;d<a.length;d++)f(g).is(a[d])&&c.push({selector:a[d],elem:g,level:h});g=g.parentNode,h++}return c}var i=Q.test(a)||typeof a!="string"?f(a,b||this.context):0;for(d=0,e=this.length;d<e;d++){g=this[d];while(g){if(i?i.index(g)>-1:f.find.matchesSelector(g,a)){c.push(g);break}g=g.parentNode;if(!g||!g.ownerDocument||g===b||g.nodeType===11)break}}c=c.length>1?f.unique(c):c;return this.pushStack(c,"closest",a)},index:function(a){if(!a)return this[0]&&this[0].parentNode?this.prevAll().length:-1;if(typeof a=="string")return f.inArray(this[0],f(a));return f.inArray(a.jquery?a[0]:a,this)},add:function(a,b){var c=typeof a=="string"?f(a,b):f.makeArray(a&&a.nodeType?[a]:a),d=f.merge(this.get(),c);return this.pushStack(S(c[0])||S(d[0])?d:f.unique(d))},andSelf:function(){return this.add(this.prevObject)}}),f.each({parent:function(a){var b=a.parentNode;return b&&b.nodeType!==11?b:null},parents:function(a){return f.dir(a,"parentNode")},parentsUntil:function(a,b,c){return f.dir(a,"parentNode",c)},next:function(a){return f.nth(a,2,"nextSibling")},prev:function(a){return f.nth(a,2,"previousSibling")},nextAll:function(a){return f.dir(a,"nextSibling")},prevAll:function(a){return f.dir(a,"previousSibling")},nextUntil:function(a,b,c){return f.dir(a,"nextSibling",c)},prevUntil:function(a,b,c){return f.dir(a,"previousSibling",c)},siblings:function(a){return f.sibling(a.parentNode.firstChild,a)},children:function(a){return f.sibling(a.firstChild)},contents:function(a){return f.nodeName(a,"iframe")?a.contentDocument||a.contentWindow.document:f.makeArray(a.childNodes)}},function(a,b){f.fn[a]=function(c,d){var e=f.map(this,b,c);L.test(a)||(d=c),d&&typeof d=="string"&&(e=f.filter(d,e)),e=this.length>1&&!R[a]?f.unique(e):e,(this.length>1||N.test(d))&&M.test(a)&&(e=e.reverse());return this.pushStack(e,a,P.call(arguments).join(","))}}),f.extend({filter:function(a,b,c){c&&(a=":not("+a+")");return b.length===1?f.find.matchesSelector(b[0],a)?[b[0]]:[]:f.find.matches(a,b)},dir:function(a,c,d){var e=[],g=a[c];while(g&&g.nodeType!==9&&(d===b||g.nodeType!==1||!f(g).is(d)))g.nodeType===1&&e.push(g),g=g[c];return e},nth:function(a,b,c,d){b=b||1;var e=0;for(;a;a=a[c])if(a.nodeType===1&&++e===b)break;return a},sibling:function(a,b){var c=[];for(;a;a=a.nextSibling)a.nodeType===1&&a!==b&&c.push(a);return c}});var V="abbr|article|aside|audio|canvas|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video",W=/ jQuery\d+="(?:\d+|null)"/g,X=/^\s+/,Y=/<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/ig,Z=/<([\w:]+)/,$=/<tbody/i,_=/<|&#?\w+;/,ba=/<(?:script|style)/i,bb=/<(?:script|object|embed|option|style)/i,bc=new RegExp("<(?:"+V+")","i"),bd=/checked\s*(?:[^=]|=\s*.checked.)/i,be=/\/(java|ecma)script/i,bf=/^\s*<!(?:\[CDATA\[|\-\-)/,bg={option:[1,"<select multiple='multiple'>","</select>"],legend:[1,"<fieldset>","</fieldset>"],thead:[1,"<table>","</table>"],tr:[2,"<table><tbody>","</tbody></table>"],td:[3,"<table><tbody><tr>","</tr></tbody></table>"],col:[2,"<table><tbody></tbody><colgroup>","</colgroup></table>"],area:[1,"<map>","</map>"],_default:[0,"",""]},bh=U(c);bg.optgroup=bg.option,bg.tbody=bg.tfoot=bg.colgroup=bg.caption=bg.thead,bg.th=bg.td,f.support.htmlSerialize||(bg._default=[1,"div<div>","</div>"]),f.fn.extend({text:function(a){if(f.isFunction(a))return this.each(function(b){var c=f(this);c.text(a.call(this,b,c.text()))});if(typeof a!="object"&&a!==b)return this.empty().append((this[0]&&this[0].ownerDocument||c).createTextNode(a));return f.text(this)},wrapAll:function(a){if(f.isFunction(a))return this.each(function(b){f(this).wrapAll(a.call(this,b))});if(this[0]){var b=f(a,this[0].ownerDocument).eq(0).clone(!0);this[0].parentNode&&b.insertBefore(this[0]),b.map(function(){var a=this;while(a.firstChild&&a.firstChild.nodeType===1)a=a.firstChild;return a}).append(this)}return this},wrapInner:function(a){if(f.isFunction(a))return this.each(function(b){f(this).wrapInner(a.call(this,b))});return this.each(function(){var b=f(this),c=b.contents();c.length?c.wrapAll(a):b.append(a)})},wrap:function(a){var b=f.isFunction(a);return this.each(function(c){f(this).wrapAll(b?a.call(this,c):a)})},unwrap:function(){return this.parent().each(function(){f.nodeName(this,"body")||f(this).replaceWith(this.childNodes)}).end()},append:function(){return this.domManip(arguments,!0,function(a){this.nodeType===1&&this.appendChild(a)})},prepend:function(){return this.domManip(arguments,!0,function(a){this.nodeType===1&&this.insertBefore(a,this.firstChild)})},before:function(){if(this[0]&&this[0].parentNode)return this.domManip(arguments,!1,function(a){this.parentNode.insertBefore(a,this)});if(arguments.length){var a=f.clean(arguments);a.push.apply(a,this.toArray());return this.pushStack(a,"before",arguments)}},after:function(){if(this[0]&&this[0].parentNode)return this.domManip(arguments,!1,function(a){this.parentNode.insertBefore(a,this.nextSibling)});if(arguments.length){var a=this.pushStack(this,"after",arguments);a.push.apply(a,f.clean(arguments));return a}},remove:function(a,b){for(var c=0,d;(d=this[c])!=null;c++)if(!a||f.filter(a,[d]).length)!b&&d.nodeType===1&&(f.cleanData(d.getElementsByTagName("*")),f.cleanData([d])),d.parentNode&&d.parentNode.removeChild(d);return this},empty:function()
{for(var a=0,b;(b=this[a])!=null;a++){b.nodeType===1&&f.cleanData(b.getElementsByTagName("*"));while(b.firstChild)b.removeChild(b.firstChild)}return this},clone:function(a,b){a=a==null?!1:a,b=b==null?a:b;return this.map(function(){return f.clone(this,a,b)})},html:function(a){if(a===b)return this[0]&&this[0].nodeType===1?this[0].innerHTML.replace(W,""):null;if(typeof a=="string"&&!ba.test(a)&&(f.support.leadingWhitespace||!X.test(a))&&!bg[(Z.exec(a)||["",""])[1].toLowerCase()]){a=a.replace(Y,"<$1></$2>");try{for(var c=0,d=this.length;c<d;c++)this[c].nodeType===1&&(f.cleanData(this[c].getElementsByTagName("*")),this[c].innerHTML=a)}catch(e){this.empty().append(a)}}else f.isFunction(a)?this.each(function(b){var c=f(this);c.html(a.call(this,b,c.html()))}):this.empty().append(a);return this},replaceWith:function(a){if(this[0]&&this[0].parentNode){if(f.isFunction(a))return this.each(function(b){var c=f(this),d=c.html();c.replaceWith(a.call(this,b,d))});typeof a!="string"&&(a=f(a).detach());return this.each(function(){var b=this.nextSibling,c=this.parentNode;f(this).remove(),b?f(b).before(a):f(c).append(a)})}return this.length?this.pushStack(f(f.isFunction(a)?a():a),"replaceWith",a):this},detach:function(a){return this.remove(a,!0)},domManip:function(a,c,d){var e,g,h,i,j=a[0],k=[];if(!f.support.checkClone&&arguments.length===3&&typeof j=="string"&&bd.test(j))return this.each(function(){f(this).domManip(a,c,d,!0)});if(f.isFunction(j))return this.each(function(e){var g=f(this);a[0]=j.call(this,e,c?g.html():b),g.domManip(a,c,d)});if(this[0]){i=j&&j.parentNode,f.support.parentNode&&i&&i.nodeType===11&&i.childNodes.length===this.length?e={fragment:i}:e=f.buildFragment(a,this,k),h=e.fragment,h.childNodes.length===1?g=h=h.firstChild:g=h.firstChild;if(g){c=c&&f.nodeName(g,"tr");for(var l=0,m=this.length,n=m-1;l<m;l++)d.call(c?bi(this[l],g):this[l],e.cacheable||m>1&&l<n?f.clone(h,!0,!0):h)}k.length&&f.each(k,bp)}return this}}),f.buildFragment=function(a,b,d){var e,g,h,i,j=a[0];b&&b[0]&&(i=b[0].ownerDocument||b[0]),i.createDocumentFragment||(i=c),a.length===1&&typeof j=="string"&&j.length<512&&i===c&&j.charAt(0)==="<"&&!bb.test(j)&&(f.support.checkClone||!bd.test(j))&&(f.support.html5Clone||!bc.test(j))&&(g=!0,h=f.fragments[j],h&&h!==1&&(e=h)),e||(e=i.createDocumentFragment(),f.clean(a,i,e,d)),g&&(f.fragments[j]=h?e:1);return{fragment:e,cacheable:g}},f.fragments={},f.each({appendTo:"append",prependTo:"prepend",insertBefore:"before",insertAfter:"after",replaceAll:"replaceWith"},function(a,b){f.fn[a]=function(c){var d=[],e=f(c),g=this.length===1&&this[0].parentNode;if(g&&g.nodeType===11&&g.childNodes.length===1&&e.length===1){e[b](this[0]);return this}for(var h=0,i=e.length;h<i;h++){var j=(h>0?this.clone(!0):this).get();f(e[h])[b](j),d=d.concat(j)}return this.pushStack(d,a,e.selector)}}),f.extend({clone:function(a,b,c){var d,e,g,h=f.support.html5Clone||!bc.test("<"+a.nodeName)?a.cloneNode(!0):bo(a);if((!f.support.noCloneEvent||!f.support.noCloneChecked)&&(a.nodeType===1||a.nodeType===11)&&!f.isXMLDoc(a)){bk(a,h),d=bl(a),e=bl(h);for(g=0;d[g];++g)e[g]&&bk(d[g],e[g])}if(b){bj(a,h);if(c){d=bl(a),e=bl(h);for(g=0;d[g];++g)bj(d[g],e[g])}}d=e=null;return h},clean:function(a,b,d,e){var g;b=b||c,typeof b.createElement=="undefined"&&(b=b.ownerDocument||b[0]&&b[0].ownerDocument||c);var h=[],i;for(var j=0,k;(k=a[j])!=null;j++){typeof k=="number"&&(k+="");if(!k)continue;if(typeof k=="string")if(!_.test(k))k=b.createTextNode(k);else{k=k.replace(Y,"<$1></$2>");var l=(Z.exec(k)||["",""])[1].toLowerCase(),m=bg[l]||bg._default,n=m[0],o=b.createElement("div");b===c?bh.appendChild(o):U(b).appendChild(o),o.innerHTML=m[1]+k+m[2];while(n--)o=o.lastChild;if(!f.support.tbody){var p=$.test(k),q=l==="table"&&!p?o.firstChild&&o.firstChild.childNodes:m[1]==="<table>"&&!p?o.childNodes:[];for(i=q.length-1;i>=0;--i)f.nodeName(q[i],"tbody")&&!q[i].childNodes.length&&q[i].parentNode.removeChild(q[i])}!f.support.leadingWhitespace&&X.test(k)&&o.insertBefore(b.createTextNode(X.exec(k)[0]),o.firstChild),k=o.childNodes}var r;if(!f.support.appendChecked)if(k[0]&&typeof (r=k.length)=="number")for(i=0;i<r;i++)bn(k[i]);else bn(k);k.nodeType?h.push(k):h=f.merge(h,k)}if(d){g=function(a){return!a.type||be.test(a.type)};for(j=0;h[j];j++)if(e&&f.nodeName(h[j],"script")&&(!h[j].type||h[j].type.toLowerCase()==="text/javascript"))e.push(h[j].parentNode?h[j].parentNode.removeChild(h[j]):h[j]);else{if(h[j].nodeType===1){var s=f.grep(h[j].getElementsByTagName("script"),g);h.splice.apply(h,[j+1,0].concat(s))}d.appendChild(h[j])}}return h},cleanData:function(a){var b,c,d=f.cache,e=f.event.special,g=f.support.deleteExpando;for(var h=0,i;(i=a[h])!=null;h++){if(i.nodeName&&f.noData[i.nodeName.toLowerCase()])continue;c=i[f.expando];if(c){b=d[c];if(b&&b.events){for(var j in b.events)e[j]?f.event.remove(i,j):f.removeEvent(i,j,b.handle);b.handle&&(b.handle.elem=null)}g?delete i[f.expando]:i.removeAttribute&&i.removeAttribute(f.expando),delete d[c]}}}});var bq=/alpha\([^)]*\)/i,br=/opacity=([^)]*)/,bs=/([A-Z]|^ms)/g,bt=/^-?\d+(?:px)?$/i,bu=/^-?\d/,bv=/^([\-+])=([\-+.\de]+)/,bw={position:"absolute",visibility:"hidden",display:"block"},bx=["Left","Right"],by=["Top","Bottom"],bz,bA,bB;f.fn.css=function(a,c){if(arguments.length===2&&c===b)return this;return f.access(this,a,c,!0,function(a,c,d){return d!==b?f.style(a,c,d):f.css(a,c)})},f.extend({cssHooks:{opacity:{get:function(a,b){if(b){var c=bz(a,"opacity","opacity");return c===""?"1":c}return a.style.opacity}}},cssNumber:{fillOpacity:!0,fontWeight:!0,lineHeight:!0,opacity:!0,orphans:!0,widows:!0,zIndex:!0,zoom:!0},cssProps:{"float":f.support.cssFloat?"cssFloat":"styleFloat"},style:function(a,c,d,e){if(!!a&&a.nodeType!==3&&a.nodeType!==8&&!!a.style){var g,h,i=f.camelCase(c),j=a.style,k=f.cssHooks[i];c=f.cssProps[i]||i;if(d===b){if(k&&"get"in k&&(g=k.get(a,!1,e))!==b)return g;return j[c]}h=typeof d,h==="string"&&(g=bv.exec(d))&&(d=+(g[1]+1)*+g[2]+parseFloat(f.css(a,c)),h="number");if(d==null||h==="number"&&isNaN(d))return;h==="number"&&!f.cssNumber[i]&&(d+="px");if(!k||!("set"in k)||(d=k.set(a,d))!==b)try{j[c]=d}catch(l){}}},css:function(a,c,d){var e,g;c=f.camelCase(c),g=f.cssHooks[c],c=f.cssProps[c]||c,c==="cssFloat"&&(c="float");if(g&&"get"in g&&(e=g.get(a,!0,d))!==b)return e;if(bz)return bz(a,c)},swap:function(a,b,c){var d={};for(var e in b)d[e]=a.style[e],a.style[e]=b[e];c.call(a);for(e in b)a.style[e]=d[e]}}),f.curCSS=f.css,f.each(["height","width"],function(a,b){f.cssHooks[b]={get:function(a,c,d){var e;if(c){if(a.offsetWidth!==0)return bC(a,b,d);f.swap(a,bw,function(){e=bC(a,b,d)});return e}},set:function(a,b){if(!bt.test(b))return b;b=parseFloat(b);if(b>=0)return b+"px"}}}),f.support.opacity||(f.cssHooks.opacity={get:function(a,b){return br.test((b&&a.currentStyle?a.currentStyle.filter:a.style.filter)||"")?parseFloat(RegExp.$1)/100+"":b?"1":""},set:function(a,b){var c=a.style,d=a.currentStyle,e=f.isNumeric(b)?"alpha(opacity="+b*100+")":"",g=d&&d.filter||c.filter||"";c.zoom=1;if(b>=1&&f.trim(g.replace(bq,""))===""){c.removeAttribute("filter");if(d&&!d.filter)return}c.filter=bq.test(g)?g.replace(bq,e):g+" "+e}}),f(function(){f.support.reliableMarginRight||(f.cssHooks.marginRight={get:function(a,b){var c;f.swap(a,{display:"inline-block"},function(){b?c=bz(a,"margin-right","marginRight"):c=a.style.marginRight});return c}})}),c.defaultView&&c.defaultView.getComputedStyle&&(bA=function(a,b){var c,d,e;b=b.replace(bs,"-$1").toLowerCase(),(d=a.ownerDocument.defaultView)&&(e=d.getComputedStyle(a,null))&&(c=e.getPropertyValue(b),c===""&&!f.contains(a.ownerDocument.documentElement,a)&&(c=f.style(a,b)));return c}),c.documentElement.currentStyle&&(bB=function(a,b){var c,d,e,f=a.currentStyle&&a.currentStyle[b],g=a.style;f===null&&g&&(e=g[b])&&(f=e),!bt.test(f)&&bu.test(f)&&(c=g.left,d=a.runtimeStyle&&a.runtimeStyle.left,d&&(a.runtimeStyle.left=a.currentStyle.left),g.left=b==="fontSize"?"1em":f||0,f=g.pixelLeft+"px",g.left=c,d&&(a.runtimeStyle.left=d));return f===""?"auto":f}),bz=bA||bB,f.expr&&f.expr.filters&&(f.expr.filters.hidden=function(a){var b=a.offsetWidth,c=a.offsetHeight;return b===0&&c===0||!f.support.reliableHiddenOffsets&&(a.style&&a.style.display||f.css(a,"display"))==="none"},f.expr.filters.visible=function(a){return!f.expr.filters.hidden(a)});var bD=/%20/g,bE=/\[\]$/,bF=/\r?\n/g,bG=/#.*$/,bH=/^(.*?):[ \t]*([^\r\n]*)\r?$/mg,bI=/^(?:color|date|datetime|datetime-local|email|hidden|month|number|password|range|search|tel|text|time|url|week)$/i,bJ=/^(?:about|app|app\-storage|.+\-extension|file|res|widget):$/,bK=/^(?:GET|HEAD)$/,bL=/^\/\//,bM=/\?/,bN=/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi,bO=/^(?:select|textarea)/i,bP=/\s+/,bQ=/([?&])_=[^&]*/,bR=/^([\w\+\.\-]+:)(?:\/\/([^\/?#:]*)(?::(\d+))?)?/,bS=f.fn.load,bT={},bU={},bV,bW,bX=["*/"]+["*"];try{bV=e.href}catch(bY){bV=c.createElement("a"),bV.href="",bV=bV.href}bW=bR.exec(bV.toLowerCase())||[],f.fn.extend({load:function(a,c,d){if(typeof a!="string"&&bS)return bS.apply(this,arguments);if(!this.length)return this;var e=a.indexOf(" ");if(e>=0){var g=a.slice(e,a.length);a=a.slice(0,e)}var h="GET";c&&(f.isFunction(c)?(d=c,c=b):typeof c=="object"&&(c=f.param(c,f.ajaxSettings.traditional),h="POST"));var i=this;f.ajax({url:a,type:h,dataType:"html",data:c,complete:function(a,b,c){c=a.responseText,a.isResolved()&&(a.done(function(a){c=a}),i.html(g?f("<div>").append(c.replace(bN,"")).find(g):c)),d&&i.each(d,[c,b,a])}});return this},serialize:function(){return f.param(this.serializeArray())},serializeArray:function(){return this.map(function(){return this.elements?f.makeArray(this.elements):this}).filter(function(){return this.name&&!this.disabled&&(this.checked||bO.test(this.nodeName)||bI.test(this.type))}).map(function(a,b){var c=f(this).val();return c==null?null:f.isArray(c)?f.map(c,function(a,c){return{name:b.name,value:a.replace(bF,"\r\n")}}):{name:b.name,value:c.replace(bF,"\r\n")}}).get()}}),f.each("ajaxStart ajaxStop ajaxComplete ajaxError ajaxSuccess ajaxSend".split(" "),function(a,b){f.fn[b]=function(a){return this.on(b,a)}}),f.each(["get","post"],function(a,c){f[c]=function(a,d,e,g){f.isFunction(d)&&(g=g||e,e=d,d=b);return f.ajax({type:c,url:a,data:d,success:e,dataType:g})}}),f.extend({getScript:function(a,c){return f.get(a,b,c,"script")},getJSON:function(a,b,c){return f.get(a,b,c,"json")},ajaxSetup:function(a,b){b?b_(a,f.ajaxSettings):(b=a,a=f.ajaxSettings),b_(a,b);return a},ajaxSettings:{url:bV,isLocal:bJ.test(bW[1]),global:!0,type:"GET",contentType:"application/x-www-form-urlencoded",processData:!0,async:!0,accepts:{xml:"application/xml, text/xml",html:"text/html",text:"text/plain",json:"application/json, text/javascript","*":bX},contents:{xml:/xml/,html:/html/,json:/json/},responseFields:{xml:"responseXML",text:"responseText"},converters:{"* text":a.String,"text html":!0,"text json":f.parseJSON,"text xml":f.parseXML},flatOptions:{context:!0,url:!0}},ajaxPrefilter:bZ(bT),ajaxTransport:bZ(bU),ajax:function(a,c){function w(a,c,l,m){if(s!==2){s=2,q&&clearTimeout(q),p=b,n=m||"",v.readyState=a>0?4:0;var o,r,u,w=c,x=l?cb(d,v,l):b,y,z;if(a>=200&&a<300||a===304){if(d.ifModified){if(y=v.getResponseHeader("Last-Modified"))f.lastModified[k]=y;if(z=v.getResponseHeader("Etag"))f.etag[k]=z}if(a===304)w="notmodified",o=!0;else try{r=cc(d,x),w="success",o=!0}catch(A){w="parsererror",u=A}}else{u=w;if(!w||a)w="error",a<0&&(a=0)}v.status=a,v.statusText=""+(c||w),o?h.resolveWith(e,[r,w,v]):h.rejectWith(e,[v,w,u]),v.statusCode(j),j=b,t&&g.trigger("ajax"+(o?"Success":"Error"),[v,d,o?r:u]),i.fireWith(e,[v,w]),t&&(g.trigger("ajaxComplete",[v,d]),--f.active||f.event.trigger("ajaxStop"))}}typeof a=="object"&&(c=a,a=b),c=c||{};var d=f.ajaxSetup({},c),e=d.context||d,g=e!==d&&(e.nodeType||e instanceof f)?f(e):f.event,h=f.Deferred(),i=f.Callbacks("once memory"),j=d.statusCode||{},k,l={},m={},n,o,p,q,r,s=0,t,u,v={readyState:0,setRequestHeader:function(a,b){if(!s){var c=a.toLowerCase();a=m[c]=m[c]||a,l[a]=b}return this},getAllResponseHeaders:function(){return s===2?n:null},getResponseHeader:function(a){var c;if(s===2){if(!o){o={};while(c=bH.exec(n))o[c[1].toLowerCase()]=c[2]}c=o[a.toLowerCase()]}return c===b?null:c},overrideMimeType:function(a){s||(d.mimeType=a);return this},abort:function(a){a=a||"abort",p&&p.abort(a),w(0,a);return this}};h.promise(v),v.success=v.done,v.error=v.fail,v.complete=i.add,v.statusCode=function(a){if(a){var b;if(s<2)for(b in a)j[b]=[j[b],a[b]];else b=a[v.status],v.then(b,b)}return this},d.url=((a||d.url)+"").replace(bG,"").replace(bL,bW[1]+"//"),d.dataTypes=f.trim(d.dataType||"*").toLowerCase().split(bP),d.crossDomain==null&&(r=bR.exec(d.url.toLowerCase()),d.crossDomain=!(!r||r[1]==bW[1]&&r[2]==bW[2]&&(r[3]||(r[1]==="http:"?80:443))==(bW[3]||(bW[1]==="http:"?80:443)))),d.data&&d.processData&&typeof d.data!="string"&&(d.data=f.param(d.data,d.traditional)),b$(bT,d,c,v);if(s===2)return!1;t=d.global,d.type=d.type.toUpperCase(),d.hasContent=!bK.test(d.type),t&&f.active++===0&&f.event.trigger("ajaxStart");if(!d.hasContent){d.data&&(d.url+=(bM.test(d.url)?"&":"?")+d.data,delete d.data),k=d.url;if(d.cache===!1){var x=f.now(),y=d.url.replace(bQ,"$1_="+x);d.url=y+(y===d.url?(bM.test(d.url)?"&":"?")+"_="+x:"")}}(d.data&&d.hasContent&&d.contentType!==!1||c.contentType)&&v.setRequestHeader("Content-Type",d.contentType),d.ifModified&&(k=k||d.url,f.lastModified[k]&&v.setRequestHeader("If-Modified-Since",f.lastModified[k]),f.etag[k]&&v.setRequestHeader("If-None-Match",f.etag[k])),v.setRequestHeader("Accept",d.dataTypes[0]&&d.accepts[d.dataTypes[0]]?d.accepts[d.dataTypes[0]]+(d.dataTypes[0]!=="*"?", "+bX+"; q=0.01":""):d.accepts["*"]);for(u in d.headers)v.setRequestHeader(u,d.headers[u]);if(d.beforeSend&&(d.beforeSend.call(e,v,d)===!1||s===2)){v.abort();return!1}for(u in{success:1,error:1,complete:1})v[u](d[u]);p=b$(bU,d,c,v);if(!p)w(-1,"No Transport");else{v.readyState=1,t&&g.trigger("ajaxSend",[v,d]),d.async&&d.timeout>0&&(q=setTimeout(function(){v.abort("timeout")},d.timeout));try{s=1,p.send(l,w)}catch(z){if(s<2)w(-1,z);else throw z}}return v},param:function(a,c){var d=[],e=function(a,b){b=f.isFunction(b)?b():b,d[d.length]=encodeURIComponent(a)+"="+encodeURIComponent(b)};c===b&&(c=f.ajaxSettings.traditional);if(f.isArray(a)||a.jquery&&!f.isPlainObject(a))f.each(a,function(){e(this.name,this.value)});else for(var g in a)ca(g,a[g],c,e);return d.join("&").replace(bD,"+")}}),f.extend({active:0,lastModified:{},etag:{}});var cd=f.now(),ce=/(\=)\?(&|$)|\?\?/i;f.ajaxSetup({jsonp:"callback",jsonpCallback:function(){return f.expando+"_"+cd++}}),f.ajaxPrefilter("json jsonp",function(b,c,d){var e=b.contentType==="application/x-www-form-urlencoded"&&typeof b.data=="string";if(b.dataTypes[0]==="jsonp"||b.jsonp!==!1&&(ce.test(b.url)||e&&ce.test(b.data))){var g,h=b.jsonpCallback=f.isFunction(b.jsonpCallback)?b.jsonpCallback():b.jsonpCallback,i=a[h],j=b.url,k=b.data,l="$1"+h+"$2";b.jsonp!==!1&&(j=j.replace(ce,l),b.url===j&&(e&&(k=k.replace(ce,l)),b.data===k&&(j+=(/\?/.test(j)?"&":"?")+b.jsonp+"="+h))),b.url=j,b.data=k,a[h]=function(a){g=[a]},d.always(function(){a[h]=i,g&&f.isFunction(i)&&a[h](g[0])}),b.converters["script json"]=function(){g||f.error(h+" was not called");return g[0]},b.dataTypes[0]="json";return"script"}}),f.ajaxSetup({accepts:{script:"text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"},contents:{script:/javascript|ecmascript/},converters:{"text script":function(a){f.globalEval(a);return a}}}),f.ajaxPrefilter("script",function(a){a.cache===b&&(a.cache=!1),a.crossDomain&&(a.type="GET",a.global=!1)}),f.ajaxTransport("script",function(a){if(a.crossDomain){var d,e=c.head||c.getElementsByTagName("head")[0]||c.documentElement;return{send:function(f,g){d=c.createElement("script"),d.async="async",a.scriptCharset&&(d.charset=a.scriptCharset),d.src=a.url,d.onload=d.onreadystatechange=function(a,c){if(c||!d.readyState||/loaded|complete/.test(d.readyState))d.onload=d.onreadystatechange=null,e&&d.parentNode&&e.removeChild(d),d=b,c||g(200,"success")},e.insertBefore(d,e.firstChild)},abort:function(){d&&d.onload(0,1)}}}});var cf=a.ActiveXObject?function(){for(var a in ch)ch[a](0,1)}:!1,cg=0,ch;f.ajaxSettings.xhr=a.ActiveXObject?function(){return!this.isLocal&&ci()||cj()}:ci,function(a){f.extend(f.support,{ajax:!!a,cors:!!a&&"withCredentials"in a})}(f.ajaxSettings.xhr()),f.support.ajax&&f.ajaxTransport(function(c){if(!c.crossDomain||f.support.cors){var d;return{send:function(e,g){var h=c.xhr(),i,j;c.username?h.open(c.type,c.url,c.async,c.username,c.password):h.open(c.type,c.url,c.async);if(c.xhrFields)for(j in c.xhrFields)h[j]=c.xhrFields[j];c.mimeType&&h.overrideMimeType&&h.overrideMimeType(c.mimeType),!c.crossDomain&&!e["X-Requested-With"]&&(e["X-Requested-With"]="XMLHttpRequest");try{for(j in e)h.setRequestHeader(j,e[j])}catch(k){}h.send(c.hasContent&&c.data||null),d=function(a,e){var j,k,l,m,n;try{if(d&&(e||h.readyState===4)){d=b,i&&(h.onreadystatechange=f.noop,cf&&delete ch[i]);if(e)h.readyState!==4&&h.abort();else{j=h.status,l=h.getAllResponseHeaders(),m={},n=h.responseXML,n&&n.documentElement&&(m.xml=n),m.text=h.responseText;try{k=h.statusText}catch(o){k=""}!j&&c.isLocal&&!c.crossDomain?j=m.text?200:404:j===1223&&(j=204)}}}catch(p){e||g(-1,p)}m&&g(j,k,m,l)},!c.async||h.readyState===4?d():(i=++cg,cf&&(ch||(ch={},f(a).unload(cf)),ch[i]=d),h.onreadystatechange=d)},abort:function(){d&&d(0,1)}}}});var ck={},cl,cm,cn=/^(?:toggle|show|hide)$/,co=/^([+\-]=)?([\d+.\-]+)([a-z%]*)$/i,cp,cq=[["height","marginTop","marginBottom","paddingTop","paddingBottom"],["width","marginLeft","marginRight","paddingLeft","paddingRight"],["opacity"]],cr;f.fn.extend({show:function(a,b,c){var d,e;if(a||a===0)return this.animate(cu("show",3),a,b,c);for(var g=0,h=this.length;g<h;g++)d=this[g],d.style&&(e=d.style.display,!f._data(d,"olddisplay")&&e==="none"&&(e=d.style.display=""),e===""&&f.css(d,"display")==="none"&&f._data(d,"olddisplay",cv(d.nodeName)));for(g=0;g<h;g++){d=this[g];if(d.style){e=d.style.display;if(e===""||e==="none")d.style.display=f._data(d,"olddisplay")||""}}return this},hide:function(a,b,c){if(a||a===0)return this.animate(cu("hide",3),a,b,c);var d,e,g=0,h=this.length;for(;g<h;g++)d=this[g],d.style&&(e=f.css(d,"display"),e!=="none"&&!f._data(d,"olddisplay")&&f._data(d,"olddisplay",e));for(g=0;g<h;g++)this[g].style&&(this[g].style.display="none");return this},_toggle:f.fn.toggle,toggle:function(a,b,c){var d=typeof a=="boolean";f.isFunction(a)&&f.isFunction(b)?this._toggle.apply(this,arguments):a==null||d?this.each(function(){var b=d?a:f(this).is(":hidden");f(this)[b?"show":"hide"]()}):this.animate(cu("toggle",3),a,b,c);return this},fadeTo:function(a,b,c,d){return this.filter(":hidden").css("opacity",0).show().end().animate({opacity:b},a,c,d)},animate:function(a,b,c,d){function g(){e.queue===!1&&f._mark(this);var b=f.extend({},e),c=this.nodeType===1,d=c&&f(this).is(":hidden"),g,h,i,j,k,l,m,n,o;b.animatedProperties={};for(i in a){g=f.camelCase(i),i!==g&&(a[g]=a[i],delete a[i]),h=a[g],f.isArray(h)?(b.animatedProperties[g]=h[1],h=a[g]=h[0]):b.animatedProperties[g]=b.specialEasing&&b.specialEasing[g]||b.easing||"swing";if(h==="hide"&&d||h==="show"&&!d)return b.complete.call(this);c&&(g==="height"||g==="width")&&(b.overflow=[this.style.overflow,this.style.overflowX,this.style.overflowY],f.css(this,"display")==="inline"&&f.css(this,"float")==="none"&&(!f.support.inlineBlockNeedsLayout||cv(this.nodeName)==="inline"?this.style.display="inline-block":this.style.zoom=1))}b.overflow!=null&&(this.style.overflow="hidden");for(i in a)j=new f.fx(this,b,i),h=a[i],cn.test(h)?(o=f._data(this,"toggle"+i)||(h==="toggle"?d?"show":"hide":0),o?(f._data(this,"toggle"+i,o==="show"?"hide":"show"),j[o]()):j[h]()):(k=co.exec(h),l=j.cur(),k?(m=parseFloat(k[2]),n=k[3]||(f.cssNumber[i]?"":"px"),n!=="px"&&(f.style(this,i,(m||1)+n),l=(m||1)/j.cur()*l,f.style(this,i,l+n)),k[1]&&(m=(k[1]==="-="?-1:1)*m+l),j.custom(l,m,n)):j.custom(l,h,""));return!0}var e=f.speed(b,c,d);if(f.isEmptyObject(a))return this.each(e.complete,[!1]);a=f.extend({},a);return e.queue===!1?this.each(g):this.queue(e.queue,g)},stop:function(a,c,d){typeof a!="string"&&(d=c,c=a,a=b),c&&a!==!1&&this.queue(a||"fx",[]);return this.each(function(){function h(a,b,c){var e=b[c];f.removeData(a,c,!0),e.stop(d)}var b,c=!1,e=f.timers,g=f._data(this);d||f._unmark(!0,this);if(a==null)for(b in g)g[b]&&g[b].stop&&b.indexOf(".run")===b.length-4&&h(this,g,b);else g[b=a+".run"]&&g[b].stop&&h(this,g,b);for(b=e.length;b--;)e[b].elem===this&&(a==null||e[b].queue===a)&&(d?e[b](!0):e[b].saveState(),c=!0,e.splice(b,1));(!d||!c)&&f.dequeue(this,a)})}}),f.each({slideDown:cu("show",1),slideUp:cu("hide",1),slideToggle:cu("toggle",1),fadeIn:{opacity:"show"},fadeOut:{opacity:"hide"},fadeToggle:{opacity:"toggle"}},function(a,b){f.fn[a]=function(a,c,d){return this.animate(b,a,c,d)}}),f.extend({speed:function(a,b,c){var d=a&&typeof a=="object"?f.extend({},a):{complete:c||!c&&b||f.isFunction(a)&&a,duration:a,easing:c&&b||b&&!f.isFunction(b)&&b};d.duration=f.fx.off?0:typeof d.duration=="number"?d.duration:d.duration in f.fx.speeds?f.fx.speeds[d.duration]:f.fx.speeds._default;if(d.queue==null||d.queue===!0)d.queue="fx";d.old=d.complete,d.complete=function(a){f.isFunction(d.old)&&d.old.call(this),d.queue?f.dequeue(this,d.queue):a!==!1&&f._unmark(this)};return d},easing:{linear:function(a,b,c,d){return c+d*a},swing:function(a,b,c,d){return(-Math.cos(a*Math.PI)/2+.5)*d+c}},timers:[],fx:function(a,b,c){this.options=b,this.elem=a,this.prop=c,b.orig=b.orig||{}}}),f.fx.prototype={update:function(){this.options.step&&this.options.step.call(this.elem,this.now,this),(f.fx.step[this.prop]||f.fx.step._default)(this)},cur:function(){if(this.elem[this.prop]!=null&&(!this.elem.style||this.elem.style[this.prop]==null))return this.elem[this.prop];var a,b=f.css(this.elem,this.prop);return isNaN(a=parseFloat(b))?!b||b==="auto"?0:b:a},custom:function(a,c,d){function h(a){return e.step(a)}var e=this,g=f.fx;this.startTime=cr||cs(),this.end=c,this.now=this.start=a,this.pos=this.state=0,this.unit=d||this.unit||(f.cssNumber[this.prop]?"":"px"),h.queue=this.options.queue,h.elem=this.elem,h.saveState=function(){e.options.hide&&f._data(e.elem,"fxshow"+e.prop)===b&&f._data(e.elem,"fxshow"+e.prop,e.start)},h()&&f.timers.push(h)&&!cp&&(cp=setInterval(g.tick,g.interval))},show:function(){var a=f._data(this.elem,"fxshow"+this.prop);this.options.orig[this.prop]=a||f.style(this.elem,this.prop),this.options.show=!0,a!==b?this.custom(this.cur(),a):this.custom(this.prop==="width"||this.prop==="height"?1:0,this.cur()),f(this.elem).show()},hide:function(){this.options.orig[this.prop]=f._data(this.elem,"fxshow"+this.prop)||f.style(this.elem,this.prop),this.options.hide=!0,this.custom(this.cur(),0)},step:function(a){var b,c,d,e=cr||cs(),g=!0,h=this.elem,i=this.options;if(a||e>=i.duration+this.startTime){this.now=this.end,this.pos=this.state=1,this.update(),i.animatedProperties[this.prop]=!0;for(b in i.animatedProperties)i.animatedProperties[b]!==!0&&(g=!1);if(g){i.overflow!=null&&!f.support.shrinkWrapBlocks&&f.each(["","X","Y"],function(a,b){h.style["overflow"+b]=i.overflow[a]}),i.hide&&f(h).hide();if(i.hide||i.show)for(b in i.animatedProperties)f.style(h,b,i.orig[b]),f.removeData(h,"fxshow"+b,!0),f.removeData(h,"toggle"+b,!0);d=i.complete,d&&(i.complete=!1,d.call(h))}return!1}i.duration==Infinity?this.now=e:(c=e-this.startTime,this.state=c/i.duration,this.pos=f.easing[i.animatedProperties[this.prop]](this.state,c,0,1,i.duration),this.now=this.start+(this.end-this.start)*this.pos),this.update();return!0}},f.extend(f.fx,{tick:function(){var a,b=f.timers,c=0;for(;c<b.length;c++)a=b[c],!a()&&b[c]===a&&b.splice(c--,1);b.length||f.fx.stop()},interval:13,stop:function(){clearInterval(cp),cp=null},speeds:{slow:600,fast:200,_default:400},step:{opacity:function(a){f.style(a.elem,"opacity",a.now)},_default:function(a){a.elem.style&&a.elem.style[a.prop]!=null?a.elem.style[a.prop]=a.now+a.unit:a.elem[a.prop]=a.now}}}),f.each(["width","height"],function(a,b){f.fx.step[b]=function(a){f.style(a.elem,b,Math.max(0,a.now)+a.unit)}}),f.expr&&f.expr.filters&&(f.expr.filters.animated=function(a){return f.grep(f.timers,function(b){return a===b.elem}).length});var cw=/^t(?:able|d|h)$/i,cx=/^(?:body|html)$/i;"getBoundingClientRect"in c.documentElement?f.fn.offset=function(a){var b=this[0],c;if(a)return this.each(function(b){f.offset.setOffset(this,a,b)});if(!b||!b.ownerDocument)return null;if(b===b.ownerDocument.body)return f.offset.bodyOffset(b);try{c=b.getBoundingClientRect()}catch(d){}var e=b.ownerDocument,g=e.documentElement;if(!c||!f.contains(g,b))return c?{top:c.top,left:c.left}:{top:0,left:0};var h=e.body,i=cy(e),j=g.clientTop||h.clientTop||0,k=g.clientLeft||h.clientLeft||0,l=i.pageYOffset||f.support.boxModel&&g.scrollTop||h.scrollTop,m=i.pageXOffset||f.support.boxModel&&g.scrollLeft||h.scrollLeft,n=c.top+l-j,o=c.left+m-k;return{top:n,left:o}}:f.fn.offset=function(a){var b=this[0];if(a)return this.each(function(b){f.offset.setOffset(this,a,b)});if(!b||!b.ownerDocument)return null;if(b===b.ownerDocument.body)return f.offset.bodyOffset(b);var c,d=b.offsetParent,e=b,g=b.ownerDocument,h=g.documentElement,i=g.body,j=g.defaultView,k=j?j.getComputedStyle(b,null):b.currentStyle,l=b.offsetTop,m=b.offsetLeft;while((b=b.parentNode)&&b!==i&&b!==h){if(f.support.fixedPosition&&k.position==="fixed")break;c=j?j.getComputedStyle(b,null):b.currentStyle,l-=b.scrollTop,m-=b.scrollLeft,b===d&&(l+=b.offsetTop,m+=b.offsetLeft,f.support.doesNotAddBorder&&(!f.support.doesAddBorderForTableAndCells||!cw.test(b.nodeName))&&(l+=parseFloat(c.borderTopWidth)||0,m+=parseFloat(c.borderLeftWidth)||0),e=d,d=b.offsetParent),f.support.subtractsBorderForOverflowNotVisible&&c.overflow!=="visible"&&(l+=parseFloat(c.borderTopWidth)||0,m+=parseFloat(c.borderLeftWidth)||0),k=c}if(k.position==="relative"||k.position==="static")l+=i.offsetTop,m+=i.offsetLeft;f.support.fixedPosition&&k.position==="fixed"&&(l+=Math.max(h.scrollTop,i.scrollTop),m+=Math.max(h.scrollLeft,i.scrollLeft));return{top:l,left:m}},f.offset={bodyOffset:function(a){var b=a.offsetTop,c=a.offsetLeft;f.support.doesNotIncludeMarginInBodyOffset&&(b+=parseFloat(f.css(a,"marginTop"))||0,c+=parseFloat(f.css(a,"marginLeft"))||0);return{top:b,left:c}},setOffset:function(a,b,c){var d=f.css(a,"position");d==="static"&&(a.style.position="relative");var e=f(a),g=e.offset(),h=f.css(a,"top"),i=f.css(a,"left"),j=(d==="absolute"||d==="fixed")&&f.inArray("auto",[h,i])>-1,k={},l={},m,n;j?(l=e.position(),m=l.top,n=l.left):(m=parseFloat(h)||0,n=parseFloat(i)||0),f.isFunction(b)&&(b=b.call(a,c,g)),b.top!=null&&(k.top=b.top-g.top+m),b.left!=null&&(k.left=b.left-g.left+n),"using"in b?b.using.call(a,k):e.css(k)}},f.fn.extend({position:function(){if(!this[0])return null;var a=this[0],b=this.offsetParent(),c=this.offset(),d=cx.test(b[0].nodeName)?{top:0,left:0}:b.offset();c.top-=parseFloat(f.css(a,"marginTop"))||0,c.left-=parseFloat(f.css(a,"marginLeft"))||0,d.top+=parseFloat(f.css(b[0],"borderTopWidth"))||0,d.left+=parseFloat(f.css(b[0],"borderLeftWidth"))||0;return{top:c.top-d.top,left:c.left-d.left}},offsetParent:function(){return this.map(function(){var a=this.offsetParent||c.body;while(a&&!cx.test(a.nodeName)&&f.css(a,"position")==="static")a=a.offsetParent;return a})}}),f.each(["Left","Top"],function(a,c){var d="scroll"+c;f.fn[d]=function(c){var e,g;if(c===b){e=this[0];if(!e)return null;g=cy(e);return g?"pageXOffset"in g?g[a?"pageYOffset":"pageXOffset"]:f.support.boxModel&&g.document.documentElement[d]||g.document.body[d]:e[d]}return this.each(function(){g=cy(this),g?g.scrollTo(a?f(g).scrollLeft():c,a?c:f(g).scrollTop()):this[d]=c})}}),f.each(["Height","Width"],function(a,c){var d=c.toLowerCase();f.fn["inner"+c]=function(){var a=this[0];return a?a.style?parseFloat(f.css(a,d,"padding")):this[d]():null},f.fn["outer"+c]=function(a){var b=this[0];return b?b.style?parseFloat(f.css(b,d,a?"margin":"border")):this[d]():null},f.fn[d]=function(a){var e=this[0];if(!e)return a==null?null:this;if(f.isFunction(a))return this.each(function(b){var c=f(this);c[d](a.call(this,b,c[d]()))});if(f.isWindow(e)){var g=e.document.documentElement["client"+c],h=e.document.body;return e.document.compatMode==="CSS1Compat"&&g||h&&h["client"+c]||g}if(e.nodeType===9)return Math.max(e.documentElement["client"+c],e.body["scroll"+c],e.documentElement["scroll"+c],e.body["offset"+c],e.documentElement["offset"+c]);if(a===b){var i=f.css(e,d),j=parseFloat(i);return f.isNumeric(j)?j:i}return this.css(d,typeof a=="string"?a:a+"px")}}),a.jQuery=a.$=f,typeof define=="function"&&define.amd&&define.amd.jQuery&&define("jquery",[],function(){return f})})(window);
/***********************************************************
	Filename: {phpok}/form.js
	Note	: 自定义表单中涉及到的JS
	Version : 4.0
	Web		: www.phpok.com
	Author  : qinggan <qinggan@188.com>
	Update  : 2012-12-26 11:02
***********************************************************/
function phpok_form_password(id,len)
{
	var list = new Array("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
	if(!len || len == "undefined") len = 8;
	var rand = "";
	for(var i = 0;i<len;i++)
	{
		var num = Math.floor(Math.random()*36+0);
		rand = rand + list[num];
	}
	var htm = "随机密码："+rand;
	$("#"+id+"_html").html(htm);
	$("#"+id).val(rand);
}

//表单扩展按钮
//btn，类型
function phpok_btn_action(btn,id)
{
	if(btn == "image")
	{
		if(!id || id == "undefined")
		{
			$.dialog.alert("未指定ID");
			return false;
		}
		var url = get_url("open","input") + "&ext="+$.str.encode("png,jpg,gif,jpeg,bmp")+"&id="+id;
		$.dialog.open(url,{
			title: "图片管理器",
			lock : true,
			width: "80%",
			height: "70%",
			resize: false
		});
	}
}

function phpok_btn_view(btn,id)
{
	if(btn == "image")
	{
		var url = $("#"+id).val();
		if(!url || url == "undefined")
		{
			$.dialog.alert("图片不存在，请在表单中填写图片地址");
		}
		else
		{
			$.dialog({
				"title":"预览",
				"content": '<img src="'+url+'" border="0" />',
				"lock":true
			});
		}
	}
}

//清空
function phpok_btn_clear(btn,id)
{
	$("#"+id).val("");
}

//添加自定义字段
function ext_add(module)
{
	var url = get_url('ext','create','id='+$.str.encode(module));
	$.dialog.open(url,{
		'title':'创建扩展字段',
		'width':'750px',
		'height':'580px',
		'resize':false,
		'lock':true,
		'ok':function(){
			var iframe = this.iframe.contentWindow;
			if (!iframe.document.body) {
				alert('iframe还没加载完毕呢');
				return false;
			};
			iframe.save();
			return false;
		},
		'okVal': '提交配置'
	});
	return true;
}

function ext_add2(id,module)
{
	var url = get_url("ext","add") + "&module="+module+"&id="+id;
	var rs = $.phpok.json(url);
	if(rs.status == 'ok')
	{
		autosave(module,module,auto_refresh);
	}
	else
	{
		$.dialog.alert(rs.content);
		return false;
	}
}

function ext_delete(id,module,title)
{
	$.dialog.confirm('确定要删除扩展字段：<span class="red">'+title+'</span> 吗？删除后是不能恢复的！',function(){
		var url = get_url('ext','delete');
		url += "&module="+$.str.encode(module);
		url += "&id="+id;
		var rs = $.phpok.json(url);
		if(rs.status == 'ok')
		{
			autosave(module,module,auto_refresh);
		}
		else
		{
			$.dialog.alert(rs.content);
			return false;
		}
	});
}

//编辑字段
function ext_edit(id,module)
{
	var url = get_url("ext","edit",'id='+id);
	url += "&module="+$.str.encode(module);
	$.dialog.open(url,{
		"title" : "编辑扩展字段属性",
		"width" : "700px",
		"height" : "95%",
		"win_min":false,
		"win_max":false,
		"resize" : false,
		"lock" : true,
		'okVal': '提交',
		'ok': function(){
			var iframe = this.iframe.contentWindow;
			if (!iframe.document.body) {
				alert('iframe还没加载完毕呢');
				return false;
			};
			iframe.save();
			return false;
		}
	});
}

function _phpok_form_opt(val,id,eid,etype)
{
	if(!val || val == "undefined")
	{
		$("#"+id).html("").hide();
		return false;
	}
	var url = get_url("form","config") + "&id="+$.str.encode(val);
	if(eid && eid != "undefined")
	{
		url += "&eid="+eid;
	}
	if(etype && etype != "undefined")
	{
		url += "&etype="+etype;
	}
	$.ajax({
		"url" : url,
		"cache" : false,
		"dataType" : "html",
		"success" : function (rs)
		{
			if(rs && rs != "exit")
			{
				$("#"+id).html(rs).show();
			}
		}
	});
}

function phpok_btn_editor_picture(id)
{
	var url = get_url("edit","picture") + "&input="+id;
	$.dialog.open(url,{
		"title" : "图片库",
		"width" : "760px",
		"height" : "80%",
		"resize" : false,
		"lock" : true
	});
}

function phpok_btn_editor_file(id)
{
	var url = get_url("edit","file") + "&input="+id+"&nopic=1";
	$.dialog.open(url,{
		"title" : "附件资源",
		"width" : "760px",
		"height" : "80%",
		"resize" : false,
		"lock" : true
	});
}

function phpok_btn_editor_video(id)
{
	var url = get_url("edit","video") + "&input="+id+"&nopic=1";
	$.dialog.open(url,{
		"title" : "添加影音",
		"width" : "760px",
		"height" : "80%",
		"resize" : false,
		"lock" : true
	});
}

//删除单个主题关联
function phpok_title_delete_single(id)
{
	$("#"+id).val("");
	$("#title_"+id).hide();
	$("#phpok-btn-"+id+"-delete").hide();
}

//删除多个主题关联
function phpok_title_delete(id,val)
{
	if(val && val != "undefined")
	{
		//移除DIV值
		$("#"+id+"_div_"+val).remove();
		//移除值
		var c = $("#"+id).val();
		if(c == "" || c == "undefined")
		{
			$("#"+id+"_div").hide();
			$("#"+id+"_button_checkbox").hide();
			$("#"+id).val("");
			return true;
		}
		var clist = c.split(",");
		var n_list = new Array();
		var m = 0;
		for(var i=0;i<clist.length;i++)
		{
			if(clist[i] != val)
			{
				n_list[m] = clist[i];
				m++;
			}
		}
		if(n_list.length<1)
		{
			$("#"+id+"_div").hide();
			$("#"+id+"_button_checkbox").hide();
			$("#"+id).val("");
		}
		else
		{
			$("#"+id).val(n_list.join(","));
		}
		return true;
	}
	val = $.input.checkbox_join(id+"_div");
	if(!val || val == "undefined")
	{
		$.dialog.alert("请选择要删除的信息");
		return false;
	}
	var lst = val.split(",");
	for(var i=0;i<lst.length;i++)
	{
		phpok_title_delete(id,lst[i]);
	}
	return true;
}

//选择主题关联
function phpok_title_select(project_id,is_multi,title,input)
{
	var url = get_url("inp","title")+"&project_id="+$.str.encode(project_id);
	if(is_multi && is_multi != 'undefined')
	{
		url += "&multi=1";
	}
	url += "&identifier="+$.str.encode(input);
	$.dialog.open(url,{
		"title" : title,
		"width" : "760px",
		"height" : "80%",
		"resize" : false,
		"lock" : true,
		"ok": function(){
			var data = $.dialog.data("title_data_"+input);
			if(data)
			{
				$("#"+input).val(data);
				window.eval("action_"+input+"_show()");
				//window.setTimeout("action_"++"_show()",500);
			}
		}
	});
}

function phpok_user_delete(id,val)
{
	//移除DIV值
	$("#"+id+"_div_"+val).remove();
	//移除值
	var c = $("#"+id).val();
	if(c == "" || c == "undefined")
	{
		$("#"+id+"_div").html("");
		$("#"+id).val("");
		return true;
	}
	var clist = c.split(",");
	var n_list = new Array();
	var m = 0;
	for(var i=0;i<clist.length;i++)
	{
		if(clist[i] != val)
		{
			n_list[m] = clist[i];
			m++;
		}
	}
	if(n_list.length<1)
	{
		$("#"+id+"_div").html("");
		$("#"+id).val("");
	}
	else
	{
		$("#"+id).val(n_list.join(","));
	}
	return true;
}

/* PHPOK编辑器扩展按钮属性 */
function phpok_edit_type(id)
{
	var t = "#sMode_"+id;
	if($(t).val() == "可视化")
	{
		$(eval("pageInit_"+id+"()"));
		$(t).val("源代码");
	}
	else
	{
		$("#"+id).xheditor(false);
		eval("CodeMirror_PHPOK_"+id+"()");
		//$("#textarea_"+id+" xhe_default:first").hide();
		//$("#textarea_"+id+" CodeMirror:first").show();
		$(t).val("可视化");
	}
}

/*
 * PHPOK自定义表单中关于附件上传涉及到的JS操作
 * 最后修改时间：2014年7月29日
 * 此JS涉及到外部调用的JS函数get_url，json_ajax，$.str，$.dialog,$.parseJSON
 */
;(function($){
	$.phpok_upload = function(opts){
		var self = this;
		var defaults = {
			multi:false, //是否多附件
			id:'upload',
			swf:'js/webuploader/uploader.swf',
			server:'index.php',
			pick:'#picker',
			resize: false,
			disableGlobalDnd:true,
			fileVal:'upfile',
			filetypes:'jpg,png,gif,jpeg',
			cateid:0
		};
		this.opts = $.extend({},defaults,opts);
		if(!this.opts.multi)
		{
			this.opts.pick = {'id':this.opts.pick,'multi':false};
		}
		else
		{
			this.opts.pick = {'id':this.opts.pick,'multi':true};
		}
		this.id = "#"+this.opts.id;
		this.update_status = 'ready';
		//添加动作
		this.open_action = function(val){
			var content = $(this.id).val();
			if(opts.multi)
			{
				content = (content && content != "undefined") ? content + ","+val : val;
				var lst = $.unique(content.split(","));
				content = lst.join(',');
			}
			else
			{
				content = val;
			}
			$(this.id).val(content);
			if(this.opts.preview && this.opts.preview != 'undefined')
			{
				(this.opts.preview)(content);
			}
			else
			{
				this.preview_res(content);
			}
		};
		this.cateid = function(val){
			this.opts.cateid = val;
		};
		this.uploader = WebUploader.create(this.opts);
		//加入队列前判断附件类型，不符合要求则不允许添加
		this.uploader.on('beforeFileQueued',function(file){
			var val = (self.opts.filetypes).toLowerCase();
			var lst = val.split(',');
			if($.inArray((file.ext).toLowerCase(),lst) < 0)
			{
				alert('不支持 '+file.ext+' 类型附件上传');
				return false;
			}
		});
		//执行添加队列
		this.uploader.on('fileQueued', function( file ) {
			if(self.opts.progress && self.opts.progress != 'undefined')
			{
				(self.opts.progress)(file);
			}
			else
			{
				$(self.id+"_progress").append('<div id="phpok-upfile-' + file.id + '" class="phpok-upfile-list">' +
					'<div class="title">' + file.name + '（<span class="status">等待上传…</span>）</div>' +
					'<div class="progress"><span>&nbsp;</span></div>' +
					'<div class="cancel" id="phpok-upfile-cancel-'+file.id+'"></div>' + 
				'</div>' );
			}
			
			self.upload_state = 'ready';
			$("#phpok-upfile-"+file.id+" .cancel").click(function(){
				self.uploader.removeFile(file,true);
				$("#phpok-upfile-"+file.id).remove();
			});
		});
		this.uploader.on('uploadProgress',function(file,percent){
			var $li = $('#phpok-upfile-'+file.id),
	        $percent = $li.find('.progress span');
	        var width = $li.find('.progress').width();
	        $percent.css( 'width', parseInt(width * percent, 10) + 'px' );
	        $li.find('span.status').html('正在上传…');
		});
		this.uploader.on('uploadBeforeSend',function(block,data){
			data.cateid = self.opts.cateid;
		});
		this.uploader.on('uploadSuccess',function(file,data){
			if(data.status != 'ok')
			{
				if(!data.content) data.content = '上传异常';
				//$('#phpok-upfile-'+file.id).find('span.status').html('上传错误：<span style="color:red">'+data.content+'</span>');
				alert(data.content);
				return false;
			}
			$('#phpok-upfile-'+file.id).find('span.status').html('上传成功');
			if(self.opts.success && self.opts.success != 'undefined')
			{
				(self.opts.success)(file,data);
			}
			else
			{
				self.open_action(data.content.id);
			}
		});
		this.uploader.on('uploadAccept',function(file,data){
			//
		});
		this.uploader.on('uploadError',function(file,reason){
			$('#phpok-upfile-'+file.id).find('span.status').html('上传错误：<span style="color:red">'+reason+'</span>');
		});
		//上传完成，无论失败与否，3秒后删除
		this.uploader.on('uploadComplete',function(file){
			$("#phpok-upfile-"+file.id).hide(1000,function(){
				$(this).remove();
			})
		});
		//上传异常时，触发这个信息
		this.uploader.on('error',function(string){
			alert(string);
			return false;
		});
		$(this.id+"_submit").click(function(){
			//如果
			if($(this).hasClass('disabled'))
			{
				return false;
			}
			var f = $(self.id+"_progress .phpok-upfile-list").length;
			if(f<1)
			{
				alert('请选择要上传的文件');
				return false;
			}
			if(self.upload_state == 'ready' || self.upload_state == 'paused')
			{
				self.uploader.upload();
			}
			else
			{
				self.uploader.stop();
			}
		});
		
		//更新附件信息
		this.update_res = function(id){
			var title = $(self.id+"_title_"+id).val();
			if(!title)
			{
				$.dialog.alert("名称不能为空");
				return false;
			}
			var url = api_url("res","update_title_note") +"&id="+id;
			url += "&title="+$.str.encode(title);
			var note = $(this.id+"_content_"+id).val();
			if(note)
			{
				url += "&note="+$.str.encode(note);
			}
			var rs = json_ajax(url);
			if(rs.status == "ok")
			{
				alert("附件信息更新成功");
				return false;
			}
			else
			{
				alert(rs.content);
				return false;
			}
		};
		//删除附件功能
		this.del_res = function(id){
			var content = $(this.id).val();
			if(!content || content == "undefined")
			{
				return false;
			}
			if(content == id)
			{
				$(this.id).val("");
				$(this.id+"_list").html("").hide();
				return false;
			}
			var list = content.split(",");
			var newlist = new Array();
			var new_i = 0;
			for(var i=0;i<list.length;i++)
			{
				if(list[i] != id)
				{
					newlist[new_i] = list[i];
					new_i++;
				}
			}
			content = newlist.join(",");
			$(this.id).val(content);
			if(this.opts.preview && this.opts.preview != 'undefined')
			{
				(this.opts.preview)(content);
			}
			else
			{
				this.preview_res(content);
			}
		};
		//预览图片
		this.preview = function(id){
			var url = get_url("res_action","preview") + "&id="+id;
			$.dialog.open(url,{
				title: "预览",
				lock : true,
				width: "700px",
				height: "70%",
				resize: true
			});
		};
		//排序
		this.sort = function(){
			var t = [];
			$("."+this.opts.id+"_taxis").each(function(i){
				var val = $(this).val();
				var data = $(this).attr("data");
				t.push({"id":val,"data":data});
			});
			t = t.sort(function(a,b){return parseInt(a['id'])>parseInt(b['id']) ? 1 : -1});
			var list = new Array();
			for(var i in t){
				list[i] = t[i]['data'];
			}
			var val = list.join(",");
			$(this.id).val(val);
			if(this.opts.preview && this.opts.preview != 'undefined'){
				(this.opts.preview)(val);
			}else{
				this.preview_res(val);
			}
		};
		this.sort_title = function(){
			var t = [];
			$("#"+this.opts.id+"_list ._title input").each(function(i){
				var val = $(this).val();
				var data = $(this).attr("data");
				t.push({"id":val,"data":data});
			});
			t = t.sort(function(a,b){return a['id']>b['id'] ? 1 : -1});
			var list = new Array();
			for(var i in t){
				list[i] = t[i]['data'];
			}
			var val = list.join(",");
			$(this.id).val(val);
			if(this.opts.preview && this.opts.preview != 'undefined'){
				(this.opts.preview)(val);
			}else{
				this.preview_res(val);
			}
		};
		//获取列表
		this.preview_res = function(id){
			$(this.id+"_sort").hide();
			if(!id || id == "undefined")
			{
				id = $(this.id).val();
				if(!id || id == "undefined")
				{
					$(this.id+"_list").hide(1000,function(){
						$(this).html('');
					});
					return false;
				}
			}
			var url = api_url("res","idlist") + "&id="+$.str.encode(id);
			var rs = json_ajax(url);
			if(rs.status == "ok")
			{
				var list = rs.content;
				var total = count(list);
				var html = '<div class="_elist">';
				var t = 1;
				var tmp = id.split(",");
				for(var i in tmp)
				{
					if(!list[tmp[i]] || list[tmp[i]] == 'undefined' || !list[tmp[i]]['ico'])
					{
						continue;
					}
					var info = list[tmp[i]];
					var cls = t == total ? "_line_end" : "_line";
					html += '<div class="'+cls+'"><table><tr>';
					html += '<td class="img"><img src="'+info.ico+'" width="100px" height="100px" /></td>';
					html += '<td valign="top">';
					html += '<div class="_title" style="width:450px;margin-bottom:5px;"><input type="text" id="'+this.opts.id+'_title_'+info.id+'" value="'+info.title+'" class="_input" placeholder="名称" data="'+info.id+'"></div>';
					html += '<div class="_note" style="width:450px;margin-bottom:5px;"><textarea id="'+this.opts.id+'_content_'+info.id+'" class="_textarea" placeholder="备注">'+info.note+'</textarea></div>';
					html += '<div class="ext_action" style="width:450px;">';
					html += '<button type="button" class="_btn" onclick="obj_'+this.opts.id+'.update_res('+info.id+')">更新附件信息</button>';
					html += '<button type="button" class="_btn" onclick="obj_'+this.opts.id+'.preview('+info.id+')">预览</button>';
					html += '<button type="button" class="_btn" onclick="obj_'+this.opts.id+'.del_res('+info.id+')">删除</button>';
					if(total > 1)
					{
						html += '<input type="text" class="_taxis '+this.opts.id+'_taxis" value="'+t+'" data="'+info.id+'" />';
					}
					html += '</div></td>';
					html += '</tr></table></div>';
					t++;
				}
				html += '</div>';
				$(this.id+"_list").html(html).show();
				if(total>1)
				{
					$(this.id+"_sort").show();
				}
			}
			else
			{
				$(this.id+"_list").hide(1000,function(){
					$(this).html('');
				});
			}
		}
	};
})(jQuery);


	
	/**
	 * jQuery MD5 hash algorithm function
	 * 
	 * 	<code>
	 * 		Calculate the md5 hash of a String 
	 * 		String $.md5 ( String str )
	 * 	</code>
	 * 
	 * Calculates the MD5 hash of str using the » RSA Data Security, Inc. MD5 Message-Digest Algorithm, and returns that hash. 
	 * MD5 (Message-Digest algorithm 5) is a widely-used cryptographic hash function with a 128-bit hash value. MD5 has been employed in a wide variety of security applications, and is also commonly used to check the integrity of data. The generated hash is also non-reversable. Data cannot be retrieved from the message digest, the digest uniquely identifies the data.
	 * MD5 was developed by Professor Ronald L. Rivest in 1994. Its 128 bit (16 byte) message digest makes it a faster implementation than SHA-1.
	 * This script is used to process a variable length message into a fixed-length output of 128 bits using the MD5 algorithm. It is fully compatible with UTF-8 encoding. It is very useful when u want to transfer encrypted passwords over the internet. If you plan using UTF-8 encoding in your project don't forget to set the page encoding to UTF-8 (Content-Type meta tag). 
	 * This function orginally get from the WebToolkit and rewrite for using as the jQuery plugin.
	 * 
	 * Example
	 * 	Code
	 * 		<code>
	 * 			$.md5("I'm Persian."); 
	 * 		</code>
	 * 	Result
	 * 		<code>
	 * 			"b8c901d0f02223f9761016cfff9d68df"
	 * 		</code>
	 * 
	 * @alias Muhammad Hussein Fattahizadeh < muhammad [AT] semnanweb [DOT] com >
	 * @link http://www.semnanweb.com/jquery-plugin/md5.html
	 * @see http://www.webtoolkit.info/
	 * @license http://www.gnu.org/licenses/gpl.html [GNU General Public License]
	 * @param {jQuery} {md5:function(string))
	 * @return string
	 */
	
	(function($){
		
		var rotateLeft = function(lValue, iShiftBits) {
			return (lValue << iShiftBits) | (lValue >>> (32 - iShiftBits));
		}
		
		var addUnsigned = function(lX, lY) {
			var lX4, lY4, lX8, lY8, lResult;
			lX8 = (lX & 0x80000000);
			lY8 = (lY & 0x80000000);
			lX4 = (lX & 0x40000000);
			lY4 = (lY & 0x40000000);
			lResult = (lX & 0x3FFFFFFF) + (lY & 0x3FFFFFFF);
			if (lX4 & lY4) return (lResult ^ 0x80000000 ^ lX8 ^ lY8);
			if (lX4 | lY4) {
				if (lResult & 0x40000000) return (lResult ^ 0xC0000000 ^ lX8 ^ lY8);
				else return (lResult ^ 0x40000000 ^ lX8 ^ lY8);
			} else {
				return (lResult ^ lX8 ^ lY8);
			}
		}
		
		var F = function(x, y, z) {
			return (x & y) | ((~ x) & z);
		}
		
		var G = function(x, y, z) {
			return (x & z) | (y & (~ z));
		}
		
		var H = function(x, y, z) {
			return (x ^ y ^ z);
		}
		
		var I = function(x, y, z) {
			return (y ^ (x | (~ z)));
		}
		
		var FF = function(a, b, c, d, x, s, ac) {
			a = addUnsigned(a, addUnsigned(addUnsigned(F(b, c, d), x), ac));
			return addUnsigned(rotateLeft(a, s), b);
		};
		
		var GG = function(a, b, c, d, x, s, ac) {
			a = addUnsigned(a, addUnsigned(addUnsigned(G(b, c, d), x), ac));
			return addUnsigned(rotateLeft(a, s), b);
		};
		
		var HH = function(a, b, c, d, x, s, ac) {
			a = addUnsigned(a, addUnsigned(addUnsigned(H(b, c, d), x), ac));
			return addUnsigned(rotateLeft(a, s), b);
		};
		
		var II = function(a, b, c, d, x, s, ac) {
			a = addUnsigned(a, addUnsigned(addUnsigned(I(b, c, d), x), ac));
			return addUnsigned(rotateLeft(a, s), b);
		};
		
		var convertToWordArray = function(string) {
			var lWordCount;
			var lMessageLength = string.length;
			var lNumberOfWordsTempOne = lMessageLength + 8;
			var lNumberOfWordsTempTwo = (lNumberOfWordsTempOne - (lNumberOfWordsTempOne % 64)) / 64;
			var lNumberOfWords = (lNumberOfWordsTempTwo + 1) * 16;
			var lWordArray = Array(lNumberOfWords - 1);
			var lBytePosition = 0;
			var lByteCount = 0;
			while (lByteCount < lMessageLength) {
				lWordCount = (lByteCount - (lByteCount % 4)) / 4;
				lBytePosition = (lByteCount % 4) * 8;
				lWordArray[lWordCount] = (lWordArray[lWordCount] | (string.charCodeAt(lByteCount) << lBytePosition));
				lByteCount++;
			}
			lWordCount = (lByteCount - (lByteCount % 4)) / 4;
			lBytePosition = (lByteCount % 4) * 8;
			lWordArray[lWordCount] = lWordArray[lWordCount] | (0x80 << lBytePosition);
			lWordArray[lNumberOfWords - 2] = lMessageLength << 3;
			lWordArray[lNumberOfWords - 1] = lMessageLength >>> 29;
			return lWordArray;
		};
		
		var wordToHex = function(lValue) {
			var WordToHexValue = "", WordToHexValueTemp = "", lByte, lCount;
			for (lCount = 0; lCount <= 3; lCount++) {
				lByte = (lValue >>> (lCount * 8)) & 255;
				WordToHexValueTemp = "0" + lByte.toString(16);
				WordToHexValue = WordToHexValue + WordToHexValueTemp.substr(WordToHexValueTemp.length - 2, 2);
			}
			return WordToHexValue;
		};
		
		var uTF8Encode = function(string) {
			string = string.replace(/\x0d\x0a/g, "\x0a");
			var output = "";
			for (var n = 0; n < string.length; n++) {
				var c = string.charCodeAt(n);
				if (c < 128) {
					output += String.fromCharCode(c);
				} else if ((c > 127) && (c < 2048)) {
					output += String.fromCharCode((c >> 6) | 192);
					output += String.fromCharCode((c & 63) | 128);
				} else {
					output += String.fromCharCode((c >> 12) | 224);
					output += String.fromCharCode(((c >> 6) & 63) | 128);
					output += String.fromCharCode((c & 63) | 128);
				}
			}
			return output;
		};
		
		$.extend({
			md5: function(string) {
				var x = Array();
				var k, AA, BB, CC, DD, a, b, c, d;
				var S11=7, S12=12, S13=17, S14=22;
				var S21=5, S22=9 , S23=14, S24=20;
				var S31=4, S32=11, S33=16, S34=23;
				var S41=6, S42=10, S43=15, S44=21;
				string = uTF8Encode(string);
				x = convertToWordArray(string);
				a = 0x67452301; b = 0xEFCDAB89; c = 0x98BADCFE; d = 0x10325476;
				for (k = 0; k < x.length; k += 16) {
					AA = a; BB = b; CC = c; DD = d;
					a = FF(a, b, c, d, x[k+0],  S11, 0xD76AA478);
					d = FF(d, a, b, c, x[k+1],  S12, 0xE8C7B756);
					c = FF(c, d, a, b, x[k+2],  S13, 0x242070DB);
					b = FF(b, c, d, a, x[k+3],  S14, 0xC1BDCEEE);
					a = FF(a, b, c, d, x[k+4],  S11, 0xF57C0FAF);
					d = FF(d, a, b, c, x[k+5],  S12, 0x4787C62A);
					c = FF(c, d, a, b, x[k+6],  S13, 0xA8304613);
					b = FF(b, c, d, a, x[k+7],  S14, 0xFD469501);
					a = FF(a, b, c, d, x[k+8],  S11, 0x698098D8);
					d = FF(d, a, b, c, x[k+9],  S12, 0x8B44F7AF);
					c = FF(c, d, a, b, x[k+10], S13, 0xFFFF5BB1);
					b = FF(b, c, d, a, x[k+11], S14, 0x895CD7BE);
					a = FF(a, b, c, d, x[k+12], S11, 0x6B901122);
					d = FF(d, a, b, c, x[k+13], S12, 0xFD987193);
					c = FF(c, d, a, b, x[k+14], S13, 0xA679438E);
					b = FF(b, c, d, a, x[k+15], S14, 0x49B40821);
					a = GG(a, b, c, d, x[k+1],  S21, 0xF61E2562);
					d = GG(d, a, b, c, x[k+6],  S22, 0xC040B340);
					c = GG(c, d, a, b, x[k+11], S23, 0x265E5A51);
					b = GG(b, c, d, a, x[k+0],  S24, 0xE9B6C7AA);
					a = GG(a, b, c, d, x[k+5],  S21, 0xD62F105D);
					d = GG(d, a, b, c, x[k+10], S22, 0x2441453);
					c = GG(c, d, a, b, x[k+15], S23, 0xD8A1E681);
					b = GG(b, c, d, a, x[k+4],  S24, 0xE7D3FBC8);
					a = GG(a, b, c, d, x[k+9],  S21, 0x21E1CDE6);
					d = GG(d, a, b, c, x[k+14], S22, 0xC33707D6);
					c = GG(c, d, a, b, x[k+3],  S23, 0xF4D50D87);
					b = GG(b, c, d, a, x[k+8],  S24, 0x455A14ED);
					a = GG(a, b, c, d, x[k+13], S21, 0xA9E3E905);
					d = GG(d, a, b, c, x[k+2],  S22, 0xFCEFA3F8);
					c = GG(c, d, a, b, x[k+7],  S23, 0x676F02D9);
					b = GG(b, c, d, a, x[k+12], S24, 0x8D2A4C8A);
					a = HH(a, b, c, d, x[k+5],  S31, 0xFFFA3942);
					d = HH(d, a, b, c, x[k+8],  S32, 0x8771F681);
					c = HH(c, d, a, b, x[k+11], S33, 0x6D9D6122);
					b = HH(b, c, d, a, x[k+14], S34, 0xFDE5380C);
					a = HH(a, b, c, d, x[k+1],  S31, 0xA4BEEA44);
					d = HH(d, a, b, c, x[k+4],  S32, 0x4BDECFA9);
					c = HH(c, d, a, b, x[k+7],  S33, 0xF6BB4B60);
					b = HH(b, c, d, a, x[k+10], S34, 0xBEBFBC70);
					a = HH(a, b, c, d, x[k+13], S31, 0x289B7EC6);
					d = HH(d, a, b, c, x[k+0],  S32, 0xEAA127FA);
					c = HH(c, d, a, b, x[k+3],  S33, 0xD4EF3085);
					b = HH(b, c, d, a, x[k+6],  S34, 0x4881D05);
					a = HH(a, b, c, d, x[k+9],  S31, 0xD9D4D039);
					d = HH(d, a, b, c, x[k+12], S32, 0xE6DB99E5);
					c = HH(c, d, a, b, x[k+15], S33, 0x1FA27CF8);
					b = HH(b, c, d, a, x[k+2],  S34, 0xC4AC5665);
					a = II(a, b, c, d, x[k+0],  S41, 0xF4292244);
					d = II(d, a, b, c, x[k+7],  S42, 0x432AFF97);
					c = II(c, d, a, b, x[k+14], S43, 0xAB9423A7);
					b = II(b, c, d, a, x[k+5],  S44, 0xFC93A039);
					a = II(a, b, c, d, x[k+12], S41, 0x655B59C3);
					d = II(d, a, b, c, x[k+3],  S42, 0x8F0CCC92);
					c = II(c, d, a, b, x[k+10], S43, 0xFFEFF47D);
					b = II(b, c, d, a, x[k+1],  S44, 0x85845DD1);
					a = II(a, b, c, d, x[k+8],  S41, 0x6FA87E4F);
					d = II(d, a, b, c, x[k+15], S42, 0xFE2CE6E0);
					c = II(c, d, a, b, x[k+6],  S43, 0xA3014314);
					b = II(b, c, d, a, x[k+13], S44, 0x4E0811A1);
					a = II(a, b, c, d, x[k+4],  S41, 0xF7537E82);
					d = II(d, a, b, c, x[k+11], S42, 0xBD3AF235);
					c = II(c, d, a, b, x[k+2],  S43, 0x2AD7D2BB);
					b = II(b, c, d, a, x[k+9],  S44, 0xEB86D391);
					a = addUnsigned(a, AA);
					b = addUnsigned(b, BB);
					c = addUnsigned(c, CC);
					d = addUnsigned(d, DD);
				}
				var tempValue = wordToHex(a) + wordToHex(b) + wordToHex(c) + wordToHex(d);
				return tempValue.toLowerCase();
			}
		});
	})(jQuery);
// PHPOK程序中常用到的JS，封装在此
// 水平比较菜:)
;(function($){
	$.phpok = {
		//刷新
		refresh: function(){
			var url = window.location.href;
			this.go(url);
		},
		reload:function(){
			this.refresh();
		},
		go: function(url){
			if(!url)
			{
				return false;
			}
			url = this.nocache(url);
			window.location.href = url;
		},
		ajax:function(url,obj,async){
			if(!url)
			{
				return false;
			}
			url = this.nocache(url);
			if(!obj || obj == 'undefined')
			{
				return $.ajax({'url':url,cache:false,async:false,dataType:"html"}).responseText;
			}
			else
			{
				var is_async = (!async || async == 'undefined') ? false : true;
				$.ajax({
					'url':url,
					'cache':false,
					'async':is_async,
					'dataType':'html',
					'success':function(rs){
						(obj)(rs);
					}
				});
			}
		},
		json:function(url,obj,async){
			if(!url)
			{
				return false;
			}
			url = this.nocache(url);
			if(!obj || obj == 'undefined')
			{
				var info = $.ajax({'url':url,cache:false,async:false,dataType:"html"}).responseText;
				return $.parseJSON(info);
			}
			else
			{
				var is_async = (!async || async == 'undefined') ? false : true;
				$.ajax({
					'url':url,
					'cache':false,
					'async':is_async,
					'dataType':'json',
					'success':function(rs){
						(obj)(rs);
					}
				});
			}
		},
		nocache: function(url){
			url = url.replace(/&amp;/g,'&');
			if(url.indexOf('_noCache') != -1)
			{
				url = url.replace(/\_noCache=[0-9\.]+/,'_noCache='+Math.random());
			}
			else
			{
				url += url.indexOf('?') != -1 ? '&' : '?';
				url += '_noCache='+Math.random();
			}
			return url;
		}
	};

})(jQuery);

//JS操作全选，反选等工具
// 由PHPOK整理重新编写的常见的input属性操作
;(function($){

	$.input = {
		//全选，调用方法：$.input.checkbox_all(id);
		checkbox_all: function(id){
			var t = id && id != "undefined" ? $("#"+id+" input[type=checkbox]") : $("input[type=checkbox]");
			t.each(function(){$(this).attr("checked",true);});
			t = null;
		},
		//全不选，调用方法：$.input.checkbox_none(id);
		checkbox_none: function(id){
			var t = id && id != "undefined" ? $("#"+id+" input[type=checkbox]") : $("input[type=checkbox]");
			t.each(function(){$(this).attr("checked",false);});
			t = null;
		},
		//每次选5个（total默认值为5） $.input.checkbox_not_all(id,5);
		checkbox_not_all: function(id,total){
			var t = id && id != "undefined" ? $("#"+id+" input[type=checkbox]") : $("input[type=checkbox]");
			var num = 0;
			if(!total || parseInt(total)<5) total = 5;
			t.each(function(){
				if($(this).attr("checked") != true && num<total)
				{
					$(this).attr("checked",true);
					num++;
				}
			});
			t = num = total = null;
		},
		//反选，调用方法：$.input.checkbox_anti(id);
		checkbox_anti: function(id){
			var t = id && id != "undefined" ? $("#"+id+" input[type=checkbox]") : $("input[type=checkbox]");
			t.each(function(i){
				if($(this).attr("checked") == true || $(this).attr("checked") == "checked"){
					$(this).attr("checked",false);
				}else{
					$(this).attr("checked",true);
				}
			});
			t = null;
		},

		//合并复选框值信息，以英文逗号隔开
		checkbox_join: function(id,type){
			var cv = id && id != "undefined" ? $("#"+id+" input[type=checkbox]") : $("input[type=checkbox]");
			var idarray = new Array();
			var m = 0;
			cv.each(function()
			{
				if(type == "all"){idarray[m] = $(this).val();m++;}
				else if(type == "unchecked")
				{
					if($(this).attr("checked") == false){idarray[m] = $(this).val();m++;}
				}
				else
				{
					if($(this).attr("checked") == true || $(this).attr("checked") == "checked"){idarray[m] = $(this).val();m++;}
				}
			});
			var tid = idarray.join(",");
			cv = idarray = m = null;
			return tid;
		}

	};

})(jQuery);

/*!
 * http://www.phpok.com/
 *
 * Copyright 2011, phpok.com
 * Released under the MIT, BSD, and LGPL Licenses.
 * 字符串编码，使用方法： $.str.encode(string);
 * 字符串合并，使用方法： $.str.join(str1,str2);
 *
 * Date: 2011-12-01 11:47
 */
;(function($){

	$.str = {
		join: function(str1,str2){
			if(str1 == "" && str2 == "" ) return false;
			if(str1 == "") return str2;
			if(str2 == "") return str1;
			var string = str1 + "," +str2;
			var array = string.split(",");
			array = $.unique(array);
			var string = array.join(",");
			return string ? string : false;
		},
		identifier: function(str){
			//验证标识串，PHPOK系统中，大量使用标识串，将此检测合并进来
			var chk = /^[A-Za-z]+[a-zA-Z0-9_\-]*$/;
			return chk.test(str);
		},
		encode: function(s1){
			var s = escape(s1);
			var sa = s.split("%");
			var retV ="";
			if(sa[0] != "")
			{
				retV = sa[0];
			}
			for(var i = 1; i < sa.length; i ++)
			{
				if(sa[i].substring(0,1) == "u")
				{
					retV += this.StringHex2Utf8(this.Str2Hex(sa[i].substring(1,5)));
					if(sa[i].length>5)
					{
						retV += sa[i].substring(5);
					}
				}
				else
				{
					retV += "%" + sa[i];
				}
			}
			return retV;
		},

		StringHex2Utf8: function(s){
			var retS = "";
			var tempS = "";
			var ss = "";
			if(s.length == 16)
			{
				tempS = "1110" + s.substring(0, 4);
				tempS += "10" +  s.substring(4, 10);
				tempS += "10" + s.substring(10,16);
				var sss = "0123456789ABCDEF";
				for(var i = 0; i < 3; i ++)
				{
					retS += "%";
					ss = tempS.substring(i * 8, (eval(i)+1)*8);
					retS += sss.charAt(this.Dig2Dec(ss.substring(0,4)));
					retS += sss.charAt(this.Dig2Dec(ss.substring(4,8)));
				}
				return retS;
			}
			return "";
		},

		Dig2Dec: function(s){
			var retV = 0;
			if(s.length == 4)
			{
				for(var i = 0; i < 4; i ++)
				{
					retV += eval(s.charAt(i)) * Math.pow(2, 3 - i);
				}
				return retV;
			}
			return -1;
		},

		Dec2Dig: function(n1){
			var s = "";
			var n2 = 0;
			for(var i = 0; i < 4; i++)
			{
				n2 = Math.pow(2,3 - i);
				if(n1 >= n2)
				{
					s += '1';
					n1 = n1 - n2;
				}
				else
				{
					s += '0';
				}
			}
			return s;
		},

		Str2Hex: function(s){
			var c = "";
			var n;
			var ss = "0123456789ABCDEF";
			var digS = "";
			for(var i = 0; i < s.length; i ++)
			{
				c = s.charAt(i);
				n = ss.indexOf(c);
				digS += this.Dec2Dig(eval(n));
			}
			return digS;
		}
	};

	$.identifier = function(str){
		return $.str.identifier(str);
	};
})(jQuery);


function identifier(str)
{
	return $.str.identifier(str);
}

// 由PHPOK编写的基于jQuery的Cookie操作
// 读取cookie信息 $.cookie.get("变量名");
// 设置cookie信息 $.cookie.set("变量名","值","过期时间");
// 删除Cookie信息 $.cookie.del("变量名");

;(function($){
	$.cookie = {
		get: function(name) {
			var cookieValue = "";
			var search = name + "=";
			if(document.cookie.length > 0)
			{
				var offset = document.cookie.indexOf(search);
				if (offset != -1)
				{
					offset += search.length;
					var end = document.cookie.indexOf(";", offset);
					if (end == -1)
					{
						end = document.cookie.length;
					}
					cookieValue = unescape(document.cookie.substring(offset, end));
					end = null;
				}
				search = offset = null;
			}
			return cookieValue;
		},
		set: function(cookieName,cookieValue,DayValue){
			var expire = "";
			var day_value=1;
			if(DayValue!=null)
			{
				day_value=DayValue;
			}
			expire = new Date((new Date()).getTime() + day_value * 86400000);
			expire = "; expires=" + expire.toGMTString();
			document.cookie = cookieName + "=" + escape(cookieValue) +";path=/"+ expire;
			cookieName = cookieValue = DayValue = day_value = expire = null;
		},
		del: function(cookieName){
			var expire = "";
			expire = new Date((new Date()).getTime() - 1 );
			expire = "; expires=" + expire.toGMTString();
			document.cookie = cookieName + "=" + escape("") +";path=/"+ expire;		
			cookieName = expire = null;
		}
	};
})(jQuery);


/***********************************************************
	Filename: js/global.js
	Note	: 后台通用JS，此JS应加载在jquery.js之后
	Version : 4.0
	Web		: www.phpok.com
	Author  : qinggan <qinggan@188.com>
	Update  : 2012-10-19 16:58
***********************************************************/
//异步加载js
function load_js(url)
{
	if(!url || url == "undefined") return false;
	var lst = url.split(",");
	var lst_count = lst.length;
	var elist = new Array();
	var tm = 0;
	$("script").each(function(t){
		var src = $(this).attr("src");
		if(src && src != 'undefined'){
			elist[tm] = src;
			tm++; 
		}
	});
	var html = '';
	for(var i=0;i<lst_count;i++)
	{
		if($.inArray(lst[i],elist) < 0)
		{
			html += '<script type="text/javascript" src="'+lst[i]+'"></script>';
		}
	}
	$("head").append(html);
}

// 同步加载Ajax，返回字符串
function get_ajax(turl)
{
	return $.phpok.ajax(turl);
}

// 同步加载Ajax，返回JSON数组
function json_ajax(turl)
{
	return $.phpok.json(turl);
}


// 异步加载Ajax，执行函数
function ajax_async(turl,func,type)
{
	if(!turl || turl == "undefined")
	{
		return false;
	}
	if(!func || func == "undefined")
	{
		return false;
	}
	if(!type || type == "undefined")
	{
		type = "json";
	}
	if(type != "html" && type != "json" && type != "text" && type != "xml")
	{
		type = "json";
	}
	turl = $.phpok.nocache(turl);
	$.ajax({
		'url': turl,
		'cache': false,
		'async': true,
		'dataType': type,
		'success': function(rs){
			(func)(rs);
		}
	});
}

// 跳转页面
function direct(url)
{
	if(!url || url == "undefined") url = window.location.href;
	$.phpok.go(url);
}

//自动刷新
function auto_refresh(rs)
{
	$.phpok.reload();
}

function autosave_callback(rs)
{
	return true;
}

/* 计算字符数长度，中文等同于三个字符，英文为一个字符 */
function strlen(str)
{
	var len = str.length;
	var reLen = 0;
	for (var i = 0; i < len; i++)
	{
		if (str.charCodeAt(i) < 27 || str.charCodeAt(i) > 126)
		{
			reLen += 3;
		} else {
			reLen++;
		}
	}
	if(reLen > 1024 && reLen < (1024 * 1024))
	{
		var reLen = (parseFloat(reLen / 1024).toFixed(3)).toString() + "KB";
	}
	else if(reLen > (1024 * 1024) && reLen < (1024 * 1024 * 1024))
	{
		var reLen = (parseFloat(reLen / (1024 * 1024)).toFixed(3)).toString() + "MB";
	}
	if(!reLen) reLen = "0";
	return reLen;
}


//友情提示
function tips(content,time,id)
{
	if(!time || time == "undefined") time = 1.5;
	if(!id || id == "undefind")
	{
		$.dialog.tips(content,time);
	}
	else
	{
		return $.dialog({
			id: 'Tips',
			title: false,
			cancel: false,
			fixed: true,
			lock: false,
			focus: id,
			resize: false
		}).content(content).time(time || 1.5);
	}
}

/* 计算数组或对像中的个数 */
function count(id)
{
	var t = typeof id;
	if(t == 'string') return id.length;
	if(t == 'object')
	{
		var n = 0;
		for(var i in id)
		{
			n++;
		}
		return n;
	}
	return false;
}

//JS语言包替换
function lang_replace(str,id,val)
{
	if(!str || str == "undefined") return false;
	if(!id || !val) return str;
	return str.replace("{"+id+"}",val);
}



/*
* jQuery Form Plugin; v20131017
* http://jquery.malsup.com/form/
* Copyright (c) 2013 M. Alsup; Dual licensed: MIT/GPL
* https://github.com/malsup/form#copyright-and-license
*/
;(function(e){"use strict";function t(t){var r=t.data;t.isDefaultPrevented()||(t.preventDefault(),e(t.target).ajaxSubmit(r))}function r(t){var r=t.target,a=e(r);if(!a.is("[type=submit],[type=image]")){var n=a.closest("[type=submit]");if(0===n.length)return;r=n[0]}var i=this;if(i.clk=r,"image"==r.type)if(void 0!==t.offsetX)i.clk_x=t.offsetX,i.clk_y=t.offsetY;else if("function"==typeof e.fn.offset){var o=a.offset();i.clk_x=t.pageX-o.left,i.clk_y=t.pageY-o.top}else i.clk_x=t.pageX-r.offsetLeft,i.clk_y=t.pageY-r.offsetTop;setTimeout(function(){i.clk=i.clk_x=i.clk_y=null},100)}function a(){if(e.fn.ajaxSubmit.debug){var t="[jquery.form] "+Array.prototype.join.call(arguments,"");window.console&&window.console.log?window.console.log(t):window.opera&&window.opera.postError&&window.opera.postError(t)}}var n={};n.fileapi=void 0!==e("<input type='file'/>").get(0).files,n.formdata=void 0!==window.FormData;var i=!!e.fn.prop;e.fn.attr2=function(){if(!i)return this.attr.apply(this,arguments);var e=this.prop.apply(this,arguments);return e&&e.jquery||"string"==typeof e?e:this.attr.apply(this,arguments)},e.fn.ajaxSubmit=function(t){function r(r){var a,n,i=e.param(r,t.traditional).split("&"),o=i.length,s=[];for(a=0;o>a;a++)i[a]=i[a].replace(/\+/g," "),n=i[a].split("="),s.push([decodeURIComponent(n[0]),decodeURIComponent(n[1])]);return s}function o(a){for(var n=new FormData,i=0;a.length>i;i++)n.append(a[i].name,a[i].value);if(t.extraData){var o=r(t.extraData);for(i=0;o.length>i;i++)o[i]&&n.append(o[i][0],o[i][1])}t.data=null;var s=e.extend(!0,{},e.ajaxSettings,t,{contentType:!1,processData:!1,cache:!1,type:u||"POST"});t.uploadProgress&&(s.xhr=function(){var r=e.ajaxSettings.xhr();return r.upload&&r.upload.addEventListener("progress",function(e){var r=0,a=e.loaded||e.position,n=e.total;e.lengthComputable&&(r=Math.ceil(100*(a/n))),t.uploadProgress(e,a,n,r)},!1),r}),s.data=null;var l=s.beforeSend;return s.beforeSend=function(e,r){r.data=t.formData?t.formData:n,l&&l.call(this,e,r)},e.ajax(s)}function s(r){function n(e){var t=null;try{e.contentWindow&&(t=e.contentWindow.document)}catch(r){a("cannot get iframe.contentWindow document: "+r)}if(t)return t;try{t=e.contentDocument?e.contentDocument:e.document}catch(r){a("cannot get iframe.contentDocument: "+r),t=e.document}return t}function o(){function t(){try{var e=n(g).readyState;a("state = "+e),e&&"uninitialized"==e.toLowerCase()&&setTimeout(t,50)}catch(r){a("Server abort: ",r," (",r.name,")"),s(k),j&&clearTimeout(j),j=void 0}}var r=f.attr2("target"),i=f.attr2("action");w.setAttribute("target",d),(!u||/post/i.test(u))&&w.setAttribute("method","POST"),i!=m.url&&w.setAttribute("action",m.url),m.skipEncodingOverride||u&&!/post/i.test(u)||f.attr({encoding:"multipart/form-data",enctype:"multipart/form-data"}),m.timeout&&(j=setTimeout(function(){T=!0,s(D)},m.timeout));var o=[];try{if(m.extraData)for(var l in m.extraData)m.extraData.hasOwnProperty(l)&&(e.isPlainObject(m.extraData[l])&&m.extraData[l].hasOwnProperty("name")&&m.extraData[l].hasOwnProperty("value")?o.push(e('<input type="hidden" name="'+m.extraData[l].name+'">').val(m.extraData[l].value).appendTo(w)[0]):o.push(e('<input type="hidden" name="'+l+'">').val(m.extraData[l]).appendTo(w)[0]));m.iframeTarget||v.appendTo("body"),g.attachEvent?g.attachEvent("onload",s):g.addEventListener("load",s,!1),setTimeout(t,15);try{w.submit()}catch(c){var p=document.createElement("form").submit;p.apply(w)}}finally{w.setAttribute("action",i),r?w.setAttribute("target",r):f.removeAttr("target"),e(o).remove()}}function s(t){if(!x.aborted&&!F){if(M=n(g),M||(a("cannot access response document"),t=k),t===D&&x)return x.abort("timeout"),S.reject(x,"timeout"),void 0;if(t==k&&x)return x.abort("server abort"),S.reject(x,"error","server abort"),void 0;if(M&&M.location.href!=m.iframeSrc||T){g.detachEvent?g.detachEvent("onload",s):g.removeEventListener("load",s,!1);var r,i="success";try{if(T)throw"timeout";var o="xml"==m.dataType||M.XMLDocument||e.isXMLDoc(M);if(a("isXml="+o),!o&&window.opera&&(null===M.body||!M.body.innerHTML)&&--O)return a("requeing onLoad callback, DOM not available"),setTimeout(s,250),void 0;var u=M.body?M.body:M.documentElement;x.responseText=u?u.innerHTML:null,x.responseXML=M.XMLDocument?M.XMLDocument:M,o&&(m.dataType="xml"),x.getResponseHeader=function(e){var t={"content-type":m.dataType};return t[e.toLowerCase()]},u&&(x.status=Number(u.getAttribute("status"))||x.status,x.statusText=u.getAttribute("statusText")||x.statusText);var l=(m.dataType||"").toLowerCase(),c=/(json|script|text)/.test(l);if(c||m.textarea){var f=M.getElementsByTagName("textarea")[0];if(f)x.responseText=f.value,x.status=Number(f.getAttribute("status"))||x.status,x.statusText=f.getAttribute("statusText")||x.statusText;else if(c){var d=M.getElementsByTagName("pre")[0],h=M.getElementsByTagName("body")[0];d?x.responseText=d.textContent?d.textContent:d.innerText:h&&(x.responseText=h.textContent?h.textContent:h.innerText)}}else"xml"==l&&!x.responseXML&&x.responseText&&(x.responseXML=X(x.responseText));try{E=_(x,l,m)}catch(b){i="parsererror",x.error=r=b||i}}catch(b){a("error caught: ",b),i="error",x.error=r=b||i}x.aborted&&(a("upload aborted"),i=null),x.status&&(i=x.status>=200&&300>x.status||304===x.status?"success":"error"),"success"===i?(m.success&&m.success.call(m.context,E,"success",x),S.resolve(x.responseText,"success",x),p&&e.event.trigger("ajaxSuccess",[x,m])):i&&(void 0===r&&(r=x.statusText),m.error&&m.error.call(m.context,x,i,r),S.reject(x,"error",r),p&&e.event.trigger("ajaxError",[x,m,r])),p&&e.event.trigger("ajaxComplete",[x,m]),p&&!--e.active&&e.event.trigger("ajaxStop"),m.complete&&m.complete.call(m.context,x,i),F=!0,m.timeout&&clearTimeout(j),setTimeout(function(){m.iframeTarget?v.attr("src",m.iframeSrc):v.remove(),x.responseXML=null},100)}}}var l,c,m,p,d,v,g,x,b,y,T,j,w=f[0],S=e.Deferred();if(S.abort=function(e){x.abort(e)},r)for(c=0;h.length>c;c++)l=e(h[c]),i?l.prop("disabled",!1):l.removeAttr("disabled");if(m=e.extend(!0,{},e.ajaxSettings,t),m.context=m.context||m,d="jqFormIO"+(new Date).getTime(),m.iframeTarget?(v=e(m.iframeTarget),y=v.attr2("name"),y?d=y:v.attr2("name",d)):(v=e('<iframe name="'+d+'" src="'+m.iframeSrc+'" />'),v.css({position:"absolute",top:"-1000px",left:"-1000px"})),g=v[0],x={aborted:0,responseText:null,responseXML:null,status:0,statusText:"n/a",getAllResponseHeaders:function(){},getResponseHeader:function(){},setRequestHeader:function(){},abort:function(t){var r="timeout"===t?"timeout":"aborted";a("aborting upload... "+r),this.aborted=1;try{g.contentWindow.document.execCommand&&g.contentWindow.document.execCommand("Stop")}catch(n){}v.attr("src",m.iframeSrc),x.error=r,m.error&&m.error.call(m.context,x,r,t),p&&e.event.trigger("ajaxError",[x,m,r]),m.complete&&m.complete.call(m.context,x,r)}},p=m.global,p&&0===e.active++&&e.event.trigger("ajaxStart"),p&&e.event.trigger("ajaxSend",[x,m]),m.beforeSend&&m.beforeSend.call(m.context,x,m)===!1)return m.global&&e.active--,S.reject(),S;if(x.aborted)return S.reject(),S;b=w.clk,b&&(y=b.name,y&&!b.disabled&&(m.extraData=m.extraData||{},m.extraData[y]=b.value,"image"==b.type&&(m.extraData[y+".x"]=w.clk_x,m.extraData[y+".y"]=w.clk_y)));var D=1,k=2,A=e("meta[name=csrf-token]").attr("content"),L=e("meta[name=csrf-param]").attr("content");L&&A&&(m.extraData=m.extraData||{},m.extraData[L]=A),m.forceSync?o():setTimeout(o,10);var E,M,F,O=50,X=e.parseXML||function(e,t){return window.ActiveXObject?(t=new ActiveXObject("Microsoft.XMLDOM"),t.async="false",t.loadXML(e)):t=(new DOMParser).parseFromString(e,"text/xml"),t&&t.documentElement&&"parsererror"!=t.documentElement.nodeName?t:null},C=e.parseJSON||function(e){return window.eval("("+e+")")},_=function(t,r,a){var n=t.getResponseHeader("content-type")||"",i="xml"===r||!r&&n.indexOf("xml")>=0,o=i?t.responseXML:t.responseText;return i&&"parsererror"===o.documentElement.nodeName&&e.error&&e.error("parsererror"),a&&a.dataFilter&&(o=a.dataFilter(o,r)),"string"==typeof o&&("json"===r||!r&&n.indexOf("json")>=0?o=C(o):("script"===r||!r&&n.indexOf("javascript")>=0)&&e.globalEval(o)),o};return S}if(!this.length)return a("ajaxSubmit: skipping submit process - no element selected"),this;var u,l,c,f=this;"function"==typeof t?t={success:t}:void 0===t&&(t={}),u=t.type||this.attr2("method"),l=t.url||this.attr2("action"),c="string"==typeof l?e.trim(l):"",c=c||window.location.href||"",c&&(c=(c.match(/^([^#]+)/)||[])[1]),t=e.extend(!0,{url:c,success:e.ajaxSettings.success,type:u||e.ajaxSettings.type,iframeSrc:/^https/i.test(window.location.href||"")?"javascript:false":"about:blank"},t);var m={};if(this.trigger("form-pre-serialize",[this,t,m]),m.veto)return a("ajaxSubmit: submit vetoed via form-pre-serialize trigger"),this;if(t.beforeSerialize&&t.beforeSerialize(this,t)===!1)return a("ajaxSubmit: submit aborted via beforeSerialize callback"),this;var p=t.traditional;void 0===p&&(p=e.ajaxSettings.traditional);var d,h=[],v=this.formToArray(t.semantic,h);if(t.data&&(t.extraData=t.data,d=e.param(t.data,p)),t.beforeSubmit&&t.beforeSubmit(v,this,t)===!1)return a("ajaxSubmit: submit aborted via beforeSubmit callback"),this;if(this.trigger("form-submit-validate",[v,this,t,m]),m.veto)return a("ajaxSubmit: submit vetoed via form-submit-validate trigger"),this;var g=e.param(v,p);d&&(g=g?g+"&"+d:d),"GET"==t.type.toUpperCase()?(t.url+=(t.url.indexOf("?")>=0?"&":"?")+g,t.data=null):t.data=g;var x=[];if(t.resetForm&&x.push(function(){f.resetForm()}),t.clearForm&&x.push(function(){f.clearForm(t.includeHidden)}),!t.dataType&&t.target){var b=t.success||function(){};x.push(function(r){var a=t.replaceTarget?"replaceWith":"html";e(t.target)[a](r).each(b,arguments)})}else t.success&&x.push(t.success);if(t.success=function(e,r,a){for(var n=t.context||this,i=0,o=x.length;o>i;i++)x[i].apply(n,[e,r,a||f,f])},t.error){var y=t.error;t.error=function(e,r,a){var n=t.context||this;y.apply(n,[e,r,a,f])}}if(t.complete){var T=t.complete;t.complete=function(e,r){var a=t.context||this;T.apply(a,[e,r,f])}}var j=e("input[type=file]:enabled",this).filter(function(){return""!==e(this).val()}),w=j.length>0,S="multipart/form-data",D=f.attr("enctype")==S||f.attr("encoding")==S,k=n.fileapi&&n.formdata;a("fileAPI :"+k);var A,L=(w||D)&&!k;t.iframe!==!1&&(t.iframe||L)?t.closeKeepAlive?e.get(t.closeKeepAlive,function(){A=s(v)}):A=s(v):A=(w||D)&&k?o(v):e.ajax(t),f.removeData("jqxhr").data("jqxhr",A);for(var E=0;h.length>E;E++)h[E]=null;return this.trigger("form-submit-notify",[this,t]),this},e.fn.ajaxForm=function(n){if(n=n||{},n.delegation=n.delegation&&e.isFunction(e.fn.on),!n.delegation&&0===this.length){var i={s:this.selector,c:this.context};return!e.isReady&&i.s?(a("DOM not ready, queuing ajaxForm"),e(function(){e(i.s,i.c).ajaxForm(n)}),this):(a("terminating; zero elements found by selector"+(e.isReady?"":" (DOM not ready)")),this)}return n.delegation?(e(document).off("submit.form-plugin",this.selector,t).off("click.form-plugin",this.selector,r).on("submit.form-plugin",this.selector,n,t).on("click.form-plugin",this.selector,n,r),this):this.ajaxFormUnbind().bind("submit.form-plugin",n,t).bind("click.form-plugin",n,r)},e.fn.ajaxFormUnbind=function(){return this.unbind("submit.form-plugin click.form-plugin")},e.fn.formToArray=function(t,r){var a=[];if(0===this.length)return a;var i=this[0],o=t?i.getElementsByTagName("*"):i.elements;if(!o)return a;var s,u,l,c,f,m,p;for(s=0,m=o.length;m>s;s++)if(f=o[s],l=f.name,l&&!f.disabled)if(t&&i.clk&&"image"==f.type)i.clk==f&&(a.push({name:l,value:e(f).val(),type:f.type}),a.push({name:l+".x",value:i.clk_x},{name:l+".y",value:i.clk_y}));else if(c=e.fieldValue(f,!0),c&&c.constructor==Array)for(r&&r.push(f),u=0,p=c.length;p>u;u++)a.push({name:l,value:c[u]});else if(n.fileapi&&"file"==f.type){r&&r.push(f);var d=f.files;if(d.length)for(u=0;d.length>u;u++)a.push({name:l,value:d[u],type:f.type});else a.push({name:l,value:"",type:f.type})}else null!==c&&c!==void 0&&(r&&r.push(f),a.push({name:l,value:c,type:f.type,required:f.required}));if(!t&&i.clk){var h=e(i.clk),v=h[0];l=v.name,l&&!v.disabled&&"image"==v.type&&(a.push({name:l,value:h.val()}),a.push({name:l+".x",value:i.clk_x},{name:l+".y",value:i.clk_y}))}return a},e.fn.formSerialize=function(t){return e.param(this.formToArray(t))},e.fn.fieldSerialize=function(t){var r=[];return this.each(function(){var a=this.name;if(a){var n=e.fieldValue(this,t);if(n&&n.constructor==Array)for(var i=0,o=n.length;o>i;i++)r.push({name:a,value:n[i]});else null!==n&&n!==void 0&&r.push({name:this.name,value:n})}}),e.param(r)},e.fn.fieldValue=function(t){for(var r=[],a=0,n=this.length;n>a;a++){var i=this[a],o=e.fieldValue(i,t);null===o||void 0===o||o.constructor==Array&&!o.length||(o.constructor==Array?e.merge(r,o):r.push(o))}return r},e.fieldValue=function(t,r){var a=t.name,n=t.type,i=t.tagName.toLowerCase();if(void 0===r&&(r=!0),r&&(!a||t.disabled||"reset"==n||"button"==n||("checkbox"==n||"radio"==n)&&!t.checked||("submit"==n||"image"==n)&&t.form&&t.form.clk!=t||"select"==i&&-1==t.selectedIndex))return null;if("select"==i){var o=t.selectedIndex;if(0>o)return null;for(var s=[],u=t.options,l="select-one"==n,c=l?o+1:u.length,f=l?o:0;c>f;f++){var m=u[f];if(m.selected){var p=m.value;if(p||(p=m.attributes&&m.attributes.value&&!m.attributes.value.specified?m.text:m.value),l)return p;s.push(p)}}return s}return e(t).val()},e.fn.clearForm=function(t){return this.each(function(){e("input,select,textarea",this).clearFields(t)})},e.fn.clearFields=e.fn.clearInputs=function(t){var r=/^(?:color|date|datetime|email|month|number|password|range|search|tel|text|time|url|week)$/i;return this.each(function(){var a=this.type,n=this.tagName.toLowerCase();r.test(a)||"textarea"==n?this.value="":"checkbox"==a||"radio"==a?this.checked=!1:"select"==n?this.selectedIndex=-1:"file"==a?/MSIE/.test(navigator.userAgent)?e(this).replaceWith(e(this).clone(!0)):e(this).val(""):t&&(t===!0&&/hidden/.test(a)||"string"==typeof t&&e(this).is(t))&&(this.value="")})},e.fn.resetForm=function(){return this.each(function(){("function"==typeof this.reset||"object"==typeof this.reset&&!this.reset.nodeType)&&this.reset()})},e.fn.enable=function(e){return void 0===e&&(e=!0),this.each(function(){this.disabled=!e})},e.fn.selected=function(t){return void 0===t&&(t=!0),this.each(function(){var r=this.type;if("checkbox"==r||"radio"==r)this.checked=t;else if("option"==this.tagName.toLowerCase()){var a=e(this).parent("select");t&&a[0]&&"select-one"==a[0].type&&a.find("option").selected(!1),this.selected=t}})},e.fn.ajaxSubmit.debug=!1})("undefined"!=typeof jQuery?jQuery:window.Zepto);
/*! jQuery JSON plugin 2.4.0 | code.google.com/p/jquery-json */
(function($){'use strict';var escape=/["\\\x00-\x1f\x7f-\x9f]/g,meta={'\b':'\\b','\t':'\\t','\n':'\\n','\f':'\\f','\r':'\\r','"':'\\"','\\':'\\\\'},hasOwn=Object.prototype.hasOwnProperty;$.toJSON=typeof JSON==='object'&&JSON.stringify?JSON.stringify:function(o){if(o===null){return'null';}
var pairs,k,name,val,type=$.type(o);if(type==='undefined'){return undefined;}
if(type==='number'||type==='boolean'){return String(o);}
if(type==='string'){return $.quoteString(o);}
if(typeof o.toJSON==='function'){return $.toJSON(o.toJSON());}
if(type==='date'){var month=o.getUTCMonth()+1,day=o.getUTCDate(),year=o.getUTCFullYear(),hours=o.getUTCHours(),minutes=o.getUTCMinutes(),seconds=o.getUTCSeconds(),milli=o.getUTCMilliseconds();if(month<10){month='0'+month;}
if(day<10){day='0'+day;}
if(hours<10){hours='0'+hours;}
if(minutes<10){minutes='0'+minutes;}
if(seconds<10){seconds='0'+seconds;}
if(milli<100){milli='0'+milli;}
if(milli<10){milli='0'+milli;}
return'"'+year+'-'+month+'-'+day+'T'+
hours+':'+minutes+':'+seconds+'.'+milli+'Z"';}
pairs=[];if($.isArray(o)){for(k=0;k<o.length;k++){pairs.push($.toJSON(o[k])||'null');}
return'['+pairs.join(',')+']';}
if(typeof o==='object'){for(k in o){if(hasOwn.call(o,k)){type=typeof k;if(type==='number'){name='"'+k+'"';}else if(type==='string'){name=$.quoteString(k);}else{continue;}
type=typeof o[k];if(type!=='function'&&type!=='undefined'){val=$.toJSON(o[k]);pairs.push(name+':'+val);}}}
return'{'+pairs.join(',')+'}';}};$.evalJSON=typeof JSON==='object'&&JSON.parse?JSON.parse:function(str){return eval('('+str+')');};$.secureEvalJSON=typeof JSON==='object'&&JSON.parse?JSON.parse:function(str){var filtered=str.replace(/\\["\\\/bfnrtu]/g,'@').replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,']').replace(/(?:^|:|,)(?:\s*\[)+/g,'');if(/^[\],:{}\s]*$/.test(filtered)){return eval('('+str+')');}
throw new SyntaxError('Error parsing JSON, source is not valid.');};$.quoteString=function(str){if(str.match(escape)){return'"'+str.replace(escape,function(a){var c=meta[a];if(typeof c==='string'){return c;}
c=a.charCodeAt();return'\\u00'+Math.floor(c/16).toString(16)+(c%16).toString(16);})+'"';}
return'"'+str+'"';};}(jQuery));
/*!
 * artDialog 4.1.7
 * Date: 2013-03-03 08:04
 * http://code.google.com/p/artdialog/
 * (c) 2009-2012 TangBin, http://www.planeArt.cn
 *
 * This is licensed under the GNU LGPL, version 2.1 or later.
 * For details, see: http://creativecommons.org/licenses/LGPL/2.1/
 */
;(function($,window,undefined){$.noop=$.noop||function(){};var _box,_thisScript,_skin,_path,_count=0,_$window=$(window),_$document=$(document),_$html=$("html"),_elem=document.documentElement,_isIE6=window.VBArray&&!window.XMLHttpRequest,_isMobile="createTouch" in document&&!("onmousemove" in _elem)||/(iPhone|iPad|iPod)/i.test(navigator.userAgent),_expando="artDialog"+ +new Date;var artDialog=function(config,ok,cancel){config=config||{};if(typeof config==="string"||config.nodeType===1){config={content:config,fixed:!_isMobile};}var api,defaults=artDialog.defaults,elem=config.follow=this.nodeType===1&&this||config.follow;for(var i in defaults){if(config[i]===undefined){config[i]=defaults[i];}}$.each({ok:"yesFn",cancel:"noFn",close:"closeFn",init:"initFn",okVal:"yesText",cancelVal:"noText"},function(i,o){config[i]=config[i]!==undefined?config[i]:config[o];});if(typeof elem==="string"){elem=$(elem)[0];}config.id=elem&&elem[_expando+"follow"]||config.id||_expando+_count;api=artDialog.list[config.id];if(elem&&api){return api.follow(elem).zIndex().focus();}if(api){return api.zIndex().focus();}if(_isMobile){config.fixed=false;}if(!$.isArray(config.button)){config.button=config.button?[config.button]:[];}if(ok!==undefined){config.ok=ok;}if(cancel!==undefined){config.cancel=cancel;}config.ok&&config.button.push({name:config.okVal,callback:config.ok,focus:true});config.cancel&&config.button.push({name:config.cancelVal,callback:config.cancel});artDialog.defaults.zIndex=config.zIndex;_count++;return artDialog.list[config.id]=_box?_box._init(config):new artDialog.fn._init(config);};artDialog.fn=artDialog.prototype={version:"4.1.7",closed:true,_init:function(config){var that=this,DOM,icon=config.icon,iconBg=icon&&(_isIE6?{png:"icons/"+icon+".png"}:{backgroundImage:"url('"+config.path+"/images/skins/icons/"+icon+".png')"});that.closed=false;that.config=config;that.DOM=DOM=that.DOM||that._getDOM();DOM.wrap.addClass(config.skin);DOM.close[config.cancel===false?"hide":"show"]();DOM.icon[0].style.display=icon?"":"none";DOM.iconBg.css(iconBg||{background:"none"});DOM.se.css("cursor",config.resize?"se-resize":"auto");DOM.title.css("cursor",config.drag?"move":"auto");DOM.content.css("padding",config.padding);that[config.show?"show":"hide"](true);that.button(config.button).title(config.title).content(config.content,true).size(config.width,config.height).time(config.time);config.follow?that.follow(config.follow):that.position(config.left,config.top);that.zIndex().focus();config.lock&&that.lock();that._addEvent();that._ie6PngFix();_box=null;config.init&&config.init.call(that,window);return that;},content:function(msg){var prev,next,parent,display,that=this,DOM=that.DOM,wrap=DOM.wrap[0],width=wrap.offsetWidth,height=wrap.offsetHeight,left=parseInt(wrap.style.left),top=parseInt(wrap.style.top),cssWidth=wrap.style.width,$content=DOM.content,content=$content[0];that._elemBack&&that._elemBack();wrap.style.width="auto";if(msg===undefined){return content;}if(typeof msg==="string"){$content.html(msg);}else{if(msg&&msg.nodeType===1){display=msg.style.display;prev=msg.previousSibling;next=msg.nextSibling;parent=msg.parentNode;that._elemBack=function(){if(prev&&prev.parentNode){prev.parentNode.insertBefore(msg,prev.nextSibling);}else{if(next&&next.parentNode){next.parentNode.insertBefore(msg,next);}else{if(parent){parent.appendChild(msg);}}}msg.style.display=display;that._elemBack=null;};$content.html("");content.appendChild(msg);msg.style.display="block";}}if(!arguments[1]){if(that.config.follow){that.follow(that.config.follow);}else{width=wrap.offsetWidth-width;height=wrap.offsetHeight-height;left=left-width/2;top=top-height/2;wrap.style.left=Math.max(left,0)+"px";wrap.style.top=Math.max(top,0)+"px";}if(cssWidth&&cssWidth!=="auto"){wrap.style.width=wrap.offsetWidth+"px";}that._autoPositionType();}that._ie6SelectFix();that._runScript(content);return that;},title:function(text){var DOM=this.DOM,wrap=DOM.wrap,title=DOM.title,className="aui_state_noTitle";if(text===undefined){return title[0];}if(text===false){title.hide().html("");wrap.addClass(className);}else{title.show().html(text||"");wrap.removeClass(className);}return this;},position:function(left,top){var that=this,config=that.config,wrap=that.DOM.wrap[0],isFixed=_isIE6?false:config.fixed,ie6Fixed=_isIE6&&that.config.fixed,docLeft=_$document.scrollLeft(),docTop=_$document.scrollTop(),dl=isFixed?0:docLeft,dt=isFixed?0:docTop,ww=_$window.width(),wh=_$window.height(),ow=wrap.offsetWidth,oh=wrap.offsetHeight,style=wrap.style;if(left||left===0){that._left=left.toString().indexOf("%")!==-1?left:null;left=that._toNumber(left,ww-ow);if(typeof left==="number"){left=ie6Fixed?(left+=docLeft):left+dl;style.left=Math.max(left,dl)+"px";}else{if(typeof left==="string"){style.left=left;}}}if(top||top===0){that._top=top.toString().indexOf("%")!==-1?top:null;top=that._toNumber(top,wh-oh);if(typeof top==="number"){top=ie6Fixed?(top+=docTop):top+dt;style.top=Math.max(top,dt)+"px";}else{if(typeof top==="string"){style.top=top;}}}if(left!==undefined&&top!==undefined){that._follow=null;that._autoPositionType();}return that;},size:function(width,height){var maxWidth,maxHeight,scaleWidth,scaleHeight,that=this,config=that.config,DOM=that.DOM,wrap=DOM.wrap,main=DOM.main,wrapStyle=wrap[0].style,style=main[0].style;if(width){that._width=width.toString().indexOf("%")!==-1?width:null;maxWidth=_$window.width()-wrap[0].offsetWidth+main[0].offsetWidth;scaleWidth=that._toNumber(width,maxWidth);width=scaleWidth;if(typeof width==="number"){wrapStyle.width="auto";style.width=Math.max(that.config.minWidth,width)+"px";wrapStyle.width=wrap[0].offsetWidth+"px";}else{if(typeof width==="string"){style.width=width;width==="auto"&&wrap.css("width","auto");}}}if(height){that._height=height.toString().indexOf("%")!==-1?height:null;maxHeight=_$window.height()-wrap[0].offsetHeight+main[0].offsetHeight;scaleHeight=that._toNumber(height,maxHeight);height=scaleHeight;if(typeof height==="number"){style.height=Math.max(that.config.minHeight,height)+"px";}else{if(typeof height==="string"){style.height=height;}}}that._ie6SelectFix();return that;},follow:function(elem){var $elem,that=this,config=that.config;if(typeof elem==="string"||elem&&elem.nodeType===1){$elem=$(elem);elem=$elem[0];}if(!elem||!elem.offsetWidth&&!elem.offsetHeight){return that.position(that._left,that._top);}var expando=_expando+"follow",winWidth=_$window.width(),winHeight=_$window.height(),docLeft=_$document.scrollLeft(),docTop=_$document.scrollTop(),offset=$elem.offset(),width=elem.offsetWidth,height=elem.offsetHeight,isFixed=_isIE6?false:config.fixed,left=isFixed?offset.left-docLeft:offset.left,top=isFixed?offset.top-docTop:offset.top,wrap=that.DOM.wrap[0],style=wrap.style,wrapWidth=wrap.offsetWidth,wrapHeight=wrap.offsetHeight,setLeft=left-(wrapWidth-width)/2,setTop=top+height,dl=isFixed?0:docLeft,dt=isFixed?0:docTop;setLeft=setLeft<dl?left:(setLeft+wrapWidth>winWidth)&&(left-wrapWidth>dl)?left-wrapWidth+width:setLeft;setTop=(setTop+wrapHeight>winHeight+dt)&&(top-wrapHeight>dt)?top-wrapHeight:setTop;style.left=setLeft+"px";style.top=setTop+"px";that._follow&&that._follow.removeAttribute(expando);that._follow=elem;elem[expando]=config.id;that._autoPositionType();return that;},button:function(){var that=this,ags=arguments,DOM=that.DOM,buttons=DOM.buttons,elem=buttons[0],strongButton="aui_state_highlight",listeners=that._listeners=that._listeners||{},list=$.isArray(ags[0])?ags[0]:[].slice.call(ags);if(ags[0]===undefined){return elem;}$.each(list,function(i,val){var name=val.name,isNewButton=!listeners[name],button=!isNewButton?listeners[name].elem:document.createElement("button");if(!listeners[name]){listeners[name]={};}if(val.callback){listeners[name].callback=val.callback;}if(val.className){button.className=val.className;}if(val.focus){that._focus&&that._focus.removeClass(strongButton);that._focus=$(button).addClass(strongButton);that.focus();}button.setAttribute("type","button");button[_expando+"callback"]=name;button.disabled=!!val.disabled;if(isNewButton){button.innerHTML=name;listeners[name].elem=button;elem.appendChild(button);}});buttons[0].style.display=list.length?"":"none";that._ie6SelectFix();return that;},show:function(){this.DOM.wrap.show();!arguments[0]&&this._lockMaskWrap&&this._lockMaskWrap.show();return this;},hide:function(){this.DOM.wrap.hide();!arguments[0]&&this._lockMaskWrap&&this._lockMaskWrap.hide();return this;},close:function(){if(this.closed){return this;}var that=this,DOM=that.DOM,wrap=DOM.wrap,list=artDialog.list,fn=that.config.close,follow=that.config.follow;that.time();if(typeof fn==="function"&&fn.call(that,window)===false){return that;}that.unlock();that._elemBack&&that._elemBack();wrap[0].className=wrap[0].style.cssText="";DOM.title.html("");DOM.content.html("");DOM.buttons.html("");if(artDialog.focus===that){artDialog.focus=null;}if(follow){follow.removeAttribute(_expando+"follow");}delete list[that.config.id];that._removeEvent();that.hide(true)._setAbsolute();for(var i in that){if(that.hasOwnProperty(i)&&i!=="DOM"){delete that[i];}}_box?wrap.remove():_box=that;return that;},time:function(second){var that=this,cancel=that.config.cancelVal,timer=that._timer;timer&&clearTimeout(timer);if(second){that._timer=setTimeout(function(){that._click(cancel);},1000*second);}return that;},focus:function(){try{if(this.config.focus){var elem=this._focus&&this._focus[0]||this.DOM.close[0];elem&&elem.focus();}}catch(e){}return this;},zIndex:function(){var that=this,DOM=that.DOM,wrap=DOM.wrap,top=artDialog.focus,index=artDialog.defaults.zIndex++;wrap.css("zIndex",index);that._lockMask&&that._lockMask.css("zIndex",index-1);top&&top.DOM.wrap.removeClass("aui_state_focus");artDialog.focus=that;wrap.addClass("aui_state_focus");return that;},lock:function(){if(this._lock){return this;}var that=this,index=artDialog.defaults.zIndex-1,wrap=that.DOM.wrap,config=that.config,docWidth=_$document.width(),docHeight=_$document.height(),lockMaskWrap=that._lockMaskWrap||$(document.body.appendChild(document.createElement("div"))),lockMask=that._lockMask||$(lockMaskWrap[0].appendChild(document.createElement("div"))),domTxt="(document).documentElement",sizeCss=_isMobile?"width:"+docWidth+"px;height:"+docHeight+"px":"width:100%;height:100%",ie6Css=_isIE6?"position:absolute;left:expression("+domTxt+".scrollLeft);top:expression("+domTxt+".scrollTop);width:expression("+domTxt+".clientWidth);height:expression("+domTxt+".clientHeight)":"";that.zIndex();wrap.addClass("aui_state_lock");lockMaskWrap[0].style.cssText=sizeCss+";position:fixed;z-index:"+index+";top:0;left:0;overflow:hidden;"+ie6Css;lockMask[0].style.cssText="height:100%;background:"+config.background+";filter:alpha(opacity=0);opacity:0";if(_isIE6){lockMask.html('<iframe src="about:blank" style="width:100%;height:100%;position:absolute;'+'top:0;left:0;z-index:-1;filter:alpha(opacity=0)"></iframe>');}lockMask.stop();lockMask.bind("click",function(){that._reset();}).bind("dblclick",function(){that._reset();});if(config.duration===0){lockMask.css({opacity:config.opacity});}else{lockMask.animate({opacity:config.opacity},config.duration);}that._lockMaskWrap=lockMaskWrap;that._lockMask=lockMask;that._lock=true;return that;},unlock:function(){var that=this,lockMaskWrap=that._lockMaskWrap,lockMask=that._lockMask;if(!that._lock){return that;}var style=lockMaskWrap[0].style;var un=function(){if(_isIE6){style.removeExpression("width");style.removeExpression("height");style.removeExpression("left");style.removeExpression("top");}style.cssText="display:none";_box&&lockMaskWrap.remove();};lockMask.stop().unbind();that.DOM.wrap.removeClass("aui_state_lock");if(!that.config.duration){un();}else{lockMask.animate({opacity:0},that.config.duration,un);}that._lock=false;return that;},_getDOM:function(){var wrap=document.createElement("div"),body=document.body;wrap.style.cssText="position:absolute;left:0;top:0";wrap.innerHTML=artDialog._templates;body.insertBefore(wrap,body.firstChild);var name,i=0,DOM={wrap:$(wrap)},els=wrap.getElementsByTagName("*"),elsLen=els.length;for(;i<elsLen;i++){name=els[i].className.split("aui_")[1];if(name){DOM[name]=$(els[i]);}}return DOM;},_toNumber:function(thisValue,maxValue){if(!thisValue&&thisValue!==0||typeof thisValue==="number"){return thisValue;}var last=thisValue.length-1;if(thisValue.lastIndexOf("px")===last){thisValue=parseInt(thisValue);}else{if(thisValue.lastIndexOf("%")===last){thisValue=parseInt(maxValue*thisValue.split("%")[0]/100);}}return thisValue;},_ie6PngFix:_isIE6?function(){var i=0,elem,png,pngPath,runtimeStyle,path=artDialog.defaults.path+"/skins/",list=this.DOM.wrap[0].getElementsByTagName("*");for(;i<list.length;i++){elem=list[i];png=elem.currentStyle["png"];if(png){pngPath=path+png;runtimeStyle=elem.runtimeStyle;runtimeStyle.backgroundImage="none";runtimeStyle.filter="progid:DXImageTransform.Microsoft."+"AlphaImageLoader(src='"+pngPath+"',sizingMethod='crop')";}}}:$.noop,_ie6SelectFix:_isIE6?function(){var $wrap=this.DOM.wrap,wrap=$wrap[0],expando=_expando+"iframeMask",iframe=$wrap[expando],width=wrap.offsetWidth,height=wrap.offsetHeight;width=width+"px";height=height+"px";if(iframe){iframe.style.width=width;iframe.style.height=height;}else{iframe=wrap.appendChild(document.createElement("iframe"));$wrap[expando]=iframe;iframe.src="about:blank";iframe.style.cssText="position:absolute;z-index:-1;left:0;top:0;"+"filter:alpha(opacity=0);width:"+width+";height:"+height;}}:$.noop,_runScript:function(elem){var fun,i=0,n=0,tags=elem.getElementsByTagName("script"),length=tags.length,script=[];for(;i<length;i++){if(tags[i].type==="text/dialog"){script[n]=tags[i].innerHTML;n++;}}if(script.length){script=script.join("");fun=new Function(script);fun.call(this);}},_autoPositionType:function(){this[this.config.fixed?"_setFixed":"_setAbsolute"]();},_setFixed:(function(){_isIE6&&$(function(){var bg="backgroundAttachment";if(_$html.css(bg)!=="fixed"&&$("body").css(bg)!=="fixed"){_$html.css({zoom:1,backgroundImage:"url(about:blank)",backgroundAttachment:"fixed"});}});return function(){var $elem=this.DOM.wrap,style=$elem[0].style;if(_isIE6){var left=parseInt($elem.css("left")),top=parseInt($elem.css("top")),sLeft=_$document.scrollLeft(),sTop=_$document.scrollTop(),txt="(document.documentElement)";this._setAbsolute();style.setExpression("left","eval("+txt+".scrollLeft + "+(left-sLeft)+') + "px"');style.setExpression("top","eval("+txt+".scrollTop + "+(top-sTop)+') + "px"');}else{style.position="fixed";}};}()),_setAbsolute:function(){var style=this.DOM.wrap[0].style;if(_isIE6){style.removeExpression("left");style.removeExpression("top");}style.position="absolute";},_click:function(name){var that=this,fn=that._listeners[name]&&that._listeners[name].callback;return typeof fn!=="function"||fn.call(that,window)!==false?that.close():that;},_reset:function(test){var newSize,that=this,oldSize=that._winSize||_$window.width()*_$window.height(),elem=that._follow,width=that._width,height=that._height,left=that._left,top=that._top;if(test){newSize=that._winSize=_$window.width()*_$window.height();if(oldSize===newSize){return;}}if(width||height){that.size(width,height);}if(elem){that.follow(elem);}else{if(left||top){that.position(left,top);}}},_addEvent:function(){var resizeTimer,that=this,config=that.config,isIE="CollectGarbage" in window,DOM=that.DOM;that._winResize=function(){resizeTimer&&clearTimeout(resizeTimer);resizeTimer=setTimeout(function(){that._reset(isIE);},40);};_$window.bind("resize",that._winResize);DOM.wrap.bind("click",function(event){var target=event.target,callbackID;if(target.disabled){return false;}if(target===DOM.close[0]){that._click(config.cancelVal);return false;}else{callbackID=target[_expando+"callback"];callbackID&&that._click(callbackID);}that._ie6SelectFix();}).bind("mousedown",function(){that.zIndex();});},_removeEvent:function(){var that=this,DOM=that.DOM;DOM.wrap.unbind();_$window.unbind("resize",that._winResize);}};artDialog.fn._init.prototype=artDialog.fn;$.fn.dialog=$.fn.artDialog=function(){var config=arguments;this[this.live?"live":"bind"]("click",function(){artDialog.apply(this,config);return false;});return this;};artDialog.focus=null;artDialog.get=function(id){return id===undefined?artDialog.list:artDialog.list[id];};artDialog.list={};_$document.bind("keydown",function(event){var target=event.target,nodeName=target.nodeName,rinput=/^INPUT|TEXTAREA$/,api=artDialog.focus,keyCode=event.keyCode;if(!api||!api.config.esc||rinput.test(nodeName)){return;}keyCode===27&&api._click(api.config.cancelVal);});_path=window["_artDialog_path"]||(function(script,i,me){for(i in script){if(script[i].src&&script[i].src.indexOf("artDialog")!==-1){me=script[i];}}_thisScript=me||script[script.length-1];me=_thisScript.src.replace(/\\/g,"/");return me.lastIndexOf("/")<0?".":me.substring(0,me.lastIndexOf("/"));}(document.getElementsByTagName("script")));_skin=_thisScript.src.split("skin=")[1];if(_skin){var link=document.createElement("link");link.rel="stylesheet";link.href=_path+"/skins/"+_skin+".css?"+artDialog.fn.version;_thisScript.parentNode.insertBefore(link,_thisScript);}_$window.bind("load",function(){setTimeout(function(){if(_count){return;}artDialog({left:"-9999em",time:9,fixed:false,lock:false,focus:false});},150);});try{document.execCommand("BackgroundImageCache",false,true);}catch(e){}artDialog._templates='<div class="aui_outer">'+'<table class="aui_border">'+"<tbody>"+"<tr>"+'<td class="aui_nw"></td>'+'<td class="aui_n"></td>'+'<td class="aui_ne"></td>'+"</tr>"+"<tr>"+'<td class="aui_w"></td>'+'<td class="aui_c">'+'<div class="aui_inner">'+'<table class="aui_dialog">'+"<tbody>"+"<tr>"+'<td colspan="2" class="aui_header">'+'<div class="aui_titleBar">'+'<div class="aui_title"></div>'+'<a class="aui_close" href="javascript:/*artDialog*/;">'+"\xd7"+"</a>"+"</div>"+"</td>"+"</tr>"+"<tr>"+'<td class="aui_icon">'+'<div class="aui_iconBg"></div>'+"</td>"+'<td class="aui_main">'+'<div class="aui_content"></div>'+"</td>"+"</tr>"+"<tr>"+'<td colspan="2" class="aui_footer">'+'<div class="aui_buttons"></div>'+"</td>"+"</tr>"+"</tbody>"+"</table>"+"</div>"+"</td>"+'<td class="aui_e"></td>'+"</tr>"+"<tr>"+'<td class="aui_sw"></td>'+'<td class="aui_s"></td>'+'<td class="aui_se"></td>'+"</tr>"+"</tbody>"+"</table>"+"</div>";artDialog.defaults={content:'<div class="aui_loading"><span>loading..</span></div>',title:"\u6d88\u606f",button:null,ok:null,cancel:null,init:null,close:null,okVal:"\u786E\u5B9A",cancelVal:"\u53D6\u6D88",width:"auto",height:"auto",minWidth:96,minHeight:32,padding:"20px 25px",skin:"",icon:null,time:null,esc:true,focus:true,show:true,follow:null,path:_path,lock:false,background:"#000",opacity:0.7,duration:300,fixed:false,left:"50%",top:"38.2%",zIndex:1987,resize:true,drag:true};window.artDialog=$.dialog=$.artDialog=artDialog;}(this.art||this.jQuery&&(this.art=jQuery),this));(function($){var _dragEvent,_use,_$window=$(window),_$document=$(document),_elem=document.documentElement,_isIE6=!("minWidth" in _elem.style),_isLosecapture="onlosecapture" in _elem,_isSetCapture="setCapture" in _elem;artDialog.dragEvent=function(){var that=this,proxy=function(name){var fn=that[name];that[name]=function(){return fn.apply(that,arguments);};};proxy("start");proxy("move");proxy("end");};artDialog.dragEvent.prototype={onstart:$.noop,start:function(event){_$document.bind("mousemove",this.move).bind("mouseup",this.end);this._sClientX=event.clientX;this._sClientY=event.clientY;this.onstart(event.clientX,event.clientY);return false;},onmove:$.noop,move:function(event){this._mClientX=event.clientX;this._mClientY=event.clientY;this.onmove(event.clientX-this._sClientX,event.clientY-this._sClientY);return false;},onend:$.noop,end:function(event){_$document.unbind("mousemove",this.move).unbind("mouseup",this.end);this.onend(event.clientX,event.clientY);return false;}};_use=function(event){var limit,startWidth,startHeight,startLeft,startTop,isResize,api=artDialog.focus,DOM=api.DOM,wrap=DOM.wrap,title=DOM.title,main=DOM.main;var clsSelect="getSelection" in window?function(){window.getSelection().removeAllRanges();}:function(){try{document.selection.empty();}catch(e){}};_dragEvent.onstart=function(x,y){if(isResize){startWidth=main[0].offsetWidth;startHeight=main[0].offsetHeight;}else{startLeft=wrap[0].offsetLeft;startTop=wrap[0].offsetTop;}_$document.bind("dblclick",_dragEvent.end);!_isIE6&&_isLosecapture?title.bind("losecapture",_dragEvent.end):_$window.bind("blur",_dragEvent.end);_isSetCapture&&title[0].setCapture();wrap.addClass("aui_state_drag");api.focus();};_dragEvent.onmove=function(x,y){if(isResize){var wrapStyle=wrap[0].style,style=main[0].style,width=x+startWidth,height=y+startHeight;wrapStyle.width="auto";style.width=Math.max(0,width)+"px";wrapStyle.width=wrap[0].offsetWidth+"px";style.height=Math.max(0,height)+"px";}else{var style=wrap[0].style,left=Math.max(limit.minX,Math.min(limit.maxX,x+startLeft)),top=Math.max(limit.minY,Math.min(limit.maxY,y+startTop));style.left=left+"px";style.top=top+"px";}clsSelect();api._ie6SelectFix();};_dragEvent.onend=function(x,y){_$document.unbind("dblclick",_dragEvent.end);!_isIE6&&_isLosecapture?title.unbind("losecapture",_dragEvent.end):_$window.unbind("blur",_dragEvent.end);_isSetCapture&&title[0].releaseCapture();_isIE6&&!api.closed&&api._autoPositionType();wrap.removeClass("aui_state_drag");};isResize=event.target===DOM.se[0]?true:false;limit=(function(){var maxX,maxY,wrap=api.DOM.wrap[0],fixed=wrap.style.position==="fixed",ow=wrap.offsetWidth,oh=wrap.offsetHeight,ww=_$window.width(),wh=_$window.height(),dl=fixed?0:_$document.scrollLeft(),dt=fixed?0:_$document.scrollTop(),maxX=ww-ow+dl;maxY=wh-oh+dt;return{minX:dl,minY:dt,maxX:maxX,maxY:maxY};})();_dragEvent.start(event);};_$document.bind("mousedown",function(event){var api=artDialog.focus;if(!api){return;}var target=event.target,config=api.config,DOM=api.DOM;if(config.drag!==false&&target===DOM.title[0]||config.resize!==false&&target===DOM.se[0]){_dragEvent=_dragEvent||new artDialog.dragEvent();_use(event);return false;}});})(this.art||this.jQuery&&(this.art=jQuery));


/*!
 * artDialog iframeTools
 * Date: 2011-11-25 13:54
 * http://code.google.com/p/artdialog/
 * (c) 2009-2011 TangBin, http://www.planeArt.cn
 *
 * This is licensed under the GNU LGPL, version 2.1 or later.
 * For details, see: http://creativecommons.org/licenses/LGPL/2.1/
 */
;(function($,window,artDialog,undefined){var _topDialog,_proxyDialog,_zIndex,_data="@ARTDIALOG.DATA",_open="@ARTDIALOG.OPEN",_opener="@ARTDIALOG.OPENER",_winName=window.name=window.name||"@ARTDIALOG.WINNAME"+ +new Date,_isIE6=window.VBArray&&!window.XMLHttpRequest;$(function(){!window.jQuery&&document.compatMode==="BackCompat"&&alert('artDialog Error: document.compatMode === "BackCompat"');});var _top=artDialog.top=function(){var top=window,test=function(name){try{var doc=window[name].document;doc.getElementsByTagName;}catch(e){return false;}return window[name].artDialog&&doc.getElementsByTagName("frameset").length===0;};if(test("top")){top=window.top;}else{if(test("parent")){top=window.parent;}}return top;}();artDialog.parent=_top;_topDialog=_top.artDialog;_zIndex=function(){return _topDialog.defaults.zIndex;};artDialog.data=function(name,value){var top=artDialog.top,cache=top[_data]||{};top[_data]=cache;if(value!==undefined){cache[name]=value;}else{return cache[name];}return cache;};artDialog.removeData=function(name){var cache=artDialog.top[_data];if(cache&&cache[name]){delete cache[name];}};artDialog.through=_proxyDialog=function(){var api=_topDialog.apply(this,arguments);if(_top!==window){artDialog.list[api.config.id]=api;}return api;};_top!==window&&$(window).bind("unload",function(){var list=artDialog.list,config;for(var i in list){if(list[i]){config=list[i].config;if(config){config.duration=0;}list[i].close();}}});artDialog.open=function(url,options,cache){options=options||{};var api,DOM,$content,$main,iframe,$iframe,$idoc,iwin,ibody,top=artDialog.top,initCss="position:absolute;left:-9999em;top:-9999em;border:none 0;background:transparent",loadCss="width:100%;height:100%;border:none 0";if(cache===false){var ts=+new Date,ret=url.replace(/([?&])_=[^&]*/,"$1_="+ts);url=ret+((ret===url)?(/\?/.test(url)?"&":"?")+"_="+ts:"");}var load=function(){var iWidth,iHeight,loading=DOM.content.find(".aui_loading"),aConfig=api.config;$content.addClass("aui_state_full");loading&&loading.hide();try{iwin=iframe.contentWindow;$idoc=$(iwin.document);ibody=iwin.document.body;}catch(e){iframe.style.cssText=loadCss;aConfig.follow?api.follow(aConfig.follow):api.position(aConfig.left,aConfig.top);options.init&&options.init.call(api,iwin,top);options.init=null;return;}iWidth=aConfig.width==="auto"?$idoc.width()+(_isIE6?0:parseInt($(ibody).css("marginLeft"))):aConfig.width;iHeight=aConfig.height==="auto"?$idoc.height():aConfig.height;setTimeout(function(){iframe.style.cssText=loadCss;},0);api.size(iWidth,iHeight);aConfig.follow?api.follow(aConfig.follow):api.position(aConfig.left,aConfig.top);options.init&&options.init.call(api,iwin,top);options.init=null;};var config={zIndex:_zIndex(),init:function(){api=this;DOM=api.DOM;$main=DOM.main;$content=DOM.content;iframe=api.iframe=top.document.createElement("iframe");iframe.src=url;iframe.name="Open"+api.config.id;iframe.style.cssText=initCss;iframe.setAttribute("frameborder",0,0);iframe.setAttribute("allowTransparency",true);$iframe=$(iframe);api.content().appendChild(iframe);iwin=iframe.contentWindow;try{iwin.name=iframe.name;artDialog.data(iframe.name+_open,api);artDialog.data(iframe.name+_opener,window);}catch(e){}$iframe.bind("load",load);},close:function(){$iframe.css("display","none").unbind("load",load);if(options.close&&options.close.call(this,iframe.contentWindow,top)===false){return false;}$content.removeClass("aui_state_full");$iframe[0].src="about:blank";$iframe.remove();try{artDialog.removeData(iframe.name+_open);artDialog.removeData(iframe.name+_opener);}catch(e){}}};if(typeof options.ok==="function"){config.ok=function(){return options.ok.call(api,iframe.contentWindow,top);};}if(typeof options.cancel==="function"){config.cancel=function(){return options.cancel.call(api,iframe.contentWindow,top);};}delete options.content;for(var i in options){if(config[i]===undefined){config[i]=options[i];}}return _proxyDialog(config);};artDialog.open.api=artDialog.data(_winName+_open);artDialog.opener=artDialog.data(_winName+_opener)||window;artDialog.open.origin=artDialog.opener;artDialog.close=function(){var api=artDialog.data(_winName+_open);api&&api.close();return false;};_top!=window&&$(document).bind("mousedown",function(){var api=artDialog.open.api;api&&api.zIndex();});artDialog.load=function(url,options,cache){cache=cache||false;var opt=options||{};var config={zIndex:_zIndex(),init:function(here){var api=this,aConfig=api.config;$.ajax({url:url,success:function(content){api.content(content);opt.init&&opt.init.call(api,here);},cache:cache});}};delete options.content;for(var i in opt){if(config[i]===undefined){config[i]=opt[i];}}return _proxyDialog(config);};artDialog.alert=function(content,callback,iconid){if(!iconid||iconid=="undefined"){iconid="warning";}return _proxyDialog({id:"Alert",zIndex:_zIndex(),icon:iconid,fixed:true,lock:true,content:content,ok:true,close:callback});};artDialog.confirm=function(content,yes,no){return _proxyDialog({id:"Confirm",zIndex:_zIndex(),icon:"question",fixed:true,lock:true,opacity:0.1,content:content,ok:function(here){return yes.call(this,here);},cancel:function(here){return no&&no.call(this,here);}});};artDialog.prompt=function(content,yes,value){value=value||"";var input;return _proxyDialog({id:"Prompt",zIndex:_zIndex(),icon:"question",fixed:true,lock:true,opacity:0.1,content:['<div style="margin-bottom:5px;font-size:12px">',content,"</div>","<div>",'<input value="',value,'" style="width:18em;padding:6px 4px" />',"</div>"].join(""),init:function(){input=this.DOM.content.find("input")[0];input.select();input.focus();},ok:function(here){return yes&&yes.call(this,input.value,here);},cancel:true});};artDialog.tips=function(content,time){return _proxyDialog({id:"Tips",zIndex:_zIndex(),title:false,cancel:false,fixed:true,lock:false}).content('<div style="padding: 0 1em;">'+content+"</div>").time(time||1.5);};$(function(){var event=artDialog.dragEvent;if(!event){return;}var $window=$(window),$document=$(document),positionType=_isIE6?"absolute":"fixed",dragEvent=event.prototype,mask=document.createElement("div"),style=mask.style;style.cssText="display:none;position:"+positionType+";left:0;top:0;width:100%;height:100%;"+"cursor:move;filter:alpha(opacity=0);opacity:0;background:#FFF";document.body.appendChild(mask);dragEvent._start=dragEvent.start;dragEvent._end=dragEvent.end;dragEvent.start=function(){var DOM=artDialog.focus.DOM,main=DOM.main[0],iframe=DOM.content[0].getElementsByTagName("iframe")[0];dragEvent._start.apply(this,arguments);style.display="block";style.zIndex=artDialog.defaults.zIndex+3;if(positionType==="absolute"){style.width=$window.width()+"px";style.height=$window.height()+"px";style.left=$document.scrollLeft()+"px";style.top=$document.scrollTop()+"px";}if(iframe&&main.offsetWidth*main.offsetHeight>307200){main.style.visibility="hidden";}};dragEvent.end=function(){var dialog=artDialog.focus;dragEvent._end.apply(this,arguments);style.display="none";if(dialog){dialog.DOM.main[0].style.visibility="visible";}};});})(this.art||this.jQuery,this,this.artDialog);artDialog.notice=function(options){var opt=options||{},api,aConfig,hide,wrap,top,duration=800;var config={id:"Notice",left:"100%",top:"100%",fixed:true,drag:false,resize:false,follow:null,lock:false,init:function(here){api=this;aConfig=api.config;wrap=api.DOM.wrap;top=parseInt(wrap[0].style.top);hide=top+wrap[0].offsetHeight;wrap.css("top",hide+"px").animate({top:top+"px"},duration,function(){opt.init&&opt.init.call(api,here);});},close:function(here){wrap.animate({top:hide+"px"},duration,function(){opt.close&&opt.close.call(this,here);aConfig.close=$.noop;api.close();});return false;}};for(var i in opt){if(config[i]===undefined){config[i]=opt[i];}}return artDialog(config);};

/**************************************************************************************************
	文件： js/jquery.global.js
	说明： PHPOK编写并整理的通用组件，包含常用的Ajax，弹出窗，桌面组件
	版本： 4.0
	网站： www.phpok.com
	作者： qinggan <qinggan@188.com>
	日期： 2014年7月11日
***************************************************************************************************/
;(function($){
	$.desktop = {
		init:function(opts){
			var defaults = {
				'win_min'		:true,
				'win_max'		:true,
				'win_close'		:true,
				'title'			:'',
				'iframe'		:'', // 定义iframe地址
				'content'		:'', // 定义内容信息，当内容为iframe时，调用iframe对应的url
				'lock'			:false,
				'bgcolor'		:'#fff',
				'position'		:'center center', //支持数字及常用单词center
				'taskbar'		:false,
				'width'			:'auto',
				'height'		:'auto',
				'prefix'		:'phpok-',
				'exheight'		:0,
				'exwidth'		:0,
				'func_close'	:false,
				'is_max'		:false, //是否直接全屏
				'move'			:true, //允许移动
				'z_index'		:1000 //弹出层的默认层级
			};
			this.opt = $.extend({},defaults, opts);
			this.ie6 = ($.browser.msie && $.browser.version < 7) ? true : false;
			this.prefix = this.opt.prefix ? this.opt.prefix : 'phpok-';
		},
		_id:function(id)
		{
			if(!id || id == 'undefined')
			{
				var str = (Math.random()).toString();
				str = str.replace(".","");
				if(!this.prefix || this.prefix == 'undefined')
				{
					this.prefix = 'phpok-';
				}
				id = this.prefix + (str).toString();
			}
			this.id = id;
		},
		win_id: function(id)
		{
			this._id(id);
			return this.id;
		},
		win: function(opts){
			this.opt = $.extend({},this.opt, opts);
			if(!this.id || this.id == 'undefined')
			{
				this._id();
			}
			//创建弹窗HTML
			this._style();
			this._content();
			this._pop();
			//编写taskbar
			this._taskbar();
			this._action();
		},
		//重新计算宽高
		height: function(height){
			var obj = this._win();
			console.log('计算高度');
			if(height == 'auto' || !height || height == 'undefined' || parseInt(height,10) > obj.height)
			{
				height = obj.height * 0.7;
			}
			if((new RegExp('%')).test(height))
			{
				height = parseInt((obj.height * parseInt(height,10))/100,10);
			}
			console.log(height);
			return height;
		},
		//计算窗口的宽度
		width: function(width){
			var obj = this._win();
			if(width == 'auto' || !width || width == 'undefined' || parseInt(width,10) > obj.width)
			{
				width = obj.width * 0.8;
			}
			if((new RegExp('%')).test(width))
			{
				width = parseInt((obj.width * parseInt(width,10))/100,10);
			}
			return width;
		},
		title: function(title,id){
			if(!title || title == 'undefined')
			{
				return false;
			}
			if(!id || id == 'undefined')
			{
				var zindex = new Array();
				var idlist = new Array();
				var tmpi = 0;
				$("ul#"+this.prefix+"taskbar li").each(function(i){
					id = ($(this).attr('id')).substr(8);
					var ishidden = $("#"+id).is(":hidden");
					if(!ishidden)
					{
						zindex[tmpi] = $("#"+id).css('z-index');
						idlist[tmpi] = id;
						tmpi++;
					}
					$(this).removeClass('on');
				});
				//当
				if(zindex.length>0 && idlist.length>0)
				{
					zmax = Math.max.apply(null,zindex);
					var t = 0;
					for(var i in zindex)
					{
						if(zindex[i] == zmax)
						{
							t = i;
						}
					}
					id = idlist[t];
				}
			}
			if(!id || id == 'undefined')
			{
				return false;
			}
			$("#title-"+id+",#taskbar-"+id).html(title);
		},
		_win:function(){
			var obj = {};
			/*obj.width = $(window).width() - parseInt(this.opt.exwidth,10);
			obj.height = $(window).height() - parseInt(this.opt.exheight,10);*/
			
			obj.width = $(window).width();
			obj.height = $(window).height();
			console.log('change!----------'+obj.height);
			
			return obj;
		},
		_doc: function(){
			var obj = {};
			/*obj.width = $(document).width() - parseInt(this.opt.exwidth,10);
			obj.height = $(document).height() - parseInt(this.opt.exheight,10);*/
			obj.width = $(document).width();
			obj.height = $(document).height();
			console.log('change!----------'+obj.height);
			return obj;
		},
		tohome:function(){
			$(".phpok-win").hide();
			$(".phpok-win-lock").hide();
			this._taskbar_on();
		},
		//取得指定ID的z-index值
		zindex:function(id){
			if(!id || id == 'undefined')
			{
				id = this.id;
			}
			var list = new Array();
			var total = $(".phpok-win").length;
			var zIndex = this.opt.z_index;
			if(total > 0)
			{
				$(".phpok-win").each(function(i){
					list[i] = $(this).css("z-index");
				});
				zIndex = Math.max.apply(null,list);
			}
			zIndex++;
			$("#"+id+"-lock").css("z-index",zIndex);
			$("#"+id).css("z-index",(zIndex+1));
			this._taskbar_on();
			return zIndex;
		},
		//触发当前高亮的taskbar
		_taskbar_on: function(){
			var id;
			var zindex = new Array();
			var idlist = new Array();
			var tmpi = 0;
			$("ul#"+this.prefix+"taskbar li").each(function(i){
				id = ($(this).attr('id')).substr(8);
				var ishidden = $("#"+id).is(":hidden");
				if(!ishidden)
				{
					zindex[tmpi] = $("#"+id).css('z-index');
					idlist[tmpi] = id;
					tmpi++;
				}
				$(this).removeClass('on');
			});
			//当
			if(zindex.length>0 && idlist.length>0)
			{
				zmax = Math.max.apply(null,zindex);
				var t = 0;
				for(var i in zindex)
				{
					if(zindex[i] == zmax)
					{
						t = i;
					}
				}
				id = idlist[t];
				$("#taskbar-"+id).addClass('on');
			}
		},
		//取得当前窗口中的最大值
		max_zindex: function(){
			var list = new Array();
			var total = $(".phpok-win").length;
			var zIndex = this.opt.z_index;
			if(total > 0)
			{
				$(".phpok-win").each(function(i){
					list[i] = $(this).css("z-index");
				});
				zIndex = Math.max.apply(null,list);
			}
			return zIndex;
		},
		close: function(id){
			if(!id || id == 'undefined')
			{
				//获取ID
				var obj = $("div.phpok-win").length > 0 ? $("div.phpok-win") : parent.$("div.phpok-win");
				var zlist = new Array();
				var is_each = false;
				obj.each(function(i){
					zlist[i] = {'zindex':$(this).css('z-index'),'id':$(this).attr('id')};
				});
				if(zlist.length>0)
				{
					var zmax = 0;
					for(var i in zlist)
					{
						if(parseInt(zlist[i]['zindex'],10) > parseInt(zmax,10))
						{
							zmax = parseInt(zlist[i]['zindex'],10);
							id = zlist[i]['id'];
						}
					}
				}
				else
				{
					id = this.id;
				}
				if(id && id != 'undefined')
				{
					return obj.find("li#close-"+id).click();
				}
			}
			var arg = this._arg(id);
			if($("#"+id).length > 0)
			{
				$("#"+id).remove();
				$("#"+id+"-lock").remove();
				$("#taskbar-"+id).remove();
				this._taskbar_on();
			}
			else
			{
				parent.$("div#"+id).remove();
				parent.$("iframe#"+id+"-lock").remove();
				parent.$("li#taskbar-"+id).remove();
			}
		},
		max: function(id){
			if(!id || id == 'undefined')
			{
				id = this.id;
			}
			var arg = this._arg(id);
			//判断当前窗口是否是最大值
			var w = $("#"+id).width();
			var is_max = w <= arg.width ? false : true;
			if(is_max)
			{
				console.log('判断是否窗口最大化');
				/*//取消最大化
				$("#"+id).css({
					'width':arg.width+"px",
					'height':arg.height+'px',
					'left':arg.left+"px",
					'top':arg.top+'px'
				});
				$("#"+id+"-body").css({
					"width":parseInt((arg.width-12),10)+"px",
					'height':parseInt((arg.height-38),10)+"px"
				});
				if(arg.lock != 1)
				{
					$("#"+id+"-lock").css({
						'width':arg.width+"px",
						'height':arg.height+'px',
						'left':arg.left+"px",
						'top':arg.top+'px'
					});
				}
				$("#max-"+id).removeClass('max').addClass('max-max');*/
			}
			else
			{
				/*var win_height = $(window).height() - arg.exheight;
				if(arg.win_height>win_height)
				{
					arg.win_height = win_height;
				}
				$("#"+id).css({
					'width':arg.win_width+"px",
					'height':arg.win_height+'px',
					'left':arg.exwidth+"px",
					'top':arg.exheight+"px"
				});
				$("#"+id+"-body").css({
					"width":parseInt((arg.win_width-12),10)+"px",
					"height":parseInt((arg.win_height-38),10)+"px"
				});
				$("#max-"+id).removeClass('max-max').addClass('max');
				if(arg.lock != 1)
				{
					$("#"+id+"-lock").css({
						'width':arg.win_width+"px",
						'height':arg.win_height+'px',
						'left':arg.exwidth+"px",
						'top':arg.exheight+'px'
					});
				}*/
			}
			this._taskbar_on();
		},
		min: function(id){
			if(!id || id == 'undefined')
			{
				id = this.id;
			}
			$("#"+id+",#"+id+"-lock").hide();
			this._taskbar_on();
		},
		_arg: function(id){
			if(!id || id == 'undefined')
			{
				id = this.id;
			}
			var str = $("#"+id).attr('data');
			var arg = {};
			if(str)
			{
				t = str.split(';');
				for(var i in t)
				{
					var val = (t[i]).split(":");
					arg[val[0]] = val[1];
				}
			}
			return arg;
		},
		_style:function(){
			var width = (parseInt(this.width(this.opt.width),10)).toString();
			var height = (parseInt(this.height(this.opt.height),10)).toString();
			var win = this._win();
			var doc = this._doc();
			var zindex = this.zindex();
			
			//取得left，top位置坐标
			var position = this.opt.position ? (this.opt.position).toLowerCase() : 'center center';
			if(!position || position == 'center center' || position == 'center')
			{
				var left = parseInt((win.width - width)/2,10);
				var top = parseInt((win.height - height)/2,10);
			}
			else
			{
				var tlist = position.split(' ');
				var left = tlist[0] ? tlist[0] : 'center';
				var top = tlist[1] ? tlist[1] : 'center';
				if(left == 'center')
				{
					left = parseInt((win.width - width)/2,10);
				}
				if(top == 'center')
				{
					var top = parseInt((win.height - height)/2,10);
				}
			}
			this.style  = 'width:'+width+'px;';
			this.style += 'height:'+height+'px;';
			this.style += 'left:'+left+'px;';
			this.style += 'top:'+top+'px;';
			this.style += 'z-index:'+(zindex+1)+';';
			//锁屏样式
			this.lockstyle  = 'position:absolute;z-index:'+zindex+';';
			this.lockstyle += 'background:'+this.opt.bgcolor+';';
			if(this.opt.lock)
			{
				var tmpheight = doc.height > win.height ? doc.height : win.height;
				this.lockstyle += 'width:100%;';
				this.lockstyle += 'height:'+tmpheight+'px;';
				this.lockstyle += 'left:0;';
				this.lockstyle += 'top:0;';
			}
			else
			{
				this.lockstyle += 'width:'+width+'px;';
				this.lockstyle += 'height:'+height+'px;';
				this.lockstyle += 'left:'+left+'px;';
				this.lockstyle += 'top:'+top+'px;';
			}
			//内容高度样式
			this.bodystyle  = 'position:relative;';
			this.bodystyle += 'width:'+parseInt((width-12),10)+'px;';
			this.bodystyle += 'height:'+parseInt((height-38),10)+'px;';
			console.log('当前窗口的高度:'+this.bodystyle);
			console.log('窗口的高度:'+this.style);
			
			//记住当前窗口的宽高
			this.arg = 'width:'+width+";height:"+height+";win_width:"+win.width+";win_height:"+win.height;
			this.arg+= ";lock:"+(this.opt.lock ? '1' : '0');
			this.arg+= ";exheight:"+this.opt.exheight+";exwidth:"+this.opt.exwidth;
			this.arg+= ";left:"+left+";top:"+top;
			this.arg+= ";move:"+(this.opt.move ? '1' :'0');
			if(this.opt.taskbar)
			{
				this.arg+= ";taskbar:"+(this.opt.taskbar).toString();
			}
			
		},
		_save: function(arg,id)
		{
			var str = '';
			for(var i in arg)
			{
				str += i+":"+arg[i]+";";
			}
			var length = str.length;
			str = str.substr(0,length-1);
			$("#"+id).attr('data',str);
		},
		_content:function(){
			if((this.opt.content).substr(0,1) == '.' || (this.opt.content).substr(0,1) == '#')
			{
				//取得内容
				var div_content = $(this.opt.content).html();
				var content = '<div id="'+this.id+'-content" class="content">'+div_content+'</div>';
				//清空现有的标识内容
				$(this.opt.content).html('');
				//增加取消触发事件
				this.opt.func_cancel = function(){
					$(this.opt.content).html(div_content);
					$("#"+this.id+'-content').html('');
					return true;
				};
			}
			else if((this.opt.content == 'iframe' || !this.opt.content) && this.opt.iframe)
			{
				var url = this.opt.iframe;
				if(url.indexOf('_noCache') != -1)
				{
					url = url.replace(/\_noCache=[0-9\.]+/,'_noCache='+Math.random());
				}
				else
				{
					url += url.indexOf('?') != -1 ? '&' : '?';
					url += '_noCache='+Math.random();
				}
				var content = '<iframe src="'+url+'" border="0" frameborder="0" marginheight="0" marginwidth="0" class="content" style="overflow:hidden;height:100%;width:100%;background:#fff;" id="'+this.id+'-content"></iframe>';
			}
			else
			{
				var content = '<div id="'+this.id+'-content" class="content">'+this.opt.content+'</div>';
			}
			this.content = content;
		},
		_pop:function(){
			
			var html = '';
			html += '<iframe class="phpok-win-lock"  marginheight="0" marginwidth="0" frameborder="0" scrolling="no" id="'+this.id+'-lock" style="'+this.lockstyle+'"></iframe>';
			html += '<div class="phpok-win" id="'+this.id+'" style="'+this.style+'" data="'+this.arg+'" >';
			html += '<div class="window">';
			html += '	<div class="title">';
			html += '		<h3 class="h3"  id="title-'+this.id+'">'+this.opt.title+'</h3>';
			html += '		<div class="button">';
			html += '		<ul>';
			if(this.opt.win_min)
			{
				html += '		<li class="min" id="min-'+this.id+'"><a href="javascript:void(0);" class="ie6png"></a></li>';
			}
			if(this.opt.win_max)
			{
				html += '		<li class="max-max" id="max-'+this.id+'"><a href="javascript:void(0);" class="ie6png"></a></li>';
			}
			if(this.opt.win_close)
			{
				html += '		<li class="close" id="close-'+this.id+'"><a href="javascript:void(0);" class="ie6png"></a></li>';
			}
			html += '		</ul>';
			html += '		</div>';
			html += '	</div>';
			html += '	<div class="body" id="'+this.id+'-body" style="'+this.bodystyle+'">';
			html += 	this.content;
			html += '	</div>';
			html += '</div>';
			$(html).appendTo("body");
		},
		_taskbar:function(id){
			if(!id || id == 'undefined')
			{
				id = this.id;
			}
			var arg = this._arg(id);
			if(arg.taskbar == 'false')
			{
				return true;
			}
			var ul_id = this.prefix+'taskbar';
			var html = '<li id="taskbar-'+id+'">'+this.opt.title+'</li>';
			$(html).appendTo("#"+ul_id);
			return true;
		},
		_vlayer: function(id){
			if(!id)
			{
				return false;
			}
			var width = $("#"+id).width();
			var height = $("#"+id).height();
			var left = parseInt($("#"+id).css('left'),10);
			var top = parseInt($("#"+id).css('top'),10);
			var css = "width:"+width+"px;height:"+height+"px;left:"+left+"px;top:"+top+'px;position:absolute;';
			var zindex = $("#"+id).css("z-index");
			css += "z-index:"+parseInt(zindex+1)+";";
			//css += "background:#FFF;"
			var html = '<div class="phpok-win-vlayer" id="vlayer-'+id+'" style="'+css+'; top:77px;">&nbsp;</div>';
			$(html).appendTo('body');
		},
		//关闭移动时的触发
		_vlayer_close: function(id){
			var arg = this._arg(id);
			var top = parseInt($("#vlayer-"+id).css("top"),10);
			var left = parseInt($("#vlayer-"+id).css('left'),10);
			$("#"+id).css({'top':top+"px",'left':left+"px"});//控件新位置
			if(arg.lock != 1)
			{
				$("#"+id+"-lock").css({'top':top+"px",'left':left+"px"});//控件新位置
			}
			arg.left = left;
			arg.top = top;
			this._save(arg,id);
			$("#vlayer-"+id).remove();
			return true;
		},
		//绑定相应的动作
		_action:function(){
			var _x,_y;//鼠标离控件左上角的相对位置
			var _move = false;
			var self = this;
			var id = this.id;
			var arg = this._arg(id);
			//存在关闭窗口执行的触发
			if(this.opt.win_close)
			{
				$("#close-"+id).click(function(){
					if(self.opt.func_close)
					{
						(self.opt.func_close)();
					}
					self.close(id);
				});
			}
			//有最大化最小化按钮时
			if(this.opt.win_max)
			{
				$("#title-"+id).dblclick(function(){self.max(id);});
				$("#max-"+id).click(function(){self.max(id);});
				console.log('执行');
			}
			//有最小化时的按钮信息
			if(this.opt.win_min)
			{
				$("#min-"+id).click(function(){self.min(id);});
			}
			//如果有启用taskbar
			if(this.opt.taskbar)
			{
				$("#taskbar-"+id).click(function(){
					//判断是否最小化了
					var is_hidden = $("#"+id).is(":hidden");
					if(is_hidden)
					{
						$("#"+id).show();
						$("#"+id+"-lock").show();
						self.zindex(id);
					}
					else
					{
						var z_id = $("#"+id).css("z-index");
						var z_max = self.max_zindex();
						if(z_max != z_id)
						{
							self.zindex(id);
						}
						else
						{
							self.min(id);
						}
					}
					self._taskbar_on();
				});
			}
			//如果默认启用了is_max
			if(this.opt.is_max)
			{
				this.max(id);
			}
			//取消 上方拖动事件
			//移动
			
			/*$("#title-"+id).mousedown(function(e){
				e = e || window.event;
				var zindex = self.zindex(id);
				//创建一个虚拟的DIV层
				_x = e.pageX-parseInt($("#"+id).css("left"));
				_y = e.pageY-parseInt($("#"+id).css("top"));
				if(arg.move == 1)
				{
					_move = true;
					self._vlayer(id);
				}
				e.preventDefault && e.preventDefault();
			}).mouseup(function(e){
				e = e || window.event;
				_move = false;
				self._vlayer_close(id);
				e.preventDefault && e.preventDefault();
			});*/
			
			/*$(document).mousemove(function(e){
				e = e || window.event;
				if(!_move)
				{
					return false;
				}
				var x = e.pageX - _x;
				var y = e.pageY - _y;
				if(self.opt.taskbar == 'top' && y < parseInt(self.opt.exheight,10))
				{
					y = parseInt(self.opt.exheight,10);
				}
				else
				{
					if(y<0)
					{
						y = 0;
					}
				}
				if(self.opt.taskbar == 'left' && x < parseInt(self.opt.exwidth,10))
				{
					x = parseInt(obj.opt.exwidth,10);
				}
				else
				{
					if(x < 0)
					{
						x = 0;
					}
				}
				var max_width = $(window).width();
				var max_height = $(window).height();
				var width = $("#"+id).width();
				var height = $("#"+id).height();
				if( (max_width - width) < x)
				{
					x = max_width - width;
				}

				if((max_height - height) < y)
				{
					y = max_height - height;
				}
				$("#vlayer-"+id).css({'top':y+"px",'left':x+"px"});//控件新位置
				e.preventDefault && e.preventDefault();
			}).mouseup(function(e){
				e = e || window.event;
				_move = false;
				self._vlayer_close(id);
				e.preventDefault && e.preventDefault();
			});
			*/
			
		}
	};
	
	$.win = function(title,url,opts){
		//检查是否窗口已存在
		var open_id = false;
		$("ul#phpok-taskbar li").each(function(i){
			var txt = $(this).text();
			if(txt == title){
				open_id = $(this).attr('id');
			}
		});
		
		if(open_id){
			$("#"+open_id).click();
			return false;
		}
		var max = $('body').width() - 770;
		var this_max = 90;//最大可以弹出90个窗口
		$("ul.head_tab li").each(function(i){
			this_max += parseInt($(this).outerWidth(true));
		});
		
		//检查窗口
		if(max <= this_max)
		{
			$.dialog.alert('您弹出的窗口太多了，请先关闭几个没有用的窗口');
			return false;
		}
		
		//var height = parseInt(($(window).height() - 45) * 0.8);
		var height = parseInt(($(document).height() - 45));
		var exwidth = $('.c_left').parent().width();
		if(!exwidth || exwidth == 'null' || exwidth == null){
			exwidth = 0;
		}
		
		var defaults = {
			'iframe':url,
			'title':title,
			'lock':false,
			'taskbar':'top',
			'exheight':45,
			'exwidth':exwidth,
			'height':height,
			'move':true,
			'win_max':true,
			'win_min':true,
			'is_max':true
		}
		
		var opt = $.extend({},defaults, opts);
		$.desktop.init(opt);
		$.desktop.win_id();
		
		//设置 两秒以后才能再次打开
		if (canOpen) {
			$.desktop.win();//执行打开事件
			//执行全屏事件
			canOpen = false;
			setTimeout(function(){
				canOpen = true;
			},2000);
		}
		console.log(canOpen);
	};
})(jQuery);


(function($) {
	$.fn.wresize = function(f) {
		version = '1.1';
		wresize = {
			fired: false,
			width: 0
		};

		function resizeOnce() {
			if ($.browser.msie) {
				if (!wresize.fired) {
					wresize.fired = true;
				} else {
					var version = parseInt($.browser.version, 10);
					wresize.fired = false;
					if (version < 7) {
						return false;
					} else if (version == 7) {
						//a vertical resize is fired once, an horizontal resize twice 
						var width = $(window).width();
						if (width != wresize.width) {
							wresize.width = width;
							return false;
						}
					}
				}
			}
			return true;
		}

		function handleWResize(e) {
			if (resizeOnce()) {
				return f.apply(this, [e]);
			}
		}
		this.each(function() {
			if (this == window) {
				//alert("ttt");
				$(this).resize(handleWResize);
			} else {
				$(this).resize(f);
			}
		});
		return this;
	};
})(jQuery);
/***********************************************************
	Filename: {phpok}js/global.admin.js
	Note	: 后台公共JS
	Version : 4.0
	Web		: www.phpok.com
	Author  : qinggan <qinggan@188.com>
	Update  : 2013年9月12日
***********************************************************/
function alt_open(id,note)
{
	if(!id || id == "undefined") return false;
	if(!note || note == "undefined")
	{
		note = $("#"+id).attr("alt") ? $("#"+id).attr("alt") : $("#"+id).attr("title");
		if(!note || note == "undefined")
		{
			return false;
		}
	}
	$.dialog({
		"id": "phpok_alt",
		"title": false,
		"cancel":false,
		"padding":"10px 10px",
		"follow": document.getElementById(id),
		"content":note
	});
}

function alt_close()
{
	$.dialog.list["phpok_alt"].close();
}

//通用更新排序
function taxis(baseurl,default_value)
{
	var url = baseurl;
	if(!default_value || default_value == "undefined") default_value = "0";
	var id_string = $.input.checkbox_join();
	if(!id_string || id_string == "undefined")
	{
		alert("没有指定要更新的排序ID！");
		return false;
	}
	//取得排序值信息
	var id_list = id_string.split(",");
	var id_leng = id_list.length;
	for(var i=0;i<id_leng;i++)
	{
		var taxis = $("#taxis_"+id_list[i]).val();
		if(!taxis) taxis = default_value;
		url += "&taxis["+id_list[i]+"]="+$.str.encode(taxis);
	}
	var rs = json_ajax(url);
	if(rs.status == "ok")
	{
		alert("排序更新完成！");
		window.location.reload();
	}
	else
	{
		alert(rs.content);
		return false;
	}
}

/* 通用状态更新 */
function phpok_status(id,url)
{
	if(!url || url == "undefined" || !id) return false;
	url += "&id="+$.str.encode(id);
	var rs = json_ajax(url);
	if(rs.status == "ok")
	{
		if(!rs.content) rs.content = '0';
		var oldvalue = $("#status_"+id).attr("value");
		var old_cls = "status"+oldvalue;
		$("#status_"+id).removeClass(old_cls).addClass("status"+rs.content);
		$("#status_"+id).attr("value",rs.content);
	}
	else
	{
		alert(rs.content);
		return false;
	}
}

/* 通用表单自动存储 */
// formid，要自动存储的表单ID
// type，要自动存储的类型，目前仅支持 cate list两种
// func，返回执行的函数
function autosave(formid,type,func)
{
	if(!type || type == "undefined") type = "list";
	if(!func || func == "undefined") func = "autosave_callback";
	var str = $("#"+formid).serialize();
	var url = get_url("auto") + "&__type="+type;
	//通过POST存储数据
	$.post(url,str,function(rs){func(rs);},"json");
}

/* 自动填写表单数据 */
function autofill(type)
{
	var turl = get_url("auto","read") + "&__type="+type;
	$.ajax({
		url:turl,
		cache:false,
		async:true,
		dataType:"json",
		success: function(rs){
			if(rs.status == "ok")
			{
				var list = rs.content;
				for(var key in list)
				{
					var input = $("input[name="+key+"]");
					var textarea = $("textarea[name="+key+"]");
					if(input.length>0)
					{
						input.val(list[key]);
					}
					else if(textarea.length>0)
					{
						var edit = $("textarea[name="+key+"][phpok_id=htmledit]");
						if(edit.length>0)
						{
							var my_edit = eval(key+"_editor");
							my_edit.html(list[key]);
						}
						else
						{
							textarea.val(list[key]);
						}
					}
				}
			}
		}
	});
}

//弹出图片选择窗口
function phpok_pic(id)
{
	if(!id || id == "undefined")
	{
		$.dialog.alert("未指定ID");
		return false;
	}
	var url = get_url("open","input") + "&type=picture&id="+id;
	$.dialog.open(url,{
		title: "图片管理器",
		lock : true,
		width: "80%",
		height: "70%",
		win_min:false,
		win_max:false,
		resize: false
	});
}

// 预览图片
function phpok_pic_view(id)
{
	var url = $("#"+id).val();
	if(!url || url == "undefined")
	{
		$.dialog.alert("图片不存在，请在表单中填写图片地址");
	}
	else
	{
		top.$.dialog({
			'title':'预览',
			'content':'<img src="'+url+'" border="0" />',
			'lock':true,
			'ok':function(){},
			'height':350,
			'width':500,
			'okVal':'关闭预览'
		});
	}
}

//弹出窗口，选择模板
function phpok_tpl_open(id)
{
	var url = get_url("tpl","open") + "&id="+id;
	$.dialog.open(url,{
		title: "模板选择",
		lock : true,
		width: "700px",
		height: "400px",
		resize: false
	});
}

function phpok_admin_control()
{
	var url = get_url("me","setting");
	$.dialog.open(url,{
		"title":"修改管理员信息",
		"width":600,
		"height":400,
		"lock":true,
		'move':false,
		'is_max':false
	});
}

function phpok_admin_logout()
{
	$.dialog.confirm("确定要退出吗？",function(){
		var url = get_url("logout");
		$.phpok.go(url);
	});
}

function phpok_admin_clear()
{
	var url = get_url("index","clear");
	var rs = $.phpok.json(url);
	if(rs.status == "ok"){
		$.dialog.alert("缓存清空完成");
	}else{
		$.dialog.alert(rs.content);
	}
}


function phpok_admin_orderby(id,val)
{
	$.dialog({
		"title":"排序设置",
		"content":'<div><label for="_phpok_tmp_desc_'+id+'"><input type="radio" name="_phpok_tmp_desc_asc_'+id+'" value="DESC" checked id="_phpok_tmp_desc_'+id+'"/>倒序↓，数值从高排到低，示例：Z→A，9→1</label></div><div><label for="_phpok_tmp_asc_'+id+'"><input type="radio" value="ASC" name="_phpok_tmp_desc_asc_'+id+'" id="_phpok_tmp_asc_'+id+'"/>正序↑，数值从低排到高，示例：A→Z，1→9</label></div>',
		'lock':true,
		"ok":function(){
			var desc_asc = $("input[name=_phpok_tmp_desc_asc_"+id+"]:checked").val();
			if(!desc_asc)
			{
				alert("请选择排序方式");
				return false;
			}
			val += " "+desc_asc;
			var str = $("#"+id).val();
			if(str)
			{
				str += ","+val;
			}
			else
			{
				str = val;
			}
			$("#"+id).val(str);
		}
	});
}

function goto_site(id,oldid)
{
	$.dialog.confirm("确定要切换到网站 <span style='color:red;font-weight:bold;'>"+$('#top_site_id').find("option:selected").text()+"</span> 吗?",function(){
		var url = get_url("index","site") + "&id="+id.toString();
		direct(url);
	},function(){
		$("#top_site_id").val(oldid);
	});
}

//前台常用JS函数封装
;(function($){
	$.admin = {
		//更换Tab设置
		tab:function(val){
			$("#float_tab li").each(function(i){
				var name = $(this).attr("name");
				if(name == val)
				{
					$(this).removeClass("tab_out").addClass("tab_over");
					$("#"+val+"_setting").show();
				}
				else
				{
					$(this).removeClass("tab_over").addClass("tab_out");
					$("#"+name+"_setting").hide();
				}
			});
		},
		group:function(obj){
			var val = $(obj).attr('name');
			$.each($(obj).parent().find('li'),function(i){
				var name = $(this).attr('name');
				$(this).removeClass('on');
				$("#"+name+"_setting").hide();
			});
			//显示当前的
			$(obj).addClass('on');
			$("#"+val+"_setting").show();
		}
	};
})(jQuery);


(function(a){var b=a(document).data("func",{});a.smartMenu=a.noop;a.fn.smartMenu=function(f,c){var i=a("body"),g={name:"",offsetX:2,offsetY:2,textLimit:6,beforeShow:a.noop,afterShow:a.noop};var h=a.extend(g,c||{});var e=function(k){var m=k||f,j=k?Math.random().toString():h.name,o="",n="",l="smart_menu_";if(a.isArray(m)&&m.length){o='<div id="smartMenu_'+j+'" class="'+l+'box"><div class="'+l+'body"><ul class="'+l+'ul">';a.each(m,function(q,p){if(q){o=o+'<li class="'+l+'li_separate">&nbsp;</li>'}if(a.isArray(p)){a.each(p,function(s,v){var w=v.text,u="",r="",t=Math.random().toString().replace(".","");if(w){if(w.length>h.textLimit){w=w.slice(0,h.textLimit)+"…";r=' title="'+v.text+'"'}if(a.isArray(v.data)&&v.data.length){u='<li class="'+l+'li" data-hover="true">'+e(v.data)+'<a href="javascript:" class="'+l+'a"'+r+' data-key="'+t+'"><i class="'+l+'triangle"></i>'+w+"</a></li>"}else{u='<li class="'+l+'li"><a href="javascript:" class="'+l+'a"'+r+' data-key="'+t+'">'+w+"</a></li>"}o+=u;var x=b.data("func");x[t]=v.func;b.data("func",x)}})}});o=o+"</ul></div></div>"}return o},d=function(){var j="#smartMenu_",l="smart_menu_",k=a(j+h.name);if(!k.size()){a("body").append(e());a(j+h.name+" a").bind("click",function(){var m=a(this).attr("data-key"),n=b.data("func")[m];if(a.isFunction(n)){n.call(b.data("trigger"))}a.smartMenu.hide();return false});a(j+h.name+" li").each(function(){var m=a(this).attr("data-hover"),n=l+"li_hover";a(this).hover(function(){var o=a(this).siblings("."+n);o.removeClass(n).children("."+l+"box").hide();o.children("."+l+"a").removeClass(l+"a_hover");if(m){a(this).addClass(n).children("."+l+"box").show();a(this).children("."+l+"a").addClass(l+"a_hover")}})});return a(j+h.name)}return k};a(this).each(function(){this.oncontextmenu=function(l){if(a.isFunction(h.beforeShow)){h.beforeShow.call(this)}l=l||window.event;l.cancelBubble=true;if(l.stopPropagation){l.stopPropagation()}a.smartMenu.hide();var k=b.scrollTop();var j=d();if(j){j.css({display:"block",left:l.clientX+h.offsetX,top:l.clientY+k+h.offsetY});b.data("target",j);b.data("trigger",this);if(a.isFunction(h.afterShow)){h.afterShow.call(this)}return false}}});if(!i.data("bind")){i.bind("click",a.smartMenu.hide).data("bind",true)}};a.extend(a.smartMenu,{hide:function(){var c=b.data("target");if(c&&c.css("display")==="block"){c.hide()}},remove:function(){var c=b.data("target");if(c){c.remove()}}})})(jQuery);
