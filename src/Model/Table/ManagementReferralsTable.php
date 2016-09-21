<?php
namespace App\Model\Table;

use App\Model\Entity\ManagementReferral;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ManagementReferrals Model
 *
 * @property \Cake\ORM\Association\BelongsTo $AllCases
 * @property \Cake\ORM\Association\BelongsTo $Referrals
 */
class ManagementReferralsTable extends Table
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

        $this->table('management_referrals');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('AllCases', [
            'foreignKey' => 'all_cases_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Referrals', [
            'foreignKey' => 'referral_id',
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
        $rules->add($rules->existsIn(['referral_id'], 'Referrals'));
        return $rules;
    }

    public function get_questions($case_id) {
        $data = $this->find()
            ->autoFields(true)
            ->where(['ManagementReferrals.all_cases_id' => $case_id])
            ->order(['ManagementReferrals.referral_order' => 'ASC'])
            ->all()
            ->toArray();

        return $data;
    }

    public function get_associations($case_id, $remove_blank = true) {
        $data = $this->find()
            ->select('referral_group')
            ->where(['ManagementReferrals.all_cases_id' => $case_id])
            ->andWhere(['ManagementReferrals.referral_group != ' => '-1'])
            ->andWhere(['ManagementReferrals.referral_group != ' => 'x'])
            ->order(['ManagementReferrals.referral_group' => 'ASC'])
            ->distinct()
            ->all()
            ->toArray();

        if ($remove_blank == true) {
            $return = array();
        } else {
            $return = array('-1' => '', 'new' => '--New Association--');
        }
        foreach ($data as $group) {
            $return[$group->referral_group] = $group->referral_group;
        }

        return $return;
    }
}
