<?php
namespace App\Controller;

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
    public function index()
    {
        $this->paginate = [
            'contain' => ['AllCases']
        ];
        $this->set('videos', $this->paginate($this->Videos));
        $this->set('_serialize', ['videos']);
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
    public function add()
    {
        $video = $this->Videos->newEntity();
        if ($this->request->is('post')) {
            $video = $this->Videos->patchEntity($video, $this->request->data);
            if ($this->Videos->save($video)) {
                $this->Flash->success(__('The video has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The video could not be saved. Please, try again.'));
            }
        }
        $allCases = $this->Videos->AllCases->find('list', ['limit' => 200]);
        $this->set(compact('video', 'allCases'));
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
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The video could not be saved. Please, try again.'));
            }
        }
        $allCases = $this->Videos->AllCases->find('list', ['limit' => 200]);
        $this->set(compact('video', 'allCases'));
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
        return $this->redirect(['action' => 'index']);
    }
}
