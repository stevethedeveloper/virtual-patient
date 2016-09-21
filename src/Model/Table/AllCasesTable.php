<?php
namespace App\Model\Table;

use App\Model\Entity\AllCase;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AllCases Model
 *
 */
class AllCasesTable extends Table
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

        $this->table('all_cases');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasOne('GeneralSettings', [
            'foreignKey' => 'all_cases_id',
            'dependent' => true,
        ]);

        $this->hasMany('CustomPages', [
            'foreignKey' => 'all_cases_id',
            'dependent' => true,
        ]);

        $this->hasMany('HistoryQuestions', [
            'foreignKey' => 'all_cases_id',
            'dependent' => true,
        ]);

        $this->addBehavior('Timestamp');

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
            ->allowEmpty('id', 'create')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        return $validator;
    }
}
