<?php
namespace App\Model\Table;

use App\Model\Entity\Menu;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Menus Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ParentMenus
 * @property \Cake\ORM\Association\HasMany $ChildMenus
 */
class MenusTable extends Table
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

        $this->table('menus');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ParentMenus', [
            'className' => 'Menus',
            'foreignKey' => 'parent_id'
        ]);
        $this->belongsTo('ContentPages', [
            'className' => 'ContentPages',
            'foreignKey' => 'content_page_id',
            'sort' => ['display_order' => 'ASC']
        ]);
        $this->hasMany('ChildMenus', [
            'className' => 'Menus',
            'foreignKey' => 'parent_id',
            'sort' => ['display_order' => 'ASC']
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
            ->integer('display_order')
            ->requirePresence('display_order', 'create')
            ->notEmpty('display_order');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        /*
        $validator
            ->requirePresence('url', 'create')
            ->notEmpty('url');

        $validator
            ->requirePresence('controller', 'create')
            ->notEmpty('controller');

        $validator
            ->requirePresence('action', 'create')
            ->notEmpty('action');

        $validator
            ->requirePresence('prefix', 'create')
            ->notEmpty('prefix');
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
        $rules->add($rules->existsIn(['parent_id'], 'ParentMenus'));
        return $rules;
    }

    public function getDisplayOrder($parent_id) {
        $query = $this->find();
        $query->select(['max_display_order' => $query->func()->max('display_order')]);
        return $query->all()->toArray()[0]->max_display_order + 1;
    }
}
