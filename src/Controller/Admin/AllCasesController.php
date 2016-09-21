<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

/**
 * AllCases Controller
 *
 * @property \App\Model\Table\AllCasesTable $AllCases
 */
class AllCasesController extends AppController
{

    public function newCase() {
        $case = array(
                        'name' => 'New Case'
                    );
        $pages = array(
                        'intro' => 'Case Overview',
                        'history' => 'Patient History',
                        'physical_exam' => 'Physical Exam',
                        'more_information' => 'More Information',
                        'labs' => 'Labs',
                        'management_counseling' => 'Management Counseling',
                        'management_medication' => 'Management Medication',
                        'management_referral' => 'Management Referral',
                        'billing' => 'Billing',
                        'feedback_study' => 'Feedback Study',
                        'feedback_counseling' => 'Feedback Counseling',
                        'feedback_medication' => 'Feedback Medication',
                        'feedback_referral' => 'Feedback Referral',
                        'feedback_billing' => 'Feedback Billing',
                        'summary' => 'Summary',
                        'differential_diagnosis' => 'Differential Diagnosis',
                        'diagnosis' => 'Diagnosis'
            );

        $default_values = array(
                'general_settings' => array(
                        'streamer_path' => 's2ib0h2bwq9s8e.cloudfront.net/cfx/st/mp4:',
                        'ios_path' => 'd2brnczga3pdl.cloudfront.net/'
                    ),
                'billings' => array(
                        'billing_text' => 'Do not participate in billing.',
                        'billing_group' => 'x',
                        'billing_order' => '1'
                    ),
                'management_counselings' => array(
                        'counseling_order' => '1',
                        'counseling_group' => 'x',
                        'counseling_text' => 'No Counseling at this time.'
                    ),
                'management_medications' => array(
                        'medication_order' => '1',
                        'medication_group' => 'x',
                        'medication_text' => 'Prescribe no medications at this time.'
                    ),
                'management_referrals' => array(
                        'referral_order' => '1',
                        'referral_group' => 'x',
                        'referral_text' => 'Do not refer this patient to a specialist at this point.'
                    )
            );

        $connection = ConnectionManager::get('default');
        $result = $connection->insert('all_cases', [
            'name' => $case['name'],
            'created' => date('Y-m-d H:i:s'),
            'modified' => date('Y-m-d H:i:s')
        ]);
        $all_cases_id = $result->lastInsertId('all_cases');

        foreach ($pages as $slug => $title) {
            $connection->insert('custom_pages', [
                'all_cases_id' => $all_cases_id,
                'slug' => $slug,
                'pages_title' => $title,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ]);
        }

        $connection->insert('general_settings', [
            'all_cases_id' => $all_cases_id,
            'streamer_path' => $default_values['general_settings']['streamer_path'],
            'ios_path' => $default_values['general_settings']['ios_path'],
            'created' => date('Y-m-d H:i:s'),
            'modified' => date('Y-m-d H:i:s')
        ]);

        $connection->insert('billings', [
            'all_cases_id' => $all_cases_id,
            'billing_text' => $default_values['billings']['billing_text'],
            'billing_group' => $default_values['billings']['billing_group'],
            'billing_order' => $default_values['billings']['billing_order'],
            'created' => date('Y-m-d H:i:s'),
            'modified' => date('Y-m-d H:i:s')
        ]);

        $connection->insert('management_counselings', [
            'all_cases_id' => $all_cases_id,
            'counseling_text' => $default_values['management_counselings']['counseling_text'],
            'counseling_group' => $default_values['management_counselings']['counseling_group'],
            'counseling_order' => $default_values['management_counselings']['counseling_order'],
            'created' => date('Y-m-d H:i:s'),
            'modified' => date('Y-m-d H:i:s')
        ]);

        $connection->insert('management_medications', [
            'all_cases_id' => $all_cases_id,
            'medication_text' => $default_values['management_medications']['medication_text'],
            'medication_group' => $default_values['management_medications']['medication_group'],
            'medication_order' => $default_values['management_medications']['medication_order'],
            'created' => date('Y-m-d H:i:s'),
            'modified' => date('Y-m-d H:i:s')
        ]);

        $connection->insert('management_referrals', [
            'all_cases_id' => $all_cases_id,
            'referral_text' => $default_values['management_referrals']['referral_text'],
            'referral_group' => $default_values['management_referrals']['referral_group'],
            'referral_order' => $default_values['management_referrals']['referral_order'],
            'created' => date('Y-m-d H:i:s'),
            'modified' => date('Y-m-d H:i:s')
        ]);

        return $this->redirect(['controller' => 'AllCases', 'action' => 'edit', $all_cases_id]);
    }

    public function currentCase() {
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'limit' => 25,
            'order' => [
                'AllCases.name' => 'asc'
            ]
        ];
        $this->set('allCases', $this->paginate($this->AllCases));
        $this->set('_serialize', ['allCases']);
    }

    public function edit($id = null)
    {
        $allCase = $this->AllCases->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $allCase = $this->AllCases->patchEntity($allCase, $this->request->data);
            if ($this->AllCases->save($allCase)) {
                $this->Flash->success(__('Settings have been saved.'));
                //return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The all case could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('allCase'));
        $this->set('_serialize', ['allCase']);
    }

    /**
     * View method
     *
     * @param string|null $id All Case id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $allCase = $this->AllCases->get($id, [
            'contain' => []
        ]);
        $this->set('allCase', $allCase);
        $this->set('_serialize', ['allCase']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $allCase = $this->AllCases->newEntity();
        if ($this->request->is('post')) {
            $allCase = $this->AllCases->patchEntity($allCase, $this->request->data);
            if ($this->AllCases->save($allCase)) {
                $this->Flash->success(__('The all case has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The all case could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('allCase'));
        $this->set('_serialize', ['allCase']);
    }

    /**
     * Delete method
     *
     * @param string|null $id All Case id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $allCase = $this->AllCases->get($id);
        if ($this->AllCases->delete($allCase)) {
            $this->Flash->success(__('The all case has been deleted.'));
        } else {
            $this->Flash->error(__('The all case could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
