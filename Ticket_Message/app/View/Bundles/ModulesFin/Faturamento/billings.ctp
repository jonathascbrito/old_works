<h2>Notas Fiscais</h2>

<div class="body">

    <h3>Contrato</h3>

    <?php $types = array('Êxito', 'Fixo', 'Fixo + êxito', 'Mensal', 'Mensal + êxito'); ?>

    <b>Número:</b> <?php echo $contract['Contract']['code_number'] . '/' . $contract['Contract']['code_year']; ?><br>
    <b>Tipo:</b> <?php echo $types[$contract['Contract']['type']]; ?><br>
    <b>Entidade:</b> <?php echo $contract['Entity']['name']; ?>

    <br><br><br><h3>Notas Fiscais</h3>

    <table class="table">
        <thead>
            <tr>
                <th>Número</th>
                <th>Estado</th>
                <th>Valor</th>
                <th>Data</th>
                <th><?php echo $this->App->createmodalbutton('Nova Nota Fiscal', 'open', '/modules/fin/faturamento/create/' . $contract['Contract']['id']); ?></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($contract['Billings'] as $billing) { ?>

            <tr>
                <td><?php echo $billing['number']; ?></td>
                <td><?php echo $billing['state']; ?></td>
                <td><?php echo $billing['value']; ?></td>
                <td><?php echo $billing['date']; ?></td>
                <td><?php echo $this->App->createmodalbutton('Editar Nota Fiscal', 'open', '/modules/fin/faturamento/update/' . $contract['Contract']['id'] . '/' . $billing['id']); ?></td>
            </tr>

            <?php } ?>
        </tbody>
    </table>

    
    <div class="form-actions right">
        <?php echo $this->App->createmodalbutton('Fechar', 'close'); ?>
    </div>
</div>