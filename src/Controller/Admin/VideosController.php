<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Videos Controller
 *
 * @property \App\Model\Table\VideosTable $Videos
 */
class VideosController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index($case_id = null)
    {
        $this->paginate = [
            'conditions' => ['all_cases_id' => $case_id],
            'contain' => ['AllCases']
        ];
        $this->set('case_id', $case_id);
        $this->set('videos', $this->paginate($this->Videos));
        $this->set('_serialize', ['videos']);
    }

    public function playVideo() {
        $this->autoRender = false;

        $video_name = $this->request->data['video_name'];
        $case_id = $this->request->data['case_id'];

        //get page
        $this->loadModel('CustomPages');
        $data = $this->CustomPages->get_page($case_id, 'intro');

        $streamer_path = $data->general_setting->streamer_path;
        $ios_path = $data->general_setting->ios_path;
        $folder = $data->general_setting->folder;

        $videos = array();
        $videos['rtmp'] = 'rtmp://'.$streamer_path.$folder.'/'.$video_name;
        $videos['http'] = 'http://'.$ios_path.$folder.'/'.$video_name;

        $this->set('autoplay', true);

        $this->response->body(json_encode($videos['http'], JSON_UNESCAPED_SLASHES));
    }

    /**
     * View method
     *
     * @param string|null $id Video id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $video = $this->Videos->get($id, [
            'contain' => ['AllCases', 'HistoryQuestions']
        ]);
        $this->set('video', $video);
        $this->set('_serialize', ['video']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($case_id = null)
    {
        $video = $this->Videos->newEntity();
        if ($this->request->is('post')) {
            $video = $this->Videos->patchEntity($video, $this->request->data);
            if ($this->Videos->save($video)) {
                $this->Flash->success(__('The video has been saved.'));
                return $this->redirect(['action' => 'index', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The video could not be saved. Please try again.'));
            }
        }

        $this->loadModel('Videos');
        $videos = $this->Videos->getPlaceholderVideosArray($this->case_id);
        $this->set(compact('videos'));

        $this->set(compact('video', 'case_id'));
        $this->set('_serialize', ['video']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Video id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $video = $this->Videos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $video = $this->Videos->patchEntity($video, $this->request->data);
            if ($this->Videos->save($video)) {
                $this->Flash->success(__('The video has been saved.'));
                return $this->redirect(['action' => 'index', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The video could not be saved. Please try again.'));
            }
        }

        $this->set(compact('video'));
        $this->set('_serialize', ['video']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Video id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $video = $this->Videos->get($id);
        if ($this->Videos->delete($video)) {
            $this->Flash->success(__('The video has been deleted.'));
        } else {
            $this->Flash->error(__('The video could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index', $video->all_cases_id]);
    }
}
