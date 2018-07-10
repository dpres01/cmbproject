$(document).ready(function()
{
	$("#respmn").click(function(){
		$("#respmnicnop").toggle();
		$("#respmnicncl").toggle();
		$("#resp-user").hide();
		$("#resp-menu").toggle();
		$("#respusericnop").show();
		$("#respusericncl").hide();
	});
	$("#respuser").click(function(){		
		$("#respusericnop").toggle();
		$("#respusericncl").toggle();
		$("#respmnicnop").show();
		$("#respmnicncl").hide();
		$("#resp-menu").hide();
		$("#resp-user").toggle();
	});
	//fly menu
    $(window).scroll(function(){ positionMenu(); });
    positionMenu();
});
var fix = 0;
//menu flottant
function positionMenu()
{
	var doc = document.documentElement;
    var top = (window.pageYOffset || doc.scrollTop)  - (doc.clientTop || 0);
    if(top >= 120)
    {
        fix = 1;  
        $(".srchinp").css("height", "30px");   
        $(".srchcheck").addClass("srchcheck-fix"); 
        $(".srchboxall").addClass("srchboxall-fix"); 
        $(".srchbtn").addClass("srchbtn-fix"); 
        $("#srcbox").addClass("srchbox-fix");
    }
    else if(fix == 1)
    {
        fix = 0;
        $(".srchinp").css("height", "50px");
        $(".srchcheck").removeClass("srchcheck-fix"); 
        $(".srchboxall").removeClass("srchboxall-fix"); 
        $(".srchbtn").removeClass("srchbtn-fix"); 
        $("#srcbox").removeClass("srchbox-fix"); 
    }
}