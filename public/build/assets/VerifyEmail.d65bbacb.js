import{u as _,i as h,d as r,b as e,f as t,w as s,F as p,o as l,H as y,e as g,a as o,n as v,L as d,l as x,h as a}from"./app.6bf1cdd5.js";import{J as b}from"./AuthenticationCard.a60e3647.js";import{_ as k}from"./AuthenticationCardLogo.7852d8d9.js";import{_ as w}from"./Button.4378d5c9.js";import"./logo-updated.06118e35.js";import"./_plugin-vue_export-helper.cdc0426e.js";const V=o("div",{class:"mb-4 text-sm text-gray-600"}," Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another. ",-1),E={key:0,class:"mb-4 font-medium text-sm text-green-600"},B=["onSubmit"],C={class:"mt-4 flex items-center justify-between"},L=a(" Resend Verification Email "),N=a(" Edit Profile"),S=a(" Log Out "),I={__name:"VerifyEmail",props:{status:String},setup(c){const m=c,i=_(),u=()=>{i.post(route("verification.send"))},f=h(()=>m.status==="verification-link-sent");return(n,F)=>(l(),r(p,null,[e(t(y),{title:"Email Verification"}),e(b,null,{logo:s(()=>[e(k)]),default:s(()=>[V,t(f)?(l(),r("div",E," A new verification link has been sent to the email address you provided in your profile settings. ")):g("",!0),o("form",{onSubmit:x(u,["prevent"])},[o("div",C,[e(w,{class:v({"opacity-25":t(i).processing}),disabled:t(i).processing},{default:s(()=>[L]),_:1},8,["class","disabled"]),o("div",null,[e(t(d),{href:n.route("profile.show"),class:"underline text-sm text-gray-600 hover:text-gray-900"},{default:s(()=>[N]),_:1},8,["href"]),e(t(d),{href:n.route("logout"),method:"post",as:"button",class:"underline text-sm text-gray-600 hover:text-gray-900 ml-2"},{default:s(()=>[S]),_:1},8,["href"])])])],40,B)]),_:1})],64))}};export{I as default};
