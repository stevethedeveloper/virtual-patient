<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ContentBlockTypes Controller
 *
 * @property \App\Model\Table\ContentBlockTypesTable $ContentBlockTypes
 */
class ContentBlockTypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $contentBlockTypes = $this->paginate($this->ContentBlockTypes);

        $this->set(compact('contentBlockTypes'));
        $this->set('_serialize', ['contentBlockTypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Content Block Type id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contentBlockType = $this->ContentBlockTypes->get($id, [
            'contain' => ['ContentBlocks']
        ]);

        $this->set('contentBlockType', $contentBlockType);
        $this->set('_serialize', ['contentBlockType']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contentBlockType = $this->ContentBlockTypes->newEntity();
        if ($this->request->is('post')) {
            $contentBlockType = $this->ContentBlockTypes->patchEntity($contentBlockType, $this->request->data);
            if ($this->ContentBlockTypes->save($contentBlockType)) {
                $this->Flash->success(__('The content block type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The content block type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('contentBlockType'));
        $this->set('_serialize', ['contentBlockType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Content Block Type id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contentBlockType = $this->ContentBlockTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contentBlockType = $this->ContentBlockTypes->patchEntity($contentBlockType, $this->request->data);
            if ($this->ContentBlockTypes->save($contentBlockType)) {
                $this->Flash->success(__('The content block type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The content block type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('contentBlockType'));
        $this->set('_serialize', ['contentBlockType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Content Block Type id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contentBlockType = $this->ContentBlockTypes->get($id);
        if ($this->ContentBlockTypes->delete($contentBlockType)) {
            $this->Flash->success(__('The content block type has been deleted.'));
        } else {
            $this->Flash->error(__('The content block type could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
