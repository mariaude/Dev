<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Convocations Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $Internships
 * @property \App\Model\Table\StudentsTable|\Cake\ORM\Association\BelongsTo $Students
 *
 * @method \App\Model\Entity\Convocation get($primaryKey, $options = [])
 * @method \App\Model\Entity\Convocation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Convocation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Convocation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Convocation|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Convocation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Convocation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Convocation findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ConvocationsTable extends Table
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

        $this->setTable('convocations');
        $this->setDisplayField('student_id');
        $this->setPrimaryKey(['student_id', 'enterprise_id']);

        $this->addBehavior('Timestamp');

        $this->belongsTo('Internships', [
            'foreignKey' => 'internship_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER'
        ]);
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
        $rules->add($rules->existsIn(['internship_id'], 'Internships'));
        $rules->add($rules->existsIn(['student_id'], 'Students'));

        return $rules;
    }
}
