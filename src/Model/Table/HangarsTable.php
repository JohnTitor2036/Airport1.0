<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Validation\Validator;

/**
 * Hangars Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\AircraftsTable|\Cake\ORM\Association\HasMany $Aircrafts
 *
 * @method \App\Model\Entity\Hangar get($primaryKey, $options = [])
 * @method \App\Model\Entity\Hangar newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Hangar[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Hangar|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Hangar|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Hangar patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Hangar[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Hangar findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class HangarsTable extends Table
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
        
        $this->setTable('hangars');
        $this->setDisplayField('code');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Aircrafts', [
            'foreignKey' => 'hangar_id'
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
            ->scalar('hangar_size')
            ->integer('hangar_size')
            ->maxLength('hangar_size', 255)
            ->requirePresence('hangar_size', 'create')
            ->notEmpty('hangar_size');

        $validator
            ->scalar('other_detail')
            ->maxLength('other_detail', 255)
            ->allowEmpty('other_detail');
        
        $validator
            ->scalar('code')
            ->maxLength('code', 255)
            ->notEmpty('code');

        return $validator;
    }
    
    public function beforeSave( $event, $entity, $options ) {
    	
    		$sluggedModel = Text::slug( $entity->code );
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
