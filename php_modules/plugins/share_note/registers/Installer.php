<?php
namespace App\plugins\share_note\registers;

use SPT\Application\IApp;

class Installer
{
    public static function info()
    {
        return ['share_note'=>['sdm']];
    }
    
    public static function name()
    {
        return 'Plugin Note';
    }

    public static function detail()
    {
        return [
            'author' => 'Pham Minh',
            'created_at' => '2023-01-03',
            'description' => 'Plugin used to demo how the SPT works'
        ];
    }

    public static function version()
    {
        return '0.0.1';
    }

    public static function install( IApp $app)
    {
        // run sth to prepare the install
    }
    public static function uninstall( IApp $app)
    {
        // run sth to uninstall
    }
    public static function active( IApp $app)
    {
        // run sth to prepare the install
    }
    public static function deactive( IApp $app)
    {
        // run sth to uninstall
    }
}