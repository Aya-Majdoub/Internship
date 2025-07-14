<?php
    session_start();
    include("database.php");

    $error = "";
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $status = $_POST["status"];
        $workshop = isset($_POST["selected_card"]) ? $_POST["selected_card"] : "";
        $workshop_str = implode(", ", $workshop);

        $check = "SELECT * FROM users WHERE user_email = '$email'";
        $checking = mysqli_query($conn, $check);

        if(empty($name) || empty($email) || empty($status)){
            $_SESSION["message"] = "Please fill in all fields.";
            header("Location: index.php?error=1");
            exit();
        }
        elseif(mysqli_num_rows($checking) > 0){
            $_SESSION["message"] = "This email already exists!";
            header("Location: index.php?error=2");
            exit();
        }
        else {
            $sql = "INSERT INTO users (username, user_email, status) VALUES (?, ?, ?);
                    INSERT INTO registration (registration_date, user_ID, par_status) ";
            $stmt = mysqli_prepare($conn, $sql);
            if($stmt){
               $stmt->bind_param("sss", $name, $email, $status); 
               $stmt->execute();
               $stmt->close();

               $_SESSION["message"] = "Registered successfully!";
               header("Location: index.php?success=1");
               exit();
            }
        }
    }

    mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalog</title>

    <!-- bootstrap css -->
    <link rel = "stylesheet" href = "assets/CSS/bootstrap.min.css">
    <!-- css -->
    <link rel = "stylesheet" href = "assets/CSS/mystyles.css">

</head>
<body>
    
    <h1>Our workshops</h1>

    <div class="container mycontainer">
        <?php
            $message = "";

            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
            }
        ?>

        <form class="w-75" action="index.php" method="post">

            <div class="form-group">
                <label>Full Name</label>
                <input class="form-control" type="text" placeholder="Full name" name="name">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input class="form-control" type="email" placeholder="email" name="email">
            </div>

            <div class="form-group">
                <label>Status</label><br>
                <select name="status" id="status">
                    <option value="" disabled selected hidden>Select your status</option>
                    <option value="student">Student</option>
                    <option value="employee">Employee</option>
                    <option value="other">Other</option>
                </select>
                <!--<label>
                    <input type="radio" name="status" value="student"> Student
                </label>
                <label>
                    <input type="radio" name="status" value="employee"> Employee
                </label>
                <label>
                    <input type="radio" name="status" value="other"> Autre
                </label>-->
            </div>

            <br>

            <button class="btn btn-danger" type="submit">Submit</button>

            <?php if (!empty($message) && ($message != "Registered successfully!")): ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <?php 
                        echo $message; 
                    ?>
                </div>
            <?php elseif(!empty($message) && ($message == "Registered successfully!")) : ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <?php 
                        echo $message; 
                    ?>
                </div>
            <?php endif; ?>

            

        </form>

    </div>


    <div class="container">
        <div id = "c1" class = "carousel slide">
            <div class="carousel-inner">

                <div class="carousel-item active">
                    <div class="row justify-content-around">
                        <div class="col-12 col-sm-6 col-md-3">
                            <input type="checkbox" id="select1" name="selected_card" value="Art of transformation" class="card-checkbox">
                            <div class = "card card-selectable" style="width: 20rem; height: 50rem";>
                                <img class = "card-img-top" src = "assets/images/Ronald_Rand_asHC.jpg" alt="">
                                <div class="card-body">
                                    <h5 class="card-title text-danger">Art of transformation</h5>
                                    <p class="card-text text-dark">Ronald Rand - Cultural Ambassador and Professor of Theater (USA)</p>
                                    <label for="select1">
                                        <span class="btn btn-danger">Select</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="row justify-content-around">
                        <div class="col-12 col-sm-6 col-md-3">
                            <input type="checkbox" id="select2" name="selected_card" value="Le masque et le corps du personnage" class="card-checkbox">
                            <div class = "card card-selectable" style="width: 18rem; height: 50rem";>
                                <img class = "card-img-top" src = "assets/images/de-maglio-2-scaled.jpg" alt="">

                                <div class="card-body">
                                    <h5 class="card-title text-danger">Le masque et le corps du personnage</h5>
                                    <p class="card-text text-dark">Claudio de Maglio - Professor of Theater (Italy)</p>

                                    <label for="select2">
                                        <span class="btn btn-danger">Select</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>

                <div class="carousel-item">
                    <div class="row justify-content-around">
                        <div class="col-12 col-sm-6 col-md-3">
                            <input type="checkbox" id="select3" name="selected_card" value="Le voyage du personnage" class="card-checkbox">
                            <div class = "card card-selectable" style="width: 18rem; height: 50rem";>
                                <img class = "card-img-top" src = "assets/images/philippe mertz.jfif" alt="">

                                <div class="card-body">
                                    <h5 class="card-title text-danger">Le voyage du personnage</h5>
                                    <p class="card-text text-dark">Philippe Mertz - Theater writing coach (France)</p>

                                    <label for="select3">
                                        <span class="btn btn-danger">Select</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>

                <div class="carousel-item">
                    <div class="row justify-content-around">
                        <div class="col-12 col-sm-6 col-md-3">
                            <input type="checkbox" id="select4" name="selected_card" value="Meinser Technique for Scene Development" class="card-checkbox">
                            <div class = "card card-selectable" style="width: 18rem; height: 50rem";>
                                <img class = "card-img-top" src = "assets/images/paintingwrkshp.jpg" alt="">

                                <div class="card-body">
                                    <h5 class="card-title text-danger">Meinser Technique for Scene Development</h5>
                                    <p class="card-text text-dark">Jhon Freeman - Professor of Theater (Australia)</p>

                                    <label for="select4">
                                        <span class="btn btn-danger">Select</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
                

            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#c1" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Previous</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#c1" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Next</span>
            </button> 

        </div>

    </div>
    
    <!-- bootstrap js -->
    <script src = "assets/JavaScript/bootstrap.bundle.min.js"></script>
    <!-- javascript -->
    <script src = "assets/JavaScript/main.js"></script>
    

</body>
</html>
