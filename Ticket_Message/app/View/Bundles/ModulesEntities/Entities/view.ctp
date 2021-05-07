<h2>Editar Entidade</h2>

<div class="body">
        <b>Empresa:</b><br>
        <p><?php echo $entity['Entity']['name']; ?></p>
        
        <br><br>
        
        <b>Contato:</b><br>
        <p><?php echo $entity['Entity']['contact']; ?></p>

        <br><br>
        
        <b>E-mail:</b><br>
        <p><?php echo $entity['Entity']['email']; ?></p>

        <br><br>
        
        <b>Telefone:</b><br>
        <p><?php echo $entity['Entity']['phone']; ?></p>
        
        <br><br>
        
        <b>Celular:</b><br>
        <p><?php echo $entity['Entity']['cellphone']; ?></p>
        
        <br><br>

        <b>Endereço:</b><br>
        <p><?php echo $entity['Entity']['address']; ?></p>
       
        <br><br>
        
        <?php if($entity['Systems']){ ?>
        <br><b>Sistemas:</b><br>

        <div class="systems">
        <?php foreach($entity['Systems'] as $systems){ ?>
            <p><?php echo $systems['name']; ?></p>
        <?php } ?>
        </div>
    <?php } ?>
        


        <div class="form-actions right">
            <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
        </div>
</div>