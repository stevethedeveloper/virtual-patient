<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * VpYields Controller
 *
 * @property \App\Model\Table\VpYieldsTable $VpYields
 */
class VpYieldsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('vpYields', $this->paginate($this->VpYields));
        $this->set('_serialize', ['vpYields']);
    }

    /**
     * View method
     *
     * @param string|null $id Vp Yield id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vpYield = $this->VpYields->get($id, [
            'contain' => []
        ]);
        $this->set('vpYield', $vpYield);
        $this->set('_serialize', ['vpYield']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $vpYield = $this->VpYields->newEntity();
        if ($this->request->is('post')) {
            $vpYield = $this->VpYields->patchEntity($vpYield, $this->request->data);
            if ($this->VpYields->save($vpYield)) {
                $this->Flash->success(__('The vp yield has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The vp yield could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('vpYield'));
        $this->set('_serialize', ['vpYield']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Vp Yield id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $vpYield = $this->VpYields->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vpYield = $this->VpYields->patchEntity($vpYield, $this->request->data);
            if ($this->VpYields->save($vpYield)) {
                $this->Flash->success(__('The vp yield has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The vp yield could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('vpYield'));
        $this->set('_serialize', ['vpYield']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Vp Yield id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vpYield = $this->VpYields->get($id);
        if ($this->VpYields->delete($vpYield)) {
            $this->Flash->success(__('The vp yield has been deleted.'));
        } else {
            $this->Flash->error(__('The vp yield could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
