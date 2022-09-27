import{u as p,d as u,b as e,f as o,w as l,F as _,o as c,H as w,a,e as h,L as g,n as v,l as y,h as n}from"./app.c17fc97f.js";import{J as V}from"./AuthenticationCard.a568fd2a.js";import{_ as b}from"./AuthenticationCardLogo.e91e8ae4.js";import{_ as k}from"./Button.44f66190.js";import{_ as d}from"./Input.3f794f37.js";import{_ as x}from"./Checkbox.4f733245.js";import{_ as i}from"./Label.37c5172b.js";import{_ as $}from"./ValidationErrors.85c8fea4.js";import"./logo-updated.06118e35.js";import"./_plugin-vue_export-helper.cdc0426e.js";const P=["onSubmit"],C={class:"mt-4"},F={class:"mt-4"},N={class:"mt-4"},U={key:0,class:"mt-4"},q={class:"flex items-center"},A={class:"ml-2"},B=n(" I agree to the "),R=["href"],S=n(" and "),T=["href"],j={class:"flex items-center justify-end mt-4"},E=n(" Already registered? "),H=n(" Register "),X={__name:"Register",setup(J){const s=p({name:"",email:"",password:"",password_confirmation:"",terms:!1}),f=()=>{s.post(route("register"),{onFinish:()=>s.reset("password","password_confirmation")})};return(m,t)=>(c(),u(_,null,[e(o(w),{title:"Register"}),e(V,null,{logo:l(()=>[e(b)]),default:l(()=>[e($,{class:"mb-4"}),a("form",{onSubmit:y(f,["prevent"])},[a("div",null,[e(i,{for:"name",value:"Name"}),e(d,{id:"name",modelValue:o(s).name,"onUpdate:modelValue":t[0]||(t[0]=r=>o(s).name=r),type:"text",class:"mt-1 block w-full",required:"",autofocus:"",autocomplete:"name"},null,8,["modelValue"])]),a("div",C,[e(i,{for:"email",value:"Email"}),e(d,{id:"email",modelValue:o(s).email,"onUpdate:modelValue":t[1]||(t[1]=r=>o(s).email=r),type:"email",class:"mt-1 block w-full",required:""},null,8,["modelValue"])]),a("div",F,[e(i,{for:"password",value:"Password"}),e(d,{id:"password",modelValue:o(s).password,"onUpdate:modelValue":t[2]||(t[2]=r=>o(s).password=r),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"new-password"},null,8,["modelValue"])]),a("div",N,[e(i,{for:"password_confirmation",value:"Confirm Password"}),e(d,{id:"password_confirmation",modelValue:o(s).password_confirmation,"onUpdate:modelValue":t[3]||(t[3]=r=>o(s).password_confirmation=r),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"new-password"},null,8,["modelValue"])]),m.$page.props.jetstream.hasTermsAndPrivacyPolicyFeature?(c(),u("div",U,[e(i,{for:"terms"},{default:l(()=>[a("div",q,[e(x,{id:"terms",checked:o(s).terms,"onUpdate:checked":t[4]||(t[4]=r=>o(s).terms=r),name:"terms"},null,8,["checked"]),a("div",A,[B,a("a",{target:"_blank",href:m.route("terms.show"),class:"underline text-sm text-gray-600 hover:text-gray-900"},"Terms of Service",8,R),S,a("a",{target:"_blank",href:m.route("policy.show"),class:"underline text-sm text-gray-600 hover:text-gray-900"},"Privacy Policy",8,T)])])]),_:1})])):h("",!0),a("div",j,[e(o(g),{href:m.route("login"),class:"underline text-sm text-gray-600 hover:text-gray-900"},{default:l(()=>[E]),_:1},8,["href"]),e(k,{class:v(["ml-4",{"opacity-25":o(s).processing}]),disabled:o(s).processing},{default:l(()=>[H]),_:1},8,["class","disabled"])])],40,P)]),_:1})],64))}};export{X as default};
