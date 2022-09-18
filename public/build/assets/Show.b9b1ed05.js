import{i as O,R as B,r as c,u as y,c as $,w as g,o as k,b as o,f as t,a as e,t as S,d as q,n as V,l as I,h as T,j as m,P as x,p as N}from"./app.49d8581a.js";import{_ as U,g as j}from"./AppLayout.fffd5899.js";import{_ as d}from"./Label.584dfeaf.js";import{_ as u}from"./Input.578a7824.js";import{_ as M}from"./Button.9fa69eb0.js";import{s as R}from"./index.39c89ed0.js";import"./logo-updated.06118e35.js";const E=["onSubmit"],G={class:"max-w-7xl mx-auto py-10 px-5 sm:px-6 lg:px-8"},H=e("h1",{class:"font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight mb-5"}," Perfil ",-1),L={class:"bg-white overflow-hidden shadow-xl rounded-lg min-h-base px-5 py-10"},z={class:"flex justify-center"},F={class:"md:w-40 md:h-40 w-24 h-24 bg-dark-blue-500 rounded-full flex justify-center items-center"},A={class:"text-poppins text-white sm:text-3xl text-xl font-bold"},D={class:"flex flex-col md:flex-row md:space-x-6 mt-5 px-2"},J={class:"md:w-1/2 w-full mb-5"},K={class:"md:w-1/2 w-full mb-5"},Q={class:"md:w-1/2 w-full mb-5 md:pr-3 px-2"},W={class:"mt-5"},X=T(" Cambiar contrase\xF1a "),Y=e("path",{fill:"currentColor",d:"M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z"},null,-1),Z=[Y],ee={class:"md:w-1/2 w-full mb-5 md:pr-3"},se={class:"relative"},oe={class:"absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5"},te={class:"flex flex-col md:flex-row md:space-x-6 mt-5"},le={class:"md:w-1/2 w-full mb-5"},ae={class:"relative"},re={class:"absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5"},ne={class:"md:w-1/2 w-full mb-5"},ie={class:"relative"},de={class:"absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5"},ue={class:"w-48"},ce=T(" Actualizar "),be={__name:"Show",setup(me){const h=O(()=>m().props.value.user),p=B(),f=c(!1),r=c(!1),w=c(!1),_=c(!1),v=c(!1),n=y({_method:"PUT",email:h.value.email,name:h.value.name,telephone:h.value.telephone}),a=y({current_password:"",password:"",password_confirmation:""}),C=()=>{r.value=!r.value,r.value||(a.current_password="",a.password="",a.password_confirmation="")},P=()=>{f.value=!0,n.post(route("user-profile-information.update"),{errorBag:"updateProfileInformation",preserveScroll:!0,onSuccess:()=>{p.success(m().props.value.flash.success,{position:x.BOTTOM_RIGHT,timeout:5e3})},onError:()=>{const i=m().props.value.errors;for(const s in i)Object.hasOwnProperty.call(i,s)&&p.error(i[s],{position:x.BOTTOM_RIGHT,timeout:5e3})},onFinish:()=>{r.value||(f.value=!1)}}),r.value&&a.put(route("user-password.update"),{errorBag:"updatePassword",preserveScroll:!0,onSuccess:()=>{p.success(m().props.value.flash.success,{position:x.BOTTOM_RIGHT,timeout:5e3}),a.current_password="",a.password="",a.password_confirmation=""},onError:()=>{const i=m().props.value.errors.updatePassword;for(const s in i)Object.hasOwnProperty.call(i,s)&&p.error(i[s],{position:x.BOTTOM_RIGHT,timeout:7e3})},onFinish:()=>{f.value=!1}})};return(i,s)=>{const b=N("font-awesome-icon");return k(),$(U,null,{default:g(()=>[o(t(R),{active:f.value},null,8,["active"]),e("form",{onSubmit:I(P,["prevent"])},[e("div",G,[H,e("div",L,[e("div",z,[e("div",F,[e("p",A,S(t(j)(t(n).name)),1)])]),e("div",D,[e("div",J,[o(d,{for:"email",value:"Correo Electr\xF3nico"}),o(u,{id:"email",modelValue:t(n).email,"onUpdate:modelValue":s[0]||(s[0]=l=>t(n).email=l),type:"email",class:"mt-1 block w-full",required:"",autofocus:""},null,8,["modelValue"])]),e("div",K,[o(d,{for:"name",value:"Nombre"}),o(u,{id:"name",modelValue:t(n).name,"onUpdate:modelValue":s[1]||(s[1]=l=>t(n).name=l),type:"text",class:"mt-1 block w-full",required:"",autofocus:""},null,8,["modelValue"])])]),e("div",Q,[o(d,{for:"phone",value:"T\xE9lefono"}),o(u,{id:"phone",modelValue:t(n).telephone,"onUpdate:modelValue":s[2]||(s[2]=l=>t(n).telephone=l),type:"text",class:"mt-1 block w-full",autofocus:""},null,8,["modelValue"])]),e("div",W,[e("a",{class:"font-semibold md:text-xl text-base text-dark-blue-500 leading-tight mb-5 inline-flex items-center cursor-pointer px-2",onClick:C},[X,(k(),q("svg",{"aria-hidden":"true",focusable:"false","data-prefix":"fas","data-icon":"chevron-down",class:V(["w-5 h-5 ml-1",r.value?"efect-rotate-down":"efect-rotate-up"]),role:"img",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 448 512"},Z,2))]),e("div",{class:V([r.value?"transition-container-full":"transition-container","px-2"])},[e("div",ee,[o(d,{for:"current_password",value:"Contrase\xF1a Actual"}),e("div",se,[o(u,{id:"current_password",modelValue:t(a).current_password,"onUpdate:modelValue":s[3]||(s[3]=l=>t(a).current_password=l),type:_.value?"text":"password",class:"mt-1 block w-full",required:r.value,autofocus:""},null,8,["modelValue","type","required"]),e("div",oe,[o(b,{icon:`fa-solid ${_.value?"fa-eye":"fa-eye-slash"}`,class:"block text-base text-gray-400 cursor-pointer pl-2",onClick:s[4]||(s[4]=l=>_.value=!_.value)},null,8,["icon"])])])]),e("div",te,[e("div",le,[o(d,{for:"new_password",value:"Nueva Contrase\xF1a"}),e("div",ae,[o(u,{id:"new_password",modelValue:t(a).password,"onUpdate:modelValue":s[5]||(s[5]=l=>t(a).password=l),type:v.value?"text":"password",class:"mt-1 block w-full",required:r.value,autofocus:""},null,8,["modelValue","type","required"]),e("div",re,[o(b,{icon:`fa-solid ${v.value?"fa-eye":"fa-eye-slash"}`,class:"block text-base text-gray-400 cursor-pointer pl-2",onClick:s[6]||(s[6]=l=>v.value=!v.value)},null,8,["icon"])])])]),e("div",ne,[o(d,{for:"new_password_confirm",value:"Confirmar Nueva Contrase\xF1a"}),e("div",ie,[o(u,{id:"new_password_confirm",modelValue:t(a).password_confirmation,"onUpdate:modelValue":s[7]||(s[7]=l=>t(a).password_confirmation=l),type:w.value?"text":"password",class:"mt-1 block w-full",required:r.value,autofocus:""},null,8,["modelValue","type","required"]),e("div",de,[o(b,{icon:`fa-solid ${w.value?"fa-eye":"fa-eye-slash"}`,class:"block text-base text-gray-400 cursor-pointer pl-2",onClick:s[8]||(s[8]=l=>w.value=!w.value)},null,8,["icon"])])])])])],2)]),e("div",ue,[o(M,{type:"submit",class:"w-full flex justify-center"},{default:g(()=>[ce]),_:1})])])])],40,E)]),_:1})}}};export{be as default};
