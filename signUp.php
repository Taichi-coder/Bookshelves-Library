<?php
session_start();
include 'db.php';


$typeError = "";
$emailError = "";
$allFields = "";

if($_SERVER["REQUEST_METHOD"] === 'POST') {
    $firstname = htmlspecialchars($_POST["firstname"]);
    $lastname = htmlspecialchars($_POST["lastname"]);
    $username = htmlspecialchars($_POST["username"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = password_hash($_POST["passkey"], PASSWORD_BCRYPT);

    $signUp = "INSERT INTO signup_users (firstname, lastname, username, email, passkey) VALUES ('$firstname', '$lastname', '$username', '$email', '$password')";

    
    
    if(mysqli_query($linking, $signUp)) {
        $getID = "SELECT * FROM signup_users ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($linking, $getID);
        $user = mysqli_fetch_assoc($result);
        $_SESSION["user_id"] = $user['id'];
        header("Location: index2.php");
    }else {
        echo "Error: " . $signUp . "<br>" . mysqli_error($linking);
    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUP Thebookshelves.org</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Emblema+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Stencil:opsz,wght@10..72,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Inline:opsz,wght@10..72,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Big+Shoulders:opsz,wght@10..72,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="create1.css">
</head>
<body>
    <header>
        <h3>SIGN UP TO CREATE STORYLINE</h3>
        <div>
            <a href="index1.php">Back to Home</a>
            <a href="user_login.php">Login</a>
        </div>
    </header>

    <main>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">

            <div class="container">
                <div class="mb-3">
                    <label for="firstname" class="form-label">First-Name*</label>
                    <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Insert First Name..." style="width: 200px;" required>
                </div>
                
                <div class="mb-3">
                    <label for="lastname" class="form-label">Last-Name*</label>
                    <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Insert Last Name..." style="width: 200px;" required>
                </div>
                
                <div class="mb-3">
                    <label for="username" class="form-label">Username*</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Insert Username..." style="width: 200px;" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail*</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Insert Email address..." style="width: 200px;" required>
                </div>

                <div class="mb-3">
                    <label for="passkey" class="form-label">Password*</label>
                    <input type="password" name="passkey" id="passkey" class="form-control" style="width: 200px;" placeholder="Insert Password..." required>
                    
                </div>

            </div>
            
            <button type="submit">Sign Up</button>
        </form>
    </main>

    <footer>
        <h3>Copyright &copy; <?php echo date("F-Y")  ?> Thebookshelves.org</h3>
    </footer>
</body>
</html>