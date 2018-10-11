<?php

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Validation\Validator;

/**
 * Aircrafts Model
 *
 * @property \App\Model\Table\AirlinesTable|\Cake\ORM\Association\BelongsTo $Airlines
 * @property \App\Model\Table\HangarsTable|\Cake\ORM\Association\BelongsTo $Hangars
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\FlightSchedulesTable|\Cake\ORM\Association\HasMany $FlightSchedules
 *
 * @method \App\Model\Entity\Aircraft get($primaryKey, $options = [])
 * @method \App\Model\Entity\Aircraft newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Aircraft[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Aircraft|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Aircraft|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Aircraft patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Aircraft[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Aircraft findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */

class AircraftsTable extends Table {

	public function initialize( array $config ) {

		parent::initialize($config);
		$this->addBehavior('Translate', ['fields' => ['other_detail']]);
		
		$this->setTable('aircrafts');
		$this->setDisplayField('model');
		$this->setPrimaryKey('id');
		
		$this->addBehavior('Timestamp');
		
		$this->belongsTo('Airlines', [
				'foreignKey' => 'airline_id',
				'joinType' => 'INNER'
		]);
		$this->belongsTo('Hangars', [
				'foreignKey' => 'hangar_id',
				'joinType' => 'INNER'
		]);
		$this->belongsTo('Users', [
				'foreignKey' => 'user_id',
				'joinType' => 'INNER'
		]);
		$this->hasMany('FlightSchedules', [
				'foreignKey' => 'aircraft_id'
		]);
	}

	public function beforeSave( $event, $entity, $options ) {
		$sluggedModel = Text::slug( strtolower($entity->model) );
		$entity->slug = substr( $sluggedModel, 0, 191 );
	}
	
	public function validationDefault(Validator $validator)
	{
		$validator
		->notEmpty('airline_id')
		->maxLength('airline_id', 255)

		->notEmpty('hangar_id')
		->maxLength('hangar_id', 255)
		
		->notEmpty('user_id')
		->maxLength('user_id', 255)

		->notEmpty('model')
		->maxLength('model', 255)

		->integer('capacity')
		->notEmpty('capacity')
		->maxLength('capacity', 255)

		->integer('weight')
		->notEmpty('weight')
		->maxLength('weight', 255)
		
		->allowEmpty('other_detail')
		->maxLength('other_detail', 255);

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
		$rules->add($rules->isUnique(['slug']));
		$rules->add($rules->existsIn(['airline_id'], 'Airlines'));
		$rules->add($rules->existsIn(['hangar_id'], 'Hangars'));
		$rules->add($rules->existsIn(['user_id'], 'Users'));
		
		return $rules;
	}
}