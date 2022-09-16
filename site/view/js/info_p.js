 load();
  $('.flexslider').flexslider({
    animation: "slide",
    animationLoop: false,
    controlNav:true,
    itemMargin: 5,
    itemWidth:100,
    sledeShow:false
  });

    $('.flexslider ul li img').click(function(){

    	var index=$(this).attr("value");
    	$(".info_p figure img").hide();
    	$("#zoom_"+index).show();
 

    });

    /*============================
    =            zoom            =
    ============================*/
    
    $(".info_p figure.viewer img").mouseover(function(event){
        console.log("over");
 
    	var cat_img=$(this).attr("src"); 
       
    	$(".zoom img").attr("src", cat_img);
        $(".zoom").fadeIn("fast");
        $(".zoom img").css("display", "block");
        $(".zoom").css({"height": $(".info_p figure.viewer").height()+"px",
                
                "background":"#eee"

    });

//         $(".zoom img").css("display", "block");
 //       $(".zoom").css("height", $("viewer").height()+"px");


     })
        $(".info_p figure.viewer img").mouseout(function(event){

        var cat_img=$(this).attr("src"); 
        
        $(".zoom img").attr("src", "");
       $(".zoom").fadeIn("fast");/**/

     })
  
 $(".info_p figure.viewer img").mousemove(function(event){

var px= event.offsetX;
var py= event.offsetY; 

$(".zoom img").css({
    "margin-left":-px+"px",
    "margin-top":-py+"px"
})

})

 $("#btnshare").click(function(){

var option= $("#btnshare i").attr("class");
console.log("option");
var n=null;
var p=0;
var btnsf=$("#btnsf");
var btnsi=$("#btnsi");
var btnst=$("#btnst");

    if (option.includes("share")) {
   
        $("#btnshare i").removeClass();
    $("#btnshare i").addClass("fa fa-close");
    $(this).removeClass("w3-green");
    $(this).addClass("w3-red");
        clearInterval(n);
        n=setInterval(frame, 1.5);
        function frame(){
            btnst.css("display", "block");
            btnsi.css("display", "block");
            btnsf.css("display", "block");

              if (p==80) {
                clearInterval(n);
              }else{
                p+=2.5;
                btnsf.css("top", p + "px" );
                btnsf.css("right", p + "px" );        
                btnsi.css("right", p + "px" );   
                btnst.css("top", p + "px" );   
              }
        }

    }else{
            $(this).removeClass("w3-red");
    $(this).addClass("w3-green");
    $("#btnshare i").removeClass();
     $("#btnshare i").addClass("fa fa-share-alt");
            btnst.css("display", "none");
            btnsi.css("display", "none");
            btnsf.css("display", "none");
      
    }
 })

  if (window.matchMedia("(min-width: 768px) and (max-width: 991px)").matches) {
     $("#hrddr").css("display", "none");

  }

  $(window).resize(function() {

load();


});

function load(){

var sol= $("#ip_price").html();  
var p_desc=$("#p_desc").attr("tt");  
var width=$(window).width();
  if (sol=="GRATIS"){
    $(".btn_ip").css("margin-left", 50+"%");
    if(width>=1200) {
     $(".hrddr").css("margin-top",90+"px" );  
    }else if (width<1200&&width>992) {
      $(".hrddr").css("margin-top",31+"px" );
      $(".btn_ip").css("margin-left", 55+"%");

    }else if (width<768) {
      $(".btn_ip").css("margin-left", 0);
    }
  }
  if (p_desc=="virtual") {
    $("#div_buy_lg").css("display", "none");
    $(".hrddr").css("display", "none");
    $("#hrbottom").css("display", "none"); 
    $("#div_buy_md").css("display", "-webkit-inline-box");
    $("#div_buy_md").css("margin-bottom", 17+"px");
    
    }
 }

$(window).on("load", function(){
  var views= $("span.views").html();
  var cv=Number(views)+1;
  $("span.views").html(cv);
var dd= new FormData();
var item= "views";
var urls= location.pathname;
var up=urls.split("/");
var id= up.pop();
dd.append("value", cv);
dd.append("item", item);
dd.append("id", id);


// Se listan los pares clave/valor
// for(let [name, value] of dd) {
//   alert(`${name} = ${value}`); // key1 = value1, luego key2 = value2
// }
$.ajax({
  url:site_url+"ajax/infop_ajax.php",
  method: "POST",
    cache: false,
    contentType: false,
    processData:false,
  data: dd ,
  
  
  success: function(r){
 

  },
  error: function (data) {
                
            }

});


})