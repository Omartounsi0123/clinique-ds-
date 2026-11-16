<?php
require_once __DIR__ . "/config.php";
function calculerFacter(int $ag, float $t=TARIF_BASE_CONSULTATION):float
{
if($ag>65)
    {
        $t=$t*0.8;
    }
    return $t;
}
function getBadgeService(string $lib):string
{
    if ($lib === 'CARDIO') {
        return 'cardiologie';
    } elseif ($lib === 'DERMA') {
        return 'DERMA';
    } elseif ($lib === 'PERDIATRIE') {
        return 'PERDIATRIE';
    }
}
?>