<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * HistoryQuestions Controller
 *
 * @property \App\Model\Table\HistoryQuestionsTable $HistoryQuestions
 */
class HistoryQuestionsController extends AppController
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
            $section_name = 'history_questions';
            $this->loadModel('UserAnswers');
            $answer_count = $this->UserAnswers->find()
                ->where(['UserAnswers.user_id' => $user_id, 'UserAnswers.all_cases_id' => $case_id, 'UserAnswers.section' => $section_name])
                ->count();

            if ($answer_count == 0) {
                $this->Flash->error(__('Please ask one or more questions.'));
                return $this->redirect(['controller' => 'HistoryQuestions', 'action' => 'index']);
            } else {
                return $this->redirect(['controller' => 'PhysicalExam', 'action' => 'index']);
            }
        }

        $data = $this->CustomPages->get_page($case_id, 'history');

        $page = $data->custom_pages[0];

        $poster = (!empty($data->general_setting->video_placeholder)) ? $data->general_setting->video_placeholder : null;

        $autoplay = false;

        $this->loadModel('Videos');
        $videos = $this->Videos->getPlaceholderVideosArray($case_id);
        $this->set(compact('videos'));

        $history_question_cap = $data->general_setting->history_question_cap;
        $this->set(compact('history_question_cap'));

        $this->loadModel('Videos');
        
        $this->loadModel('HistoryQuestionsGroups');
        $questions = $this->HistoryQuestions->HistoryQuestionsGroups->getGroups($case_id);

        $this->loadModel('UserAnswers');
        
        $user_id = $this->Auth->user()['id'];
        $case_id = $this->request->session()->read('case_id');

        $questions_asked = $this->UserAnswers->find()
            ->select('UserAnswers.answer_id')
            ->where(['UserAnswers.user_id' => $user_id, 'UserAnswers.all_cases_id' => $case_id, 'UserAnswers.section' => 'history_questions'])
            ->toArray();
        
        $already_asked = array();
        foreach ($questions_asked as $val) {
               $already_asked[] = $val->answer_id;
        }   

        $total_count = count($already_asked);

        $this->set(compact('total_count'));

        $this->set(compact('data', 'page', 'questions', 'poster', 'autoplay', 'already_asked', 'case_id'));
    }

    public function playVideo() {
        $this->autoRender = false;

        $video_id = $this->request->data['video_id'];
        $question_id = $this->request->data['question_id'];
        $section_name = $this->request->data['section_name'];
        $case_id = $this->request->session()->read('case_id');

        //get page
        $this->loadModel('CustomPages');
        $data = $this->CustomPages->get_page($case_id, 'history');

        //set video
        $this->loadModel('Videos');
        $videos = $this->Videos->getVideosArray($data, $video_id);

        $history_question_cap = $data->general_setting->history_question_cap;
        $this->set(compact('history_question_cap'));

        $this->set('autoplay', true);

        //update user_answers
        $this->loadModel('UserAnswers');
        
        $user_id = $this->Auth->user()['id'];
        $case_id = $this->request->session()->read('case_id');

        $already_asked = $this->UserAnswers->find()
            ->where(['UserAnswers.user_id' => $user_id, 'UserAnswers.all_cases_id' => $case_id, 'UserAnswers.answer_id' => $question_id, 'UserAnswers.section' => $section_name])
            ->count();

        $total_count = $this->UserAnswers->find()
            ->where(['UserAnswers.user_id' => $user_id, 'UserAnswers.all_cases_id' => $case_id, 'UserAnswers.section' => $section_name])
            ->count();

        $this->set(compact('total_count'));

        if ($already_asked == 0 && $total_count <= $history_question_cap) {    
            $data = $this->UserAnswers->newEntity();
            $data->user_id = $user_id;
            $data->all_cases_id = $case_id;
            $data->answer_id = $question_id;
            $data->section = $section_name;
            $this->UserAnswers->save($data);
        }

        $this->response->body(json_encode($videos['http'], JSON_UNESCAPED_SLASHES));

        //return json_encode($videos->video_file_name);
        //$this->render('/Element/flowplayer', 'ajax');
    }

    /**
     * View method
     *
     * @param string|null $id History Question id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $historyQuestion = $this->HistoryQuestions->get($id, [
            'contain' => ['AllCases', 'Videos']
        ]);
        $this->set('historyQuestion', $historyQuestion);
        $this->set('_serialize', ['historyQuestion']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $historyQuestion = $this->HistoryQuestions->newEntity();
        if ($this->request->is('post')) {
            $historyQuestion = $this->HistoryQuestions->patchEntity($historyQuestion, $this->request->data);
            if ($this->HistoryQuestions->save($historyQuestion)) {
                $this->Flash->success(__('The history question has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The history question could not be saved. Please, try again.'));
            }
        }
        $allCases = $this->HistoryQuestions->AllCases->find('list', ['limit' => 200]);
        $questions = $this->HistoryQuestions->Questions->find('list', ['limit' => 200]);
        $videos = $this->HistoryQuestions->Videos->find('list', ['limit' => 200]);
        $this->set(compact('historyQuestion', 'allCases', 'questions', 'videos'));
        $this->set('_serialize', ['historyQuestion']);
    }

    /**
     * Edit method
     *
     * @param string|null $id History Question id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $historyQuestion = $this->HistoryQuestions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $historyQuestion = $this->HistoryQuestions->patchEntity($historyQuestion, $this->request->data);
            if ($this->HistoryQuestions->save($historyQuestion)) {
                $this->Flash->success(__('The history question has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The history question could not be saved. Please, try again.'));
            }
        }
        $allCases = $this->HistoryQuestions->AllCases->find('list', ['limit' => 200]);
        $questions = $this->HistoryQuestions->Questions->find('list', ['limit' => 200]);
        $videos = $this->HistoryQuestions->Videos->find('list', ['limit' => 200]);
        $this->set(compact('historyQuestion', 'allCases', 'questions', 'videos'));
        $this->set('_serialize', ['historyQuestion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id History Question id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $historyQuestion = $this->HistoryQuestions->get($id);
        if ($this->HistoryQuestions->delete($historyQuestion)) {
            $this->Flash->success(__('The history question has been deleted.'));
        } else {
            $this->Flash->error(__('The history question could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
