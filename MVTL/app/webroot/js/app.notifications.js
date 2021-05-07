/**
 * Cria o módulo notifications na aplicação.
 */
app.notifications = app.__module();

app.notifications.load = function()
{
    app.notifications.to = false;
    app.notifications.getnotifications();
};

app.notifications.getnotifications = function () {
    if (app.notifications.to) {
        clearTimeout(app.notifications.to);
    }
    
    app.request(base_path + 'modules/notifications/update', 'post', {}, function (status, data) {
        if ( status == 'success') {
            var notifications = JSON.decode(data);
            
            $('notifications-count').removeClass('normal').removeClass('high');
            $('modules-notifications-count').removeClass('normal').removeClass('high');
            
            if (notifications.count) {
                $('messages-count').set('html', notifications.messages);
                $('messages-count').addClass(notifications.priority);
                $('notifications-count').set('html', notifications.notifications);
                $('notifications-count').addClass(notifications.priority);

                $('modules-notifications-count').set('html', notifications.count);
                $('modules-notifications-count').addClass(notifications.priority);
            }
            
            app.notifications.to = setTimeout('app.notifications.getnotifications();', 15*60*1000);
        }
    });
};