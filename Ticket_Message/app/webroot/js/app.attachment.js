/**
 * Cria o módulo attachment na aplicação.
 */
app.attachment = app.__module();

app.attachment.parse = function(context) {
    app.find('.attachment', context).each(function(attachment){
        var attach_id = 'attach-' + Math.round(Math.random()*10000);
        var attach_swf = new Element('div.trigger').inject(attachment, 'top');

        new Swiff(base_path + 'js/app.attachment.swf', {
            'width': 162,
            'height': 22,
            'params': {
                'wmode': 'transparent',
                'allowScriptAccess': 'always',
            },
            'vars': {
                'attach_id': attach_id,
                'attach_url': base_path + 'upload'
            },
            'container': attach_swf
        });

        attachment.set('id', attach_id);
    });
};

app.attachment.triggerover = function(id) {
    app.find('#' + id + ' .attach').toggleClass('hover', true);
};

app.attachment.triggerout = function(id) {
    app.find('#' + id + ' .attach').toggleClass('hover', false);
};

app.attachment.add = function(id, file, name, ext, size) {
    var unit = 'b';

    if (size>1024) {
        unit = 'kb';
        size = size/1024;
    }

    if (size>1024) {
        unit = 'mb';
        size = size/1024;
    }

    if (size>1024) {
        unit = 'gb';
        size = size/1024;
    }

    size = app.utils.numberformat(size, 2, ',', '.') + unit;

    app.find('#' + id + ' .files').grab(new Element('div#' + file, {
        'class': 'file' + ' ' + ext.substr(1),
        'html': '<span class="name" title="' + name + '">'
              +     name.substr(0, 20) + (name.length > 20 ? '...' : '')
              + '</span>'
              + '<div class="size">' + ext.substr(1) + ' (' + size + ')</div>'
              + '<div class="progress"><div class="bar"></div></div>'
    }));

    if (typeof app.modal !== 'undefined') {
        app.modal.resize();
    }

    return 'file-' + new Date().getTime();
};

app.attachment.error = function(id, file) {
    //@todo: handle error
};

app.attachment.complete = function(id, file) {
    app.find('#' + id + ' .files #' + file).addClass('completed');
};

app.attachment.completedata = function(id, file, data) {
    var field = app.find('#' + id + ' .attach').get('attach-field')[0];
        field = field.split('.');

    var name = 'data';
    var value = data;

    for (var f=0; f<field.length; f++) {
        name = name + '[' + field[f] + ']';
    }

    name = name + '[]';

    app.find('#' + id + ' .files #' + file).grab(new Element('input', {
        'name': name,
        'value': value,
        'type': 'hidden'
    }));
};

app.attachment.progress = function(id, file, progress) {
    progress = progress*100;
    progress = Math.round(progress) + '%';

    app.find('#' + id + ' .files #' + file + ' .bar').setStyle('width', progress);
};

//@todo: comment