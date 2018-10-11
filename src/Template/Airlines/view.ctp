<?php
use Cake\ORM\TableRegistry;
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Airline $airline
 */
$loguser = $this->request->getSession()->read( 'Auth.User' );
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li>
        <?php 
        if ($loguser) {
        	if ($airline->user_id === $loguser['id'] || $loguser['admin']) {
        		echo $this->Html->link(__('Edit Airline'), ['action' => 'edit', $airline->slug])."</li><li>";
        		echo $this->Form->postLink(__('Delete Airline'), ['action' => 'delete', $airline->slug], ['confirm' => __('Are you sure you want to delete {0}?', $airline->airline_name)])."</li><li>";
        	}
        	echo $this->Html->link(__('New Airline'), ['action' => 'add']);
        }
        ?>
        </li>
        <li><?= $this->Html->link(__('List Airlines'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('List Aircrafts'), ['controller' => 'Aircrafts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Hangars'), ['controller' => 'Hangars', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Flight Schedules'), ['controller' => 'FlightSchedules', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Pilots'), ['controller' => 'Pilots', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="airlines view large-9 medium-8 columns content">
    <h3><?= h($airline->airline_name) ?></h3>
    <table class="vertical-table">
    	<tr>
    	<?php 
    	if ( $loguser['admin']) {
    		echo '<th scope="row">';
 			echo __('User');
 			echo '</th>';
    		echo '<td>';
    		echo $airline->has('user') ? $this->Html->link($airline->user->username, ['controller' => 'Users', 'action' => 'view', $airline->user->slug]) : '';
    		echo '</td>';
    	}
    	?>
   		</tr>
        <tr>
            <th scope="row"><?= __('Airline Name') ?></th>
            <td><?= h($airline->airline_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country') ?></th>
            <td><?= h($airline->country) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other Detail') ?></th>
            <td><?= h($airline->other_detail) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($airline->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($airline->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Logo') ?></th>
            <td>
            <?php
            $files = TableRegistry::get('files');
            $file = $files
            ->find()
            ->where(['airline_id =' => $airline->id])
            ->first();
            if ($file != null) {
            	$file->airline_id = $airline->id;
            	echo '<img src="../../webroot/'.h($file->path.$file->name).'" width="300px"';
            } else {
            	echo __("No logo");
            }
            ?>
            </td>
        </tr>
    </table>
    <div class="related">
    	<h4><?= __('Related Aircrafts') ?></h4>
        <?php if (!empty($airline->aircrafts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
            	<th scope="col"><?= __('Model') ?></th>
                <th scope="col"><?= __('Airline') ?></th>
                <th scope="col"><?= __('Hangar Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($airline->aircrafts as $aircrafts): ?>
            <tr>
            	<td><?= h($aircrafts->model) ?></td>
                <td><?= h($airline->airline_name) ?></td>
                <td><?= h($aircrafts->hangar_id) ?></td>
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
