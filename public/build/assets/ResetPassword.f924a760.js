import{u as k,i as d,d as i,b as e,f as s,w as _,F as w,o as n,H as v,a as t,g,t as x,e as C,n as E,l as y,h as S,j as B}from"./app.6bf1cdd5.js";import{J as F}from"./AuthenticationCard.a60e3647.js";import{_ as N}from"./Button.4378d5c9.js";import{_ as m}from"./Input.3f69c69d.js";import{_ as c}from"./Label.cd503b58.js";import"./logo-updated.06118e35.js";import"./_plugin-vue_export-helper.cdc0426e.js";const R=t("h2",{class:"font-poppins font-bold text-dark-blue-500 md:text-2xl text-lg mb-5"}," Reestablecer contrase\xF1a ",-1),q=["onSubmit"],U={class:"mt-4"},$={class:"mt-4"},j={key:0,class:"mt-2"},H={class:"mt-3 list-disc list-inside text-sm text-red-600"},J={class:"mt-8"},P=S(" Reestablecer Contrase\xF1a "),I={__name:"ResetPassword",props:{email:String,token:String},setup(b){const p=b,o=k({token:p.token,email:p.email,password:"",password_confirmation:""}),u=d(()=>!o.email||!o.password||!o.password_confirmation),f=d(()=>B().props.value.errors),l=d(()=>Object.keys(f.value).length>0),h=()=>{o.post(route("password.update"),{onFinish:()=>o.reset("password","password_confirmation")})};return(z,r)=>(n(),i(w,null,[e(s(v),{title:"Reestablecer Contrase\xF1a"}),e(F,null,{default:_(()=>[R,t("form",{onSubmit:y(h,["prevent"])},[t("div",null,[e(c,{for:"email",value:"Correo El\xE9ctronico"}),e(m,{id:"email",modelValue:s(o).email,"onUpdate:modelValue":r[0]||(r[0]=a=>s(o).email=a),hasErrors:s(l),type:"email",class:"mt-1 block w-full",required:"",autofocus:""},null,8,["modelValue","hasErrors"])]),t("div",U,[e(c,{for:"password",value:"Contrase\xF1a"}),e(m,{id:"password",modelValue:s(o).password,"onUpdate:modelValue":r[1]||(r[1]=a=>s(o).password=a),hasErrors:s(l),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"new-password"},null,8,["modelValue","hasErrors"])]),t("div",$,[e(c,{for:"password_confirmation",value:"Confirmar Contrase\xF1a"}),e(m,{id:"password_confirmation",modelValue:s(o).password_confirmation,"onUpdate:modelValue":r[2]||(r[2]=a=>s(o).password_confirmation=a),hasErrors:s(l),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"new-password"},null,8,["modelValue","hasErrors"])]),s(l)?(n(),i("div",j,[t("ul",H,[(n(!0),i(w,null,g(s(f),(a,V)=>(n(),i("li",{key:V},x(a),1))),128))])])):C("",!0),t("div",J,[e(N,{class:E({"opacity-25":s(o).processing||s(u)}),disabled:s(o).processing||s(u)},{default:_(()=>[P]),_:1},8,["class","disabled"])])],40,q)]),_:1})],64))}};export{I as default};
