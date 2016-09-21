<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * GroupMedia Entity.
 *
 * @property int $id
 * @property int $all_cases_id
 * @property string $group_media_type
 * @property string $group_media_group
 * @property string $group_media_file
 * @property string $group_media_file_not_ordered
 * @property string $group_media_not_ordered_message
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \App\Model\Entity\AllCase $all_case
 */
class GroupMedia extends Entity
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
