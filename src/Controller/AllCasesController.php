<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AllCases Controller
 *
 * @property \App\Model\Table\AllCasesTable $AllCases
 */
class AllCasesController extends AppController
{


    public function currentCase() {
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('allCases', $this->paginate($this->AllCases));
        $this->set('_serialize', ['allCases']);
    }

    /**
     * View method
     *
     * @param string|null $id All Case id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $allCase = $this->AllCases->get($id, [
            'contain' => []
        ]);
        $this->set('allCase', $allCase);
        $this->set('_serialize', ['allCase']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $allCase = $this->AllCases->newEntity();
        if ($this->request->is('post')) {
            $allCase = $this->AllCases->patchEntity($allCase, $this->request->data);
            if ($this->AllCases->save($allCase)) {
                $this->Flash->success(__('The all case has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The all case could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('allCase'));
        $this->set('_serialize', ['allCase']);
    }

    /**
     * Edit method
     *
     * @param string|null $id All Case id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $allCase = $this->AllCases->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $allCase = $this->AllCases->patchEntity($allCase, $this->request->data);
            if ($this->AllCases->save($allCase)) {
                $this->Flash->success(__('The all case has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The all case could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('allCase'));
        $this->set('_serialize', ['allCase']);
    }

    /**
     * Delete method
     *
     * @param string|null $id All Case id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $allCase = $this->AllCases->get($id);
        if ($this->AllCases->delete($allCase)) {
            $this->Flash->success(__('The all case has been deleted.'));
        } else {
            $this->Flash->error(__('The all case could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
