<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Hangar Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $code
 * @property string $hangar_size
 * @property string $other_detail
 * @property string $slug
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Aircraft[] $aircrafts
 */
class Hangar extends Entity {

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
