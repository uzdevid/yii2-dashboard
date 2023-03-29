const notificationSound = new Audio('/storage/sounds/notification.mp3');

$(function () {
    getNotificationsMiniList(false);
    setInterval(function () {
        getNotificationsMiniList();
    }, 10000);
});

function getNotificationsMiniList(notice = true) {
    $.get(BASEURL + '/' + LANGUAGE + "/system/notification/mini-list", function (data) {
        lastNotifications = localStorage.getItem('notifications');

        localStorage.setItem('notifications', data.body.badge);
        $("#notifications-badge").html(data.body.badge);

        if (data.body.badge > lastNotifications && notice) {
            notificationSound.play();
        }

        if (data.body.badge == 0) {
            $("#notifications-badge").hide();
        } else {
            $("#notifications-badge").show();
        }

        $('#notifications-mini-list').html(data.body.view);
    });
}