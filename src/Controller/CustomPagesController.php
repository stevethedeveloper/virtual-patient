<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

/**
 * CustomPages Controller
 *
 * @property \App\Model\Table\CustomPagesTable $CustomPages
 */
class CustomPagesController extends AppController
{

    public function intro() {
        if(stripos($_SERVER['HTTP_REFERER'], 'courses') !== false) {
            $this->goToCurrentSection($this->Auth->user('id'), $this->request->session()->read('case_id'));
        }

        $case_id = $this->request->session()->read('case_id');

        $data = $this->CustomPages->get_page($case_id, 'intro');

        $page = $data->custom_pages[0];

        $poster = (!empty($data->general_setting->video_placeholder)) ? $data->general_setting->video_placeholder : null;

        $autoplay = true;

        $this->loadModel('Videos');
        $videos = $this->Videos->getVideosArray($data, $page->video_id);

        $this->set(compact('page', 'videos', 'poster', 'autoplay'));

    }

    public function goToCurrentSection($user_id = null, $case_id = null) {
        if ($user_id === null || $case_id === null) {
            return;
        }

        $connection = ConnectionManager::get('default');
        $results = $connection->execute("SELECT section FROM user_progress WHERE user_id = '$user_id' AND all_cases_id = '$case_id' AND current_section = '1';")->fetch('assoc');

        if (!empty($results) && count($results) > 0 && $results['section'] != 'intro') {
            return $this->redirect(['controller' => $this->case_sections[$results['section']]['controller'], 'action' => $this->case_sections[$results['section']]['action']]);
        }
        
        return;
    }

    public function physicalExam() {
        $case_id = $this->request->session()->read('case_id');

        $data = $this->CustomPages->get_page($case_id, 'physical_exam');

        $page = $data->custom_pages[0];

        $poster = (!empty($data->general_setting->video_placeholder)) ? $data->general_setting->video_placeholder : null;

        $this->set(compact('data', 'page', 'poster'));
    }

    public function moreInformation() {
        $case_id = $this->request->session()->read('case_id');

        $data = $this->CustomPages->get_page($case_id, 'more_information');

        $page = $data->custom_pages[0];

        $poster = (!empty($data->general_setting->video_placeholder)) ? $data->general_setting->video_placeholder : null;

        $this->set(compact('data', 'page', 'poster'));
    }

    public function summary() {

        $case_id = $this->request->session()->read('case_id');

        $data = $this->CustomPages->get_page($case_id, 'summary');

        $page = $data->custom_pages[0];

        $poster = (!empty($data->general_setting->video_placeholder)) ? $data->general_setting->video_placeholder : null;

        $autoplay = true;

        $this->loadModel('Videos');
        $videos = $this->Videos->getVideosArray($data, $page->video_id);

        $this->set(compact('page', 'videos', 'poster', 'autoplay'));

    }

    public function completed() {
        $this->autorender = false;
        
        $user_id = $this->Auth->user('id');
        $case_id = $this->request->session()->read('case_id');

        //get wp id
        if (!empty($this->request->params['case_slug'])) {
            $connection = ConnectionManager::get('default');
            $results = $connection->execute("SELECT wp_post_id, wp_lesson_post_id, course_home FROM all_cases where id = '$case_id'")->fetch('assoc');
            if (count($results) > 0) {
                $wp_post_id = $results['wp_post_id'];
                $wp_lesson_post_id = $results['wp_lesson_post_id'];
                $course_home = $results['course_home'];
            }
        }

        //get wp record
        if (!empty($wp_lesson_post_id) && !empty($wp_post_id)) {
            $connection = ConnectionManager::get('wordpress');
            $results = $connection->execute("SELECT umeta_id, meta_value FROM wp_usermeta where meta_key = '_sfwd-course_progress' and user_id = '$user_id'")->fetch('assoc');

            $umeta_id = $results['umeta_id'];
            $meta_value = $results['meta_value'];
            $meta_array = unserialize($meta_value);

            $meta_array[$wp_post_id]['lessons'][$wp_lesson_post_id] = 1;

            $meta = serialize($meta_array);

            $connection->query("update wp_usermeta set meta_value = '".$meta."' where umeta_id = '".$umeta_id."'");
        }

        return $this->redirect($course_home);

    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['AllCases']
        ];
        $this->set('customPages', $this->paginate($this->CustomPages));
        $this->set('_serialize', ['customPages']);
    }

    /**
     * View method
     *
     * @param string|null $id Custom Page id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $customPage = $this->CustomPages->get($id, [
            'contain' => ['AllCases']
        ]);
        $this->set('customPage', $customPage);
        $this->set('_serialize', ['customPage']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customPage = $this->CustomPages->newEntity();
        if ($this->request->is('post')) {
            $customPage = $this->CustomPages->patchEntity($customPage, $this->request->data);
            if ($this->CustomPages->save($customPage)) {
                $this->Flash->success(__('The custom page has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The custom page could not be saved. Please, try again.'));
            }
        }
        $allCases = $this->CustomPages->AllCases->find('list', ['limit' => 200]);
        $this->set(compact('customPage', 'allCases'));
        $this->set('_serialize', ['customPage']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Custom Page id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $customPage = $this->CustomPages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customPage = $this->CustomPages->patchEntity($customPage, $this->request->data);
            if ($this->CustomPages->save($customPage)) {
                $this->Flash->success(__('The custom page has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The custom page could not be saved. Please, try again.'));
            }
        }
        $allCases = $this->CustomPages->AllCases->find('list', ['limit' => 200]);
        $this->set(compact('customPage', 'allCases'));
        $this->set('_serialize', ['customPage']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Custom Page id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customPage = $this->CustomPages->get($id);
        if ($this->CustomPages->delete($customPage)) {
            $this->Flash->success(__('The custom page has been deleted.'));
        } else {
            $this->Flash->error(__('The custom page could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
