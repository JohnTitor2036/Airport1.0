<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FlightSchedule[]|\Cake\Collection\CollectionInterface $flightSchedules
 */

$loguser = $this->request->getSession()->read( 'Auth.User' );
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li>
        <?php 
        if ($loguser) {
        	echo $this->Html->link(__('New Flight Schedule'), ['action' => 'add'])."</li><li>";
        }
        ?>
        </li>
        <li><?= $this->Html->link(__('List Aircrafts'), ['controller' => 'Aircrafts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Airlines'), ['controller' => 'Airlines', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Hangars'), ['controller' => 'Hangars', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Pilots'), ['controller' => 'Pilots', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="flightSchedules index large-9 medium-8 columns content">
    <h3><?= __('Flight Schedules') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
            	<th scope="col"><?= $this->Paginator->sort('flight_name', "Flight Code") ?></th>
                <th scope="col"><?= $this->Paginator->sort('aircraft_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pilot_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('event_type') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($flightSchedules as $flightSchedule): ?>
            <tr>
            	<td><?= h($flightSchedule->flight_name) ?></td>
                <td><?= $flightSchedule->has('aircraft') ? $this->Html->link($flightSchedule->aircraft->model, ['controller' => 'Aircrafts', 'action' => 'view', $flightSchedule->aircraft->slug]) : '' ?></td>
                <?php $name = $flightSchedule->pilot->first_name ?>
                <?php $name .= " " ?>
                <?php $name .= $flightSchedule->pilot->last_name ?>
                <td><?= $flightSchedule->has('pilot') ? $this->Html->link($name, ['controller' => 'Pilots', 'action' => 'view', $flightSchedule->pilot->slug]) : '' ?></td>
                <td><?= h($flightSchedule->event_type) ?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), ['action' => 'view', $flightSchedule->slug])."&#8199;";
                    if ( $flightSchedule->user_id === $loguser['id'] || $loguser['admin']) {
                    	echo $this->Html->link(__('Edit'), ['action' => 'edit', $flightSchedule->slug])."&#8199;";
                    	echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $flightSchedule->slug], ['confirm' => __('Are you sure you want to delete {0}?', $flightSchedule->flight_name)]);
	                }?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
