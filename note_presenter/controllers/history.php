<?php
/**
 * SPT software - homeController
 *
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic controller
 *
 */

namespace App\pnote\note_presenter\controllers;

use SPT\Response;
use DTM\note\libraries\NoteController;

class history extends NoteController
{
    public function detail()
    {
        $urlVars = $this->request->get('urlVars');
        $id = (int) $urlVars['id'];

        $exist = $this->HistoryEntity->findByPK($id);

        if(!empty($id) && !$exist)
        {
            $this->session->set('flashMsg', "Invalid note");
            return $this->app->redirect(
                $this->router->url('notes')
            );
        }

        $this->app->set('layout', 'backend.history');
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
    }

    public function rollback()
    {
        $id = $this->validateID();
        $try = $this->NotePresenterModel->rollback($id);

        $msg = $try ? 'Rollback Successfully' : $this->NotePresenterModel->getError();

        $link = $try ? 'note/detail/'. $try : 'history/note-presenter/'.$id;
    
        $this->session->set('flashMsg', $msg);
        return $this->app->redirect(
            $this->router->url($link)
        );
    }

    public function validateID()
    {
        
        $urlVars = $this->request->get('urlVars');
        $id = (int) $urlVars['id'];

        if(empty($id))
        {
            $ids = $this->request->post->get('ids', [], 'array');
            if(count($ids)) return $ids;

            $this->session->set('flashMsg', 'Invalid version');
            return $this->app->redirect(
                $this->router->url('notes'),
            );
        }

        return $id;
    }
}