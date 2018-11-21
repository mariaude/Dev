<h1>Login</h1>
<div class="users form large-6 medium-2 columns content" style="width: 100%; padding-right: 25%;padding-left: 25%;">
<?= $this->Form->create() ?>

<?= $this->Form->control('email') ?>
<?= $this->Form->control('password') ?>
<?= $this->Form->button('Connexion') ?>


<?= $this->Html->link(__('Reset password'), ['controller' => 'Users', 'action' => 'sendPasswordLink']) ?>
<?= $this->Form->end() ?>
</div>