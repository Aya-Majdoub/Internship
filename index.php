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

    <div class="container desc">

        <form class="w-75" action="adminlogin.php" method="post">

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
                <label>
                    <input type="checkbox" name="status"> Student
                </label>
                <label>
                    <input type="checkbox" name="status"> Employee
                </label>
                <label>
                    <input type="checkbox" name="status"> Autre
                </label>
            </div>

            <br>
        </form>

    </div>


    
    <div id = "c1" class = "carousel slide">
        <div class="carousel-inner">

            <div class="carousel-item active">
                <div class="row justify-content-around">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class = "card" style="width: 20rem";>
                            <img class = "card-img-top" src = "assets/images/Ronald_Rand_asHC.jpg" alt="">

                            <div class="card-body">
                                <h5 class="card-title text-danger">Art of transformation</h5>
                                <p class="card-text text-dark">Ronald Rand - Cultural Ambassador and Professor of Theater (USA)</p>

                                <a href="atelier1.php" class="btn btn-danger">Register</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="row justify-content-around">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class = "card" style="width: 18rem";>
                            <img class = "card-img-top" src = "assets/images/de-maglio-2-scaled.jpg" alt="">

                            <div class="card-body">
                                <h5 class="card-title text-danger">Le masque et le corps du personnage</h5>
                                <p class="card-text text-dark">Claudio de Maglio - Professor of Theater (Italy)</p>

                                <a href="" class="btn btn-danger">Register</a>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>

            <div class="carousel-item">
                <div class="row justify-content-around">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class = "card" style="width: 18rem";>
                            <img class = "card-img-top" src = "assets/images/philippe mertz.jfif" alt="">

                            <div class="card-body">
                                <h5 class="card-title text-danger">Le voyage du personnage</h5>
                                <p class="card-text text-dark">Philippe Mertz - Theater writing coach (France)</p>

                                <a href="" class="btn btn-danger">Register</a>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>

            <div class="carousel-item">
                <div class="row justify-content-around">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class = "card" style="width: 18rem";>
                            <img class = "card-img-top" src = "assets/images/paintingwrkshp.jpg" alt="">

                            <div class="card-body">
                                <h5 class="card-title text-danger">Meinser Technique for Scene Development</h5>
                                <p class="card-text text-dark">Jhon Freeman - Professor of Theater (Australia)</p>

                                <a href="" class="btn btn-danger">Register</a>
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

    <button class="btn btn-danger" type="submit">Submit</button>
    
    <!-- bootstrap js -->
    <script src = "assets/JavaScript/bootstrap.bundle.min.js"></script>
    <!-- javascript -->
    <script src = "assets/JavaScript/main.js"></script>
    

</body>
</html>


<?php

?>