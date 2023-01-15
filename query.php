<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");

$user = $_SESSION['username'];
// $name = $_SESSION['email'];
$con = mysqli_connect("localhost", "root", "", "LoginSystem"); // connect with data
$que = "SELECT * FROM `users` WHERE email='$user'"; // Extract data with database by using session username.
$name = mysqli_query($con, $que);
$row = $name->fetch_assoc();

if (isset($_POST['submitQuery'])) {
    $uid = $_REQUEST['userID'];
    $qrelate = $_REQUEST['queryRelated'];
    $uemail = $_REQUEST['inputEmail4'];
    $uname = $_REQUEST['inputname'];
    $umsg = $_REQUEST['usermessage'];
    
    $sql = "INSERT INTO query (userID,queryRelate, email, name, message) VALUES ('$uid','$qrelate' , '$uemail', '$uname', '$umsg')";

    if (mysqli_query($con, $sql)) {
        ?>
            <script>
                alert("Query Submitted successfully");
            </script>
        <?php
        echo "Query Submitted successfully";
    }
    else {
        ?>
            <script>
                alert("Failed to upload file.");
            </script>
        <?php
        echo "Failed to upload file.";
    }

}
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
    <link rel="stylesheet" href="css/tableStyle.css">
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
            <div class="table-container">
                <h1 class="heading">Query</h1>
                <form class="row g-3" action="query.php" method="POST">
                <input type="text" value="<?php echo $row['id']?>" hidden name="userID">
                    <div class="col-md-12">
                        <label for="inputState" class="form-label">Subject</label>
                        <select id="inputState" class="form-select" name="queryRelated">
                            <option selected>Choose...</option>
                            <option>General</option>
                            <option>Payment Related</option>
                            <option>Project Descripiency</option>
                            <option>Integrity Report</option>
                            <option>Project Not upto the mark</option>
                            <option>Profile</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input type="email" class="form-control" id="inputEmail4" name="inputEmail4" value="<?php echo $row['email']?>">
                    </div>
                    <div class="col-md-6">
                        <label for="inputname" class="form-label">Name</label>
                        <input type="text" class="form-control" id="inputname" name="inputname" value="<?php echo $row['username'] ?>">
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="usermessage"></textarea>
                        <label for="floatingTextarea2">Message</label>
                    </div>
                    <!-- <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck">
                            <label class="form-check-label" for="gridCheck">
                                Check me out
                            </label>
                        </div>
                    </div> -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary" name="submitQuery">Submit</button>
                    </div>
                </form>
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