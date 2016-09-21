<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Billing Entity.
 *
 * @property int $id
 * @property int $all_cases_id
 * @property \App\Model\Entity\AllCase $all_case
 * @property string $billing_id
 * @property string $billing_text
 * @property string $billing_group
 * @property int $billing_order
 * @property string $media_type
 * @property string $media
 * @property string $media_not_ordered
 * @property string $media_lg
 * @property int $billing_yield
 * @property int $billing_yield_not_ordered
 * @property string $if_ordered
 * @property string $not_ordered
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \App\Model\Entity\Billing[] $billings
 */
class Billing extends Entity
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
