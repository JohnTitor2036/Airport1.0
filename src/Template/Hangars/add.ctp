<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Hangar $hangar
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
	<ul class="side-nav">
		<li class="heading"><?= __('Actions') ?></li>
		<li><?= $this->Html->link(__('List Hangars'), ['action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Aircrafts'), ['controller' => 'Aircrafts', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Airlines'), ['controller' => 'Airlines', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Flight Schedules'), ['controller' => 'FlightSchedules', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Pilots'), ['controller' => 'Pilots', 'action' => 'index']) ?></li>
	</ul>
</nav>
<div class="hangars form large-9 medium-8 columns content">
    <?= $this->Form->create($hangar) ?>
    <fieldset>
		<legend><?= __('Add Hangar') ?></legend>
        <?php
			echo $this->Form->control( 'code' );
			echo $this->Form->control( 'hangar_size' );
			echo $this->Form->control( 'other_detail' );
		?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
