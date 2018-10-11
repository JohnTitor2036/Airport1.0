<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * File Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $airline_id
 * @property string $name
 * @property string $path
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property bool $status
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Airline $airline
 * @property \App\Model\Entity\Airline[] $airlines
 */
class File extends Entity {
	protected $_accessible = [ 
			'*'=>true, 'id'=>false, 'slug'=>false
	];
}