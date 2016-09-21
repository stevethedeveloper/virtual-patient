<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ManagementMedication Entity.
 *
 * @property int $id
 * @property int $all_cases_id
 * @property \App\Model\Entity\AllCase $all_case
 * @property string $medication_id
 * @property \App\Model\Entity\Medication $medication
 * @property int $medication_order
 * @property string $medication_group
 * @property string $feedback_only
 * @property string $medication_text
 * @property int $study_yield
 * @property int $study_yield_not_ordered
 * @property string $if_ordered
 * @property string $not_ordered
 * @property string $media_type
 * @property string $vid_ordered
 * @property string $vid_not_ordered
 * @property string $pict_ordered
 * @property string $pict_ordered_lg
 * @property string $pict_not_ordered
 * @property string $pict_not_ordered_lg
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class ManagementMedication extends Entity
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
