<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

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
    public function index($case_id)
    {
        $this->loadModel('HistoryQuestionsGroups');
        $historyQuestionGroups = $this->HistoryQuestions->HistoryQuestionsGroups->getGroups($case_id);
        $this->set(compact('historyQuestionGroups'));
        $this->set('_serialize', ['historyQuestionGroups']);        
    }

    public function changeQuestionOrder() {
        $this->autoRender = false;

        $arr = $this->request->data;
        
        $connection = ConnectionManager::get('default');

        foreach ($arr['myArguments'] as $group_name => $questions) {
            $group_id = substr($group_name, strrpos($group_name, '_') + 1);
            $count = 1;
            foreach ($questions as $question) {
                $question_id = substr($question, strrpos($question, '_') + 1);
                $connection->update('history_questions', ['history_questions_groups_id' => $group_id, 'question_order' => $count], ['id' => $question_id]);
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
            $connection->update('history_questions_groups', ['group_order' => $count], ['id' => $group_id]);
            $count++;
        }
    }


    public function groups($case_id = null) {
        if (empty($case_id)) {
            echo 'Case ID is missing.';die;
        }
        $this->loadModel('HistoryQuestionsGroups');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $group = $this->HistoryQuestionsGroups->newEntity();
            $group->all_cases_id = $case_id;
            $group->name = $this->request->data('HistoryQuestionsGroups.name');
            //$historyQuestionGroups = $this->HistoryQuestions->HistoryQuestionsGroups->patchEntity($historyQuestionGroups, $group);
            if ($this->HistoryQuestions->HistoryQuestionsGroups->save($group)) {
                $this->Flash->success(__('Groups have been saved.'));
                return $this->redirect(['controller' => 'HistoryQuestions', 'action' => 'groups', $case_id]);
            } else {
                $this->Flash->error(__('Groups could not be saved. Please, try again.'));
            }
        }
        
        $historyQuestionGroups = $this->HistoryQuestions->HistoryQuestionsGroups->getGroups($case_id);
        $this->set(compact('historyQuestionGroups'));
        $this->set('_serialize', ['historyQuestionGroups']);        
    }

    public function editGroup($id = null)
    {
        $this->loadModel('HistoryQuestionsGroups');

        $historyQuestionGroup = $this->HistoryQuestions->HistoryQuestionsGroups->get($id, [
            'contain' => []
        ]);

        if ($id == 0) {
            echo 'This group cannot be edited or deleted.';die;
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
        //pr($this->request->data);die();
            $group = $this->HistoryQuestionsGroups->newEntity();
            $group->name = $this->request->data('name');
            $group->id = $id;
            //$historyQuestion = $this->HistoryQuestions->patchEntity($historyQuestion, $this->request->data);
            if ($this->HistoryQuestions->HistoryQuestionsGroups->save($group)) {
                $this->Flash->success(__('Your changes have been saved.'));
                return $this->redirect(['controller' => 'HistoryQuestions', 'action' => 'groups', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('Your changes could not be saved. Please try again.'));
            }
        }

        $this->set(compact('historyQuestionGroup'));
        $this->set('_serialize', ['historyQuestionGroup']);
    }

    public function deleteGroup($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        if ($id == 0) {
            echo 'This group cannot be edited or deleted.';die;
        }

        $this->loadModel('HistoryQuestionsGroups');
        $historyQuestionGroup = $this->HistoryQuestions->HistoryQuestionsGroups->get($id);

        if ($this->HistoryQuestionsGroups->delete($historyQuestionGroup)) {
            $this->HistoryQuestions->query('update history_questions set history_questions_groups_id = 0 where history_questions_groups_id = {$id} and all_cases_id = {$historyQuestionGroup->all_cases_id}');
            $this->Flash->success(__('The group has been deleted.'));
        } else {
            $this->Flash->error(__('The group could not be deleted. Please try again.'));
        }
        
        return $this->redirect(['controller' => 'HistoryQuestions', 'action' => 'groups', $historyQuestionGroup->all_cases_id]);
    }

    public function questions($case_id = null) {
        if (empty($case_id)) {
            echo 'Case ID is missing.';die;
        }

        $historyQuestions = $this->HistoryQuestions->get_questions($case_id);

        $this->set(compact('historyQuestions', 'case_id'));
        $this->set('_serialize', ['historyQuestions']);
    }

    public function addQuestion($case_id = null)
    {
        $historyQuestion = $this->HistoryQuestions->newEntity();
        if ($this->request->is('post')) {
            $historyQuestion = $this->HistoryQuestions->patchEntity($historyQuestion, $this->request->data);
            if ($this->HistoryQuestions->save($historyQuestion)) {
                $this->Flash->success(__('The question has been saved.'));
                return $this->redirect(['controller' => 'HistoryQuestions', 'action' => 'questions', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The question could not be saved. Please try again.'));
            }
        }

        $videos = $this->HistoryQuestions->Videos->getVideoList($case_id);
        $this->set(compact('historyQuestion', 'videos', 'case_id'));
        $this->set('_serialize', ['historyQuestion']);
    }

    public function editQuestion($id = null)
    {
        $historyQuestion = $this->HistoryQuestions->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $historyQuestion = $this->HistoryQuestions->patchEntity($historyQuestion, $this->request->data);
            if ($this->HistoryQuestions->save($historyQuestion)) {
                $this->Flash->success(__('The question has been saved.'));
                return $this->redirect(['controller' => 'HistoryQuestions', 'action' => 'questions', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The question could not be saved. Please try again.'));
            }
        }

        $videos = $this->HistoryQuestions->Videos->getVideoList($historyQuestion->all_cases_id);
        $this->set(compact('historyQuestion', 'videos'));
        $this->set('_serialize', ['historyQuestion']);
    }

    public function deleteQuestion($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $historyQuestion = $this->HistoryQuestions->get($id);
        if ($this->HistoryQuestions->delete($historyQuestion)) {
            $this->Flash->success(__('The question has been deleted.'));
        } else {
            $this->Flash->error(__('The question could not be deleted. Please try again.'));
        }

        return $this->redirect(['controller' => 'HistoryQuestions', 'action' => 'questions', $historyQuestion->all_cases_id]);
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
