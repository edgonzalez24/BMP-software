import{u as w,i,d as o,b as a,f as s,w as n,F as _,o as l,H as k,L as v,a as e,g as y,e as f,t as p,n as V,l as B,h,j as C}from"./app.376df573.js";import{_ as F}from"./AuthenticationCard.c2ff816a.js";import{_ as L}from"./Button.5132c52c.js";import{_ as N}from"./Input.ccb38418.js";import{_ as R}from"./Label.4adefac4.js";const S=e("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 320 512",class:"h-6 w-6 mr-2"},[e("path",{d:"M224 480c-8.188 0-16.38-3.125-22.62-9.375l-192-192c-12.5-12.5-12.5-32.75 0-45.25l192-192c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L77.25 256l169.4 169.4c12.5 12.5 12.5 32.75 0 45.25C240.4 476.9 232.2 480 224 480z"})],-1),$=h(" Regresar "),E=e("h2",{class:"font-poppins font-bold text-dark-blue-500 md:text-3xl text-lg mb-5"}," Recuperar contrase\xF1a ",-1),j=["onSubmit"],z={key:0,class:"mt-2"},H={class:"mt-3 text-sm text-dark-blue-500 font-medium"},M={key:1,class:"mt-2"},P={class:"mt-3 text-sm text-dark-blue-500 font-medium"},q={class:"mt-12"},D=h(" Recuperar "),J={__name:"ForgotPassword",props:{status:String},setup(m){const t=w({email:""}),c=i(()=>!t.email),u=i(()=>C().props.value.errors),b=i(()=>Object.keys(u.value).length>0),x=()=>{t.post(route("password.email"),{onFinish:()=>t.reset("email")})};return(O,d)=>(l(),o(_,null,[a(s(k),{title:"Recuperar contrase\xF1a"}),a(F,null,{default:n(()=>[a(s(v),{href:"/",class:"inline-flex mb-2"},{default:n(()=>[S,$]),_:1}),E,e("form",{onSubmit:B(x,["prevent"])},[e("div",null,[a(R,{for:"email",value:"Correo El\xE9ctronico",class:"mb-2"}),a(N,{id:"email",modelValue:s(t).email,"onUpdate:modelValue":d[0]||(d[0]=r=>s(t).email=r),type:"email",class:"mt-1 block w-full",required:"",autofocus:""},null,8,["modelValue"])]),s(b)?(l(),o("div",z,[e("ul",H,[(l(!0),o(_,null,y(s(u),(r,g)=>(l(),o("li",{key:g},p(r),1))),128))])])):f("",!0),m.status?(l(),o("div",M,[e("ul",P,[e("li",null,p(m.status),1)])])):f("",!0),e("div",q,[a(L,{class:V({"opacity-25":s(t).processing||s(c)}),disabled:s(t).processing||s(c)},{default:n(()=>[D]),_:1},8,["class","disabled"])])],40,j)]),_:1})],64))}};export{J as default};
