$(function () {
    setInterval(function () {
        getOnlineUsers();
    }, 10000);
});

function getOnlineUsers() {
    $.get(BASEURL + '/' + LANGUAGE + "/system/user/online-users", function (data) {
        $("#online-users-badge").html(data.body.badge);
        $('#online-users-list').html(data.body.view);
    });
}