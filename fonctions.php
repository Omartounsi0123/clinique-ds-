<?php
require_once __DIR__ . "/config.php";
function calculerFacter(int $ag, float $t=TARIF_BASE_CONSULTATION):float
{
    if ($ag > 65) {
        $t *= 1.2;
    }

    return $t;
}

function getBadgeService(string $lib):array
{
    if ($lib === 'CARDIO') {
        return ['libelle' => 'cardiologie', 'classe' => 'badge-cardio'];
    }

    if ($lib === 'DERMA') {
        return ['libelle' => 'dermatologie', 'classe' => 'badge-derma'];
    }

    if ($lib === 'PEDIATRIE') {
        return ['libelle' => 'pédiatrie', 'classe' => 'badge-pediatrie'];
    }

    return ['libelle' => 'inconnu', 'classe' => 'badge-inconnu'];
}

function filtrerUrgence(array $patients): array
{
    return array_filter($patients, function ($patient) {
        return ($patient['code_urgence'] ?? '') === 'ROUGE';
    });
}

function getLibelleUrgence(string $codeUrgence): string
{
    switch (strtoupper($codeUrgence)) {
        case 'ROUGE':
            return 'Urgence absolue';
        case 'ORANGE':
            return 'Urgence relative';
        case 'VERT':
            return 'Consultation standard';
        default:
            return 'Code d’urgence inconnu';
    }
}