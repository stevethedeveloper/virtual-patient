<?php
namespace App\Model\Table;

use App\Model\Entity\ContentBlock;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ContentBlocks Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Pages
 * @property \Cake\ORM\Association\BelongsTo $ContentBlockTypes
 */
class ContentBlocksTable extends Table
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

        $this->table('content_blocks');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Pages', [
            'foreignKey' => 'page_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ContentBlockTypes', [
            'foreignKey' => 'content_block_type_id',
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('content', 'create')
            ->notEmpty('content');

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
        $rules->add($rules->existsIn(['page_id'], 'Pages'));
        $rules->add($rules->existsIn(['content_block_type_id'], 'ContentBlockTypes'));
        return $rules;
    }
}
