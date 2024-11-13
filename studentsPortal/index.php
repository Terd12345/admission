 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Access Module</title>
    <link rel="shortcut icon" href="../assets/images/logoPearl.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>

    <div class="login-container">
        <h1>Students Access Module</h1>

        <form action="login.php" method="post">
            <?php if(isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
            <div class="mb-3">
                <label for="username" class="form-label">Student User:</label>
                <input type="text" class="form-control" id="username" name="uname" placeholder="Username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <button type="reset" class="btn btn-secondary">Clear Entries</button>
        </form>

        <div class="form-text">
            <a href="forgot.php">Forgot your password? Click here</a>
        </div>
                <br>
    </div>

    <div class="footer">
        <img src="../assets/images/logoPearl.png" alt="logo" height="400px" width="400px">
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
    crossorigin="anonymous"></script>
</body>
</html>

