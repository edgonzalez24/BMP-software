import{_ as i}from"./AppLayout.6927338f.js";import o from"./DeleteTeamForm.bfb40fff.js";import{J as r}from"./SectionBorder.684c0ee6.js";import l from"./TeamMemberManager.a93a4ae1.js";import n from"./UpdateTeamNameForm.eb186be1.js";import{c,w as a,o as s,a as m,b as t,d as p,F as d,e as f}from"./app.27d2b638.js";import"./logo-updated.06118e35.js";import"./ActionSection.e06f90cf.js";import"./SectionTitle.8512c782.js";import"./_plugin-vue_export-helper.cdc0426e.js";import"./ConfirmationModal.d446b7ac.js";import"./Modal.46256e3d.js";import"./DangerButton.26879f1d.js";import"./SecondaryButton.399aad45.js";import"./ActionMessage.f9e75057.js";import"./Button.2879c7b0.js";import"./DialogModal.73490d29.js";import"./FormSection.d2f1ef15.js";import"./Input.7f4b7f9e.js";import"./InputError.0684aad4.js";import"./Label.ed52c964.js";const u=m("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"}," Team Settings ",-1),x={class:"max-w-7xl mx-auto py-10 sm:px-6 lg:px-8"},q={__name:"Show",props:{team:Object,availableRoles:Array,permissions:Object},setup(e){return(b,h)=>(s(),c(i,{title:"Team Settings"},{header:a(()=>[u]),default:a(()=>[m("div",null,[m("div",x,[t(n,{team:e.team,permissions:e.permissions},null,8,["team","permissions"]),t(l,{class:"mt-10 sm:mt-0",team:e.team,"available-roles":e.availableRoles,"user-permissions":e.permissions},null,8,["team","available-roles","user-permissions"]),e.permissions.canDeleteTeam&&!e.team.personal_team?(s(),p(d,{key:0},[t(r),t(o,{class:"mt-10 sm:mt-0",team:e.team},null,8,["team"])],64)):f("",!0)])])]),_:1}))}};export{q as default};