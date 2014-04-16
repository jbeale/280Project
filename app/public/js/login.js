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
    $.get("user/facebook/" + accessToken, function(data) {
        if (data == "invalid") {
            alert("FB problem");
            $("#lightbox_overlay").fadeOut();
        } else if (data == "no_sso") {
            currentFacebookToken = accessToken;
            goToSSOAssociation();
        } else if (data !== "") {
            var result = jQuery.parseJSON(data);
            token = result.token;
            $("#current_user").html("Logged in as " + result.cn);
            goToCourseSelect();
            //location.href = createLaunchUrl(token);
        }
    });
}