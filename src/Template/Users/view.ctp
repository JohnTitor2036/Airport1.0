<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var \App\Model\Entity\Airline $airline
 */
$loguser = $this->request->getSession()->read( 'Auth.User' );
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li>
        <?php 
        if ($loguser) {
        	if ($user->id === $loguser['id'] || $loguser['admin']) {
        		echo $this->Html->link(__('Edit User'), ['action' => 'edit', $user->slug])."</li><li>";
        		echo $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->slug], ['confirm' => __('Are you sure you want to delete {0}?', $user->username)])."</li><li>";
        	}
        	if ($loguser['admin']) {
        		echo $this->Html->link(__('New User'), ['action' => 'add'])."</li><li>";
        		echo $this->Html->link(__('List Users'), ['action' => 'index'])."</li><li>";
        	}
        }
        ?>
        </li>
        <li><?= $this->Html->link(__('List Aircrafts'), ['controller' => 'Aircrafts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Airlines'), ['controller' => 'Airlines', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Hangars'), ['controller' => 'Hangars', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Flight Schedules'), ['controller' => 'FlightSchedules', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Pilots'), ['controller' => 'Pilots', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->username) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rank') ?></th>
            <td><?= $user->admin ? __('Administrator') : __('Air traffic controller'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Aircrafts') ?></h4>
        <?php if (!empty($user->aircrafts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Model') ?></th>
                <th scope="col"><?= __('Airline Id') ?></th>
                <th scope="col"><?= __('Hangar Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->aircrafts as $aircrafts): ?>
            <tr>
                <td><?= h($aircrafts->model) ?></td>
                <td><?= h($aircrafts->airline_id) ?></td>
                <td><?= h($aircrafts->hangar_id) ?></td>
                <td class="actions">
                <?php echo $this->Html->link(__('View'), ['controller' => 'Aircrafts', 'action' => 'view', $aircrafts->slug])."&#8199;";
                	if ( $aircrafts->user_id === $loguser['id'] || $loguser['admin']) {
                		echo $this->Html->link(__('Edit'), ['controller' => 'Aircrafts', 'action' => 'edit', $aircrafts->slug])."&#8199;";
                		echo $this->Form->postLink(__('Delete'), ['controller' => 'Aircrafts', 'action' => 'delete', $aircrafts->slug], ['confirm' => __('Are you sure you want to delete {0}?', $aircrafts->model)]);
	                }?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Airlines') ?></h4>
        <?php if (!empty($user->airlines)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Airline Name') ?></th>
                <th scope="col"><?= __('Country') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->airlines as $airlines): ?>
            <tr>
                <td><?= h($airlines->airline_name) ?></td>
                <td><?= h($airlines->country) ?></td>
                <td class="actions">
                <?php echo $this->Html->link(__('View'), ['controller' => 'Airlines', 'action' => 'view', $airlines->slug])."&#8199;";
                if ( $airlines->user_id === $loguser['id'] || $loguser['admin']) {
                	echo $this->Html->link(__('Edit'), ['controller' => 'Airlines', 'action' => 'edit', $airlines->slug])."&#8199;";
                	echo $this->Form->postLink(__('Delete'), ['controller' => 'Airlines', 'action' => 'delete', $airlines->slug], ['confirm' => __('Are you sure you want to delete {0}?', $airlines->airline_name)]);
	                }?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Flight Schedules') ?></h4>
        <?php if (!empty($user->flight_schedules)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Flight Code') ?></th>
                <th scope="col"><?= __('Aircraft id') ?></th>
                <th scope="col"><?= __('Pilot Id') ?></th>
                <th scope="col"><?= __('Event Type') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->flight_schedules as $flightSchedules): ?>
            <tr>
                <td><?= h($flightSchedules->flight_name) ?></td>
                <td><?= h($flightSchedules->aircraft_id) ?></td>
                <td><?= h($flightSchedules->pilot_id) ?></td>
                <td><?= h($flightSchedules->event_type) ?></td>
                <td class="actions">
                 <?php echo $this->Html->link(__('View'), ['controller' => 'FlightSchedules', 'action' => 'view', $flightSchedules->slug])."&#8199;";
                if ( $flightSchedules->user_id === $loguser['id'] || $loguser['admin']) {
                	echo $this->Html->link(__('Edit'), ['controller' => 'FlightSchedules', 'action' => 'edit', $flightSchedules->slug])."&#8199;";
                	echo $this->Form->postLink(__('Delete'), ['controller' => 'FlightSchedules', 'action' => 'delete', $flightSchedules->slug], ['confirm' => __('Are you sure you want to delete {0}?', $flightSchedules->flight_name)]);
	            }?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Hangars') ?></h4>
        <?php if (!empty($user->hangars)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
           		<th scope="col"><?= __('Hangar Code') ?></th>
                <th scope="col"><?= __('Hangar Size') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->hangars as $hangars): ?>
            <tr>
         	    <td><?= h($hangars->code) ?></td>
                <td><?= h($hangars->hangar_size) ?></td>
                <td class="actions">
                 <?php echo $this->Html->link(__('View'), ['controller' => 'Hangars', 'action' => 'view', $hangars->slug])."&#8199;";
                 if ( $hangars->user_id === $loguser['id'] || $loguser['admin']) {
                 	echo $this->Html->link(__('Edit'), ['controller' => 'Hangars', 'action' => 'edit', $hangars->slug])."&#8199;";
                 	echo $this->Form->postLink(__('Delete'), ['controller' => 'Hangars', 'action' => 'delete', $hangars->slug], ['confirm' => __('Are you sure you want to delete {0}?', $hangars->code)]);
	            }?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Pilots') ?></h4>
        <?php if (!empty($user->pilots)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Licence Number') ?></th>
                <th scope="col"><?= __('First Name') ?></th>
                <th scope="col"><?= __('Last Name') ?></th>
                <th scope="col"><?= __('Gender') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->pilots as $pilots): ?>
            <tr>
                <td><?= h($pilots->licence_number) ?></td>
                <td><?= h($pilots->first_name) ?></td>
                <td><?= h($pilots->last_name) ?></td>
                <td><?= h($pilots->gender) ?></td>
                <td class="actions">
                <?php echo $this->Html->link(__('View'), ['controller' => 'Pilots', 'action' => 'view', $pilots->slug])."&#8199;";
                 if ( $hangars->user_id === $loguser['id'] || $loguser['admin']) {
                 	echo $this->Html->link(__('Edit'), ['controller' => 'Pilots', 'action' => 'edit', $pilots->slug])."&#8199;";
                 	echo $this->Form->postLink(__('Delete'), ['controller' => 'Pilots', 'action' => 'delete', $pilots->slug], ['confirm' => __('Are you sure you want to delete {0} {1}?', $pilots->first_name, $pilots->last_name)]);
	            }?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
