<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FlightSchedule $flightSchedule
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
	<ul class="side-nav">
		<li class="heading"><?= __('Actions') ?></li>
		<li><?= $this->Html->link(__('List Flight Schedules'), ['action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Aircrafts'), ['controller' => 'Aircrafts', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Airlines'), ['controller' => 'Airlines', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Hangars'), ['controller' => 'Hangars', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Pilots'), ['controller' => 'Pilots', 'action' => 'index']) ?></li>
	</ul>
</nav>
<div class="flightSchedules form large-9 medium-8 columns content">
    <?= $this->Form->create($flightSchedule) ?>
    <fieldset>
		<legend><?= __('Add Flight Schedule') ?></legend>
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
