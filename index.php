<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/fonctions.php';

$patients = [
    ['id' => 1, 'nom' => 'Sara Brnali', 'age' => 70, 'categorie' => 'CARDIO', 'code_urgence' => 'ROUGE'],
    ['id' => 2, 'nom' => 'Ahmed Trabelsi', 'age' => 45, 'categorie' => 'DERMA', 'code_urgence' => 'ORANGE'],
    ['id' => 3, 'nom' => 'Amina Jlassi', 'age' => 8, 'categorie' => 'PEDIATRIE', 'code_urgence' => 'VERT'],
    ['id' => 4, 'nom' => 'Karim Ayari', 'age' => 68, 'categorie' => 'CARDIO', 'code_urgence' => 'VERT'],
];

foreach ($patients as $index => $patient) {
    $patients[$index]['tarif'] = calculerFacter($patient['age']);
    $patients[$index]['badge'] = getBadgeService($patient['categorie']);
    $patients[$index]['libelle_urgence'] = getLibelleUrgence($patient['code_urgence']);
}

$urgencesAbsolues = filtrerUrgence($patients);
$total = array_sum(array_column($patients, 'tarif'));
$urgencesParCode = array_count_values(array_column($patients, 'code_urgence'));
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Suivi des patients</title>
</head>
<body>
    <main class="conteneur">
        <header class="entete">
            <p class="sur-titre">Tableau de bord</p>
            <h1>Suivi des patients</h1>
            <p>Consultations et niveaux d'urgence</p>
        </header>

        <section class="resume" aria-label="Résumé">
            <div class="resume-item">
                <strong><?= count($patients) ?></strong>
                <span>patients</span>
            </div>
            <div class="resume-item urgence-absolue">
                <strong><?= count($urgencesAbsolues) ?></strong>
                <span>urgence(s) absolue(s)</span>
            </div>
        </section>

        <section class="patients" aria-labelledby="patients-titre">
            <h2 id="patients-titre">Liste des patients</h2>
            <div class="grille">
                <?php foreach ($patients as $patient): ?>
                    <article class="carte">
                        <div class="carte-entete">
                            <h3><?= htmlspecialchars($patient['nom'], ENT_QUOTES, 'UTF-8') ?></h3>
                            <span class="code code-<?= strtolower($patient['code_urgence']) ?>">
                                <?= htmlspecialchars($patient['code_urgence'], ENT_QUOTES, 'UTF-8') ?>
                            </span>
                        </div>
                        <p><?= $patient['age'] ?> ans</p>
                        <p><span class="badge <?= htmlspecialchars($patient['badge']['classe'], ENT_QUOTES, 'UTF-8') ?>">
                            <?= htmlspecialchars($patient['badge']['libelle'], ENT_QUOTES, 'UTF-8') ?>
                        </span></p>
                        <p class="libelle-urgence"><?= htmlspecialchars($patient['libelle_urgence'], ENT_QUOTES, 'UTF-8') ?></p>
                        <strong>Tarif : <?= number_format($patient['tarif'], 2, ',', ' ') ?> €</strong>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="recap" aria-labelledby="recap-titre">
            <h2 id="recap-titre">Récapitulatif</h2>
            <div class="recap-statistiques">
                <p><strong><?= count($patients) ?></strong> patient(s) au total</p>
                <p><strong><?= $urgencesParCode['ROUGE'] ?? 0 ?></strong> urgence(s) <span class="code code-rouge">ROUGE</span></p>
                <p><strong><?= $urgencesParCode['ORANGE'] ?? 0 ?></strong> urgence(s) <span class="code code-orange">ORANGE</span></p>
                <p><strong><?= $urgencesParCode['VERT'] ?? 0 ?></strong> consultation(s) <span class="code code-vert">VERT</span></p>
            </div>
            <p>Total estimé : <strong><?= number_format($total, 2, ',', ' ') ?> €</strong></p>
            <h3>Patients par urgence</h3>
            <ul class="liste-recap">
                <?php foreach ($patients as $patient): ?>
                    <li>
                        <span class="code code-<?= strtolower($patient['code_urgence']) ?>">
                            <?= htmlspecialchars($patient['code_urgence'], ENT_QUOTES, 'UTF-8') ?>
                        </span>
                        <strong><?= htmlspecialchars($patient['nom'], ENT_QUOTES, 'UTF-8') ?></strong>
                        <span><?= htmlspecialchars($patient['badge']['libelle'], ENT_QUOTES, 'UTF-8') ?></span>
                        <small><?= htmlspecialchars($patient['libelle_urgence'], ENT_QUOTES, 'UTF-8') ?></small>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </main>
</body>
</html>
