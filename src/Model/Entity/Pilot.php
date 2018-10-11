<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Pilot Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $licence_number
 * @property string $first_name
 * @property string $last_name
 * @property string $gender
 * @property string $other_detail
 * @property string $slug
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\FlightSchedule[] $flight_schedules
 */
class Pilot extends Entity {

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
