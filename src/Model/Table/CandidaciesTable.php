<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Candidacies Model
 *
 * @property \App\Model\Table\InternshipsTable|\Cake\ORM\Association\BelongsTo $Internships
 * @property \App\Model\Table\StudentsTable|\Cake\ORM\Association\BelongsTo $Students
 *
 * @method \App\Model\Entity\Candidacy get($primaryKey, $options = [])
 * @method \App\Model\Entity\Candidacy newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Candidacy[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Candidacy|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Candidacy|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Candidacy patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Candidacy[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Candidacy findOrCreate($search, callable $callback = null, $options = [])
 */
class CandidaciesTable extends Table
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

        $this->setTable('candidacies');
        $this->setDisplayField('internship_id');
        $this->setPrimaryKey(['internship_id', 'student_id']);

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
