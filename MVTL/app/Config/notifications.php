<?php

$notifications = dirname(__FILE__) . DS . 'notifications';
$handle = opendir($notifications);

while ($notification = readdir($handle)) {
    if (substr($notification, -4) == '.php')
        include $notifications . DS . $notification;
}