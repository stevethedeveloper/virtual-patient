<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Video Entity.
 *
 * @property int $id
 * @property int $all_cases_id
 * @property string $video_file_name
 * @property string $video_nice_name
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \App\Model\Entity\AllCase $all_case
 * @property \App\Model\Entity\HistoryQuestion[] $history_questions
 */
class Video extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
