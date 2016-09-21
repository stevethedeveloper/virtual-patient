<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\Event\Event;

/**
 * OrderLabs Controller
 *
 * @property \App\Model\Table\OrderLabsTable $OrderLabs
 */
class OrderLabsController extends AppController
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
        $this->loadModel('OrderLabsGroups');
        $orderLabGroups = $this->OrderLabs->OrderLabsGroups->getGroups($case_id);
        $this->set(compact('orderLabGroups'));
        $this->set('_serialize', ['orderLabGroups']);        
    }

    public function changeLabOrder() {
        $this->autoRender = false;

        $arr = $this->request->data;

        $connection = ConnectionManager::get('default');

        foreach ($arr['myArguments'] as $group_name => $labs) {
            $group_id = substr($group_name, strrpos($group_name, '_') + 1);
            $count = 1;
            foreach ($labs as $lab) {
                $lab_id = substr($lab, strrpos($lab, '_') + 1);
                $connection->update('order_labs', ['order_labs_groups_id' => $group_id, 'lab_order' => $count], ['id' => $lab_id]);
                $count++;
            }
        }
    }

    public function changeGroupOrder() {
        $this->autoRender = false;
        $arr = $this->request->data;
       
        $connection = ConnectionManager::get('default');

        $count = 1;
        foreach ($arr['data'] as $group) {
            $group_id = substr($group, strrpos($group, '_') + 1);
            $connection->update('order_labs_groups', ['group_order' => $count], ['id' => $group_id]);
            $count++;
        }
    }

    public function groups($case_id = null) {
        if (empty($case_id)) {
            echo 'Case ID is missing.';die;
        }
        $this->loadModel('OrderLabsGroups');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $group = $this->OrderLabsGroups->newEntity();
            $group->all_cases_id = $case_id;
            $group->name = $this->request->data('OrderLabsGroups.name');
            //$orderLabGroups = $this->OrderLabs->OrderLabsGroups->patchEntity($orderLabGroups, $group);
            if ($this->OrderLabs->OrderLabsGroups->save($group)) {
                $this->Flash->success(__('Groups have been saved.'));
                return $this->redirect(['controller' => 'OrderLabs', 'action' => 'groups', $case_id]);
            } else {
                $this->Flash->error(__('Groups could not be saved. Please, try again.'));
            }
        }
        
        $orderLabGroups = $this->OrderLabs->OrderLabsGroups->getGroups($case_id);
        $this->set(compact('orderLabGroups'));
        $this->set('_serialize', ['orderLabGroups']);        
    }

    public function editGroup($id = null)
    {
        $this->loadModel('OrderLabsGroups');

        $orderLabGroup = $this->OrderLabs->OrderLabsGroups->get($id, [
            'contain' => []
        ]);

        if ($id == 0) {
            echo 'This group cannot be edited or deleted.';die;
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
        //pr($this->request->data);die();
            $group = $this->OrderLabsGroups->newEntity();
            $group->name = $this->request->data('name');
            $group->id = $id;
            //$orderLab = $this->OrderLabs->patchEntity($orderLab, $this->request->data);
            if ($this->OrderLabs->OrderLabsGroups->save($group)) {
                $this->Flash->success(__('Your changes have been saved.'));
                return $this->redirect(['controller' => 'OrderLabs', 'action' => 'groups', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('Your changes could not be saved. Please try again.'));
            }
        }
        
        $this->set(compact('orderLabGroup'));
        $this->set('_serialize', ['orderLabGroup']);
    }

    public function deleteGroup($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        if ($id == 0) {
            echo 'This group cannot be edited or deleted.';die;
        }

        $this->loadModel('OrderLabsGroups');
        $orderLabGroup = $this->OrderLabs->OrderLabsGroups->get($id);

        if ($this->OrderLabsGroups->delete($orderLabGroup)) {
            $this->OrderLabs->query('update order_labs set order_labs_groups_id = 0 where order_labs_groups_id = {$id} and all_cases_id = {$orderLabGroup->all_cases_id}');
            $this->Flash->success(__('The group has been deleted.'));
        } else {
            $this->Flash->error(__('The group could not be deleted. Please try again.'));
        }
        
        return $this->redirect(['controller' => 'OrderLabs', 'action' => 'groups', $orderLabGroup->all_cases_id]);
    }

    public function labs($case_id = null) {
        if (empty($case_id)) {
            echo 'Case ID is missing.';die;
        }

        $orderLabForm = $this->OrderLabs->newEntity();
        if ($this->request->is('post')) {
            $orderLabForm = $this->OrderLabs->patchEntity($orderLabForm, $this->request->data, ['validate' => false]);
            $orderLabForm->id = $this->request->data['OrderLabs']['id'];
            if ($this->OrderLabs->save($orderLabForm)) {
                $this->Flash->success(__('The association name has been saved.'));
                return $this->redirect(['controller' => 'OrderLabs', 'action' => 'labs', $case_id]);
            } else {
                pr($orderLabForm->errors());die;
                $this->Flash->error(__('The association name could not be saved. Please try again.'));
            }
        }

        $orderLabs = $this->OrderLabs->get_labs($case_id);        
        $associations = $this->OrderLabs->get_associations($case_id, false);        

        $this->set('colors', $this->colors);

        $this->set(compact('orderLabForm'));
        $this->set('_serialize', ['orderLabForm']);

        $this->set(compact('orderLabs', 'case_id', 'associations'));
        $this->set('_serialize', ['orderLabs']);
    }

    public function changeAssociation() {
        $this->autoRender = false;
        $arr = $this->request->data;

        $connection = ConnectionManager::get('default');

        $connection->update('order_labs', ['lab_group' => $arr['lab_group']], ['id' => $arr['id']]);
    }

    public function addAssociation($id) {
    }

    public function addLab($case_id = null)
    {
        $orderLab = $this->OrderLabs->newEntity();
        if ($this->request->is('post')) {
            $orderLab = $this->OrderLabs->patchEntity($orderLab, $this->request->data);
            if ($this->OrderLabs->save($orderLab)) {
                $this->Flash->success(__('The lab has been saved.'));
                return $this->redirect(['controller' => 'OrderLabs', 'action' => 'labs', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The lab could not be saved. Please try again.'));
            }
        }

        $this->loadModel('Videos');
        $videos = $this->Videos->getVideoList($this->case_id);

        $this->set(compact('orderLab', 'case_id', 'videos'));
        $this->set('_serialize', ['orderLab']);
    }

    public function editLab($id = null)
    {
        $orderLab = $this->OrderLabs->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $orderLab = $this->OrderLabs->patchEntity($orderLab, $this->request->data);
            if ($this->OrderLabs->save($orderLab)) {
                $this->Flash->success(__('The lab has been saved.'));
                return $this->redirect(['controller' => 'OrderLabs', 'action' => 'labs', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The lab could not be saved. Please try again.'));
            }
        }

        $this->loadModel('Videos');
        $videos = $this->Videos->getVideoList($this->case_id);

        $this->set(compact('orderLab', 'videos'));
        $this->set('_serialize', ['orderLab']);
    }

    public function deleteLab($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $orderLab = $this->OrderLabs->get($id);
        if ($this->OrderLabs->delete($orderLab)) {
            $this->Flash->success(__('The lab has been deleted.'));
        } else {
            $this->Flash->error(__('The lab could not be deleted. Please try again.'));
        }

        return $this->redirect(['controller' => 'OrderLabs', 'action' => 'labs', $orderLab->all_cases_id]);
    }

    public function orderLab() {
        $this->autoRender = false;

        $lab_id = $this->request->data['lab_id'];
        $section_name = $this->request->data['section_name'];
        $case_id = $this->request->session()->read('case_id');

        //get page
        $this->loadModel('CustomPages');
        $data = $this->CustomPages->get_page($case_id, 'labs');

        $lab_order_cap = $data->general_setting->lab_order_cap;
        $this->set(compact('lab_order_cap'));

        //update user_answers
        $this->loadModel('UserAnswers');
        
        $user_id = $this->Auth->user()['id'];

        $already_ordered = $this->UserAnswers->find()
            ->where(['UserAnswers.user_id' => $user_id, 'UserAnswers.all_cases_id' => $case_id, 'UserAnswers.answer_id' => $lab_id, 'UserAnswers.section' => $section_name])
            ->count();

        $total_count = $this->UserAnswers->find()
            ->where(['UserAnswers.user_id' => $user_id, 'UserAnswers.all_cases_id' => $case_id, 'UserAnswers.section' => $section_name])
            ->count();

        $this->set(compact('total_count'));

        if ($already_ordered == 0 && $total_count <= $lab_order_cap) {    
            $data = $this->UserAnswers->newEntity();
            $data->user_id = $user_id;
            $data->all_cases_id = $case_id;
            $data->answer_id = $lab_id;
            $data->section = $section_name;
            $this->UserAnswers->save($data);
        }

        //get lab
        $this->loadModel('OrderLabs');
        $lab = $this->OrderLabs->find()
            ->select(['lab', 'result', 'if_ordered', 'pict_ordered', 'pict_ordered_lg'])
            ->where(['OrderLabs.id' => $lab_id])
            ->first()
            ->toArray();

        $this->response->body(json_encode($lab));        
    }

    /**
     * View method
     *
     * @param string|null $id Order Lab id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $orderLab = $this->OrderLabs->get($id, [
            'contain' => ['AllCases', 'Labs']
        ]);
        $this->set('orderLab', $orderLab);
        $this->set('_serialize', ['orderLab']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $orderLab = $this->OrderLabs->newEntity();
        if ($this->request->is('post')) {
            $orderLab = $this->OrderLabs->patchEntity($orderLab, $this->request->data);
            if ($this->OrderLabs->save($orderLab)) {
                $this->Flash->success(__('The order lab has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The order lab could not be saved. Please, try again.'));
            }
        }
        $allCases = $this->OrderLabs->AllCases->find('list', ['limit' => 200]);
        $labs = $this->OrderLabs->Labs->find('list', ['limit' => 200]);
        $this->set(compact('orderLab', 'allCases', 'labs'));
        $this->set('_serialize', ['orderLab']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Order Lab id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $orderLab = $this->OrderLabs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $orderLab = $this->OrderLabs->patchEntity($orderLab, $this->request->data);
            if ($this->OrderLabs->save($orderLab)) {
                $this->Flash->success(__('The order lab has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The order lab could not be saved. Please, try again.'));
            }
        }
        $allCases = $this->OrderLabs->AllCases->find('list', ['limit' => 200]);
        $labs = $this->OrderLabs->Labs->find('list', ['limit' => 200]);
        $this->set(compact('orderLab', 'allCases', 'labs'));
        $this->set('_serialize', ['orderLab']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Order Lab id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $orderLab = $this->OrderLabs->get($id);
        if ($this->OrderLabs->delete($orderLab)) {
            $this->Flash->success(__('The order lab has been deleted.'));
        } else {
            $this->Flash->error(__('The order lab could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
