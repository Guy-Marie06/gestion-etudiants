// On attend que le document soit chargé
document.addEventListener('DOMContentLoaded', function() {

    // On récupère tous les boutons de suppression
    const boutonsSupprimer = document.querySelectorAll('.btn-confirmer');

    // On attache un événement clic à chaque bouton
    boutonsSupprimer.forEach(bouton => {
        bouton.addEventListener('click', function(event) {
            
            // On affiche la boîte de confirmation
            const confirmation = confirm("Êtes-vous sûr de vouloir supprimer cet étudiant ?");
            
            // Si l'utilisateur clique sur "Annuler"
            if (!confirmation) {
                event.preventDefault(); // On bloque l'envoi vers delete.php
            }
        });
    });

});
