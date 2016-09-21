<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * GroupMedias Controller
 *
 * @property \App\Model\Table\GroupMediasTable $GroupMedias
 */
class GroupMediasController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['AllCases']
        ];
        $this->set('groupMedias', $this->paginate($this->GroupMedias));
        $this->set('_serialize', ['groupMedias']);
    }

    /**
     * View method
     *
     * @param string|null $id Group Media id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $groupMedia = $this->GroupMedias->get($id, [
            'contain' => ['AllCases']
        ]);
        $this->set('groupMedia', $groupMedia);
        $this->set('_serialize', ['groupMedia']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $groupMedia = $this->GroupMedias->newEntity();
        if ($this->request->is('post')) {
            $groupMedia = $this->GroupMedias->patchEntity($groupMedia, $this->request->data);
            if ($this->GroupMedias->save($groupMedia)) {
                $this->Flash->success(__('The group media has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The group media could not be saved. Please, try again.'));
            }
        }
        $allCases = $this->GroupMedias->AllCases->find('list', ['limit' => 200]);
        $this->set(compact('groupMedia', 'allCases'));
        $this->set('_serialize', ['groupMedia']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Group Media id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $groupMedia = $this->GroupMedias->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $groupMedia = $this->GroupMedias->patchEntity($groupMedia, $this->request->data);
            if ($this->GroupMedias->save($groupMedia)) {
                $this->Flash->success(__('The group media has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The group media could not be saved. Please, try again.'));
            }
        }
        $allCases = $this->GroupMedias->AllCases->find('list', ['limit' => 200]);
        $this->set(compact('groupMedia', 'allCases'));
        $this->set('_serialize', ['groupMedia']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Group Media id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $groupMedia = $this->GroupMedias->get($id);
        if ($this->GroupMedias->delete($groupMedia)) {
            $this->Flash->success(__('The group media has been deleted.'));
        } else {
            $this->Flash->error(__('The group media could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
