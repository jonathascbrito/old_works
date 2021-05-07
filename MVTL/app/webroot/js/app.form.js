/**
 * Cria o módulo form na aplicação.
 */
app.form = app.__module();

/**
 * Analisa uma parte da interface tratando campos de formulários com as
 * propriedades mask, autosize e campos dos tipos checkbox e radio.
 *
 * @params mixed context
 * @returns null
 */
app.form.parse = function(context)
{
    app.form.setMask(context);
    app.form.setToggles(context);
    app.form.setAutosize(context);
    app.form.radio(context);
    app.form.checkbox(context);
};

/**
 * Configura campos com a propriedade mask facilitando a inputação e validação
 * dos dados.
 *
 * @params mixed context
 * @returns null
 */
app.form.setMask = function(context)
{
    var masks = {
        'a' : /[a-z]/,
        '9' : /[0-9]/,
        '+' : /[-+]/,
        '-' : /[-+]/,
        '*' : /./
    };

    app.find('[input-mask]', context).each(function(input){
        var mask = input.get('input-mask');
        var parsed = [];

        var toescape = false;
        for (var l=0; l<mask.length; l++) {
            if ( mask[l] == '\\' ) {
                toescape = true;
                continue;
            }

            if ( ! toescape && typeof masks[mask[l]] != 'undefined' ) {
                parsed.push({'type':'regex', 'value':masks[mask[l]]});
            } else {
                parsed.push({'type':'marker', 'value':mask[l]});
                toescape = false;
            }
        }

        mask = parsed;

        /*input.addEvent('focus', function (event) {
            var value = this.get('value');
            var masked = '';

            if ( value.length > parsed.length )
                value = value.substr(0, parsed.length);

            var v = 0;
            while ( typeof mask[v] !== 'undefined' ) {

                if ( v >= value.length && mask[v].type != 'marker' ) {
                    break;
                }

                if ( mask[v].type == 'marker' ) {
                    masked += mask[v].value;
                }

                if ( mask[v].type == 'regex' ) {
                    masked += mask[v].value.test(value[v]) ? value[v] : '';
                }

                v++;
            }

            this.set('value', masked);
        });*/

        input.addEvent('keydown', function (event) {
            if (event.key == 'backspace'
            ||  event.key == 'delete'
            
            ||  event.key == 'shift'
            ||  event.key == 'ctrl'
            
            ||  event.key == 'tab') return true;
            
            var value = this.get('value');
            var v = value.length;
            
            if ( typeof mask[v] !== 'undefined' ) {
                if ( mask[v].type == 'marker' ) {
                    value += mask[v].value;
                }
            }

            this.set('value', value);
        });

        input.addEvent('keyup', function (event) {
            var value = this.get('value');
            var masked = '';

            if (event.key == 'backspace') return true;
            
            if ( value.length > parsed.length )
                value = value.substr(0, parsed.length);

            var v = 0;
            while ( typeof mask[v] !== 'undefined' ) {

                if ( v >= value.length /*&& mask[v].type != 'marker'*/ ) {
                    break;
                }

                if ( mask[v].type == 'marker' ) {
                    masked += mask[v].value;
                }

                if ( mask[v].type == 'regex' ) {
                    masked += mask[v].value.test(value[v]) ? value[v] : '';
                }

                v++;
            }

            this.set('value', masked);
        });
    });
};

/**
 * Configura campos com a propriedade toggle, utilizados para marcar ou desmarcar
 * diversos checkboxes de uma única vez.
 *
 * @params mixed context
 * @returns null
 */
app.form.setToggles = function(context)
{
    app.find('[toggle]', context).addEvent('click', function(event){
        var name = this.get("toggle");

        var toggles = app.find("[toggle='"+name+"']:not(:disabled)");
        var toggleall = app.find("[toggleall='"+name+"']");

        toggleall.set("checked", toggles.length == toggles.filter(":checked").length);
        toggleall.fireEvent("change");

        app.find("[togglecondition='"+name+"']").toggleClass('disabled', ! toggles.filter(":checked").length);
    });

    app.find('[toggleall]', context).addEvent('click', function(event){
        var name = this.get("toggleall");
        var toggles = app.find("[toggle='"+name+"']:not(:disabled)");

        toggles.set("checked", this.get("checked"));
        toggles.fireEvent("change");

        app.find("[togglecondition='"+name+"']").toggleClass('disabled', ! this.get("checked"));
    });

    app.find("[togglecondition]").each(function (element){
        var name = element.get("togglecondition");
        var toggles = app.find("[toggle='"+name+"']:not(:disabled)");

        element.toggleClass('disabled', ! toggles.filter(":checked").length);
    });
};

/**
 * Configura campos com a propriedade autosize. Estes campos alteram seu tamanho
 * ao seram clicados.
 *
 * @params mixed context
 * @returns null
 */
app.form.setAutosize = function(context)
{
    app.find('[autosize]', context).each(function(input) {
        var size = input.getStyle('width');
        var newsize = input.get('autosize');

        input.addEvents({
            'focus': function(event) {
                input.set('tween', {duration: 'normal'});
                input.tween('width', newsize);
            },
            'blur': function(event) {
                input.set('tween', {duration: 'normal'});
                input.tween('width', size);
            }
        });
    });
};

app.form.radio = function (context)
{
    app.find('input[type=radio]', context).each(function(radio){
        var fancyradio = new Element('div', {'class': 'app-radio'});

        fancyradio.addEvent('click', function(event){
            if(typeof event !== 'undefined') event.stop();
            if(radio.get('disabled')) return;

            radio.set('checked', !radio.get('checked'));
            radio.fireEvent('click');
            radio.fireEvent('change');
        });

        radio.addEvent('change', function(event){
            $$("input[type=radio][name='" + this.get('name') + "']").each(function(radio){
                radio.retrieve('fancyradio').toggleClass('checked', radio.get('checked'));
                radio.retrieve('fancyradio').toggleClass('disabled', radio.get('disabled'));
            });
        });

        fancyradio.inject(radio, 'after');
        fancyradio.toggleClass('checked', radio.get('checked'));
        fancyradio.toggleClass('disabled', radio.get('disabled'));

        radio.store('fancyradio', fancyradio);
        radio.toggleClass('hide', true);
    });
};

app.form.checkbox = function (context)
{
    app.find('input[type=checkbox]', context).each(function(checkbox){
        var fancycb = new Element('div', {'class': 'app-checkbox'});

        fancycb.addEvent('click', function(event){
            if(typeof event !== 'undefined') event.stop();
            if(checkbox.get('disabled')) return;

            checkbox.set('checked', !checkbox.get('checked'));
            checkbox.fireEvent('click');
            checkbox.fireEvent('change');
        });

        checkbox.addEvent('change', function(event){
            fancycb.toggleClass('checked', this.get('checked'));
            fancycb.toggleClass('disabled', this.get('disabled'));
        });

        fancycb.inject(checkbox, 'after');
        fancycb.toggleClass('checked', checkbox.get('checked'));
        fancycb.toggleClass('disabled', checkbox.get('disabled'));

        checkbox.toggleClass('hide', true);
    });
};