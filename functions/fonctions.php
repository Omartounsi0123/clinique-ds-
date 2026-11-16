<?php
require_once __DIR__ . "/config.php";
function calculerFacter(int $ag, float $t=TARIF_BASE_CONSULTATION):float
{
if($ag>65)
    {
    $t=$t*1.2;
    }
    return $t;
}
function getBadgeService(string $lib):string
{
    if ($lib === 'CARDIO') {
        return 'cardiologie';
    } elseif ($lib === 'DERMA') {
        return 'dermatologie';
    } elseif ($lib === 'PERDIATRIE') {
        return 'pédiatrie';
    }
}
function filtrerUrgence(array $patients): array
{
    return array_filter($patients, function ($patient) {
        return $patient['urgence'] === "ROUGE";
    });
}
function getLibelleUrgence(string $Urgence): string
{
    switch (strtoupper($Urgence)) {
        case 'ROUGE':
            return 'Urgence absolue';
        case 'ORANGE':
            return 'Urgence relative';
        case 'VERT':
            return 'Consultation standard';

    }
}
?>