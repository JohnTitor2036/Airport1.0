<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pilot[]|\Cake\Collection\CollectionInterface $pilots
 */

$loguser = $this->request->getSession()->read( 'Auth.User' );
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li>
        <?php 
        if ($loguser) {
        	echo $this->Html->link(__('New Pilot'), ['action' => 'add'])."</li><li>";
        }
        ?>
        <li>
        <li><?= $this->Html->link(__('List Aircrafts'), ['controller' => 'Aircrafts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Airlines'), ['controller' => 'Airlines', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Hangars'), ['controller' => 'Hangars', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Flight Schedules'), ['controller' => 'FlightSchedules', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="pilots index large-9 medium-8 columns content">
    <h3><?= __('Pilots') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('licence_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('first_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('gender') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pilots as $pilot): ?>
            <tr>
                <td><?= h($pilot->licence_number) ?></td>
                <td><?= h($pilot->first_name) ?></td>
                <td><?= h($pilot->last_name) ?></td>
                <td><?= h($pilot->gender) ?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), ['action' => 'view', $pilot->slug])."&#8199;";
                    if ( $pilot->user_id === $loguser['id'] || $loguser['admin']) {
                    	echo $this->Html->link(__('Edit'), ['action' => 'edit', $pilot->slug])."&#8199;";
                    	echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $pilot->slug], ['confirm' => __('Are you sure you want to delete {0} {1}?', $pilot->first_name, $pilot->last_name)]);
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
