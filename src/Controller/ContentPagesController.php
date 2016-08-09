<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ContentPages Controller
 *
 * @property \App\Model\Table\ContentPagesTable $ContentPages
 */
class ContentPagesController extends AppController
{

    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function display()
    {
        $path = func_get_args();

        if ($path[0] == 'home-page') {
            $this->viewBuilder()->layout('home');
        }

        $contentPage = $this->ContentPages->find()
            ->autoFields(true)
            ->select(['PageTypes.id', 'PageTypes.name'])
            ->leftJoin(
                ['PageTypes' => 'page_types'],
                ['PageTypes.id = ContentPages.page_type_id'])        
            ->where(['ContentPages.slug' => $path[0]])
            ->first();

//        $contentPage = $this->ContentPages->find([
//            'contain' => ['PageTypes'],
//            'conditions' => ['slug' => $path[0]]
//        ]);


        $this->set('contentPage', $contentPage);
        $this->set('_serialize', ['contentPage']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['PageTypes']
        ];
        $contentPages = $this->paginate($this->ContentPages);

        $this->set(compact('contentPages'));
        $this->set('_serialize', ['contentPages']);
    }

    /**
     * View method
     *
     * @param string|null $id Content Page id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contentPage = $this->ContentPages->get($id, [
            'contain' => ['PageTypes']
        ]);

        $this->set('contentPage', $contentPage);
        $this->set('_serialize', ['contentPage']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contentPage = $this->ContentPages->newEntity();
        if ($this->request->is('post')) {
            $contentPage = $this->ContentPages->patchEntity($contentPage, $this->request->data);
            if ($this->ContentPages->save($contentPage)) {
                $this->Flash->success(__('The content page has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The content page could not be saved. Please, try again.'));
            }
        }
        $pageTypes = $this->ContentPages->PageTypes->find('list', ['limit' => 200]);
        $this->set(compact('contentPage', 'pageTypes'));
        $this->set('_serialize', ['contentPage']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Content Page id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contentPage = $this->ContentPages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contentPage = $this->ContentPages->patchEntity($contentPage, $this->request->data);
            if ($this->ContentPages->save($contentPage)) {
                $this->Flash->success(__('The content page has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The content page could not be saved. Please, try again.'));
            }
        }
        $pageTypes = $this->ContentPages->PageTypes->find('list', ['limit' => 200]);
        $this->set(compact('contentPage', 'pageTypes'));
        $this->set('_serialize', ['contentPage']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Content Page id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contentPage = $this->ContentPages->get($id);
        if ($this->ContentPages->delete($contentPage)) {
            $this->Flash->success(__('The content page has been deleted.'));
        } else {
            $this->Flash->error(__('The content page could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
