<?php
namespace App\Model\Table;

use App\Model\Entity\Diagnostic;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Diagnostics Model
 *
 * @property \Cake\ORM\Association\BelongsTo $AllCases
 * @property \Cake\ORM\Association\BelongsTo $Dds
 * @property \Cake\ORM\Association\BelongsTo $Diags
 */
class DiagnosticsTable extends Table
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

        $this->table('diagnostics');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

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
        $rules->add($rules->existsIn(['all_cases_id'], 'AllCases'));
        $rules->add($rules->existsIn(['dd_id'], 'Dds'));
        $rules->add($rules->existsIn(['diag_id'], 'Diags'));
        return $rules;
    }

    public function get_differential_options($case_id) {

        $data = $this->find()
            ->autoFields(true)
            ->where(['Diagnostics.all_cases_id' => $case_id])
            ->order(['Diagnostics.dd_order' => 'ASC'])
            ->all()
            ->toArray();

        return $data;

    }

    public function get_diagnosis_options($case_id) {

        $data = $this->find()
            ->autoFields(true)
            ->where(['Diagnostics.all_cases_id' => $case_id])
            ->order(['Diagnostics.diag_order' => 'ASC'])
            ->all()
            ->toArray();

        return $data;

    }

}
