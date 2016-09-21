<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Diagnostic Entity.
 *
 * @property int $id
 * @property int $all_cases_id
 * @property string $dd_id
 * @property \App\Model\Entity\Dd $dd
 * @property string $diag_id
 * @property \App\Model\Entity\Diag $diag
 * @property int $dd_order
 * @property int $diag_order
 * @property string $diagnosis_name
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \App\Model\Entity\AllCase $all_case
 */
class Diagnostic extends Entity
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
