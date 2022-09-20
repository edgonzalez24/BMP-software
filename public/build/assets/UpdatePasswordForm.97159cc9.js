import{r as i,u as w,c as f,w as e,o as V,a as d,b as r,f as o,n as g,h as n}from"./app.49d8581a.js";import{_ as v}from"./ActionMessage.e06bd3c4.js";import{_ as y}from"./Button.9fa69eb0.js";import{_ as P}from"./FormSection.815c14f7.js";import{_ as l}from"./Input.578a7824.js";import{_ as p}from"./InputError.d5011931.js";import{_ as c}from"./Label.584dfeaf.js";import"./SectionTitle.4cfd78ff.js";import"./_plugin-vue_export-helper.cdc0426e.js";const b=n(" Update Password "),k=n(" Ensure your account is using a long, random password to stay secure. "),S={class:"col-span-6 sm:col-span-4"},$={class:"col-span-6 sm:col-span-4"},U={class:"col-span-6 sm:col-span-4"},h=n(" Saved. "),x=n(" Save "),D={__name:"UpdatePasswordForm",setup(B){const u=i(null),m=i(null),s=w({current_password:"",password:"",password_confirmation:""}),_=()=>{s.put(route("user-password.update"),{errorBag:"updatePassword",preserveScroll:!0,onSuccess:()=>s.reset(),onError:()=>{s.errors.password&&(s.reset("password","password_confirmation"),u.value.focus()),s.errors.current_password&&(s.reset("current_password"),m.value.focus())}})};return(C,a)=>(V(),f(P,{onSubmitted:_},{title:e(()=>[b]),description:e(()=>[k]),form:e(()=>[d("div",S,[r(c,{for:"current_password",value:"Current Password"}),r(l,{id:"current_password",ref_key:"currentPasswordInput",ref:m,modelValue:o(s).current_password,"onUpdate:modelValue":a[0]||(a[0]=t=>o(s).current_password=t),type:"password",class:"mt-1 block w-full",autocomplete:"current-password"},null,8,["modelValue"]),r(p,{message:o(s).errors.current_password,class:"mt-2"},null,8,["message"])]),d("div",$,[r(c,{for:"password",value:"New Password"}),r(l,{id:"password",ref_key:"passwordInput",ref:u,modelValue:o(s).password,"onUpdate:modelValue":a[1]||(a[1]=t=>o(s).password=t),type:"password",class:"mt-1 block w-full",autocomplete:"new-password"},null,8,["modelValue"]),r(p,{message:o(s).errors.password,class:"mt-2"},null,8,["message"])]),d("div",U,[r(c,{for:"password_confirmation",value:"Confirm Password"}),r(l,{id:"password_confirmation",modelValue:o(s).password_confirmation,"onUpdate:modelValue":a[2]||(a[2]=t=>o(s).password_confirmation=t),type:"password",class:"mt-1 block w-full",autocomplete:"new-password"},null,8,["modelValue"]),r(p,{message:o(s).errors.password_confirmation,class:"mt-2"},null,8,["message"])])]),actions:e(()=>[r(v,{on:o(s).recentlySuccessful,class:"mr-3"},{default:e(()=>[h]),_:1},8,["on"]),r(y,{class:g({"opacity-25":o(s).processing}),disabled:o(s).processing},{default:e(()=>[x]),_:1},8,["class","disabled"])]),_:1}))}};export{D as default};
