/**
 * Minified by jsDelivr using Terser v5.3.5.
 * Original file: /gh/alpinejs/alpine@2.8.2/dist/alpine.js
 *
 * Do NOT use SRI with dynamically generated files! More information: https://www.jsdelivr.com/using-sri-with-dynamic-files
 */
 !function(e,t){"object"==typeof exports&&"undefined"!=typeof module?module.exports=t():"function"==typeof define&&define.amd?define(t):(e=e||self).Alpine=t()}(this,(function(){"use strict";function e(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function t(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(e);t&&(i=i.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,i)}return n}function n(n){for(var i=1;i<arguments.length;i++){var r=null!=arguments[i]?arguments[i]:{};i%2?t(Object(r),!0).forEach((function(t){e(n,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(n,Object.getOwnPropertyDescriptors(r)):t(Object(r)).forEach((function(e){Object.defineProperty(n,e,Object.getOwnPropertyDescriptor(r,e))}))}return n}function i(e){return Array.from(new Set(e))}function r(){return navigator.userAgent.includes("Node.js")||navigator.userAgent.includes("jsdom")}function s(e,t){return e==t}function o(e,t){"template"!==e.tagName.toLowerCase()?console.warn(`Alpine: [${t}] directive should only be added to <template> tags. See https://github.com/alpinejs/alpine#${t}`):1!==e.content.childElementCount&&console.warn(`Alpine: <template> tag with [${t}] encountered with an unexpected number of root elements. Make sure <template> has a single root element. `)}function a(e){return e.toLowerCase().replace(/-(\w)/g,((e,t)=>t.toUpperCase()))}function l(e,t){if(!1===t(e))return;let n=e.firstElementChild;for(;n;)l(n,t),n=n.nextElementSibling}function c(e,t){var n;return function(){var i=this,r=arguments,s=function(){n=null,e.apply(i,r)};clearTimeout(n),n=setTimeout(s,t)}}const u=(e,t,n)=>{if(console.warn(`Alpine Error: "${n}"\n\nExpression: "${t}"\nElement:`,e),!r())throw Object.assign(n,{el:e,expression:t}),n};function d(e,{el:t,expression:n}){try{const i=e();return i instanceof Promise?i.catch((e=>u(t,n,e))):i}catch(e){u(t,n,e)}}function f(e,t,n,i={}){return d((()=>"function"==typeof t?t.call(n):new Function(["$data",...Object.keys(i)],`var __alpine_result; with($data) { __alpine_result = ${t} }; return __alpine_result`)(n,...Object.values(i))),{el:e,expression:t})}const m=/^x-(on|bind|data|text|html|model|if|for|show|cloak|transition|ref|spread)\b/;function p(e){const t=y(e.name);return m.test(t)}function h(e,t,n){let i=Array.from(e.attributes).filter(p).map(v),r=i.filter((e=>"spread"===e.type))[0];if(r){let n=f(e,r.expression,t.$data);i=i.concat(Object.entries(n).map((([e,t])=>v({name:e,value:t}))))}return n?i.filter((e=>e.type===n)):function(e){let t=["bind","model","show","catch-all"];return e.sort(((e,n)=>{let i=-1===t.indexOf(e.type)?"catch-all":e.type,r=-1===t.indexOf(n.type)?"catch-all":n.type;return t.indexOf(i)-t.indexOf(r)}))}(i)}function v({name:e,value:t}){const n=y(e),i=n.match(m),r=n.match(/:([a-zA-Z0-9\-:]+)/),s=n.match(/\.[^.\]]+(?=[^\]]*$)/g)||[];return{type:i?i[1]:null,value:r?r[1]:null,modifiers:s.map((e=>e.replace(".",""))),expression:t}}function y(e){return e.startsWith("@")?e.replace("@","x-on:"):e.startsWith(":")?e.replace(":","x-bind:"):e}function b(e,t=Boolean){return e.split(" ").filter(t)}const g="in",x="out",_="cancelled";function w(e,t,n,i,r=!1){if(r)return t();if(e.__x_transition&&e.__x_transition.type===g)return;const s=h(e,i,"transition"),o=h(e,i,"show")[0];if(o&&o.modifiers.includes("transition")){let i=o.modifiers;if(i.includes("out")&&!i.includes("in"))return t();const r=i.includes("in")&&i.includes("out");i=r?i.filter(((e,t)=>t<i.indexOf("out"))):i,function(e,t,n,i){const r={duration:O(t,"duration",150),origin:O(t,"origin","center"),first:{opacity:0,scale:O(t,"scale",95)},second:{opacity:1,scale:100}};k(e,t,n,(()=>{}),i,r,g)}(e,i,t,n)}else s.some((e=>["enter","enter-start","enter-end"].includes(e.value)))?function(e,t,n,i,r){const s=b(A((n.find((e=>"enter"===e.value))||{expression:""}).expression,e,t)),o=b(A((n.find((e=>"enter-start"===e.value))||{expression:""}).expression,e,t)),a=b(A((n.find((e=>"enter-end"===e.value))||{expression:""}).expression,e,t));S(e,s,o,a,i,(()=>{}),g,r)}(e,i,s,t,n):t()}function E(e,t,n,i,r=!1){if(r)return t();if(e.__x_transition&&e.__x_transition.type===x)return;const s=h(e,i,"transition"),o=h(e,i,"show")[0];if(o&&o.modifiers.includes("transition")){let i=o.modifiers;if(i.includes("in")&&!i.includes("out"))return t();const r=i.includes("in")&&i.includes("out");i=r?i.filter(((e,t)=>t>i.indexOf("out"))):i,function(e,t,n,i,r){const s={duration:n?O(t,"duration",150):O(t,"duration",150)/2,origin:O(t,"origin","center"),first:{opacity:1,scale:100},second:{opacity:0,scale:O(t,"scale",95)}};k(e,t,(()=>{}),i,r,s,x)}(e,i,r,t,n)}else s.some((e=>["leave","leave-start","leave-end"].includes(e.value)))?function(e,t,n,i,r){const s=b(A((n.find((e=>"leave"===e.value))||{expression:""}).expression,e,t)),o=b(A((n.find((e=>"leave-start"===e.value))||{expression:""}).expression,e,t)),a=b(A((n.find((e=>"leave-end"===e.value))||{expression:""}).expression,e,t));S(e,s,o,a,(()=>{}),i,x,r)}(e,i,s,t,n):t()}function O(e,t,n){if(-1===e.indexOf(t))return n;const i=e[e.indexOf(t)+1];if(!i)return n;if("scale"===t&&!P(i))return n;if("duration"===t){let e=i.match(/([0-9]+)ms/);if(e)return e[1]}return"origin"===t&&["top","right","left","center","bottom"].includes(e[e.indexOf(t)+2])?[i,e[e.indexOf(t)+2]].join(" "):i}function k(e,t,n,i,r,s,o){e.__x_transition&&e.__x_transition.cancel&&e.__x_transition.cancel();const a=e.style.opacity,l=e.style.transform,c=e.style.transformOrigin,u=!t.includes("opacity")&&!t.includes("scale"),d=u||t.includes("opacity"),f=u||t.includes("scale"),m={start(){d&&(e.style.opacity=s.first.opacity),f&&(e.style.transform=`scale(${s.first.scale/100})`)},during(){f&&(e.style.transformOrigin=s.origin),e.style.transitionProperty=[d?"opacity":"",f?"transform":""].join(" ").trim(),e.style.transitionDuration=s.duration/1e3+"s",e.style.transitionTimingFunction="cubic-bezier(0.4, 0.0, 0.2, 1)"},show(){n()},end(){d&&(e.style.opacity=s.second.opacity),f&&(e.style.transform=`scale(${s.second.scale/100})`)},hide(){i()},cleanup(){d&&(e.style.opacity=a),f&&(e.style.transform=l),f&&(e.style.transformOrigin=c),e.style.transitionProperty=null,e.style.transitionDuration=null,e.style.transitionTimingFunction=null}};$(e,m,o,r)}const A=(e,t,n)=>"function"==typeof e?n.evaluateReturnExpression(t,e):e;function S(e,t,n,i,r,s,o,a){e.__x_transition&&e.__x_transition.cancel&&e.__x_transition.cancel();const l=e.__x_original_classes||[],c={start(){e.classList.add(...n)},during(){e.classList.add(...t)},show(){r()},end(){e.classList.remove(...n.filter((e=>!l.includes(e)))),e.classList.add(...i)},hide(){s()},cleanup(){e.classList.remove(...t.filter((e=>!l.includes(e)))),e.classList.remove(...i.filter((e=>!l.includes(e))))}};$(e,c,o,a)}function $(e,t,n,i){const r=C((()=>{t.hide(),e.isConnected&&t.cleanup(),delete e.__x_transition}));e.__x_transition={type:n,cancel:C((()=>{i(_),r()})),finish:r,nextFrame:null},t.start(),t.during(),e.__x_transition.nextFrame=requestAnimationFrame((()=>{let n=1e3*Number(getComputedStyle(e).transitionDuration.replace(/,.*/,"").replace("s",""));0===n&&(n=1e3*Number(getComputedStyle(e).animationDuration.replace("s",""))),t.show(),e.__x_transition.nextFrame=requestAnimationFrame((()=>{t.end(),setTimeout(e.__x_transition.finish,n)}))}))}function P(e){return!Array.isArray(e)&&!isNaN(e)}function C(e){let t=!1;return function(){t||(t=!0,e.apply(this,arguments))}}function j(e,t,i,r,s){o(t,"x-for");let a=D("function"==typeof i?e.evaluateReturnExpression(t,i):i),l=function(e,t,n,i){let r=h(t,e,"if")[0];if(r&&!e.evaluateReturnExpression(t,r.expression))return[];let s=e.evaluateReturnExpression(t,n.items,i);P(s)&&s>=0&&(s=Array.from(Array(s).keys(),(e=>e+1)));return s}(e,t,a,s),c=t;l.forEach(((i,o)=>{let u=function(e,t,i,r,s){let o=s?n({},s):{};o[e.item]=t,e.index&&(o[e.index]=i);e.collection&&(o[e.collection]=r);return o}(a,i,o,l,s()),d=function(e,t,n,i){let r=h(t,e,"bind").filter((e=>"key"===e.value))[0];return r?e.evaluateReturnExpression(t,r.expression,(()=>i)):n}(e,t,o,u),f=function(e,t){if(!e)return;if(void 0===e.__x_for_key)return;if(e.__x_for_key===t)return e;let n=e;for(;n;){if(n.__x_for_key===t)return n.parentElement.insertBefore(n,e);n=!(!n.nextElementSibling||void 0===n.nextElementSibling.__x_for_key)&&n.nextElementSibling}}(c.nextElementSibling,d);f?(delete f.__x_for_key,f.__x_for=u,e.updateElements(f,(()=>f.__x_for))):(f=function(e,t){let n=document.importNode(e.content,!0);return t.parentElement.insertBefore(n,t.nextElementSibling),t.nextElementSibling}(t,c),w(f,(()=>{}),(()=>{}),e,r),f.__x_for=u,e.initializeElements(f,(()=>f.__x_for))),c=f,c.__x_for_key=d})),function(e,t){var n=!(!e.nextElementSibling||void 0===e.nextElementSibling.__x_for_key)&&e.nextElementSibling;for(;n;){let e=n,i=n.nextElementSibling;E(n,(()=>{e.remove()}),(()=>{}),t),n=!(!i||void 0===i.__x_for_key)&&i}}(c,e)}function D(e){let t=/,([^,\}\]]*)(?:,([^,\}\]]*))?$/,n=String(e).match(/([\s\S]*?)\s+(?:in|of)\s+([\s\S]*)/);if(!n)return;let i={};i.items=n[2].trim();let r=n[1].trim().replace(/^\(|\)$/g,""),s=r.match(t);return s?(i.item=r.replace(t,"").trim(),i.index=s[1].trim(),s[2]&&(i.collection=s[2].trim())):i.item=r,i}function T(e,t,n,r,o,l,c){var u=e.evaluateReturnExpression(t,r,o);if("value"===n){if(ge.ignoreFocusedForValueBinding&&document.activeElement.isSameNode(t))return;if(void 0===u&&String(r).match(/\./)&&(u=""),"radio"===t.type)void 0===t.attributes.value&&"bind"===l?t.value=u:"bind"!==l&&(t.checked=s(t.value,u));else if("checkbox"===t.type)"boolean"==typeof u||[null,void 0].includes(u)||"bind"!==l?"bind"!==l&&(Array.isArray(u)?t.checked=u.some((e=>s(e,t.value))):t.checked=!!u):t.value=String(u);else if("SELECT"===t.tagName)!function(e,t){const n=[].concat(t).map((e=>e+""));Array.from(e.options).forEach((e=>{e.selected=n.includes(e.value||e.text)}))}(t,u);else{if(t.value===u)return;t.value=u}}else if("class"===n)if(Array.isArray(u)){const e=t.__x_original_classes||[];t.setAttribute("class",i(e.concat(u)).join(" "))}else if("object"==typeof u){Object.keys(u).sort(((e,t)=>u[e]-u[t])).forEach((e=>{u[e]?b(e).forEach((e=>t.classList.add(e))):b(e).forEach((e=>t.classList.remove(e)))}))}else{const e=t.__x_original_classes||[],n=u?b(u):[];t.setAttribute("class",i(e.concat(n)).join(" "))}else n=c.includes("camel")?a(n):n,[null,void 0,!1].includes(u)?t.removeAttribute(n):!function(e){return["disabled","checked","required","readonly","hidden","open","selected","autofocus","itemscope","multiple","novalidate","allowfullscreen","allowpaymentrequest","formnovalidate","autoplay","controls","loop","muted","playsinline","default","ismap","reversed","async","defer","nomodule"].includes(e)}(n)?L(t,n,u):L(t,n,n)}function L(e,t,n){e.getAttribute(t)!=n&&e.setAttribute(t,n)}function N(e,t,n,i,r,s={}){const o={passive:i.includes("passive")};let l,u;if(i.includes("camel")&&(n=a(n)),i.includes("away")?(u=document,l=a=>{t.contains(a.target)||t.offsetWidth<1&&t.offsetHeight<1||(z(e,r,a,s),i.includes("once")&&document.removeEventListener(n,l,o))}):(u=i.includes("window")?window:i.includes("document")?document:t,l=a=>{if(u!==window&&u!==document||document.body.contains(t)){if(!(function(e){return["keydown","keyup"].includes(e)}(n)&&function(e,t){let n=t.filter((e=>!["window","document","prevent","stop"].includes(e)));if(n.includes("debounce")){let e=n.indexOf("debounce");n.splice(e,P((n[e+1]||"invalid-wait").split("ms")[0])?2:1)}if(0===n.length)return!1;if(1===n.length&&n[0]===R(e.key))return!1;const i=["ctrl","shift","alt","meta","cmd","super"].filter((e=>n.includes(e)));if(n=n.filter((e=>!i.includes(e))),i.length>0){if(i.filter((t=>("cmd"!==t&&"super"!==t||(t="meta"),e[t+"Key"]))).length===i.length&&n[0]===R(e.key))return!1}return!0}(a,i)||(i.includes("prevent")&&a.preventDefault(),i.includes("stop")&&a.stopPropagation(),i.includes("self")&&a.target!==t))){z(e,r,a,s).then((e=>{!1===e?a.preventDefault():i.includes("once")&&u.removeEventListener(n,l,o)}))}}else u.removeEventListener(n,l,o)}),i.includes("debounce")){let e=i[i.indexOf("debounce")+1]||"invalid-wait",t=P(e.split("ms")[0])?Number(e.split("ms")[0]):250;l=c(l,t)}u.addEventListener(n,l,o)}function z(e,t,i,r){return e.evaluateCommandExpression(i.target,t,(()=>n(n({},r()),{},{$event:i})))}function R(e){switch(e){case"/":return"slash";case" ":case"Spacebar":return"space";default:return e&&e.replace(/([a-z])([A-Z])/g,"$1-$2").replace(/[_\s]/,"-").toLowerCase()}}function F(e,t,n){return"radio"===e.type&&(e.hasAttribute("name")||e.setAttribute("name",n)),(n,i)=>{if(n instanceof CustomEvent&&n.detail)return n.detail;if("checkbox"===e.type){if(Array.isArray(i)){const e=t.includes("number")?I(n.target.value):n.target.value;return n.target.checked?i.concat([e]):i.filter((t=>!s(t,e)))}return n.target.checked}if("select"===e.tagName.toLowerCase()&&e.multiple)return t.includes("number")?Array.from(n.target.selectedOptions).map((e=>I(e.value||e.text))):Array.from(n.target.selectedOptions).map((e=>e.value||e.text));{const e=n.target.value;return t.includes("number")?I(e):t.includes("trim")?e.trim():e}}}function I(e){const t=e?parseFloat(e):null;return P(t)?t:e}const{isArray:M}=Array,{getPrototypeOf:B,create:q,defineProperty:U,defineProperties:W,isExtensible:K,getOwnPropertyDescriptor:G,getOwnPropertyNames:H,getOwnPropertySymbols:V,preventExtensions:Z,hasOwnProperty:J}=Object,{push:Q,concat:X,map:Y}=Array.prototype;function ee(e){return void 0===e}function te(e){return"function"==typeof e}const ne=new WeakMap;function ie(e,t){ne.set(e,t)}const re=e=>ne.get(e)||e;function se(e,t){return e.valueIsObservable(t)?e.getProxy(t):t}function oe(e,t,n){X.call(H(n),V(n)).forEach((i=>{let r=G(n,i);r.configurable||(r=ve(e,r,se)),U(t,i,r)})),Z(t)}class ae{constructor(e,t){this.originalTarget=t,this.membrane=e}get(e,t){const{originalTarget:n,membrane:i}=this,r=n[t],{valueObserved:s}=i;return s(n,t),i.getProxy(r)}set(e,t,n){const{originalTarget:i,membrane:{valueMutated:r}}=this;return i[t]!==n?(i[t]=n,r(i,t)):"length"===t&&M(i)&&r(i,t),!0}deleteProperty(e,t){const{originalTarget:n,membrane:{valueMutated:i}}=this;return delete n[t],i(n,t),!0}apply(e,t,n){}construct(e,t,n){}has(e,t){const{originalTarget:n,membrane:{valueObserved:i}}=this;return i(n,t),t in n}ownKeys(e){const{originalTarget:t}=this;return X.call(H(t),V(t))}isExtensible(e){const t=K(e);if(!t)return t;const{originalTarget:n,membrane:i}=this,r=K(n);return r||oe(i,e,n),r}setPrototypeOf(e,t){}getPrototypeOf(e){const{originalTarget:t}=this;return B(t)}getOwnPropertyDescriptor(e,t){const{originalTarget:n,membrane:i}=this,{valueObserved:r}=this.membrane;r(n,t);let s=G(n,t);if(ee(s))return s;const o=G(e,t);return ee(o)?(s=ve(i,s,se),s.configurable||U(e,t,s),s):o}preventExtensions(e){const{originalTarget:t,membrane:n}=this;return oe(n,e,t),Z(t),!0}defineProperty(e,t,n){const{originalTarget:i,membrane:r}=this,{valueMutated:s}=r,{configurable:o}=n;if(J.call(n,"writable")&&!J.call(n,"value")){const e=G(i,t);n.value=e.value}return U(i,t,function(e){return J.call(e,"value")&&(e.value=re(e.value)),e}(n)),!1===o&&U(e,t,ve(r,n,se)),s(i,t),!0}}function le(e,t){return e.valueIsObservable(t)?e.getReadOnlyProxy(t):t}class ce{constructor(e,t){this.originalTarget=t,this.membrane=e}get(e,t){const{membrane:n,originalTarget:i}=this,r=i[t],{valueObserved:s}=n;return s(i,t),n.getReadOnlyProxy(r)}set(e,t,n){return!1}deleteProperty(e,t){return!1}apply(e,t,n){}construct(e,t,n){}has(e,t){const{originalTarget:n,membrane:{valueObserved:i}}=this;return i(n,t),t in n}ownKeys(e){const{originalTarget:t}=this;return X.call(H(t),V(t))}setPrototypeOf(e,t){}getOwnPropertyDescriptor(e,t){const{originalTarget:n,membrane:i}=this,{valueObserved:r}=i;r(n,t);let s=G(n,t);if(ee(s))return s;const o=G(e,t);return ee(o)?(s=ve(i,s,le),J.call(s,"set")&&(s.set=void 0),s.configurable||U(e,t,s),s):o}preventExtensions(e){return!1}defineProperty(e,t,n){return!1}}function ue(e){let t=void 0;return M(e)?t=[]:"object"==typeof e&&(t={}),t}const de=Object.prototype;function fe(e){if(null===e)return!1;if("object"!=typeof e)return!1;if(M(e))return!0;const t=B(e);return t===de||null===t||null===B(t)}const me=(e,t)=>{},pe=(e,t)=>{},he=e=>e;function ve(e,t,n){const{set:i,get:r}=t;return J.call(t,"value")?t.value=n(e,t.value):(ee(r)||(t.get=function(){return n(e,r.call(re(this)))}),ee(i)||(t.set=function(t){i.call(re(this),e.unwrapProxy(t))})),t}class ye{constructor(e){if(this.valueDistortion=he,this.valueMutated=pe,this.valueObserved=me,this.valueIsObservable=fe,this.objectGraph=new WeakMap,!ee(e)){const{valueDistortion:t,valueMutated:n,valueObserved:i,valueIsObservable:r}=e;this.valueDistortion=te(t)?t:he,this.valueMutated=te(n)?n:pe,this.valueObserved=te(i)?i:me,this.valueIsObservable=te(r)?r:fe}}getProxy(e){const t=re(e),n=this.valueDistortion(t);if(this.valueIsObservable(n)){const i=this.getReactiveState(t,n);return i.readOnly===e?e:i.reactive}return n}getReadOnlyProxy(e){e=re(e);const t=this.valueDistortion(e);return this.valueIsObservable(t)?this.getReactiveState(e,t).readOnly:t}unwrapProxy(e){return re(e)}getReactiveState(e,t){const{objectGraph:n}=this;let i=n.get(t);if(i)return i;const r=this;return i={get reactive(){const n=new ae(r,t),i=new Proxy(ue(t),n);return ie(i,e),U(this,"reactive",{value:i}),i},get readOnly(){const n=new ce(r,t),i=new Proxy(ue(t),n);return ie(i,e),U(this,"readOnly",{value:i}),i}},n.set(t,i),i}}class be{constructor(e,t=null){this.$el=e;const n=this.$el.getAttribute("x-data"),i=""===n?"{}":n,r=this.$el.getAttribute("x-init");let s={$el:this.$el},o=t?t.$el:this.$el;Object.entries(ge.magicProperties).forEach((([e,t])=>{Object.defineProperty(s,"$"+e,{get:function(){return t(o)}})})),this.unobservedData=t?t.getUnobservedData():f(e,i,s);let{membrane:a,data:l}=this.wrapDataInObservable(this.unobservedData);var c;this.$data=l,this.membrane=a,this.unobservedData.$el=this.$el,this.unobservedData.$refs=this.getRefsProxy(),this.nextTickStack=[],this.unobservedData.$nextTick=e=>{this.nextTickStack.push(e)},this.watchers={},this.unobservedData.$watch=(e,t)=>{this.watchers[e]||(this.watchers[e]=[]),this.watchers[e].push(t)},Object.entries(ge.magicProperties).forEach((([e,t])=>{Object.defineProperty(this.unobservedData,"$"+e,{get:function(){return t(o,this.$el)}})})),this.showDirectiveStack=[],this.showDirectiveLastElement,t||ge.onBeforeComponentInitializeds.forEach((e=>e(this))),r&&!t&&(this.pauseReactivity=!0,c=this.evaluateReturnExpression(this.$el,r),this.pauseReactivity=!1),this.initializeElements(this.$el,(()=>{}),t),this.listenForNewElementsToInitialize(),"function"==typeof c&&c.call(this.$data),t||setTimeout((()=>{ge.onComponentInitializeds.forEach((e=>e(this)))}),0)}getUnobservedData(){return function(e,t){let n=e.unwrapProxy(t),i={};return Object.keys(n).forEach((e=>{["$el","$refs","$nextTick","$watch"].includes(e)||(i[e]=n[e])})),i}(this.membrane,this.$data)}wrapDataInObservable(e){var t=this;let n=c((function(){t.updateElements(t.$el)}),0);return function(e,t){let n=new ye({valueMutated(e,n){t(e,n)}});return{data:n.getProxy(e),membrane:n}}(e,((e,i)=>{t.watchers[i]?t.watchers[i].forEach((t=>t(e[i]))):Array.isArray(e)?Object.keys(t.watchers).forEach((n=>{let r=n.split(".");"length"!==i&&r.reduce(((i,r)=>(Object.is(e,i[r])&&t.watchers[n].forEach((t=>t(e))),i[r])),t.unobservedData)})):Object.keys(t.watchers).filter((e=>e.includes("."))).forEach((n=>{let r=n.split(".");i===r[r.length-1]&&r.reduce(((r,s)=>(Object.is(e,r)&&t.watchers[n].forEach((t=>t(e[i]))),r[s])),t.unobservedData)})),t.pauseReactivity||n()}))}walkAndSkipNestedComponents(e,t,n=(()=>{})){l(e,(e=>e.hasAttribute("x-data")&&!e.isSameNode(this.$el)?(e.__x||n(e),!1):t(e)))}initializeElements(e,t=(()=>{}),n=!1){this.walkAndSkipNestedComponents(e,(e=>void 0===e.__x_for_key&&(void 0===e.__x_inserted_me&&void this.initializeElement(e,t,!n))),(e=>{n||(e.__x=new be(e))})),this.executeAndClearRemainingShowDirectiveStack(),this.executeAndClearNextTickStack(e)}initializeElement(e,t,n=!0){e.hasAttribute("class")&&h(e,this).length>0&&(e.__x_original_classes=b(e.getAttribute("class"))),n&&this.registerListeners(e,t),this.resolveBoundAttributes(e,!0,t)}updateElements(e,t=(()=>{})){this.walkAndSkipNestedComponents(e,(e=>{if(void 0!==e.__x_for_key&&!e.isSameNode(this.$el))return!1;this.updateElement(e,t)}),(e=>{e.__x=new be(e)})),this.executeAndClearRemainingShowDirectiveStack(),this.executeAndClearNextTickStack(e)}executeAndClearNextTickStack(e){e===this.$el&&this.nextTickStack.length>0&&requestAnimationFrame((()=>{for(;this.nextTickStack.length>0;)this.nextTickStack.shift()()}))}executeAndClearRemainingShowDirectiveStack(){this.showDirectiveStack.reverse().map((e=>new Promise(((t,n)=>{e(t,n)})))).reduce(((e,t)=>e.then((()=>t.then((e=>{e()}))))),Promise.resolve((()=>{}))).catch((e=>{if(e!==_)throw e})),this.showDirectiveStack=[],this.showDirectiveLastElement=void 0}updateElement(e,t){this.resolveBoundAttributes(e,!1,t)}registerListeners(e,t){h(e,this).forEach((({type:i,value:r,modifiers:s,expression:o})=>{switch(i){case"on":N(this,e,r,s,o,t);break;case"model":!function(e,t,i,r,s){var o="select"===t.tagName.toLowerCase()||["checkbox","radio"].includes(t.type)||i.includes("lazy")?"change":"input";N(e,t,o,i,`${r} = rightSideOfExpression($event, ${r})`,(()=>n(n({},s()),{},{rightSideOfExpression:F(t,i,r)})))}(this,e,s,o,t)}}))}resolveBoundAttributes(e,t=!1,n){let i=h(e,this);i.forEach((({type:r,value:s,modifiers:a,expression:l})=>{switch(r){case"model":T(this,e,"value",l,n,r,a);break;case"bind":if("template"===e.tagName.toLowerCase()&&"key"===s)return;T(this,e,s,l,n,r,a);break;case"text":var c=this.evaluateReturnExpression(e,l,n);!function(e,t,n){void 0===t&&String(n).match(/\./)&&(t=""),e.textContent=t}(e,c,l);break;case"html":!function(e,t,n,i){t.innerHTML=e.evaluateReturnExpression(t,n,i)}(this,e,l,n);break;case"show":c=this.evaluateReturnExpression(e,l,n);!function(e,t,n,i,r=!1){const s=()=>{t.style.display="none",t.__x_is_shown=!1},o=()=>{1===t.style.length&&"none"===t.style.display?t.removeAttribute("style"):t.style.removeProperty("display"),t.__x_is_shown=!0};if(!0===r)return void(n?o():s());const a=(i,r)=>{n?(("none"===t.style.display||t.__x_transition)&&w(t,(()=>{o()}),r,e),i((()=>{}))):"none"!==t.style.display?E(t,(()=>{i((()=>{s()}))}),r,e):i((()=>{}))};i.includes("immediate")?a((e=>e()),(()=>{})):(e.showDirectiveLastElement&&!e.showDirectiveLastElement.contains(t)&&e.executeAndClearRemainingShowDirectiveStack(),e.showDirectiveStack.push(a),e.showDirectiveLastElement=t)}(this,e,c,a,t);break;case"if":if(i.some((e=>"for"===e.type)))return;c=this.evaluateReturnExpression(e,l,n);!function(e,t,n,i,r){o(t,"x-if");const s=t.nextElementSibling&&!0===t.nextElementSibling.__x_inserted_me;if(!n||s&&!t.__x_transition)!n&&s&&E(t.nextElementSibling,(()=>{t.nextElementSibling.remove()}),(()=>{}),e,i);else{const n=document.importNode(t.content,!0);t.parentElement.insertBefore(n,t.nextElementSibling),w(t.nextElementSibling,(()=>{}),(()=>{}),e,i),e.initializeElements(t.nextElementSibling,r),t.nextElementSibling.__x_inserted_me=!0}}(this,e,c,t,n);break;case"for":j(this,e,l,t,n);break;case"cloak":e.removeAttribute("x-cloak")}}))}evaluateReturnExpression(e,t,i=(()=>{})){return f(e,t,this.$data,n(n({},i()),{},{$dispatch:this.getDispatchFunction(e)}))}evaluateCommandExpression(e,t,i=(()=>{})){return function(e,t,n,i={}){return d((()=>{if("function"==typeof t)return Promise.resolve(t.call(n,i.$event));let e=Function;if(e=Object.getPrototypeOf((async function(){})).constructor,Object.keys(n).includes(t)){let e=new Function(["dataContext",...Object.keys(i)],`with(dataContext) { return ${t} }`)(n,...Object.values(i));return"function"==typeof e?Promise.resolve(e.call(n,i.$event)):Promise.resolve()}return Promise.resolve(new e(["dataContext",...Object.keys(i)],`with(dataContext) { ${t} }`)(n,...Object.values(i)))}),{el:e,expression:t})}(e,t,this.$data,n(n({},i()),{},{$dispatch:this.getDispatchFunction(e)}))}getDispatchFunction(e){return(t,n={})=>{e.dispatchEvent(new CustomEvent(t,{detail:n,bubbles:!0}))}}listenForNewElementsToInitialize(){const e=this.$el;new MutationObserver((e=>{for(let t=0;t<e.length;t++){const n=e[t].target.closest("[x-data]");if(n&&n.isSameNode(this.$el)){if("attributes"===e[t].type&&"x-data"===e[t].attributeName){const n=e[t].target.getAttribute("x-data")||"{}",i=f(this.$el,n,{$el:this.$el});Object.keys(i).forEach((e=>{this.$data[e]!==i[e]&&(this.$data[e]=i[e])}))}e[t].addedNodes.length>0&&e[t].addedNodes.forEach((e=>{1!==e.nodeType||e.__x_inserted_me||(!e.matches("[x-data]")||e.__x?this.initializeElements(e):e.__x=new be(e))}))}}})).observe(e,{childList:!0,attributes:!0,subtree:!0})}getRefsProxy(){var e=this;return new Proxy({},{get(t,n){return"$isAlpineProxy"===n||(e.walkAndSkipNestedComponents(e.$el,(e=>{e.hasAttribute("x-ref")&&e.getAttribute("x-ref")===n&&(i=e)})),i);var i}})}}const ge={version:"2.8.2",pauseMutationObserver:!1,magicProperties:{},onComponentInitializeds:[],onBeforeComponentInitializeds:[],ignoreFocusedForValueBinding:!1,start:async function(){r()||await new Promise((e=>{"loading"==document.readyState?document.addEventListener("DOMContentLoaded",e):e()})),this.discoverComponents((e=>{this.initializeComponent(e)})),document.addEventListener("turbolinks:load",(()=>{this.discoverUninitializedComponents((e=>{this.initializeComponent(e)}))})),this.listenForNewUninitializedComponentsAtRunTime()},discoverComponents:function(e){document.querySelectorAll("[x-data]").forEach((t=>{e(t)}))},discoverUninitializedComponents:function(e,t=null){const n=(t||document).querySelectorAll("[x-data]");Array.from(n).filter((e=>void 0===e.__x)).forEach((t=>{e(t)}))},listenForNewUninitializedComponentsAtRunTime:function(){const e=document.querySelector("body");new MutationObserver((e=>{if(!this.pauseMutationObserver)for(let t=0;t<e.length;t++)e[t].addedNodes.length>0&&e[t].addedNodes.forEach((e=>{1===e.nodeType&&(e.parentElement&&e.parentElement.closest("[x-data]")||this.discoverUninitializedComponents((e=>{this.initializeComponent(e)}),e.parentElement))}))})).observe(e,{childList:!0,attributes:!0,subtree:!0})},initializeComponent:function(e){if(!e.__x)try{e.__x=new be(e)}catch(e){setTimeout((()=>{throw e}),0)}},clone:function(e,t){t.__x||(t.__x=new be(t,e))},addMagicProperty:function(e,t){this.magicProperties[e]=t},onComponentInitialized:function(e){this.onComponentInitializeds.push(e)},onBeforeComponentInitialized:function(e){this.onBeforeComponentInitializeds.push(e)}};return r()||(window.Alpine=ge,window.deferLoadingAlpine?window.deferLoadingAlpine((function(){window.Alpine.start()})):window.Alpine.start()),ge}));
 //# sourceMappingURL=/sm/44afe343e2d1648d1350ab98ed40031d7c91d6246d1aa6dadb2f143c24a5612c.map

/* axios v0.19.2 | (c) 2020 by Matt Zabriskie */
!function(e,t){"object"==typeof exports&&"object"==typeof module?module.exports=t():"function"==typeof define&&define.amd?define([],t):"object"==typeof exports?exports.axios=t():e.axios=t()}(this,function(){return function(e){function t(n){if(r[n])return r[n].exports;var o=r[n]={exports:{},id:n,loaded:!1};return e[n].call(o.exports,o,o.exports,t),o.loaded=!0,o.exports}var r={};return t.m=e,t.c=r,t.p="",t(0)}([function(e,t,r){e.exports=r(1)},function(e,t,r){"use strict";function n(e){var t=new i(e),r=s(i.prototype.request,t);return o.extend(r,i.prototype,t),o.extend(r,t),r}var o=r(2),s=r(3),i=r(4),a=r(22),u=n(r(10));u.Axios=i,u.create=function(e){return n(a(u.defaults,e))},u.Cancel=r(23),u.CancelToken=r(24),u.isCancel=r(9),u.all=function(e){return Promise.all(e)},u.spread=r(25),e.exports=u,e.exports.default=u},function(e,t,r){"use strict";function n(e){return"[object Array]"===c.call(e)}function o(e){return void 0===e}function s(e){return null!==e&&"object"==typeof e}function i(e){return"[object Function]"===c.call(e)}function a(e,t){if(null!=e)if("object"!=typeof e&&(e=[e]),n(e))for(var r=0,o=e.length;r<o;r++)t.call(null,e[r],r,e);else for(var s in e)Object.prototype.hasOwnProperty.call(e,s)&&t.call(null,e[s],s,e)}var u=r(3),c=Object.prototype.toString;e.exports={isArray:n,isArrayBuffer:function(e){return"[object ArrayBuffer]"===c.call(e)},isBuffer:function(e){return null!==e&&!o(e)&&null!==e.constructor&&!o(e.constructor)&&"function"==typeof e.constructor.isBuffer&&e.constructor.isBuffer(e)},isFormData:function(e){return"undefined"!=typeof FormData&&e instanceof FormData},isArrayBufferView:function(e){return"undefined"!=typeof ArrayBuffer&&ArrayBuffer.isView?ArrayBuffer.isView(e):e&&e.buffer&&e.buffer instanceof ArrayBuffer},isString:function(e){return"string"==typeof e},isNumber:function(e){return"number"==typeof e},isObject:s,isUndefined:o,isDate:function(e){return"[object Date]"===c.call(e)},isFile:function(e){return"[object File]"===c.call(e)},isBlob:function(e){return"[object Blob]"===c.call(e)},isFunction:i,isStream:function(e){return s(e)&&i(e.pipe)},isURLSearchParams:function(e){return"undefined"!=typeof URLSearchParams&&e instanceof URLSearchParams},isStandardBrowserEnv:function(){return("undefined"==typeof navigator||"ReactNative"!==navigator.product&&"NativeScript"!==navigator.product&&"NS"!==navigator.product)&&"undefined"!=typeof window&&"undefined"!=typeof document},forEach:a,merge:function e(){function t(t,n){"object"==typeof r[n]&&"object"==typeof t?r[n]=e(r[n],t):r[n]=t}for(var r={},n=0,o=arguments.length;n<o;n++)a(arguments[n],t);return r},deepMerge:function e(){function t(t,n){"object"==typeof r[n]&&"object"==typeof t?r[n]=e(r[n],t):r[n]="object"==typeof t?e({},t):t}for(var r={},n=0,o=arguments.length;n<o;n++)a(arguments[n],t);return r},extend:function(e,t,r){return a(t,function(t,n){e[n]=r&&"function"==typeof t?u(t,r):t}),e},trim:function(e){return e.replace(/^\s*/,"").replace(/\s*$/,"")}}},function(e,t){"use strict";e.exports=function(e,t){return function(){for(var r=new Array(arguments.length),n=0;n<r.length;n++)r[n]=arguments[n];return e.apply(t,r)}}},function(e,t,r){"use strict";function n(e){this.defaults=e,this.interceptors={request:new i,response:new i}}var o=r(2),s=r(5),i=r(6),a=r(7),u=r(22);n.prototype.request=function(e){"string"==typeof e?(e=arguments[1]||{}).url=arguments[0]:e=e||{},(e=u(this.defaults,e)).method?e.method=e.method.toLowerCase():this.defaults.method?e.method=this.defaults.method.toLowerCase():e.method="get";var t=[a,void 0],r=Promise.resolve(e);for(this.interceptors.request.forEach(function(e){t.unshift(e.fulfilled,e.rejected)}),this.interceptors.response.forEach(function(e){t.push(e.fulfilled,e.rejected)});t.length;)r=r.then(t.shift(),t.shift());return r},n.prototype.getUri=function(e){return e=u(this.defaults,e),s(e.url,e.params,e.paramsSerializer).replace(/^\?/,"")},o.forEach(["delete","get","head","options"],function(e){n.prototype[e]=function(t,r){return this.request(o.merge(r||{},{method:e,url:t}))}}),o.forEach(["post","put","patch"],function(e){n.prototype[e]=function(t,r,n){return this.request(o.merge(n||{},{method:e,url:t,data:r}))}}),e.exports=n},function(e,t,r){"use strict";function n(e){return encodeURIComponent(e).replace(/%40/gi,"@").replace(/%3A/gi,":").replace(/%24/g,"$").replace(/%2C/gi,",").replace(/%20/g,"+").replace(/%5B/gi,"[").replace(/%5D/gi,"]")}var o=r(2);e.exports=function(e,t,r){if(!t)return e;var s;if(r)s=r(t);else if(o.isURLSearchParams(t))s=t.toString();else{var i=[];o.forEach(t,function(e,t){null!=e&&(o.isArray(e)?t+="[]":e=[e],o.forEach(e,function(e){o.isDate(e)?e=e.toISOString():o.isObject(e)&&(e=JSON.stringify(e)),i.push(n(t)+"="+n(e))}))}),s=i.join("&")}if(s){var a=e.indexOf("#");-1!==a&&(e=e.slice(0,a)),e+=(-1===e.indexOf("?")?"?":"&")+s}return e}},function(e,t,r){"use strict";function n(){this.handlers=[]}var o=r(2);n.prototype.use=function(e,t){return this.handlers.push({fulfilled:e,rejected:t}),this.handlers.length-1},n.prototype.eject=function(e){this.handlers[e]&&(this.handlers[e]=null)},n.prototype.forEach=function(e){o.forEach(this.handlers,function(t){null!==t&&e(t)})},e.exports=n},function(e,t,r){"use strict";function n(e){e.cancelToken&&e.cancelToken.throwIfRequested()}var o=r(2),s=r(8),i=r(9),a=r(10);e.exports=function(e){return n(e),e.headers=e.headers||{},e.data=s(e.data,e.headers,e.transformRequest),e.headers=o.merge(e.headers.common||{},e.headers[e.method]||{},e.headers),o.forEach(["delete","get","head","post","put","patch","common"],function(t){delete e.headers[t]}),(e.adapter||a.adapter)(e).then(function(t){return n(e),t.data=s(t.data,t.headers,e.transformResponse),t},function(t){return i(t)||(n(e),t&&t.response&&(t.response.data=s(t.response.data,t.response.headers,e.transformResponse))),Promise.reject(t)})}},function(e,t,r){"use strict";var n=r(2);e.exports=function(e,t,r){return n.forEach(r,function(r){e=r(e,t)}),e}},function(e,t){"use strict";e.exports=function(e){return!(!e||!e.__CANCEL__)}},function(e,t,r){"use strict";function n(e,t){!o.isUndefined(e)&&o.isUndefined(e["Content-Type"])&&(e["Content-Type"]=t)}var o=r(2),s=r(11),i={"Content-Type":"application/x-www-form-urlencoded"},a={adapter:function(){var e;return"undefined"!=typeof XMLHttpRequest?e=r(12):"undefined"!=typeof process&&"[object process]"===Object.prototype.toString.call(process)&&(e=r(12)),e}(),transformRequest:[function(e,t){return s(t,"Accept"),s(t,"Content-Type"),o.isFormData(e)||o.isArrayBuffer(e)||o.isBuffer(e)||o.isStream(e)||o.isFile(e)||o.isBlob(e)?e:o.isArrayBufferView(e)?e.buffer:o.isURLSearchParams(e)?(n(t,"application/x-www-form-urlencoded;charset=utf-8"),e.toString()):o.isObject(e)?(n(t,"application/json;charset=utf-8"),JSON.stringify(e)):e}],transformResponse:[function(e){if("string"==typeof e)try{e=JSON.parse(e)}catch(e){}return e}],timeout:0,xsrfCookieName:"XSRF-TOKEN",xsrfHeaderName:"X-XSRF-TOKEN",maxContentLength:-1,validateStatus:function(e){return e>=200&&e<300},headers:{common:{Accept:"application/json, text/plain"}}};o.forEach(["delete","get","head"],function(e){a.headers[e]={}}),o.forEach(["post","put","patch"],function(e){a.headers[e]=o.merge(i)}),e.exports=a},function(e,t,r){"use strict";var n=r(2);e.exports=function(e,t){n.forEach(e,function(r,n){n!==t&&n.toUpperCase()===t.toUpperCase()&&(e[t]=r,delete e[n])})}},function(e,t,r){"use strict";var n=r(2),o=r(13),s=r(5),i=r(16),a=r(19),u=r(20),c=r(14);e.exports=function(e){return new Promise(function(t,f){var p=e.data,d=e.headers;n.isFormData(p)&&delete d["Content-Type"];var l=new XMLHttpRequest;if(e.auth){var h=e.auth.username||"",m=e.auth.password||"";d.Authorization="Basic "+btoa(h+":"+m)}var y=i(e.baseURL,e.url);if(l.open(e.method.toUpperCase(),s(y,e.params,e.paramsSerializer),!0),l.timeout=e.timeout,l.onreadystatechange=function(){if(l&&4===l.readyState&&(0!==l.status||l.responseURL&&0===l.responseURL.indexOf("file:"))){var r="getAllResponseHeaders"in l?a(l.getAllResponseHeaders()):null,n={data:e.responseType&&"text"!==e.responseType?l.response:l.responseText,status:l.status,statusText:l.statusText,headers:r,config:e,request:l};o(t,f,n),l=null}},l.onabort=function(){l&&(f(c("Request aborted",e,"ECONNABORTED",l)),l=null)},l.onerror=function(){f(c("Network Error",e,null,l)),l=null},l.ontimeout=function(){var t="timeout of "+e.timeout+"ms exceeded";e.timeoutErrorMessage&&(t=e.timeoutErrorMessage),f(c(t,e,"ECONNABORTED",l)),l=null},n.isStandardBrowserEnv()){var g=r(21),v=(e.withCredentials||u(y))&&e.xsrfCookieName?g.read(e.xsrfCookieName):void 0;v&&(d[e.xsrfHeaderName]=v)}if("setRequestHeader"in l&&n.forEach(d,function(e,t){void 0===p&&"content-type"===t.toLowerCase()?delete d[t]:l.setRequestHeader(t,e)}),n.isUndefined(e.withCredentials)||(l.withCredentials=!!e.withCredentials),e.responseType)try{l.responseType=e.responseType}catch(t){if("json"!==e.responseType)throw t}"function"==typeof e.onDownloadProgress&&l.addEventListener("progress",e.onDownloadProgress),"function"==typeof e.onUploadProgress&&l.upload&&l.upload.addEventListener("progress",e.onUploadProgress),e.cancelToken&&e.cancelToken.promise.then(function(e){l&&(l.abort(),f(e),l=null)}),void 0===p&&(p=null),l.send(p)})}},function(e,t,r){"use strict";var n=r(14);e.exports=function(e,t,r){var o=r.config.validateStatus;!o||o(r.status)?e(r):t(n("Request failed with status code "+r.status,r.config,null,r.request,r))}},function(e,t,r){"use strict";var n=r(15);e.exports=function(e,t,r,o,s){var i=new Error(e);return n(i,t,r,o,s)}},function(e,t){"use strict";e.exports=function(e,t,r,n,o){return e.config=t,r&&(e.code=r),e.request=n,e.response=o,e.isAxiosError=!0,e.toJSON=function(){return{message:this.message,name:this.name,description:this.description,number:this.number,fileName:this.fileName,lineNumber:this.lineNumber,columnNumber:this.columnNumber,stack:this.stack,config:this.config,code:this.code}},e}},function(e,t,r){"use strict";var n=r(17),o=r(18);e.exports=function(e,t){return e&&!n(t)?o(e,t):t}},function(e,t){"use strict";e.exports=function(e){return/^([a-z][a-z\d\+\-\.]*:)?\/\//i.test(e)}},function(e,t){"use strict";e.exports=function(e,t){return t?e.replace(/\/+$/,"")+"/"+t.replace(/^\/+/,""):e}},function(e,t,r){"use strict";var n=r(2),o=["age","authorization","content-length","content-type","etag","expires","from","host","if-modified-since","if-unmodified-since","last-modified","location","max-forwards","proxy-authorization","referer","retry-after","user-agent"];e.exports=function(e){var t,r,s,i={};return e?(n.forEach(e.split("\n"),function(e){if(s=e.indexOf(":"),t=n.trim(e.substr(0,s)).toLowerCase(),r=n.trim(e.substr(s+1)),t){if(i[t]&&o.indexOf(t)>=0)return;i[t]="set-cookie"===t?(i[t]?i[t]:[]).concat([r]):i[t]?i[t]+", "+r:r}}),i):i}},function(e,t,r){"use strict";var n=r(2);e.exports=n.isStandardBrowserEnv()?function(){function e(e){var t=e;return r&&(o.setAttribute("href",t),t=o.href),o.setAttribute("href",t),{href:o.href,protocol:o.protocol?o.protocol.replace(/:$/,""):"",host:o.host,search:o.search?o.search.replace(/^\?/,""):"",hash:o.hash?o.hash.replace(/^#/,""):"",hostname:o.hostname,port:o.port,pathname:"/"===o.pathname.charAt(0)?o.pathname:"/"+o.pathname}}var t,r=/(msie|trident)/i.test(navigator.userAgent),o=document.createElement("a");return t=e(window.location.href),function(r){var o=n.isString(r)?e(r):r;return o.protocol===t.protocol&&o.host===t.host}}():function(){return!0}},function(e,t,r){"use strict";var n=r(2);e.exports=n.isStandardBrowserEnv()?{write:function(e,t,r,o,s,i){var a=[];a.push(e+"="+encodeURIComponent(t)),n.isNumber(r)&&a.push("expires="+new Date(r).toGMTString()),n.isString(o)&&a.push("path="+o),n.isString(s)&&a.push("domain="+s),!0===i&&a.push("secure"),document.cookie=a.join("; ")},read:function(e){var t=document.cookie.match(new RegExp("(^|;\\s*)("+e+")=([^;]*)"));return t?decodeURIComponent(t[3]):null},remove:function(e){this.write(e,"",Date.now()-864e5)}}:{write:function(){},read:function(){return null},remove:function(){}}},function(e,t,r){"use strict";var n=r(2);e.exports=function(e,t){t=t||{};var r={},o=["url","method","params","data"],s=["headers","auth","proxy"],i=["baseURL","url","transformRequest","transformResponse","paramsSerializer","timeout","withCredentials","adapter","responseType","xsrfCookieName","xsrfHeaderName","onUploadProgress","onDownloadProgress","maxContentLength","validateStatus","maxRedirects","httpAgent","httpsAgent","cancelToken","socketPath"];n.forEach(o,function(e){void 0!==t[e]&&(r[e]=t[e])}),n.forEach(s,function(o){n.isObject(t[o])?r[o]=n.deepMerge(e[o],t[o]):void 0!==t[o]?r[o]=t[o]:n.isObject(e[o])?r[o]=n.deepMerge(e[o]):void 0!==e[o]&&(r[o]=e[o])}),n.forEach(i,function(n){void 0!==t[n]?r[n]=t[n]:void 0!==e[n]&&(r[n]=e[n])});var a=o.concat(s).concat(i),u=Object.keys(t).filter(function(e){return-1===a.indexOf(e)});return n.forEach(u,function(n){void 0!==t[n]?r[n]=t[n]:void 0!==e[n]&&(r[n]=e[n])}),r}},function(e,t){"use strict";function r(e){this.message=e}r.prototype.toString=function(){return"Cancel"+(this.message?": "+this.message:"")},r.prototype.__CANCEL__=!0,e.exports=r},function(e,t,r){"use strict";function n(e){if("function"!=typeof e)throw new TypeError("executor must be a function.");var t;this.promise=new Promise(function(e){t=e});var r=this;e(function(e){r.reason||(r.reason=new o(e),t(r.reason))})}var o=r(23);n.prototype.throwIfRequested=function(){if(this.reason)throw this.reason},n.source=function(){var e;return{token:new n(function(t){e=t}),cancel:e}},e.exports=n},function(e,t){"use strict";e.exports=function(e){return function(t){return e.apply(null,t)}}}])});


var createCookie = function(name, value, days) {
    var expires;
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}


function getCookie(c_name) {
    if (document.cookie.length > 0) {
        c_start = document.cookie.indexOf(c_name + "=");
        if (c_start != -1) {
            c_start = c_start + c_name.length + 1;
            c_end = document.cookie.indexOf(";", c_start);
            if (c_end == -1) {
                c_end = document.cookie.length;
            }
            return unescape(document.cookie.substring(c_start, c_end));
        }
    }
    return "";
}



/*header height*/
window.onresize = window.onload = function() {
    var bdhdhg = document.querySelector('body');
    var header = document.querySelector('#header')
    var height = header.clientHeight + 'px';
    bdhdhg.style.setProperty('--header', height)
  }
  
/*items*/
var root = document.documentElement;
const lists = document.querySelectorAll('.rspl');
lists.forEach(el => {
const listItems = el.querySelectorAll('.ctgr');
const n = el.children.length;
el.style.setProperty('--total', n);
});


/* change mode light dark */
const modeButton = document.querySelector('#mode-theme');
if(modeButton) {
    modeButton.addEventListener('click', ()=> {
		const mode = document.querySelector('#mode-theme-change');
		if(mode.classList.contains('fa-toggle-on')) {
			//Change to light
			console.log('light');
			document.getElementById('logo-theme-url').innerHTML = "";
			document.getElementById('logo-theme-url').innerHTML += torotube_Public.logoHeadDark;
			createCookie('mode_theme', 'light', 365);
			document.querySelector('html').classList.remove('dm-on');
			mode.classList.remove('fa-toggle-on');
			mode.classList.remove('co01-c');
		} else {
			//Change to dark
			console.log('dark');
			document.getElementById('logo-theme-url').innerHTML = "";
			document.getElementById('logo-theme-url').innerHTML += torotube_Public.logoHeadLight;
			createCookie('mode_theme', 'dark', 365);
			document.querySelector('html').classList.add('dm-on');
			mode.classList.add('fa-toggle-on');
			mode.classList.add('co01-c');
		}
	});
}


/* close player videos */
const btnplayer = document.querySelector('#player-inside-btn');
if(btnplayer) {
    btnplayer.addEventListener('click', ()=> {
		var myobj = document.getElementById("player-inside");
        myobj.remove();
	});
}


/* favorite */
var favorite = document.querySelector('#favorite-user');
if(favorite){
    favorite.addEventListener('click', function(e){
        e.preventDefault();
        var postid = document.querySelector('#content').getAttribute('data-post');
        var status = favorite.getAttribute('data-status');
        var params = new URLSearchParams();
        params.append('action', 'action_favorite');
        params.append('postid', postid);
        params.append('status', status);
        axios.post(torotube_Public.url, params)
        .then(function(res) {
            console.log(res);
            if(res.status == 200) {
                if(status == 'favorite') {
                    document.querySelector('#favorite-active').classList.add('far');
                    document.querySelector('#favorite-active').classList.remove('fa');
                    favorite.setAttribute('data-status', 'nofavorite');
                } else if(status == 'nofavorite') {
                    document.querySelector('#favorite-active').classList.remove('far');
                    document.querySelector('#favorite-active').classList.add('fa');
                    favorite.setAttribute('data-status', 'favorite');
                }
            }
        })
        .catch(function(err) {
            console.log(err);
        })
        .then(function() {
            console.log('ready');
        });
    });
}

/* favorite loop */
document.querySelectorAll('.favorite-user-loop').forEach(item => {
    item.addEventListener('click', event => {
        console.log('as');
        var postid = item.getAttribute('data-post');
        var status = item.getAttribute('data-status');
        var params = new URLSearchParams();
        params.append('action', 'action_favorite');
        params.append('postid', postid);
        params.append('status', status);
        axios.post(torotube_Public.url, params)
        .then(function(res) {
            if(status == 'favorite') {
                item.querySelector('.favorite-active').classList.add('far');
                item.querySelector('.favorite-active').classList.remove('fa');
                item.setAttribute('data-status', 'nofavorite');
            } else if(status == 'nofavorite') {
                item.querySelector('.favorite-active').classList.remove('far');
                item.querySelector('.favorite-active').classList.add('fa');
                item.setAttribute('data-status', 'favorite');
            }
        })
        .catch(function(err) {
            console.log(err);
        })
        .then(function() {
            console.log('ready');
        });
    })
});






/* watch later */
var watch = document.querySelector('#watch-user');
if(watch){
    watch.addEventListener('click', function(e){
        e.preventDefault();
        var postid = document.querySelector('#content').getAttribute('data-post');
        var status = watch.getAttribute('data-status');
        var params = new URLSearchParams();
        params.append('action', 'action_watch');
        params.append('postid', postid);
        params.append('status', status);
        axios.post(torotube_Public.url, params)
        .then(function(res) {
            if(res.status == 200) {
                if(status == 'watch') {
                    document.querySelector('#watch-active').classList.remove('fa-check');
                    document.querySelector('#watch-active').classList.add('fa-clock');
                    watch.setAttribute('data-status', 'nowatch');
                } else if(status == 'nowatch') {
                    document.querySelector('#watch-active').classList.add('fa-check');
                    document.querySelector('#watch-active').classList.remove('fa-clock');
                    watch.setAttribute('data-status', 'watch');
                }
            }
        })
        .catch(function(err) {
            console.log(err);
        })
        .then(function() {
            console.log('ready');
        });
    });
}


/* watch later loop */

document.querySelectorAll('.watch-user-loop').forEach(item => {
    item.addEventListener('click', event => {
        var postid = item.getAttribute('data-post');
        var status = item.getAttribute('data-status');
        var params = new URLSearchParams();
        params.append('action', 'action_watch');
        params.append('postid', postid);
        params.append('status', status);
        axios.post(torotube_Public.url, params)
        .then(function(res) {
            if(res.status == 200) {
                if(status == 'watch') {
                    item.querySelector('.watch-active').classList.add('far');
                    item.setAttribute('data-status', 'nowatch');
                } else if(status == 'nowatch') {
                    item.querySelector('.watch-active').classList.remove('far');
                    item.setAttribute('data-status', 'watch');
                }
            }
        })
        .catch(function(err) {
            console.log(err);
        })
        .then(function() {
            console.log('ready');
        });
    })
});



/* vote up post*/
var voteup = document.querySelector('#vote-up');
if(voteup){
    voteup.addEventListener('click', function(e){
        e.preventDefault();
        var postid = document.querySelector('#content').getAttribute('data-post');
        var ar = getCookie('vote_' + postid);
        if(ar != 1 ){
            var params = new URLSearchParams();
            params.append('action', 'action_vote_up');
            params.append('postid', postid);
            axios.post(torotube_Public.url, params)
            .then(function(res) {
                if(res.status == 200) {
                    document.querySelector('#num_vote_up').innerHTML = res.data.num;
                    createCookie('vote_' + postid , '1');
                }
            })
            .catch(function(err) {
                console.log(err);
            })
            .then(function() {
                console.log('ready');
            });
        }
    });
}



/* vote down */
var votedown = document.querySelector('#vote-down');
if(votedown){
    votedown.addEventListener('click', function(e){
        e.preventDefault();
        var postid = document.querySelector('#content').getAttribute('data-post');
        var ar = getCookie('vote_' + postid);
        if(ar != 1 ){
            var params = new URLSearchParams();
            params.append('action', 'action_vote_down');
            params.append('postid', postid);
            axios.post(torotube_Public.url, params)
            .then(function(res) {
                if(res.status == 200) {
                    document.querySelector('#num_vote_down').innerHTML = res.data.num;
                    createCookie('vote_' + postid , '1');
                }
            })
            .catch(function(err) {
                console.log(err);
            })
            .then(function() {
                console.log('ready');
            });
        }
    });
}

/* vote up tax*/
var voteuptax = document.querySelector('#vote-up-tax');
if(voteuptax){
    voteuptax.addEventListener('click', function(e){
        e.preventDefault();
        var postid = document.querySelector('#content').getAttribute('data-tax');
        var ar = getCookie('votetax_' + postid);
        if(ar != 1 ){
            var params = new URLSearchParams();
            params.append('action', 'action_vote_up_tax');
            params.append('postid', postid);
            axios.post(torotube_Public.url, params)
            .then(function(res) {
                if(res.status == 200) {
                    document.querySelector('#num_vote_up').innerHTML = res.data.num;
                    createCookie('votetax_' + postid , '1');
                }
            })
            .catch(function(err) {
                console.log(err);
            })
            .then(function() {
                console.log('ready');
            });
        }
    });
}

/* vote down tax*/
var votedowntax = document.querySelector('#vote-down-tax');
if(votedowntax){
    votedowntax.addEventListener('click', function(e){
        e.preventDefault();
        var postid = document.querySelector('#content').getAttribute('data-tax');
        var ar = getCookie('votetax_' + postid);
        if(ar != 1 ){
            var params = new URLSearchParams();
            params.append('action', 'action_vote_down_tax');
            params.append('postid', postid);
            axios.post(torotube_Public.url, params)
            .then(function(res) {
                if(res.status == 200) {
                    document.querySelector('#num_vote_down').innerHTML = res.data.num;
                    createCookie('votetax_' + postid , '1');
                }
            })
            .catch(function(err) {
                console.log(err);
            })
            .then(function() {
                console.log('ready');
            });
        }
    });
}

/* login */
var login = document.querySelector('#form-login');
if(login){
    login.addEventListener('submit', function(e){
        e.preventDefault();
        var name = document.querySelector('#form-login-names').value;
        var pass = document.querySelector('#form-login-pat').value;
        var params = new URLSearchParams();
        params.append('action', 'action_login');
        params.append('name', name);
        params.append('pass', pass);
        axios.post(torotube_Public.url, params)
        .then(function(res) {
            if(res.status == 200) {
                if(res.data.error == 'false') {
                    window.location.href = torotube_Public.redirect_login;
                } else {
                    console.log('error');
                }
            }
        })
        .catch(function(err) {
            console.log(err);
        })
        .then(function() {
            console.log('ready');
        });
    });
}

/* register */
var register = document.querySelector('#form-register-user');
if(register){
    register.addEventListener('submit', function(e){
        e.preventDefault();
        var name = document.querySelector('#form-register-names').value;
        var pass = document.querySelector('#form-register-passs').value;
        var email = document.querySelector('#form-register-emails').value;
        var params = new URLSearchParams();
        params.append('action', 'action_register');
        params.append('name', name);
        params.append('pass', pass);
        params.append('email', email);
        axios.post(torotube_Public.url, params)
        .then(function(res) {
            if(res.status == 200) {
                if(res.data.error == 'false') {
                    setTimeout(function(){ 
                        var parames = new URLSearchParams();
                        parames.append('name', name);
                        parames.append('pass', pass);
                        parames.append('action', 'action_login');
                        axios.post(torotube_Public.url, parames)
                        .then(function(resn) {
                            if(resn.status == 200) {
                                if(resn.data.error == 'false') {
                                    window.location.href = torotube_Public.redirect_login;
                                } else {
                                    console.log('error');
                                }
                            }
                        })
                        .catch(function(err) {
                            console.log(err);
                        })
                        .then(function() {
                            console.log('ready');
                        });
                    }, 500);
                } else {
                    console.log('error en login');
                }
            }
        })
        .catch(function(err) {
            console.log(err);
        })
        .then(function() {
            console.log('ready');
        });
    });
}


/* Filter Tax */
var filtertax = document.querySelector('#filter-tax');
if(filtertax){
    filtertax.addEventListener('change', function(e){
        e.preventDefault();
        if(filtertax.value == 'latest') {
            window.location.href = torotube_Public.urlCurrent;
        } else {
            window.location.href = torotube_Public.urlCurrent  + '?filter=' + filtertax.value;
        }
        
    });
}


/* SEARCH SUGGETS */
var inputsearch = document.querySelector('#tr_live_search');
if(inputsearch){
    inputsearch.addEventListener('search', function(e){
        e.preventDefault();
        var searchTerm = inputsearch.value;
        if (searchTerm.length < 3){
            document.querySelector('#list-search').classList.remove('dbim');
            document.querySelector('#list-search').innerHTML = "";
        }
    });

    inputsearch.addEventListener('keyup', function(e){
        e.preventDefault();
        document.querySelector('#list-search').innerHTML = "";
        var searchTerm = inputsearch.value;
        var params = new URLSearchParams();
        params.append('action', 'action_search_suggest');
        params.append('term', searchTerm);
        if (searchTerm.length > 2){
            axios.post(torotube_Public.url, params)
            .then(function(res) {
                if(res.status == 200) {
                    document.querySelector('#list-search').innerHTML = "";
                    var ar = res.data.list;
                    if(ar.length > 0){
                        ar.forEach( function(valor, indice, array) {
                            document.querySelector('#list-search').innerHTML += '<li><a href="">' + valor['name'] + '</a></li>';
                        });
                    } else {
                        document.querySelector('#list-search').innerHTML += '<li>No videos found</li>';
                    }
                    document.querySelector('#list-search').classList.add('dbim');
                }
            })
            .catch(function(err) {
                document.querySelector('#list-search').classList.remove('dbim');
                document.querySelector('#list-search').innerHTML = "";
            })
            .then(function() {
                console.log('ready');
            });
        } else {
            document.querySelector('#list-search').classList.remove('dbim');
            document.querySelector('#list-search').innerHTML = "";
        }
    });
}

/* changue player */

document.querySelectorAll('.pl-tk').forEach(item => {
    item.addEventListener('click', event => {
        var position = item.getAttribute('data-position');
        document.querySelector('#player-torotube').innerHTML = torotube_Public.player[position];
        
    })
});



/* LOAD MORE RELATED */
var related_more = document.querySelector('#related-more');
if(related_more) {
    related_more.addEventListener('click', function(e){
        e.preventDefault();
        document.querySelectorAll('.art-esp').forEach(item => {
            item.classList.remove('d-none');
        });
        related_more.remove();
    });
}


/* report form */
var report_form = document.querySelector('#form-report');
if(report_form){
    report_form.addEventListener('submit', function(e){
        e.preventDefault();
        var ide  = report_form.getAttribute('data-id');
        var desc = document.querySelector('#form-desc').value;
        
        var reasons = document.getElementsByName('report_reason');
        for (var i = 0, length = reasons.length; i < length; i++) {
            if (reasons[i].checked) {
                var reas = reasons[i].value;
            }
        }

        if( reas != undefined ||  desc != '' ) {
            
            var params = new URLSearchParams();
            params.append('action', 'action_reportform');
            params.append('desc', desc);
            params.append('reas', reas);
            params.append('ide', ide);
            axios.post(torotube_Public.url, params)
            .then(function(res) {
                if(res.status == 200) {
                    document.querySelector('#res-wrong-form').innerHTML = '<p class="f12 lime-c fwb">'+torotube_Public.text_report_sent_successfully+'</p>';
                }
            })
            .catch(function(err) {
                console.log(err);
            })
            .then(function() {
                console.log('ready');
            });

        } else {
            document.querySelector('#res-wrong-form').innerHTML = '<p class="f12 fire-c fwb">'+torotube_Public.text_somethings_wrong+'</p>';
        }
    });
}


/* edit profile */

var edit_profile = document.querySelector('#edit-user-profile');
if(edit_profile){
    edit_profile.addEventListener('submit', function(e){
        e.preventDefault();
        
        var button_send = document.querySelector('#submit-edit-profile');
        

        var pass   = document.querySelector('#pass').value;
        var named  = document.querySelector('#name').value;
        var userid = edit_profile.getAttribute('data-user');

        var alert = document.querySelector('#alert-res');
        if(alert) {
            alert.remove();
        }
        
        /* if(!pass || pass == ''){
            document.querySelector('#res-profile').innerHTML += '<span id="alert-res" class="fire-c f10 fwb">'+torotube_Public.text_enter_new_pass+'</span>';
            return;
        } */

        if( ( !pass || pass == '' ) && ( !named || named =='' )){
            document.querySelector('#res-profile').innerHTML += '<span id="alert-res" class="fire-c f10 fwb">'+torotube_Public.text_somethings_wrong+'</span>';
            return;
        }

        button_send.setAttribute('disabled', true);
            
        var params = new URLSearchParams();
        params.append('action', 'action_edit_profile');
        params.append('pass', pass);
        params.append('named', named);
        params.append('userid', userid);
        axios.post(torotube_Public.url, params)
        .then(function(res) {
           
            if(res.status == 200) {
                console.log(res.data);
                button_send.removeAttribute('disabled');
                document.querySelector('#res-profile').innerHTML += '<span id="alert-res" class="lime-c f10 fwb">'+torotube_Public.text_changes_saved_successfully+'</span>';
            }
        })
        .catch(function(err) {
            button_send.removeAttribute('disabled');
            document.querySelector('#res-profile').innerHTML += '<span id="alert-res" class="fire-c f10 fwb">'+torotube_Public.text_somethings_wrong+'</span>';
        })
        .then(function() {
            console.log('ready');
        });

       
    });
}


/* remove favorite and watcher of pages */

document.querySelectorAll('.dlt').forEach(item => {
    item.addEventListener('click', event => {
        
        var postid   = item.getAttribute('data-post');
        var posttype = item.getAttribute('data-type');
        
        var params = new URLSearchParams();
        params.append('action', 'action_remove_favorite');
        params.append('postid', postid);
        params.append('posttype', posttype);
        axios.post(torotube_Public.url, params)
        .then(function(res) {
            if(res.status == 200) {
                console.log(res.data);
                item.parentNode.parentNode.parentNode.remove();
            }
        })
        .catch(function(err) {
            console.log(err);
        })
        .then(function() {
            console.log('ready');
        });
    })
});


/* preview on loop */

if ("ontouchstart" in document) { 

    document.querySelectorAll('.loop-post').forEach(item => {
        
        item.addEventListener('touchstart', event => {

            document.querySelectorAll('.loop-post video').forEach(item => {
                if(item){
                    item.remove();
                }
            });

            vid = item.getAttribute('preview');
            if(vid){
                item.querySelector('figure').innerHTML += '<video src="'+vid+'" class="video-thumbnail" loop webkit-playsinline="true" playsinline="true" autoplay="true" muted=""></video>';
            }
        }), item.addEventListener('touchstart', event => {
                event.originalEvent.touches;
            })
    });
    
} else {
    document.querySelectorAll('.loop-post').forEach(item => {
        item.addEventListener('mouseenter', event => {
            vid = item.getAttribute('preview');
            if(vid){
                item.querySelector('figure').innerHTML += '<video src="'+vid+'" class="video-thumbnail" loop webkit-playsinline="true" playsinline="true" autoplay="true" muted=""></video>';
            }
        })
    });

    document.querySelectorAll('.loop-post').forEach(item => {
        item.addEventListener('mouseleave', event => {
         
           
                if(item.querySelector('video')){
                    item.querySelector('video').remove();
                }
            
        })
    });
}  



