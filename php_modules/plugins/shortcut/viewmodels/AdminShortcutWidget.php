<?php
namespace App\plugins\shortcut\viewmodels;

use SPT\Web\Gui\Form;
use SPT\Web\Gui\Listing;
use SPT\Web\ViewModel;

class AdminShortcutWidget extends ViewModel
{
    public static function register()
    {
        return [
            'widget'=>[
                'form',
            ],
        ];
    }

    public function form()
    {
        $form = new Form($this->getFields(), []);
        
        return [
            'form' => $form,
            'url' => $this->router->url(),
            'link_list' =>  '',
            'link_form' => $this->router->url('note/edit'),
            'link_preview' => $this->router->url('note/detail'),
            'token' => $this->token->value(),
        ];
    }

    public function getFields()
    {
        return [
            'name_shortcut' => [
                'text',
                'default' => '',
                'showLabel' => false,
                'formClass' => 'form-control',
                'placeholder' => 'Name',
                'required' => 'required',
            ],
            'link_shortcut' => [
                'text',
                'default' => '',
                'showLabel' => false,
                'formClass' => 'form-control',
                'placeholder' => 'Link',
                'required' => 'required',
            ],
            'group_shortcut' => [
                'text',
                'default' => '',
                'showLabel' => false,
                'formClass' => 'form-control',
                'placeholder' => 'Group',
                'required' => 'required',
            ],
        ];
    }
}
