<?php

namespace App\plugins\pnote\note_table\registers;

use SPT\Application\IApp;

class Notetype
{
    public static function registerType()
    {
        return [
            'table' => [
                'namespace' => 'App\plugins\pnote\note_table\\',
                'title' => 'Table'
            ]
        ];
    }
}
