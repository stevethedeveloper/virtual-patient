<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * HistoryQuestion Entity.
 *
 * @property int $id
 * @property int $all_cases_id
 * @property string $question_id
 * @property \App\Model\Entity\Question $question
 * @property int $video_id
 * @property \App\Model\Entity\Video $video
 * @property int $question_order
 * @property string $question_category
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \App\Model\Entity\AllCase $all_case
 */
class HistoryQuestion extends Entity
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
