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

	$("#arrusr").click(function(){
		$("#mreusr").toggle();
	}); 
   
   $('.add-another-collection-widget').click(function (e) {
    var list = jQuery(jQuery(this).attr('data-list'));
        // Try to find the counter of the list
        var counter = list.data('widget-counter') | list.children().length;
        // If the counter does not exist, use the length of the list
        if (!counter) { counter = list.children().length; }

        // grab the prototype template
        var newWidget = list.attr('data-prototype');
        // replace the "__name__" used in the id and name of the prototype
        // with a number that's unique to your emails
        // end name attribute looks like name="contact[emails][2]"
        newWidget = newWidget.replace(/__name__/g, counter);
        // Increase the counter
        counter++;
        // And store it, the length cannot be used if deleting widgets is allowed
        list.data(' widget-counter', counter);

        // create a new list element and add it to the list
        var newElem = jQuery(list.attr('data-widget-tags')).html(newWidget);
        newElem.appendTo(list);
    });
   
    //fly menu
    $(window).scroll(function(){ positionMenu(); });
    positionMenu();
    //console.log(jquery('.cached'));
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
function shfilter()
{
	var flt = $(".annonce-l").css("float");
	if(flt == "none")
	{
		$("#filter-annonce").toggleClass("shfilter");
		//$(".filter-annonce").removeClass("filter-annonce");
	}
}