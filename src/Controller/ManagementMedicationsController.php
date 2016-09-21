<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

/**
 * ManagementMedications Controller
 *
 * @property \App\Model\Table\ManagementMedicationsTable $ManagementMedications
 */
class ManagementMedicationsController extends AppController
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

        $data = $this->CustomPages->get_page($case_id, 'management_medication');

        $page = $data->custom_pages[0];

        $poster = (!empty($data->general_setting->video_placeholder)) ? $data->general_setting->video_placeholder : null;

        $questions = $this->ManagementMedications->get_questions($case_id);

        //get question groups
        $question_groups = array();
        foreach ($questions as $question) {
            if ($question->medication_group != -1 && $question->medication_group != 'x') {
                $question_groups[$question->medication_group]['ids'][] = $question->id;
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
            ->where(['UserAnswers.user_id' => $user_id, 'UserAnswers.all_cases_id' => $case_id, 'UserAnswers.section' => 'management_medication'])
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

    /**
     * View method
     *
     * @param string|null $id Management Medication id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $managementMedication = $this->ManagementMedications->get($id, [
            'contain' => ['AllCases', 'Medications']
        ]);
        $this->set('managementMedication', $managementMedication);
        $this->set('_serialize', ['managementMedication']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $managementMedication = $this->ManagementMedications->newEntity();
        if ($this->request->is('post')) {
            $managementMedication = $this->ManagementMedications->patchEntity($managementMedication, $this->request->data);
            if ($this->ManagementMedications->save($managementMedication)) {
                $this->Flash->success(__('The management medication has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The management medication could not be saved. Please, try again.'));
            }
        }
        $allCases = $this->ManagementMedications->AllCases->find('list', ['limit' => 200]);
        $medications = $this->ManagementMedications->Medications->find('list', ['limit' => 200]);
        $this->set(compact('managementMedication', 'allCases', 'medications'));
        $this->set('_serialize', ['managementMedication']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Management Medication id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $managementMedication = $this->ManagementMedications->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $managementMedication = $this->ManagementMedications->patchEntity($managementMedication, $this->request->data);
            if ($this->ManagementMedications->save($managementMedication)) {
                $this->Flash->success(__('The management medication has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The management medication could not be saved. Please, try again.'));
            }
        }
        $allCases = $this->ManagementMedications->AllCases->find('list', ['limit' => 200]);
        $medications = $this->ManagementMedications->Medications->find('list', ['limit' => 200]);
        $this->set(compact('managementMedication', 'allCases', 'medications'));
        $this->set('_serialize', ['managementMedication']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Management Medication id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $managementMedication = $this->ManagementMedications->get($id);
        if ($this->ManagementMedications->delete($managementMedication)) {
            $this->Flash->success(__('The management medication has been deleted.'));
        } else {
            $this->Flash->error(__('The management medication could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
