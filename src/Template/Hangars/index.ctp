<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Hangar[]|\Cake\Collection\CollectionInterface $hangars
 */

$loguser = $this->request->getSession()->read( 'Auth.User' );
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li>
        <?php 
        if ($loguser) {
        	echo $this->Html->link(__('New Hangar'), ['action' => 'add'])."</li><li>";
        }
        ?>
        </li>
        <li><?= $this->Html->link(__('List Aircrafts'), ['controller' => 'Aircrafts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Airlines'), ['controller' => 'Airlines', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Flight Schedules'), ['controller' => 'FlightSchedules', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Pilots'), ['controller' => 'Pilots', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="hangars index large-9 medium-8 columns content">
    <h3><?= __('Hangars') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hangar_size') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hangars as $hangar): ?>
            <tr>
                <td><?= h($hangar->code) ?></td>
                <td><?= h($hangar->hangar_size) ?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), ['action' => 'view', $hangar->slug])."&#8199;";
                    if ( $hangar->user_id === $loguser['id'] || $loguser['admin']) {
                    	echo $this->Html->link(__('Edit'), ['action' => 'edit', $hangar->slug])."&#8199;";
                    	echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $hangar->slug], ['confirm' => __('Are you sure you want to delete {0}?', $hangar->code)]);
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
