<?php
namespace App\Model\Table;

use App\Model\Entity\Video;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Videos Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ContentPages
 */
class VideosTable extends Table
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

        $this->table('videos');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ContentPages', [
            'foreignKey' => 'content_page_id',
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

        /*
        $validator
            ->requirePresence('video_url', 'create')
            ->notEmpty('video_url');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->integer('display_order')
            ->requirePresence('display_order', 'create')
            ->notEmpty('display_order');
        */

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
        $rules->add($rules->existsIn(['content_page_id'], 'ContentPages'));
        return $rules;
    }

    public function getDisplayOrder($content_page_id) {
        $query = $this->find();
        $query->select(['max_display_order' => $query->func()->max('display_order')]);
        return $query->all()->toArray()[0]->max_display_order + 1;
    }
}
