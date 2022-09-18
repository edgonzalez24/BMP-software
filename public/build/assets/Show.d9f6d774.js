import{_ as R}from"./AppLayout.b2424b02.js";import{_ as M}from"./Table.58415f89.js";import{_ as w}from"./Button.ef355720.js";import{_ as O}from"./Modal.ad381771.js";import{r as h,u as C,x as I,o as $,d as y,b as o,f as _,a as e,w as i,l as j,h as E,j as v,P as g,i as V,p as S,t as b,U as F,O as L,c as P,g as U,F as N}from"./app.11c57ce6.js";import{s as B}from"./index.3854ef05.js";import{_ as k}from"./Label.5212fba0.js";import{_ as T}from"./Input.fd4bdfec.js";import"./logo-updated.06118e35.js";const D=["onSubmit"],G=e("h2",{class:"font-semibold md:text-2xl text-lg text-dark-blue-500 leading-tight text-center"},"\xBFEsta seguro de eliminar a este usuario?",-1),H={class:"px-5"},A=e("p",{class:"mt-5 text-justify text-gray-400"}," Al eliminar a este miembro se borrar\xE1 permanentemente del sistema, por favor confirmar la acci\xF3n haciendo click en el bot\xF3n de 'Eliminar'. ",-1),z={class:"flex justify-end mt-5"},q={class:"w-auto flex flex-row space-x-4 justify-between"},W=E(" Cancelar "),Z=E(" Eliminar "),J={__name:"DeleteUser",props:{user:Number},emits:["close"],setup(p,{emit:f}){const a=p,c=h(!1),u=C(),r=window.route,x=I().appContext.config.globalProperties.$toast,l=()=>{c.value=!0,r&&u.get(r("delete.user",a.user),{onSuccess:()=>{x.success(v().props.value.flash.success,{position:g.BOTTOM_RIGHT,timeout:5e3})},onError:()=>{const d=v().props.value.errors;for(const t in d)Object.hasOwnProperty.call(d,t)&&x.error(d[t],{position:g.BOTTOM_RIGHT,timeout:5e3})},onFinish:()=>{f("close"),c.value=!1}})};return(d,t)=>($(),y("form",{onSubmit:j(l,["prevent"]),class:"py-8 px-5"},[o(_(B),{active:c.value},null,8,["active"]),G,e("div",H,[A,e("div",z,[e("div",q,[o(w,{background:"bg-transparente text-gray-300 focus:ring-transparent focus:border-transparent",type:"button",onClick:t[0]||(t[0]=s=>f("close"))},{default:i(()=>[W]),_:1}),o(w,{background:"bg-red-600 focus:ring-transparent focus:border-transparent",type:"submit"},{default:i(()=>[Z]),_:1})])])])],40,D))}},K=["onSubmit"],Q={class:"font-semibold text-2xl text-dark-blue-500 leading-tight text-center mb-5"},X={class:"mb-5"},Y={class:"mb-5"},ee={class:"mb-8"},te=e("path",{d:"M4.95 6.3L0 1.3L1.283 0L4.95 3.706L8.617 0L9.9 1.3L4.95 6.3Z",fill:"#A4AFB7"},null,-1),se=[te],oe={class:"capitalize"},ae={class:"flex justify-end mb-5"},ne={class:"w-auto flex flex-row space-x-4 justify-between"},le=E(" Cancelar "),re={__name:"FormUser",props:{isEdit:Boolean,user:Object},emits:["close"],setup(p,{emit:f}){const a=p,c=V(()=>v().props.value.roles),u=h(!1),r=I().appContext.config.globalProperties.$toast,x=t=>t&&t.length>0?c.value.find(s=>s.name===t[0]):null,l=C({name:a.isEdit&&a.user.name||null,email:a.isEdit&&a.user.email||null,role_id:a.isEdit&&x(a.user.user_role).id||null}),d=()=>{u.value=!0,a.isEdit?l.transform(t=>({...t,user_id:a.user.id})).post(route("change.role"),{onSuccess:()=>{r.success(v().props.value.flash.success,{position:g.BOTTOM_RIGHT,timeout:5e3}),f("close")},onError:()=>{const t=v().props.value.errors;for(const s in t)Object.hasOwnProperty.call(t,s)&&r.error(t[s],{position:g.BOTTOM_RIGHT,timeout:5e3})},onFinish:()=>{u.value=!1}}):l.post(route("invite.user"),{onSuccess:()=>{r.success(v().props.value.flash.success,{position:g.BOTTOM_RIGHT,timeout:5e3}),f("close")},onError:()=>{const t=v().props.value.errors;for(const s in t)Object.hasOwnProperty.call(t,s)&&r.error(t[s],{position:g.BOTTOM_RIGHT,timeout:5e3})},onFinish:()=>{u.value=!1}})};return(t,s)=>{const m=S("v-select");return $(),y("form",{class:"py-8 px-5",onSubmit:j(d,["prevent"])},[o(_(B),{active:u.value},null,8,["active"]),e("h2",Q,b(p.isEdit?"Editar usuario":"Invitar a usuario"),1),e("div",X,[o(k,{for:"name",value:"Nombre"}),o(T,{id:"name",modelValue:_(l).name,"onUpdate:modelValue":s[0]||(s[0]=n=>_(l).name=n),type:"text",class:"mt-1 block w-full",required:"",autofocus:"",onlyRead:p.isEdit},null,8,["modelValue","onlyRead"])]),e("div",Y,[o(k,{for:"email",value:"Correo Electr\xF3nico"}),o(T,{id:"email",modelValue:_(l).email,"onUpdate:modelValue":s[1]||(s[1]=n=>_(l).email=n),type:"email",class:"mt-1 block w-full",required:"",autofocus:"",onlyRead:p.isEdit},null,8,["modelValue","onlyRead"])]),e("div",ee,[o(k,{for:"rol",value:"Rol"}),o(m,{modelValue:_(l).role_id,"onUpdate:modelValue":s[2]||(s[2]=n=>_(l).role_id=n),options:_(c).length?_(c):[],reduce:n=>n.id,label:"name",placeholder:"Seleccionar un rol",class:"appearance-none capitalize"},{"open-indicator":i(({attributes:n})=>[($(),y("svg",F(n,{width:"10",height:"7",viewBox:"0 0 10 7",fill:"none",xmlns:"http://www.w3.org/2000/svg"}),se,16))]),option:i(({name:n})=>[e("span",oe,b(n),1)]),_:1},8,["modelValue","options","reduce"])]),e("div",ae,[e("div",ne,[o(w,{background:"bg-transparente text-gray-300 focus:ring-transparent focus:border-transparent",type:"button",onClick:s[3]||(s[3]=n=>f("close"))},{default:i(()=>[le]),_:1}),o(w,{type:"submit"},{default:i(()=>[E(b(p.isEdit?"Editar":"Invitar"),1)]),_:1})])])],40,K)}}},ie={class:"py-12 min-h-screen"},ce={class:"max-w-7xl mx-auto px-5 sm:px-6 lg:px-8"},ue={class:"flex justify-between items-center mb-5"},de=e("h2",{class:"font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight"}," Usuarios ",-1),me=E(" Invitar "),_e={class:"bg-white overflow-hidden shadow-xl rounded-lg min-h-base"},pe={class:"px-5"},fe={class:"mt-2"},xe={class:"text-center p-2 md:text-base text-xs"},he={class:"text-center p-2 md:text-base text-xs hidden lg:block break-words"},ve={class:"text-center p-2 md:text-base text-xs"},be=["href"],ge={class:"text-center p-2 md:text-base text-xs capitalize"},$e={class:"text-center p-2 md:text-base text-xs"},we={class:"flex justify-center"},ye={class:"flex flex-row space-x-4"},Ee=["onClick"],ke=["onClick"],Se={__name:"Show",props:{users:Object,roles:Array},setup(p){const f=h(["Nombre","Correo Electronico","Telefono","Rol","Acciones"]),a=h(!1),c=L({name:null,email:null,rol_id:null}),u=h(!1),r=()=>{u.value=!u.value},x=h(!1),l=h(0),d=()=>{x.value=!x.value};return(t,s)=>($(),P(R,{title:"Dashboard"},{default:i(()=>[o(O,{show:u.value,maxWidth:"lg",onClose:r},{default:i(()=>[o(re,{isEdit:a.value,user:c,onClose:r},null,8,["isEdit","user"])]),_:1},8,["show"]),o(O,{show:x.value,maxWidth:"lg",onClose:d},{default:i(()=>[o(J,{user:l.value,onClose:d},null,8,["user"])]),_:1},8,["show"]),e("div",ie,[e("div",ce,[e("div",ue,[de,o(w,{onClick:s[0]||(s[0]=m=>{r(),a.value=!1})},{default:i(()=>[me]),_:1})]),e("div",_e,[o(M,{header:f.value},{default:i(()=>[e("tbody",pe,[($(!0),y(N,null,U(p.users.data,m=>($(),y("tr",fe,[e("td",xe,b(m.name),1),e("td",he,b(m.email),1),e("td",ve,[e("a",{href:`tel:${m.telephone}`},b(m.telephone),9,be)]),e("td",ge,b(m.user_role[0]),1),e("td",$e,[e("div",we,[e("div",ye,[e("a",{onClick:n=>{r(),c=m,a.value=!0},class:"text-blue-500 font-medium cursor-pointer"},"Editar",8,Ee),e("a",{onClick:n=>{d(),l.value=m.id},class:"text-blue-500 font-medium cursor-pointer"},"Eliminar",8,ke)])])])]))),256))])]),_:1},8,["header"])])])])]),_:1}))}};export{Se as default};
