<?php
/**
 * @var \App\View\AppView $this
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
	<ul class="side-nav">
		<li class="heading"><?= __('Actions') ?></li>
		<li><?= $this->Html->link(__('List Aircrafts'), ['controller' => 'Aircrafts', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Airlines'), ['controller' => 'Airlines', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Hangars'), ['controller' => 'Hangars', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Flight Schedules'), ['controller' => 'FlightSchedules', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Pilots'), ['controller' => 'Pilots', 'action' => 'index']) ?></li>
	</ul>
</nav>
<div class="aircrafts form large-9 medium-8 columns content">
	<fieldset>
		<legend><?= __('Login') ?></legend>
        <?= $this->Form->create() ?>
		<?= $this->Form->control('email') ?>
		<?= $this->Form->control('password') ?>
    </fieldset>
    <?= $this->Form->button(__('Login')) ?>
	<?= $this->Form->end() ?>
</div>