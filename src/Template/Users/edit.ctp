<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$loguser = $this->request->getSession()->read( 'Auth.User' );
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
	<ul class="side-nav">
		<li class="heading"><?= __('Actions') ?></li>
		<li>
        <?php
			if ( $user->id === $loguser['id'] || $loguser['admin'] ) {
				echo $this->Form->postLink( __( 'Delete' ), [ 
						'action'=>'delete', $user->slug
				], [ 
						'confirm'=>__( 'Are you sure you want to delete {0}?', $user->username )
				] ) . "</li><li>";
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
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
		<legend><?= __('Edit User') ?></legend>
        <?php
			echo $this->Form->control( 'username' );
			echo $this->Form->control( 'email' );
			echo $this->Form->control( 'password' );
			if ( $loguser['admin'] ) {
				echo $this->Form->control( 'admin' );
			}
		?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
