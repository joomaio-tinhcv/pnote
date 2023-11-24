<?php
namespace App\plugins\pnote\registers;

use SPT\Application\IApp;
use App\plugins\pnote\libraries\NoteDispatch;

class Dispatcher
{
    public static function dispatch(IApp $app)
    {
        $app->plgLoad('permission', 'CheckSession');

        $cName = $app->get('controller');
        $fName = $app->get('function');
        // prepare note

        $controller = 'App\plugins\pnote\controllers\\'. $cName;
        if(!class_exists($controller))
        {
            $app->raiseError('Invalid controller '. $cName);
        }

        $controller = new $controller($app->getContainer());
        $controller->{$fName}();
        
        $app->set('theme', $app->cf('adminTheme'));

        $fName = 'to'. ucfirst($app->get('format', 'html'));

        $app->finalize(
            $controller->{$fName}()
        );
    }
}