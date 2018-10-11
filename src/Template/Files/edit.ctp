<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File $file
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Airlines'), ['controller' => 'Airlines', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Aircrafts'), ['controller' => 'Aircrafts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Hangars'), ['controller' => 'Hangars', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Flight Schedules'), ['controller' => 'FlightSchedules', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Pilots'), ['controller' => 'Pilots', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="airlines form large-9 medium-8 columns content">
    <?= $this->Flash->render() ?>
    <div class="upload-frm">
        <?php echo $this->Form->create($file, ['type' => 'file']); ?>
        <fieldset>
        <legend><?= __("#2 Edit the logo (Not obligatory)") ?></legend>
            <?php echo $this->Form->control('file', ['type' => 'file', 'class' => 'form-control']); ?>
            <?php echo $this->Form->button(__('Done'), ['type'=>'submit', 'class' => 'form-controlbtn btn-default']); ?>
        </fieldset>
        <?php echo $this->Form->end(); ?>
        <?php echo $this->Form->postButton('Delete the logo', ['controller' => 'files', 'action' => 'delete', $this->request->getParam('pass.0')]); ?>
    </div>
</div>