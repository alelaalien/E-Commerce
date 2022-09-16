var n_expr= /^[a-zA-ZáéíóúÁÉÍÓÚÑñ ]*$/;
var e_expr= /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
var p_expr=/^[a-zA-Z0-9]*$/;
var cntn=true;
var nouser="No se encuentran usuarios con los datos ingresados, revisa si están escritos correctamente o registrate nuevamente.";
var checkemail="Por favor revise su bandeja de entrada o carpeta de correo no deseado para verificar su cuenta.";
var emailae=false;
var wrong_pass="Contraseña incorrecta";
var act_url=location.href;
$(".btn_direct").click(function(){

localStorage.setItem("act_url", act_url);
log_in();
})

/*==============================
	=            keyups            =
	==============================*/
/*----------  name  ----------*/
$("#user_r_n").keyup(function(event){

name_t();
})
function name_t(){
	var kg=false;
		if (event.keyCode==13||$("#user_r_n").focusout()){
		if($("#user_r_n").val()=="") {
			$("#alert_r_n").html(" Este campo es obligatorio");
		  	$("#alert_r_n").css("display","inline");
		  	$("#user_r_n").css("border", "1px solid red"); 
		  	 $("#user_r_n").addClass("dkg");
		  	//return;
		  }
	}
	
	 if ($("#user_r_n").val()!="") {
	 	if (!n_expr.test($("#user_r_n").val())){
		 $("#alert_r_n").html(" Sólo se permiten letras");
	  	 $("#alert_r_n").css("display","inline");
	  	 $("#user_r_n").css("border", "1px solid red"); 	
	  	  $("#user_r_n").addClass("dkg");
	 	}else{
		 $("#alert_r_n").html("");
	  	 $("#alert_r_n").css("display","none");
	  	 $("#user_r_n").css("border", ""); 	 
	  	  if ($("#user_r_n.dkg")) {
	  	 	$("#user_r_n").removeClass("dkg");
	  	 }
	  	 kg=true;		
	 	} 	
	 }
	 return kg;
}
/*----------  email  ----------*/
$("#user_r_e").keyup(function(event){

email_t();
})
function email_t(){

	var kg=false;
		if (event.keyCode==13||$("#user_r_e").focusout()){
		if($("#user_r_e").val()=="") {
			$("#alert_r_e").html(" Este campo es obligatorio");
		  	$("#alert_r_e").css("display","inline");
		  	$("#user_r_e").css("border", "1px solid red"); 
		  	$("#user_r_e").addClass("dkg");
		  }
	}
	
	 if ($("#user_r_e").val()!="") {
	 	if (!e_expr.test($("#user_r_e").val())){
		 $("#alert_r_e").html(" Escribe correctamente tu dirección de correo electrónico");
	  	 $("#alert_r_e").css("display","inline");
	  	 $("#user_r_e").css("border", "1px solid red"); 
	  	 $("#user_r_e").addClass("dkg");	
	 	}else{
		 $("#alert_r_e").html("");
	  	 $("#alert_r_e").css("display","none");
	  	 $("#user_r_e").css("border", ""); 	
	  	 if ($("#user_r_e.dkg")) {
	  	 	$("#user_r_e").removeClass("dkg");
	  	 }
	  	 kg=true; 		
	 	} 	
	 }
	 return kg;
}

$("#user_r_e").focusout(function(){
 var m_e=$("#user_r_e").val();
 var x="email_exists";
 mail_exists(x, m_e, false);	
/* var data= new FormData();
 data.append("real_", m_e);
 $.ajax({
 	url:site_url+"ajax/user_ajax.php",
 	method:"POST",
 	cache:false,
 	contentType:false,
 	processData:false,
 	data:data,
 	success: function(r){
 		console.log("r", r);
		if (r=="ok") {
 		
 }else{
 	$("#alert_r_e").html("Ingresa una dirección de correo electrónico válida");
			$("#alert_r_e").css("display","inline");
			$("#user_r_e").css("border", "1px solid red"); 
 } 
 	}
 })*/
 

})
function mail_exists(item, value, b){

var data= new FormData();
data.append(item, value);

$.ajax({
	 url:site_url+"ajax/user_ajax.php",
  method: "POST",
    cache: false,
    contentType: false,
    processData:false,
    data: data,
    success: function(response){
 
checkingmail(response, item, b);

    }
})
}

function checkingmail(response, item, b){	
	console.log("response", response);
	 
	if (item=="email_exists") {
		//console.log("entro a ", "email existe");
	    var eae="Ya existe un usuario con este correo electrónico registrado a través de ";
    	if (response.length<=5) {
    		 if (b){
    		$("#alert_r_e").html("No existe una cuenta asociada a este correo electrónico.");
			$("#alert_r_e").css("display","inline");
			$("#user_r_e").css("border", "1px solid red"); 	
    		 }
    		//console.log("entro a ", "respuesta menor a 5 de email existe(no existe)");
		var ee=	$("#alert_r_e").html();
		if (ee==eae) {
			$("#alert_r_e").css("display","none");
			$("#user_r_e").css("border", ""); 			
		}
    	    emailae=false;	 	
    	 } else{
    	 //	console.log("entro a ", "respuesta mayor a 5 de email existe");
    	 	emailae=true;
			var mode= JSON.parse(response).login;	
			if (mode=="direct") {mode="esta página (registro directo)."} 	 
			$("#alert_r_e").html(eae+mode);
			$("#alert_r_e").css("display","inline");
			$("#user_r_e").css("border", "1px solid red"); 																	
    	 }
    	}else{
    
    		 if (response.length<=5) { 
			$("#alert_fp_e").css("display", "inline");
 			$("#alert_fp_e").html("Esta dirrección de correo electónico no se encuentra registrada");
 			$("#fp_e").css("border", "1px solid red");
 			$("#darp").css("margin-top", "-"+24+"px");
			    	 	 	
			} else{ 
				$("#alert_fp_e").html("");
			  	 $("#alert_fp_e").css("display","none");
			  	 $("#fp_e").css("border", ""); 	 
			  	 
			  	 var data= new FormData();
			  	 data.append(item,$("#fp_e").val());
			  	 data.append("act_url", act_url);
			  	 
			  	 $.ajax({
			  	 	url: site_url+"ajax/user_ajax.php",
			  	 	method:"POST",
			  	 	cache:false,
			  	 	contentType:false,
			  	 	processData:false,
			  	 	data:data,
			  	 	success: function(r){
			  	 					  	  		if (r=="error_reset") {
			  	  		swal({
						   title: "Error",
						   text: "Ha ocurrido un error. Por favor, vuelve a intentarlo.",
						   icon: "error",
						 });
			  	  		}else if(r=="nouser"){
					swal({
						  title: "Error:",
						  text: "La dirección de correo electrónico ingresada no se encuentra registrada.",
						  icon: "error",
						});
			  	  		}else if("ok_reset"){/* window.location= localStorage.getItem('act_url');*/
			  	  		 
			  	  		 window.location=site_url+"wait";

			  	  		}
			  	 	}/**/
			  	 })

			    	 
			    	}
	}
}
/*----------  pass    ----------*/
$("#user_r_p").keyup(function(event){
	if (event.keyCode==13||$("#user_r_p").focusout()){
		if($("#user_r_p").val()=="") {
			$("#alert_r_p").html(" Este campo es obligatorio");
		  	$("#alert_r_p").css("display","inline");
		  	$("#user_r_p").css("border", "1px solid red"); 
		  
		  }
	}
	
	 if ($("#user_r_p").val()!="") {
	 	if (!p_expr.test($("#user_r_p").val())){
		 $("#alert_r_p").html(" Sólo se permiten letras y/o números");
	  	 $("#alert_r_p").css("display","inline");
	  	 $("#user_r_p").css("border", "1px solid red"); 	
	 	}else{
		 $("#alert_r_p").html("");
	  	 $("#alert_r_p").css("display","none");
	  	 $("#user_r_p").css("border", ""); 
	  	  if ($("#user_r_p.dkg")) {
	  	 	$("#user_r_p").removeClass("dkg");
	  	 }	 		
	 	} 	
	 }
})
/*----------  pass 2  ----------*/
$("#user_p_rr").keyup(function(event){
	if (event.keyCode==13||$("#user_p_rr").focusout()){
		if($("#user_p_rr").val()=="") {
			$("#alert_rr_p").html(" Este campo es obligatorio");
		  	$("#alert_rr_p").css("display","inline");
		  	$("#user_p_rr").css("border", "1px solid red"); 
		  	//return;
		  }else{
			if ($("#user_p_rr").val()!=$("#user_r_p").val()){
		 $("#alert_rr_p").html(" Las contraseñas ingresadas no coinciden");
	  	 $("#alert_rr_p").css("display","inline");
	  	 $("#user_p_rr").css("border", "1px solid red"); 	
	 		}else{
		 $("#alert_rr_p").html("");
	  	 $("#alert_rr_p").css("display","none");
	  	 $("#user_p_rr").css("border", ""); 
	  	 if ($("#user_p_rr.dkg")) {
	  	 	$("#user_p_rr").removeClass("dkg");
	  	 }	 			
	 		}
		}	
	}	 
})	
	
/*=====  End of keyups  ======*/
function removed(x){
	fc=has_second(x);
	 if (fc.hasClass("second_p")) {
	 	fc[0].remove();

	}
 }

function has_second(x){
	
	var parents=x.parents();
	var fp=parents[1];
	var fc= $(fp).children();	
	return fc;
 }
function cfru(){
 
	sb=false;
	var arr=[];
	arr[0]=$("#user_r_n");
	arr[1]=$("#user_r_e");
	arr[2]=$("#user_r_p");
	arr[3]=$("#user_p_rr");
	
	for (var i = 0; i < arr.length; i++) {
	 
		 if(arr[i].val()==""){
		 	$(arr[i] ).css("display","inline");
		  	$(arr[i]).css("border", "1px solid red"); 
		  	$(arr[i]).addClass("dkg");
		  	cntn=false;
		  	  

		 }

	}

	var terms=$("#reg_term:checked").val();
	 if (terms!="on") {
	 	$("#alert_r_t").css("display", "inline");$("#reg_term").css("border", "1px solid red"); 
	 	$("#alert_r_t").html(" Atención: para continuar debes aceptar las condiciones de uso y políticas de privacidad");
	 	cntn=false;	 	
	 }else{
	 		if (sb) {cntn=true;}
		 	
		 }
	if (!arr[0].hasClass("dkg")&&!arr[1].hasClass("dkg")&&!arr[2].hasClass("dkg")&&!arr[3].hasClass("dkg")) {
		user_register(); 
	}
	    

}
$("#reg_term").change(function(){
	
	    if(this.checked) {
 $("#alert_r_t").css("display", "none");
 $("#alert_r_t").html("");

	} 
})

function user_register(){		 
	 
	var rb=true;
	try{
 
	/*----------  name  ----------*/
	var name=$("#user_r_n").val();
		
		if (name!="") {
	 	
		 	if (!n_expr.test(name)) {

				rb=false;
				console.log("rbname", rb);
				return rb;			 	 
		 		}
	 	}else{

			rb=false;
			return rb;
		}
		console.log("rbddjn", rb);
		/*----------  email  ----------*/
	var email=$("#user_r_e").val();
		if (email!="") {
		 	if (!e_expr.test(email)) {
				rb=false;
				console.log("rbe", rb);
				return rb;
		 	}
		 }else{
		 	rb=false;
		 	return rb;
		 }/**/
		 if (emailae) {
		 	return false;
		 }
		 console.log("rbd e", rb);
	/*----------  pass  ----------*/
	var pass=$("#user_r_p").val();
		if ($("#user_r_p").val()!="") {
		 	if (!p_expr.test($("#user_r_p").val())) {
					rb=false;
					return rb;
			 }
		 }else{
		 	rb=false;
		 	return rb;
		 }
		 console.log("rbd p", rb);
	/*----------  pass 2  ----------*/
	var pass_r=$("#user_p_rr").val();
		if (pass_r!="") {
		 	if (pass_r!=pass){
		 	rb=false;
		 	return rb;
			}
		}else{

		 	rb=false;
		 	return rb;
		}
		console.log("rb p2", rb);
	var terms=$("#reg_term:checked").val();
		 if (terms!="on") {
		 	$("#alert_r_t").css("display", "inline");
		 	$("#alert_r_t").html(" Atención: para continuar debes aceptar las condiciones de uso y políticas de privacidad");
		 	rb=false;
		 	return rb;
		 }
register(rb); 
		 }catch(err){
		 	console.log(err.message);	
		 	console.log("rbcatch", rb);
	}
}
function register(rb){
	if (!rb) {
		swal({
			title: "Error",
			icon:"error"
		});
	}else{
		var data= new FormData();
		data.append("user_r_n", $("#user_r_n").val());
		data.append("user_r_e", $("#user_r_e").val());
		data.append("user_r_p", $("#user_r_p").val());
		data.append("user_p_rr", $("#user_p_rr").val());
		$.ajax({
		 	url:site_url+"ajax/user_ajax.php",
		 	method:"POST",
		 	cache:false,
		 	contentType:false,
		 	processData:false,
		 	data:data,
		 	success: function(r){
		 		console.log("r", r);
		 		if (r=="ok") {
		 			window.location=site_url+"wait";
		 		}else{swal({
			title: "Error",
			icon:"error"
		});}
			}
		});
}
}


$("#reg_term").change(function(){
	
	    if(this.checked) {
 $("#alert_r_t").css("display", "none");
 $("#alert_r_t").html("");

	} 
})

/*==============================
=            log in            =
==============================*/

function log_in(){

	
var email=	$("#user_l_e").val(); 
 
var pass=$("#user_l_p").val();
var text="Campo requerido";
if (email=="") {
 
alert_login("e", true, text)
}else if(pass==""){
 
alert_login("p", true, text);
}else{
 if (!e_expr.test(email)) {
 	text="Correo electrónico mal ingresado";
 	alert_login("e", true, text)
 }
  if (!p_expr.test(pass)) {
 	text="La contraseña solo permite números y/o letras";
 	alert_login("p", true, text)
 }

 var real;
 var data2= new FormData();
 data2.append("real_", email);
 $.ajax({
 	url:site_url+"ajax/user_ajax.php",
 	method:"POST",
 	contentType:false,
 	processData:false,
 	cache:false,
 	data:data2,
 	success: function(r){
 		console.log("real_", r);

 	}

 	}) 

 var data= new FormData();
 data.append("email",email);
 data.append("pass", pass);
 $.ajax({
 	url:site_url+"ajax/user_ajax.php",
 	method:"POST",
 	contentType:false,
 	processData:false,
 	cache:false,
 	data:data,
 	
 	success: function(r){  
 		swalls_login(r, email);
 	}
 })
}
}		


function swalls_login(r, x){
	switch(r){
		case "error":swal({
			  title: "Error:",
			  text: nouser,
			  icon: "error",
			});alert_login("e", true, "");
		break;
		case "1":swal({
			  title: "Error: cuenta sin verificar",
			  text: checkemail,
			  icon: "error",
			});
		break;
		case "wrong_pass":alert_login("p", true, wrong_pass);
		$("#fpass").css("display","inline");
		break;
		case "ok": window.location= localStorage.getItem('act_url');
		break;
		default:break;
	}
}

function alert_login(x, y, text){
if (y) {

	$("#alert_l_"+x).css("display", "inline");
	 $("#alert_l_"+x).html(text);
	 $("#user_l_"+x).css("border", "1px solid red");
}else{
	$("#alert_l_"+x).css("display", "none");
	 $("#alert_l_"+x).html(text);
	 $("#user_l_"+x).css("border", "1px solid #495057");
}
}

 $("#user_l_e").keyup(function(event){
 	if (e_expr.test($(this).val())) {
 		alert_login("e", false, "");
 		
 	}
 })
  $("#user_l_p").keyup(function(event){
 	if (p_expr.test($(this).val())) {
 		alert_login("p", false, "");
 		
 	}
 })
/*==================================
=            reset pass            =
==================================*/
 $(".btn_rp").click(function(){
rtpass();
 })

 function rtpass(){
 	 	if ($("#fp_e").val()!="") {
 		if (!e_expr.test($("#fp_e").val())) {
 			$("#alert_fp_e").css("display", "inline");
 			$("#alert_fp_e").html("Escribe correctamente tu dirección de correo electrónico");
 			$("#fp_e").css("border", "1px solid red");
 			$("#darp").css("margin-top", "-"+24+"px");
 		}else{
 			$("#alert_fp_e").css("display", "none");
 			$("#fp_e").css("border", "1px solid #495057");
 			$("#darp").css("margin-top", 0);
 			var x="resset_pass";
 			mail_exists(x, $("#fp_e").val(), false);
 			
 			 
 		}
 	}else{ return 0;}
 }
$("#fp_e").keyup(function(event){
	$("#alert_fp_e").css("display", "none");
 			$("#fp_e").css("border", "1px solid #495057");
 			$("#darp").css("margin-top", 0);
})


/*=====  End of reset pass  ======*/

 function resetnew(x){
var data1 =	$("#inc").val();
 var data2 =	$("#user_nc_p").val();
 var data3 =	$("#user_nc_pp").val();

 if (data1=="") {

 }
 var data=new FormData();
 data.append("JxV15", data1);
 data.append("JxwV15", data3);
 data.append("DFSncu", x);
 $.ajax({
 	url:site_url+"ajax/user_ajax.php",
 	method:"POST";
 	cache:false,
 	contentType:false,
 	processData:false,
 	data:data,
 	success: function(r){
 		swal({
						  title: "¡Hecho!:",
						  text: "Ya puedes ingresar con tu nueva contraseña.",
						  icon: "success",
						});
 		$("#m_login").modal("show");
 	}
 })

 }
 
  			
 