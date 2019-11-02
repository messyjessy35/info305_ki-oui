$('form.ajax').on('submit', function() {
    
    //Recuperation du formulaire et des données de soumission
    var form = $(this),
        url = form.attr('action'),
        type = form.attr('method'),
        data = {};

    //Creation de l'objet qui contient les données noms/valeurs
    form.find('[name]').each(function(index, value) {
        
        var input = $(this),
            name = input.attr('name'),
            value = input.val();
        
        data[name] = value;

    });



    $.ajax({

        url: url,
        type: type,
        data: data,
        //Fonction executée avant l'envoi du formulaire
        beforeSend: function(){

            //Desactivation des champs
            document.querySelector('input[type="submit"]').setAttribute('disabled', 'disabled');
            document.querySelector('input[type="submit"]').setAttribute('value', ' • • • ');

            for (let inputDisabled of document.querySelectorAll('input:not([disabled])')) {
                inputDisabled.setAttribute('disabled', 'disabled');
            }
        },
        //Fonction executée lorsque l'on reçoit une reponse du php
        success: function(response) {
            
            setTimeout(function() {

                //Separation des elements de la reponse
                responseArray = response.split("#");

                //Div qui affiche le message retour
                var alertDiv = document.querySelector('#hint_' + data['action']);

                if (responseArray[0] == "SUCCESS") {
                    alertDiv.setAttribute('class', 'alert alert-success');
                    alertDiv.innerHTML = '<i class="fas fa-check-circle"></i>  &nbsp; ' + responseArray[1];

                    //Redirection si lien non "null"
                    if (responseArray[2] != "null") {
                        setTimeout(function() { window.location.href = responseArray[2]; }, 1000);
                    }
                    
                } else {
                    alertDiv.setAttribute('class', 'alert alert-warning');
                    alertDiv.innerHTML = '<i class="fas fa-exclamation-circle"></i>  &nbsp; ' + responseArray[1];
                }

                //Affichage du div message
                alertDiv.removeAttribute('style');
                
                //Réactivation des champs
                document.querySelector('input[type="submit"]').removeAttribute('disabled');
                document.querySelector('input[type="submit"]').setAttribute('value', 'Me connecter');
                document.querySelector('input[type="password"]').value = "";

                for (let inputDisabled of document.querySelectorAll("input[disabled='disabled']")) {
                    inputDisabled.removeAttribute('disabled');
                }

            }, 100);
        }

    });



    return false;
});