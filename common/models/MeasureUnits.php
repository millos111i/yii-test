<?php

namespace common\models;

class MeasureUnits
{
    const M = "m";
    const MM = "mm";
    const CM = "cm";

    public static function getArray()
    {
        return array(
            MeasureUnits::M => MeasureUnits::M, 
            MeasureUnits::MM => MeasureUnits::MM, 
            MeasureUnits::CM => MeasureUnits::CM
        );
    }
}

?>