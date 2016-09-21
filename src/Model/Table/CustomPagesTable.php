<?php
namespace App\Model\Table;

use App\Model\Entity\CustomPage;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CustomPages Model
 *
 * @property \Cake\ORM\Association\BelongsTo $AllCases
 */
class CustomPagesTable extends Table
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

        $this->table('custom_pages');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('AllCases', [
            'foreignKey' => 'all_cases_id',
            'joinType' => 'INNER'
        ]);

        $this->hasOne('GeneralSettings', [
            'foreignKey' => 'all_cases_id',
        ]);

        $this->hasOne('Videos', [
            'foreignKey' => 'video_id'
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
        return $rules;
    }

    public function get_page($case_id, $page_slug) {
        $this->page_slug = $page_slug;
        
        $data = $this->AllCases->find()
            ->where(['AllCases.id' => $case_id])
            ->contain('GeneralSettings')
            ->matching('GeneralSettings')
            ->matching('CustomPages')
            ->contain([
                'CustomPages' => function ($q) {
                    return $q->autoFields(true)
                         ->where(['CustomPages.slug' => $this->page_slug]);
                }
            ])
            ->first();

        return $data;
    }

}
