<?php
    require 'Connexion.php';
?>

<?php
// 2. On vérifie si le bouton "btn_ajouter" a bien été cliqué
if (isset($_POST['btn_ajouter'])) {
    
    // Récupération des données envoyées par le formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $id_fil = $_POST['id_fil'];

    // 3. Préparation de la requête d'insertion
    // On utilise des marqueurs (?) pour la sécurité
    $sql = "INSERT INTO etudiants (nom, prenom, id_fil) VALUES (?, ?, ?)";
    $req = $k->prepare($sql);

    // 4. Exécution de la requête avec les valeurs récupérées
    if ($req->execute([$nom, $prenom, $id_fil])) {
        // Si ça marche, on redirige vers l'index
        header("Location: index.php");
        exit();
    } else {
        echo "Une erreur est survenue lors de l'enregistrement.";
    }

} else {
    // Si quelqu'un essaie d'accéder à ce fichier sans passer par le formulaire
    header("Location: index.php");
    exit();
}
?>