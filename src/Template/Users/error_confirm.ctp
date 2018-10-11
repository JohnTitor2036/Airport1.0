<?php
/**
 * @var \App\View\AppView $this
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
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
	<h1><?php echo __("You need to confirm your email to access all the functionalities") ?></h1>
	<p><?php echo __("You can't :") ?></p>
	<ul>
		<li><?php echo __("Add a new element (Aircraft, airline, etc.)") ?></li>
		<li><?php echo __("Edit your account") ?></li>
	</ul>
	<fieldset>
	<?php
	echo $this->Form->postButton( __( 'Send back the confirmation email' ), [ 
			'controller'=>'Users', 'action'=>'email', $user['email'], $user['username'], $user['uuid']
	] );
	echo "</fieldset><fieldset>";
	echo $this->Form->postButton( __( 'Continue anyway' ), [ 
			'controller'=>'Aircrafts', 'action'=>'index'
	] );
	?>
	</fieldset>
</div>