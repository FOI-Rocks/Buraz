<?php
namespace App;

class Studies {
    private static $studies = [
        1 => 'Informacijski i poslovni sustavi',
        2 => 'Ekonomika poduzetništva',
        3 => 'PITUP'
    ];

    public static function getStudyEnum() {
        return self::$studies;
    }
} 