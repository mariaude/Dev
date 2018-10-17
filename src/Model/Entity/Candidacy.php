<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Candidacy Entity
 *
 * @property int $internship_id
 * @property int $student_id
 *
 * @property \App\Model\Entity\Internship $internship
 * @property \App\Model\Entity\Student $student
 */
class Candidacy extends Entity
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
        'internship' => true,
        'student' => true
    ];
}
