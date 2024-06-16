document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const loginMessage = document.getElementById('loginMessage');

    loginForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const username = loginForm.querySelector('#username').value;
        const password = loginForm.querySelector('#password').value;

        // Enviar requisição AJAX para verificar login
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'login_process.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        loginMessage.textContent = 'Login bem-sucedido. Redirecionando...';
                        setTimeout(function() {
                            window.location.href = 'index.html';
                        }, 1000);
                    } else {
                        loginMessage.textContent = 'Usuário ou senha incorretos.';
                    }
                } else {
                    loginMessage.textContent = 'Erro ao processar requisição.';
                }
            }
        };

        const

