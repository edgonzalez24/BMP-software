import{_ as i}from"./AppLayout.211d2108.js";import o from"./DeleteTeamForm.a4dee447.js";import{J as r}from"./SectionBorder.6e0a690b.js";import l from"./TeamMemberManager.1e7cfa3d.js";import n from"./UpdateTeamNameForm.0c5c5560.js";import{c,w as a,o as s,a as m,b as t,d as p,F as d,e as f}from"./app.5cd43312.js";import"./logo-updated.06118e35.js";import"./ActionSection.cc414a8c.js";import"./SectionTitle.ff30f74b.js";import"./_plugin-vue_export-helper.cdc0426e.js";import"./ConfirmationModal.2520ecf8.js";import"./Modal.b4e50afb.js";import"./DangerButton.6f56273d.js";import"./SecondaryButton.d5fec9d4.js";import"./ActionMessage.e3ebd824.js";import"./Button.ec39c580.js";import"./DialogModal.b7eea568.js";import"./FormSection.2d8d48a9.js";import"./Input.0c2c9904.js";import"./InputError.a5c6398b.js";import"./Label.05887034.js";const u=m("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"}," Team Settings ",-1),x={class:"max-w-7xl mx-auto py-10 sm:px-6 lg:px-8"},q={__name:"Show",props:{team:Object,availableRoles:Array,permissions:Object},setup(e){return(b,h)=>(s(),c(i,{title:"Team Settings"},{header:a(()=>[u]),default:a(()=>[m("div",null,[m("div",x,[t(n,{team:e.team,permissions:e.permissions},null,8,["team","permissions"]),t(l,{class:"mt-10 sm:mt-0",team:e.team,"available-roles":e.availableRoles,"user-permissions":e.permissions},null,8,["team","available-roles","user-permissions"]),e.permissions.canDeleteTeam&&!e.team.personal_team?(s(),p(d,{key:0},[t(r),t(o,{class:"mt-10 sm:mt-0",team:e.team},null,8,["team"])],64)):f("",!0)])])]),_:1}))}};export{q as default};
