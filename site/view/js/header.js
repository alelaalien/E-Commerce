var _checkemail="Por favor revise su bandeja de entrada o carpeta de correo no deseado para verificar su cuenta.";
var _success="¡Hecho!";

load();
/*==============================
=            header            =
==============================*/
$("#div_btncategories").click(function(){

if (window.matchMedia("(max-width:767px)").matches) {
	$("#div_btncategories").after($("#div_categories").slideToggle("fast"))
	 $("#div_categories").css("display", "-webkit-box");
}else{

	$("#div_header").after($("#div_categories").slideToggle("fast"))
	 $("#div_categories").css("display", "-webkit-box");
	}
})


/*=====  End of header  ======*/
/*===========================
=            top            =
===========================*/
$("#sprr").click(function(){
//showpass(1);
})
function showpass(x){
	if(x==1){
	var pass= $("#user_p_rr").val();
	var inpprr=$("#user_p_rr").attr("type");
	if (inpprr=="text") {
		$("#user_p_rr").attr("type", "password");
	}else{
		$("#user_p_rr").attr("type", "text");
	}	
		
	}else{

	var pass= $("#user_r_p").val();
	var inpprr=$("#user_r_p").attr("type");
	if (inpprr=="text") {
		$("#user_r_p").attr("type", "password");
	}else{
		$("#user_r_p").attr("type", "text");
	}


	}

}
function load(){
	if (window.matchMedia("(min-width:992px)").matches) {
		$("#cis").addClass("container");
		$("#cis").css("margin", "0px 0px 5px 1px;");
	}
}

/*=====  End of top  ======*/
