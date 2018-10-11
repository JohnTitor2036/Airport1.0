<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Aircraft[]|\Cake\Collection\CollectionInterface $aircrafts
 */

$loguser = $this->request->getSession()->read( 'Auth.User' );
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li>
        <?php 
        if ($loguser) {
        	echo $this->Html->link(__('New Aircraft'), ['action' => 'add'])."</li><li>";
        }
        ?>
        </li>
        <li><?= $this->Html->link(__('List Airlines'), ['controller' => 'Airlines', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Hangars'), ['controller' => 'Hangars', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Flight Schedules'), ['controller' => 'FlightSchedules', 'action' => 'index']) ?></li>
    	<li><?= $this->Html->link(__('List Pilots'), ['controller' => 'Pilots', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="aircrafts index large-9 medium-8 columns content">
    <h3><?= __('Aircrafts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
          		<th scope="col"><?= $this->Paginator->sort('model') ?></th>
                <th scope="col"><?= $this->Paginator->sort('airline_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hangar_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($aircrafts as $aircraft): ?>
            <tr>
           		<td><?= h($aircraft->model) ?></td>
                <td><?= $aircraft->has('airline') ? $this->Html->link($aircraft->airline->airline_name, ['controller' => 'Airlines', 'action' => 'view', $aircraft->airline->slug]) : '' ?></td>
                <td><?= $aircraft->has('hangar') ? $this->Html->link($aircraft->hangar->code, ['controller' => 'Hangars', 'action' => 'view', $aircraft->hangar->slug]) : '' ?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), ['action' => 'view', $aircraft->slug])."&#8199;";
	                if ( $aircraft->user_id === $loguser['id'] || $loguser['admin']) {
	                	echo $this->Html->link(__('Edit'), ['action' => 'edit', $aircraft->slug])."&#8199;";
                		echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $aircraft->slug], ['confirm' => __('Are you sure you want to delete {0}?', $aircraft->model)]);
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
