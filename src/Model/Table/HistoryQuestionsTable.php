<?php
namespace App\Model\Table;

use App\Model\Entity\HistoryQuestion;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HistoryQuestions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $AllCases
 * @property \Cake\ORM\Association\BelongsTo $Videos
 */
class HistoryQuestionsTable extends Table
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

        $this->table('history_questions');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('AllCases', [
            'foreignKey' => 'all_cases_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('HistoryQuestionsGroups', [
            'foreignKey' => 'history_questions_groups_id',
            'joinType' => 'INNER'
        ]);

        $this->hasOne('Videos', [
            'foreignKey' => 'video_id'
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
        $rules->add($rules->existsIn(['all_cases_id'], 'AllCases'));
        $rules->add($rules->existsIn(['video_id'], 'Videos'));
        return $rules;
    }

    public function get_questions($case_id) {

        $data = $this->find()
            ->autoFields(true)
            ->where(['HistoryQuestions.all_cases_id' => $case_id])
            ->select(['Videos.id', 'Videos.video_file_name'])
            ->select(['HistoryQuestionsGroups.id', 'HistoryQuestionsGroups.name'])
            ->leftJoin(
                ['Videos' => 'videos'],
                ['Videos.id = HistoryQuestions.video_id'])
            ->leftJoin(
                ['HistoryQuestionsGroups' => 'history_questions_groups'],
                ['HistoryQuestionsGroups.id = HistoryQuestions.history_questions_groups_id'])
            ->order(['HistoryQuestionsGroups.group_order' => 'ASC', 'HistoryQuestions.question_order' => 'ASC'])
            ->all()
            ->toArray();

        return $data;
    }
}
