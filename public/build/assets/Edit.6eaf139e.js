import{L as b}from"./Admin.11cb9301.js";import{H as f,L as h,g as p,r as i,o as r,c as l,a as d,w as c,b as t,h as w,i as k,p as v,t as y,k as j,F as x,l as g,e as m}from"./app.78ecd11a.js";import{S as L}from"./sweetalert2.all.3828ed88.js";import{_ as N}from"./_plugin-vue_export-helper.cdc0426e.js";const S={layout:b,components:{Head:f,Link:h},props:{errors:Object,lesson:Object},setup(o){const e=p({title:o.lesson.title});return{form:e,submit:()=>{g.Inertia.put(`/admin/lessons/${o.lesson.id}`,{title:e.title},{onSuccess:()=>{L.fire({title:"Success!",text:"Pelajaran Berhasil Diupdate!.",icon:"success",showConfirmButton:!1,timer:2e3})}})}}}},B=t("title",null,"Edit Mata Pelajaran - Aplikasi Ujian Online",-1),P={class:"container-fluid mb-5 mt-5"},V={class:"row"},C={class:"col-md-12"},E=t("i",{class:"fa fa-long-arrow-alt-left me-2"},null,-1),H={class:"card border-0 shadow"},M={class:"card-body"},D=t("h5",null,[t("i",{class:"fa fa-bookmark"}),m(" Edit Pelajaran")],-1),O=t("hr",null,null,-1),U={class:"mb-4"},A=t("label",null,"Nama Pelajaran",-1),F={key:0,class:"alert alert-danger mt-2"},T=t("button",{type:"submit",class:"btn btn-md btn-primary border-0 shadow me-2"},"Update",-1),I=t("button",{type:"reset",class:"btn btn-md btn-warning border-0 shadow"},"Reset",-1);function K(o,e,a,s,R,q){const _=i("Head"),u=i("Link");return r(),l(x,null,[d(_,null,{default:c(()=>[B]),_:1}),t("div",P,[t("div",V,[t("div",C,[d(u,{href:"/admin/lessons",class:"btn btn-md btn-primary border-0 shadow mb-3",type:"button"},{default:c(()=>[E,m(" Kembali")]),_:1}),t("div",H,[t("div",M,[D,O,t("form",{onSubmit:e[1]||(e[1]=w((...n)=>s.submit&&s.submit(...n),["prevent"]))},[t("div",U,[A,k(t("input",{type:"text",class:"form-control",placeholder:"Masukkan Nama Pelajaran","onUpdate:modelValue":e[0]||(e[0]=n=>s.form.title=n)},null,512),[[v,s.form.title]]),a.errors.title?(r(),l("div",F,y(a.errors.title),1)):j("",!0)]),T,I],32)])])])])])],64)}const W=N(S,[["render",K]]);export{W as default};