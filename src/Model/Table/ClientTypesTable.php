<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ClientTypes Model
 *
 * @property \App\Model\Table\EnterprisesTable|\Cake\ORM\Association\BelongsToMany $Enterprises
 *
 * @method \App\Model\Entity\ClientType get($primaryKey, $options = [])
 * @method \App\Model\Entity\ClientType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ClientType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ClientType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClientType|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ClientType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ClientType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ClientType findOrCreate($search, callable $callback = null, $options = [])
 */
class ClientTypesTable extends Table
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

        $this->setTable('client_types');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Enterprises', [
            'foreignKey' => 'client_type_id',
            'targetForeignKey' => 'enterprise_id',
            'joinTable' => 'enterprises_client_types'
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
