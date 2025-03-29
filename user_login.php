<?php
include 'db.php';
session_start();
$login_error = '';


if($_SERVER['REQUEST_METHOD']== 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM signup_users WHERE username = '$username' ";

    $result = mysqli_query($linking, $sql);
    $user = mysqli_fetch_assoc($result);
    if($user && password_verify($password, $user['passkey'])){
        $_SESSION['user_id'] = $user['id'];
        header('location:  index2.php');
    }else{
        $login_error = 'Invalid username or password';
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log-in Thebookshelves.org</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Emblema+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Stencil:opsz,wght@10..72,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Inline:opsz,wght@10..72,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Big+Shoulders:opsz,wght@10..72,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="user_login.css">
</head>
<body>
    <header>
        <h3>LOG-IN TO STORYLINE</h3>
        <div>
            <a href="index1.php">Back to Home</a>
            <a href="signUp.php">Sign Up</a>
        </div>
    </header>
    <main>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">

            <div class="container">
                <div class="mb-3">
                    <label for="firstname" class="form-label">Username*</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Insert Username..." style="width: 300px;" >
                    <span><?php ?></span>
                </div>
                
                <div class="mb-3">
                    <label for="lastname" class="form-label">Password*</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Insert Password..." style="width: 300px;" >
                </div>
            </div>

            <span><?php echo $login_error; ?></span>

                <button type="submit">Log in</button>
        </form>
    </main>

    <footer>
        <h3>Copyright &copy; <?php echo date("F-Y")  ?> Thebookshelves.org</h3>
    </footer>
</body>
</html>