// Attache un gestionnaire d'événement à l'événement 'keyup' du champ de saisie avec l'ID 'employeeName'
$('#employeeName').on('keyup', function () {
    // Obtient la valeur saisie par l'utilisateur
    let value = $(this).val();
    // Vérifie si la longueur de la saisie est supérieure ou égale à 2
    if (value.length >= 2) {
         // Envoie une requête AJAX au serveur
        $.ajax({
            type: 'post',  // Type de la requête (POST)
            url: '/employee/searchAjax/name',  // URL du service de recherche sur le serveur
            data: {'employeeName': value},  // Données envoyées au serveur (nom de l'employé à rechercher)
            success: function (data) {
                // En cas de succès de la requête, met à jour le contenu du conteneur avec la classe 'response-container'
                $('.response-container').html(data);
            }
        });
    } else {
          // Si la longueur de la saisie est inférieure à 2 on vide le contenu du conteneur
       $('.response-container').html('');
    }
});