<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

/**
 * Menus Controller
 *
 * @property \App\Model\Table\MenusTable $Menus
 */
class MenusController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ParentMenus'],
            'limit' => 20,
            'order' => ['Menus.display_order ASC'],
            'conditions' => ['Menus.parent_id IS NULL']
        ];
        $menus = $this->paginate($this->Menus);

        $this->set(compact('menus'));
        $this->set('_serialize', ['menus']);
    }

    /**
     * View method
     *
     * @param string|null $id Menu id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

        $menu = $this->Menus->get($id, [
            'contain' => ['ParentMenus', 'ChildMenus']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $menu = $this->Menus->newEntity();
            $this->request->data['display_order'] = $this->Menus->getDisplayOrder($this->request->data['parent_id']);
            $menu = $this->Menus->patchEntity($menu, $this->request->data);
            if ($this->Menus->save($menu)) {
                $this->Flash->success(__('The submenu has been saved.'));
                return $this->redirect(['action' => 'view', $id]);
            } else {
                pr($menu->errors());
                $this->Flash->error(__('The submenu could not be saved. Please, try again.'));
            }
        }

        $contentPages = $this->Menus->ContentPages->find('list', ['limit' => 1200]);
        $this->set('contentPages', $contentPages);
        $this->set('menu', $menu);
        $this->set('_serialize', ['menu']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($parent_id = null)
    {
        $menu = $this->Menus->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['display_order'] = $this->Menus->getDisplayOrder($this->request->data['parent_id']);
            $menu = $this->Menus->patchEntity($menu, $this->request->data);
            if ($this->Menus->save($menu)) {
                $this->Flash->success(__('The menu has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                pr($menu->errors());
                $this->Flash->error(__('The menu could not be saved. Please, try again.'));
            }
        }
        $parentMenus = $this->Menus->ParentMenus->find('list', ['limit' => 200]);
        $contentPages = $this->Menus->ContentPages->find('list', ['limit' => 1200, 'order' => ['ContentPages.title ASC']]);
        $this->set(compact('menu', 'parentMenus', 'contentPages'));
        $this->set('_serialize', ['menu']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Menu id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $menu = $this->Menus->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $menu = $this->Menus->patchEntity($menu, $this->request->data);
            if ($this->Menus->save($menu)) {
                $this->Flash->success(__('The menu item has been saved.'));
                if ($this->request->data['parent_id']) {
                    return $this->redirect(['action' => 'view', $this->request->data['parent_id']]);
                }
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The menu item could not be saved. Please, try again.'));
            }
        }
        $parentMenus = $this->Menus->ParentMenus->find('list', ['limit' => 200]);
        $contentPages = $this->Menus->ContentPages->find('list', ['limit' => 1200, 'order' => ['ContentPages.title ASC']]);
        $this->set(compact('menu', 'parentMenus', 'contentPages'));
        $this->set('_serialize', ['menu']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Menu id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $menu = $this->Menus->get($id);

        if ($this->Menus->delete($menu)) {
            $this->Menus->deleteAll(['parent_id' => $menu->id]);
            $this->Flash->success(__('The menu has been deleted.'));
        } else {
            $this->Flash->error(__('The menu could not be deleted. Please, try again.'));
        }
        if ($menu->parent_id) {
            return $this->redirect(['action' => 'view', $menu->parent_id]);
        }
        return $this->redirect(['action' => 'index']);
    }

    public function changeTopOrder() {
        $this->autoRender = false;
        $arr = $this->request->data;

        $connection = ConnectionManager::get('default');

        $count = 1;
        foreach ($arr['data'] as $option) {
            $option_id = substr($option, strrpos($option, '_') + 1);
            $connection->update('menus', ['display_order' => $count], ['id' => $option_id]);
            $count++;
        }
    }

}
