<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

/**
 * Billings Controller
 *
 * @property \App\Model\Table\BillingsTable $Billings
 */
class BillingsController extends AppController
{

    var $colors = array('magenta', 'blue', 'green', 'purple', 'red', 'brown');

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $case_id = $this->request->session()->read('case_id');

        $data = $this->CustomPages->get_page($case_id, 'billing');

        $page = $data->custom_pages[0];

        $poster = (!empty($data->general_setting->video_placeholder)) ? $data->general_setting->video_placeholder : null;

        $questions = $this->Billings->get_questions($case_id);

        //get question groups
        $question_groups = array();
        foreach ($questions as $question) {
            if ($question->billing_group != -1 && $question->billing_group != 'x') {
                $question_groups[$question->billing_group]['ids'][] = $question->id;
            }
            $question_groups['x']['ids'][] = $question->id;
        }

        //set colors for groups
        $groups = array();
        $count = 0;
        foreach ($question_groups as $key => $val) {
            $groups[$key]['ids'] = $val['ids'];
            if ($key != 'x') {
                $groups[$key]['color'] = $this->colors[$count];
                $count++;
            }
        }
        $this->set(compact('groups'));

        //get user answers
        $this->loadModel('UserAnswers');
        
        $user_id = $this->Auth->user()['id'];
        $case_id = $this->request->session()->read('case_id');

        $questions_ordered = $this->UserAnswers->find()
            ->select('UserAnswers.answer_id')
            ->where(['UserAnswers.user_id' => $user_id, 'UserAnswers.all_cases_id' => $case_id, 'UserAnswers.section' => 'billing'])
            ->toArray();
        
        $already_ordered = array();
        foreach ($questions_ordered as $val) {
               $already_ordered[] = $val->answer_id;
        }   

        $total_count = count($already_ordered);

        $this->set(compact('total_count'));

        $this->set(compact('data', 'page', 'questions', 'already_ordered', 'poster'));
    }

    public function selectQuestion() {
        $this->autoRender = false;

        $question_id = $this->request->data['question_id'];
        $section_name = $this->request->data['section_name'];
        $group = $this->request->data['group'];
        $case_id = $this->request->session()->read('case_id');

        //get page
        $this->loadModel('CustomPages');
        $data = $this->CustomPages->get_page($case_id, $section_name);

        //update user_answers
        $this->loadModel('UserAnswers');
        
        $user_id = $this->Auth->user()['id'];

        $already_ordered = $this->UserAnswers->find()
            ->where(['UserAnswers.user_id' => $user_id, 'UserAnswers.all_cases_id' => $case_id, 'UserAnswers.answer_id' => $question_id, 'UserAnswers.section' => $section_name])
            ->count();

        if ($group == 'x') {
            $connection = ConnectionManager::get('default');
            $connection->delete('user_answers', ['user_id' => $user_id, 'all_cases_id' => $case_id, 'section' => $section_name]);
        }

        if ($already_ordered == 0) {
            $data = $this->UserAnswers->newEntity();
            $data->user_id = $user_id;
            $data->all_cases_id = $case_id;
            $data->answer_id = $question_id;
            $data->section = $section_name;
            $this->UserAnswers->save($data);
        } else {
            $connection = ConnectionManager::get('default');
            $connection->delete('user_answers', ['user_id' => $user_id, 'all_cases_id' => $case_id, 'answer_id' => $question_id, 'section' => $section_name]);
        }
    }

    public function canAdvance() {
        $this->autoRender = false;

        $case_id = $this->request->session()->read('case_id');
        $user_id = $this->Auth->user()['id'];
        $this->loadModel('UserAnswers');

        $count = $this->UserAnswers->find()
            ->where(['UserAnswers.user_id' => $user_id, 'UserAnswers.all_cases_id' => $case_id, 'UserAnswers.section' => 'billing'])
            ->count();

        if ($count > 0) {
                return $this->redirect(['controller' => 'Feedback']);
        } else {
                $this->Flash->error(__('Please make at least one Billing selection.'));
                return $this->redirect(['controller' => 'Billing']);
        }

    }

    /**
     * View method
     *
     * @param string|null $id Billing id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $billing = $this->Billings->get($id, [
            'contain' => ['AllCases', 'Billings']
        ]);
        $this->set('billing', $billing);
        $this->set('_serialize', ['billing']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $billing = $this->Billings->newEntity();
        if ($this->request->is('post')) {
            $billing = $this->Billings->patchEntity($billing, $this->request->data);
            if ($this->Billings->save($billing)) {
                $this->Flash->success(__('The billing has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The billing could not be saved. Please, try again.'));
            }
        }
        $allCases = $this->Billings->AllCases->find('list', ['limit' => 200]);
        $this->set(compact('billing', 'allCases'));
        $this->set('_serialize', ['billing']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Billing id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $billing = $this->Billings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $billing = $this->Billings->patchEntity($billing, $this->request->data);
            if ($this->Billings->save($billing)) {
                $this->Flash->success(__('The billing has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The billing could not be saved. Please, try again.'));
            }
        }
        $allCases = $this->Billings->AllCases->find('list', ['limit' => 200]);
        $this->set(compact('billing', 'allCases'));
        $this->set('_serialize', ['billing']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Billing id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $billing = $this->Billings->get($id);
        if ($this->Billings->delete($billing)) {
            $this->Flash->success(__('The billing has been deleted.'));
        } else {
            $this->Flash->error(__('The billing could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
