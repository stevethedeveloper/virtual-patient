<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

/**
 * Diagnostics Controller
 *
 * @property \App\Model\Table\DiagnosticsTable $Diagnostics
 */
class DiagnosticsController extends AppController
{
    public function diagnosis()
    {
        $case_id = $this->request->session()->read('case_id');

        $data = $this->CustomPages->get_page($case_id, 'diagnosis');

        $page = $data->custom_pages[0];

        $poster = (!empty($data->general_setting->video_placeholder)) ? $data->general_setting->video_placeholder : null;

        $d_option_cap = $data->general_setting->d_option_cap;
        $this->set(compact('d_option_cap'));

        $options = $this->Diagnostics->get_diagnosis_options($case_id);

        $this->loadModel('UserAnswers');
    
        $user_id = $this->Auth->user()['id'];
        $case_id = $this->request->session()->read('case_id');

        $differential_options_selected = $this->UserAnswers->find()
            ->select(['UserAnswers.answer_id', 'UserAnswers.question_id'])
            ->where(['UserAnswers.user_id' => $user_id, 'UserAnswers.all_cases_id' => $case_id, 'UserAnswers.section' => 'differential_diagnosis'])
            ->toArray();
        
        $locked = 0;
        $differential_already_selected = array();
        foreach ($differential_options_selected as $val) {
               if ($val->question_id != 999) {
                   $differential_already_selected[] = $val->answer_id;
               }
        }   

        $options_selected = $this->UserAnswers->find()
            ->select(['UserAnswers.answer_id', 'UserAnswers.question_id'])
            ->where(['UserAnswers.user_id' => $user_id, 'UserAnswers.all_cases_id' => $case_id, 'UserAnswers.section' => 'diagnosis'])
            ->toArray();
        
        $locked = 0;
        $already_selected = array();
        foreach ($options_selected as $val) {
               if ($val->question_id != 999) {
                   $already_selected[] = $val->answer_id;
               } else {
                   $locked = 1;
               }
        }   

        $total_count = count($already_selected);

        $this->set(compact('total_count'));

        $this->set(compact('data', 'page', 'options', 'already_selected', 'differential_already_selected', 'poster', 'locked'));
    }

    public function differential()
    {
        $case_id = $this->request->session()->read('case_id');

        $data = $this->CustomPages->get_page($case_id, 'differential_diagnosis');

        $page = $data->custom_pages[0];

        $poster = (!empty($data->general_setting->video_placeholder)) ? $data->general_setting->video_placeholder : null;

        $dd_option_cap = $data->general_setting->dd_option_cap;
        $this->set(compact('dd_option_cap'));

        $options = $this->Diagnostics->get_differential_options($case_id);

        $this->loadModel('UserAnswers');
    
        $user_id = $this->Auth->user()['id'];
        $case_id = $this->request->session()->read('case_id');

        $options_selected = $this->UserAnswers->find()
            ->select(['UserAnswers.answer_id', 'UserAnswers.question_id'])
            ->where(['UserAnswers.user_id' => $user_id, 'UserAnswers.all_cases_id' => $case_id, 'UserAnswers.section' => 'differential_diagnosis'])
            ->toArray();
        
        $locked = 0;
        $already_selected = array();
        foreach ($options_selected as $val) {
               if ($val->question_id != 999) {
                   $already_selected[] = $val->answer_id;
               } else {
                   $locked = 1;
               }
        }   

        $total_count = count($already_selected);

        $this->set(compact('total_count'));

        $this->set(compact('data', 'page', 'options', 'already_selected', 'poster', 'locked'));
    }

    public function selectOption() {
        $this->autoRender = false;

        $status = "error";
        $option_id = $this->request->data['option_id'];
        $section_name = $this->request->data['section_name'];
        $case_id = $this->request->session()->read('case_id');

        //get page
        $this->loadModel('CustomPages');
        $data = $this->CustomPages->get_page($case_id, $section_name);

        $dd_option_cap = $data->general_setting->dd_option_cap;
        $this->set(compact('dd_option_cap'));

        //update user_answers
        $this->loadModel('UserAnswers');
        
        $user_id = $this->Auth->user()['id'];

        $already_asked = $this->UserAnswers->find()
            ->where(['UserAnswers.user_id' => $user_id, 'UserAnswers.all_cases_id' => $case_id, 'UserAnswers.answer_id' => $option_id, 'UserAnswers.section' => $section_name])
            ->count();

        $total_count = $this->UserAnswers->find()
            ->where(['UserAnswers.user_id' => $user_id, 'UserAnswers.all_cases_id' => $case_id, 'UserAnswers.section' => $section_name])
            ->count();

        $this->set(compact('total_count'));

        if ($already_asked == 0) {    
            if ($total_count <= $dd_option_cap) {
                $data = $this->UserAnswers->newEntity();
                $data->user_id = $user_id;
                $data->all_cases_id = $case_id;
                $data->answer_id = $option_id;
                $data->section = $section_name;
                if ($this->UserAnswers->save($data)) {
                    $status = "entered";
                }
            } else {
                $status = "cap";
            }
        } else {
            $connection = ConnectionManager::get('default');
            $connection->delete('user_answers', ['user_id' => $user_id, 'all_cases_id' => $case_id, 'answer_id' => $option_id, 'section' => $section_name]);
            $status = "removed";
        }

        $this->response->body(json_encode($status));

        //return json_encode($videos->video_file_name);
        //$this->render('/Element/flowplayer', 'ajax');
    }

    public function lockD() {
        $this->autoRender = false;

        $case_id = $this->request->session()->read('case_id');
        $user_id = $this->Auth->user()['id'];
        $this->loadModel('UserAnswers');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $section_name = 'diagnosis';
            $answer_count = $this->UserAnswers->find()
                ->where(['UserAnswers.user_id' => $user_id, 'UserAnswers.all_cases_id' => $case_id, 'UserAnswers.section' => $section_name])
                ->count();

            if ($answer_count == 0) {
                $this->Flash->error(__('Please select one or more options.'));
                return $this->redirect(['controller' => 'diagnostics', 'action' => 'diagnosis']);
            }
        }

        $data = $this->UserAnswers->newEntity();
        $data->user_id = $user_id;
        $data->all_cases_id = $case_id;
        $data->question_id = 999;
        $data->answer_id = 999;
        $data->section = 'diagnosis';
        if ($this->UserAnswers->save($data)) {
            return $this->redirect(['controller' => 'Management', 'action' => 'index']);
        } else {
            return $this->redirect(['controller' => 'Diagnostics', 'action' => 'diagnosis']);
        }
    }

    public function lockDd() {
        $this->autoRender = false;

        $case_id = $this->request->session()->read('case_id');
        $user_id = $this->Auth->user()['id'];

        $this->loadModel('UserAnswers');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $section_name = 'differential_diagnosis';
            $answer_count = $this->UserAnswers->find()
                ->where(['UserAnswers.user_id' => $user_id, 'UserAnswers.all_cases_id' => $case_id, 'UserAnswers.section' => $section_name])
                ->count();

            if ($answer_count == 0) {
                $this->Flash->error(__('Please select one or more options.'));
                return $this->redirect(['controller' => 'diagnostics', 'action' => 'differential']);
            }
        }

        $data = $this->UserAnswers->newEntity();
        $data->user_id = $user_id;
        $data->all_cases_id = $case_id;
        $data->question_id = 999;
        $data->answer_id = 999;
        $data->section = 'differential_diagnosis';
        if ($this->UserAnswers->save($data)) {
            return $this->redirect(['controller' => 'CustomPages', 'action' => 'more_information']);
        } else {
            return $this->redirect(['controller' => 'Diagnostics', 'action' => 'differential']);
        }
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['AllCases', 'Dds', 'Diags']
        ];
        $this->set('diagnostics', $this->paginate($this->Diagnostics));
        $this->set('_serialize', ['diagnostics']);
    }

    /**
     * View method
     *
     * @param string|null $id Diagnostic id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $diagnostic = $this->Diagnostics->get($id, [
            'contain' => ['AllCases', 'Dds', 'Diags']
        ]);
        $this->set('diagnostic', $diagnostic);
        $this->set('_serialize', ['diagnostic']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $diagnostic = $this->Diagnostics->newEntity();
        if ($this->request->is('post')) {
            $diagnostic = $this->Diagnostics->patchEntity($diagnostic, $this->request->data);
            if ($this->Diagnostics->save($diagnostic)) {
                $this->Flash->success(__('The diagnostic has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The diagnostic could not be saved. Please, try again.'));
            }
        }
        $allCases = $this->Diagnostics->AllCases->find('list', ['limit' => 200]);
        $dds = $this->Diagnostics->Dds->find('list', ['limit' => 200]);
        $diags = $this->Diagnostics->Diags->find('list', ['limit' => 200]);
        $this->set(compact('diagnostic', 'allCases', 'dds', 'diags'));
        $this->set('_serialize', ['diagnostic']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Diagnostic id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $diagnostic = $this->Diagnostics->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $diagnostic = $this->Diagnostics->patchEntity($diagnostic, $this->request->data);
            if ($this->Diagnostics->save($diagnostic)) {
                $this->Flash->success(__('The diagnostic has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The diagnostic could not be saved. Please, try again.'));
            }
        }
        $allCases = $this->Diagnostics->AllCases->find('list', ['limit' => 200]);
        $dds = $this->Diagnostics->Dds->find('list', ['limit' => 200]);
        $diags = $this->Diagnostics->Diags->find('list', ['limit' => 200]);
        $this->set(compact('diagnostic', 'allCases', 'dds', 'diags'));
        $this->set('_serialize', ['diagnostic']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Diagnostic id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $diagnostic = $this->Diagnostics->get($id);
        if ($this->Diagnostics->delete($diagnostic)) {
            $this->Flash->success(__('The diagnostic has been deleted.'));
        } else {
            $this->Flash->error(__('The diagnostic could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
