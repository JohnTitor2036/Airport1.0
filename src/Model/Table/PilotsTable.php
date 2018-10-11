<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Validation\Validator;

/**
 * Pilots Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\FlightSchedulesTable|\Cake\ORM\Association\HasMany $FlightSchedules
 *
 * @method \App\Model\Entity\Pilot get($primaryKey, $options = [])
 * @method \App\Model\Entity\Pilot newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Pilot[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Pilot|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pilot|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pilot patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Pilot[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Pilot findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PilotsTable extends Table
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
        $this->addBehavior('Translate', ['fields' => ['other_detail']]);

        $this->setTable('pilots');
        $this->setDisplayField('last_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('FlightSchedules', [
            'foreignKey' => 'pilot_id'
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
            ->scalar('licence_number')
            ->maxLength('licence_number', 255)
            ->requirePresence('licence_number', 'create')
            ->notEmpty('licence_number');

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
            ->scalar('gender')
            ->maxLength('gender', 255)
            ->requirePresence('gender', 'create')
            ->notEmpty('gender');

        $validator
            ->scalar('other_detail')
            ->maxLength('other_detail', 255)
            ->allowEmpty('other_detail');

        return $validator;
    }

    public function beforeSave( $event, $entity, $options ) {
    	
    	$nom = $entity->first_name;
    	$nom .= " ";
    	$nom .= $entity->last_name;
    	$sluggedModel = Text::slug( strtolower($nom) );
    	$entity->slug = substr( $sluggedModel, 0, 191 );

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
        $rules->add($rules->isUnique(['slug']));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
