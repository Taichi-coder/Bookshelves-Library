<?php

include 'db.php';
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $author = htmlspecialchars($_POST['author']);
    $bookname = htmlspecialchars($_POST['bookname']);
    $details = htmlspecialchars( $_POST['details']);
    $numberOfPage = htmlspecialchars($_POST['numberOfPage']);
    $yearOfBook = htmlspecialchars($_POST['yearOfBook']);
    $user_id = htmlspecialchars($_SESSION['user_id']);

    $insert = "INSERT INTO books (author, bookname, details, users_id, numberOfPage, yearOfBook) VALUES ('$author', '$bookname', '$details', $user_id,'$numberOfPage', '$yearOfBook' )";

    if(mysqli_query($linking, $insert) === true){
        header('Location:index2.php');
        exit; 
    }else{
        echo "Error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Thebookshelves.org</title>
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
        <h3>CREATE YOUR STORYLINE</h3>
        <a href="index2.php">Back to Home</a>
    </header>

    <main>
        <form action="create.php" method="POST">

            <div class="container">
                <div class="mb-3">
                    <label for="author" class="form-label">Author*</label>
                    <input type="text" name="author" id="author" class="form-control" placeholder="Insert Author's name..." style="width: 200px;" required>
                </div>
                
                <div class="mb-3">
                    <label for="bookname" class="form-label">Book-Name*</label>
                    <input type="text" name="bookname" id="bookname" class="form-control" placeholder="Insert Book name..." style="width: 200px;" required>
                </div>

                <div class="mb-3">
                    <label for="yearOfBook" class="form-label">Book Year*</label>
                    <input type="text" name="yearOfBook" id="yearOfBook" placeholder="Insert year published..." class="form-control"  required>
                </div>

                <div class="mb-3">
                    <label for="numberOfPage" class="form-label">Number of Page*</label>
                    <input type="number"  name="numberOfPage" id="numberOfPage" style="width: 100px;"class="form-control" placeholder="1-100" required>
                </div>

                <div class="form-floating">
                    <textarea class="form-control" id="details" name="details" style="width: 550px; height: 300px; font-family: 'Oswald', sans-serif; font-size: 1.3rem; padding-top: 40px;"></textarea>
                    <label for="details">Details*</label>
                </div>
            </div>
            
            <button type="submit">Create</button>
        </form>
    </main>

    <footer>
        <h3>Copyright &copy; <?php echo date("F-Y")  ?> Thebookshelves.org</h3>
    </footer>
</body>
</html>