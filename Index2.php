<?php
session_start();
include 'db.php';

$index1 = "SELECT * FROM books ORDER BY created_time";

$getAll = mysqli_query($linking, $index1);
$user = null;
$id = null;


// Retrieve user details from session
// $user = isset($_SESSION['user_id']) ? $_SESSION['user'] : null;
if(isset($_SESSION['user_id'])){
    $id = $_SESSION['user_id'];
    $sql = "SELECT * FROM signup_users WHERE id = '$id' ";
    $result = mysqli_query($linking, $sql);
    $user = mysqli_fetch_assoc($result);

}
//Configuration..
$perPage = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $perPage;

$sql = "SELECT * FROM books ORDER BY created_time LIMIT $start, $perPage";

$getAll = $linking->query($sql);

// Pagination Links
$totalRows = $linking->query("SELECT COUNT(*) FROM books")->fetch_row()[0];
$totalPages = ceil($totalRows / $perPage);

$link = $_SERVER['PHP_SELF'];

$pagination = "";
for($i = 1; $i <= $totalPages; $i++){
    $pagination .= "<a href='$link?page=$i'>$i</a>";
}

//Time validation
$greetings = "";
$date2 = date("H");

if($date2 >= 12 &&  $date2 < 18) {
    $greetings = "Good Afternoon";
}elseif($date2 >= 18 && $date2 <= 23) {
    $greetings = "Good Evening ";
}else {
    $greetings = "Good Morning";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thebookshelves.org</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Emblema+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Stencil:opsz,wght@10..72,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Inline:opsz,wght@10..72,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    
    <header>
        <div class="headerdiv" >
            <img src="img/images.png" alt="imagelogo">
            <h2>The Book Shelves</h2>
        </div>
        <div class="create1">
            <p><?php echo $greetings.": " . ($user ? $user["username"] : "Guest"); ?></p> 
            <a href="create.php">Create your story</a>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="thead thead2">
                <p class="sn" >S/N</p>
                <p class="au" >Author</p>
                <p class="bok">Book-Names</p>
                <p class="boy">Book Year</p>
                <p class="nop">No of Page</p>
                <p class="det">Read More...</p>
                <p class="act">Actions</p>
            </div>
            <?php
                $sn = 1;
                while($row = mysqli_fetch_assoc($getAll)) {
            ?>
            <div class="thead thead3">
                <p class="sn nd" ><?php echo $sn++ ?></p>
                <p class="au" ><?php echo $row['author'] ?></p>
                <p class="bok bok2"><?php echo $row['bookname'] ?></p>
                <p class="boy"><?php echo $row['yearOfBook'] ?></p>
                <p class="nop nop2"><?php echo $row['numberOfPage'] ?></p>
                <p class="det"><a href="read_more2.php?id=<?php echo $row['id'] ?>"><?php if(strlen($row['details']) > 50) {
                    echo substr($row['details'], 0, 30). " ...Read More";
                }else{
                    echo $row['details'];
                }  ?></a></p>
               <p class="act">
                   <?php if($id === $row['users_id']) {?>
                    <a href="edit.php?id=<?php echo $row['id'] ?>">Edit</a> <a href="delete.php?id=<?php echo $row['id'] ?>">Delete</a>
                    <?php } ?>
                </p>
            </div>
            <?php
                }
            ?>
        </div>

           
        </div>

        <div class="pagination">
            <?php echo $pagination ?>
        </div>

        <a href="logout.php" class="logout">Log Out</a>
    </main>

    <footer>
        <h3>Copyright &copy; <?php echo date("F-Y")  ?> Thebookshelves.org</h3>
    </footer>
</body>
</html>