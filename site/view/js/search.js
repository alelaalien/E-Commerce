var path = location.pathname+"/";
var patharray=path.split("/");
cerror();
function cerror(){
	var path = location.pathname+"/";

var patharray=path.split("/");
patharray.pop();
  var ce=$("#div_list").children();

var lap=patharray.pop();

var hpb=true;
var ac = "-a-";

 if (lap.indexOf(ac) > -1) {hpb=false;}	 
 
 if (ce.hasClass("error404")&&hpb) {
 	
 $(".product_bar").css({"display":"none"});

 }
 
}

$("header #div_search input").change(function(){

ctrl();

}) 

function ctrl(){
//expresion regular /^[]*$/
	 var href_search=$("header #div_search input").val();
	

var control= /^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]*$/;

	 if (!control.test(href_search)) {
	 	 

	 	 $("header #div_search input").val("");
	 

	 }	 else{
    	
	var search_replaced=href_search.replace(/[áéíóúÁÉÍÓÚ ]/g, "_");
	 
 	return search_replaced;
	    
	  }
}

 function search(){
 	var new_u=ctrl();
 	var url_search=$("header #div_search a").attr("href");
 	
 	$("header #div_search a").attr("href",url_search+"/"+new_u );
    }

$("header #div_search  a").click(function(){
	
	if ($("header #div_search input").val()!="" ) {
		search();
	}else{
		
		var href_n= $("#site_u").val();
		$("header #div_search a").attr("href", href_n);
	}

})




$("header #div_search input").focus(function(){

$(document).keyup(function(event){

event.preventDefault();
if(event.keyCode==13&&$("header #div_search input").val()!="")	{
	search();	
 var url_search=$("header #div_search a").attr("href");
 $("header #div_search  input").val("");
	 window.location.href=url_search;
}
})

})


function openNav() {
  document.getElementById("sidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
   $(".side_nav i").html("Cancelar");



}

function closeNav() {
  document.getElementById("sidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
     $(".side_nav i").html("Filtrar");
  
 
}

$("#side_btn_").click(function(){

var option= $(".side_nav span").attr("class");

 
if ( option.includes("close")) {
closeNav();
 $(".side_nav span").removeClass("fa fa-close");
   $(".side_nav span").addClass("fa fa-plus");
}else{
openNav();
   $(".side_nav span").removeClass("fa fa-plus");
   $(".side_nav span").addClass("fa fa-close");

}})

$("#sbps").click(function(){
	var ulrref= $("#btn_pf").attr("href");
	var kg=false;
	
	var urlr=ulrref;
	var urr=""
	var control_n=  /^[0-9]+$/;
	var minv=$("#minpsn").val();
	
	if (!minv) {minv="";}
	var maxv=$("#maxpsn").val();
	if (!maxv) {maxv="";}
if (!control_n.test(minv)) {$("#minpsn").val("");}else{kg=true;}

if (!control_n.test(maxv)) {$("#maxpsn").val("");}else{kg=true;}
if ($("#minpsn").val()=="" ) {minv=0;}
if ($("#maxpsn").val()=="" ) {maxv="max";}
if (kg) {urr=ulrref+minv+"-a-"+maxv;

 
$("#btn_pf").attr("href", urr);
$("#maxpsn").prop("disabled", true);
$("#minpsn").prop("disabled", true);
}
if ($("#minpsn").val()==""&&$("#maxpsn").val()=="") {
 
$("#btn_pf").attr("href", path.slice(0,-1));


}


})