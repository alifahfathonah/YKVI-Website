(window.webpackJsonp=window.webpackJsonp||[]).push([[11],{"U/3w":function(t,a,e){"use strict";e.r(a);var r=e("e7F3"),s=e("TJPC"),o=e("enAU");Object(r.c)("required",s.c),Object(r.d)("id",o);var i={components:{ValidationObserver:r.a,ValidationProvider:r.b},props:{actionForm:{type:String,required:!0},redirectUri:{type:String,required:!0},dataUri:{type:String,default:""}},data:function(){return{search_kategori:null,form_data:{pertanyaan:"",jawaban:"",publish_status:1},field_state:!1,form_alert_state:!1,form_alert_color:"",form_alert_text:""}},mounted:function(){this.getFormData()},methods:{getFormData:function(){var t=this;console.log(this),this.dataUri&&(this.field_state=!0,axios.get(this.dataUri).then((function(a){if(a.data.success){var e=a.data.data;t.form_data={pertanyaan:e.question,jawaban:e.answer,publish_status:e.publish_status},t.field_state=!1}else t.form_alert_state=!0,t.form_alert_color="error",t.form_alert_text=a.data.message,t.field_state=!1})).catch((function(a){t.form_alert_state=!0,t.form_alert_color="error",t.form_alert_text=response.data.message,t.field_state=!1})))},clearForm:function(){this.form_data={pertanyaan:"",jawaban:"",publish_status:""},this.$refs.observer.reset()},submitForm:function(){var t=this;this.$refs.observer.validate().then((function(a){a&&(t.field_state=!0,t.postFormData())}))},postFormData:function(){var t=this,a=new FormData(this.$refs["post-form"]);this.dataUri&&(a.append("_method","put"),a.append("answer",this.form_data.jawaban),a.append("publish_status",this.form_data.publish_status)),a.append("answer",this.form_data.jawaban),a.append("publish_status",this.form_data.publish_status),axios.post(this.actionForm,a).then((function(a){a.data.success?(t.form_alert_state=!0,t.form_alert_color="success",t.form_alert_text=a.data.message,setTimeout((function(){t.goto(t.redirectUri)}),6e3)):(t.field_state=!1,t.form_alert_state=!0,t.form_alert_color="error",t.form_alert_text=a.data.message)})).catch((function(a){t.field_state=!1,t.form_alert_state=!0,t.form_alert_color="error",t.form_alert_text="Oops, something went wrong. Please try again later."}))}}},n=e("KHd+"),_=Object(n.a)(i,void 0,void 0,!1,null,null,null);a.default=_.exports}}]);