import{L as u}from"./Admin.11cb9301.js";import{H as f,L as h,g as p,r,o as i,c as l,a as d,w as c,b as t,h as w,i as k,p as v,t as y,k as x,F as j,l as S,e as m}from"./app.78ecd11a.js";import{S as g}from"./sweetalert2.all.3828ed88.js";import{_ as L}from"./_plugin-vue_export-helper.cdc0426e.js";const N={layout:u,components:{Head:f,Link:h},props:{errors:Object},setup(){const a=p({title:""});return{form:a,submit:()=>{S.Inertia.post("/admin/lessons",{title:a.title},{onSuccess:()=>{g.fire({title:"Success!",text:"Pelajaran Berhasil Disimpan!.",icon:"success",showConfirmButton:!1,timer:2e3})}})}}}},B=t("title",null,"Tambah Mata Pelajaran - Aplikasi Ujian Online",-1),C={class:"container-fluid mb-5 mt-5"},P={class:"row"},V={class:"col-md-12"},H=t("i",{class:"fa fa-long-arrow-alt-left me-2"},null,-1),M={class:"card border-0 shadow"},T={class:"card-body"},D=t("h5",null,[t("i",{class:"fa fa-bookmark"}),m(" Tambah Pelajaran")],-1),A=t("hr",null,null,-1),F={class:"mb-4"},O=t("label",null,"Nama Pelajaran",-1),U={key:0,class:"alert alert-danger mt-2"},E=t("button",{type:"submit",class:"btn btn-md btn-primary border-0 shadow me-2"},"Simpan",-1),I=t("button",{type:"reset",class:"btn btn-md btn-warning border-0 shadow"},"Reset",-1);function K(a,s,n,e,R,q){const _=r("Head"),b=r("Link");return i(),l(j,null,[d(_,null,{default:c(()=>[B]),_:1}),t("div",C,[t("div",P,[t("div",V,[d(b,{href:"/admin/lessons",class:"btn btn-md btn-primary border-0 shadow mb-3",type:"button"},{default:c(()=>[H,m(" Kembali")]),_:1}),t("div",M,[t("div",T,[D,A,t("form",{onSubmit:s[1]||(s[1]=w((...o)=>e.submit&&e.submit(...o),["prevent"]))},[t("div",F,[O,k(t("input",{type:"text",class:"form-control",placeholder:"Masukkan Nama Pelajaran","onUpdate:modelValue":s[0]||(s[0]=o=>e.form.title=o)},null,512),[[v,e.form.title]]),n.errors.title?(i(),l("div",U,y(n.errors.title),1)):x("",!0)]),E,I],32)])])])])])],64)}const W=L(N,[["render",K]]);export{W as default};
