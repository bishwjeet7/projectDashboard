<?php
include 'filesLogic.php';
//include auth_session.php file on all user panel pages
include("auth_session.php");

$user = $_SESSION['username'];
// $name = $_SESSION['email'];
$con = mysqli_connect("localhost", "root", "", "LoginSystem"); // connect with data
$que = "SELECT * FROM `users` WHERE email='$user'"; // Extract data with database by using session username.
$name = mysqli_query($con, $que);
$row = $name->fetch_assoc();
$id = $row['id'];
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
            <?php
            $dataFromfile = "SELECT * from files WHERE userID='$id'";
            $result = mysqli_query($con, $dataFromfile);
            $nums = mysqli_num_rows(($result));
            ?>
            <div class="table-container">
                <H1 class="heading">Track Payment <table></table>
                </H1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Project Name</th>
                            <th>Upload Date</th>
                            <th>Fee</th>
                            <th>Payment Status</th>
                            <th>Message</th>
                            <th>Pay</th>
                            <th>Payment Proof</th>
                            <!-- <th>Any Query</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($res = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td data-label="Project Name"><?php echo $res['projectName'] ?></td>
                                <td data-label="Upload Date"><?php echo $res['uploadDate'] ?></td>
                                <td data-label="Fee"><?php echo $res['projectFee'] ?></td>
                                <td data-label="Payment Status"><?php echo $res['paymentStatus'] ?></td>
                                <td data-label="Message"><span class="text_open"><?php echo $res['projectMessage'] ?></span></td>
                                <td data-label="Pay"><a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn">Pay Now</a></td>
                                <td data-label="Payment Proof"><a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1" data-bs-whatever="<?php echo $res['id'] ?>" class="btn">Upload</a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- pop box by pootstrap -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Payment Details</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><i class="fa-solid fa-arrow-right"></i> If you are facing any kind of issue please contact us using query or E-mail</p>
                        <p><i class="fa-solid fa-arrow-right"></i> Please upload payment proof via<span style="font-weight: bold;"> payment Proof </span>option</p>
                        <hr>
                        <h6><i class="fa-brands fa-amazon-pay"></i>UPI </h6>
                        <h6>9304989643@axl , 9304989643596@paytm</h6>
                        <hr>
                        <h7><i class="fa-solid fa-building-columns"></i> Bank Details</h7>
                        <h6>Account holder Name - Bishwjeet kumar</h6>
                        <h6>Account Number - 35069268278</h6>
                        <h6>IFSC Code - SBIN001714</h6>
                        <h5>------------------------------------</h5>
                        <h6>Account holder Name - Bishwjeet kumar</h6>
                        <h6>Account Number - 35069268278</h6>
                        <h6>IFSC Code - SBIN001714</h6>
                        <hr>
                        <h7><i class="fa-solid fa-qrcode"></i> Scan and Pay</h7>
                        <img src="https://img.freepik.com/premium-vector/qr-code-sample-smartphone-scanning-qr-code-icon-flat-design-stock-vector-illustration_550395-108.jpg?w=2000" width="90%">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div>
        </div><!-- pop box by pootstrap -->



        <!-- model for file upload -->

        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Payment Proof</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php
                            $dataFromfile = "SELECT * from files WHERE userID='$id'";
                            $result = mysqli_query($con, $dataFromfile);
                            $row = $result->fetch_assoc();
                            // echo $row['email']
                        ?>
                        <form action="payment.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label" hidden>Project Name :</label>
                                <input type="text" class="form-control" id="recipient-name" disabled hidden>
                            </div>
                            <input type="text" value="" name="userIDPayment" id="userIDPayment" hidden>
                            <div class="mb-3">
                                <input type="file" class="form-control" name="myfile" aria-label="file example" required>
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Message:</label>
                                <textarea class="form-control" id="message-text" name="userMessage"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="uploadProof">Send message</button>
                            </div>
                        </form>
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


        /*Pop box will be show from using bootstrap*/
        const myModal = document.getElementById('myModal')
        const myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', () => {
            myInput.focus()
        })
    </script>

    <script>
        const exampleModal = document.getElementById('exampleModal1')
        exampleModal.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget
            // Extract info from data-bs-* attributes
            const recipient = button.getAttribute('data-bs-whatever')
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            const modalTitle = exampleModal.querySelector('.modal-title')
            const modalBodyInput = exampleModal.querySelector('.modal-body input')

            modalTitle.textContent = `Upload Payment Proof`
            document.getElementById("userIDPayment").value = recipient;
            modalBodyInput.value = recipient
        })
    </script>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/iconify/2.0.0/iconify.min.js" integrity="sha512-lYMiwcB608+RcqJmP93CMe7b4i9G9QK1RbixsNu4PzMRJMsqr/bUrkXUuFzCNsRUo3IXNUr5hz98lINURv5CNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>
<!-- <?php
        header("Location: login.php");
        ?> -->