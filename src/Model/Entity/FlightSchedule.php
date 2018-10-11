<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FlightSchedule Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $aircraft_id
 * @property int $pilot_id
 * @property string $flight_name
 * @property string $event_type
 * @property \Cake\I18n\FrozenTime $departure_time
 * @property \Cake\I18n\FrozenTime $arrival_time
 * @property string $other_detail
 * @property string $slug
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Aircraft $aircraft
 * @property \App\Model\Entity\Pilot $pilot
 */
class FlightSchedule extends Entity {

	/**
	 * Fields that can be mass assigned using newEntity() or patchEntity().
	 *
	 * Note that when '*' is set to true, this allows all unspecified fields to
	 * be mass assigned. For security purposes, it is advised to set '*' to false
	 * (or remove it), and explicitly make individual fields accessible as needed.
	 *
	 * @var array
	 */
	protected $_accessible = [ 
			'*'=>true, 'id'=>false, 'slug'=>false
	];
}
