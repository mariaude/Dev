<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Convocation Entity
 *
 * @property int $internship_id
 * @property int $student_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Student $student
 * @property \App\Model\Entity\Enterprise $enterprise
 */
class Convocation extends Entity
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
        'created' => true,
        'modified' => true,
        'student' => true,
        'internship' => true,
        'internship_id' => true,
        'student_id' => true
    ];
}
