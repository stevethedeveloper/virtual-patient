<?php
namespace App\Model\Table;

use App\Model\Entity\Video;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * Videos Model
 *
 * @property \Cake\ORM\Association\BelongsTo $AllCases
 * @property \Cake\ORM\Association\HasMany $HistoryQuestions
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
        return $rules;
    }

    public function getVideosArray($data, $video_id) {
        $streamer_path = $data->general_setting->streamer_path;
        $ios_path = $data->general_setting->ios_path;
        $folder = $data->general_setting->folder;

        $videos = $this->find()
            ->where(['Videos.id' => $video_id])
            ->first();

        $video_file_name = $videos->video_file_name;

        $arr = array();
        $arr['rtmp'] = 'rtmp://'.$streamer_path.$folder.'/'.$video_file_name;
        $arr['http'] = 'http://'.$ios_path.$folder.'/'.$video_file_name;
        
        return $arr;

    }

    public function getPlaceholderVideosArray($case_id) {

        $this->CustomPages = TableRegistry::get('CustomPages');

        $data = $this->CustomPages->get_page($case_id, 'intro');

        $page = $data->custom_pages[0];

        $streamer_path = $data->general_setting->streamer_path;
        $ios_path = $data->general_setting->ios_path;
        $folder = $data->general_setting->folder;

        $videos = $this->find()
            ->where(['Videos.id' => $page->video_id])
            ->first();

        $video_file_name = $videos->video_file_name;

        $arr = array();
        $arr['rtmp'] = 'rtmp://'.$streamer_path.$folder.'/'.$video_file_name;
        $arr['http'] = 'http://'.$ios_path.$folder.'/'.$video_file_name;
        
        return $arr;

    }

    public function getVideoList($case_id) {
        $data = $this->find()
            ->select(['id', 'video_file_name', 'video_nice_name'])
            ->formatResults(function($results) {
                return $results->combine(
                    'id',
                    function($row) {
                        return $row['video_file_name'] . ' - ' . $row['video_nice_name'];
                    }
                );
            })
            ->where(['all_cases_id' => $case_id])
            ->all()
            ->toArray();

        $data = ['' => ''] + $data;

        return $data;
    }

}
