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
});
//menu flottant
function positionDossierMainButton()
{
	
}