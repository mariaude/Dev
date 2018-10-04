<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Enterprises Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\InternshipsTable|\Cake\ORM\Association\HasMany $Internships
 *
 * @method \App\Model\Entity\Enterprise get($primaryKey, $options = [])
 * @method \App\Model\Entity\Enterprise newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Enterprise[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Enterprise|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Enterprise|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Enterprise patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Enterprise[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Enterprise findOrCreate($search, callable $callback = null, $options = [])
 */
class EnterprisesTable extends Table
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

        $this->setTable('enterprises');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Internships', [
            'foreignKey' => 'enterprise_id'
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

        $validator
            ->scalar('adress')
            ->maxLength('adress', 255)
            ->requirePresence('adress', 'create')
            ->notEmpty('adress');

        $validator
            ->scalar('city')
            ->maxLength('city', 255)
            ->requirePresence('city', 'create')
            ->notEmpty('city');

        $validator
            ->scalar('province')
            ->maxLength('province', 255)
            ->requirePresence('province', 'create')
            ->notEmpty('province');

        $validator
            ->scalar('postal_code')
            ->maxLength('postal_code', 6)
            ->requirePresence('postal_code', 'create')
            ->notEmpty('postal_code');

        $validator
            ->scalar('region')
            ->maxLength('region', 255)
            ->requirePresence('region', 'create')
            ->notEmpty('region');
        
        $validator
            ->scalar('additional_informations')
            ->requirePresence('additional_informations', 'create')
            ->notEmpty('additional_informations');
        
        $validator
            ->boolean('active')
            ->requirePresence('active', 'create');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
