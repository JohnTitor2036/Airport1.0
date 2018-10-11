<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FlightSchedule $flightSchedule
 */
$loguser = $this->request->getSession()->read( 'Auth.User' );
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li>
        <?php 
        if ($loguser) {
        	if ($flightSchedule->user_id === $loguser['id'] || $loguser['admin']) {
        		echo $this->Html->link(__('Edit Flight Schedule'), ['action' => 'edit', $flightSchedule->slug])."</li><li>";
        		echo $this->Form->postLink(__('Delete Flight Schedule'), ['action' => 'delete', $flightSchedule->slug], ['confirm' => __('Are you sure you want to delete {0}?', $flightSchedule->flight_name)])."</li><li>";
        	}
        	echo $this->Html->link(__('New Flight Schedule'), ['action' => 'add']);
        }
        ?>
        <li>
        <li><?= $this->Html->link(__('List Flight Schedules'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('List Aircrafts'), ['controller' => 'Aircrafts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Airlines'), ['controller' => 'Airlines', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Hangars'), ['controller' => 'Hangars', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Pilots'), ['controller' => 'Pilots', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="flightSchedules view large-9 medium-8 columns content">
    <h3><?= h($flightSchedule->flight_name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Aircraft') ?></th>
            <td><?= $flightSchedule->has('aircraft') ? $this->Html->link($flightSchedule->aircraft->model, ['controller' => 'Aircrafts', 'action' => 'view', $flightSchedule->aircraft->slug]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pilot') ?></th>
            <td><?= $flightSchedule->has('pilot') ? $this->Html->link($flightSchedule->pilot->first_name + " " + $flightSchedule->pilot->last_name, ['controller' => 'Pilots', 'action' => 'view', $flightSchedule->pilot->slug]) : '' ?></td>
        </tr>
        <tr>
        <?php 
        if ( $loguser['admin']) {
    		echo '<th scope="row">';
 			echo __('User');
 			echo '</th>';
    		echo '<td>';
    		echo $flightSchedule->has('user') ? $this->Html->link($flightSchedule->user->username, ['controller' => 'Users', 'action' => 'view', $flightSchedule->user->slug]) : '' ;
    		echo '</td>';
    	}
    	?>
        </tr>
        <tr>
            <th scope="row"><?= __('Flight Name') ?></th>
            <td><?= h($flightSchedule->flight_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Event Type') ?></th>
            <td><?= h($flightSchedule->event_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Detail') ?></th>
            <td><?= h($flightSchedule->other_detail) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Departure Time') ?></th>
            <td><?= h($flightSchedule->departure_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Arrival Time') ?></th>
            <td><?= h($flightSchedule->arrival_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($flightSchedule->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($flightSchedule->modified) ?></td>
        </tr>
    </table>
</div>
