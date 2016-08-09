<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ContentBlocks Controller
 *
 * @property \App\Model\Table\ContentBlocksTable $ContentBlocks
 */
class ContentBlocksController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Pages', 'ContentBlockTypes']
        ];
        $contentBlocks = $this->paginate($this->ContentBlocks);

        $this->set(compact('contentBlocks'));
        $this->set('_serialize', ['contentBlocks']);
    }

    /**
     * View method
     *
     * @param string|null $id Content Block id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contentBlock = $this->ContentBlocks->get($id, [
            'contain' => ['Pages', 'ContentBlockTypes']
        ]);

        $this->set('contentBlock', $contentBlock);
        $this->set('_serialize', ['contentBlock']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contentBlock = $this->ContentBlocks->newEntity();
        if ($this->request->is('post')) {
            $contentBlock = $this->ContentBlocks->patchEntity($contentBlock, $this->request->data);
            if ($this->ContentBlocks->save($contentBlock)) {
                $this->Flash->success(__('The content block has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The content block could not be saved. Please, try again.'));
            }
        }
        $pages = $this->ContentBlocks->Pages->find('list', ['limit' => 200]);
        $contentBlockTypes = $this->ContentBlocks->ContentBlockTypes->find('list', ['limit' => 200]);
        $this->set(compact('contentBlock', 'pages', 'contentBlockTypes'));
        $this->set('_serialize', ['contentBlock']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Content Block id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contentBlock = $this->ContentBlocks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contentBlock = $this->ContentBlocks->patchEntity($contentBlock, $this->request->data);
            if ($this->ContentBlocks->save($contentBlock)) {
                $this->Flash->success(__('The content block has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The content block could not be saved. Please, try again.'));
            }
        }
        $pages = $this->ContentBlocks->Pages->find('list', ['limit' => 200]);
        $contentBlockTypes = $this->ContentBlocks->ContentBlockTypes->find('list', ['limit' => 200]);
        $this->set(compact('contentBlock', 'pages', 'contentBlockTypes'));
        $this->set('_serialize', ['contentBlock']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Content Block id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contentBlock = $this->ContentBlocks->get($id);
        if ($this->ContentBlocks->delete($contentBlock)) {
            $this->Flash->success(__('The content block has been deleted.'));
        } else {
            $this->Flash->error(__('The content block could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
