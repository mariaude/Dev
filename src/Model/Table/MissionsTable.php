<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Missions Model
 *
 * @property \App\Model\Table\EnterprisesTable|\Cake\ORM\Association\BelongsToMany $Enterprises
 *
 * @method \App\Model\Entity\Mission get($primaryKey, $options = [])
 * @method \App\Model\Entity\Mission newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Mission[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Mission|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Mission|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Mission patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Mission[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Mission findOrCreate($search, callable $callback = null, $options = [])
 */
class MissionsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('missions');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Enterprises', [
            'foreignKey' => 'mission_id',
            'targetForeignKey' => 'enterprise_id',
            'joinTable' => 'enterprises_missions'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }
}
