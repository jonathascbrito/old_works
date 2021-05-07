<h2>Editar Entidade</h2>

<div class="body">
    <?php if (isset($success)) : ?>
        <p>A entidade <?php echo $this->request->data['Entity']['name']; ?> foi atualizada com sucesso!</p>

        <div class="form-actions right">
            <?php
                $this->App->setattribute('onclick', 'window.location.reload();');
                echo $this->App->createbutton('Fechar');
            ?>
        </div>
    <?php else : ?>
        <form id="update" method="put">

            <?php echo $this->App->createinput('', 'Entity.id', 'hidden'); ?>
			<?php echo $this->App->createinput('', 'Entity.Grupo.number', 'hidden'); ?>

            <?php echo $this->App->createinput('Nome', 'Entity.name'); ?>

            <?php
                $this->App->setattribute('onchange', 'EntityType();');
                $this->App->setattribute('options', array('Gr' => 'Grupo', 'Pf' => 'Pessoa Física', 'Pj' => 'Pessoa Jurídica'));
                echo $this->App->createinput('Tipo', 'Entity.type', 'radio');
            ?>

			<div id="EntityFields">
            <?php
                $this->App->setattribute('input-mask', '999\.999\.999\-99');
                echo $this->App->createinput('CPF', 'Entity.Pf.number');
            ?>

            <?php
                $this->App->setattribute('input-mask', '99\.999\.999\/9999\-99');
                echo $this->App->createinput('CNPJ', 'Entity.Pj.number');
            ?>

            <?php echo $this->App->createinput('Contato', 'Entity.contact'); ?>

            <?php echo $this->App->createinput('E-mail', 'Entity.email'); ?>

            <?php
                $this->App->setattribute('input-mask', '\(99\)\ 9999\-9999');
                echo $this->App->createinput('Telefone', 'Entity.phone');
            ?>
            <?php
                $this->App->setattribute('input-mask', '\(99\)\ 9999\-9999');
                echo $this->App->createinput('Celular', 'Entity.cellphone');
            ?>
            <?php
                $this->App->setattribute('input-mask', '\(99\)\ 9999\-9999');
                echo $this->App->createinput('Fax', 'Entity.fax');
            ?>

            <?php
                $this->App->setattribute('input-mask', '99\/99');
                echo $this->App->createinput('Aniversário', 'Entity.birthday');
            ?>

            <?php
                echo $this->App->createinput('', 'Entity.entity_id', 'hidden');

                $this->App->setattributes(array(
                    'autocomplete-for' => 'EntityEntityId',
                    'autocomplete-source' => $this->App->createurl('/modules/entities/qentities')
                ));

                echo $this->App->createinput('Grupo', 'Entity.entity_id_name');
            ?>

            <?php
                echo $this->App->createinput('', 'Entity.organizational_structure_id', 'hidden');

                $this->App->setattributes(array(
                    'autocomplete-for' => 'EntityOrganizationalStructureId',
                    'autocomplete-source' => $this->App->createurl('/modules/entities/qorganizational_structure')
                ));

                echo $this->App->createinput('Nível Organizacional', 'Entity.organizational_structure_id_name');
            ?>

            <?php echo $this->App->createinput('Endereço', 'Entity.address', 'textarea'); ?>

			</div>

			
            <div class="form-actions right">
                <?php echo $this->App->createmodalbutton('Cancelar', 'close'); ?>
                <?php
                    $this->App->setAttribute('modal-data', 'update');
                    echo $this->App->createmodalbutton('Salvar', 'open', '/modules/entities/update/' . $id);
                ?>
            </div>
			
			
			<script type="text/javascript">
                var EntityType = function () {
                    var pf = $('EntityTypePf').get('checked');
                    var pj = $('EntityTypePj').get('checked');

					if (! pf && ! pj) {
						$('EntityFields').addClass('hide');
					}else{
						$('EntityFields').removeClass('hide');
						$("EntityContact").getParent().toggleClass("hide", ! pj);
						$("EntityPjNumber").getParent().toggleClass("hide", ! pj);
						$("EntityPfNumber").getParent().toggleClass("hide", ! pf);
					}

                    app.modal.resize();
                };

                app.onupdate = EntityType;
            </script>
			
        </form>
    <?php endif; ?>
</div>