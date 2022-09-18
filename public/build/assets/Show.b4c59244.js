import{o as n,d as x,b as t,w as a,f as i,L as w,F as $,g as L,c as O,h as p,t as u,n as A,a as e,r as d,x as E,u as N,l as B,j as k,P as C}from"./app.11c57ce6.js";import{_ as M}from"./AppLayout.b2424b02.js";import{_ as y}from"./Button.ef355720.js";import{_ as T}from"./Table.58415f89.js";import{_ as F}from"./Modal.ad381771.js";import{_ as I}from"./Label.5212fba0.js";import{_ as V}from"./Input.fd4bdfec.js";import{s as z}from"./index.3854ef05.js";import"./logo-updated.06118e35.js";const R={class:"relative z-0 inline-flex rounded-md shadow-sm","aria-label":"Pagination"},U=e("svg",{"aria-hidden":"true",focusable:"false","data-prefix":"fas","data-icon":"chevron-left",class:"h-5 w-5",role:"img",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 320 512"},[e("path",{class:"fill-current text-gray-500",d:"M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z"})],-1),D=e("svg",{"aria-hidden":"true",focusable:"false","data-prefix":"fas","data-icon":"chevron-right",class:"h-5 w-5",role:"img",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 320 512"},[e("path",{class:"fill-current text-gray-500",fill:"currentColor",d:"M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"})],-1),G={__name:"Pagination",props:{total:Number,next:String,previous:String,page:String},emits:["next","previous","page"],setup(s,{emit:v}){const b=()=>new URLSearchParams(window.location.search).has("page")?Number(new URLSearchParams(window.location.search).get("page")):1;return(m,l)=>(n(),x("div",R,[t(i(w),{class:"bg-white relative inline-flex items-center w-10 h-10 justify-center border text-sm font-medium border-gray-300 cursor-pointer hover:bg-gray-100 transition duration-300 ease-in-out",href:s.previous},{default:a(()=>[U]),_:1},8,["href"]),(n(!0),x($,null,L(Array.from({length:s.total}),(f,r)=>(n(),O(i(w),{key:r,class:A(["z-10 bg-white relative inline-flex items-center px-4 py-2 border text-sm font-medium border-gray-300 cursor-pointer hover:bg-gray-100 transition duration-300 ease-in-out",b()===r+1?"border-dark-blue-500 text-dark-blue-500 ":"text-gray-400"]),href:m.route(s.page,{page:r+1})},{default:a(()=>[p(u(r+1),1)]),_:2},1032,["class","href"]))),128)),t(i(w),{class:"bg-white relative inline-flex items-center w-10 h-10 justify-center border text-sm font-medium border-gray-300 cursor-pointer hover:bg-gray-100 transition duration-300 ease-in-out",href:s.next},{default:a(()=>[D]),_:1},8,["href"])]))}},H=["onSubmit"],q={class:"font-semibold text-2xl text-dark-blue-500 leading-tight text-center mb-5"},W={class:"mb-5"},J={class:"flex justify-end mb-5"},K={class:"w-auto flex flex-row space-x-4 justify-between"},Q=p(" Cancelar "),X={class:"min-h-screen"},Y={class:"max-w-7xl mx-auto px-5 sm:px-6 lg:px-8"},Z={class:"flex justify-between items-center my-5"},ee=e("h2",{class:"font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight"}," Categorias ",-1),te=p(" Crear "),se={class:"bg-white overflow-hidden shadow-xl rounded-lg min-h-base"},ae={class:"px-5"},re={class:"mt-2"},oe={class:"text-center p-2 md:text-base text-xs"},ie={class:"text-center p-2 md:text-base text-xs"},ne={class:"text-center p-2 md:text-base text-xs"},le={class:"flex justify-center"},ce={class:"flex flex-row space-x-4"},de={class:"flex mt-8 justify-center"},be={__name:"Show",props:{categoryArticle:Object},setup(s){const v=s,b=d(["ID","Nombre","Acciones"]),m=E().appContext.config.globalProperties.$toast,l=d(!1),f=d(!1),r=d(!1);d(1);const S=Math.ceil(v.categoryArticle.total/v.categoryArticle.per_page),g=N({name:null}),h=()=>{f.value=!f.value},j=()=>{r.value=!0,l.value||g.post(route("category.save"),{onSuccess:()=>{m.success(k().props.value.flash.success,{position:C.BOTTOM_RIGHT,timeout:5e3}),h(),g.reset()},onError:()=>{const _=k().props.value.errors;for(const o in _)Object.hasOwnProperty.call(_,o)&&m.error(_[o],{position:C.BOTTOM_RIGHT,timeout:5e3})},onFinish:()=>{r.value=!1}})};return(_,o)=>(n(),O(M,null,{default:a(()=>[t(i(z),{active:r.value},null,8,["active"]),t(F,{show:f.value,maxWidth:"lg",onClose:h},{default:a(()=>[e("form",{class:"py-8 px-5",onSubmit:B(j,["prevent"])},[e("h2",q,u(l.value?"Editar categoria":"Nueva categoria"),1),e("div",W,[t(I,{for:"name",value:"Nombre"}),t(V,{id:"name",modelValue:i(g).name,"onUpdate:modelValue":o[0]||(o[0]=c=>i(g).name=c),type:"text",class:"mt-1 block w-full",required:"",autofocus:""},null,8,["modelValue"])]),e("div",J,[e("div",K,[t(y,{background:"bg-transparente text-gray-300 focus:ring-transparent focus:border-transparent",type:"button",onClick:h},{default:a(()=>[Q]),_:1}),t(y,{type:"submit"},{default:a(()=>[p(u(l.value?"Editar":"Crear"),1)]),_:1})])])],40,H)]),_:1},8,["show"]),e("div",X,[e("div",Y,[e("div",Z,[ee,t(y,{onClick:o[1]||(o[1]=c=>{h(),l.value=!1})},{default:a(()=>[te]),_:1})]),e("div",se,[t(T,{header:b.value},{default:a(()=>[e("tbody",ae,[(n(!0),x($,null,L(s.categoryArticle.data,c=>(n(),x("tr",re,[e("td",oe,u(c.id),1),e("td",ie,u(c.name),1),e("td",ne,[e("div",le,[e("div",ce,[e("a",{onClick:P=>!0,class:"text-blue-500 font-medium cursor-pointer"},"Editar"),e("a",{onClick:P=>!0,class:"text-blue-500 font-medium cursor-pointer"},"Eliminar")])])])]))),256))])]),_:1},8,["header"])]),e("div",de,[t(G,{total:i(S),previous:s.categoryArticle.prev_page_url,next:s.categoryArticle.next_page_url,page:"categories"},null,8,["total","previous","next"])])])])]),_:1}))}};export{be as default};