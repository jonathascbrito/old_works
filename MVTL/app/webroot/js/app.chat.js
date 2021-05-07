/**
 * Cria o módulo chat na aplicação.
 */
app.chat = app.__module();

app.chat.load = function()
{
    this.title;
    
    this.chatwindows_to = [];
    this.chatwindows_messages = [];
    this.chatwindows_messages_to = [];
    this.chatwindows_messages_titles = [];

    this.chatwindows = new Element('div', {
        'class': 'chat-windows'
    });
    
    this.chatsound = new Element('div#chat-sound');

    document.body.adopt(this.chatwindows);
    document.body.adopt(this.chatsound);

    new Swiff(base_path + 'js/app.chat.swf', {
        'width': 0,
        'height': 0,
        'params': {
            'wmode': 'transparent',
            'allowScriptAccess': 'always',
        },
        'vars': {
            'sound': base_path + 'js/app.chat.mp3'
        },
        'container': this.chatsound
    });

    app.chat.getchats();
    app.chat.filterto = false;
};

app.chat.create = function(id, title, close, textarea, refresh, to)
{
    if ( app.count('[chat-id="' + id + '"]') > 0 ) {
        return;
    }

    var chatwindow = new Element('div', {
        'chat-id': id,
        'class': 'chat-window chat-' + id
    });

    if (close !== false) {
        var close = new Element('div.close', {
            'events': {
                'click': function (event) {
                    event.stop();
                    app.chat.close(chatwindow);
                }
            }
        });

        chatwindow.adopt(close);
    }
    
    if (id != 'users') {
        var clear = new Element('div.clear', {
            'html': 'limpar',
            'events': {
                'click': function (event) {
                    event.stop();
                    app.chat.clear(chatwindow);
                }
            }
        });

        chatwindow.adopt(clear);
    }

    var title = new Element('div.title', {
        'html': title,
        'events': {
            'click': function (event) {
                event.stop();
                app.chat.toggle(chatwindow);
            }
        }
    });

    var content = new Element('div.content');

    chatwindow.adopt(title, content);

    if (textarea !== false) {
        var textarea = new Element('textarea', {
            'events': {
                'keydown': function (event) {
                    if ( ! event.shift && event.key == 'enter' ) {
                        app.chat.sendmessage(id, this.get('value'));
                        this.set('value', '');

                        return false;
                    }
                },
                'click': function (event) {
                    app.chat.stopnotify(id);
                }
            }
        });

        chatwindow.adopt(textarea);
    }

    app.chat.chatwindows.adopt(chatwindow);
    app.chat.refresh(id,
        typeof refresh === 'undefined' ? 'chat/getmessages/'+id : refresh,
        typeof to === 'undefined' ? 1000 : to, true);
};

app.chat.toggle = function(object)
{
    var id = object.get('chat-id');
    var opened = object.hasClass('opened');

    //object.set('tween', {duration: 'normal'});
    //object.tween('bottom', opened ? -1*contentsize.y : 0);

    object.toggleClass('opened', ! opened);

    app.request(base_path + 'chat/setstatus/' + id, 'post', {'data': {'status': ! opened}});
};

app.chat.refresh = function(id, url, to, creating)
{ 
    if ( typeof creating === 'undefined' ) {
        creating = false;
    }

    var postdata = {};
    
    if ( id === 'users' ) {
        var q = $$('[chat-id=users] [name=q]').get('value')[0];
        
        if ( q != '' ) {
            postdata.q = q;
        }
    }

    if ( app.chat.chatwindows_to[id] ) {
        clearTimeout(app.chat.chatwindows_to[id]);
    }

    app.request(base_path + url, 'post', postdata, function (status, data) {
        if(status === 'success') {
            var data = JSON.decode(data);

            var chat = app.find('[chat-id="' + id + '"]')[0];
            var chattitle = app.find('.title', chat)[0];
            var chatcontent = app.find('.content', chat)[0];

            if (creating) {
                chat.toggleClass('opened', data.status == 'true' ? true : false);
            }
            
            chattitle.set('html', data.title);

            var lastFocus = document.activeElement;
            var lastScrollTop = chatcontent.scrollTop;

            app.update(chatcontent, data.content);
            
            if ( id === 'users' ) {
                if (lastFocus == $$('[chat-id=users] [name=q]')[0]) {
                    $$('[chat-id=users] [name=q]')[0].focus();
                    $$('[chat-id=users] [name=q]').set('value',
                        $$('[chat-id=users] [name=q]').get('value')[0]);
                }
            }

            chatcontent.scrollTop = id === 'users' ? lastScrollTop : chatcontent.scrollHeight;

            if (app.find('[from=received]', chatcontent).length > app.chat.chatwindows_messages[id]) {
                app.chat.sound();
                app.chat.notify(id);
            }
            
            app.chat.chatwindows_messages[id] = app.find('[from=received]', chatcontent).length;

            app.chat.chatwindows_to[id] = setTimeout('app.chat.refresh("' + id + '", "' + url + '", ' + to + ');', to);
        }
    });
};

app.chat.close = function(object)
{
    var id = object.get('chat-id');

    object.toggleClass('hide', true);

    app.request(base_path + 'chat/setstatus/' + id, 'post', {'data': {'status': 'closed'}}, function(status, data) {
        if ( status === 'success' ) {
            if ( app.chat.chatwindows_to[id] ) {
                clearTimeout(app.chat.chatwindows_to[id]);
            }

            object.destroy();
        }
    });
};

app.chat.clear = function(object)
{
    var id = object.get('chat-id');

    app.request(base_path + 'chat/clear/' + id, 'get', {}, function(status, data) {
        if ( status === 'success' ) {
            app.chat.refresh(id, 'chat/getmessages/'+id, 1000);
        }
    });
};

app.chat.sendmessage = function(id, content)
{
    app.request(base_path + 'chat/sendmessage/' + id, 'post',
        {
            'data': {
                'content': content
            }
        },
        function (status, data) {
            if ( status == 'success') {
                app.chat.refresh(id, 'chat/getmessages/'+id, 1000);
            }
        }
    );
};

app.chat.getchats = function () {
    app.request(base_path + 'chat/getchats', 'post', {}, function (status, data) {
        if ( status == 'success') {
            var chats = JSON.decode(data);

            app.chat.create('users', 'carregando...', false, false, 'chat/getusers', 5000);

            for( var c=0; c<chats.length; c++ ) {
                app.chat.create(chats[c].id, 'carregando...');
            }

            setTimeout('app.chat.getchats();', 5000);
        }
    });
};

app.chat.sound = function () {
    Swiff.remote(app.chat.chatsound.getChildren()[0], 'playalert');
}

app.chat.notify = function (id) {
    if (typeof app.chat.chatwindows_messages_to[id] != 'undefined') {
        clearTimeout(app.chat.chatwindows_messages_to[id]);
    }
    
    var chat = app.find('[chat-id="' + id + '"]')[0];
    var chattitle = app.find('.title', chat)[0];
    
    if (typeof app.chat.chatwindows_messages_titles[id] == 'undefined') {
        app.chat.chatwindows_messages_titles[id] = chattitle.get('html');
    }
    
    if (typeof app.chat.title == 'undefined') {
        app.chat.title = document.title;
    }
    
    chattitle.toggleClass('notify');
    //chattitle.set('html', chattitle.get('html') == app.chat.chatwindows_messages_titles[id] ? 'Nova mensagem...' : app.chat.chatwindows_messages_titles[id]);
    
    document.title = document.title == app.chat.title ? 'Nova Mensagem...' : app.chat.title;
    
    app.chat.chatwindows_messages_to[id] = setTimeout('app.chat.notify(' + id + ');', 3000);
};

app.chat.stopnotify = function (id) {
    var chat = app.find('[chat-id="' + id + '"]')[0];
    var chattitle = app.find('.title', chat)[0];
    
    if (typeof app.chat.chatwindows_messages_to[id] != 'undefined') {
        clearTimeout(app.chat.chatwindows_messages_to[id]);
    }
    
    if (typeof app.chat.chatwindows_messages_titles[id] != 'undefined') {
        //chattitle.set('html', app.chat.chatwindows_messages_titles[id]);
    }
    
    if (typeof app.chat.title != 'undefined') {
        document.title = app.chat.title;
    }
    
    chattitle.toggleClass('notify', false);
};

app.chat.filter = function (filter) {
    if (typeof filter == 'undefined') {
        filter = false;
    }
    
    if (filter) {
        app.chat.refresh('users', 'chat/getusers', 5000);
        return;
    }
    
    clearTimeout(app.chat.filterto);
    app.chat.filterto = setTimeout('app.chat.filter(true)', 800);
};