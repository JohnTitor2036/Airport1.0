<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Aircraft $aircraft
 */
$loguser = $this->request->getSession()->read( 'Auth.User' );
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
	<ul class="side-nav">
		<li class="heading"><?= __('Actions') ?></li>
		<li>
        <?php
			if ( $aircraft->user_id === $loguser['id'] || $loguser['admin'] ) {
				echo $this->Form->postLink( __( 'Delete' ), [ 
						'action'=>'delete', $aircraft->slug
				], [ 
						'confirm'=>__( 'Are you sure you want to delete {0}?', $aircraft->model )
				] ) . "</li><li>";
			}
		?>
        </li>
		<li><?= $this->Html->link(__('List Aircrafts'), ['action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Airlines'), ['controller' => 'Airlines', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Hangars'), ['controller' => 'Hangars', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Flight Schedules'), ['controller' => 'FlightSchedules', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Pilots'), ['controller' => 'Pilots', 'action' => 'index']) ?></li>
	</ul>
</nav>
<div class="aircrafts form large-9 medium-8 columns content">
    <?= $this->Form->create($aircraft) ?>
    <fieldset>
		<legend><?= __('Edit Aircraft') ?></legend>
        <?php
			echo $this->Form->control( 'airline_id', [ 
					'options'=>$airlines
			] );
			echo $this->Form->control( 'hangar_id', [ 
					'options'=>$hangars
			] );
			echo $this->Form->control( 'model' );
			echo $this->Form->control( 'capacity' );
			echo $this->Form->control( 'weight' );
			echo $this->Form->control( 'other_detail' );
		?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
