import{_ as i}from"./AppLayout.4d3fe5a9.js";import o from"./DeleteTeamForm.affa0f4d.js";import{J as r}from"./SectionBorder.15dab283.js";import l from"./TeamMemberManager.1bc22f0a.js";import n from"./UpdateTeamNameForm.1c36227b.js";import{c,w as a,o as s,a as m,b as t,d as p,F as d,e as f}from"./app.29c54f81.js";import"./logo-updated.06118e35.js";import"./ActionSection.7f3a3afc.js";import"./SectionTitle.5490fd64.js";import"./_plugin-vue_export-helper.cdc0426e.js";import"./ConfirmationModal.fcdb4824.js";import"./Modal.d418aaef.js";import"./DangerButton.aa5507ac.js";import"./SecondaryButton.934257e8.js";import"./ActionMessage.aece2cfa.js";import"./Button.8fe6b133.js";import"./DialogModal.0075d541.js";import"./FormSection.c586dca4.js";import"./Input.95b21071.js";import"./InputError.6343f2aa.js";import"./Label.49e3d504.js";const u=m("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"}," Team Settings ",-1),x={class:"max-w-7xl mx-auto py-10 sm:px-6 lg:px-8"},q={__name:"Show",props:{team:Object,availableRoles:Array,permissions:Object},setup(e){return(b,h)=>(s(),c(i,{title:"Team Settings"},{header:a(()=>[u]),default:a(()=>[m("div",null,[m("div",x,[t(n,{team:e.team,permissions:e.permissions},null,8,["team","permissions"]),t(l,{class:"mt-10 sm:mt-0",team:e.team,"available-roles":e.availableRoles,"user-permissions":e.permissions},null,8,["team","available-roles","user-permissions"]),e.permissions.canDeleteTeam&&!e.team.personal_team?(s(),p(d,{key:0},[t(r),t(o,{class:"mt-10 sm:mt-0",team:e.team},null,8,["team"])],64)):f("",!0)])])]),_:1}))}};export{q as default};
