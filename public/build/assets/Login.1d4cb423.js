import{u as g,i as m,d as i,b as o,f as s,w as u,F as f,o as n,H as V,a as t,g as k,e as y,n as _,L as E,l as C,h as w,j as S,t as B}from"./app.376df573.js";import{_ as F}from"./AuthenticationCard.c2ff816a.js";import{_ as L}from"./Button.5132c52c.js";import{_ as b}from"./Input.ccb38418.js";import{_ as h}from"./Label.4adefac4.js";const N=["onSubmit"],$=t("h2",{class:"font-poppins font-bold text-dark-blue-500 md:text-3xl text-lg mb-5"}," Iniciar Sesi\xF3n ",-1),j={class:"mt-4"},q={key:0,class:"mt-2"},H={class:"mt-3 list-disc list-inside text-sm text-red-600"},I=w(" \xBFOlvidaste tu contrase\xF1a? "),O=w(" Acceder "),T={__name:"Login",setup(U){const e=g({email:null,password:null,remember:!1}),c=m(()=>!e.email||!e.password),p=m(()=>S().props.value.errors),r=m(()=>Object.keys(p.value).length>0),x=()=>{e.transform(d=>({...d,remember:e.remember?"on":""})).post(route("login"),{onFinish:()=>e.reset("password")})};return(d,l)=>(n(),i(f,null,[o(s(V),{title:"Iniciar Sesion"}),o(F,null,{default:u(()=>[t("form",{onSubmit:C(x,["prevent"])},[$,t("div",null,[o(h,{for:"email",value:"Correo El\xE9ctronico"}),o(b,{id:"email",modelValue:s(e).email,"onUpdate:modelValue":l[0]||(l[0]=a=>s(e).email=a),type:"email",class:"mt-1 block w-full",hasErrors:s(r),required:"",autofocus:""},null,8,["modelValue","hasErrors"])]),t("div",j,[o(h,{for:"password",value:"Contrase\xF1a"}),o(b,{id:"password",modelValue:s(e).password,"onUpdate:modelValue":l[1]||(l[1]=a=>s(e).password=a),type:"password",class:"mt-1 block w-full",hasErrors:s(r),required:"",autocomplete:"current-password"},null,8,["modelValue","hasErrors"])]),s(r)?(n(),i("div",q,[t("ul",H,[(n(!0),i(f,null,k(s(p),(a,v)=>(n(),i("li",{key:v},B(a),1))),128))])])):y("",!0),t("div",{class:_(["flex justify-end mb-6",{"mt-6":!s(r)}])},[o(s(E),{href:d.route("password.request"),class:"text-sm text-blue-600 hover:opacity-75"},{default:u(()=>[I]),_:1},8,["href"])],2),o(L,{class:_({"opacity-25":s(e).processing||s(c)}),disabled:s(e).processing||s(c)},{default:u(()=>[O]),_:1},8,["class","disabled"])],40,N)]),_:1})],64))}};export{T as default};
