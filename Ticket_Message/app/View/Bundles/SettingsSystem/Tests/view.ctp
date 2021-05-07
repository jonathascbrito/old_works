<h2><?php echo $test['Test']['name']; ?></h2>

<div class="body">

    <p><?php echo $test['Test']['description']; ?></p>
    
    <br><br>
    

    <div class="form-actions right">
        <?php echo $this->App->createmodalbutton('Fechar', 'close'); ?>
    </div>

</div>