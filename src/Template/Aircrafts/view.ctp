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
        if ($loguser) {
        	if ($aircraft->user_id === $loguser['id'] || $loguser['admin']) {
        		echo $this->Html->link(__('Edit Aircraft'), ['action' => 'edit', $aircraft->slug])."</li><li>";
        		echo $this->Form->postLink(__('Delete Aircraft'), ['action' => 'delete', $aircraft->slug], ['confirm' => __('Are you sure you want to delete {0}?', $aircraft->model)])."</li><li>";
        	}
        	echo $this->Html->link(__('New Aircraft'), ['action' => 'add']);
        }
        ?>
        </li>
        <li><?= $this->Html->link(__('List Aircrafts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('List Airlines'), ['controller' => 'Airlines', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Hangars'), ['controller' => 'Hangars', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Flight Schedules'), ['controller' => 'FlightSchedules', 'action' => 'index']) ?></li>
    	<li><?= $this->Html->link(__('List Pilots'), ['controller' => 'Pilots', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="aircrafts view large-9 medium-8 columns content">
    <h3><?= h($aircraft->model) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Airline') ?></th>
            <td><?= $aircraft->has('airline') ? $this->Html->link($aircraft->airline->airline_name, ['controller' => 'Airlines', 'action' => 'view', $aircraft->airline->slug]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hangar') ?></th>
            <td><?= $aircraft->has('hangar') ? $this->Html->link($aircraft->hangar->code, ['controller' => 'Hangars', 'action' => 'view', $aircraft->hangar->slug]) : '' ?></td>
        </tr>
        <tr>
        <?php 
        if ( $loguser['admin']) {
    		echo '<th scope="row">';
 			echo __('User');
 			echo '</th>';
    		echo '<td>';
    		echo $aircraft->has('user') ? $this->Html->link($aircraft->user->username, ['controller' => 'Users', 'action' => 'view', $aircraft->user->slug]) : '' ;
    		echo '</td>';
    	}
    	?>
        </tr>
        <tr>
            <th scope="row"><?= __('Model') ?></th>
            <td><?= h($aircraft->model) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Detail') ?></th>
            <td><?= h($aircraft->other_detail) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Capacity') ?></th>
            <td><?= $this->Number->format($aircraft->capacity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Weight') ?></th>
            <td><?= $this->Number->format($aircraft->weight) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($aircraft->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($aircraft->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Flight Schedules') ?></h4>
        <?php if (!empty($aircraft->flight_schedules)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
            	<th scope="col"><?= __('Flight Code') ?></th>
                <th scope="col"><?= __('Aircraft') ?></th>
                <th scope="col"><?= __('Pilot Id') ?></th>
                <th scope="col"><?= __('Event Type') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($aircraft->flight_schedules as $flightSchedules): ?>
            <tr>
           		<td><?= h($flightSchedules->flight_name) ?></td>
                <td><?= h($aircraft->model) ?></td>
                <td><?= h($flightSchedules->pilot_id) ?></td>
                <td><?= h($flightSchedules->event_type) ?></td>
                <td class="actions">
                	<?php echo $this->Html->link(__('View'), ['controller' => 'FlightSchedules', 'action' => 'view', $flightSchedules->slug])."&#8199;";
                	if ( $flightSchedules->user_id === $loguser['id'] || $loguser['admin']) {
                		echo $this->Html->link(__('Edit'), ['controller' => 'FlightSchedules', 'action' => 'edit', $flightSchedules->slug])."&#8199;";
                		echo $this->Form->postLink(__('Delete'), ['controller' => 'FlightSchedules', 'action' => 'delete', $flightSchedules->slug], ['confirm' => __('Are you sure you want to delete {0}?', $flightSchedules->flight_name)]);
	                }?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
