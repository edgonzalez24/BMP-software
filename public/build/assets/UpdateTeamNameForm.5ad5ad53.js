import{u,c as f,S as p,w as t,o as h,b as o,f as m,n as v,a as s,t as c,h as n}from"./app.8ee23448.js";import{_ as b}from"./ActionMessage.2aa2fb5b.js";import{_ as g}from"./Button.77f76b96.js";import{_ as w}from"./FormSection.9b227af8.js";import{_ as T}from"./Input.c6c64d85.js";import{_ as x}from"./InputError.d95dde0f.js";import{_ as l}from"./Label.ef2b1ada.js";import"./SectionTitle.7dbfdd0d.js";import"./_plugin-vue_export-helper.cdc0426e.js";const N=n(" Team Name "),S=n(" The team's name and owner information. "),V={class:"col-span-6"},$={class:"flex items-center mt-2"},y=["src","alt"],B={class:"ml-4 leading-tight"},U={class:"text-gray-700 text-sm"},j={class:"col-span-6 sm:col-span-4"},k=n(" Saved. "),O=n(" Save "),J={__name:"UpdateTeamNameForm",props:{team:Object,permissions:Object},setup(e){const i=e,a=u({name:i.team.name}),d=()=>{a.put(route("teams.update",i.team),{errorBag:"updateTeamName",preserveScroll:!0})};return(C,r)=>(h(),f(w,{onSubmitted:d},p({title:t(()=>[N]),description:t(()=>[S]),form:t(()=>[s("div",V,[o(l,{value:"Team Owner"}),s("div",$,[s("img",{class:"w-12 h-12 rounded-full object-cover",src:e.team.owner.profile_photo_url,alt:e.team.owner.name},null,8,y),s("div",B,[s("div",null,c(e.team.owner.name),1),s("div",U,c(e.team.owner.email),1)])])]),s("div",j,[o(l,{for:"name",value:"Team Name"}),o(T,{id:"name",modelValue:m(a).name,"onUpdate:modelValue":r[0]||(r[0]=_=>m(a).name=_),type:"text",class:"mt-1 block w-full",disabled:!e.permissions.canUpdateTeam},null,8,["modelValue","disabled"]),o(x,{message:m(a).errors.name,class:"mt-2"},null,8,["message"])])]),_:2},[e.permissions.canUpdateTeam?{name:"actions",fn:t(()=>[o(b,{on:m(a).recentlySuccessful,class:"mr-3"},{default:t(()=>[k]),_:1},8,["on"]),o(g,{class:v({"opacity-25":m(a).processing}),disabled:m(a).processing},{default:t(()=>[O]),_:1},8,["class","disabled"])])}:void 0]),1024))}};export{J as default};
