/*==================================
=            grisd list            =
==================================*/ 
loader();
function g_l(x,y){

$("#div_list ."+x+"0").show();

$("#div_list ."+y+"0").hide();
}
 
 $(".g_l_pagination li a").click(function(){
 
loader();

 })
 function loader(){
 var gl=sessionStorage.getItem("g_l");
if (gl== undefined||gl!="list") {
	g_l("grid", "list");
}else{

 	 g_l("list", "grid");
 }
 }

	$("#btn_list_p").click(function(){
		
		sessionStorage.clear();
		sessionStorage.setItem("g_l", "list");
		g_l("list", "grid");

	})
		$("#btn_grid_p").click(function(){
		sessionStorage.clear();
			sessionStorage.setItem("g_l", "grid");
				g_l("grid", "list");
		 
	})

/*========================
		=                        =
========================*/
		
	var active_pag=$(".pag_act").html();
	if (active_pag!=null) {
	var re_ap= active_pag.replace(/-/g, " ");	
	$(".pag_act").html(re_ap);	
	}


 
				
 