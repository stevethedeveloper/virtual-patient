<?php
namespace App\Model\Table;

use App\Model\Entity\Page;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Pages Model
 *
 * @property \Cake\ORM\Association\BelongsTo $PageTypes
 * @property \Cake\ORM\Association\HasMany $ContentBlocks
 */
class PagesTable extends Table
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

        $this->table('pages');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('PageTypes', [
            'foreignKey' => 'page_type_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ContentBlocks', [
            'foreignKey' => 'page_id'
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('controller', 'create')
            ->notEmpty('controller');

        $validator
            ->requirePresence('action', 'create')
            ->notEmpty('action');

        $validator
            ->requirePresence('prefix', 'create')
            ->notEmpty('prefix');

        $validator
            ->requirePresence('configuration', 'create')
            ->notEmpty('configuration');

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
        $rules->add($rules->existsIn(['page_type_id'], 'PageTypes'));
        return $rules;
    }
}
