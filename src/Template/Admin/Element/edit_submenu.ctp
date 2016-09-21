<div class="col-md-12">
<br />
<div class="btn-group" role="group" aria-label="...">
  <div class="btn-group" role="group">
    <button type="button" class="btn btn-default dropdown-toggle<?=($this->request->controller == 'GeneralSettings' || $this->request->controller == 'Videos') ? ' active' : ''?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Settings
      <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
      <li<?=($this->request->controller == 'GeneralSettings') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'GeneralSettings', 'action' => 'edit', $case_id_nav])?>">General Settings</a></li>
      <li<?=($this->request->controller == 'Videos') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'Videos', 'action' => 'index', $case_id_nav])?>">Videos</a></li>
    </ul>
  </div>

  <div class="btn-group" role="group">
    <button type="button" class="btn btn-default dropdown-toggle<?=($this->request->controller == 'CustomPages') ? ' active' : ''?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Pages
      <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
      <li<?=($this->request->controller == 'CustomPages' && $this->request->action == 'intro') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'CustomPages', 'action' => 'intro', $case_id_nav])?>">Intro</a></li>
      <li<?=($this->request->controller == 'CustomPages' && $this->request->action == 'history') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'CustomPages', 'action' => 'history', $case_id_nav])?>">History</a></li>
      <li<?=($this->request->controller == 'CustomPages' && $this->request->action == 'physicalExam') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'CustomPages', 'action' => 'physical_exam', $case_id_nav])?>">Physical Exam</a></li>
      <li<?=($this->request->controller == 'CustomPages' && $this->request->action == 'differentialDiagnosis') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'CustomPages', 'action' => 'differential_diagnosis', $case_id_nav])?>">Differential Diagnosis</a></li>
      <li<?=($this->request->controller == 'CustomPages' && $this->request->action == 'moreInformation') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'CustomPages', 'action' => 'more_information', $case_id_nav])?>">More Info</a></li>
      <li<?=($this->request->controller == 'CustomPages' && $this->request->action == 'labs') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'CustomPages', 'action' => 'labs', $case_id_nav])?>">Labs</a></li>
      <li<?=($this->request->controller == 'CustomPages' && $this->request->action == 'diagnosis') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'CustomPages', 'action' => 'diagnosis', $case_id_nav])?>">Diagnosis</a></li>
      <li<?=($this->request->controller == 'CustomPages' && $this->request->action == 'managementCounseling') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'CustomPages', 'action' => 'management_counseling', $case_id_nav])?>">Management Counseling</a></li>
      <li<?=($this->request->controller == 'CustomPages' && $this->request->action == 'managementMedication') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'CustomPages', 'action' => 'management_medication', $case_id_nav])?>">Management Medication</a></li>
      <li<?=($this->request->controller == 'CustomPages' && $this->request->action == 'managementReferral') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'CustomPages', 'action' => 'management_referral', $case_id_nav])?>">Management Referral</a></li>
      <li<?=($this->request->controller == 'CustomPages' && $this->request->action == 'billing') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'CustomPages', 'action' => 'billing', $case_id_nav])?>">Billing</a></li>
      <li<?=($this->request->controller == 'CustomPages' && $this->request->action == 'feedbackStudy') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'CustomPages', 'action' => 'feedback_study', $case_id_nav])?>">Feedback Study</a></li>
      <li<?=($this->request->controller == 'CustomPages' && $this->request->action == 'feedbackCounseling') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'CustomPages', 'action' => 'feedback_counseling', $case_id_nav])?>">Feedback Counseling</a></li>
      <li<?=($this->request->controller == 'CustomPages' && $this->request->action == 'feedbackMedication') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'CustomPages', 'action' => 'feedback_medication', $case_id_nav])?>">Feedback Medication</a></li>
      <li<?=($this->request->controller == 'CustomPages' && $this->request->action == 'feedbackReferral') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'CustomPages', 'action' => 'feedback_referral', $case_id_nav])?>">Feedback Referral</a></li>
      <li<?=($this->request->controller == 'CustomPages' && $this->request->action == 'feedbackBilling') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'CustomPages', 'action' => 'feedback_billing', $case_id_nav])?>">Feedback Billing</a></li>
      <li<?=($this->request->controller == 'CustomPages' && $this->request->action == 'summary') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'CustomPages', 'action' => 'summary', $case_id_nav])?>">Summary</a></li>
    </ul>
  </div>

  <div class="btn-group" role="group">
    <button type="button" class="btn btn-default dropdown-toggle<?=($this->request->controller == 'HistoryQuestions') ? ' active' : ''?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      History Questions
      <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
      <li<?=($this->request->controller == 'HistoryQuestions' && $this->request->action == 'groups') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'HistoryQuestions', 'action' => 'groups', $case_id_nav])?>">Add/Edit Groups</a></li>
      <li<?=($this->request->controller == 'HistoryQuestions' && $this->request->action == 'questions') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'HistoryQuestions', 'action' => 'questions', $case_id_nav])?>">Add/Edit Questions</a></li>
      <li<?=($this->request->controller == 'HistoryQuestions' && $this->request->action == 'index') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'HistoryQuestions', 'action' => 'index', $case_id_nav])?>">Sort Questions/Groups</a></li>
    </ul>
  </div>

  <div class="btn-group" role="group">
    <button type="button" class="btn btn-default dropdown-toggle<?=($this->request->controller == 'OrderLabs') ? ' active' : ''?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Labs
      <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
      <li<?=($this->request->controller == 'OrderLabs' && $this->request->action == 'groups') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'OrderLabs', 'action' => 'groups', $case_id_nav])?>">Add/Edit Groups</a></li>
      <li<?=($this->request->controller == 'OrderLabs' && $this->request->action == 'labs') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'OrderLabs', 'action' => 'labs', $case_id_nav])?>">Add/Edit Labs</a></li>
      <li<?=($this->request->controller == 'OrderLabs' && $this->request->action == 'index') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'OrderLabs', 'action' => 'index', $case_id_nav])?>">Sort Questions/Groups</a></li>
    </ul>
  </div>

  <button type="button" class="btn btn-default<?=($this->request->controller == 'Diagnostics') ? ' active' : ''?>"><a href="<?= $this->Url->build(['controller' => 'Diagnostics', 'action' => 'index', $case_id_nav])?>">Diagnostics</a></button>

  <div class="btn-group" role="group">
    <button type="button" class="btn btn-default dropdown-toggle<?=($this->request->controller == 'ManagementCounselings' || $this->request->controller == 'ManagementMedications' || $this->request->controller == 'ManagementReferrals') ? ' active' : ''?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Management
      <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
      <li<?=($this->request->controller == 'ManagementCounselings') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'ManagementCounselings', 'action' => 'index', $case_id_nav])?>">Counseling</a></li>
      <li<?=($this->request->controller == 'ManagementMedications') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'ManagementMedications', 'action' => 'index', $case_id_nav])?>">Medication</a></li>
      <li<?=($this->request->controller == 'ManagementReferrals') ? ' class="active"' : ''?>><a href="<?= $this->Url->build(['controller' => 'ManagementReferrals', 'action' => 'index', $case_id_nav])?>">Referral</a></li>
    </ul>
  </div>

  <button type="button" class="btn btn-default<?=($this->request->controller == 'Billings') ? ' active' : ''?>"><a href="<?= $this->Url->build(['controller' => 'Billings', 'action' => 'index', $case_id_nav])?>">Billing</a></button>
</div>