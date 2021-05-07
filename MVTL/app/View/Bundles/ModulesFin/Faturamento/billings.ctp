<h2>Notas Fiscais</h2>

<div class="body">

    <h3>Contrato</h3>

    <?php $types = array('Êxito', 'Fixo', 'Fixo + êxito', 'Mensal', 'Mensal + êxito'); ?>

    <div class="control">
        <label><b>Número:</b></label><div class="intext"><?php echo $contract['Contract']['code_number'] . '/' . $contract['Contract']['code_year']; ?></div>
    </div>
    
    <div class="control">
        <label><b>Objeto:</b></label><div class="intext" style="width: 250px;"><?php echo $contract['Contract']['object']; ?></div>
    </div>
    
    <div class="control">
        <label><b>Tipo:</b></label><div class="intext"><?php echo $types[$contract['Contract']['type']]; ?></div>
    </div>
    
    <div class="control">
        <label><b>Entidade:</b></label><div class="intext"><?php echo $contract['Entity']['name']; ?></div>
    </div>
    
    <div class="control">
        <label><b>Vigência:</b></label><div class="intext"><?php echo $contract['Contract']['start']; ?> a <?php echo $contract['Contract']['end']; ?></div>
    </div>

    <div class="control">
        <label><b>Valor do Contrato:</b></label><div class="intext">R$ <?php echo number_format($contract['Contract']['value'], 2, ',', '.'); ?></div>
    </div>
    
    <br><br><br><h3>Notas Fiscais</h3>

    <table class="table" style="width: 100%;">
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
                <td>R$ <?php echo number_format($billing['value'], 2, ',', '.'); ?></td>
                <td><?php echo $billing['date']; ?></td>
                <td style="text-align: right;">
                    <?php echo $this->App->createmodalbutton('Editar', 'open', '/modules/fin/faturamento/update/' . $contract['Contract']['id'] . '/' . $billing['id']); ?>
                </td>
            </tr>

            <?php } ?>
        </tbody>
    </table>

    
    <div class="form-actions right">
        <?php echo $this->App->createmodalbutton('Fechar', 'close'); ?>
    </div>
</div>