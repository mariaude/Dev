<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Internship Entity
 *
 * @property int $id
 * @property int $enterprise_id
 * @property string $semester
 * @property \Cake\I18n\FrozenDate $start_date
 * @property \Cake\I18n\FrozenDate $end_date
 * @property int $available_places
 * @property string $work_hours
 * @property string $title
 * @property string $description
 *
 * @property \App\Model\Entity\Enterprise $enterprise
 * @property \App\Model\Entity\Candidacy[] $candidacies
 */
class Internship extends Entity
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
        'enterprise_id' => true,
        'semester' => true,
        'start_date' => true,
        'end_date' => true,
        'available_places' => true,
        'work_hours' => true,
        'title' => true,
        'description' => true,
        'enterprise' => true,
        'candidacies' => true
    ];

    public function beforeDelete() {
        
        //$this->Internships->Candidacies->deleteAll(['internship_id' => $this->_properties['id']]);
    }
}
