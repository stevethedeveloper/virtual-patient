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
use Cake\ORM\TableRegistry;

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
    var $case_sections = array(
        'intro' => array('controller' => 'CustomPages', 'action' => 'intro'),
        'history' => array('controller' => 'HistoryQuestions', 'action' => 'index'),
        'physical_exam' => array('controller' => 'CustomPages', 'action' => 'physicalExam'),
        'differential_diagnosis' => array('controller' => 'Diagnostics', 'action' => 'differential'),
        'more_information' => array('controller' => 'CustomPages', 'action' => 'moreInformation'),
        'labs' => array('controller' => 'OrderLabs', 'action' => 'index'),
        'diagnosis' => array('controller' => 'Diagnostics', 'action' => 'diagnosis'),
        'management_counseling' => array('controller' => 'ManagementCounselings', 'action' => 'index'),
        'management_medication' => array('controller' => 'ManagementMedications', 'action' => 'index'),
        'management_referral' => array('controller' => 'ManagementReferrals', 'action' => 'index'),
        'billing' => array('controller' => 'Billings', 'action' => 'index'),
        'feedback_labs' => array('controller' => 'Feedback', 'action' => 'study'),
        'feedback_counseling' => array('controller' => 'Feedback', 'action' => 'counseling'),
        'feedback_medication' => array('controller' => 'Feedback', 'action' => 'medication'),
        'feedback_referral' => array('controller' => 'Feedback', 'action' => 'referral'),
        'feedback_billing' => array('controller' => 'Feedback', 'action' => 'billing'),
        'summary' => array('controller' => 'CustomPages', 'action' => 'summary'),
        );
    var $current_section = null;
    var $locked_sections = array();
    var $colors = array('magenta', 'blue', 'green', 'purple', 'red', 'brown');
    var $case_id = null;
    
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
            'loginRedirect' => false,
            'logoutRedirect' => false,
            'authorize' => array('Controller'),
        ]);

        $this->loadModel('AllCases');
        $this->loadModel('CustomPages');
    }

    public function loggedInToWordpress() {
        $cookies = $_COOKIE;
        $found = $user_id = false;
        foreach ($cookies as $key => $val) {
            if (stripos($key, 'wordpress_logged_in_') !== false) {
                $username = substr($val, 0, stripos($val, '|'));
                $found = true;
                break;
            }
        }

        if ($found === true) {

            $connection = ConnectionManager::get('wordpress');
            $results = $connection->execute("SELECT ID FROM wp_users where user_login = '$username'")->fetch('assoc');
            
            if (count($results) > 0) {

                $user_id = $user['id'] = $results['ID'];

            }

            if (!$user_id) {
                return false;
            } elseif ($user['id'] != $user_id) {
                return false;
            }

            return true;

        }

        return false;

    }

    public function logInFromWordpress() {
        $user = array();
        $user['id'] = null;
        $user['first_name'] = null;
        $user['last_name'] = null;
        $user['is_admin'] = 0;

        $cookies = $_COOKIE;
        $found = false;
        foreach ($cookies as $key => $val) {
            if (stripos($key, 'wordpress_logged_in_') !== false) {

                $username = substr($val, 0, stripos($val, '|'));
                $found = true;
                break;
            }
        }

        if ($found === true) {

            $connection = ConnectionManager::get('wordpress');
            $results = $connection->execute("SELECT ID FROM wp_users where user_login = '$username'")->fetch('assoc');
            
            if (count($results) > 0) {

                $user_id = $user['id'] = $results['ID'];

            }

            $results = $connection->execute("SELECT * FROM wp_usermeta where user_id = '$user_id'")->fetchAll('assoc');

            foreach ($results as $meta_record) {

                if ($meta_record['meta_key'] == "first_name") {

                    $user['first_name'] = $meta_record['meta_value'];

                }

                if ($meta_record['meta_key'] == "last_name") {

                    $user['last_name'] = $meta_record['meta_value'];

                }

                if ($meta_record['meta_key'] == "wp_capabilities") {

                    if (stripos($meta_record['meta_value'], 'admin') !== false) {

                        $user['is_admin'] = 1;
                        $user['role'] = 'admin';

                    }

                }

            }
        }

        if ($user['id'] != null) {
            $this->checkUserRecord($user['id'], $user['is_admin']);
            $this->Auth->setUser($user);
        } else {
            return $this->redirect(BACK_TO_WP);
        }

        return false;

    }

    public function checkUserRecord($user_id, $is_admin) {

        $this->loadModel('Users');
        $data = $this->Users->find()
            ->where(['Users.id' => $user_id])
            ->count();

        if ($data == 0) {
            $usersTable = TableRegistry::get('Users');
            $user = $usersTable->newEntity();
            $user->id = $user_id;
            $user->is_admin = $is_admin;
            $usersTable->save($user);
        } else {
            $usersTable = TableRegistry::get('Users');
            $user = $usersTable->get($user_id);
            $user->id = $user_id;
            $user->is_admin = $is_admin;
            $usersTable->save($user);
        }

    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $user_logged_in = $this->Auth->user();
        $logged_in = $this->loggedInToWordpress();

        if(!$user_logged_in || $logged_in === false) {
            $this->logInFromWordpress();
        }

        if (isset($this->request->query) && isset($this->request->query['case_id'])) {
            $this->case_id = $this->request->query['case_id'];
        } else {
            if (isset($this->request->params['pass'][0])) {
                $this->case_id = $this->request->params['pass'][0];
            }
        }
        $this->set('case_id_nav', $this->case_id);
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
        $this->trackProgress($this->Auth->user('id'), $this->request->session()->read('case_id'));        
    }

    public function trackProgress($user_id = null, $case_id = null) {
        if ($user_id === null || $case_id === null) {
            return;
        }

        $controller = $this->request->controller;
        $action = $this->request->action;

        $connection = ConnectionManager::get('default');
        
        foreach ($this->case_sections as $name => $section) {
            if ($controller == $section['controller'] && $action == $section['action']) {
                $results = $connection->execute("SELECT id FROM user_progress WHERE user_id = '$user_id' AND all_cases_id = '$case_id' AND section = '$name';")->fetch('assoc');
                //pr($results);die;
                if (!empty($results) && count($results) > 0) {
                    $connection->update('user_progress', ['current_section' => 0], ['all_cases_id' => $case_id, 'user_id' => $user_id]);
                    $connection->update('user_progress', ['current_section' => 1, 'modified' => date('Y-m-d H:i:s')], ['id' => $results['id']]);
                } else {
                    $connection->update('user_progress', ['current_section' => 0], ['all_cases_id' => $case_id, 'user_id' => $user_id]);
                    $connection->insert('user_progress', [
                        'user_id' => $user_id,
                        'all_cases_id' => $case_id,
                        'section' => $name,
                        'current_section' => 1,
                        'created' => date('Y-m-d H:i:s'),
                        'modified' => date('Y-m-d H:i:s'),
                    ], ['created' => 'datetime']);                    
                }
                break;
            }
            
        }

        $results = $connection->execute("SELECT id, section FROM user_progress WHERE user_id = '$user_id' AND all_cases_id = '$case_id';")->fetchAll('assoc');
        $visited = array();
        foreach ($results as $val) {
            $visited[] = $val['section'];
        }
        $keys = array_keys($this->case_sections);
        $this->locked_sections = array_diff($keys, $visited);
        $this->set('locked_sections', $this->locked_sections);
    }

    public function isAuthorized($user = null)
    {
        //get wp id
        if (!empty($this->request->params['case_slug'])) {
            $slug = $this->request->params['case_slug'];
            $connection = ConnectionManager::get('default');
            $results = $connection->execute("SELECT all_cases.id, all_cases.wp_post_id, all_cases.course_home, general_settings.hide_billing FROM all_cases, general_settings where all_cases.id = general_settings.all_cases_id AND slug = '$slug'")->fetch('assoc');
            if (count($results) > 0) {
                $wp_post_id = $results['wp_post_id'];
                $case_id = $results['id'];
                $course_home = $results['course_home'];
                $hide_billing = $results['hide_billing'];
                $this->set('course_home', $course_home);
                $this->request->session()->write('course_home', $course_home);
                $this->set('hide_billing', $hide_billing);
                $this->request->session()->write('hide_billing', $hide_billing);
            }
        }

        //get wp record
        if (!empty($wp_post_id)) {
            $connection = ConnectionManager::get('wordpress');
            $results = $connection->execute("SELECT meta_value FROM wp_postmeta where meta_key = '_sfwd-courses' and post_id = '$wp_post_id'")->fetch('assoc');
            $meta_value = $results['meta_value'];
            $meta_array = unserialize($meta_value);

            $access_list = explode(',', $meta_array['sfwd-courses_course_access_list']);
            
            //$user = $this->request->session()->read('Auth.User');

            if (in_array($user['id'], $access_list)) {
                $this->request->session()->write('case_id', $case_id);
                return true;
            }
        }

        // Only admins can access admin functions
        if (isset($this->request->params['prefix']) && $this->request->params['prefix'] === 'admin') {
            return (bool)($user['role'] === 'admin');
        }

        // Default deny
        return $this->redirect(BACK_TO_WP);
    }

}
