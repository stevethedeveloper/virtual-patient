<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\Event\Event;

/**
 * ManagementMedications Controller
 *
 * @property \App\Model\Table\ManagementMedicationsTable $ManagementMedications
 */
class ManagementMedicationsController extends AppController
{
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $yield_names = array('' => '--Please Select--', '0' => 'Contraindicated', '4' => 'High Yield', '3' => 'Reasonable Yield', '2' => 'Low Yield', '1' => 'Very Low Yield');
        $this->set('yield_names', $yield_names);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index($case_id)
    {

        if (empty($case_id)) {
            echo 'Case ID is missing.';die;
        }

        $medicationForm = $this->ManagementMedications->newEntity();
        if ($this->request->is('post')) {
            $medicationForm = $this->ManagementMedications->patchEntity($medicationForm, $this->request->data, ['validate' => false]);
            $medicationForm->id = $this->request->data['ManagementMedications']['id'];
            if ($this->ManagementMedications->save($medicationForm)) {
                $this->Flash->success(__('The association name has been saved.'));
                return $this->redirect(['controller' => 'ManagementMedications', 'action' => 'index', $case_id]);
            } else {
                pr($medicationForm->errors());die;
                $this->Flash->error(__('The association name could not be saved. Please try again.'));
            }
        }

        $managementMedications = $this->ManagementMedications->get_questions($case_id);
        $associations = $this->ManagementMedications->get_associations($case_id, false);        

        $this->set('colors', $this->colors);

        $this->set(compact('medicationForm'));
        $this->set('_serialize', ['medicationForm']);

        $this->set(compact('managementMedications', 'case_id', 'associations'));
        $this->set('_serialize', ['managementMedications']);

    }

    public function changeOrder() {
        $this->autoRender = false;
        $arr = $this->request->data;

        $connection = ConnectionManager::get('default');

        $count = 1;
        foreach ($arr['data'] as $option) {
            $option_id = substr($option, strrpos($option, '_') + 1);
            $connection->update('management_medications', ['medication_order' => $count], ['id' => $option_id]);
            $count++;
        }
    }

    public function changeAssociation() {
        $this->autoRender = false;
        $arr = $this->request->data;

        $connection = ConnectionManager::get('default');

        $connection->update('management_medications', ['medication_group' => $arr['medication_group']], ['id' => $arr['id']]);
    }

    public function addOption($case_id = null)
    {
        $managementMedication = $this->ManagementMedications->newEntity();
        if ($this->request->is('post')) {
            $managementMedication = $this->ManagementMedications->patchEntity($managementMedication, $this->request->data);
            if ($this->ManagementMedications->save($managementMedication)) {
                $this->Flash->success(__('The option has been saved.'));
                return $this->redirect(['controller' => 'ManagementMedications', 'action' => 'index', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The option could not be saved. Please try again.'));
            }
        }

        $this->loadModel('Videos');
        $videos = $this->Videos->getVideoList($this->case_id);

        $this->set(compact('managementMedication', 'case_id', 'videos'));
        $this->set('_serialize', ['managementMedication']);
    }

    public function editOption($id = null)
    {
        $managementMedication = $this->ManagementMedications->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $managementMedication = $this->ManagementMedications->patchEntity($managementMedication, $this->request->data);
            if ($this->ManagementMedications->save($managementMedication)) {
                $this->Flash->success(__('The option has been saved.'));
                return $this->redirect(['controller' => 'ManagementMedications', 'action' => 'index', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The option could not be saved. Please try again.'));
            }
        }

        $this->loadModel('Videos');
        $videos = $this->Videos->getVideoList($this->case_id);

        $this->set(compact('managementMedication', 'videos'));
        $this->set('_serialize', ['managementMedication']);
    }

    public function deleteOption($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $managementMedication = $this->ManagementMedications->get($id);
        if ($this->ManagementMedications->delete($managementMedication)) {
            $this->Flash->success(__('The option has been deleted.'));
        } else {
            $this->Flash->error(__('The option could not be deleted. Please try again.'));
        }

        return $this->redirect(['controller' => 'ManagementMedications', 'action' => 'index', $managementMedication->all_cases_id]);
    }
}
