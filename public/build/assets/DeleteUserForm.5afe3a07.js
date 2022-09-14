import{r as u,u as f,c as y,w as e,o as w,a as c,b as t,f as a,K as h,n as v,h as s}from"./app.29c54f81.js";import{_ as k}from"./ActionSection.7f3a3afc.js";import{_ as x}from"./DialogModal.0075d541.js";import{_ as m}from"./DangerButton.aa5507ac.js";import{_ as g}from"./Input.95b21071.js";import{_ as C}from"./InputError.6343f2aa.js";import{_ as D}from"./SecondaryButton.934257e8.js";import"./SectionTitle.5490fd64.js";import"./_plugin-vue_export-helper.cdc0426e.js";import"./Modal.d418aaef.js";const b=s(" Delete Account "),V=s(" Permanently delete your account. "),$=c("div",{class:"max-w-xl text-sm text-gray-600"}," Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain. ",-1),A={class:"mt-5"},U=s(" Delete Account "),B=s(" Delete Account "),K=s(" Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account. "),F={class:"mt-4"},N=s(" Cancel "),P=s(" Delete Account "),L={__name:"DeleteUserForm",setup(I){const r=u(!1),n=u(null),o=f({password:""}),_=()=>{r.value=!0,setTimeout(()=>n.value.focus(),250)},i=()=>{o.delete(route("current-user.destroy"),{preserveScroll:!0,onSuccess:()=>l(),onError:()=>n.value.focus(),onFinish:()=>o.reset()})},l=()=>{r.value=!1,o.reset()};return(O,d)=>(w(),y(k,null,{title:e(()=>[b]),description:e(()=>[V]),content:e(()=>[$,c("div",A,[t(m,{onClick:_},{default:e(()=>[U]),_:1})]),t(x,{show:r.value,onClose:l},{title:e(()=>[B]),content:e(()=>[K,c("div",F,[t(g,{ref_key:"passwordInput",ref:n,modelValue:a(o).password,"onUpdate:modelValue":d[0]||(d[0]=p=>a(o).password=p),type:"password",class:"mt-1 block w-3/4",placeholder:"Password",onKeyup:h(i,["enter"])},null,8,["modelValue","onKeyup"]),t(C,{message:a(o).errors.password,class:"mt-2"},null,8,["message"])])]),footer:e(()=>[t(D,{onClick:l},{default:e(()=>[N]),_:1}),t(m,{class:v(["ml-3",{"opacity-25":a(o).processing}]),disabled:a(o).processing,onClick:i},{default:e(()=>[P]),_:1},8,["class","disabled"])]),_:1},8,["show"])]),_:1}))}};export{L as default};