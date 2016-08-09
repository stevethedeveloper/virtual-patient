<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'loginRedirect' => [
                'controller' => 'Dashboard',
                'action' => 'index',
                'prefix' => 'admin'
            ],
            'logoutRedirect' => [
                'prefix' => false,
                'controller' => 'Pages',
                'action' => 'display',
                'home',
            ]
        ]);
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }

        if ($this->Auth->user()) {
            $this->set('username', $this->Auth->user()['username']);
        }

        $connection = ConnectionManager::get('default');
        $this->loadModel('Menus');

        $menu = $this->Menus->find('all', [
            'conditions' => ['Menus.parent_id IS NULL'],
            'contain' => ['ParentMenus', 'ChildMenus' => ['ContentPages'], 'ContentPages'],
            'order' => ['Menus.display_order ASC']
        ])->toArray();

        $this->set('menus', $menu);
    }

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['display']);
    }

    public function isAuthorized($user)
    {
        if (isset($this->request->params['prefix']) && $this->request->params['prefix'] === 'admin') {
            if (isset($user['role']) && ($user['role'] === 'admin' || $user['role'] === 'superadmin')) {
                return true;
            }
        }

        // Default deny
        return false;
    }

}
