<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Video Entity.
 *
 * @property int $id
 * @property int $content_page_id
 * @property \App\Model\Entity\ContentPage $content_page
 * @property string $video_url
 * @property string $title
 * @property string $description
 * @property int $display_order
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
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
