<?php

/**
 * SPT software - ViewModel
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: A simple View Model
 * 
 */

namespace App\plugins\filter\viewmodels;

use SPT\Web\ViewModel;
use SPT\Web\Gui\Form;

class AdminFilter extends ViewModel
{
    public static function register()
    {
        return [
            'layout' => [
                'filter.form',
            ]
        ];
    }
    
    private function getItem()
    {
        $urlVars = $this->request->get('urlVars');
        $id = $urlVars && isset($urlVars['id']) ? (int) $urlVars['id'] : 0;

        $data = $this->FilterModel->getDetail($id);
        return $data;
    }

    public function form()
    {
        $data = $this->getItem();
        $id = isset($data['id']) ? $data['id'] : 0;
        $form = new Form($this->getFormFields(), $data);
        $button_header = [
            [
                'link' => $this->router->url('my-filters'),
                'class' => 'btn btn-outline-secondary me-2',
                'title' => 'Cancel',
            ],
            [  
                'link' => '#',
                'class' => 'btn btn-outline-success btn_save_close me-2',
                'title' => 'Save & Close',
            ], 
            [
                'link' => '#',
                'class' => 'btn btn-outline-success btn_apply',
                'title' => 'Apply',
            ],
        ];

        $tags = [];
        if ($data && $data['tags'])
        {
            foreach($data['tags'] as $tag_id)
            {
                $tag = $this->TagEntity->findByPK($tag_id);
                if ($tag)
                {
                    $tags[] = $tag;
                }
            }
        }

        return [
            'id' => $id,
            'form' => $form,
            'data' => $data,
            'tags' => $tags,
            'button_header' => $button_header,
            'title_page' => 'My Filter Form',
            'url' => $this->router->url(),
            'link_tag' => $this->router->url('tag/search'),
            'link_list' => $this->router->url('my-filters'),
            'link_form' => $this->router->url('my-filter/edit'),
        ];
        
    }

    public function getFormFields($data = [])
    {
        $users = $this->UserEntity->list(0, 0);
        $groups = $this->GroupEntity->list(0, 0);
        $option_user = [[
            'text' => 'Select User',
            'value' => '',
        ]];

        $option_permission = [];
        
        foreach ($users as $user) 
        {
            $option_user[] = [
                'text' => $user['name'],
                'value' => $user['id'],
            ];
        }

        $option_permission[] = [
            'text' => 'User',
            'option' => $option_user,
        ];

        $option_permission[] = [
            'text' => 'Group',
            'option' => $option_user,
        ];

        $fields = [
            'tags' => [
                'tinymce',
                'label' => '',
                'formClass' => 'form-control',
            ],
            'name' => [
                'text',
                'showLabel' => false,
                'placeholder' => 'Filter Name',
                'formClass' => 'form-control',
                'required' => 'required',
            ],
            'shortcut_name' => [
                'text',
                'showLabel' => false,
                'placeholder' => 'Shortcut Name',
                'formClass' => 'form-control',
            ],
            'shortcut_link' => [
                'text',
                'showLabel' => false,
                'placeholder' => 'Shortcut Link',
                'formClass' => 'form-control',
            ],
            'shortcut_group' => [
                'text',
                'showLabel' => false,
                'placeholder' => 'Shortcut Group',
                'formClass' => 'form-control',
            ],
            'start_date' => ['date',
                'formClass' => 'form-control',
            ],
            'end_date' => ['date',
                'formClass' => 'form-control',
            ],
            'tags' => [
                'type' => 'multiselect',
                'option',
                'formClass' => 'form-select',
                'default' => 'note',
                'options' => [],
            ],
            'creator' => ['option',
                'type' => 'multiselect',
                'formClass' => 'form-select',
                'default' => 'note',
                'options' => $option_user,
            ],
            'permission' => ['option',
                'type' => 'optgroup',
                'formClass' => 'form-select',
                'default' => 'note',
                'options' => $option_permission,
            ],
            'select_object' => ['option',
                'formClass' => 'form-select',
                'default' => 'note',
                'options' => [
                    ['text' => 'Note', 'value' => 'note'],
                ],
                'showLabel' => false
            ],

            'token' => ['hidden',
                'default' => $this->token->value(),
            ],
        ];

        return $fields;
    }
}
