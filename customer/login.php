<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <form method="post" action="./login.php" name="loginForm">
            <div class="mb-3">
                <label for="email" class="col-form-label">Email:</label>
                <input type="text" class="form-control" name="email">
            </div>
            <div class="mb-3">
                <label for="password" class="col-form-label">Password:</label>
                <input type="password" class="form-control" name="password">
            </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary">Create Account</button>
        <button type="button" class="btn btn-secondary">Close</button>
        <button type="submit" name="login" class="btn btn-primary">Login</button>
    </div>
    </div>
    </form>
</body>

</html>