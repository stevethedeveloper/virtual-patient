<?php
namespace App\Model\Table;

use App\Model\Entity\UserAnswer;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * UserAnswers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $AllCases
 */
class UserAnswersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('user_answers');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('AllCases', [
            'foreignKey' => 'all_cases_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['all_cases_id'], 'AllCases'));
        return $rules;
    }

    public function getFeedbackArray($case_id, $user_id, $section) {

        //get user answers
        $questions_ordered = $this->find()
            ->select('UserAnswers.answer_id')
            ->where(['UserAnswers.user_id' => $user_id, 'UserAnswers.all_cases_id' => $case_id, 'UserAnswers.section' => $section])
            ->toArray();
        
        $already_ordered = array();
        foreach ($questions_ordered as $val) {
               $already_ordered[] = $val->answer_id;
        }

        //key is yield section
        $feedback_array = array('ordered' => null, 'not_ordered' => null);
        foreach ($feedback_array as $key => $val) {
            $feedback_array[$key] = array('0' => null, '4' => null, '3' => null, '2' => null, '1' => null);
        }

        //get all questions
        switch ($section) {
            case 'labs':
                $this->OrderLabs = TableRegistry::get('OrderLabs'); 
                $all_questions = $this->OrderLabs->find()
                    ->autoFields(true)
                    ->where(['OrderLabs.all_cases_id' => $case_id])
                    ->order(['OrderLabs.lab_order' => 'ASC'])
                    ->all()
                    ->toArray();

                    foreach ($all_questions as $q) {
                        if (in_array($q->id, $already_ordered)) {
                            $feedback_array['ordered'][$q->study_yield][$q->id]['study'] = $q->lab;
                            $feedback_array['ordered'][$q->study_yield][$q->id]['status'] = 'Ordered';
                            $feedback_array['ordered'][$q->study_yield][$q->id]['result'] = $q->result;
                            $feedback_array['ordered'][$q->study_yield][$q->id]['study_yield'] = $q->study_yield    ;
                            $feedback_array['ordered'][$q->study_yield][$q->id]['rationale'] = $q->if_ordered;
                            $feedback_array['ordered'][$q->study_yield][$q->id]['video'] = $q->vid_ordered;
                            $feedback_array['ordered'][$q->study_yield][$q->id]['photo'] = $q->pict_ordered;
                            $feedback_array['ordered'][$q->study_yield][$q->id]['photo_lg'] = $q->pict_ordered_lg;
                        } else {
                            $feedback_array['not_ordered'][$q->study_yield_not_ordered][$q->id]['study'] = $q->lab;
                            $feedback_array['not_ordered'][$q->study_yield_not_ordered][$q->id]['status'] = 'Not Ordered';
                            $feedback_array['not_ordered'][$q->study_yield_not_ordered][$q->id]['result'] = $q->result;
                            $feedback_array['not_ordered'][$q->study_yield_not_ordered][$q->id]['study_yield_not_ordered'] = $q->study_yield_not_ordered;
                            $feedback_array['not_ordered'][$q->study_yield_not_ordered][$q->id]['rationale'] = $q->not_ordered;
                            $feedback_array['not_ordered'][$q->study_yield_not_ordered][$q->id]['video'] = $q->vid_not_ordered;
                            $feedback_array['not_ordered'][$q->study_yield_not_ordered][$q->id]['photo'] = $q->pict_not_ordered;
                            $feedback_array['not_ordered'][$q->study_yield_not_ordered][$q->id]['photo_lg'] = $q->pict_not_ordered_lg;
                        }
                    }
                break;
            case 'management_counseling':
                $this->ManagementCounselings = TableRegistry::get('ManagementCounselings'); 
                $all_questions = $this->ManagementCounselings->find()
                    ->autoFields(true)
                    ->where(['ManagementCounselings.all_cases_id' => $case_id])
                    ->order(['ManagementCounselings.counseling_order' => 'ASC'])
                    ->all()
                    ->toArray();

                    foreach ($all_questions as $q) {
                        if (in_array($q->id, $already_ordered)) {
                            $feedback_array['ordered'][$q->study_yield][$q->id]['study'] = $q->counseling_text;
                            $feedback_array['ordered'][$q->study_yield][$q->id]['status'] = 'Ordered';
                            $feedback_array['ordered'][$q->study_yield][$q->id]['rationale'] = $q->if_ordered;
                            $feedback_array['ordered'][$q->study_yield][$q->id]['video'] = $q->vid_ordered;
                            $feedback_array['ordered'][$q->study_yield][$q->id]['photo'] = $q->pict_ordered;
                            $feedback_array['ordered'][$q->study_yield][$q->id]['photo_lg'] = $q->pict_ordered_lg;
                        } else {
                            $feedback_array['not_ordered'][$q->study_yield_not_ordered][$q->id]['study'] = $q->counseling_text;
                            $feedback_array['not_ordered'][$q->study_yield_not_ordered][$q->id]['status'] = 'Not Ordered';
                            $feedback_array['not_ordered'][$q->study_yield_not_ordered][$q->id]['rationale'] = $q->not_ordered;
                            $feedback_array['not_ordered'][$q->study_yield_not_ordered][$q->id]['video'] = $q->vid_not_ordered;
                            $feedback_array['not_ordered'][$q->study_yield_not_ordered][$q->id]['photo'] = $q->pict_not_ordered;
                            $feedback_array['not_ordered'][$q->study_yield_not_ordered][$q->id]['photo_lg'] = $q->pict_not_ordered_lg;
                        }
                    }
                break;
            case 'management_medication':
                $this->ManagementMedications = TableRegistry::get('ManagementMedications'); 
                $all_questions = $this->ManagementMedications->find()
                    ->autoFields(true)
                    ->where(['ManagementMedications.all_cases_id' => $case_id])
                    ->order(['ManagementMedications.medication_order' => 'ASC'])
                    ->all()
                    ->toArray();

                    foreach ($all_questions as $q) {
                        if (in_array($q->id, $already_ordered)) {
                            $feedback_array['ordered'][$q->study_yield][$q->id]['study'] = $q->medication_text;
                            $feedback_array['ordered'][$q->study_yield][$q->id]['status'] = 'Ordered';
                            $feedback_array['ordered'][$q->study_yield][$q->id]['rationale'] = $q->if_ordered;
                            $feedback_array['ordered'][$q->study_yield][$q->id]['video'] = $q->vid_ordered;
                            $feedback_array['ordered'][$q->study_yield][$q->id]['photo'] = $q->pict_ordered;
                            $feedback_array['ordered'][$q->study_yield][$q->id]['photo_lg'] = $q->pict_ordered_lg;
                        } else {
                            $feedback_array['not_ordered'][$q->study_yield_not_ordered][$q->id]['study'] = $q->medication_text;
                            $feedback_array['not_ordered'][$q->study_yield_not_ordered][$q->id]['status'] = 'Not Ordered';
                            $feedback_array['not_ordered'][$q->study_yield_not_ordered][$q->id]['rationale'] = $q->not_ordered;
                            $feedback_array['not_ordered'][$q->study_yield_not_ordered][$q->id]['video'] = $q->vid_not_ordered;
                            $feedback_array['not_ordered'][$q->study_yield_not_ordered][$q->id]['photo'] = $q->pict_not_ordered;
                            $feedback_array['not_ordered'][$q->study_yield_not_ordered][$q->id]['photo_lg'] = $q->pict_not_ordered_lg;
                        }
                    }
                break;
            case 'management_referral':
                $this->ManagementReferrals = TableRegistry::get('ManagementReferrals'); 
                $all_questions = $this->ManagementReferrals->find()
                    ->autoFields(true)
                    ->where(['ManagementReferrals.all_cases_id' => $case_id])
                    ->order(['ManagementReferrals.referral_order' => 'ASC'])
                    ->all()
                    ->toArray();

                    foreach ($all_questions as $q) {
                        if (in_array($q->id, $already_ordered)) {
                            $feedback_array['ordered'][$q->study_yield][$q->id]['study'] = $q->referral_text;
                            $feedback_array['ordered'][$q->study_yield][$q->id]['status'] = 'Ordered';
                            $feedback_array['ordered'][$q->study_yield][$q->id]['rationale'] = $q->if_ordered;
                            $feedback_array['ordered'][$q->study_yield][$q->id]['video'] = $q->vid_ordered;
                            $feedback_array['ordered'][$q->study_yield][$q->id]['photo'] = $q->pict_ordered;
                            $feedback_array['ordered'][$q->study_yield][$q->id]['photo_lg'] = $q->pict_ordered_lg;
                        } else {
                            $feedback_array['not_ordered'][$q->study_yield_not_ordered][$q->id]['study'] = $q->referral_text;
                            $feedback_array['not_ordered'][$q->study_yield_not_ordered][$q->id]['status'] = 'Not Ordered';
                            $feedback_array['not_ordered'][$q->study_yield_not_ordered][$q->id]['rationale'] = $q->not_ordered;
                            $feedback_array['not_ordered'][$q->study_yield_not_ordered][$q->id]['video'] = $q->vid_not_ordered;
                            $feedback_array['not_ordered'][$q->study_yield_not_ordered][$q->id]['photo'] = $q->pict_not_ordered;
                            $feedback_array['not_ordered'][$q->study_yield_not_ordered][$q->id]['photo_lg'] = $q->pict_not_ordered_lg;
                        }
                    }
                break;
            case 'billing':
                $this->Billings = TableRegistry::get('Billings'); 
                $all_questions = $this->Billings->find()
                    ->autoFields(true)
                    ->where(['Billings.all_cases_id' => $case_id])
                    ->order(['Billings.billing_order' => 'ASC'])
                    ->all()
                    ->toArray();

                    foreach ($all_questions as $q) {
                        if (in_array($q->id, $already_ordered)) {
                            $feedback_array['ordered'][$q->billing_yield][$q->id]['study'] = $q->billing_text;
                            $feedback_array['ordered'][$q->billing_yield][$q->id]['status'] = 'Billed';
                            $feedback_array['ordered'][$q->billing_yield][$q->id]['rationale'] = $q->if_ordered;
                            $feedback_array['ordered'][$q->billing_yield][$q->id]['video'] = $q->vid_ordered;
                            $feedback_array['ordered'][$q->billing_yield][$q->id]['photo'] = $q->pict_ordered;
                            $feedback_array['ordered'][$q->billing_yield][$q->id]['photo_lg'] = $q->pict_ordered_lg;
                        } else {
                            $feedback_array['not_ordered'][$q->billing_yield_not_ordered][$q->id]['study'] = $q->billing_text;
                            $feedback_array['not_ordered'][$q->billing_yield_not_ordered][$q->id]['status'] = 'Not Billed';
                            $feedback_array['not_ordered'][$q->billing_yield_not_ordered][$q->id]['rationale'] = $q->not_ordered;
                            $feedback_array['not_ordered'][$q->billing_yield_not_ordered][$q->id]['video'] = $q->vid_not_ordered;
                            $feedback_array['not_ordered'][$q->billing_yield_not_ordered][$q->id]['photo'] = $q->pict_not_ordered;
                            $feedback_array['not_ordered'][$q->billing_yield_not_ordered][$q->id]['photo_lg'] = $q->pict_not_ordered_lg;
                        }
                    }
                break;
        }

        return $feedback_array;

    }
}
