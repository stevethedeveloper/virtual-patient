<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

/**
 * Diagnostics Controller
 *
 * @property \App\Model\Table\DiagnosticsTable $Diagnostics
 */
class DiagnosticsController extends AppController
{
    /**
     * Index method
     *
     * @return void
     */
    public function index($case_id)
    {
        $this->paginate = ['all',
            'conditions' => ['Diagnostics.all_cases_id' => $case_id],
            'order' => ['Diagnostics.diagnosis_name' => 'ASC']
        ];
        $this->set('case_id', $case_id);
        $this->set('diagnostics', $this->paginate($this->Diagnostics));
        $this->set('_serialize', ['diagnostics']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($case_id)
    {
        $diagnostic = $this->Diagnostics->newEntity();
        if ($this->request->is('post')) {
            $diagnostic = $this->Diagnostics->patchEntity($diagnostic, $this->request->data);
            if ($this->Diagnostics->save($diagnostic)) {
                $this->Flash->success(__('The diagnostic has been saved.'));
                return $this->redirect(['action' => 'index', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The diagnostic could not be saved. Please try again.'));
            }
        }
        $this->set(compact('diagnostic', 'case_id'));
        $this->set('_serialize', ['diagnostic']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Diagnostic id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $diagnostic = $this->Diagnostics->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $diagnostic = $this->Diagnostics->patchEntity($diagnostic, $this->request->data);
            if ($this->Diagnostics->save($diagnostic)) {
                $this->Flash->success(__('The diagnostic has been saved.'));
                return $this->redirect(['action' => 'index', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The diagnostic could not be saved. Please try again.'));
            }
        }
        $this->set(compact('diagnostic'));
        $this->set('_serialize', ['diagnostic']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Diagnostic id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $diagnostic = $this->Diagnostics->get($id);
        if ($this->Diagnostics->delete($diagnostic)) {
            $this->Flash->success(__('The diagnostic has been deleted.'));
        } else {
            $this->Flash->error(__('The diagnostic could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index', $diagnostic->all_cases_id]);
    }
}
