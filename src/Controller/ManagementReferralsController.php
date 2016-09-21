<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

/**
 * ManagementReferrals Controller
 *
 * @property \App\Model\Table\ManagementReferralsTable $ManagementReferrals
 */
class ManagementReferralsController extends AppController
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

        $data = $this->CustomPages->get_page($case_id, 'management_referral');

        $page = $data->custom_pages[0];

        $poster = (!empty($data->general_setting->video_placeholder)) ? $data->general_setting->video_placeholder : null;

        $questions = $this->ManagementReferrals->get_questions($case_id);

        //get question groups
        $question_groups = array();
        foreach ($questions as $question) {
            if ($question->referral_group != -1 && $question->referral_group != 'x') {
                $question_groups[$question->referral_group]['ids'][] = $question->id;
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
            ->where(['UserAnswers.user_id' => $user_id, 'UserAnswers.all_cases_id' => $case_id, 'UserAnswers.section' => 'management_referral'])
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

        $counseling_count = $this->UserAnswers->find()
            ->where(['UserAnswers.user_id' => $user_id, 'UserAnswers.all_cases_id' => $case_id, 'UserAnswers.section' => 'management_counseling'])
            ->count();

        $medication_count = $this->UserAnswers->find()
            ->where(['UserAnswers.user_id' => $user_id, 'UserAnswers.all_cases_id' => $case_id, 'UserAnswers.section' => 'management_medication'])
            ->count();

        $referral_count = $this->UserAnswers->find()
            ->where(['UserAnswers.user_id' => $user_id, 'UserAnswers.all_cases_id' => $case_id, 'UserAnswers.section' => 'management_referral'])
            ->count();

        if ($counseling_count > 0 && $medication_count > 0 && $referral_count > 0) {
                if ($this->request->session()->read('hide_billing') == 1) {
                    return $this->redirect(['controller' => 'Feedback']);
                } else {
                    return $this->redirect(['controller' => 'Billings']);
                }
        } else {
                $this->Flash->error(__('Please make at least one selection in each management section.'));
                return $this->redirect(['controller' => 'Management']);
        }

    }

    /**
     * View method
     *
     * @param string|null $id Management Referral id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $managementReferral = $this->ManagementReferrals->get($id, [
            'contain' => ['AllCases', 'Referrals']
        ]);
        $this->set('managementReferral', $managementReferral);
        $this->set('_serialize', ['managementReferral']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $managementReferral = $this->ManagementReferrals->newEntity();
        if ($this->request->is('post')) {
            $managementReferral = $this->ManagementReferrals->patchEntity($managementReferral, $this->request->data);
            if ($this->ManagementReferrals->save($managementReferral)) {
                $this->Flash->success(__('The management referral has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The management referral could not be saved. Please, try again.'));
            }
        }
        $allCases = $this->ManagementReferrals->AllCases->find('list', ['limit' => 200]);
        $referrals = $this->ManagementReferrals->Referrals->find('list', ['limit' => 200]);
        $this->set(compact('managementReferral', 'allCases', 'referrals'));
        $this->set('_serialize', ['managementReferral']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Management Referral id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $managementReferral = $this->ManagementReferrals->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $managementReferral = $this->ManagementReferrals->patchEntity($managementReferral, $this->request->data);
            if ($this->ManagementReferrals->save($managementReferral)) {
                $this->Flash->success(__('The management referral has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The management referral could not be saved. Please, try again.'));
            }
        }
        $allCases = $this->ManagementReferrals->AllCases->find('list', ['limit' => 200]);
        $referrals = $this->ManagementReferrals->Referrals->find('list', ['limit' => 200]);
        $this->set(compact('managementReferral', 'allCases', 'referrals'));
        $this->set('_serialize', ['managementReferral']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Management Referral id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $managementReferral = $this->ManagementReferrals->get($id);
        if ($this->ManagementReferrals->delete($managementReferral)) {
            $this->Flash->success(__('The management referral has been deleted.'));
        } else {
            $this->Flash->error(__('The management referral could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
