<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Enterprise Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $adress
 * @property string $city
 * @property string $province
 * @property string $postal_code
 * @property string $region
 * @property bool $active
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Internship[] $internships
 */
class Enterprise extends Entity
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
        'user_id' => true,
        'name' => true,
        'adress' => true,
        'city' => true,
        'province' => true,
        'postal_code' => true,
        'region' => true,
        'additional_informations' => true,
        'active' => true,
        'user' => true,
        'internships' => true
    ];
}
