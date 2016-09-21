<?php
namespace App\Model\Table;

use App\Model\Entity\OrderLab;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrderLabs Model
 *
 * @property \Cake\ORM\Association\BelongsTo $AllCases
 * @property \Cake\ORM\Association\BelongsTo $Labs
 */
class OrderLabsTable extends Table
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

        $this->table('order_labs');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('AllCases', [
            'foreignKey' => 'all_cases_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('OrderLabsGroups', [
            'foreignKey' => 'order_labs_groups_id',
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
        $rules->add($rules->existsIn(['lab_id'], 'Labs'));
        return $rules;
    }

    public function get_labs($case_id) {

        $data = $this->find()
            ->autoFields(true)
            ->where(['OrderLabs.all_cases_id' => $case_id])
            ->select(['OrderLabsGroups.id', 'OrderLabsGroups.name'])
            ->leftJoin(
                ['OrderLabsGroups' => 'order_labs_groups'],
                ['OrderLabsGroups.id = OrderLabs.order_labs_groups_id'])
            ->order(['OrderLabsGroups.group_order' => 'ASC', 'OrderLabs.lab_order' => 'ASC'])
            ->all()
            ->toArray();

        return $data;
    }

    public function get_associations($case_id, $remove_blank = true) {
        $data = $this->find()
            ->select('lab_group')
            ->where(['OrderLabs.all_cases_id' => $case_id])
            ->andWhere(['OrderLabs.lab_group != ' => '-1'])
            ->order(['OrderLabs.lab_group' => 'ASC'])
            ->distinct()
            ->all()
            ->toArray();

        if ($remove_blank == true) {
            $return = array();
        } else {
            $return = array('-1' => '', 'new' => '--New Association--');
        }
        foreach ($data as $group) {
            $return[$group->lab_group] = $group->lab_group;
        }

        return $return;
    }
}
