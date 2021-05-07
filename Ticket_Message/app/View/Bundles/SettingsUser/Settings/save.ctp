<h2>Salvar Configurações</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>As alterações foram salvas com sucesso!</p>
    <?php else : ?>
        <p>As senhas digitadas não conferem!</p>
    <?php endif; ?>

    <div class="form-actions right">
        <?php echo $this->App->createmodalbutton('Fechar', 'close'); ?>
    </div>
</div>