import{u as g,i as m,d as i,b as t,f as e,w as u,F as f,o as n,H as V,a as o,g as k,t as y,e as E,n as _,L as C,l as S,h as w,j as B}from"./app.11c57ce6.js";import{J as F}from"./AuthenticationCard.0a8fac98.js";import{_ as L}from"./Button.ef355720.js";import{_ as h}from"./Input.fd4bdfec.js";import{_ as b}from"./Label.5212fba0.js";import"./logo-updated.06118e35.js";import"./_plugin-vue_export-helper.cdc0426e.js";const N=["onSubmit"],j=o("h2",{class:"font-poppins font-bold text-dark-blue-500 md:text-2xl text-lg mb-5"}," Iniciar Sesi\xF3n ",-1),q={class:"mt-4"},$={key:0,class:"mt-2"},A={class:"mt-3 list-disc list-inside text-sm text-red-600"},H=w(" \xBFOlvidaste tu contrase\xF1a? "),I=w(" Acceder "),G={__name:"Login",setup(J){const s=g({email:null,password:null,remember:!1}),c=m(()=>!s.email||!s.password),p=m(()=>B().props.value.errors),a=m(()=>Object.keys(p.value).length>0),x=()=>{s.transform(d=>({...d,remember:s.remember?"on":""})).post(route("login"),{onFinish:()=>s.reset("password")})};return(d,l)=>(n(),i(f,null,[t(e(V),{title:"Iniciar Sesion"}),t(F,null,{default:u(()=>[o("form",{onSubmit:S(x,["prevent"])},[j,o("div",null,[t(b,{for:"email",value:"Correo El\xE9ctronico"}),t(h,{id:"email",modelValue:e(s).email,"onUpdate:modelValue":l[0]||(l[0]=r=>e(s).email=r),type:"email",class:"mt-1 block w-full",hasErrors:e(a),required:"",autofocus:""},null,8,["modelValue","hasErrors"])]),o("div",q,[t(b,{for:"password",value:"Contrase\xF1a"}),t(h,{id:"password",modelValue:e(s).password,"onUpdate:modelValue":l[1]||(l[1]=r=>e(s).password=r),type:"password",class:"mt-1 block w-full",hasErrors:e(a),required:"",autocomplete:"current-password"},null,8,["modelValue","hasErrors"])]),e(a)?(n(),i("div",$,[o("ul",A,[(n(!0),i(f,null,k(e(p),(r,v)=>(n(),i("li",{key:v},y(r),1))),128))])])):E("",!0),o("div",{class:_(["flex justify-end mb-6",{"mt-6":!e(a)}])},[t(e(C),{href:d.route("password.request"),class:"text-sm text-blue-600 hover:opacity-75"},{default:u(()=>[H]),_:1},8,["href"])],2),t(L,{class:_({"opacity-25":e(s).processing||e(c)}),disabled:e(s).processing||e(c)},{default:u(()=>[I]),_:1},8,["class","disabled"])],40,N)]),_:1})],64))}};export{G as default};
