var item=0;
var item_pag=$("#pagination li");
var img_p=$(".img_prod");
var slide= $("#div_slide");
var ul_li= $("#div_slide ul li");
var go_f =$("#div_slide #go_forward");
var go_b =$("#div_slide #go_back");
var title1 =$("#div_slide h1");
var title2 =$("#div_slide h2");
var title3 =$("#div_slide h3");
var btn_p =$("#div_slide button");
var ic = false;
var di= false;
var toogle = false;


/*=============================================
ANIMACIÓN INICIAL
=============================================*/
animation();

function animation(){
 
$(img_p[item]).animate({"top": -10+"%", "opacity":0.5}, 100);
$(img_p[item]).animate({"top": 30+"px", "opacity":1}, 600);
$(title1).animate({"top": -10+"%", "opacity":0.5}, 100);
$(title1).animate({"top": 30+"px", "opacity":1}, 600);
$(title2).animate({"top": -10+"%", "opacity":0.5}, 100);
$(title2).animate({"top": 30+"px", "opacity":1}, 600);
$(title3).animate({"top": -10+"%", "opacity":0.5}, 100);
$(title3).animate({"top": 30+"px", "opacity":1}, 600);
$(btn_p).animate({"top": -10+"%", "opacity":0.5}, 100);
$(btn_p).animate({"top": 30+"px", "opacity":1}, 600);
}
 
/*=============================================
PAGINACION
=============================================*/
item_pag.click(function(){
item=$(this).attr("item")-1; 
mov_slide(item);

})
function mov_slide(item){
	$("#div_slide ul li").finish();
	$("#div_slide ul").animate({"left": item * -100+"%"}, 1000);
	$(item_pag).css({"opacity":.5}); 
	$(item_pag[item]).css({"opacity":1}); 
	ic=true;
animation();


}
/*=============================================camilowilches9@gmail.com https://www.awseducate.com/student/s/
1030645314.Camilo

interval
=============================================setInterval*/
$(go_f).click(function(){
	go_forward();
});
$(go_b).click(function(){
 go_back();
});

function go_forward(){
	if (item== $("#div_slide ul li").length -1) {
		item=0;
	}else{
		item++;
	}
	ic=true;
	mov_slide(item);
}
function go_back(){
		if (item==0) {
		item= $("#div_slide ul li").length -1;
	}else{
		item--;
	}
	mov_slide(item);
}
setInterval(function(){

	if (ic) {
		ic=false;
		
	//	$("#div_slide ul li").finish();

	}else{
		if (!di) {
	go_forward();			
		}
		
	}

}, 3000);

$(slide).mouseover(function(){

	$(go_b).css({"opacity":1});
	$(go_f).css({"opacity":1});
	di=true;
	
});
$(slide).mouseout(function(){

	$(go_b).css({"opacity":0});
	$(go_f).css({"opacity":0});
	di=false;
});

$("#btn_slide").click(function(){

	if(!toogle){

		toogle = true;

		$("#div_slide").slideUp("fast");

		$("#btn_slide").html('<i class="fa fa-angle-down"></i>')
	
	}else{

		toogle = false;

		$("#div_slide").slideDown("fast");

		$("#btn_slide").html('<i class="fa fa-angle-up"></i>')
	}

})





$(window).on("blur focus", function(e) { 
var prevType = $(this).data("prevType");
 if (prevType != e.type) {
 
  switch (e.type) { case "blur": 

					di= true;

                      break; 
                      case "focus": 
					di= false;
                        break; 
                    } 
                }
$(this).data("prevType", e.type); })

