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

    $query3 = "SELECT * FROM workshop w LEFT JOIN users u ON u.user_ID = w.user_ID WHERE w.user_ID = 51";
    $result3 = mysqli_query($conn, $query3);

    /* Form data */

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $title = $_POST["title"];
        $description = $_POST["description"];
        $date = $_POST["date"];
        $Stime = $_POST["Stime"];
        $Etime = $_POST["Etime"];
        $capacity = $_POST["capacity"];
        $category = $_POST["category"];
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
</head>
<body>
    
    <h1>Admin profile</h1>
    <div class="row">
        <h2 class="mycontainer">
            <?php echo "Hello " . $adminInfo["username"]; ?>
        </h2><br><br>
    </div>

    <!-- Current workshops -->
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Workshop</th>
                <th scope="col">Description</th>
                <th scope="col">Date</th> 
                <th scope="col">Start_time</th>
                <th scope="col">End_time</th>  
                <th scope="col">Capacity</th> 
                <th scope="col">Category</th>   
                <th> </th> 
                </tr>
            </thead>
            <tbody>
                <?php while ($workshopInfo = mysqli_fetch_assoc($result2)) : 
                    $collapseId = "collapse" . $workshopInfo["workshop_ID"];
                    $workshopID = $workshopInfo["workshop_ID"];
                    $query3 = "SELECT u.username, u.user_email, r.par_status FROM registration r JOIN users u ON u.user_ID = r.user_ID WHERE r.workshop_ID = $workshopID";
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
                            <button class="btn btn-warning" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $collapseId ?>" aria-expanded="false" aria-controls="#<?= $collapseId ?>">
                                View participants
                            </button>
                        </td>
                    </tr>
                    <tr class="collapse" id="<?= $collapseId ?>">
                        <td colspan="9">
                            <div class="card card-body">
                                <?php if (mysqli_num_rows($result3) > 0): ?>
                                    <?php while ($part_info = mysqli_fetch_assoc($result3)) : ?>
                                        <ul>
                                            <li><strong><?php echo $part_info["username"] ?></strong> — 
                                            <?php echo $part_info["user_email"] ?> — 
                                            Status: <?php echo $part_info["par_status"] ?></li>
                                        </ul>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <p class="text-muted">No participants for this workshop.</p>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>   
                <?php endwhile; ?>
        
            </tbody>
        </table>
    </div>                              
    <!-- Add workshops -->
    <div class="container">
        <strong><label>Add workshops</label></strong>
        <form class="w-75" action="adminpage.php" method="post">
            <div class="mb-3">
                <label class="form-label">Workshop title</label>
                <input type="text" class="form-control" placeholder="workshop title" name="title">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" rows="3" name="description" placeholder="Type the description here"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Date</label>
                <input type="date" class="form-control" name="date">
            </div>
            <div class="mb-3">
                <label class="form-label">Start_time</label>
                <input type="time" class="form-control" name="Stime">
            </div>
            <div class="mb-3">
                <label class="form-label">End_time</label>
                <input type="time" class="form-control" name="Etime">
            </div>
            <div class="mb-3">
                <label class="form-label">Capacity</label>
                <input type="number" class="form-control" name="capacity">
            </div>
            <div class="mb-3">
                <label class="form-label">Category</label>
                <input type="text" class="form-control" name="category">
            </div>
        </form> 
    </div>


    <!-- Edit workshops -->
    <div>

    </div>

    
    <!-- bootstrap js -->
    <script src = "assets/JavaScript/bootstrap.bundle.min.js"></script>
    <!-- javascript -->
    <script src = "assets/JavaScript/main.js"></script>
</body>
</html>
