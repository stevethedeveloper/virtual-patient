<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * OrderLabs Controller
 *
 * @property \App\Model\Table\OrderLabsTable $OrderLabs
 */
class OrderLabsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $case_id = $this->request->session()->read('case_id');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user_id = $this->Auth->user('id');
            $section_name = 'labs';
            $this->loadModel('UserAnswers');
            $answer_count = $this->UserAnswers->find()
                ->where(['UserAnswers.user_id' => $user_id, 'UserAnswers.all_cases_id' => $case_id, 'UserAnswers.section' => $section_name])
                ->count();

            if ($answer_count == 0) {
                $this->Flash->error(__('Please select one or more options.'));
                return $this->redirect(['controller' => 'OrderLabs']);
            } else {
                return $this->redirect(['controller' => 'Diagnostics', 'action' => 'diagnosis']);
            }
        }

        $associations = array('-1' => '', 'new' => '--New Association--');
        $associations += $this->OrderLabs->get_associations($case_id);

        $data = $this->CustomPages->get_page($case_id, 'labs');

        $page = $data->custom_pages[0];

        $poster = (!empty($data->general_setting->video_placeholder)) ? $data->general_setting->video_placeholder : null;

        $lab_order_cap = $data->general_setting->lab_order_cap;
        $this->set(compact('lab_order_cap'));

        $this->loadModel('OrderLabsGroups');
        $labs = $this->OrderLabs->OrderLabsGroups->getGroups($case_id);

        //get lab groups
        $lab_groups = array();
        foreach ($labs as $l) {
            foreach ($l->order_labs as $lab) {
                if ($lab->lab_group != -1) {
                    $lab_groups[$lab->lab_group]['ids'][] = $lab->id;
                }
            }
        }

        //set colors for lab groups
        $groups = array();
        $count = 0;
        foreach ($lab_groups as $key => $val) {
            $groups[$key]['ids'] = $val['ids'];
            $groups[$key]['color'] = $this->colors[$count];
            $count++;
        }
        $this->set(compact('groups'));

        //get user answers
        $this->loadModel('UserAnswers');
        
        $user_id = $this->Auth->user()['id'];
        $case_id = $this->request->session()->read('case_id');

        $labs_ordered = $this->UserAnswers->find()
            ->select('UserAnswers.answer_id')
            ->where(['UserAnswers.user_id' => $user_id, 'UserAnswers.all_cases_id' => $case_id, 'UserAnswers.section' => 'labs'])
            ->toArray();
        
        $already_ordered = array();
        foreach ($labs_ordered as $val) {
               $already_ordered[] = $val->answer_id;
        }   

        $total_count = count($already_ordered);

        $this->set(compact('total_count'));

        $this->set('colors', $this->colors);
        $this->set(compact('data', 'page', 'labs', 'already_ordered', 'poster', 'associations'));

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
