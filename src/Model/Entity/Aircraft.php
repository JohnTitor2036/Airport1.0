<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Aircraft Entity
 *
 * @property int $id
 * @property int $airline_id
 * @property int $hangar_id
 * @property int $user_id
 * @property string $model
 * @property int $capacity
 * @property int $weight
 * @property string $other_detail
 * @property string $slug
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\FlightSchedule[] $flight_schedule
 * @property \App\Model\Entity\Airline[] $airline
 * @property \App\Model\Entity\Hangar[] $hangar
 */
class Aircraft extends Entity {
	protected $_accessible = [ 
			'*'=>true, 'id'=>false, 'slug'=>false
	];
}