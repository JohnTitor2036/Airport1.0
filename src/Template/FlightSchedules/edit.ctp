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
			if ( $flightSchedule->user_id === $loguser['id'] || $loguser['admin'] ) {
				echo $this->Form->postLink( __( 'Delete' ), [ 
						'action'=>'delete', $flightSchedule->slug
				], [ 
						'confirm'=>__( 'Are you sure you want to delete {0}?', $flightSchedule->flight_name )
				] ) . "</li><li>";
			}
		?>
        </li>
		<li><?= $this->Html->link(__('List Flight Schedules'), ['action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Aircrafts'), ['controller' => 'Aircrafts', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Airlines'), ['controller' => 'Airlines', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Hangars'), ['controller' => 'Hangars', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Pilots'), ['controller' => 'Pilots', 'action' => 'index']) ?></li>

</nav>
<div class="flightSchedules form large-9 medium-8 columns content">
    <?= $this->Form->create($flightSchedule) ?>
    <fieldset>
		<legend><?= __('Edit Flight Schedule') ?></legend>
        <?php
			echo $this->Form->control( 'aircraft_id', [ 
					'options'=>$aircrafts
			] );
			echo $this->Form->control( 'pilot_id', [ 
					'options'=>$pilots
			] );
			echo $this->Form->control( 'flight_name' );
			echo $this->Form->control( 'event_type' );
			echo $this->Form->control( 'departure_time' );
			echo $this->Form->control( 'arrival_time' );
			echo $this->Form->control( 'other_detail' );
		?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
