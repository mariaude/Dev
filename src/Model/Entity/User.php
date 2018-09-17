<?php
namespace App\Model\Entity;

<<<<<<< HEAD
use Cake\Auth\DefaultPasswordHasher; 
=======
use Cake\Auth\DefaultPasswordHasher;
>>>>>>> 45022bde7df0d4367f6248b2972c9c3703646080
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $email
 * @property string $password
 *
 * @property \App\Model\Entity\Enterprise[] $enterprises
 * @property \App\Model\Entity\Student[] $students
 */
class User extends Entity
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
        'email' => true,
        'password' => true,
        'enterprises' => true,
        'students' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
    
    protected function _setPassword($value)
    {
        if (strlen($value)) {
            $hasher = new DefaultPasswordHasher();

            return $hasher->hash($value);
        }
    }
<<<<<<< HEAD
    
=======
>>>>>>> 45022bde7df0d4367f6248b2972c9c3703646080
}
