import{i as C,o as h,d as w,a as e,t as r,q as A,G as N,f as o,D as B,n as F,J as U,r as v,u as V,c as T,w as n,b as t,h as x,l as E,g as P,F as q}from"./app.e1a2adef.js";import{_ as L}from"./AppLayout.a09aeef9.js";import{_ as f}from"./Button.7b30fa47.js";import{s as W}from"./index.f38b7ee4.js";import{_ as M}from"./Modal.a1e8304c.js";import{_ as g}from"./Label.8537854e.js";import{_ as $}from"./Input.0229338a.js";import{_ as z}from"./Table.b89a4ea2.js";import{_ as G}from"./Pagination.8a6617a9.js";import"./logo-updated.06118e35.js";const J={class:"w-full relative inline-flex"},O={class:"relative mr-3"},R={class:"text-gray-500 text-sm"},H={class:"flex items-center cursor-pointer"},K={class:"relative"},Q=e("div",{class:"toggle__line w-10 h-4 rounded-full shadow-inner bg-gray-100"},null,-1),X=e("div",{class:"toggle__dot absolute w-6 h-6 bg-white rounded-full shadow inset-y-0 left-0"},null,-1),Y=e("div",{class:"ml-3 text-dark font-medium"},null,-1),Z={class:"relative ml-1"},ee={class:"text-gray-500 text-sm"},te={__name:"Toggle",props:{checked:Boolean,label:Boolean},emits:["update:checked"],setup(l,{emit:d}){const _=l,u=C({get(){return _.checked},set(c){console.log(c),d("update:checked",c)}});return(c,m)=>(h(),w("div",J,[e("div",O,[e("p",R,r(l.label?"No":"Inactivo"),1)]),e("label",H,[e("div",K,[A(e("input",{"onUpdate:modelValue":m[0]||(m[0]=p=>B(u)?u.value=p:null),type:"checkbox",class:"hidden"},null,512),[[N,o(u)]]),Q,X]),Y]),e("div",Z,[e("p",ee,r(l.label?"Si":"Activo"),1)])]))}},se={__name:"Status",props:{status:Number},setup(l){const d=l,_=C(()=>d.status===1?"text-green-700 bg-green-300":"text-red-700 bg-red-300");return(u,c)=>(h(),w("div",{class:F(["text-xs rounded-full px-1 py-0.5",o(_)])},r(l.status===1?"Activo":"Inactivo"),3))}},oe=["onSubmit"],le={class:"font-semibold text-2xl text-dark-blue-500 leading-tight text-center mb-5"},ae={class:"mb-5"},ne={class:"mb-5"},ie={class:"mb-5"},re={class:"mb-5"},ce={class:"flex justify-end mb-5"},de={class:"w-auto flex flex-row space-x-4 justify-between"},ue=x(" Cancelar "),me=e("h2",{class:"font-semibold text-2xl text-dark-blue-500 leading-tight text-center mb-5"}," Eliminar Proveedor ",-1),_e={class:"px-5"},pe=e("p",{class:"mt-5 text-justify text-gray-400"}," Al eliminar a este proveedor se borrar\xE1 permanentemente del sistema, por favor confirmar la acci\xF3n haciendo click en el bot\xF3n de 'Eliminar'. ",-1),fe={class:"flex justify-end mt-5"},he={class:"w-auto flex flex-row space-x-4 justify-between"},xe=x(" Cancelar "),be=x(" Eliminar "),ve={class:"min-h-screen"},ge={class:"max-w-7xl mx-auto px-5 sm:px-6 lg:px-8"},we={class:"flex justify-between items-center my-5"},ye=e("h2",{class:"font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight"}," Proveedores ",-1),ke=x(" A\xF1adir "),$e={class:"bg-white overflow-hidden shadow-xl rounded-lg min-h-base"},Ce={class:"px-5"},Ve={class:"mt-2"},Ee={class:"text-center p-2 md:text-base text-xs"},Me={class:"text-center p-2 md:text-base text-xs"},je=["href"],De={class:"text-center p-2 md:text-base text-xs"},Ie={class:"flex justify-center"},Se={class:"text-center p-2 md:text-base text-xs hidden lg:block"},Ae={class:"text-center p-2 md:text-base text-xs"},Ne={class:"flex justify-center"},Be={class:"flex flex-row space-x-4"},Fe=["onClick"],Ue={class:"flex mt-8 justify-center"},He={__name:"Show",props:{suppliers:Object},setup(l){const d=l,_=U([{name:"Nombre",showInMobile:!0},{name:"Tel\xE9fono",showInMobile:!0},{name:"Estado",showInMobile:!0},{name:"Correo Electr\xF3nico",showInMobile:!1},{name:"Acciones",showInMobile:!0}]),u=v(!1),c=v(!1),m=v(!1),p=v(!1),i=V({name:null,telephone:null,email:null,active:!0}),j=V({id:null}),y=()=>{m.value=!m.value},k=()=>{p.value=!p.value},D=b=>{j.id=b.id,k()},I=C(()=>Math.ceil(d.suppliers.total/d.suppliers.per_page));return(b,a)=>(h(),T(L,null,{default:n(()=>[t(o(W),{active:u.value},null,8,["active"]),t(M,{show:m.value,maxWidth:"lg",onClose:y},{default:n(()=>[e("form",{class:"py-8 px-5",onSubmit:E(s=>!0,["prevent"])},[e("h2",le,r(c.value?"Editar proveedor":"A\xF1adir proveedor"),1),e("div",ae,[t(g,{for:"name",value:"Status"}),t(te,{checked:o(i).active,"onUpdate:checked":a[0]||(a[0]=s=>o(i).active=s)},null,8,["checked"])]),e("div",ne,[t(g,{for:"name",value:"Nombre"}),t($,{id:"name",modelValue:o(i).name,"onUpdate:modelValue":a[1]||(a[1]=s=>o(i).name=s),type:"text",class:"mt-1 block w-full",required:"",autofocus:""},null,8,["modelValue"])]),e("div",ie,[t(g,{for:"name",value:"T\xE9lefono"}),t($,{id:"name",modelValue:o(i).telephone,"onUpdate:modelValue":a[2]||(a[2]=s=>o(i).telephone=s),type:"text",class:"mt-1 block w-full",autofocus:""},null,8,["modelValue"])]),e("div",re,[t(g,{for:"name",value:"Correo Electr\xF3nico"}),t($,{id:"name",modelValue:o(i).email,"onUpdate:modelValue":a[3]||(a[3]=s=>o(i).email=s),type:"email",class:"mt-1 block w-full",autofocus:""},null,8,["modelValue"])]),e("div",ce,[e("div",de,[t(f,{background:"bg-transparente text-gray-300 focus:ring-transparent focus:border-transparent",type:"button",onClick:y},{default:n(()=>[ue]),_:1}),t(f,{type:"submit"},{default:n(()=>[x(r(c.value?"Editar":"A\xF1adir"),1)]),_:1})])])],40,oe)]),_:1},8,["show"]),t(M,{show:p.value,maxWidth:"lg",onClose:k},{default:n(()=>[e("form",{class:"py-8 px-5",onSubmit:a[4]||(a[4]=E((...s)=>b.submitDelete&&b.submitDelete(...s),["prevent"]))},[me,e("div",_e,[pe,e("div",fe,[e("div",he,[t(f,{background:"bg-transparente text-gray-300 focus:ring-transparent focus:border-transparent",type:"button",onClick:k},{default:n(()=>[xe]),_:1}),t(f,{background:"bg-red-600 focus:ring-transparent focus:border-transparent",type:"submit"},{default:n(()=>[be]),_:1})])])])],32)]),_:1},8,["show"]),e("div",ve,[e("div",ge,[e("div",we,[ye,t(f,{onClick:y},{default:n(()=>[ke]),_:1})]),e("div",$e,[t(z,{header:_},{default:n(()=>[e("tbody",Ce,[(h(!0),w(q,null,P(l.suppliers.data,s=>(h(),w("tr",Ve,[e("td",Ee,r(s.name),1),e("td",Me,[e("a",{href:`tel:${s.telephone}`},r(s.telephone),9,je)]),e("td",De,[e("div",Ie,[t(se,{status:s.active,class:"sm:w-1/2 md:w-1/3 w-full"},null,8,["status"])])]),e("td",Se,r(s.email),1),e("td",Ae,[e("div",Ne,[e("div",Be,[e("a",{onClick:S=>!0,class:"text-blue-500 font-medium cursor-pointer"},"Editar"),e("a",{onClick:S=>D(s),class:"text-blue-500 font-medium cursor-pointer"},"Eliminar",8,Fe)])])])]))),256))])]),_:1},8,["header"])]),e("div",Ue,[t(G,{total:o(I),previous:l.suppliers.prev_page_url,next:l.suppliers.next_page_url,page:"suppliers"},null,8,["total","previous","next"])])])])]),_:1}))}};export{He as default};