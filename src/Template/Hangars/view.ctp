<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Hangar $hangar
 */
$loguser = $this->request->getSession()->read( 'Auth.User' );
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li>
        <?php 
        if ($loguser) {
        	if ($hangar->user_id === $loguser['id'] || $loguser['admin']) {
        		echo $this->Html->link(__('Edit Hangar'), ['action' => 'edit', $hangar->slug])."</li><li>";
        		echo $this->Form->postLink(__('Delete Hangar'), ['action' => 'delete', $hangar->slug], ['confirm' => __('Are you sure you want to delete {0}?', $hangar->code)])."</li><li>";
        	}
        	echo $this->Html->link(__('New Hangar'), ['action' => 'add']);
        }
        ?>
        </li>
        <li><?= $this->Html->link(__('List Hangars'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('List Aircrafts'), ['controller' => 'Aircrafts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Airlines'), ['controller' => 'Airlines', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Flight Schedules'), ['controller' => 'FlightSchedules', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Pilots'), ['controller' => 'Pilots', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="hangars view large-9 medium-8 columns content">
    <h3>Hangar <?= h($hangar->code) ?></h3>
    <table class="vertical-table">
        <tr>
        <?php 
        if ( $loguser['admin']) {
    		echo '<th scope="row">';
 			echo __('User');
 			echo '</th>';
    		echo '<td>';
    		echo $hangar->has('user') ? $this->Html->link($hangar->user->username, ['controller' => 'Users', 'action' => 'view', $hangar->user->slug]) : '' ;
    		echo '</td>';
    	}
    	?>
        </tr>
        <tr>
            <th scope="row"><?= __('Code') ?></th>
            <td><?= h($hangar->code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hangar Size') ?></th>
            <td><?= h($hangar->hangar_size) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Detail') ?></th>
            <td><?= h($hangar->other_detail) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($hangar->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($hangar->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Aircrafts') ?></h4>
        <?php if (!empty($hangar->aircrafts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
            	<th scope="col"><?= __('Model') ?></th>
            	<th scope="col"><?= __('Hangar') ?></th>
                <th scope="col"><?= __('Airline Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($hangar->aircrafts as $aircrafts): ?>
            <tr>
            	<td><?= h($aircrafts->model) ?></td>
            	<td><?= h($hangar->code) ?></td>
                <td><?= h($aircrafts->airline_id) ?></td>
                <td class="actions">
                <?php echo $this->Html->link(__('View'), ['controller' => 'Aircrafts', 'action' => 'view', $aircrafts->slug])."&#8199;";
                	if ( $aircrafts->user_id === $loguser['id'] || $loguser['admin']) {
                		echo $this->Html->link(__('Edit'), ['controller' => 'Aircrafts', 'action' => 'edit', $aircrafts->slug])."&#8199;";
                		echo $this->Form->postLink(__('Delete'), ['controller' => 'Aircrafts', 'action' => 'delete', $aircrafts->slug], ['confirm' => __('Are you sure you want to delete {0}?', $aircrafts->model)]);
	                }?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
