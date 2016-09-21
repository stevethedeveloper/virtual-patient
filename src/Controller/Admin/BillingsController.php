<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\Event\Event;

/**
 * Billings Controller
 *
 * @property \App\Model\Table\BillingsTable $Billings
 */
class BillingsController extends AppController
{
    var $hide_billing = 0;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $yield_names = array('' => '--Please Select--', '0' => 'Contraindicated', '4' => 'High Yield', '3' => 'Reasonable Yield', '2' => 'Low Yield', '1' => 'Very Low Yield');
        $this->set('yield_names', $yield_names);

        if (isset($this->request->params['pass'][0])) {
            $case_id = $this->request->params['pass'][0];
        }
        $connection = ConnectionManager::get('default');
        $results = $connection->execute("SELECT * FROM general_settings where all_cases_id = '$case_id'")->fetch('assoc');
        if (count($results) > 0) {
            $this->hide_billing = $results['hide_billing'];
            if ($this->hide_billing == 1) {
                $this->Flash->error(__('Billing is disabled.  You can enable it in General Settings.'));
            }
        }
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

        $billingForm = $this->Billings->newEntity();
        if ($this->request->is('post')) {
            $billingForm = $this->Billings->patchEntity($billingForm, $this->request->data, ['validate' => false]);
            $billingForm->id = $this->request->data['Billings']['id'];
            if ($this->Billings->save($billingForm)) {
                $this->Flash->success(__('The association name has been saved.'));
                return $this->redirect(['controller' => 'Billings', 'action' => 'index', $case_id]);
            } else {
                pr($billingForm->errors());die;
                $this->Flash->error(__('The association name could not be saved. Please try again.'));
            }
        }

        $billings = $this->Billings->get_questions($case_id);
        $associations = $this->Billings->get_associations($case_id, false);        

        $this->set('colors', $this->colors);

        $this->set(compact('billingForm'));
        $this->set('_serialize', ['billingForm']);

        $this->set(compact('billings', 'case_id', 'associations'));
        $this->set('_serialize', ['billings']);

    }

    public function changeOrder() {
        $this->autoRender = false;
        $arr = $this->request->data;

        $connection = ConnectionManager::get('default');

        $count = 1;
        foreach ($arr['data'] as $option) {
            $option_id = substr($option, strrpos($option, '_') + 1);
            $connection->update('billings', ['billing_order' => $count], ['id' => $option_id]);
            $count++;
        }
    }

    public function changeAssociation() {
        $this->autoRender = false;
        $arr = $this->request->data;

        $connection = ConnectionManager::get('default');

        $connection->update('billings', ['billing_group' => $arr['billing_group']], ['id' => $arr['id']]);
    }

    public function addOption($case_id = null)
    {
        $billing = $this->Billings->newEntity();
        if ($this->request->is('post')) {
            $billing = $this->Billings->patchEntity($billing, $this->request->data);
            if ($this->Billings->save($billing)) {
                $this->Flash->success(__('The option has been saved.'));
                return $this->redirect(['controller' => 'Billings', 'action' => 'index', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The option could not be saved. Please try again.'));
            }
        }

        $this->loadModel('Videos');
        $videos = $this->Videos->getVideoList($this->case_id);

        $this->set(compact('billing', 'case_id', 'videos'));
        $this->set('_serialize', ['billing']);
    }

    public function editOption($id = null)
    {
        $billing = $this->Billings->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $billing = $this->Billings->patchEntity($billing, $this->request->data);
            if ($this->Billings->save($billing)) {
                $this->Flash->success(__('The option has been saved.'));
                return $this->redirect(['controller' => 'Billings', 'action' => 'index', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The option could not be saved. Please try again.'));
            }
        }

        $this->loadModel('Videos');
        $videos = $this->Videos->getVideoList($this->case_id);

        $this->set(compact('billing', 'videos'));
        $this->set('_serialize', ['billing']);
    }

    public function deleteOption($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $billing = $this->Billings->get($id);
        if ($this->Billings->delete($billing)) {
            $this->Flash->success(__('The option has been deleted.'));
        } else {
            $this->Flash->error(__('The option could not be deleted. Please try again.'));
        }

        return $this->redirect(['controller' => 'Billings', 'action' => 'index', $billing->all_cases_id]);
    }
}
