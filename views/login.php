<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="/assets/style.css?t=<?=time()?>" rel="stylesheet">
</head>
<body>
    <div id="main">
        <div style="position: absolute; left: 50%; top: 50%; -webkit-transform: translate(-50%, -50%); transform: translate(-50%, -50%);">
            <h1>Login</h1>
            <form method="POST" action="/api/v1/login">
                <input type="username" name="username" placeholder="Username" required><br><br>
                <input type="password" name="password" placeholder="Password" required><br><br>
                <button>Login</button>
            </form>
        </div>
    </div>
</body>
</html>