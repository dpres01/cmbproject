 $(document).ready(function()
{
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
}
