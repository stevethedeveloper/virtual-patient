<?php
namespace App\Model\Table;

use App\Model\Entity\HistoryQuestionsGroup;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HistoryQuestionsGroups Model
 *
 */
class HistoryQuestionsGroupsTable extends Table
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

        $this->table('history_questions_groups');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('HistoryQuestions', [
            'foreignKey' => 'history_questions_groups_id',
            'dependent' => true,
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
        return $rules;
    }

    public function getGroups($case_id) {
        
        $data = $this->find()
            ->contain([
                'HistoryQuestions' => function ($q) {
                   return $q
                        ->order(['HistoryQuestions.question_order' => 'ASC']);
                }
            ])
            ->autoFields(true)
            ->where(['HistoryQuestionsGroups.all_cases_id' => $case_id])
            ->orWhere(['HistoryQuestionsGroups.id' => 0])
            ->order(['HistoryQuestionsGroups.group_order' => 'ASC'])
            ->all()
            ->toArray();
        
        return $data;
    }
}
