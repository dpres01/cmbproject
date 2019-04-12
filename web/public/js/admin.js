 $(document).ready(function()
{
   dataTableLaunch('#table-annonces');
   dataTableLaunch('#table-signal');
   dataTableLaunch('#table-users');
});

function desactifUser(url,idUser,action){
     //  1 professionnel (Actif/desactif),2 Admin (Actif/desactif), 3 utilisateur (Actif/desactif)
     if( action == 3 ){
        var $value =  $('#id-etat-user').val();
     }
     $.ajax({
            url : url,
            type: 'POST',
            data: { user:idUser, typeAction : action, value : $value},
            success : function(requete){
            $('#id-mess-error').html('<div id="id-msg-envoi-modal" class="alert alert-success" role="alert"> Votre message est envoyé avec success </div>')
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
    // Radialize the colors
    
/*Highcharts.setOptions({
    colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: {
                cx: 0.5,
                cy: 0.3,
                r: 0.7
            },
            stops: [
                [0, color],
                [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
            ]
        };
    })
});*/
}

function chartUpdate(id,data,title,name){
    Highcharts.chart(id, {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: title + new Date().getFullYear()
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                },
                connectorColor: 'silver'
            }
        }
    },
    series: [{
        name: name,
        data: data
    }]
});
    
}

function dataTableLaunch(id){
    $(id).DataTable({
        "scrollY": 400,
        "scrollX": true,
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
}
