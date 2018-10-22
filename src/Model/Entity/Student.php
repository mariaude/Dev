<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Student Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $admission_number
 * @property string $first_name
 * @property string $last_name
 * @property string $phone_number
 * @property string $informations
 * @property string $notes
 * @property bool $active
 *
 * @property \App\Model\Entity\User $user
 */
class Student extends Entity
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
        'admission_number' => true,
        'first_name' => true,
        'last_name' => true,
        'phone_number' => true,
        'informations' => true,
        'notes' => true,
        'active' => true,
        'user' => true,
        'candidacies' => true
    ];

    protected $_virtual = [
        'full_name'
    ];

    protected function _getFullName()
    {
        if(!$this->isNew()){
            return $this->_properties['first_name'] . ' ' .$this->_properties['last_name'];
        }
        return null;
    }


}
