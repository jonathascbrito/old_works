/**
 * Cria o módulo messages na aplicação.
 */
app.messages = app.__module();

/**
 * Analisa uma parte da interface recuperando cada mensagem e adicionando o botão
 * "x" para removê-la.
 *
 * @param mixed context
 * @returns null
 */
app.messages.parse = function(context) {
    app.find('.message', context).each(function(message) {
        var close = new Element('a.close');

        close.addEvent('click', function(event) {
            event.stop();
            message.destroy();
        });

        message.grab(close, 'top');
    });
};