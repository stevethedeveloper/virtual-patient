<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

/**
 * ContentPages Controller
 *
 * @property \App\Model\Table\ContentPagesTable $ContentPages
 */
class ContentPagesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'limit' => 20,
            'order' => ['ContentPages.title ASC']
        ];
        $contentPages = $this->paginate($this->ContentPages);

        $this->set(compact('contentPages'));
        $this->set('_serialize', ['contentPages']);
    }

    /**
     * View method
     *
     * @param string|null $id Content Page id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contentPage = $this->ContentPages->get($id, [
            'contain' => ['PageTypes']
        ]);

        $this->set('contentPage', $contentPage);
        $this->set('_serialize', ['contentPage']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contentPage = $this->ContentPages->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['slug'] = slugify($this->request->data['title']);
            $contentPage = $this->ContentPages->patchEntity($contentPage, $this->request->data);
            if ($result = $this->ContentPages->save($contentPage)) {
                $this->Flash->success(__('The content page has been saved.'));
                return $this->redirect(['action' => 'edit', $result->id]);
            } else {
                $this->Flash->error(__('The content page could not be saved. Please, try again.'));
            }
        }
        $pageTypes = $this->ContentPages->PageTypes->find('list', ['limit' => 200]);
        $this->set(compact('contentPage', 'pageTypes'));
        $this->set('_serialize', ['contentPage']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Content Page id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contentPage = $this->ContentPages->get($id, [
            'contain' => []
        ]);

        if ($contentPage->page_type_id == 3) {
            return $this->redirect(['action' => 'edit_video', $id]);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['slug'] = slugify($this->request->data['title']);
            $contentPage = $this->ContentPages->patchEntity($contentPage, $this->request->data);
            if ($this->ContentPages->save($contentPage)) {
                $this->Flash->success(__('The content page has been saved.'));
                return $this->redirect(['action' => 'edit', $id]);
            } else {
                $this->Flash->error(__('The content page could not be saved. Please, try again.'));
            }
        }
        $pageTypes = $this->ContentPages->PageTypes->find('list', ['limit' => 200]);
        $this->set(compact('contentPage', 'pageTypes'));
        $this->set('_serialize', ['contentPage']);
    }

    public function editVideo($id = null)
    {
        $contentPage = $this->ContentPages->get($id, [
            'contain' => ['Videos']
        ]);
        //pr($contentPage);die;
        
        $newVideo = $this->ContentPages->Videos->newEntity();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $video = $this->ContentPages->Videos->newEntity();
            $this->request->data['display_order'] = $this->ContentPages->Videos->getDisplayOrder($this->request->data['content_page_id']);
            $video = $this->ContentPages->Videos->patchEntity($video, $this->request->data);
            if ($this->ContentPages->Videos->save($video)) {
                $this->Flash->success(__('The video has been saved.'));
                return $this->redirect(['action' => 'editVideo', $id]);
            } else {
                $this->Flash->error(__('The video could not be saved. Please, try again.'));
            }
        }
        $pageTypes = $this->ContentPages->PageTypes->find('list', ['limit' => 200]);
        $this->set(compact('contentPage', 'pageTypes', 'newVideo'));
        $this->set('_serialize', ['contentPage']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Content Page id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contentPage = $this->ContentPages->get($id);
        if ($this->ContentPages->delete($contentPage)) {
            $this->Flash->success(__('The content page has been deleted.'));
        } else {
            $this->Flash->error(__('The content page could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function deleteVideo($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $video = $this->ContentPages->Videos->get($id);
        if ($this->ContentPages->Videos->delete($video)) {
            $this->Flash->success(__('The video has been deleted.'));
        } else {
            $this->Flash->error(__('The video could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'edit-video', $video->content_page_id]);
    }

    public function changeVideoOrder() {
        $this->autoRender = false;
        $arr = $this->request->data;

        $connection = ConnectionManager::get('default');

        $count = 1;
        foreach ($arr['data'] as $option) {
            $option_id = substr($option, strrpos($option, '_') + 1);
            $connection->update('videos', ['display_order' => $count], ['id' => $option_id]);
            $count++;
        }
    }
}
