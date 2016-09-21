<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * GeneralSettings Controller
 *
 * @property \App\Model\Table\GeneralSettingsTable $GeneralSettings
 */
class GeneralSettingsController extends AppController
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
        $this->set('generalSettings', $this->paginate($this->GeneralSettings));
        $this->set('_serialize', ['generalSettings']);
    }

    /**
     * View method
     *
     * @param string|null $id General Setting id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $generalSetting = $this->GeneralSettings->get($id, [
            'contain' => ['AllCases']
        ]);
        $this->set('generalSetting', $generalSetting);
        $this->set('_serialize', ['generalSetting']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $generalSetting = $this->GeneralSettings->newEntity();
        if ($this->request->is('post')) {
            $generalSetting = $this->GeneralSettings->patchEntity($generalSetting, $this->request->data);
            if ($this->GeneralSettings->save($generalSetting)) {
                $this->Flash->success(__('The general setting has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The general setting could not be saved. Please, try again.'));
            }
        }
        $allCases = $this->GeneralSettings->AllCases->find('list', ['limit' => 200]);
        $this->set(compact('generalSetting', 'allCases'));
        $this->set('_serialize', ['generalSetting']);
    }

    /**
     * Edit method
     *
     * @param string|null $id General Setting id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $generalSetting = $this->GeneralSettings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $generalSetting = $this->GeneralSettings->patchEntity($generalSetting, $this->request->data);
            if ($this->GeneralSettings->save($generalSetting)) {
                $this->Flash->success(__('The general setting has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The general setting could not be saved. Please, try again.'));
            }
        }
        $allCases = $this->GeneralSettings->AllCases->find('list', ['limit' => 200]);
        $this->set(compact('generalSetting', 'allCases'));
        $this->set('_serialize', ['generalSetting']);
    }

    /**
     * Delete method
     *
     * @param string|null $id General Setting id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $generalSetting = $this->GeneralSettings->get($id);
        if ($this->GeneralSettings->delete($generalSetting)) {
            $this->Flash->success(__('The general setting has been deleted.'));
        } else {
            $this->Flash->error(__('The general setting could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
