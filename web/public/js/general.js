var realUrl = "";
$(document).ready(function()
{
	$("#respmn").click(function(){
		$("#respmnicnop").toggle();
		$("#respmnicncl").toggle();
		$("#resp-user").removeClass("clse-resp-menu");
		//$("#resp-menu").toggle();
		$("#respusericnop").show();
		$("#respusericncl").hide();
		$("#resp-menu").toggleClass("clse-resp-menu");
	});
	$("#respuser").click(function(){
		$("#respusericnop").toggle();
		$("#respusericncl").toggle();
		$("#respmnicnop").show();
		$("#respmnicncl").hide();
		$("#resp-menu").removeClass("clse-resp-menu");
		//$("#resp-user").toggle();
		$("#resp-user").toggleClass("clse-resp-menu");
	});

	$(".signal").click(function(){
	    $('#reportModal').modal('toggle');
            $("input[id^='form_']").val('');
            $("#form_signalement_message").val('');
            $("input:radio").attr("checked",false);
            $('.alert-danger').remove();
            $('.help-block').remove();
	});
	$("#arrusr").click(function(){
	    $("#mreusr").toggle();
	});

        $("#idcontactMess").click(function(){
	    $('#reportModalMess').modal('toggle');
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

	$(".ann-price-num").click(function()
	{
            $("#phone1").toggle();
            $("#phone2").toggle();
	});

//        $("#form_annonce_prix").on('blur',function(){
//            var $tab = [];
//            var $retour = [];
//            var input = $(this).val();
//            if( $.isNumeric(input) || input == ''){
//                for(var i = 0;i < input.length ; i++){
//                 $tab.push(input.substr(i,1));
//                }
//                var t = $tab.length -1
//                var cpt = 1;
//                var ntour = ($tab.length)/3;
//                for(t = $tab.length -1 ;t >= 0 ; t--){
//                    if(cpt == 3 && ntour > 1){
//                       $retour[t] = ',' + $tab[t];
//                       cpt++;
//                       ntour--
//                       cpt = 1;
//                    }else{
//                       $retour[t] = $tab[t];
//                       cpt++;
//                    }
//                }
//                $("#form_annonce_prix").val($retour.join(''));
//                $("#form_annonce_prix").removeAttr('style');
//            }else{
//                $("#form_annonce_prix").css('border-color','red');
//            }
//         })

    //fly menu
    //$(window).scroll(function(){ positionMenu(); });
    //positionMenu();   
// si  on click sur la page dans Mes annonces/comptes utilisateur 
if( $('#page-clic').val() == true){ 
    console.log('ici');
    $('#home').removeClass('active');
    $('#list-1').removeClass('active');
    $('#profile').addClass('active');
    $('#list-2').addClass('active');
    $('#profile').tab('show'); 
    $('#page-clic').val(false);
 }
 
$('#table-annonces').DataTable({
    "language": {
        "lengthMenu": " Afficher _MENU_ par page",
        "zeroRecords": "Aucun element trouvé ",
        "info": " Affichage _START_ à _END_ sur _TOTAL_ elements",
        "infoEmpty": "Aucun element disponible",
        "infoFiltered": "(filtered from _MAX_ total records)",
        "search": "Recherche:",
        "paginate": {
            "next":       "Suivant",
            "previous":   "Précédent"
        },
    }
});
                
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
        $(".srchsel").css("height", "30px");
        $(".srchcheck").addClass("srchcheck-fix");
        $(".srchboxall").addClass("srchboxall-fix");
        $(".srchbtn").addClass("srchbtn-fix");
        $("#srcbox").addClass("srchbox-fix");
        $(".hd-top").addClass("ht-top-mr-resp");
    }
    else if(fix == 1)
    {
        fix = 0;
        $(".srchinp").css("height", "50px");
        $(".srchsel").css("height", "50px");
        $(".srchcheck").removeClass("srchcheck-fix");
        $(".srchboxall").removeClass("srchboxall-fix");
        $(".srchbtn").removeClass("srchbtn-fix");
        $("#srcbox").removeClass("srchbox-fix");
        $(".hd-top").removeClass("ht-top-mr-resp");
    }
}

function filterRmv(_url, cat)
{
	var getter 		 = (_url)   ? _url : location.search;
	getter 	  		 = (getter) ? getter.split("?")[1] : '';
	var vars         = getter.split("&");
	var query_string = {};
	var url 		 = "";

	for(var i = 0; i < vars.length; i++)
	{
		var pair  = vars[i].split("=");
		var key   = decodeURIComponent(pair[0]);
		var value = decodeURIComponent(pair[1]);

		if(key && cat.indexOf(key) < 0)
		{
			if (i === 0)
			{
				url += "?";
			}
			else
			{
				if(url.indexOf('?') == -1 )
				{
					url += "?";
				}
				else
				{
				   url += "&";
				}

			}
			url += key;
			url += '=';
			url += decodeURIComponent(value);
		}

		if (typeof query_string[key] === "undefined") // If first entry with this name
		{
			query_string[key] = decodeURIComponent(value);
		}
		else if (typeof query_string[key] === "string")  // If second entry with this name
		{
			var arr = [query_string[key], decodeURIComponent(value)];
			query_string[key] = arr;
		}
		else  // If third or later entry with this name
		{
			query_string[key].push(decodeURIComponent(value));
		}
	}
	return url;
}

function filterAdd(_url, cat, val)
{
	var getter 		 = (_url)   ? _url : location.search;
	getter 	  		 = (getter) ? getter.split("?")[1] : '';
	var vars         = getter.split("&");
	var query_string = {};
	var url 		 = "";
   // console.log(cat,vars );

	for(var i = 0; i < vars.length; i++)
	{
		var pair  = vars[i].split("=");
		var key   = decodeURIComponent(pair[0]);
		var value = decodeURIComponent(pair[1]);

		if(key && key != cat && val)
		{
			if (i === 0)
			{
				url += "?";
			}
			else
			{
				if(url.indexOf('?') == -1 )
				{
					url += "?";
				}
				else
				{
				   url += "&";
				}

			}
			url += key;
			url += '=';
			url += decodeURIComponent(value);
		}

		if (typeof query_string[key] === "undefined") // If first entry with this name
		{
			query_string[key] = decodeURIComponent(value);
		}
		else if (typeof query_string[key] === "string")  // If second entry with this name
		{
			var arr = [query_string[key], decodeURIComponent(value)];
			query_string[key] = arr;
		}
		else  // If third or later entry with this name
		{
			query_string[key].push(decodeURIComponent(value));
		}
	}
	if(val)
	{
		if(url)
		{
			url += "&"+cat+"="+val;
		}
		else
		{
			url += "?"+cat+"="+val;
		}
	}
	return url;
}
var filterHasValue = 0;
function filterGo(_url)
{
	var url    = _url;
	var filter = 0;
	if($("#cfilter").is(":checked"))
	{
		if($("#pr1").val() || $("#pr2").val())
		{ 
			url = filterAdd(url, "pr", $("#pr1").val()+"_"+$("#pr2").val()); 
			filter = 1;
		}
		url = filterAdd(url, "ft", 1); 
	}
	else
	{
		url = filterRmv(url, ["pr", "ft"]);
	}
	return url;
}
function filterTri()
{
    var url = "";
    url = filterAdd(url, "tr", $("#seltrier").val());
    url = filterGo(url);
    if(url)
    {
            window.location = url;
    }
}
function checker()
{	
	$("#cfilter").click();
}
function filterSel()
{
	if($("#cfilter").is( ":checked" ))
	{$("#filtreform").show();}
	else
	{
		var hasValue = 0;		
		$(".formdatao").each(function()
		{
			if($(this).val())
			{
				hasValue++;
			}
		});
		$("#filtreform").hide();		
		if(hasValue > 0){ filterTri(); }
	}
}

function postAjx(_obj, _callback)
{
	var jqxhr = $.post( "/recherche", _obj, function()
	{
		//alert( "success" );
	}).done(function()
	{
		//alert( "second success" );
		return _callback();
	}).fail(function()
	{
		//alert( "error" );
	}).always(function()
	{
		//alert( "finished" );
	});
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

function sendMessage(url){
    var message = $("#textAmessage").val();
    var nom = $("#nomMessage").val();
    var tel = $("#telMessage").val();
    var email = $("#emailMessage").val();
    $.ajax({
            url : url,
            type: 'POST',
            data: { nom:nom,tel:tel,email:email,message:message},
            success : function(requete){
             $('#id-mess-cntact-error').html('<div id="id-msg-envoi-modal" class="alert alert-success" role="alert"> Votre message est envoyé avec success </div>')
             setTimeout(
                    function()
                    {
                     $('#reportModalMess').modal('toggle');
                    }, 3000);

            },
            statusCode:{
                       400: function(requete) {
                        $('#id-mess-cntact-error').html('<div id="id-msg-envoi-modal" class="alert alert-danger" role="alert"> \n\
                                                                                      Les champs ne doivent pas être vide, \n\
                                                                                      vérifier votre Email soit correct et \n\
                                                                                      téléphone doit être de type numérique </div>')
                        }
                     }
                });
}

function initMessageContact(url,type){

   if(type == 1 ){
       if($('#id-contact-msg').val()!='' && $('#id-contact-msg').val()!='undefined'){
        var form = $("form[name='form_contact']");
        $.ajax({
            url : url+'?type='+type,
            type: 'POST',
            data: form.serialize(),
            success : function(requete){
                        $('#id-add-form').html(requete.template);
                        $("input[id^='form_contact']").val('');
                        $('#form_contact_message').val('');
                        $('#id-contact-msg').val('');
                        $('#msgposter').hide();
            },
            statusCode:{
                       400: function(requete) {
                            //$(requete.responseJSON.template).appendTo($("form[name='form_contact']").empty());
                            $('#id-add-form').html(requete.responseJSON.template);
                            $('#msgposter').show();
                        }
                     }
                });
        }else{
          $('#msgposter').show();
          $('#id-contact-msg').val('open');
        }

   }else {
       var form = $("form[name='form_signalement']");
        $.ajax({
            url : url+'?type='+type,
            type: 'POST',
            data: form.serialize(),
            success : function(requete){
                       $('#reportModal').modal('toggle');
                       $("input[id^='form_']").val('');
                       $("#form_signalement_message").val('');
                       $("input:radio").attr("checked",false);
                       $('<div id="id-msg-envoi-modal" class="alert alert-success" role="alert"> Votre message est envoyé avec success </div>').insertBefore( $('#id-contact-msg'));
            },
            statusCode:{
                       400: function(requete) {
                           $(".modal-body").html(requete.responseJSON.template);
                        }
                     }
                });
   }

}

//compte
$('#myTabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})
