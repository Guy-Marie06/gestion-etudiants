<?php
    require 'Connexion.php';

    // 1. Récupérer les filières depuis la base de données
    $query = $k->query("SELECT id_fil, lib_fil FROM filieres");
    $filieres = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Étudiants</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

    <div class="container">
        <header>
            <h1>Gestion des Étudiants</h1>
        </header>

        <main>
            <section class="form-section">
                <h2>Ajouter un étudiant</h2>
                
                <form action="traitement.php" method="POST">
                    
                    <div class="form-group">
                        <label for="nom">Nom :</label>
                        <input type="text" id="nom" name="nom" required placeholder="Saisir le nom">
                    </div>

                    <div class="form-group">
                        <label for="prenom">Prénom :</label>
                        <input type="text" id="prenom" name="prenom" required placeholder="Saisir le prénom">
                    </div>

                    <div class="form-group">
                        <label for="filiere">Filière :</label>
                        <select name="id_fil" id="filiere" required>
                            <option value="">-- Sélectionnez une filière --</option>
                            <?php foreach ($filieres as $f): ?>
                                <option value="<?= $f['id_fil'] ?>">
                                    <?= htmlspecialchars($f['lib_fil']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" name="btn_ajouter" class="btn-submit">
                        Enregistrer l'étudiant
                    </button>
                </form>
            </section>
        </main>
    </div>

    <script src="js/script.js"></script>
</body>
</html>