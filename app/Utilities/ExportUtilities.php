<?php

namespace App\Utilities;
class ExportUtilities
{
    public static function convertMaterialToPartNo($material)
    {
        $formattedMaterial = rtrim(sprintf('%.2f', floatval($material)), '0');
        return $formattedMaterial;
    }
}
