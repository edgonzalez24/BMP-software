import{u as w,i,d as o,b as a,f as e,w as n,F as _,o as r,H as k,L as v,a as s,g as y,t as p,e as f,n as V,l as C,h,j as B}from"./app.8ee23448.js";import{J as F}from"./AuthenticationCard.6f516b2b.js";import{_ as L}from"./Button.77f76b96.js";import{_ as N}from"./Input.c6c64d85.js";import{_ as R}from"./Label.ef2b1ada.js";import"./logo-updated.06118e35.js";import"./_plugin-vue_export-helper.cdc0426e.js";const S=s("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 320 512",class:"h-6 w-6 mr-2"},[s("path",{d:"M224 480c-8.188 0-16.38-3.125-22.62-9.375l-192-192c-12.5-12.5-12.5-32.75 0-45.25l192-192c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L77.25 256l169.4 169.4c12.5 12.5 12.5 32.75 0 45.25C240.4 476.9 232.2 480 224 480z"})],-1),E=h(" Regresar "),$=s("h2",{class:"font-poppins font-bold text-dark-blue-500 md:text-2xl text-lg mb-5"}," Recuperar contrase\xF1a ",-1),j=["onSubmit"],z={key:0,class:"mt-2"},H={class:"mt-3 text-sm text-dark-blue-500 font-medium"},J={key:1,class:"mt-2"},M={class:"mt-3 text-sm text-dark-blue-500 font-medium"},P={class:"mt-12"},q=h(" Recuperar "),Q={__name:"ForgotPassword",props:{status:String},setup(m){const t=w({email:""}),c=i(()=>!t.email),u=i(()=>B().props.value.errors),b=i(()=>Object.keys(u.value).length>0),x=()=>{t.post(route("password.email"),{onFinish:()=>t.reset("email")})};return(A,d)=>(r(),o(_,null,[a(e(k),{title:"Recuperar contrase\xF1a"}),a(F,null,{default:n(()=>[a(e(v),{href:"/",class:"inline-flex mb-2"},{default:n(()=>[S,E]),_:1}),$,s("form",{onSubmit:C(x,["prevent"])},[s("div",null,[a(R,{for:"email",value:"Correo El\xE9ctronico",class:"mb-2"}),a(N,{id:"email",modelValue:e(t).email,"onUpdate:modelValue":d[0]||(d[0]=l=>e(t).email=l),type:"email",class:"mt-1 block w-full",required:"",autofocus:""},null,8,["modelValue"])]),e(b)?(r(),o("div",z,[s("ul",H,[(r(!0),o(_,null,y(e(u),(l,g)=>(r(),o("li",{key:g},p(l),1))),128))])])):f("",!0),m.status?(r(),o("div",J,[s("ul",M,[s("li",null,p(m.status),1)])])):f("",!0),s("div",P,[a(L,{class:V({"opacity-25":e(t).processing||e(c)}),disabled:e(t).processing||e(c)},{default:n(()=>[q]),_:1},8,["class","disabled"])])],40,j)]),_:1})],64))}};export{Q as default};
