/**
 * Cria o módulo autocomplete na aplicação.
 */
app.autocomplete = app.__module();

/**
 * Cria os elementos utilizados pelo módulo autocomplete.
 *
 * @returns null
 */
app.autocomplete.load = function()
{
    this.input = false;
    this.field = false;

    this.suggestions = new Element('div.autocomplete');
    this.suggestions.inject(document.body, 'bottom');
};

/**
 * Calcula a posição das sugestões sempre que a janela é redimensionada.
 *
 * @returns null
 */
app.autocomplete.resize = function()
{
    if ( ! this.input) {
        return;
    }

    var size = this.input.getSize();
    var position = this.input.getPosition();

    this.suggestions.setStyles({
        'top': position.y+size.y,
        'left': position.x,
        'width': this.input.get('autocomplete-for') == 'TicketTicketDeviceId' ? '290px' : size.x-2
    });
};

/**
 * Analisa uma parte da interface adicionando os eventos necessários para campos
 * com a propriedade autocomplete.
 *
 * @param mixed context
 * @returns null
 */
app.autocomplete.parse = function(context)
{
    app.find('[autocomplete-source]', context).addEvents({
        'keyup': function(event) {
            var field = this.get('autocomplete-for') ? '#' + this.get('autocomplete-for') : this;
            var ainfo = this.get('autocomplete-info') ? this.get('autocomplete-info') : null;

            var ignore = ['left', 'right', 'shift', 'alt', 'ctrl', 'capslock'];
            var events = ['esc', 'enter', 'up', 'down'];

            if (ignore.indexOf(event.key) !== -1) return;
            if (events.indexOf(event.key) !== -1) {
                return app.autocomplete['handle' + event.key].call(this);
            }

            app.autocomplete.input = this;
            app.autocomplete.field = field;

            if (ainfo) {
                ainfo = eval(ainfo);
            }

            app.find(field).set('value', '');
            app.request(this.get('autocomplete-source'), 'post',
                {
                    'q': this.get('value'),
                    'i': ainfo
                },
                function(status, data) {
                    app.autocomplete.handle(status, data);
                }
            );
        },
        'keydown': function(event) {
            if (event.key === 'up' || event.key === 'down') {
                return false;
            }
        },
        'blur': app.autocomplete.handleblur
    });
};

/**
 * Trata os dados retornados pela url especificada pela propriedade
 * autocomplete-source. Os dados devem ser retornados no formato json
 * {value:display}.
 *
 * @param string status
 * @param mixed data
 * @returns null
 */
app.autocomplete.handle = function(status, data)
{
    this.suggestions.set('html', '');
    this.suggestions.toggleClass('show', true);
    //@todo: handle errors

    if (status === 'success') {
        var data = JSON.decode(data);

        if (data.length === 0) {
            this.suggestions.set('html', '<span>nenhum item encontrado...</span>');
            return;
        }

        for (var value in data) {
            this.suggestions.grab(new Element('a', {
                'href': value,
                'html': data[value],
                'events': {
                    'mousedown': app.autocomplete.handleclick
                }
            }));
        }
    }
    
    this.resize();
};

/**
 * Define o valor do campo ao disparar o evento blur.
 *
 * @param object event
 * @returns null
 */
app.autocomplete.handleblur = function(event)
{
    app.find('a', app.autocomplete.suggestions).each(function(suggestion){
        if (suggestion.get('html').toLowerCase() === app.autocomplete.input.get('value').toLowerCase()) {
            app.find(app.autocomplete.input).set('value', suggestion.get('html'));
            app.find(app.autocomplete.field).set('value', suggestion.get('href'));
        }
    });

    app.autocomplete.suggestions.toggleClass('show', false);
};

/**
 * Trata as sugestões quando a tecla esc é pressionada.
 *
 * @returns null
 */
app.autocomplete.handleesc = function()
{
    app.autocomplete.suggestions.toggleClass('show', false);
};

/**
 * Trata as sugestões quando a tecla enter é pressionada.
 *
 * @returns null
 */
app.autocomplete.handleenter = function()
{
    var selected = app.find('.selected', app.autocomplete.suggestions);

    if (selected.length === 1) {
        selected = selected[0];

        app.find(this).set('value', selected.get('html'));
        app.find(app.autocomplete.field).set('value', selected.get('href'));
        app.autocomplete.suggestions.toggleClass('show', false);
    }
};

/**
 * Trata as sugestões quando a tecla up é pressionada.
 *
 * @returns null
 */
app.autocomplete.handleup = function()
{
    var selected = app.find('.selected', app.autocomplete.suggestions);

    if (selected.length === 1) {
        selected = selected[0].getPrevious();
    }

    if ( ! selected || selected.length === 0 ) {
        selected = app.autocomplete.suggestions.getLast();
    }

    app.find('a', app.autocomplete.suggestions).toggleClass('selected', false);
    app.find(selected).toggleClass('selected', true);
};

/**
 * Trata as sugestões quando a tecla down é pressionada.
 *
 * @returns null
 */
app.autocomplete.handledown = function()
{
    app.autocomplete.suggestions.toggleClass('show', true);

    var selected = app.find('.selected', app.autocomplete.suggestions);

    if (selected.length === 1) {
        selected = selected[0].getNext();
    }

    if ( ! selected || selected.length === 0 ) {
        selected = app.autocomplete.suggestions.getFirst();
    }

    app.find('a', app.autocomplete.suggestions).toggleClass('selected', false);
    app.find(selected).toggleClass('selected', true);
};

/**
 * Define o valor do campo a partir do evento click em uma sugestão.
 *
 * @returns null
 */
app.autocomplete.handleclick = function(event)
{
    event.stop();

    app.find(app.autocomplete.input).set('value', this.get('html'));
    app.find(app.autocomplete.field).set('value', this.get('href'));

    app.autocomplete.suggestions.toggleClass('show', false);
};