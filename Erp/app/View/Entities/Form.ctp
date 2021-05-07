<?php

$this->start( 'script' );
echo $this->Html->script( 'mvtl.form' );
echo $this->Html->script( 'mvtl.entities' );
$this->end( );

?>

<h2><?php print $controller_name; ?> &rarr; <?php print $controller_action; ?></h2>

<div id="breadcrumb">

    <div id="links">
         <?php
            echo $this->Html->link( "Ajuda",
                array(
                    "controller"    => "pages",
                    "action"        => "help"
                ),
                array(
                    "class"         => array(
                        "help"
                    )
                )
            );
        ?>
        <div class="sep"></div>

        <?php print $this->element('settings-link'); ?>

    </div>

    <?php
        echo $this->Html->link( "Home",
            array(
                "controller"    => "pages",
                "action"        => "home"
            ),
            array(
                "class"         => array(
                    "home"
                )
            )
        );
    ?>
    <div class="arrow"></div>
    <?php
        echo $this->Html->link( "Entidades",
            array(
                "controller"    => "entities",
                "action"        => "index"
            )
        );
    ?>
    <div class="arrow"></div>
    <?php
        echo $this->Html->link( "Adicionar",
            array(
                "controller"    => "entities",
                "action"        => "add"
            )
        );
    ?>
</div>

<div class="description">
    Utilize esta página para adicionar uma nova entidade ao sistema. O cadastro de entidades permite um gerenciamento unificado dos colaboradores, clientes e fornecedores do escritório independente de sua natureza.
</div>

<div class="content">

<?php echo $this->Session->flash( ); ?>

<?php
    echo $this->Form->create
    (
        "Entity",
        array
        (
            "class" => "form-horizontal"
        )
    );

    if ( isset( $id ) )
    {
        echo $this->Form->input(
            "Entity.id",
            array
            (
                "type" => "hidden",
                "value" => $id
            )
        );
    }
?>

<fieldset>
<legend>Informações Básicas</legend>

<div class="control-group">
    <label class="control-label" for="EntityName">Nome/Razão Social</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Entity.name",
                array
                (
                    "div" => false,
                    "label" => false
                )
            );
        ?>

        <span class="help-block">Informe o nome ou razão social da entidade</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="EntityType">Tipo</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Entity.type",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type"  => "select",
                    "options" => array
                    (
                        "Pessoa Física" => "Pessoa Física",
                        "Pessoa Jurídica" => "Pessoa Jurídica"
                    )
                )
            );
        ?>

        <span class="help-block">Informe a natureza da entidade (pessoa física ou jurídica)</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="EntityNumber">CPF/CNPJ</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Entity.number",
                array
                (
                    "div" => false,
                    "label" => false
                )
            );
        ?>

        <span class="help-block">Informe o CPF/CNPJ da entidade</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="EntityEntityId">Vínculo Econômico</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Entity.entity_id",
                array
                (
                    "div" => false,
                    "label" => false,
                    "empty" => true,
                    "empty" => "selecione..."
                )
            );
        ?>

        <span class="help-block">Selecione o vínculo econômico, se houver</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label">Relações</label>

    <div class="controls">
        <label for="EntityOwner">
            <?php
                echo $this->Form->input
                (
                    "Entity.owner",
                    array
                    (
                        "div" => false,
                        "label" => false,
                        "type" => "checkbox"
                    )
                );
            ?>
            Sócio
        </label>

        <label for="EntityPartner">
            <?php
                echo $this->Form->input
                (
                    "Entity.partner",
                    array
                    (
                        "div" => false,
                        "label" => false,
                        "type" => "checkbox"
                    )
                );
            ?>
            Advogado Associado
        </label>

        <label for="EntityRepresentant">
            <?php
                echo $this->Form->input
                (
                    "Entity.representant",
                    array
                    (
                        "div" => false,
                        "label" => false,
                        "type" => "checkbox"
                    )
                );
            ?>
            Representante
        </label>

        <label for="EntityEmployee">
            <?php
                echo $this->Form->input
                (
                    "Entity.employee",
                    array
                    (
                        "div" => false,
                        "label" => false,
                        "type" => "checkbox"
                    )
                );
            ?>
            Colaborador
        </label>

        <label for="EntitySupplier">
            <?php
                echo $this->Form->input
                (
                    "Entity.supplier",
                    array
                    (
                        "div" => false,
                        "label" => false,
                        "type" => "checkbox"
                    )
                );
            ?>
            Fornecedor
        </label>

        <label for="EntityClient">
            <?php
                echo $this->Form->input
                (
                    "Entity.client",
                    array
                    (
                        "div" => false,
                        "label" => false,
                        "type" => "checkbox"
                    )
                );
            ?>
            Cliente
        </label>

        <span class="help-block">Selecione os tipos de relação da entidade com o escritório. Entidades com mais de uma relação devem ser cadastradas apenas uma vez.</span>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="EntityOrganizationalUnitId">Vínculo Organizacional</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Entity.organizational_unit_id",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type"  => "select",
                    "empty" => "selecione..."
                )
            );
        ?>

        <span class="help-block">Informe a natureza da entidade (pessoa física ou jurídica)</span>
    </div>
</div>

</fieldset>

<fieldset>
<legend>Informações de Contatos</legend>

<div class="form-inline">
<div class="control-group">
    <label class="control-label" for="EntityPhoneCountry">Telefone</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Entity.phone_country",
                array
                (
                    "div" => false,
                    "label" => false,
                    "class" => array
                    (
                        "span1"
                    ),
                    "placeholder" => "País"
                )
            );
        ?>

        <?php
            echo $this->Form->input
            (
                "Entity.phone_area",
                array
                (
                    "div" => false,
                    "label" => false,
                    "class" => array
                    (
                        "span1"
                    ),
                    "placeholder" => "Área"
                )
            );
        ?>

        <?php
            echo $this->Form->input
            (
                "Entity.phone_number",
                array
                (
                    "div" => false,
                    "label" => false,
                    "class" => array
                    (
                        "span2"
                    ),
                    "placeholder" => "Número"
                )
            );
        ?>

        <?php
            echo $this->Form->input
            (
                "Entity.phone_branch",
                array
                (
                    "div" => false,
                    "label" => false,
                    "class" => array
                    (
                        "span1"
                    ),
                    "placeholder" => "Ramal"
                )
            );
        ?>
    </div>
</div>

</div>

</fieldset>

<fieldset>
    <legend>Endereço</legend>

<div class="control-group">
    <label class="control-label" for="EntityAddressStreet">Logradouro</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Entity.address_street",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type"  => "textarea",
                    "rows" => "3"
                )
            );
        ?>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="EntityAddressN">Nº</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Entity.address_n",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type"  => "text"
                )
            );
        ?>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="EntityAddressComp">Complemento</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Entity.address_comp",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type"  => "textarea"
                )
            );
        ?>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="EntityAddressCep">CEP</label>

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Entity.address_cep",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type"  => "text"
                )
            );
        ?>
    </div>
</div>

<div class="control-group">

    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Entity.address_bairro",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type"  => "text",
                    "placeholder" => "Bairro",
                    "class" => array
                    (
                        "span2"
                    )
                )
            );
        ?>

        <?php
            echo $this->Form->input
            (
                "Entity.address_city",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type"  => "text",
                    "placeholder" => "Cidade",
                    "class" => array
                    (
                        "span2"
                    )
                )
            );
        ?>
    </div>
</div>

<div class="control-group">
    <div class="controls">
        <?php
            echo $this->Form->input
            (
                "Entity.address_estate",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type"  => "text",
                    "placeholder" => "Estado",
                    "class" => array
                    (
                        "span2"
                    )
                )
            );
        ?>

        <?php
            echo $this->Form->input
            (
                "Entity.address_country",
                array
                (
                    "div" => false,
                    "label" => false,
                    "type"  => "text",
                    "placeholder" => "País",
                    "class" => array
                    (
                        "span2"
                    )
                )
            );
        ?>
    </div>
</div>

</fieldset>

<div class="form-actions">
    <button type="submit" class="btn btn-primary">Salvar</button>
    <button type="button" class="btn">Cancelar</button>
</div>

<?php echo $this->Form->end( ); ?>

</div>