document.getElementById('ajout_service').addEventListener('click', function() {
    var newServiceName = document.getElementById('categorieRecherche').value;
    fetch('ServiceController.php', {
        method: 'POST',
        body: JSON.stringify({ serviceName: newServiceName }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            var select = document.getElementById('categorieRecherche');
            var option = document.createElement('option');
            option.value = data.id;
            option.textContent = newServiceName;
            select.appendChild(option);
        } else {
            // Gérez les erreurs ici
        }
    });
});
