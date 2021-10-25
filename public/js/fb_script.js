// Facebook SDK
window.fbAsyncInit = function() {
    FB.init({
        appId: '426169618864833',
        cookie: true,
        xfbml: true,
        version: 'v12.0',
        // apiKey: 'EAAGDmViZCGsEBAOaUUczjOuTPe6bjIa33N0PZC2jqGb8V1BRxegfLM40L6t8ODjZC5izbL6zfdZA7YiKWB7w5VzUM8t423vsw3i3KztNXPLLRJwZAJ4lJMdgtxwP89gH0iolrI8leWakFltEJ0JBKdxYpANTq6CwfRqDZCs3KfkQKBXZAoJK4oXgTtvmPCtBbaAo56vMcnUhpZA1EZAyOCCBsfeItB4BhuEAclbxsyAVBIsdKuC2owEJf'
    });

    FB.AppEvents.logPageView();

    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });
};

(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement(s);
    js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Verifica o retorno da api
function statusChangeCallback(response) {
    if(response.status === 'connected') {
        accessToken = response.authResponse.accessToken;
        console.log(accessToken);
        console.log("Logado");
        fbLogout = document.querySelector(".fb-logout");
        fbLogout.classList.add("active");
        btnLogin = document.getElementById("btn-login-auth");
        testApi();
    } else {
        console.log("Não logado");
    }
}

function checkLoginState() {
    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });
}

// Desloga do facebook e atualiza página
function logout() {
    FB.logout(function(response) {
        window.location.reload();
        console.log("Deslogado com sucesso");
    });
}

// Recupera informações de usuário facebook
function testApi() {
   FB.api('/me?fields=name,email,birthday,location,picture', function(response) {
        if(response && !response.error) {
            console.log(response);
            buildProfile(response);
            const btnLogin = document.querySelector("#btn-login-auth");
            btnLogin.click();
            // window.location.href = "https://localhost/projetos/techinside/autenticacao";
        }
   })
}

// Cria os inputs para o form de login (response do Facebook Graph API)
function buildProfile(user) {
    // let profile = `
    //     <h3>${user.name}</h3>
    //     <ul class="list-group">
    //         <li class="list-group-item">User ID: ${user.id}</li>
    //         <li class="list-group-item">User E-mail: ${user.email}</li>
    //         <li class="list-group-item">User Birthday: ${user.birthday}</li>
    //         <li class="list-group-item">User Location: ${user.location.name}</li>
    //         <li class="list-group-item">User Image: <img src="${user.picture.data.url}"></img></li>
    //     </u>
    // `;
    // console.log('criar tabela')
    // document.getElementById('profile').innerHTML = profile;

    let profile = `
        <input type="hidden" name="fb_access" value="true">
        <input type="hidden" name="fb_name" value="${user.name}">
        <input type="hidden" name="fb_email" value="${user.email}">
        <input type="hidden" name="fb_birthday" value="${user.birthday}">
        <input type="hidden" name="fb_location" value="${user.location.name}">
        <input type="hidden" name="fb_picture" value="${user.picture.data.url}">
        <input type="hidden" name="fb_token" value="${accessToken}">
    `;
    document.getElementById('fb_profile').innerHTML = profile;
}