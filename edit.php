<?php

include 'db.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $author = htmlspecialchars($_POST['author']);
    $bookname = htmlspecialchars($_POST['bookname']);
    $details = htmlspecialchars( $_POST['details']);
    $numberOfPage = htmlspecialchars($_POST['numberOfPage']);
    $yearOfBook = htmlspecialchars($_POST['yearOfBook']);
    $id = htmlspecialchars($_POST['id']);

    $update = "UPDATE books SET author = '$author', bookname = '$bookname', yearOfBook = '$yearOfBook', numberOfPage = '$numberOfPage', details = '$details' WHERE id = '$id'";

    if(mysqli_query($linking, $update) === true){
        header('Location:index2.php');
        exit;
    }else{
        echo "Error";
    }
} 

$sel = "SELECT * FROM books ORDER BY created_time";
$sql3 = mysqli_query($linking, $sel);
$update3 = mysqli_fetch_assoc($sql3);

    $id = $_GET['id'];
    $sql = "SELECT * FROM books WHERE id = $id";
    $result = mysqli_query($linking, $sql);
    $update2 = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Thebookshelves.org</title>
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
        <h3>UPDATE YOUR STORYLINE</h3>
        <a href="index2.php">Back to Home</a>
    </header>
    
    <main>
        <form action="edit.php" method="POST">

            <div class="container">
            <input type="hidden" name="id" id="id" value='<?php echo $update3['id'] ?>' required>
                <div class="mb-3">
                    <label for="author" class="form-label">Author*</label>
                    <input type="text" value="<?php echo htmlspecialchars($update3["author"]) ?>" name="author" id="author" class="form-control" placeholder="Insert Author's name..." style="width: 200px;" required>
                </div>
                
                <div class="mb-3">
                    <label for="bookname" class="form-label">Book-Name*</label>
                    <input type="text" value="<?php echo htmlspecialchars($update3["bookname"]) ?>" name="bookname" id="bookname" class="form-control" placeholder="Insert Book name..." style="width: 200px;" required>
                </div>

                <div class="mb-3">
                    <label for="yearOfBook" class="form-label">Book Year*</label>
                    <input type="text" value="<?php echo htmlspecialchars($update3["yearOfBook"]) ?>" name="yearOfBook" id="yearOfBook" placeholder="Insert year published..." class="form-control"  required>
                </div>

                <div class="mb-3">
                    <label for="numberOfPage" class="form-label">Number of Page*</label>
                    <input type="number" value="<?php echo htmlspecialchars($update3["numberOfPage"]) ?>" name="numberOfPage" id="numberOfPage" style="width: 100px;"class="form-control" placeholder="1-100" required>
                </div>

                <div class="form-floating">
                    <textarea class="form-control" id="details" name="details" style="width: 460px; height: 250px; font-family: 'Oswald', sans-serif; padding-top: 40px;font-size: 1.3rem;"><?php echo htmlspecialchars($update3["details"]) ?></textarea>
                    <label for="details">Details*</label>
                </div>
            </div>
            
            <button type="submit">UPDATE</button>
        </form>
    </main>

    <footer>
        <h3>Copyright &copy; <?php echo date("F-Y")  ?> Thebookshelves.org</h3>
    </footer>
</body>
</html>