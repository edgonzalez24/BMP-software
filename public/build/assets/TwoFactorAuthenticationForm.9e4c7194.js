import{r as _,M as H,o as t,d as s,a as i,m as I,b as a,w as o,h as n,t as C,K as R,n as x,z as N,u as Q,i as Y,k as z,c as y,f as h,e as u,F as D,g as U,j,s as A}from"./app.29c54f81.js";import{_ as G}from"./ActionSection.7f3a3afc.js";import{_ as $}from"./Button.8fe6b133.js";import{_ as O}from"./DialogModal.0075d541.js";import{_ as B}from"./Input.95b21071.js";import{_ as M}from"./InputError.6343f2aa.js";import{_ as S}from"./SecondaryButton.934257e8.js";import{_ as W}from"./DangerButton.aa5507ac.js";import{_ as J}from"./Label.49e3d504.js";import"./SectionTitle.5490fd64.js";import"./_plugin-vue_export-helper.cdc0426e.js";import"./Modal.d418aaef.js";const X={class:"mt-4"},Z=n(" Cancel "),w={__name:"ConfirmsPassword",props:{title:{type:String,default:"Confirm Password"},content:{type:String,default:"For your security, please confirm your password to continue."},button:{type:String,default:"Confirm"}},emits:["confirmed"],setup(g,{emit:b}){const c=_(!1),e=H({password:"",error:"",processing:!1}),l=_(null),v=()=>{axios.get(route("password.confirmation")).then(r=>{r.data.confirmed?b("confirmed"):(c.value=!0,setTimeout(()=>l.value.focus(),250))})},p=()=>{e.processing=!0,axios.post(route("password.confirm"),{password:e.password}).then(()=>{e.processing=!1,d(),N().then(()=>b("confirmed"))}).catch(r=>{e.processing=!1,e.error=r.response.data.errors.password[0],l.value.focus()})},d=()=>{c.value=!1,e.password="",e.error=""};return(r,m)=>(t(),s("span",null,[i("span",{onClick:v},[I(r.$slots,"default")]),a(O,{show:c.value,onClose:d},{title:o(()=>[n(C(g.title),1)]),content:o(()=>[n(C(g.content)+" ",1),i("div",X,[a(B,{ref_key:"passwordInput",ref:l,modelValue:e.password,"onUpdate:modelValue":m[0]||(m[0]=T=>e.password=T),type:"password",class:"mt-1 block w-3/4",placeholder:"Password",onKeyup:R(p,["enter"])},null,8,["modelValue","onKeyup"]),a(M,{message:e.error,class:"mt-2"},null,8,["message"])])]),footer:o(()=>[a(S,{onClick:d},{default:o(()=>[Z]),_:1}),a($,{class:x(["ml-3",{"opacity-25":e.processing}]),disabled:e.processing,onClick:p},{default:o(()=>[n(C(g.button),1)]),_:1},8,["class","disabled"])]),_:1},8,["show"])]))}},ee=n(" Two Factor Authentication "),te=n(" Add additional security to your account using two factor authentication. "),oe={key:0,class:"text-lg font-medium text-gray-900"},se={key:1,class:"text-lg font-medium text-gray-900"},ae={key:2,class:"text-lg font-medium text-gray-900"},ne=i("div",{class:"mt-3 max-w-xl text-sm text-gray-600"},[i("p",null," When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone's Google Authenticator application. ")],-1),re={key:3},ie={key:0},ce={class:"mt-4 max-w-xl text-sm text-gray-600"},le={key:0,class:"font-semibold"},ue={key:1},de=["innerHTML"],me={key:0,class:"mt-4 max-w-xl text-sm text-gray-600"},fe={class:"font-semibold"},_e=n(" Setup Key: "),pe=["innerHTML"],he={key:1,class:"mt-4"},ve={key:1},ye=i("div",{class:"mt-4 max-w-xl text-sm text-gray-600"},[i("p",{class:"font-semibold"}," Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost. ")],-1),we={class:"grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg"},ge={class:"mt-5"},xe={key:0},be=n(" Enable "),ke={key:1},Ce=n(" Confirm "),Se=n(" Regenerate Recovery Codes "),Te=n(" Show Recovery Codes "),Fe=n(" Cancel "),$e=n(" Disable "),Ne={__name:"TwoFactorAuthenticationForm",props:{requiresConfirmation:Boolean},setup(g){const b=g,c=_(!1),e=_(!1),l=_(!1),v=_(null),p=_(null),d=_([]),r=Q({code:""}),m=Y(()=>{var f;return!c.value&&((f=j().props.value.user)==null?void 0:f.two_factor_enabled)});z(m,()=>{m.value||(r.reset(),r.clearErrors())});const T=()=>{c.value=!0,A.Inertia.post("/user/two-factor-authentication",{},{preserveScroll:!0,onSuccess:()=>Promise.all([L(),q(),F()]),onFinish:()=>{c.value=!1,e.value=b.requiresConfirmation}})},L=()=>axios.get("/user/two-factor-qr-code").then(f=>{v.value=f.data.svg}),q=()=>axios.get("/user/two-factor-secret-key").then(f=>{p.value=f.data.secretKey}),F=()=>axios.get("/user/two-factor-recovery-codes").then(f=>{d.value=f.data}),K=()=>{r.post("/user/confirmed-two-factor-authentication",{errorBag:"confirmTwoFactorAuthentication",preserveScroll:!0,preserveState:!0,onSuccess:()=>{e.value=!1,v.value=null,p.value=null}})},E=()=>{axios.post("/user/two-factor-recovery-codes").then(()=>F())},V=()=>{l.value=!0,A.Inertia.delete("/user/two-factor-authentication",{preserveScroll:!0,onSuccess:()=>{l.value=!1,e.value=!1}})};return(f,P)=>(t(),y(G,null,{title:o(()=>[ee]),description:o(()=>[te]),content:o(()=>[h(m)&&!e.value?(t(),s("h3",oe," You have enabled two factor authentication. ")):h(m)&&e.value?(t(),s("h3",se," Finish enabling two factor authentication. ")):(t(),s("h3",ae," You have not enabled two factor authentication. ")),ne,h(m)?(t(),s("div",re,[v.value?(t(),s("div",ie,[i("div",ce,[e.value?(t(),s("p",le," To finish enabling two factor authentication, scan the following QR code using your phone's authenticator application or enter the setup key and provide the generated OTP code. ")):(t(),s("p",ue," Two factor authentication is now enabled. Scan the following QR code using your phone's authenticator application or enter the setup key. "))]),i("div",{class:"mt-4",innerHTML:v.value},null,8,de),p.value?(t(),s("div",me,[i("p",fe,[_e,i("span",{innerHTML:p.value},null,8,pe)])])):u("",!0),e.value?(t(),s("div",he,[a(J,{for:"code",value:"Code"}),a(B,{id:"code",modelValue:h(r).code,"onUpdate:modelValue":P[0]||(P[0]=k=>h(r).code=k),type:"text",name:"code",class:"block mt-1 w-1/2",inputmode:"numeric",autofocus:"",autocomplete:"one-time-code",onKeyup:R(K,["enter"])},null,8,["modelValue","onKeyup"]),a(M,{message:h(r).errors.code,class:"mt-2"},null,8,["message"])])):u("",!0)])):u("",!0),d.value.length>0&&!e.value?(t(),s("div",ve,[ye,i("div",we,[(t(!0),s(D,null,U(d.value,k=>(t(),s("div",{key:k},C(k),1))),128))])])):u("",!0)])):u("",!0),i("div",ge,[h(m)?(t(),s("div",ke,[a(w,{onConfirmed:K},{default:o(()=>[e.value?(t(),y($,{key:0,type:"button",class:x(["mr-3",{"opacity-25":c.value}]),disabled:c.value},{default:o(()=>[Ce]),_:1},8,["class","disabled"])):u("",!0)]),_:1}),a(w,{onConfirmed:E},{default:o(()=>[d.value.length>0&&!e.value?(t(),y(S,{key:0,class:"mr-3"},{default:o(()=>[Se]),_:1})):u("",!0)]),_:1}),a(w,{onConfirmed:F},{default:o(()=>[d.value.length===0&&!e.value?(t(),y(S,{key:0,class:"mr-3"},{default:o(()=>[Te]),_:1})):u("",!0)]),_:1}),a(w,{onConfirmed:V},{default:o(()=>[e.value?(t(),y(S,{key:0,class:x({"opacity-25":l.value}),disabled:l.value},{default:o(()=>[Fe]),_:1},8,["class","disabled"])):u("",!0)]),_:1}),a(w,{onConfirmed:V},{default:o(()=>[e.value?u("",!0):(t(),y(W,{key:0,class:x({"opacity-25":l.value}),disabled:l.value},{default:o(()=>[$e]),_:1},8,["class","disabled"]))]),_:1})])):(t(),s("div",xe,[a(w,{onConfirmed:T},{default:o(()=>[a($,{type:"button",class:x({"opacity-25":c.value}),disabled:c.value},{default:o(()=>[be]),_:1},8,["class","disabled"])]),_:1})]))])]),_:1}))}};export{Ne as default};
