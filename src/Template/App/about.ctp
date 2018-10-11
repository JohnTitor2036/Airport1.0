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
	<h4><?php echo __("Airport manager"); ?></h4>
	<ul>
		<li>
			<?php echo __("Version 1.0<br />");?>
		</li>
		<li>
			<?php echo __("By Nicolas Meunier"); ?>
		</li>
		<li>
			<?php echo __('For "420-5b7 MO Applications internet"'); ?>
		</li>
		<li>
			<?php echo __("Fall 2018, Coll&egrave;ge Montmorency"); ?>
		</li>
		<li>
			<?php echo __("Some examples : "); ?>
			<ul>
				<li>
					<?php echo __("A visitor can only see the elements and their details"); ?>
					<ul>
						<li><?php echo __("There is no option to add nor edit anything (except adding an account)."); ?></li>
						<li><?php echo __("You can connect to an account with the Login button in the top right corner."); ?></li>
						<li><?php echo __("You can create an new account with the Register button in the top right corner."); ?></li>
						<li><?php echo __("You can't see the user list (The option is there, but it lead to the login section)."); ?></li>
					</ul>
				</li>
				<br />
				<li>
					<?php echo __("An air traffic controller can add elements (aircraft, airline, etc.) and modify or delete the elements he has created."); ?>
					<ul>
						<li><?php echo __("Depending of the page you are on, there is an option in the left menu and in the index page to add an element or edit/delete any elements he has created."); ?></li>
						<li><?php echo __("You can Logout with the Logout button in the top right corner."); ?></li>
						<li><?php echo __("There is a button call My Profile that lead you to your profil."); ?></li>
						<li><?php echo __("The Register button has disappeared."); ?></li>
						<li><?php echo __("You can't see the user list or a user informations other than you."); ?></li>
						<li><?php echo __("You can only view, modify or delete your profile."); ?></li>
					</ul>
				</li>
				<br />
				<li>
					<?php echo __("An admin can do anything"); ?>
					<ul>
						<li><?php echo __("All the Add, Edit, and Delete buttons are visibles and functionals."); ?></li>
						<li><?php echo __("You can Logout with the Logout button in the top right corner."); ?></li>
						<li><?php echo __("There is a button call My Profile that lead you to your profil."); ?></li>
						<li><?php echo __("There is a button call All the Users that lead you to the user list."); ?></li>
						<li><?php echo __("The Register button has disappeared, but you can still add a user with the option in the left menu in the user list."); ?></li>
						<li><?php echo __("You can see the user list and informations, and modify or delete every profiles."); ?></li>
					</ul>
				</li>
			</ul>
		</li>
	</ul>
	<p>
		<a
			href="http://www.databaseanswers.org/data_models/heathrow_airport/index.htm"><?php echo __("For the original database, click here");?></a>
	</p>
	<p><?php echo __("My database : ");?></p>
	<img alt="BD" src="../webroot/img/bd.png">
</div>