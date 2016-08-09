<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PageTypes Controller
 *
 * @property \App\Model\Table\PageTypesTable $PageTypes
 */
class PageTypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $pageTypes = $this->paginate($this->PageTypes);

        $this->set(compact('pageTypes'));
        $this->set('_serialize', ['pageTypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Page Type id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pageType = $this->PageTypes->get($id, [
            'contain' => ['ContentPages']
        ]);

        $this->set('pageType', $pageType);
        $this->set('_serialize', ['pageType']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pageType = $this->PageTypes->newEntity();
        if ($this->request->is('post')) {
            $pageType = $this->PageTypes->patchEntity($pageType, $this->request->data);
            if ($this->PageTypes->save($pageType)) {
                $this->Flash->success(__('The page type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The page type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('pageType'));
        $this->set('_serialize', ['pageType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Page Type id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pageType = $this->PageTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pageType = $this->PageTypes->patchEntity($pageType, $this->request->data);
            if ($this->PageTypes->save($pageType)) {
                $this->Flash->success(__('The page type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The page type could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('pageType'));
        $this->set('_serialize', ['pageType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Page Type id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pageType = $this->PageTypes->get($id);
        if ($this->PageTypes->delete($pageType)) {
            $this->Flash->success(__('The page type has been deleted.'));
        } else {
            $this->Flash->error(__('The page type could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
