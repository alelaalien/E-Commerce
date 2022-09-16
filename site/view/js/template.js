 

/*=================================
=            variables            =
=================================*/
var site_url=$("#site_u").val();
 
var url_s=site_url;
var btn_list = $(".btn_list");
var btn_grid = $(".btn_grid");

 function get_t(){
 	//return url_s;
 	console.log("url_s", url_s);
 }


/*=====  End of variables  ======*/




$.ajax({
url:url_s+"ajax/template_ajax.php",

success:function(r){
  
var top_bar =JSON.parse(r).top_bar ;
var background =JSON.parse(r).background ;
var text_color =JSON.parse(r).text_color ;
var top_text_color =JSON.parse(r).top_text_color ;

$(".back_color, .back_color a").css({"background": background, "color":text_color})

$(".div_top, .div_top a").css({"background": top_bar, "color":top_text_color})	 

}
})
 
/*==================================
=            grisd list            =
==================================*/
for (var i = 0 ; i < btn_list.length; i++) {
	$("#btn_list"+i).click(function(){
		var n= $(this).attr("id").substr(-1);
		$(".list"+n).show();
		$(".grid"+n).hide();
	})
		$("#btn_grid"+i).click(function(){
		var n= $(this).attr("id").substr(-1);
		$(".grid"+n).show();
		$(".list"+n).hide();
		console.log("n", n);
	})
}



/*=====  End of grisd list  ======*/

/*==============================
=            scroll            =
==============================*/
$(window).scroll(function(){

	var s_y=window.pageYOffset;
	if (!$(".banner")[0]  ) { }else{
	if (s_y<($(".banner").offset().top)-200) {	 
		
$(".banner img").css({"margin-top":-s_y/2+"px"});
		
	}else{
		s_y=0;
	}
}
})

$('[data-toggle="tooltip"]').tooltip();
/*==============================
=            pagination            =
==============================*/
var url=window.location.href;
var index=url.split("/");
var n=index[7];
var pop=index.pop();
if (isNaN(n)||n=="1") {
	$("#item1").addClass("active");
}else{
	$("#item"+n).addClass("active");
}