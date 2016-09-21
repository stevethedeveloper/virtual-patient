<?php
namespace App\Model\Table;

use App\Model\Entity\ManagementMedication;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ManagementMedications Model
 *
 * @property \Cake\ORM\Association\BelongsTo $AllCases
 * @property \Cake\ORM\Association\BelongsTo $Medications
 */
class ManagementMedicationsTable extends Table
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

        $this->table('management_medications');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('AllCases', [
            'foreignKey' => 'all_cases_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Medications', [
            'foreignKey' => 'medication_id',
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
        $rules->add($rules->existsIn(['all_cases_id'], 'AllCases'));
        $rules->add($rules->existsIn(['medication_id'], 'Medications'));
        return $rules;
    }

    public function get_questions($case_id) {
        $data = $this->find()
            ->autoFields(true)
            ->where(['ManagementMedications.all_cases_id' => $case_id])
            ->order(['ManagementMedications.medication_order' => 'ASC'])
            ->all()
            ->toArray();

        return $data;
    }

    public function get_associations($case_id, $remove_blank = true) {
        $data = $this->find()
            ->select('medication_group')
            ->where(['ManagementMedications.all_cases_id' => $case_id])
            ->andWhere(['ManagementMedications.medication_group != ' => '-1'])
            ->andWhere(['ManagementMedications.medication_group != ' => 'x'])
            ->order(['ManagementMedications.medication_group' => 'ASC'])
            ->distinct()
            ->all()
            ->toArray();

        if ($remove_blank == true) {
            $return = array();
        } else {
            $return = array('-1' => '', 'new' => '--New Association--');
        }
        foreach ($data as $group) {
            $return[$group->medication_group] = $group->medication_group;
        }

        return $return;
    }
}
