<?php
namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Validation\Validator;

/**
 * Airlines Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\AircraftsTable|\Cake\ORM\Association\HasMany $Aircrafts
 *
 * @method \App\Model\Entity\Airline get($primaryKey, $options = [])
 * @method \App\Model\Entity\Airline newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Airline[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Airline|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Airline|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Airline patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Airline[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Airline findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AirlinesTable extends Table
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
        $this->addBehavior('Translate', ['fields' => ['other_detail', 'country']]);

        $this->setTable('airlines');
        $this->setDisplayField('airline_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Aircrafts', [
            'foreignKey' => 'airline_id'
        ]);
    }
    
    public function beforeSave( $event, $entity, $options ) {
    		$sluggedModel = Text::slug( strtolower($entity->airline_name) );
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
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('airline_name')
            ->maxLength('airline_name', 255)
            ->requirePresence('airline_name', 'create')
            ->notEmpty('airline_name');

        $validator
            ->scalar('country')
            ->maxLength('country', 255)
            ->requirePresence('country', 'create')
            ->notEmpty('country');

        $validator
            ->scalar('other_detail')
            ->maxLength('other_detail', 255)
            ->allowEmpty('other_detail');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
