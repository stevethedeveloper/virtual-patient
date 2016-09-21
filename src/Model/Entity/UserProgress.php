<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserProgress Entity.
 *
 * @property int $id
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property int $all_cases_id
 * @property \App\Model\Entity\AllCase $all_case
 * @property string $section
 * @property int $current_section
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class UserProgress extends Entity
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
