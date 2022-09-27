import{J as P,x as D,r as x,i as N,u as C,c as G,w as a,o as O,b as o,f as h,a as e,t as g,h as f,l as T,d as I,g as H,F as R,j as u,P as d}from"./app.6bf1cdd5.js";import{_ as V}from"./AppLayout.685b876a.js";import{_}from"./Button.4378d5c9.js";import{_ as L}from"./Table.39f423de.js";import{_ as M}from"./Modal.2762babc.js";import{_ as W}from"./Label.cd503b58.js";import{_ as q}from"./Input.3f69c69d.js";import{s as J}from"./index.a109a2fd.js";import{_ as U}from"./Pagination.e5715db6.js";import"./logo-updated.06118e35.js";const z=["onSubmit"],K={class:"font-semibold text-2xl text-dark-blue-500 leading-tight text-center mb-5"},Q={class:"mb-5"},X={class:"flex justify-end mb-5"},Y={class:"w-auto flex flex-row space-x-4 justify-between"},Z=f(" Cancelar "),ee=["onSubmit"],te=e("h2",{class:"font-semibold text-2xl text-dark-blue-500 leading-tight text-center mb-5"}," Eliminar Categoria ",-1),se={class:"px-5"},oe=e("p",{class:"mt-5 text-justify text-gray-400"}," Al eliminar a esta categoria se borrar\xE1 permanentemente del sistema, por favor confirmar la acci\xF3n haciendo click en el bot\xF3n de 'Eliminar'. ",-1),ae={class:"flex justify-end mt-5"},re={class:"w-auto flex flex-row space-x-4 justify-between"},ne=f(" Cancelar "),ie=f(" Eliminar "),le={class:"min-h-screen"},ce={class:"max-w-7xl mx-auto px-5 sm:px-6 lg:px-8"},ue={class:"flex justify-between items-center my-5"},de=e("h2",{class:"font-semibold md:text-3xl text-xl text-dark-blue-500 leading-tight"}," Categorias ",-1),me=f(" Crear "),_e={class:"bg-white overflow-hidden shadow-xl rounded-lg min-h-base"},fe={class:"px-5"},pe={class:"mt-2"},xe={class:"text-center p-2 md:text-base text-xs"},he={class:"text-center p-2 md:text-base text-xs"},ge={class:"text-center p-2 md:text-base text-xs"},be={class:"flex justify-center"},ve={class:"flex flex-row space-x-4"},ye=["onClick"],we=["onClick"],Oe={class:"flex mt-8 justify-center"},Ae={__name:"Show",props:{categoryArticle:Object},setup(p){const k=p,E=P([{name:"ID",showInMobile:!0},{name:"Nombre",showInMobile:!0},{name:"Acciones",showInMobile:!0}]),i=D().appContext.config.globalProperties.$toast,m=x(!1),l=x(!1),j=N(()=>Math.ceil(k.categoryArticle.total/k.categoryArticle.per_page)),r=C({name:null,category_id:null}),b=C({id:null}),v=x(!1),y=x(!1),c=()=>{v.value=!v.value},w=()=>{y.value=!y.value},$=t=>{r.name=t.name,r.category_id=t.id,m.value=!0,c()},B=t=>{b.id=t.id,w()},S=()=>{l.value=!0,m.value?r.post(route("category.change"),{onSuccess:()=>{i.success(u().props.value.flash.success,{position:d.BOTTOM_RIGHT,timeout:5e3}),c(),r.reset()},onError:()=>{const t=u().props.value.errors;for(const s in t)Object.hasOwnProperty.call(t,s)&&i.error(t[s],{position:d.BOTTOM_RIGHT,timeout:5e3})},onFinish:()=>{l.value=!1}}):r.post(route("category.save"),{onSuccess:()=>{i.success(u().props.value.flash.success,{position:d.BOTTOM_RIGHT,timeout:5e3}),c(),r.reset()},onError:()=>{const t=u().props.value.errors;for(const s in t)Object.hasOwnProperty.call(t,s)&&i.error(t[s],{position:d.BOTTOM_RIGHT,timeout:5e3})},onFinish:()=>{l.value=!1}})},A=()=>{l.value=!0,b.get(route("category.delete",b.id),{onSuccess:()=>{i.success(u().props.value.flash.success,{position:d.BOTTOM_RIGHT,timeout:5e3})},onError:()=>{const t=u().props.value.errors;for(const s in t)Object.hasOwnProperty.call(t,s)&&i.error(t[s],{position:d.BOTTOM_RIGHT,timeout:5e3})},onFinish:()=>{l.value=!1}})};return(t,s)=>(O(),G(V,null,{default:a(()=>[o(h(J),{active:l.value},null,8,["active"]),o(M,{show:v.value,maxWidth:"lg",onClose:c},{default:a(()=>[e("form",{class:"py-8 px-5",onSubmit:T(S,["prevent"])},[e("h2",K,g(m.value?"Editar categoria":"Nueva categoria"),1),e("div",Q,[o(W,{for:"name",value:"Nombre"}),o(q,{id:"name",modelValue:h(r).name,"onUpdate:modelValue":s[0]||(s[0]=n=>h(r).name=n),type:"text",class:"mt-1 block w-full",required:"",autofocus:""},null,8,["modelValue"])]),e("div",X,[e("div",Y,[o(_,{background:"bg-transparente text-gray-300 focus:ring-transparent focus:border-transparent",type:"button",onClick:c},{default:a(()=>[Z]),_:1}),o(_,{type:"submit"},{default:a(()=>[f(g(m.value?"Editar":"Crear"),1)]),_:1})])])],40,z)]),_:1},8,["show"]),o(M,{show:y.value,maxWidth:"lg",onClose:w},{default:a(()=>[e("form",{class:"py-8 px-5",onSubmit:T(A,["prevent"])},[te,e("div",se,[oe,e("div",ae,[e("div",re,[o(_,{background:"bg-transparente text-gray-300 focus:ring-transparent focus:border-transparent",type:"button",onClick:w},{default:a(()=>[ne]),_:1}),o(_,{background:"bg-red-600 focus:ring-transparent focus:border-transparent",type:"submit"},{default:a(()=>[ie]),_:1})])])])],40,ee)]),_:1},8,["show"]),e("div",le,[e("div",ce,[e("div",ue,[de,o(_,{onClick:s[1]||(s[1]=n=>{c(),m.value=!1})},{default:a(()=>[me]),_:1})]),e("div",_e,[o(L,{header:E},{default:a(()=>[e("tbody",fe,[(O(!0),I(R,null,H(p.categoryArticle.data,n=>(O(),I("tr",pe,[e("td",xe,g(n.id),1),e("td",he,g(n.name),1),e("td",ge,[e("div",be,[e("div",ve,[e("a",{onClick:F=>$(n),class:"text-blue-500 font-medium cursor-pointer"},"Editar",8,ye),e("a",{onClick:F=>B(n),class:"text-blue-500 font-medium cursor-pointer"},"Eliminar",8,we)])])])]))),256))])]),_:1},8,["header"])]),e("div",Oe,[o(U,{total:h(j),previous:p.categoryArticle.prev_page_url,next:p.categoryArticle.next_page_url,page:"categories"},null,8,["total","previous","next"])])])])]),_:1}))}};export{Ae as default};
