window.fbAsyncInit = function() {
    FB.init({
        appId: '309223815892634', // App ID
        channelUrl: 'channel.html', // Channel File
        status: true, // check login status
        cookie: true, // enable cookies to allow the server to access the session
        xfbml: true
        // parse XFBML
    });
};


function facebookLogin() {
    FB.login(function(response) {
        if (response.authResponse) {
            // connected
            handleToken(response.authResponse.accessToken);
        } else {

        }
    });
}

function handleToken(accessToken) {
    var request = $.ajax({
        type: "POST",
        url: "/facebook/auth",
        data: { token : accessToken },
        dataType: "json"

    });

    request.success(function(data) {
        if(data.status == "invalid_token") {
            alert("FAIL");
        } else if (data.status == "nolink") {

        } else if (data.status == "success") {
            location.href = "/";
        }
    });


}

$(document).ready(function() {
    $("#fb-signin").click(function() {
        facebookLogin();
    });
});

// Load the SDK Asynchronously
(function(d) {
    var js, id = 'facebook-jssdk',
        ref = d.getElementsByTagName('script')[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement('script');
    js.id = id;
    js.async = true;
    js.src = "//connect.facebook.net/en_US/all.js";
    ref.parentNode.insertBefore(js, ref);


}(document));