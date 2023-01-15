<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");

$user = $_SESSION['username'];
// $name = $_SESSION['email'];
$con = mysqli_connect("localhost", "root", "", "LoginSystem"); // connect with data
$que = "SELECT * FROM `users` WHERE email='$user'"; // Extract data with database by using session username.
$name = mysqli_query($con, $que);
$row = $name->fetch_assoc();
$id = $row['id'];
// echo "this is a test text message. we are working on session get data so that we can work further in dashboards = " . $row['email'] . " || " . $row['username'] . "password : ";

$fileUploadedTotalQuery =  "SELECT COUNT(*) FROM files WHERE userID = $id";  // count the number of file uploaded by current id of user.

$result=mysqli_query($con,$fileUploadedTotalQuery); // run query
$projectCount=mysqli_fetch_array($result); // fetch data 
// echo "<h3>$rowcount[0]</h3>"; // print data


// get data which PAYMET IS PENDING IN the project.
$filePAYMETQuery =  "SELECT COUNT(*) FROM files WHERE userID = $id AND paymentStatus = 'Pending'";  // count the number of file uploaded by current id of user.

$resultpayment=mysqli_query($con,$filePAYMETQuery); // run query
$projectpaymentPendingCount=mysqli_fetch_array($resultpayment); // fetch data


// get data which PAYMET IS PENDING IN the project.
$fileQuery =  "SELECT COUNT(*) FROM files WHERE userID = $id AND projectstatus = 'Completed'";  // count the number of file uploaded by current id of user.

$resultdelivered=mysqli_query($con,$fileQuery); // run query
$projectDeliveredCount=mysqli_fetch_array($resultdelivered); // fetch data

// get data which is active project.
$fileQueryActiveProject =  "SELECT COUNT(*) FROM files WHERE userID = $id AND projectstatus = 'Approved'";  // count the number of file uploaded by current id of user.

$resultactive=mysqli_query($con,$fileQueryActiveProject); // run query
$projectresultactiveCount=mysqli_fetch_array($resultactive); // fetch data

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/navbar.css">
    <!-- <link rel="stylesheet" href="css/tableStyle.css"> -->
    <link rel="stylesheet" href="css/daschboardStyle.css">
    <title>CodingSolution</title>
</head>

<body>
    <div class="sidebar active">
        <div class="logo_content">
            <div class="logo">
                <i class='bx bxl-c-plus-plus' style="font-size: 30px;"></i>
                <div class="logoname" style="margin-left: 5px;">CodingSolution</div>
            </div>
            <i class="fa-solid fa-bars" id="btn" style="font-size: 25px;"></i>
        </div>
        <ul class="nav_list">
            <li>
                <a href="dashboard.php">
                    <i class="fa-solid fa-gauge"></i>
                    <span class="link_names">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="profile.php">
                    <i class="fa-solid fa-user"></i>
                    <span class="link_names">Profile</span>
                </a>
                <span class="tooltip">Profile</span>
            </li>
            <li>
                <a href="message.php">
                    <i class="fa-solid fa-message"></i>
                    <span class="link_names">Messages</span>
                </a>
                <span class="tooltip">Messages</span>
            </li>
            <li>
                <a href="upload.php">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <span class="link_names">Upload</span>
                </a>
                <span class="tooltip">Upload</span>
            </li>
            <li>
                <a href="track.php">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    <span class="link_names">Track</span>
                </a>
                <span class="tooltip">Track</span>
            </li>
            <li>
                <a href="payment.php">
                    <i class="fa-solid fa-dollar-sign"></i>
                    <span class="link_names">Payment</span>
                </a>
                <span class="tooltip">Payment</span>
            </li>
            <li>
                <a href="downloads.php">
                    <i class="fa-solid fa-download"></i>
                    <span class="link_names">Download</span>
                </a>
                <span class="tooltip">Download</span>
            </li>
            <li>
                <a href="query.php">
                    <i class="fa-solid fa-clipboard-question"></i>
                    <span class="link_names">Query</span>
                </a>
                <span class="tooltip">Query</span>
            </li>
        </ul>
        <div class="profile_content">
            <div class="profile">
                <div class="profile_details">
                    <img src="https://vz.cnwimg.com/wp-content/uploads/2014/01/alex.jpg?x86007" alt="">
                    <div class="name_job">
                        <div class="name"><?php echo $row['username']; ?></div>
                        <div class="job">User</div>
                    </div>
                </div>
                <a href="logout.php"><i class="fa-solid fa-right-from-bracket" id="log_out"></i></a>
            </div>
        </div>
    </div>
    <!-- body content -->
    <div class="home_content">
        <div class="trackBox">
            <p>Welcome, <?php echo $row['username'] ?></p>
            <div class="row">
                <div class="column">
                    <div class="card">
                        <h4>Project Uploaded</h4>
                        <h5><?php echo $projectCount[0] ?></h5>
                        <p>All project uploaded till now.</p>
                    </div>
                </div>

                <div class="column">
                    <div class="card">
                        <h4>Project Delivered</h4>
                        <p><?php echo $projectDeliveredCount[0] ?></p>
                        <p>Project sucessfully completed and delivered</p>
                    </div>
                </div>

                <div class="column">
                    <div class="card">
                        <h4>Payment Pending</h4>
                        <h5>$ <?php echo $projectpaymentPendingCount[0] * 25 ?></h5>
                        <p>Payment pending for poject : <span style="font-weight: bolder;"><?php echo $projectpaymentPendingCount[0] ?></span></p>
                        <!-- <h5>$ </h5> -->
                    </div>
                </div>

                <div class="column">
                    <div class="card">
                        <h3>Active Project</h3>
                        <h5><?php echo $projectresultactiveCount[0] ?></h5>
                        <p>Active working on project.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END -->
    <script>
        let btn = document.querySelector("#btn");
        let sidebar = document.querySelector(".sidebar");
        let searchBtn = document.querySelector(".bx-search")

        btn.onclick = function() {
            sidebar.classList.toggle("active");
        }
        searchBtn.onclick = function() {
            sidebar.classList.toggle("active");
        }
    </script>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/iconify/2.0.0/iconify.min.js" integrity="sha512-lYMiwcB608+RcqJmP93CMe7b4i9G9QK1RbixsNu4PzMRJMsqr/bUrkXUuFzCNsRUo3IXNUr5hz98lINURv5CNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>
<!-- <?php
        header("Location: login.php");
        ?> -->