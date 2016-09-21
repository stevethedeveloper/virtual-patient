<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\Event\Event;

/**
 * ManagementReferrals Controller
 *
 * @property \App\Model\Table\ManagementReferralsTable $ManagementReferrals
 */
class ManagementReferralsController extends AppController
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

        $referralForm = $this->ManagementReferrals->newEntity();
        if ($this->request->is('post')) {
            $referralForm = $this->ManagementReferrals->patchEntity($referralForm, $this->request->data, ['validate' => false]);
            $referralForm->id = $this->request->data['ManagementReferrals']['id'];
            if ($this->ManagementReferrals->save($referralForm)) {
                $this->Flash->success(__('The association name has been saved.'));
                return $this->redirect(['controller' => 'ManagementReferrals', 'action' => 'index', $case_id]);
            } else {
                pr($referralForm->errors());die;
                $this->Flash->error(__('The association name could not be saved. Please try again.'));
            }
        }

        $managementReferrals = $this->ManagementReferrals->get_questions($case_id);
        $associations = $this->ManagementReferrals->get_associations($case_id, false);        

        $this->set('colors', $this->colors);

        $this->set(compact('referralForm'));
        $this->set('_serialize', ['referralForm']);

        $this->set(compact('managementReferrals', 'case_id', 'associations'));
        $this->set('_serialize', ['managementReferrals']);

    }

    public function changeOrder() {
        $this->autoRender = false;
        $arr = $this->request->data;

        $connection = ConnectionManager::get('default');

        $count = 1;
        foreach ($arr['data'] as $option) {
            $option_id = substr($option, strrpos($option, '_') + 1);
            $connection->update('management_referrals', ['referral_order' => $count], ['id' => $option_id]);
            $count++;
        }
    }

    public function changeAssociation() {
        $this->autoRender = false;
        $arr = $this->request->data;

        $connection = ConnectionManager::get('default');

        $connection->update('management_referrals', ['referral_group' => $arr['referral_group']], ['id' => $arr['id']]);
    }

    public function addOption($case_id = null)
    {
        $managementReferral = $this->ManagementReferrals->newEntity();
        if ($this->request->is('post')) {
            $managementReferral = $this->ManagementReferrals->patchEntity($managementReferral, $this->request->data);
            if ($this->ManagementReferrals->save($managementReferral)) {
                $this->Flash->success(__('The option has been saved.'));
                return $this->redirect(['controller' => 'ManagementReferrals', 'action' => 'index', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The option could not be saved. Please try again.'));
            }
        }

        $this->loadModel('Videos');
        $videos = $this->Videos->getVideoList($this->case_id);

        $this->set(compact('managementReferral', 'case_id', 'videos'));
        $this->set('_serialize', ['managementReferral']);
    }

    public function editOption($id = null)
    {
        $managementReferral = $this->ManagementReferrals->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $managementReferral = $this->ManagementReferrals->patchEntity($managementReferral, $this->request->data);
            if ($this->ManagementReferrals->save($managementReferral)) {
                $this->Flash->success(__('The option has been saved.'));
                return $this->redirect(['controller' => 'ManagementReferrals', 'action' => 'index', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The option could not be saved. Please try again.'));
            }
        }

        $this->loadModel('Videos');
        $videos = $this->Videos->getVideoList($this->case_id);

        $this->set(compact('managementReferral', 'videos'));
        $this->set('_serialize', ['managementReferral']);
    }

    public function deleteOption($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $managementReferral = $this->ManagementReferrals->get($id);
        if ($this->ManagementReferrals->delete($managementReferral)) {
            $this->Flash->success(__('The option has been deleted.'));
        } else {
            $this->Flash->error(__('The option could not be deleted. Please try again.'));
        }

        return $this->redirect(['controller' => 'ManagementReferrals', 'action' => 'index', $managementReferral->all_cases_id]);
    }
}
