/**
 * Cria o módulo dropdown na aplicação.
 */
app.dropdown = app.__module();

/**
 * Registra o evento click em todo o documento. Sempre que o evento for disparado
 * vamos ocultar o dropdown.
 *
 * @returns null
 */
app.dropdown.load = function()
{
    app.find(document.body).addEvent('click', function (event) {
        app.dropdown.hide();
    });
};

/**
 * Analisa uma parte da interface e adiciona os eventos necessários para o
 * funcionamento do dropdown.
 *
 * @param mixed context
 * @returns null
 */
app.dropdown.parse = function(context) {
    app.find('[dropdown]', context).each(function(link) {
        var dropdown = '#' + link.get('dropdown');
            dropdown = app.find(dropdown)[0];

        var position = link.get('dropdown-position');

        dropdown.addClass(position);
        dropdown.grab(
            new Element('div.arrow'), position == 'bottom' ? 'top' : 'bottom'
        );

        link.addEvent('click', function(event) {
            event.stop();
            app.dropdown.hide();
            app.dropdown.show(link, dropdown, position);
        });
    });
};

/**
 * Exibe o dropdown associado ao link informado. Este método recebe os objetos
 * link e dropdown e não seus ids ou um seletor.
 *
 * @param object link
 * @param object dropdown
 * @param string position
 * @returns null
 */
app.dropdown.show = function(link, dropdown, position) {
    var linksize = link.getSize();
    var linkposition = link.getPosition();

    link.toggleClass('active', true);
    dropdown.toggleClass('show', true);

    var dropdownsize = dropdown.getSize();

    dropdown.setStyles(
        {
            'top': position == 'top' ?
                    linkposition.y - dropdownsize.y + 8 :
                    linkposition.y + linksize.y - 8,
            'left': linkposition.x + ( linksize.x - 200 ) + 8
        }
    );
};

/**
 * Esconde todos os dropdowns mapeados.
 *
 * @returns null
 */
app.dropdown.hide = function() {
    app.find('.dropdown').toggleClass('show', false);
    app.find('[dropdown]').toggleClass('active', false);
};