/**
 * Objeto base do framework de interface. Contem métodos úteis e comuns aos
 * módulos da aplicação.
 * @type Object
 */
var app = new Object;

/**
 * Método executado ao carregar a aplicação. Executa a lógica de inicialização de
 * todos os módulos ativos.
 *
 * @returns null
 */
app.__load = function() {
    app.__run('load');
}

/**
 * Método executado ao redimensionar a aplicação. Executa a lógica de
 * redimensionamento de todos os módulos ativos.
 *
 * @returns null
 */
app.__resize = function() {
    app.__run('resize');
}

/**
 * Método executado ao atualizar uma parte da interface. O elemento atualizado
 * será processado por todos os módulos ativos.
 *
 * @param mixed context
 * @returns null
 */
app.__parse = function(context) {
    context = typeof context == 'undefined' ? document.body : context;
    app.__run('parse', context);
}

/**
 * Executa uma ação em todos os módulos ativos.
 *
 * @param string action
 * @param mixed params
 * @returns null
 */
app.__run = function(action, params) {
    for(var m=0; m<app.modules.length; m++) {
        if(typeof app.modules[m][action] === 'function')
            app.modules[m][action](params);
    }
}

/**
 * Inicializa um novo módulo e o registra no framework de interface.
 *
 * @returns Object
 */
app.__module = function() {
    var module = new Object;

    app.modules = typeof app.modules === 'undefined' ? [] : app.modules;
    app.modules.push(module);

    return module;
}

/**
 * Método utilizado apenas como parãmetro padrã para funções ou placeholders,
 * não realiza nenhuma ação.
 *
 * @returns null
 */
app.noop = function() {};

/**
 * Realiza uma busca no contexto especificado retornando os elementos compatíveis
 * com o seletor especificado.
 *
 * @param string selector
 * @param mixed context
 * @returns Object
 */
app.find = function(selector, context) {
    context = typeof context == 'undefined' ? document.body : context;
    return $(context).getElements(selector);
};

/**
 * Realiza uma busca no contexto especificado e conta os elementos compatíveis
 * com o seletor especificado.
 *
 * @param string selector
 * @param mixed context
 * @returns integer
 */
app.count = function(selector, context) {
    return app.find(selector, context).length;
};

/**
 * Atualiza um elemento da interface com o conteúdo especificado. Após a
 * atualização o elemento será processado por todos os módulos ativos.
 *
 * @param mixed element
 * @param string content
 * @returns null
 */
app.update = function ( element, content )
{
    $(element).set('html', content);
    $(element).fireEvent('change');

    app.__parse(element);

    if (typeof app.onupdate == 'function') {
        app.onupdate();
        app.onupdate = null;
    }
};

/**
 * Realiza uma requisição assíncrona utilizando xmlHttpRequest e retorna o
 * resultado para a função especificada.
 *
 * @param string url
 * @param string method
 * @param object content
 * @param function callback
 * @returns null
 */
app.request = function(url, method, content, callback) {
    method = typeof method === 'undefined' ? 'get' : method;
    content = typeof content === 'undefined' ? {} : content;
    callback = typeof callback === 'undefined' ? app.noop : callback;

    new Request({
        'emulation': true, 'noCache': true, 'evalScripts': true,
        'url': url, 'method': method, 'data': content,

        'onRequest': function () { callback('request'); },
        'onFailure': function (xhr) { callback('failure', xhr); },
        'onSuccess': function (response, xml) { callback('success', response); },

        'onProgress': function (event, xhr) {
            var loaded = event.loaded, total = event.total;
            var progress = parseInt(loaded / total * 100, 10);

            callback('progress', progress);
        }
    }).send();
};

/**
 * Registra po módulo utils na aplicação.
 * Contem métodos úteis e comuns a toda a aplicação.
 */
app.utils = app.__module();

/**
 * Formata um número de acordo com os parâmetros informados.
 *
 * @param integer n
 * @param integer decimals
 * @param string decimal_sep
 * @param string thousands_sep
 * @returns string
 */
app.utils.numberformat = function(n, decimals, decimal_sep, thousands_sep)
{
   c = isNaN(decimals) ? 2 : Math.abs(decimals),
   d = decimal_sep || '.',

   t = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep, //if you don't want to use a thousands separator you can pass empty string as thousands_sep value

   sign = (n < 0) ? '-' : '',

   i = parseInt(n = Math.abs(n).toFixed(c)) + '',

   j = ((j = i.length) > 3) ? j % 3 : 0;
   return sign + (j ? i.substr(0, j) + t : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : '');
}

/**
 * Associa os eventos load, resize e parse do framework com os respectivos
 * eventos do navegador.
 */
window.addEvent('resize', function(){ app.__resize(); });
window.addEvent('domready', function(){ app.__load(); app.__parse(); });