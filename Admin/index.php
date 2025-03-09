<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxe-Home Dashboard</title>
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <div class="login-container">
        <h1>Luxe-Home Dashboard</h1>
        <form action="php/login.php" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Ingresa tu email" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>
            </div>
            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            fetch('PHP/login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({ email, password })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.usuario.rol === 'admin') {
                        window.location.href = 'dashboard.php';
                    } else {
                        window.location.href = 'ParteUsuario/index.php';
                    }
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>

</html>