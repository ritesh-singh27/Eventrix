<?php
include('config.php');
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: index.php");
}

$user = $_SESSION['username'];
$query = mysqli_query($conn, "select * from users where username = '$user'");
$row = mysqli_fetch_array($query);
$id = $row['id'];
// echo "$id";

if (isset($_REQUEST['submit'])) {
    $clubName = $_POST['club_name'];
    $eventName = $_POST['event_name'];
    $eventDate = $_POST['date'];
    $eventTime = $_POST['time'];
    $description = $_POST['event_description'];

    $insertQuery = "INSERT INTO data (club_name, event_name, event_date, event_time, event_description, user_id) VALUES ('$clubName', '$eventName', '$eventDate', '$eventTime', '$description', '$id')";
    mysqli_query($conn, $insertQuery);
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}
$query1 = mysqli_query($conn, "select * from data where user_id = '$id'");
$result = mysqli_num_rows($query1);


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Event List</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        /* Internal CSS adjustments */
        body {
            background-color: #d1dde9;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: rgb(244, 242, 242);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .my-4 {
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        #items {
            text-align: center;
        }

        h2 {
            margin-bottom: 0px;
        }
        form {
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="date"],
        input[type="time"],
        textarea {
            width: 100%;
            padding: 5px;
            margin-bottom: 0px;
            box-sizing: border-box;
        }

        table 
    {
        width: 70%;
        border-collapse: collapse;
    }

    table th, table td 
    {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    table th 
    {
        background-color: #a4bdd7;
        text-align: center;
        color: #ffffff;
    }
        .btn-danger {
            padding: 6px 12px;
        }

        .ques{
            color: black;
            font-weight:bold;
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Eventrix</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="aboutus.html">About</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="contactus.html" tabindex="-1" aria-disabled="true">Contact</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="logout.php" tabindex="-1" aria-disabled="true">Logout</a>
                </li>
            </ul>

        </div>
    </nav>
    <div class="container my-4">
        <form action="#" method="POST">
            <label for="club_name" class="ques">Club Name:</label><br><br>
            <input type="text" id="club_name" name="club_name"><br><br>
            <label for="event_name" class="ques">Event Name:</label><br><br>
            <input type="text" id="event_name" name="event_name"><br><br>
            <label for="date" class="ques">Event Date:</label><br><br>
            <input type="date" id="date" name="date"><br><br>
            <label for="time" class="ques">Event Time:</label><br><br>
            <input type="time" id="time" name="time"><br><br>
            <label for="description" class="ques">Description:</label><br><br>
            <textarea name="event_description" id="event_description" rows="3"></textarea><br><br>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </form>

        <div id="items" class="my-4">
        <h2 style="text-align: center; color : #4676a9" >Events List</h2>
            <table border="1px" align="center">
                <tr>
                    <th>Event Title</th>
                    <th>Event Description</th>
                    <th>Edit list</th>
                </tr>

                <?php
                for ($i = 1; $i <= $result; $i++) {
                    $row = mysqli_fetch_array($query1)
                        ?>




                    <tr>
                        <td>
                            <?php echo $row['event_name'] ?>
                        </td>
                        <td>
                            <?php echo $row['event_description'] ?>
                        </td>
                        <td>
                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>


</body>

</html>
<?php
// Handle delete functionality
if (isset($_POST['delete'])) {
    $delete_id = $_POST['delete_id'];
    $deleteQuery = "DELETE FROM data WHERE id = '$delete_id' AND user_id = '$id'";
    mysqli_query($conn, $deleteQuery);
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}
?>