<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher; 
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

/**
 * User Entity
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $role
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
        'role' => true,
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

    protected $_virtual = [
        'enterprise', 
        'student'
    ];

    protected function _getEnterprise()
    {   
        if(!$this->isNew()){
            $enterprises = TableRegistry::get('Enterprises');
            $enterprise = $enterprises->find()->where(['user_id' => $this->_properties['id']])->first();
            return $enterprise;
        }
        return null;

    }

    protected function _getStudent()
    {   
        if(!$this->isNew()){
            $students = TableRegistry::get('Students');
            $student = $students->find()->where(['user_id' => $this->_properties['id']])->first();
            return $student;
        }
        return null;
    }
    
}
