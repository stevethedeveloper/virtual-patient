<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\Event\Event;

/**
 * ManagementCounselings Controller
 *
 * @property \App\Model\Table\ManagementCounselingsTable $ManagementCounselings
 */
class ManagementCounselingsController extends AppController
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

        $counselingForm = $this->ManagementCounselings->newEntity();
        if ($this->request->is('post')) {
            $counselingForm = $this->ManagementCounselings->patchEntity($counselingForm, $this->request->data, ['validate' => false]);
            $counselingForm->id = $this->request->data['ManagementCounselings']['id'];
            if ($this->ManagementCounselings->save($counselingForm)) {
                $this->Flash->success(__('The association name has been saved.'));
                return $this->redirect(['controller' => 'ManagementCounselings', 'action' => 'index', $case_id]);
            } else {
                pr($counselingForm->errors());die;
                $this->Flash->error(__('The association name could not be saved. Please try again.'));
            }
        }

        $managementCounselings = $this->ManagementCounselings->get_questions($case_id);
        $associations = $this->ManagementCounselings->get_associations($case_id, false);        

        $this->set('colors', $this->colors);

        $this->set(compact('counselingForm'));
        $this->set('_serialize', ['counselingForm']);

        $this->set(compact('managementCounselings', 'case_id', 'associations'));
        $this->set('_serialize', ['managementCounselings']);

    }

    public function changeOrder() {
        $this->autoRender = false;
        $arr = $this->request->data;

        $connection = ConnectionManager::get('default');

        $count = 1;
        foreach ($arr['data'] as $option) {
            $option_id = substr($option, strrpos($option, '_') + 1);
            $connection->update('management_counselings', ['counseling_order' => $count], ['id' => $option_id]);
            $count++;
        }
    }

    public function changeAssociation() {
        $this->autoRender = false;
        $arr = $this->request->data;

        $connection = ConnectionManager::get('default');

        $connection->update('management_counselings', ['counseling_group' => $arr['counseling_group']], ['id' => $arr['id']]);
    }

    public function addOption($case_id = null)
    {
        $managementCounseling = $this->ManagementCounselings->newEntity();
        if ($this->request->is('post')) {
            $managementCounseling = $this->ManagementCounselings->patchEntity($managementCounseling, $this->request->data);
            if ($this->ManagementCounselings->save($managementCounseling)) {
                $this->Flash->success(__('The option has been saved.'));
                return $this->redirect(['controller' => 'ManagementCounselings', 'action' => 'index', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The option could not be saved. Please try again.'));
            }
        }

        $this->loadModel('Videos');
        $videos = $this->Videos->getVideoList($this->case_id);

        $this->set(compact('managementCounseling', 'case_id', 'videos'));
        $this->set('_serialize', ['managementCounseling']);
    }

    public function editOption($id = null)
    {
        $managementCounseling = $this->ManagementCounselings->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $managementCounseling = $this->ManagementCounselings->patchEntity($managementCounseling, $this->request->data);
            if ($this->ManagementCounselings->save($managementCounseling)) {
                $this->Flash->success(__('The option has been saved.'));
                return $this->redirect(['controller' => 'ManagementCounselings', 'action' => 'index', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The option could not be saved. Please try again.'));
            }
        }

        $this->loadModel('Videos');
        $videos = $this->Videos->getVideoList($this->case_id);

        $this->set(compact('managementCounseling', 'videos'));
        $this->set('_serialize', ['managementCounseling']);
    }

    public function deleteOption($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $managementCounseling = $this->ManagementCounselings->get($id);
        if ($this->ManagementCounselings->delete($managementCounseling)) {
            $this->Flash->success(__('The option has been deleted.'));
        } else {
            $this->Flash->error(__('The option could not be deleted. Please try again.'));
        }

        return $this->redirect(['controller' => 'ManagementCounselings', 'action' => 'index', $managementCounseling->all_cases_id]);
    }
}
