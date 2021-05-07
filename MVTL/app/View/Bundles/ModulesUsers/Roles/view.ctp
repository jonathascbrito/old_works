<h2><?php echo $role['Role']['name']; ?></h2>

<div class="body">

    <p><?php echo $role['Role']['description']; ?></p>
    
    <br><br>
    
    <b>Usuários:</b><br>
    <?php foreach ($role['Users'] as $user) { ?>
    
        <?php echo $user['name']; ?><br>
    
    <?php } ?>

    <div class="form-actions right">
        <?php echo $this->App->createmodalbutton('Fechar', 'close'); ?>
    </div>

</div>