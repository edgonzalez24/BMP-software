import{_ as i}from"./AppLayout.0570fe7b.js";import o from"./DeleteTeamForm.523a8d25.js";import{J as r}from"./SectionBorder.f427a330.js";import l from"./TeamMemberManager.8ac46617.js";import n from"./UpdateTeamNameForm.343c5b55.js";import{c,w as a,o as s,a as m,b as t,d as p,F as d,e as f}from"./app.c17fc97f.js";import"./logo-updated.06118e35.js";import"./ActionSection.93e66a81.js";import"./SectionTitle.7a88189e.js";import"./_plugin-vue_export-helper.cdc0426e.js";import"./ConfirmationModal.454ca609.js";import"./Modal.ac4f42c2.js";import"./DangerButton.a6075c96.js";import"./SecondaryButton.4548ab7e.js";import"./ActionMessage.e0b924b3.js";import"./Button.44f66190.js";import"./DialogModal.e7522ec3.js";import"./FormSection.9be42c1f.js";import"./Input.3f794f37.js";import"./InputError.8b45b824.js";import"./Label.37c5172b.js";const u=m("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"}," Team Settings ",-1),x={class:"max-w-7xl mx-auto py-10 sm:px-6 lg:px-8"},q={__name:"Show",props:{team:Object,availableRoles:Array,permissions:Object},setup(e){return(b,h)=>(s(),c(i,{title:"Team Settings"},{header:a(()=>[u]),default:a(()=>[m("div",null,[m("div",x,[t(n,{team:e.team,permissions:e.permissions},null,8,["team","permissions"]),t(l,{class:"mt-10 sm:mt-0",team:e.team,"available-roles":e.availableRoles,"user-permissions":e.permissions},null,8,["team","available-roles","user-permissions"]),e.permissions.canDeleteTeam&&!e.team.personal_team?(s(),p(d,{key:0},[t(r),t(o,{class:"mt-10 sm:mt-0",team:e.team},null,8,["team"])],64)):f("",!0)])])]),_:1}))}};export{q as default};
