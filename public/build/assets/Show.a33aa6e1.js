import{_ as i}from"./AppLayout.249ad17f.js";import o from"./DeleteTeamForm.d4987996.js";import{J as r}from"./SectionBorder.43c92f7d.js";import l from"./TeamMemberManager.d76be1e6.js";import n from"./UpdateTeamNameForm.e891cb9c.js";import{c,w as a,o as s,a as m,b as t,d as p,F as d,e as f}from"./app.6d3bc8a1.js";import"./logo-updated.06118e35.js";import"./ActionSection.6edc8065.js";import"./SectionTitle.72dab7aa.js";import"./_plugin-vue_export-helper.cdc0426e.js";import"./ConfirmationModal.bc4d443e.js";import"./Modal.0211b894.js";import"./DangerButton.d351c1fd.js";import"./SecondaryButton.accc7446.js";import"./ActionMessage.cfb4abc4.js";import"./Button.88019c98.js";import"./DialogModal.9a1365be.js";import"./FormSection.9a1543b2.js";import"./Input.65161d71.js";import"./InputError.66611dcc.js";import"./Label.265655fd.js";const u=m("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"}," Team Settings ",-1),x={class:"max-w-7xl mx-auto py-10 sm:px-6 lg:px-8"},q={__name:"Show",props:{team:Object,availableRoles:Array,permissions:Object},setup(e){return(b,h)=>(s(),c(i,{title:"Team Settings"},{header:a(()=>[u]),default:a(()=>[m("div",null,[m("div",x,[t(n,{team:e.team,permissions:e.permissions},null,8,["team","permissions"]),t(l,{class:"mt-10 sm:mt-0",team:e.team,"available-roles":e.availableRoles,"user-permissions":e.permissions},null,8,["team","available-roles","user-permissions"]),e.permissions.canDeleteTeam&&!e.team.personal_team?(s(),p(d,{key:0},[t(r),t(o,{class:"mt-10 sm:mt-0",team:e.team},null,8,["team"])],64)):f("",!0)])])]),_:1}))}};export{q as default};
