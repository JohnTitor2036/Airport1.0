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
        if ($loguser) {
        	if ($pilot->user_id === $loguser['id'] || $loguser['admin']) {
        		echo $this->Html->link(__('Edit Pilot'), ['action' => 'edit', $pilot->slug])."</li><li>";
        		echo $this->Form->postLink(__('Delete Pilot'), ['action' => 'delete', $pilot->slug], ['confirm' => __('Are you sure you want to delete {0} {1}?', $pilot->first_name, $pilot->last_name)])."</li><li>";
        	}
        	echo $this->Html->link(__('New Pilot'), ['action' => 'add']);
        }
        ?>
        </li>
        <li><?= $this->Html->link(__('List Pilots'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('List Aircrafts'), ['controller' => 'Aircrafts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Airlines'), ['controller' => 'Airlines', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Hangars'), ['controller' => 'Hangars', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Flight Schedules'), ['controller' => 'FlightSchedules', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="pilots view large-9 medium-8 columns content">
	<?php $name = $pilot->first_name ?>
    <?php $name .= " " ?>
    <?php $name .= $pilot->last_name ?>
    <h3><?= h($name) ?></h3>
    <table class="vertical-table">
        <tr>
        <?php 
        if ( $loguser['admin']) {
    		echo '<th scope="row">';
 			echo __('User');
 			echo '</th>';
    		echo '<td>';
    		echo $pilot->has('user') ? $this->Html->link($pilot->user->username, ['controller' => 'Users', 'action' => 'view', $pilot->user->slug]) : '' ;
    		echo '</td>';
    	}
    	?>
        </tr>
        <tr>
            <th scope="row"><?= __('Licence Number') ?></th>
            <td><?= h($pilot->licence_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('First Name') ?></th>
            <td><?= h($pilot->first_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Name') ?></th>
            <td><?= h($pilot->last_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gender') ?></th>
            <td><?= h($pilot->gender) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Detail') ?></th>
            <td><?= h($pilot->other_detail) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($pilot->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($pilot->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Flight Schedules') ?></h4>
        <?php if (!empty($pilot->flight_schedules)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
           		<th scope="col"><?= __('Flight Code') ?></th>
           		<th scope="col"><?= __('Pilot') ?></th>
                <th scope="col"><?= __('Aircraft Id') ?></th>
                <th scope="col"><?= __('Event Type') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($pilot->flight_schedules as $flightSchedules): ?>
            <tr>
            	<td><?= h($flightSchedules->flight_name) ?></td>
            	<td><?= h($pilot->first_name." ".$pilot->last_name) ?></td>
                <td><?= h($flightSchedules->aircraft_id) ?></td>
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
