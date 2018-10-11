<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pilot $pilot
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
	<ul class="side-nav">
		<li class="heading"><?= __('Actions') ?></li>
		<li><?= $this->Html->link(__('List Pilots'), ['action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Aircrafts'), ['controller' => 'Aircrafts', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Airlines'), ['controller' => 'Airlines', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Hangars'), ['controller' => 'Hangars', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Flight Schedules'), ['controller' => 'FlightSchedules', 'action' => 'index']) ?></li>
	</ul>
</nav>
<div class="pilots form large-9 medium-8 columns content">
    <?= $this->Form->create($pilot) ?>
    <fieldset>
		<legend><?= __('Add Pilot') ?></legend>
        <?php
			echo $this->Form->control( 'licence_number' );
			echo $this->Form->control( 'first_name' );
			echo $this->Form->control( 'last_name' );
			echo $this->Form->control( 'gender' );
			echo $this->Form->control( 'other_detail' );
		?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
