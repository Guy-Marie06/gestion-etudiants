<?php
    require 'Connexion.php';

    // 1. Récupérer les filières depuis la base de données
    $query = $k->query("SELECT id_fil, lib_fil FROM filieres");
    $filieres = $query->fetchAll();

    // 2. Récupération des étudiants avec le nom de leur filière
    // On lie la table etudiant à la table filieres (f)
    $sqlEtu = "SELECT e.id_etu, e.nom, e.prenom, f.lib_fil 
           FROM etudiants e 
           JOIN filieres f ON e.id_fil = f.id_fil 
           ORDER BY e.id_etu DESC";
    $queryEtu = $k->query($sqlEtu);
    $etudiants = $queryEtu->fetchAll();
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
            <section class="list-section">
                <h2>Liste des étudiants enregistrés</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Filière</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($etudiants as $etu): ?>
                        <tr>
                            <td><?= htmlspecialchars($etu['nom']) ?></td>
                            <td><?= htmlspecialchars($etu['prenom']) ?></td>
                            <td><?= htmlspecialchars($etu['lib_fil']) ?></td>
                            <td>
                                <!-- Liens pour les prochaines étapes : Modifier et Supprimer -->
                                <a href="update.php?id=<?= $etu['id_etu'] ?>" class="btn-edit">Modifier</a>
                                <a href="delete.php?id=<?= $etu['id_etu'] ?>" class="btn-delete btn-confirmer">Supprimer</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>

    <script src="assets/script.js"></script>
</body>
</html>