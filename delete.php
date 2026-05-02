<?php
// 1. Inclure la connexion
    require 'Connexion.php';

// 2. Vérifier si l'ID est bien présent dans l'URL
if (isset($_GET['id'])) {
    $id_a_supprimer = $_GET['id'];

    try {
        // 3. Préparer la requête de suppression
        // On utilise un marqueur ? pour la sécurité
        $sql = "DELETE FROM etudiants WHERE id_etu = ?";
        $req = $k->prepare($sql);
        
        // 4. Exécuter la suppression
        $req->execute([$id_a_supprimer]);

        // Redirection vers la page principale après suppression
        header("Location: index.php");
        exit();

    } catch (PDOException $e) {
        die("Erreur lors de la suppression : " . $e->getMessage());
    }

} else {
    // Si on accède au fichier sans ID, on retourne à l'index
    header("Location: index.php");
    exit();
}
?>