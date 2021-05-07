/**
 * Cria o módulo modal na aplicação.
 */
app.modal = app.__module();

/**
 * Cria os elementos necessários para o funcionamento do modal.
 *
 * @returns null
 */
app.modal.load = function()
{
    this.content = new Element('div.content');
    this.modal = new Element('div.modal');
    this.blackout = new Element('div.blackout', {'styles':{'opacity': .1}});

    this.content.inject(this.modal);

    $(document.body).grab(this.modal);
    $(document.body).grab(this.blackout);
};

/**
 * Calcula o tamanho e posição do modal ao redimensionar a janela do navegador.
 *
 * @returns null
 */
app.modal.resize = function()
{
    var modal = this.modal.getSize();
    var viewport = $(window).getSize();

    var mt = (viewport.y - modal.y) / 2;
    this.modal.setStyle('margin-top', mt < 0 ? 0 : mt);
    this.blackout.setStyle('height', viewport.y);
};

/**
 * Analiza uma parte da interface adicionando os eventos para abrir e fechar o
 * modal.
 *
 * @param mixed context
 * @returns null
 */
app.modal.parse = function(context) {
    app.find('[modal-action]', context).each(function(toggle) {
        var action = toggle.get('modal-action');

        var data = null;
        var method = 'get';

        if(toggle.get('modal-data')){
            data = $(toggle.get('modal-data'));
            method = data.get('method') ? data.get('method') : 'post';
        }

        toggle.addEvent('click', function(event) {
            event.stop();

            if (this.hasClass('disabled')) {
                return;
            }

            if (action === 'open') {
                app.modal.open(toggle.get('modal-url'), method, data);
            } else {
                app.modal.close();
            }
        });
    });
};

/**
 * Abre o modal apontando para a url especificada. A página é carregada utilizando
 * o método e dados especificados.
 *
 * @param string url
 * @param string method
 * @param object data
 * @returns null
 */
app.modal.open = function(url, method, data) {
    app.request(url, method, data, function(status, data){
        app.modal.handle(status, data);
    });
};

/**
 * Fecha o modal e remove o conteúdo previamente exibido.
 *
 * @returns null
 */
app.modal.close = function() {
    app.update(this.content, '');

    app.modal.modal.toggleClass('show', false);
    app.modal.blackout.toggleClass('show', false);
};

/**
 * Trata as respostas do método app.request exibindo o carregamento, conteúdo ou
 * erros da requisição.
 *
 * @param string status
 * @param mixed data
 * @returns null
 */
app.modal.handle = function(status, data)
{
    //@todo: handle error

    if (status === 'request') {
        app.update(this.content, '<div class="loader"></div>');

        app.modal.modal.toggleClass('show', true);
        app.modal.blackout.toggleClass('show', true);

        app.modal.resize();
    }

    if (status === 'success') {
        app.update(this.content, data);

        app.modal.modal.toggleClass('show', true);
        app.modal.blackout.toggleClass('show', true);

        app.modal.resize();
    }
};