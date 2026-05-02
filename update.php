<?php
    require 'Connexion.php';
    
// 1. On récupère l'étudiant à modifier via l'ID dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $k->prepare("SELECT * FROM etudiants WHERE id_etu = ?");
    $stmt->execute([$id]);
    $etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$etudiant) {
        header("Location: index.php");
        exit();
    }
}

// 2. On récupère les filières pour la liste déroulante
$queryFil = $k->query("SELECT * FROM filieres");
$filieres = $queryFil->fetchAll(PDO::FETCH_ASSOC);

// 3. Traitement de la mise à jour si le formulaire est soumis
if (isset($_POST['btn_modifier'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $id_fil = $_POST['id_fil'];
    $id_etu = $_POST['id_etu'];

    $sql = "UPDATE etudiants SET nom = ?, prenom = ?, id_fil = ? WHERE id_etu = ?";
    $stmt = $k->prepare($sql);
    $stmt->execute([$nom, $prenom, $id_fil, $id_etu]);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier l'étudiant</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <header><h1>Modifier l'étudiant</h1></header>
        
        <form method="POST" id="form-update">
            <!-- Champ caché pour garder l'ID de l'étudiant -->
            <input type="hidden" name="id_etu" value="<?= $etudiant['id_etu'] ?>">

            <div class="form-group">
                <label>Nom :</label>
                <input type="text" name="nom" value="<?= htmlspecialchars($etudiant['nom']) ?>" required>
            </div>

            <div class="form-group">
                <label>Prénom :</label>
                <input type="text" name="prenom" value="<?= htmlspecialchars($etudiant['prenom']) ?>" required>
            </div>

            <div class="form-group">
                <label>Filière :</label>
                <select name="id_fil" required>
                    <?php foreach ($filieres as $f): ?>
                        <option value="<?= $f['id_fil'] ?>" <?= ($f['id_fil'] == $etudiant['id_fil']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($f['lib_fil']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" name="btn_modifier" class="btn-submit">Mettre à jour</button>
            <a href="index.php" style="display:block; text-align:center; margin-top:10px; color:#7f8c8d; text-decoration:none;">Annuler</a>
        </form>
    </div>
    <script src="assets/script.js"></script>
</body>
</html>