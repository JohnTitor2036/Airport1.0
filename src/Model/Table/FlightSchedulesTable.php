<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Validation\Validator;

/**
 * FlightSchedules Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\AircraftsTable|\Cake\ORM\Association\BelongsTo $Aircrafts
 * @property \App\Model\Table\PilotsTable|\Cake\ORM\Association\BelongsTo $Pilots
 *
 * @method \App\Model\Entity\FlightSchedule get($primaryKey, $options = [])
 * @method \App\Model\Entity\FlightSchedule newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FlightSchedule[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FlightSchedule|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FlightSchedule|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FlightSchedule patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FlightSchedule[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FlightSchedule findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FlightSchedulesTable extends Table
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

        $this->setTable('flight_schedules');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Aircrafts', [
            'foreignKey' => 'aircraft_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Pilots', [
            'foreignKey' => 'pilot_id',
            'joinType' => 'INNER'
        ]);
    }
    
    public function beforeSave( $event, $entity, $options ) {
    	
    	$sluggedModel = Text::slug( strtolower($entity->flight_name) );
    	$entity->slug = substr( $sluggedModel, 0, 191 );
    	
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
            ->allowEmpty('id', 'create')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('flight_name')
            ->maxLength('flight_name', 255)
            ->requirePresence('flight_name', 'create')
            ->notEmpty('flight_name');

        $validator
            ->scalar('event_type')
            ->maxLength('event_type', 255)
            ->requirePresence('event_type', 'create')
            ->notEmpty('event_type');

        $validator
            ->dateTime('departure_time')
            ->requirePresence('departure_time', 'create')
            ->notEmpty('departure_time');

        $validator
            ->dateTime('arrival_time')
            ->requirePresence('arrival_time', 'create')
            ->notEmpty('arrival_time');

        $validator
            ->scalar('other_detail')
            ->maxLength('other_detail', 255)
            ->allowEmpty('other_detail');
        
        $validator
        	->notEmpty('aircraft_id');
        
        $validator
        	->notEmpty('pilot_id');

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
        $rules->add($rules->isUnique(['id']));
        $rules->add($rules->isUnique(['slug']));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['aircraft_id'], 'Aircrafts'));
        $rules->add($rules->existsIn(['pilot_id'], 'Pilots'));

        return $rules;
    }
}
