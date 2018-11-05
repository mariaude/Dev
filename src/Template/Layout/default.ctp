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
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
$loguser = $this->request->getSession()->read('Auth.User');
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>
        <div class="top-bar-section">

            <ul class="left">
                <?php if($loguser['role'] == 'admin'):
                    
                    ?>
                <li><?= $this->Html->link(__('Offres de stage'), ['controller' => 'Internships', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('Étudiants'), ['controller' => 'Students', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('Entreprises'), ['controller' => 'Enterprises', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('Candidatures'), ['controller' => 'Candidacies', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('Convocations'), ['controller' => 'Convocations', 'action' => 'index']) ?></li>
                <?php elseif($loguser['enterprise']['active'] == 1):?>
                    <li><?= $this->Html->link(__('Offres de stage'), ['controller' => 'Internships', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link(__('Candidatures'), ['controller' => 'Candidacies', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link(__('Convocations'), ['controller' => 'Convocations', 'action' => 'index']) ?></li>

                <?php elseif($loguser['enterprise']['student'] == 1):?>
                    <li><?= $this->Html->link(__('Offres de stage'), ['controller' => 'Internships', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link(__('Entreprises'), ['controller' => 'Enterprises', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link(__('Candidatures'), ['controller' => 'Candidacies', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link(__('Convocations'), ['controller' => 'Convocations', 'action' => 'index']) ?></li>

                <?php endif;?>


            </ul>
            <ul class="right">
            <?php
                        
                        
                        if ($loguser) {
                            $user = $loguser['email'];
                            echo '<li>'.$this->Html->link($user . ' logout', ['controller' => 'Users', 'action' => 'logout']).'</li>';
                        } else {
                            echo '<li>'.$this->Html->link('Login', ['controller' => 'Users', 'action' => 'login']).'</li>';
                            echo '<li>'.$this->Html->link('Register', ['controller' => 'Users', 'action' => 'add']).'</li>';
                        }
                        ?>
                <li><a target="_blank" href="https://book.cakephp.org/3.0/">Documentation</a></li>
                <li><a target="_blank" href="https://api.cakephp.org/3.0/">API</a></li>
            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
