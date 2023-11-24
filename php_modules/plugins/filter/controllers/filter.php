<?php
namespace App\plugins\filter\controllers;

use SPT\Response;
use SPT\Web\ControllerMVVM;

class filter extends ControllerMVVM
{
    public function list()
    {
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
        $this->app->set('layout', 'filter.list');
    }

    public function detail()
    {
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
        $this->app->set('layout', 'filter.form');
    }

    public function add()
    {
        $data = [
            'name' => $this->request->post->get('name', '', 'string'),
            'description' => $this->request->post->get('description', '', 'string'),
            'parent_id' => $this->request->post->get('parent_id', 0, 'int'),
        ];

        $try = $this->TagModel->add($data);

        $message = $try ? 'Create Successfully!' : 'Error: '. $this->TagModel->getError();

        $this->session->set('flashMsg', $message);
        return $this->app->redirect(
            $this->router->url('tags')
        );
    }

    public function update()
    {
        $id = $this->validateID(); 

        if(is_numeric($id) && $id)
        {
            $data = [
                'name' => $this->request->post->get('name', '', 'string'),
                'description' => $this->request->post->get('description', '', 'string'),
                'parent_id' => $this->request->post->get('parent_id', 0, 'int'),
                'id' => $id,
            ];
        
            $try = $this->TagModel->update($data);
            $message = $try ? 'Update Successfully!' : 'Error: '. $this->TagModel->getError();
            
            $this->session->set('flashMsg', $message);
            return $this->app->redirect(
                $this->router->url('tags')
            );
        }

        $this->session->set('flashMsg', 'Error: Invalid Task!');
        return $this->app->redirect(
            $this->router->url('tags')
        );
    }

    public function delete()
    {
        $ids = $this->validateID();
        $count = 0;
        if( is_array($ids))
        {
            foreach($ids as $id)
            {
                //Delete file in source
                if( $this->TagModel->remove( $id ) )
                {
                    $count++;
                }
            }
        }
        elseif( is_numeric($ids) )
        {
            if( $this->TagModel->remove($ids ) )
            {
                $count++;
            }
        }  
        

        $this->session->set('flashMsg', $count.' deleted record(s)');
        return $this->app->redirect(
            $this->router->url('tags'), 
        );
    }

    public function validateID()
    {
        $urlVars = $this->request->get('urlVars');
        $id = $urlVars ? (int) $urlVars['id'] : 0;

        if(empty($id))
        {
            $ids = $this->request->post->get('ids', [], 'array');
            if(count($ids)) return $ids;

            $this->session->set('flashMsg', 'Invalid Tag');
            return $this->app->redirect(
                $this->router->url('tags'),
            );
        }

        return $id;
    }
}