<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pilot $pilot
 */
$loguser = $this->request->getSession()->read( 'Auth.User' );
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
	<ul class="side-nav">
		<li class="heading"><?= __('Actions') ?></li>
		<li>
        <?php
			if ( $pilot->user_id === $loguser['id'] || $loguser['admin'] ) {
				echo $this->Form->postLink( __( 'Delete' ), [ 
						'action'=>'delete', $pilot->slug
				], [ 
						'confirm'=>__( 'Are you sure you want to delete {0} {1}?', $pilot->first_name, $pilot->last_name )
				] ) . "</li><li>";
			}
		?>
        </li>
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
		<legend><?= __('Edit Pilot') ?></legend>
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
