import{_ as i}from"./AppLayout.fffd5899.js";import o from"./DeleteTeamForm.e3dc3923.js";import{J as r}from"./SectionBorder.abc45435.js";import l from"./TeamMemberManager.63df9014.js";import n from"./UpdateTeamNameForm.3b937afb.js";import{c,w as a,o as s,a as m,b as t,d as p,F as d,e as f}from"./app.49d8581a.js";import"./logo-updated.06118e35.js";import"./ActionSection.f9ea11c7.js";import"./SectionTitle.4cfd78ff.js";import"./_plugin-vue_export-helper.cdc0426e.js";import"./ConfirmationModal.4ab1cab1.js";import"./Modal.aa97109b.js";import"./DangerButton.56cec28b.js";import"./SecondaryButton.c395ef8f.js";import"./ActionMessage.e06bd3c4.js";import"./Button.9fa69eb0.js";import"./DialogModal.6edae1cc.js";import"./FormSection.815c14f7.js";import"./Input.578a7824.js";import"./InputError.d5011931.js";import"./Label.584dfeaf.js";const u=m("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"}," Team Settings ",-1),x={class:"max-w-7xl mx-auto py-10 sm:px-6 lg:px-8"},q={__name:"Show",props:{team:Object,availableRoles:Array,permissions:Object},setup(e){return(b,h)=>(s(),c(i,{title:"Team Settings"},{header:a(()=>[u]),default:a(()=>[m("div",null,[m("div",x,[t(n,{team:e.team,permissions:e.permissions},null,8,["team","permissions"]),t(l,{class:"mt-10 sm:mt-0",team:e.team,"available-roles":e.availableRoles,"user-permissions":e.permissions},null,8,["team","available-roles","user-permissions"]),e.permissions.canDeleteTeam&&!e.team.personal_team?(s(),p(d,{key:0},[t(r),t(o,{class:"mt-10 sm:mt-0",team:e.team},null,8,["team"])],64)):f("",!0)])])]),_:1}))}};export{q as default};