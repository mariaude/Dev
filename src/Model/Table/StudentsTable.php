<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Students Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\CandidaciesTable|\Cake\ORM\Association\HasMany $Candidacies
 * @property |\Cake\ORM\Association\HasMany $Convocations
 *
 * @method \App\Model\Entity\Student get($primaryKey, $options = [])
 * @method \App\Model\Entity\Student newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Student[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Student|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Student|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Student patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Student[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Student findOrCreate($search, callable $callback = null, $options = [])
 */
class StudentsTable extends Table
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

        $this->setTable('students');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Candidacies', [
            'foreignKey' => 'student_id'
        ]);
        $this->hasMany('Convocations', [
            'foreignKey' => 'student_id'
        ]);
        $this->hasMany('Files', [
            'foreignKey' => 'student_id'
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
            ->scalar('admission_number')
            ->maxLength('admission_number', 9)
            ->requirePresence('admission_number', 'create')
            ->notEmpty('admission_number');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 255)
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 255)
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name');

        $validator
            ->scalar('phone_number')
            ->maxLength('phone_number', 13)
            ->requirePresence('phone_number', 'create')
            ->notEmpty('phone_number');

        $validator
            ->scalar('informations')
            ->requirePresence('informations', 'create')
            ->notEmpty('informations');

        $validator
            ->scalar('notes')
            ->requirePresence('notes', false)
            ->allowEmpty('notes');

        $validator
            ->boolean('active')
            ->requirePresence('active', false)
            ->allowEmpty('active');

        return $validator;
    }

        /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationAdmin(Validator $validator)
    {

        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('admission_number')
            ->maxLength('admission_number', 9)
            ->requirePresence('admission_number', 'create')
            ->allowEmpty('admission_number');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 255)
            ->requirePresence('first_name', 'create')
            ->allowEmpty('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 255)
            ->requirePresence('last_name', 'create')
            ->allowEmpty('last_name');

        $validator
            ->scalar('phone_number')
            ->maxLength('phone_number', 13)
            ->requirePresence('phone_number', 'create')
            ->allowEmpty('phone_number');

        $validator
            ->scalar('informations')
            ->requirePresence('informations', 'create')
            ->allowEmpty('informations');

        $validator
            ->scalar('notes')
            ->requirePresence('notes', false)
            ->allowEmpty('notes');

        $validator
            ->boolean('active')
            ->requirePresence('active', false)
            ->allowEmpty('active');

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
