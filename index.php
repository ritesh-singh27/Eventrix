<?php
include('config.php');
session_start();


$query1 = mysqli_query($conn, "SELECT * FROM data");
$result = mysqli_num_rows($query1);


?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <link rel="stylesheet" href="styles.css">
    <style>
        table {
            width: 70%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        table th {
            background-color: #a4bdd7;
            text-align: center;
            color: #ffffff;
        }
    </style>

    <title> Event List</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Eventrix</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="aboutus.html">About Us</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="contactus.html" tabindex="-1" aria-disabled="true">Contact Us</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="register.php">Register</a>
                </li>


            </ul>

        </div>
    </nav>

    <div class="container-fluid">
        <div class="text-overlay">
            <h1 style="text-align: center;">Welcome To Eventrix !!</h1>
        </div>
        <img src="event2.jpg" alt="Eventrix Image" class="img-fluid">
        <div class="event-text">
            Eventrix
        </div>
    </div>

    <div id="items" class="my-4">
        <h2 style="text-align: center; color : #4676a9">All Events</h2>
        <table border="1px" align="center">
            <tr>
                <th>Club Name</th>
                <th>Event Name</th>
                <th>Event Date</th>
                <th>Event Description</th>
                <th>Register</th>
            </tr>

            <?php
            while ($row = mysqli_fetch_assoc($query1)) {
            ?>
                <tr>
                    <td>
                        <?php echo $row['club_name']; ?>
                    </td>
                    <td>
                        <?php echo $row['event_name']; ?>
                    </td>
                    <td>
                        <?php echo $row['event_date']; ?>
                    </td>
                    <td>
                        <?php echo $row['event_description']; ?>
                    </td>
                    <td><a href="pop_up.html" class="btn btn-primary">Register</a></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>


</body>

</html>