<?php
namespace App\Model\Table;

use App\Model\Entity\OrderLabsGroup;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrderLabsGroups Model
 *
 */
class OrderLabsGroupsTable extends Table
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

        $this->table('order_labs_groups');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('OrderLabs', [
            'foreignKey' => 'order_labs_groups_id',
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
                'OrderLabs' => function ($q) {
                   return $q
                        ->order(['OrderLabs.lab_order' => 'ASC']);
                }
            ])
            ->autoFields(true)
            ->where(['OrderLabsGroups.all_cases_id' => $case_id])
            ->orWhere(['OrderLabsGroups.id' => 0])
            ->order(['OrderLabsGroups.group_order' => 'ASC'])
            ->all()
            ->toArray();

        return $data;
    }
}
