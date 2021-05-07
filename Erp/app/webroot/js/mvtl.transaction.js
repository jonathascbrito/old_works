jQuery(

    function( $ )
    {

        function checkValues ( field )
        {
            if( ! $(field).length )
                return;

            var value = $(field).val().toString();
                value = value != '' ? value : '0';

            $(field).val(new Number(value.replace('.', '').replace(',', '.')).toMoney(2, ',', '.'));
        }

        function checkType ( )
        {
            var type = $('#TransactionType').val();

            if ( type == 'Entrada' )
            {
                $('#TransactionBudgetAccountIdIn').css('display', 'block');
                $('#TransactionBudgetAccountIdOut').css('display', 'none');
            }else{
                $('#TransactionBudgetAccountIdIn').css('display', 'none');
                $('#TransactionBudgetAccountIdOut').css('display', 'block');
            }
        }

        function checkResultsCenters ( )
        {
            $('.ResultsCenter').each(function(itens, resultscenter){

                resultscenter = $(resultscenter);
                resultscenter = resultscenter.children();

                $(resultscenter[0]).attr
                (
                    {
                        id: 'TransactionResultsCenter'+itens+'ResultsCenterId',
                        name: 'data[TransactionResultsCenter]['+itens+'][results_center_id]'
                    }
                );

                $(resultscenter[1]).attr
                (
                    {
                        id: 'TransactionResultsCenter'+itens+'Part',
                        name: 'data[TransactionResultsCenter]['+itens+'][part]'
                    }
                );
            });
        }

        function checkResultsCentersPart ( )
        {
            var total = 0;

            $('.ResultsCenter').each(function(itens, resultscenter){
                resultscenter = $(resultscenter);
                resultscenter = resultscenter.children();

                var value = $(resultscenter[1]).val().toString().replace('%', '');
                    value = value ? value : '100';
                    value = new Number(value);

                total += value;

                $(resultscenter[1]).addClass('span1').val(value + '%');
            });

            if (total != 100)
            {
                $('#TransactionResultsCenter0Part').tooltip('show');
            }
            else
            {
                $('#TransactionResultsCenter0Part').tooltip('hide');
            }
        }

        $('#TransactionResultsCenter0Part').tooltip({
            title    : 'A soma das porcentagens de rateio deve ser igual a 100%',
            trigger  : 'manual',
            placement: 'top'
        });

        $('#TransactionValue, #TransactionInterest, #TransactionFines, #TransactionDiscounts').change(function(event){
            checkValues( this );
        });

        $('#TransactionType').change(function(event){
            checkType();
        });

        $('#TransactionResultsCenter0Part').change(function(event){
            checkResultsCentersPart();
        });

        $('#addResultsCenter').click(function(event){
            event.preventDefault();

            var model = $(this).parent();
            var resultscenter = model.clone();

            resultscenter.children('input')
                .change(function(event){
                    checkResultsCentersPart();
                });

            resultscenter.children('a').children('i')
                .removeClass('icon-plus-sign')
                .addClass('icon-minus-sign').click(function(event){
                    event.preventDefault();

                    $(this).parent().parent().remove();
                    checkResultsCenters();
                });

            model.after(resultscenter);
            checkResultsCenters();
            checkResultsCentersPart();
        });

        checkValues('#TransactionValue');
        checkValues('#TransactionInterest');
        checkValues('#TransactionFines');
        checkValues('#TransactionDiscounts');

        checkType();
        checkResultsCentersPart();

    }

);