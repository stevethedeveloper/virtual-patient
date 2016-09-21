<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Page Entity.
 *
 * @property int $id
 * @property int $case_id
 * @property \App\Model\Entity\AllCase $all_case
 * @property string $pages_title
 * @property string $pages_desc
 * @property string $pages_text
 * @property int $pages_order
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Page extends Entity
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
