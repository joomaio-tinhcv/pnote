<?php
namespace App\plugins\pnote\viewmodels;

use SPT\Web\Gui\Form;
use SPT\Web\Gui\Listing;
use SPT\Web\ViewModel;

class AdminPNote extends ViewModel
{
    public static function register()
    {
        return [
            'layout'=>[
                'pnote.dashboard',
            ]
        ];
    }

    public function dashboard()
    {
        $shortcuts = $this->ShortcutModel->getShortcut();
        
        return [
            'url' => $this->router->url(),
            'shortcuts' => $shortcuts,
            'link_shortcut_form' => $this->router->url('shortcut'),
            'link_shortcut_list' => $this->router->url('shortcuts'),
        ];
    }
}
