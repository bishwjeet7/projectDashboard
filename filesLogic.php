<?php
// include("auth_session.php");
// include("auth_session.php");
// connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'loginSystem');
$sql = "SELECT * FROM files";
$result = mysqli_query($conn, $sql);

$files = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Uploads files
if (isset($_POST['save'])) { // if save button on the form is clicked

    // Data get from form
    $userID = $_REQUEST['userID'];
    $userName = $_REQUEST['userName'];
    $userEmail = $_REQUEST['userEmail'];
    $mobNumber = $_REQUEST['mobNumber'];
    $whatsappNumber = $_REQUEST['whatsappNumber'];
    $progName = $_REQUEST['progName'];
    $projectName = $_REQUEST['projectName'];
    $courseName = $_REQUEST['courseName'];
    $submissionDate = $_REQUEST['submissionDate'];
    $basis = $_REQUEST['basis'];
    $userMessage = $_REQUEST['userMessage'];

    // name of the uploaded file
    $filename = $_FILES['myfile']['name'];

    // destination of the file on the server
    $destination = 'uploads/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];

    if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
        ?>
        <script>
            alert("You file extension must be .zip, .pdf or .docx");
            </script>
        <?php
        // echo "You file extension must be .zip, .pdf or .docx";
    } elseif ($_FILES['myfile']['size'] > 30000000) { // file shouldn't be larger than 30Megabyte
        ?>
        <script>
            alert("File too large!");
            </script>
        <?php
        // echo "File too large!";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            // $sql = "INSERT INTO files (name, size, downloads) VALUES ('$filename', $size, 0)";
            $sql = "INSERT INTO files (name, size, downloads,userID,userName,email,mobNumber,whatsapp,progName,projectName,progCourseName,submissionDate,basis,message) VALUES ('$filename', $size, 0,'$userID','$userName','$userEmail','$mobNumber','$whatsappNumber','$progName','$projectName','$courseName','$submissionDate','$basis','$userMessage')";
            if (mysqli_query($conn, $sql)) {
                ?>
                    <script>
                        alert("File uploaded successfully");
                    </script>
                <?php
                echo "File uploaded successfully";
            }
        } else {
            ?>
                <script>
                    alert("Failed to upload file.");
                </script>
            <?php
            echo "Failed to upload file.";
        }
    }
}


// Downloads files
if (isset($_GET['file_id'])) {
    $id = $_GET['file_id'];

    // fetch file to download from database
    $sql = "SELECT * FROM files WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'uploads/' . $file['name'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('uploads/' . $file['name']));
        readfile('uploads/' . $file['name']);

        // Now update downloads count
        $newCount = $file['downloads'] + 1;
        $updateQuery = "UPDATE files SET downloads=$newCount WHERE id=$id";
        mysqli_query($conn, $updateQuery);
        exit;
    }

}





if (isset($_POST['uploadProof'])) { // if save button on the form is clicked
    // Data get from form
    $userIDPay = $_REQUEST['userIDPayment'];
    $userMessage = $_REQUEST['userMessage'];

    // name of the uploaded file
    $filename = $_FILES['myfile']['name'];

    // destination of the file on the server
    $destination = 'payment/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];

    if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
        ?>
        <script>
            alert("You file extension must be .zip, .pdf or .docx");
            </script>
        <?php
        // echo "You file extension must be .zip, .pdf or .docx";
    } elseif ($_FILES['myfile']['size'] > 30000000) { // file shouldn't be larger than 30Megabyte
        ?>
        <script>
            alert("File too large!");
            </script>
        <?php
        // echo "File too large!";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $sql = "UPDATE files SET paymentProof = '$filename', paymentfileSize = '$size',paymentmsg='$userMessage' WHERE id='$userIDPay'";
            if (mysqli_query($conn, $sql)) {
                ?>
                    <script>
                        alert("File uploaded successfully");
                    </script>
                <?php
                echo "File uploaded successfully";
            }
        } else {
            ?>
                <script>
                    alert("Failed to upload file.");
                </script>
            <?php
            echo "Failed to upload file.";
        }
    }
}