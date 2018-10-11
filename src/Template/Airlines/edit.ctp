<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Airline $airline
 */
$loguser = $this->request->getSession()->read( 'Auth.User' );
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
	<ul class="side-nav">
		<li class="heading"><?= __('Actions') ?></li>
		<li>
        <?php
			if ( $airline->user_id === $loguser['id'] || $loguser['admin'] ) {
				echo $this->Form->postLink( __( 'Delete' ), [ 
						'action'=>'delete', $airline->slug
				], [ 
						'confirm'=>__( 'Are you sure you want to delete {0}?', $airline->airline_name )
				] ) . "</li><li>";
			}
		?>
        </li>
		<li><?= $this->Html->link(__('List Airlines'), ['action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Aircrafts'), ['controller' => 'Aircrafts', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Hangars'), ['controller' => 'Hangars', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Flight Schedules'), ['controller' => 'FlightSchedules', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Pilots'), ['controller' => 'Pilots', 'action' => 'index']) ?></li>
	</ul>
</nav>
<div class="airlines form large-9 medium-8 columns content">
    <?= $this->Form->create($airline) ?>
    <fieldset>
		<legend><?= __('#1 : Edit the airline informations') ?></legend>
        <?php
			echo $this->Form->control( 'airline_name' );
			echo $this->Form->control( 'country' );
			echo $this->Form->control( 'other_detail' );
		?>
    </fieldset>
    <?= $this->Form->button(__('Next')) ?>
    <?= $this->Form->end() ?>
</div>
