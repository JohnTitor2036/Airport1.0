<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 *
 * @var \App\View\AppView $this
 */
$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport"
	content="width=device-width, initial-scale=1.0">
<title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
	<nav class="top-bar expanded" data-topbar role="navigation">
		<ul class="title-area large-3 medium-4 columns">
			<li class="name">
				<h1>
					<a href=""><?= $this->fetch('title') ?></a>
				</h1>
			</li>
		</ul>
		<div class="top-bar-section">
			<ul class="right">
				<li>
				<?= $this->Html->link('Français', ['action' => 'changeLang', 'fr_CA'], ['escape' => false]) ?>
			</li>
				<li>
				<?= $this->Html->link('English', ['action' => 'changeLang', 'en_US'], ['escape' => false]) ?>
			</li>
				<li>
				<?= $this->Html->link('日本語', ['action' => 'changeLang', 'ja_JP'], ['escape' => false]) ?>
			</li>
				<li><?php
				$loguser = $this->request->getSession()->read( 'Auth.User' );
				if ( $loguser ) {
					$TheUser = $loguser['email'];
					$rank = "";
					if ( $loguser['admin'] ) {
						$rank = __( 'Administrator - ' );
					} else {
						$rank = __( 'Air traffic controller - ' );
					}
					echo $this->Html->link( $rank . $TheUser . ' Logout', [ 
							'controller'=>'Users', 'action'=>'logout'
					] );
					echo "</li><li>";
					echo $this->Html->link( __( 'My Profile' ), [ 
							'controller'=>'Users', 'action'=>'view', $loguser['slug']
					] );
					if ( $loguser['admin'] ) {
						echo "</li><li>";
						echo $this->Html->link( __( 'All the Users' ), [ 
								'controller'=>'Users', 'action'=>'index'
						] );
					}
				} else {
					echo $this->Html->link( __( 'Login' ), [ 
							'controller'=>'Users', 'action'=>'login'
					] );
					echo "</li><li>";
					echo $this->Html->link( __( 'Register' ), [ 
							'controller'=>'Users', 'action'=>'add'
					] );
				}
				echo "</li><li>";
				echo $this->Html->link( __( "About this app" ), [ 
						'controller'=>'App', 'action'=>'about'
				] );
				echo "</li><li>";
				?></li>
			</ul>
		</div>
	</nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
	<footer> </footer>
</body>
</html>
