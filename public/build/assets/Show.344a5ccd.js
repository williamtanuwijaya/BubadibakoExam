import{L as p}from"./Admin.11cb9301.js";import{P as k}from"./Pagination.9ea90e3f.js";import{H as L,L as v,r,o as _,c as h,a as n,w as l,b as t,t as a,F as b,j as H,l as M,e as i,n as o,h as T}from"./app.78ecd11a.js";import{S as f}from"./sweetalert2.all.3828ed88.js";import{_ as g}from"./_plugin-vue_export-helper.cdc0426e.js";const j={layout:p,components:{Head:L,Link:v,Pagination:k},props:{errors:Object,exam:Object},setup(){return{destroy:(u,e)=>{f.fire({title:"Apakah Anda yakin?",text:"Anda tidak akan dapat mengembalikan ini!",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, delete it!"}).then(c=>{c.isConfirmed&&(M.Inertia.delete(`/admin/exams/${u}/questions/${e}/destroy`),f.fire({title:"Deleted!",text:"Soal Ujian Berhasil Dihapus!.",icon:"success",timer:2e3,showConfirmButton:!1}))})}}}},C=t("title",null,"Detail Ujian - Aplikasi Ujian Online",-1),B={class:"container-fluid mb-5 mt-5"},S={class:"row"},A={class:"col-md-12"},D=t("i",{class:"fa fa-long-arrow-alt-left me-2"},null,-1),U={class:"card border-0 shadow mb-4"},N={class:"card-body"},P=t("h5",null,[t("i",{class:"fa fa-edit"}),i(" Detail Ujian")],-1),O=t("hr",null,null,-1),V={class:"table-responsive"},F={class:"table table-bordered table-centered table-nowrap mb-0 rounded"},I=t("td",{style:{width:"30%"},class:"fw-bold"},"Nama Ujian",-1),K=t("td",{class:"fw-bold"},"Mata Pelajaran",-1),z=t("td",{class:"fw-bold"},"Kelas",-1),E=t("td",{class:"fw-bold"},"Jumlah Soal",-1),J=t("td",{class:"fw-bold"},"Durasi (Menit)",-1),Y={class:"card border-0 shadow"},G={class:"card-body"},Q=t("h5",null,[t("i",{class:"fa fa-question-circle"}),i(" Soal Ujian")],-1),R=t("hr",null,null,-1),W=t("i",{class:"fa fa-plus-circle"},null,-1),X=t("i",{class:"fa fa-file-excel"},null,-1),Z={class:"table-responsive mt-3"},q={class:"table table-bordered table-centered table-nowrap mb-0 rounded"},$=t("thead",{class:"thead-dark"},[t("tr",{class:"border-0"},[t("th",{class:"border-0 rounded-start",style:{width:"5%"}},"No."),t("th",{class:"border-0"},"Soal"),t("th",{class:"border-0 rounded-end",style:{width:"15%"}},"Aksi")])],-1),tt=t("div",{class:"mt-2"},null,-1),et={class:"fw-bold text-center"},st=["innerHTML"],nt=t("hr",null,null,-1),at={type:"A"},lt=["innerHTML"],ot=["innerHTML"],it=["innerHTML"],dt=["innerHTML"],ct=["innerHTML"],rt={class:"text-center"},_t=t("i",{class:"fa fa-pencil-alt"},null,-1),ht=["onClick"],ut=t("i",{class:"fa fa-trash"},null,-1),mt=[ut];function bt(w,u,e,c,ft,wt){const x=r("Head"),d=r("Link"),y=r("Pagination");return _(),h(b,null,[n(x,null,{default:l(()=>[C]),_:1}),t("div",B,[t("div",S,[t("div",A,[n(d,{href:"/admin/exams",class:"btn btn-md btn-primary border-0 shadow mb-3",type:"button"},{default:l(()=>[D,i(" Kembali")]),_:1}),t("div",U,[t("div",N,[P,O,t("div",V,[t("table",F,[t("tbody",null,[t("tr",null,[I,t("td",null,a(e.exam.title),1)]),t("tr",null,[K,t("td",null,a(e.exam.lesson.title),1)]),t("tr",null,[z,t("td",null,a(e.exam.classroom.title),1)]),t("tr",null,[E,t("td",null,a(e.exam.questions.data.length),1)]),t("tr",null,[J,t("td",null,a(e.exam.duration)+" Menit",1)])])])])])]),t("div",Y,[t("div",G,[Q,R,n(d,{href:`/admin/exams/${e.exam.id}/questions/create`,class:"btn btn-md btn-primary border-0 shadow me-2",type:"button"},{default:l(()=>[W,i(" Tambah")]),_:1},8,["href"]),n(d,{href:`/admin/exams/${e.exam.id}/questions/import`,class:"btn btn-md btn-success border-0 shadow text-white",type:"button"},{default:l(()=>[X,i(" Import")]),_:1},8,["href"]),t("div",Z,[t("table",q,[$,tt,t("tbody",null,[(_(!0),h(b,null,H(e.exam.questions.data,(s,m)=>(_(),h("tr",{key:m},[t("td",et,a(++m+(e.exam.questions.current_page-1)*e.exam.questions.per_page),1),t("td",null,[t("div",{class:"fw-bold",innerHTML:s.question},null,8,st),nt,t("ol",at,[t("li",{innerHTML:s.option_1,class:o({"text-success fw-bold":s.answer=="1"})},null,10,lt),t("li",{innerHTML:s.option_2,class:o({"text-success fw-bold":s.answer=="2"})},null,10,ot),t("li",{innerHTML:s.option_3,class:o({"text-success fw-bold":s.answer=="3"})},null,10,it),t("li",{innerHTML:s.option_4,class:o({"text-success fw-bold":s.answer=="4"})},null,10,dt),t("li",{innerHTML:s.option_5,class:o({"text-success fw-bold":s.answer=="5"})},null,10,ct)])]),t("td",rt,[n(d,{href:`/admin/exams/${e.exam.id}/questions/${s.id}/edit`,class:"btn btn-sm btn-info border-0 shadow me-2",type:"button"},{default:l(()=>[_t]),_:2},1032,["href"]),t("button",{onClick:T(xt=>c.destroy(e.exam.id,s.id),["prevent"]),class:"btn btn-sm btn-danger border-0"},mt,8,ht)])]))),128))])])]),n(y,{links:e.exam.questions.links,align:"end"},null,8,["links"])])])])])])],64)}const Ht=g(j,[["render",bt]]);export{Ht as default};