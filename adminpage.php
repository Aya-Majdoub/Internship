<?php
    session_start();
    include("database.php");


    if(!isset($_SESSION["admin_ID"])){
        header("Location: adminlogin.php");
        exit();
    }

    $admin_ID = $_SESSION["admin_ID"];
    $query1 = "SELECT * FROM users WHERE user_ID = '$admin_ID'";
    $result1 = mysqli_query($conn, $query1);
    $adminInfo = mysqli_fetch_assoc($result1);

    $query2 = "SELECT * FROM workshop";
    $result2 = mysqli_query($conn, $query2);

    /* Form data */

    if($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['delete_wrkshp']) && !isset($_POST['edit_button'])){
        $title = $_POST["title"];
        $description = $_POST["description"];
        $date = $_POST["date"];
        $Stime = $_POST["Stime"];
        $Etime = $_POST["Etime"];
        $capacity = $_POST["capacity"];
        $category = $_POST["category"];

        $check = "SELECT * FROM workshop WHERE title = '$title'";
        $checking = mysqli_query($conn, $check);

        if(mysqli_num_rows($checking) > 0){
            $_SESSION["message"] = "This workshop already exists!";
            header("Location: adminpage.php?error=1");
            exit();
        }
        elseif(empty($title) || empty($description) || empty($date) || empty($Stime) || empty($Etime) || empty($capacity) || empty($category)){
            $_SESSION["message"] = "Please fill in all fields!";
            header("Location: adminpage.php?error=1");
            exit();
        }
        else{
            $query3 = "INSERT INTO workshop (title, description, workshop_date, start_time, end_time, capacity, category) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query3);
            $stmt->bind_param("sssssis", $title, $description, $date, $Stime, $Etime, $capacity, $category);
            if($stmt->execute()){
                $_SESSION["message"] = "Workshop added successfully!";
                header("Location: adminpage.php?success=1");
                exit();
            } else {
                $_SESSION["message"] = "Error adding workshop!";
                header("Location: adminpage.php?error=2");
                exit();
            }
        }
    } 
    
    /* Delete workshops */
    $query4 = "SELECT * FROM workshop";
    $result4 = mysqli_query($conn, $query4);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_wrkshp'])) {
        if (isset($_POST['selected_workshop']) && !empty($_POST['selected_workshop'])) {
            if ($_POST['selected_workshop'] == 'Select workshop') {
                $_SESSION["message2"] = "Please select a workshop to delete!";
                header("Location: adminpage.php?error=3");
                exit();
            }

            $selected_workshop = $_POST['selected_workshop'];

            $query5 = "DELETE FROM workshop WHERE workshop_ID = ?";
            if ($stmt = $conn->prepare($query5)) {
                $stmt->bind_param("i", $selected_workshop);
                if ($stmt->execute()) {
                    $_SESSION["message2"] = "Workshop deleted successfully!";
                    header("Location: adminpage.php?success=2");
                    exit();
                } else {
                    $_SESSION["message2"] = "Error deleting workshop!";
                    header("Location: adminpage.php?error=4");
                    exit();
                }

            }
        }
    }

    /* Edit workshops */
    
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_button'])){
        $ID = $_POST["ID"];
        $title2 = $_POST["title2"];
        $description2 = $_POST["description2"];
        $date2 = $_POST["date2"];
        $Stime2 = $_POST["Stime2"];
        $Etime2 = $_POST["Etime2"];
        $capacity2 = $_POST["capacity2"];
        $category2 = $_POST["category2"];

        if(empty($title2) || empty($description2) || empty($date2) || empty($Stime2) || empty($Etime2) || empty($capacity2) || empty($category2)){
            $_SESSION["message3"] = "Please fill in all fields!";
            header("Location: adminpage.php?error=5");
            exit();
        }
        else{
            $query7 = "UPDATE workshop SET title = ?, description = ?, workshop_date = ?, start_time = ?, end_time = ?, capacity = ?, category = ? WHERE workshop_ID = ?";
            if($stmt2 = $conn->prepare($query7)){
                $stmt2->bind_param("sssssisi", $title2, $description2, $date2, $Stime2, $Etime2, $capacity2, $category2, $ID);

                if($stmt2->execute()){
                    if ($stmt2->affected_rows > 0) {
                        $_SESSION["message3"] = "Workshop edited successfully!";
                        header("Location: adminpage.php?success=3");
                        exit();
                    } else {
                        $_SESSION["message3"] = "No changes were made (same data?)";
                        header("Location: adminpage.php?success=3");
                        exit();
                    }
                } else {
                    $_SESSION["message3"] = "Error editing workshop!";
                    header("Location: adminpage.php?error=7");
                    exit();
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>


    <!-- bootstrap css -->
    <link rel = "stylesheet" href = "assets/CSS/bootstrap.min.css">
    <!-- css -->
    <link rel = "stylesheet" href = "assets/CSS/mystyles.css">

    <style>

    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Fituc 2025</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" aria-current="page" href="https://www.fituc.ma/">Home</a>
                    <a class="nav-link" href="https://intern.com/index.php">Registration</a>
                    <a class="nav-link" href="https://intern.com/Festival workshops/adminlogin.php">Log out</a>
                </div>
            </div>
        </div>
    </nav>
    
    <h1><?php echo "Hello " . $adminInfo["username"]; ?></h1>
    

    <!-- Current workshops -->
    <div class="container">
        <table class="table table-secondary rounded-4 overflow-hidden table-striped border-dark">
            <thead>
                <tr class="table-dark">
                    <th scope="col">#</th>
                    <th scope="col">Workshop</th>
                    <th scope="col">Description</th>
                    <th scope="col">Date</th> 
                    <th scope="col">Start_time</th>
                    <th scope="col">End_time</th>  
                    <th scope="col">Capacity</th> 
                    <th scope="col">Category</th>   
                    <th> </th> 
                    <th> </th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php while ($workshopInfo = mysqli_fetch_assoc($result2)) : 
                    $collapseId = "collapse" . $workshopInfo["workshop_ID"];
                    $EditcollapseId = "edcollapse" . $workshopInfo["workshop_ID"];
                    $workshopID = $workshopInfo["workshop_ID"];
                    $query3 = "SELECT u.username, u.user_email, r.par_status, r.expectations FROM registration r JOIN users u ON u.user_ID = r.user_ID WHERE r.workshop_ID = $workshopID";
                    $result3 = mysqli_query($conn, $query3);
                    ?>
                        
                    <tr>
                        <th scope="row"><?php echo $workshopInfo["workshop_ID"]; ?></th>
                        <td><?php echo $workshopInfo["title"]; ?></td>
                        <td><?php echo $workshopInfo["description"]; ?></td>
                        <td><?php echo $workshopInfo["workshop_date"]; ?></td>
                        <td><?php echo $workshopInfo["start_time"]; ?></td>
                        <td><?php echo $workshopInfo["end_time"]; ?></td>
                        <td><?php echo $workshopInfo["capacity"]; ?></td>
                        <td><?php echo $workshopInfo["category"]; ?></td>
                        <td>
                            <button class="btn btn-danger" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $collapseId ?>" aria-expanded="false" aria-controls="#<?= $collapseId ?>">
                                View participants
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $EditcollapseId ?>" aria-expanded="false" aria-controls="#<?= $EditcollapseId ?>">
                                Edit workshop
                            </button>
                        </td>
                    </tr>
                    <tr class="collapse" id="<?= $collapseId ?>">
                        <td colspan="10">
                            <div class="card card-body card-body1">
                                <div id="pdf-content-<?php echo $workshopInfo["workshop_ID"]; ?>">
                                    <table class="table">
                                        <thead>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Expectations</th>
                                        </thead>
                                        <tbody>
                                            <?php if (mysqli_num_rows($result3) > 0): ?>
                                                <?php while ($part_info = mysqli_fetch_assoc($result3)) : ?>
                                                    <tr>
                                                        <td><?php echo $part_info["username"] ?></td>
                                                        <td><?php echo $part_info["user_email"] ?></td>
                                                        <td><?php echo $part_info["par_status"] ?></td>
                                                        <td><?php echo $part_info["expectations"] ?></td>
                                                    </tr>
                                                <?php endwhile; ?>
                                            <?php else : ?>
                                                <p class="text-muted">No participants for this workshop.</p>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center mt-4">
                                    <button onclick="downloadPDF('pdf-content-<?php echo $workshopInfo['workshop_ID']; ?>')" class="btn btn-success">⬇️ Download list as PDF</button>
                                </div>
                            </div>
                        </td>
                    </tr>   

                    <div class="mybutton">
                        <?php
                            $message3 = "";

                            if (isset($_SESSION['message3'])) {
                                $message3 = $_SESSION['message3'];
                                unset($_SESSION['message3']);
                            }
                        ?>         
                        <?php if (!empty($message3) && ($message3 != "Workshop edited successfully!")) : ?>
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <?php 
                                    echo $message3; 
                                ?>
                            </div>
                        <?php elseif(!empty($message3) && ($message3 == "Workshop edited successfully!")) : ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <?php 
                                    echo $message3; 
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <tr class="collapse" id="<?= $EditcollapseId ?>">
                        <td colspan="10">
                            <div class="card card-body card-body1">
                                
                                <form class="w-75" action="adminpage.php" method="post">
                                    <div class="mb-3">
                                        <label class="form-label">Workshop ID</label>
                                        <input type="number" class="form-control" name="ID" value="<?php echo $workshopInfo["workshop_ID"]; ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Workshop title</label>
                                        <input type="text" class="form-control" name="title2" value="<?php echo $workshopInfo["title"]; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" rows="3" name="description2"><?php echo $workshopInfo["description"]; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Date</label>
                                        <input type="date" class="form-control" name="date2" value="<?php echo $workshopInfo["workshop_date"]; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Start_time</label>
                                        <input type="time" class="form-control" name="Stime2" value="<?php echo $workshopInfo["start_time"]; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">End_time</label>
                                        <input type="time" class="form-control" name="Etime2" value="<?php echo $workshopInfo["end_time"]; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Capacity</label>
                                        <input type="number" class="form-control" name="capacity2" value="<?php echo $workshopInfo["capacity"]; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Category</label>
                                        <input type="text" class="form-control" name="category2" value="<?php echo $workshopInfo["category"]; ?>">
                                    </div>
                                    <div class="mybutton">
                                        <button class="btn btn-danger" type="submit" name="edit_button">Edit</button>
                                    </div>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
        
            </tbody>
        </table>
    </div>    

    
    <div class="container">

        <!-- Add workshops -->
        <p class="d-grid gap-2">
            <button class="btn btn-danger" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
                Add
            </button>
        
            <div class="collapse" id="collapseExample1">
                <div class="card card-body card-body1">
                    <div class="container">

                        

                        <strong><label style="color: black;">Add workshops</label></strong>
                        <form class="w-75" action="adminpage.php" method="post">
                            <div class="mb-3">
                                <label class="form-label" style="color: black;">Workshop title</label>
                                <input type="text" class="form-control" placeholder="workshop title" name="title">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: black;">Description</label>
                                <textarea class="form-control" rows="3" name="description" placeholder="Type the description here"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: black;">Date</label>
                                <input type="date" class="form-control" name="date">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: black;">Start_time</label>
                                <input type="time" class="form-control" name="Stime">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: black;">End_time</label>
                                <input type="time" class="form-control" name="Etime">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: black;">Capacity</label>
                                <input type="number" class="form-control" name="capacity">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="color: black;">Category</label>
                                <input type="text" class="form-control" name="category">
                            </div>

                            <div class="mybutton">
                                <button class="btn btn-danger" type="submit">Submit</button>                               
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </p>    


        <?php
            $message = "";

            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
            }
        ?>
        <?php if (!empty($message) && ($message != "Workshop added successfully!")): ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <?php 
                    echo $message; 
                ?>
            </div>
        <?php elseif(!empty($message) && ($message == "Workshop added successfully!")) : ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <?php 
                    echo $message; 
                ?>
            </div>
        <?php endif; ?>
        

        <!-- Delete workshops -->
        <div  class="delete">
            <p class="d-grid gap-2">
                <button class="btn btn-danger" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Delete
                </button>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body card-body1">
                        <div class="container">
                            <strong><label style="color: black;">Delete workshops</label></strong>
                            
                            <form class="w-75" action="adminpage.php" method="post">
                                <div class="mb-3">
                                    <label class="form-label" style="color: black;">Workshop title</label>
                                    <select class="form-select" name="selected_workshop">
                                        <option selected>Select workshop</option>
                                        <?php while ($workshopInfo = mysqli_fetch_assoc($result4)) : ?>
                                            <option value="<?php echo $workshopInfo['workshop_ID']; ?>">
                                                <?php echo $workshopInfo["title"]; ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                    
                                <div class="mybutton">
                                    <button class="btn btn-danger" type="submit" name="delete_wrkshp">Delete</button>
                                    
                                </div>
    

                            </form> 
                            
                    
                        </div>
                    </div>
                </div>
            </p>

        </div>

        <?php
            $message2 = "";

            if (isset($_SESSION['message2'])) {
                $message2 = $_SESSION['message2'];
                unset($_SESSION['message2']);
            }
        ?>
        <?php if (!empty($message2) && ($message2 != "Workshop deleted successfully!")): ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <?php 
                    echo $message2; 
                ?>
            </div>
        <?php elseif(!empty($message2) && ($message2 == "Workshop deleted successfully!")) : ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <?php 
                    echo $message2; 
                ?>
            </div>
        <?php endif; ?>
 
    </div> 
    <!-- bootstrap js -->
    <script src = "assets/JavaScript/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <!-- javascript -->
    <script src = "assets/JavaScript/main.js"></script>

    <script>
        function downloadPDF(elementId) {
            const element = document.getElementById(elementId);
            if (!element) {
                alert("Element not found.");
                return;
            }
            const opt = {
            margin: 1,
            filename: 'participants-list.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            
            html2canvas: {
                scrollY: 0,
                scale: 2,
                useCORS: true
            },
            jsPDF: {
                unit: 'px',
                format: [794, 1123],
                orientation: 'portrait'
            }
            };
            html2pdf().set(opt).from(element).save();
        }
    </script>
</body>
</html>
