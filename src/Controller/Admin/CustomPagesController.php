<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * CustomPages Controller
 *
 * @property \App\Model\Table\CustomPagesTable $CustomPages
 */
class CustomPagesController extends AppController
{

    public function intro($case_id) {
        $query = $this->CustomPages->find('all', [
            'conditions' => ['CustomPages.all_cases_id' => $case_id, 'CustomPages.slug' => 'intro'],
            'order' => ['CustomPages.id' => 'DESC']
        ]);
        $customPage = $query->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $customPage = $this->CustomPages->patchEntity($customPage, $this->request->data);
            if ($this->CustomPages->save($customPage)) {
                $this->Flash->success(__('The page has been saved.'));
                //return $this->redirect(['action' => 'index', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The page could not be saved. Please try again.'));
            }
        }

        $videos = $this->CustomPages->Videos->getVideoList($case_id);
        $this->set(compact('customPage', 'videos', 'case_id'));
        $this->set('_serialize', ['customPage']);
    }

    public function physicalExam($case_id) {
        $query = $this->CustomPages->find('all', [
            'conditions' => ['CustomPages.all_cases_id' => $case_id, 'CustomPages.slug' => 'physical_exam'],
            'order' => ['CustomPages.id' => 'DESC']
        ]);
        $customPage = $query->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $customPage = $this->CustomPages->patchEntity($customPage, $this->request->data);
            if ($this->CustomPages->save($customPage)) {
                $this->Flash->success(__('The page has been saved.'));
                //return $this->redirect(['action' => 'index', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The page could not be saved. Please try again.'));
            }
        }

        $this->set(compact('customPage', 'case_id'));
        $this->set('_serialize', ['customPage']);
    }

    public function moreInformation($case_id) {
        $query = $this->CustomPages->find('all', [
            'conditions' => ['CustomPages.all_cases_id' => $case_id, 'CustomPages.slug' => 'more_information'],
            'order' => ['CustomPages.id' => 'DESC']
        ]);
        $customPage = $query->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $customPage = $this->CustomPages->patchEntity($customPage, $this->request->data);
            if ($this->CustomPages->save($customPage)) {
                $this->Flash->success(__('The page has been saved.'));
                //return $this->redirect(['action' => 'index', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The page could not be saved. Please try again.'));
            }
        }

        $this->set(compact('customPage', 'case_id'));
        $this->set('_serialize', ['customPage']);
    }

    public function summary($case_id) {
        $query = $this->CustomPages->find('all', [
            'conditions' => ['CustomPages.all_cases_id' => $case_id, 'CustomPages.slug' => 'summary'],
            'order' => ['CustomPages.id' => 'DESC']
        ]);
        $customPage = $query->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $customPage = $this->CustomPages->patchEntity($customPage, $this->request->data);
            if ($this->CustomPages->save($customPage)) {
                $this->Flash->success(__('The page has been saved.'));
                //return $this->redirect(['action' => 'index', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The page could not be saved. Please try again.'));
            }
        }

        $videos = $this->CustomPages->Videos->getVideoList($case_id);
        $this->set(compact('customPage', 'videos', 'case_id'));
        $this->set('_serialize', ['customPage']);
    }

    public function history($case_id) {
        $query = $this->CustomPages->find('all', [
            'conditions' => ['CustomPages.all_cases_id' => $case_id, 'CustomPages.slug' => 'history'],
            'order' => ['CustomPages.id' => 'DESC']
        ]);
        $customPage = $query->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $customPage = $this->CustomPages->patchEntity($customPage, $this->request->data);
            if ($this->CustomPages->save($customPage)) {
                $this->Flash->success(__('The page has been saved.'));
                //return $this->redirect(['action' => 'index', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The page could not be saved. Please try again.'));
            }
        }

        $videos = $this->CustomPages->Videos->getVideoList($case_id);
        $this->set(compact('customPage', 'videos', 'case_id'));
        $this->set('_serialize', ['customPage']);
    }

    public function differentialDiagnosis($case_id) {
        $query = $this->CustomPages->find('all', [
            'conditions' => ['CustomPages.all_cases_id' => $case_id, 'CustomPages.slug' => 'differential_diagnosis'],
            'order' => ['CustomPages.id' => 'DESC']
        ]);
        $customPage = $query->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $customPage = $this->CustomPages->patchEntity($customPage, $this->request->data);
            if ($this->CustomPages->save($customPage)) {
                $this->Flash->success(__('The page has been saved.'));
                //return $this->redirect(['action' => 'index', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The page could not be saved. Please try again.'));
            }
        }

        $videos = $this->CustomPages->Videos->getVideoList($case_id);
        $this->set(compact('customPage', 'videos', 'case_id'));
        $this->set('_serialize', ['customPage']);
    }

     public function labs($case_id) {
        $query = $this->CustomPages->find('all', [
            'conditions' => ['CustomPages.all_cases_id' => $case_id, 'CustomPages.slug' => 'labs'],
            'order' => ['CustomPages.id' => 'DESC']
        ]);
        $customPage = $query->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $customPage = $this->CustomPages->patchEntity($customPage, $this->request->data);
            if ($this->CustomPages->save($customPage)) {
                $this->Flash->success(__('The page has been saved.'));
                //return $this->redirect(['action' => 'index', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The page could not be saved. Please try again.'));
            }
        }

        $videos = $this->CustomPages->Videos->getVideoList($case_id);
        $this->set(compact('customPage', 'videos', 'case_id'));
        $this->set('_serialize', ['customPage']);
    }

    public function diagnosis($case_id) {
        $query = $this->CustomPages->find('all', [
            'conditions' => ['CustomPages.all_cases_id' => $case_id, 'CustomPages.slug' => 'diagnosis'],
            'order' => ['CustomPages.id' => 'DESC']
        ]);
        $customPage = $query->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $customPage = $this->CustomPages->patchEntity($customPage, $this->request->data);
            if ($this->CustomPages->save($customPage)) {
                $this->Flash->success(__('The page has been saved.'));
                //return $this->redirect(['action' => 'index', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The page could not be saved. Please try again.'));
            }
        }

        $videos = $this->CustomPages->Videos->getVideoList($case_id);
        $this->set(compact('customPage', 'videos', 'case_id'));
        $this->set('_serialize', ['customPage']);
    }

    public function managementCounseling($case_id) {
        $query = $this->CustomPages->find('all', [
            'conditions' => ['CustomPages.all_cases_id' => $case_id, 'CustomPages.slug' => 'management_counseling'],
            'order' => ['CustomPages.id' => 'DESC']
        ]);
        $customPage = $query->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $customPage = $this->CustomPages->patchEntity($customPage, $this->request->data);
            if ($this->CustomPages->save($customPage)) {
                $this->Flash->success(__('The page has been saved.'));
                //return $this->redirect(['action' => 'index', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The page could not be saved. Please try again.'));
            }
        }

        $videos = $this->CustomPages->Videos->getVideoList($case_id);
        $this->set(compact('customPage', 'videos', 'case_id'));
        $this->set('_serialize', ['customPage']);
    }

    public function managementReferral($case_id) {
        $query = $this->CustomPages->find('all', [
            'conditions' => ['CustomPages.all_cases_id' => $case_id, 'CustomPages.slug' => 'management_referral'],
            'order' => ['CustomPages.id' => 'DESC']
        ]);
        $customPage = $query->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $customPage = $this->CustomPages->patchEntity($customPage, $this->request->data);
            if ($this->CustomPages->save($customPage)) {
                $this->Flash->success(__('The page has been saved.'));
                //return $this->redirect(['action' => 'index', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The page could not be saved. Please try again.'));
            }
        }

        $videos = $this->CustomPages->Videos->getVideoList($case_id);
        $this->set(compact('customPage', 'videos', 'case_id'));
        $this->set('_serialize', ['customPage']);
    }

    public function managementMedication($case_id) {
        $query = $this->CustomPages->find('all', [
            'conditions' => ['CustomPages.all_cases_id' => $case_id, 'CustomPages.slug' => 'management_medication'],
            'order' => ['CustomPages.id' => 'DESC']
        ]);
        $customPage = $query->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $customPage = $this->CustomPages->patchEntity($customPage, $this->request->data);
            if ($this->CustomPages->save($customPage)) {
                $this->Flash->success(__('The page has been saved.'));
                //return $this->redirect(['action' => 'index', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The page could not be saved. Please try again.'));
            }
        }

        $videos = $this->CustomPages->Videos->getVideoList($case_id);
        $this->set(compact('customPage', 'videos', 'case_id'));
        $this->set('_serialize', ['customPage']);
    }

    public function billing($case_id) {
        $query = $this->CustomPages->find('all', [
            'conditions' => ['CustomPages.all_cases_id' => $case_id, 'CustomPages.slug' => 'billing'],
            'order' => ['CustomPages.id' => 'DESC']
        ]);
        $customPage = $query->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $customPage = $this->CustomPages->patchEntity($customPage, $this->request->data);
            if ($this->CustomPages->save($customPage)) {
                $this->Flash->success(__('The page has been saved.'));
                //return $this->redirect(['action' => 'index', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The page could not be saved. Please try again.'));
            }
        }

        $videos = $this->CustomPages->Videos->getVideoList($case_id);
        $this->set(compact('customPage', 'videos', 'case_id'));
        $this->set('_serialize', ['customPage']);
    }

    public function feedbackStudy($case_id) {
        $query = $this->CustomPages->find('all', [
            'conditions' => ['CustomPages.all_cases_id' => $case_id, 'CustomPages.slug' => 'feedback_study'],
            'order' => ['CustomPages.id' => 'DESC']
        ]);
        $customPage = $query->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $customPage = $this->CustomPages->patchEntity($customPage, $this->request->data);
            if ($this->CustomPages->save($customPage)) {
                $this->Flash->success(__('The page has been saved.'));
                //return $this->redirect(['action' => 'index', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The page could not be saved. Please try again.'));
            }
        }

        $videos = $this->CustomPages->Videos->getVideoList($case_id);
        $this->set(compact('customPage', 'videos', 'case_id'));
        $this->set('_serialize', ['customPage']);
    }

    public function feedbackCounseling($case_id) {
        $query = $this->CustomPages->find('all', [
            'conditions' => ['CustomPages.all_cases_id' => $case_id, 'CustomPages.slug' => 'feedback_counseling'],
            'order' => ['CustomPages.id' => 'DESC']
        ]);
        $customPage = $query->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $customPage = $this->CustomPages->patchEntity($customPage, $this->request->data);
            if ($this->CustomPages->save($customPage)) {
                $this->Flash->success(__('The page has been saved.'));
                //return $this->redirect(['action' => 'index', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The page could not be saved. Please try again.'));
            }
        }

        $videos = $this->CustomPages->Videos->getVideoList($case_id);
        $this->set(compact('customPage', 'videos', 'case_id'));
        $this->set('_serialize', ['customPage']);
    }

    public function feedbackMedication($case_id) {
        $query = $this->CustomPages->find('all', [
            'conditions' => ['CustomPages.all_cases_id' => $case_id, 'CustomPages.slug' => 'feedback_medication'],
            'order' => ['CustomPages.id' => 'DESC']
        ]);
        $customPage = $query->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $customPage = $this->CustomPages->patchEntity($customPage, $this->request->data);
            if ($this->CustomPages->save($customPage)) {
                $this->Flash->success(__('The page has been saved.'));
                //return $this->redirect(['action' => 'index', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The page could not be saved. Please try again.'));
            }
        }

        $videos = $this->CustomPages->Videos->getVideoList($case_id);
        $this->set(compact('customPage', 'videos', 'case_id'));
        $this->set('_serialize', ['customPage']);
    }

    public function feedbackReferral($case_id) {
        $query = $this->CustomPages->find('all', [
            'conditions' => ['CustomPages.all_cases_id' => $case_id, 'CustomPages.slug' => 'feedback_referral'],
            'order' => ['CustomPages.id' => 'DESC']
        ]);
        $customPage = $query->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $customPage = $this->CustomPages->patchEntity($customPage, $this->request->data);
            if ($this->CustomPages->save($customPage)) {
                $this->Flash->success(__('The page has been saved.'));
                //return $this->redirect(['action' => 'index', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The page could not be saved. Please try again.'));
            }
        }

        $videos = $this->CustomPages->Videos->getVideoList($case_id);
        $this->set(compact('customPage', 'videos', 'case_id'));
        $this->set('_serialize', ['customPage']);
    }

    public function feedbackBilling($case_id) {
        $query = $this->CustomPages->find('all', [
            'conditions' => ['CustomPages.all_cases_id' => $case_id, 'CustomPages.slug' => 'feedback_billing'],
            'order' => ['CustomPages.id' => 'DESC']
        ]);
        $customPage = $query->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $customPage = $this->CustomPages->patchEntity($customPage, $this->request->data);
            if ($this->CustomPages->save($customPage)) {
                $this->Flash->success(__('The page has been saved.'));
                //return $this->redirect(['action' => 'index', $this->request->data('all_cases_id')]);
            } else {
                $this->Flash->error(__('The page could not be saved. Please try again.'));
            }
        }

        $videos = $this->CustomPages->Videos->getVideoList($case_id);
        $this->set(compact('customPage', 'videos', 'case_id'));
        $this->set('_serialize', ['customPage']);
    }

   /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
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
