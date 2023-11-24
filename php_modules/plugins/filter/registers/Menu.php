<?php
namespace App\plugins\filter\registers;

use SPT\Application\IApp;
use SPT\Support\Loader;

class Menu
{
    public static function registerItem( IApp $app )
    {
        $container = $app->getContainer();
        $router = $container->get('router');
        $path_current = $router->get('actualPath');

        $active = strpos($path_current, '/my-filters') !== false ? 'active' : '';
        $menu = [[
            'link' => $router->url('my-filters'), 
            'title' => 'My Filters', 
            'icon' => '<i class="fa-solid fa-filter"></i>',
            'class' => $active,
        ]];
       
        return [
            'menu'=> $menu,
            'order' => 3,
        ];
    }
}