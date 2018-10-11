<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Airline[]|\Cake\Collection\CollectionInterface $airlines
 */
use Cake\ORM\TableRegistry;

$loguser = $this->request->getSession()->read( 'Auth.User' );
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li>
        <?php 
        if ($loguser) {
        	echo $this->Html->link(__('New Airline'), ['action' => 'add'])."</li><li>";
        }
        ?>
        </li>
        <li><?= $this->Html->link(__('List Aircrafts'), ['controller' => 'Aircrafts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Hangars'), ['controller' => 'Hangars', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Flight Schedules'), ['controller' => 'FlightSchedules', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Pilots'), ['controller' => 'Pilots', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="airlines index large-9 medium-8 columns content">
    <h3><?= __('Airlines') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('airline_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('country') ?></th>
                <th scope="col"><?= $this->Paginator->sort('logo') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($airlines as $airline): ?>
            <tr>
                <td><?= h($airline->airline_name) ?></td>
                <td><?= h($airline->country) ?></td>
                <td>
	            <?php
	            $files = TableRegistry::get('files');
	            $file = $files
	            ->find()
	            ->where(['airline_id =' => $airline->id])
	            ->first();
	            if ($file != null) {
	            	$file->airline_id = $airline->id;
	            	echo '<img src="webroot/'.h($file->path.$file->name).'" width="100px"';
	            } else {
	            	echo "Aucun logo";
	            }
	            ?>
	            </td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), ['action' => 'view', $airline->slug])."&#8199;";
                    if ( $airline->user_id === $loguser['id'] || $loguser['admin']) {
                    	echo $this->Html->link(__('Edit'), ['action' => 'edit', $airline->slug])."&#8199;";
                    	echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $airline->slug], ['confirm' => __('Are you sure you want to delete {0}?', $airline->airline_name)]);
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
