import{L as u}from"./Student.a3fe7055.js";import{H as _,g as f,r as g,o as n,c as i,a as b,w as h,b as s,t as l,k as d,h as v,i as c,p as m,F as w,l as y}from"./app.78ecd11a.js";import{_ as k}from"./_plugin-vue_export-helper.cdc0426e.js";const x={layout:u,components:{Head:_},props:{errors:Object},setup(){const t=f({nisn:"",password:""});return{form:t,submit:()=>{y.Inertia.post("/students/login",{nisn:t.nisn,password:t.password})}}}},N=s("title",null,"Login Siswa - Aplikasi Ujian Online",-1),B={class:"row justify-content-center mt-5"},S={class:"col-md-5"},V={class:"bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500"},A={key:0,class:"alert alert-danger mt-2"},L={key:1,class:"alert alert-danger mt-2"},j=s("div",{style:{"text-align":"center"}},[s("img",{src:"/assets/images/ppsk.png",alt:"logo",style:{"align-items":"center",height:"190px"},class:"three-d-logo"}),s("h5",null,"CBT SMA XAVERIUS 1 PALEMBANG"),s("h6",null,"by Bubadibako Team")],-1),C={class:"form-group mb-4"},H=s("label",{for:"email"},"Nisn",-1),I={class:"input-group"},M=s("span",{class:"input-group-text",id:"basic-addon1"},[s("i",{class:"fa fa-key"})],-1),U={key:0,class:"alert alert-danger mt-2"},E={class:"form-group"},O={class:"form-group mb-4"},P=s("label",{for:"password"},"Password",-1),T={class:"input-group"},D=s("span",{class:"input-group-text",id:"basic-addon2"},[s("i",{class:"fa fa-lock"})],-1),F={key:0,class:"alert alert-danger mt-2"},G=s("div",{class:"d-flex justify-content-between align-items-top mb-4"},[s("div",{class:"form-check"},[s("input",{class:"form-check-input",type:"checkbox",value:"",id:"remember"}),s("label",{class:"form-check-label mb-0",for:"remember"}," Remember me ")])],-1),R=s("div",{class:"d-grid"},[s("button",{type:"submit",class:"btn btn-gray-800"},"LOGIN")],-1);function X(t,e,o,r,q,z){const p=g("Head");return n(),i(w,null,[b(p,null,{default:h(()=>[N]),_:1}),s("div",B,[s("div",S,[s("div",V,[o.errors.message?(n(),i("div",A,l(o.errors.message),1)):d("",!0),t.$page.props.session.error?(n(),i("div",L,l(t.$page.props.session.error),1)):d("",!0),j,s("form",{onSubmit:e[2]||(e[2]=v((...a)=>r.submit&&r.submit(...a),["prevent"])),class:"mt-4"},[s("div",C,[H,s("div",I,[M,c(s("input",{type:"number",class:"form-control","onUpdate:modelValue":e[0]||(e[0]=a=>r.form.nisn=a),placeholder:"Nisn"},null,512),[[m,r.form.nisn]])]),o.errors.nisn?(n(),i("div",U,l(o.errors.nisn),1)):d("",!0)]),s("div",E,[s("div",O,[P,s("div",T,[D,c(s("input",{type:"password",placeholder:"Password",class:"form-control","onUpdate:modelValue":e[1]||(e[1]=a=>r.form.password=a)},null,512),[[m,r.form.password]])]),o.errors.password?(n(),i("div",F,l(o.errors.password),1)):d("",!0)]),G]),R],32)])])])],64)}const W=k(x,[["render",X]]);export{W as default};
