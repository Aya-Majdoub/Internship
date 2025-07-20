<?php
    session_start();
    include("database.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $name = $fname ." ". $lname;
        $email = $_POST["email"];
        $status = $_POST["status"];
        $workshop = $_POST["selected_card"];
        $part = "Participant";
        $exp = $_POST["expectations"];

     
        if($workshop == "Art of transformation"){
            $wrkshp_ID = 1;
        }
        elseif($workshop == "Le masque et le corps du personnage"){
            $wrkshp_ID = 2;
        }
        elseif($workshop == "Le voyage du personnage"){
            $wrkshp_ID = 3;
        }
        elseif($workshop == "Meinser Technique for Scene Development"){
            $wrkshp_ID = 4;
        }

        $check = "SELECT * FROM users WHERE user_email = '$email'";
        $checking = mysqli_query($conn, $check);

        $now = date('Y-m-d'); 

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
            $sql = "INSERT INTO users (username, user_email, status) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);

            $query = "INSERT INTO registration (registration_date, user_ID, workshop_ID, par_status, expectations) VALUES (?, ?, ?, ?, ?)";
            $stmt2 = mysqli_prepare($conn, $query);
            

            if($stmt && $stmt2){
               $stmt->bind_param("sss", $name, $email, $part); 
               $stmt->execute();
               $user_id = mysqli_insert_id($conn);
               $stmt->close();

               $stmt2->bind_param("siiss", $now, $user_id, $wrkshp_ID, $status, $exp); 
               $stmt2->execute();
               $stmt2->close();

                $_SESSION["fname"] = $fname;
                $_SESSION["lname"] = $lname;
                $_SESSION["name"] = $name;
                $_SESSION["email"] = $email;
                $_SESSION["status"] = $status;
                $_SESSION["workshop"] = $workshop;
                $_SESSION["part"] = $part;
                $_SESSION["exp"] = $exp;
               
               header("Location: form_confirm.php?success=1");
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
    <title>Register</title>

    <!-- bootstrap css -->
    <link rel = "stylesheet" href = "assets/CSS/bootstrap.min.css">
    <!-- css -->
    <link rel = "stylesheet" href = "assets/CSS/mystyles.css">
    
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary " >
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Fituc 2025</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link " aria-current="page" href="https://www.fituc.ma/">Home</a>
                    <a class="nav-link active" href="https://intern.com/index.php">Registration</a>
                    <a class="nav-link" href="https://intern.com/adminlogin.php">Admin log in</a>
                </div>
            </div>
        </div>
    </nav>
    
    <header id="header">
        <h1 class="indexh1">   التسجيل في ورشات الدورة السابعة والثلاثين لمهرجان المسرح  الجامعي الدولي بالدار البيضاء بكلية الآداب والعلوم الإنسانية بنمسيك  Registration for the Workshops of the 37th International University Theater Festival in Casablanca at the Faculty of Letters and Human Sciences of Ben M'Sik🎭</h1>
    </header>
    
    <div class="formlayout">
        <div class="container">
            <p style="font-size: larger;">هل تحلم بتطوير مهاراتك المسرحية على يد أساتذة المسرح
            دوليين متخصصين في فن الركح؟ هل تطمح لخوض تجربة فنية استثنائية والانفتاح  على مدارس مسرحية عالمية؟ انضموا إلى ورشات
            المهرجان الدولي للمسرح الجامعي بالدار البيضاء-الدورة السابعة والثلاثون التواريخ
            14،13،12،11 يوليوز 2025 الوقت: من الساعة 9:30 صاحا إلى12:30 زوالا، المكان : كلية
            الآداب و العلوم الإنسانية بنمسيك، الدار البيضاء. ورشات متميزة يؤطرها أساتذة المسرح يرجى تعبئة الاستبيان لإختيار الورشات التي ترغبون في حضورها المقاعد محدودة –
            الأولوية حسب أسبقية التسجيل المشاركة مفتوحة للطلبة و جميع المهتمين بالمسرح - سيتم
            تسليم شهادات المشاركة بعد حفل الاختتام 
            يوم 15 يوليوز، أو بكلية الآداب ابتداء من يوم الإثنين 21 يوليوز</p>

            <p style="font-size: larger;">Are you looking to discover and enhance your theater skills with internationally renowned professionals specialized in the performing arts? Eager to embark on an exceptional artistic journey and discover global theatrical approaches? Join the workshops of the 37th International University Theater Festival in Casablanca FITUC 2025 Dates: July 11, 12, 13, 14 2025 Time:  from 9:30 AM to 12:30 PM. Location: Faculty of Letters and Human Sciences Ben M'Sik, Casablanca. Please fill out the form to select the workshops you wish to attend. Limited seats available – first come, first served. Open to students and all theater enthusiasts. Participation certificates will be issued after the closing ceremony on July 15, or at the faculty starting from Monday, July 21</p>
        </div>
        
        <div class="container mycontainer">
            <?php
                $message = "";

                if (isset($_SESSION['message'])) {
                    $message = $_SESSION['message'];
                    unset($_SESSION['message']);
                }
            ?>
            
            <form class="w-75" action="index.php" method="post">
                
                    <div>
                        <div class="form-group">
                            <label style="display: flex; justify-content: space-between;">
                                <span> First Name  </span>                           
                                <span> الإسم الشخصي  </span>  
                            </label>
                            <input class="form-control" type="text" placeholder="first name" name="fname">
                        </div>

                        <div class="form-group">
                            <label style="display: flex; justify-content: space-between;">
                                <span> Last Name  </span>                           
                                <span> الإسم العائلي  </span>  
                            </label>
                            <input class="form-control" type="text" placeholder="last name" name="lname">
                        </div>

                        <div class="form-group">
                            <label style="display: flex; justify-content: space-between;">
                                <span> Email  </span>                           
                                <span>  البريد الإلكتروني  </span>  
                            </label>    
                            <input class="form-control" type="email" placeholder="email" name="email">
                        </div>

                        <div class="form-group">
                            <label style="display: flex; justify-content: space-between;">
                                <span> Status  </span>                           
                                <span>   الحالة  </span>  
                            </label>
                            <select name="status" id="status">
                                <option value="" disabled selected hidden>Select your status</option>
                                <option value="student">Student</option>
                                <option value="employee">Employee</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <br>

                        <div class="form-group">
                            <label style="display: flex; justify-content: space-between;">
                                <span> Your expectations?  </span>                           
                                <span>   توقعاتكم؟  </span>  
                            </label>
                            <textarea class="form-control" placeholder="Let us know your expectations about the workshops" name="expectations" rows="8"></textarea>
                        </div>
                    </div>

                    <br> <br> <br>
        
                    <div class="carouselFix">
                        <div id = "c1" class = "carousel slide">
                            <div class="carousel-inner">

                                <div class="carousel-item active align-content-center">
                                    <div class="row justify-content-center">

                                        <!-- Card 1 -->
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <input type="radio" id="select1" name="selected_card" value="Art of transformation" class="card-checkbox">
                                            <div class = "card card-selectable" style="width: 18rem; height: 50rem";>
                                                <div class="IMG-card">
                                                    <img class = "card-img-top" src = "assets/images/Ronald_Rand_asHC.jpg" alt="">
                                                </div>
                                                <div class="card-body card-body2">
                                                    <div class="cardtxtdiv">
                                                        <h5 class="card-title text-danger">Art of transformation - فن التحول</h5>
                                                        <p class="card-text text-dark">Ronald Rand - Cultural Ambassador and Professor of Theater (USA) - رونالد راند - سفير  ثقافي وأستاذ المسرح _الولايات المتحدة الأمريكية </p>
                                                    </div>
                                                    <div class="cardbtndiv">
                                                        <label for="select1">
                                                            <span class="btn btn-danger">Select</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Card 2 -->
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <input type="radio" id="select2" name="selected_card" value="Le masque et le corps du personnage" class="card-checkbox">
                                            <div class = "card card-selectable" style="width: 18rem; height: 50rem";>
                                                <div class="IMG-card">
                                                    <img class = "card-img-top" src = "assets/images/de-maglio-2-scaled.jpg" alt="">
                                                </div>
                                                <div class="card-body card-body2">
                                                    <div class="cardtxtdiv">
                                                        <h5 class="card-title text-danger">Le masque et le corps du personnage -  القناع و جسد الشخصية</h5>
                                                        <p class="card-text text-dark">Claudio de Maglio - Professor of Theater (Italy) - كلوديو دي ماجليو - أستاذ المسرح (إيطاليا)</p>
                                                    </div>
                                                    <div class="cardbtndiv">
                                                        <label for="select2">
                                                            <span class="btn btn-danger">Select</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Card 3 -->
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <input type="radio" id="select3" name="selected_card" value="Le voyage du personnage" class="card-checkbox">
                                            <div class = "card card-selectable" style="width: 18rem; height: 50rem";>
                                                <div class="IMG-card">
                                                    <img class = "card-img-top" src = "assets/images/PhilippeMertz.jpg" alt="">
                                                </div>
                                                <div class="card-body card-body2">
                                                    <div class="cardtxtdiv">
                                                        <h5 class="card-title text-danger">Le voyage du personnage - رحلة الشخصية </h5>
                                                        <p class="card-text text-dark">Philippe Mertz - Theater writing coach (France) - فيليب ميرتز – كاتب ومدرب كتابة مسرحية (فرنسا)</p>
                                                    </div>
                                                    <div class="cardbtndiv">
                                                        <label for="select3">
                                                            <span class="btn btn-danger">Select</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

            

                                <div class="carousel-item align-content-center">
                                    <div class="row justify-content-center">

                                        <!-- Card 4 -->
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <input type="radio" id="select4" name="selected_card" value="Meinser Technique for Scene Development" class="card-checkbox">
                                            <div class = "card card-selectable" style="width: 18rem; height: 50rem";>
                                                <div class="IMG-card">
                                                    <img class = "card-img-top" src = "assets/images/jhonfreeman.jpg" alt="">
                                                </div>
                                                <div class="card-body card-body2">
                                                    <div class="cardtxtdiv">
                                                        <h5 class="card-title text-danger">Meinser Technique for Scene Development - تقنية مايسنر لتطوير المشهد</h5>
                                                        <p class="card-text text-dark">Jhon Freeman - Professor of Theater (Australia) - جون فريمان -أستاذ المسرح( أستراليا) </p>
                                                    </div>
                                                    <div class="cardbtndiv">
                                                        <label for="select4">
                                                            <span class="btn btn-danger">Select</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Card 5 -->
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <input type="radio" id="select5" name="selected_card" value="Le masque et le corps du personnage" class="card-checkbox">
                                            <div class = "card card-selectable" style="width: 18rem; height: 50rem";>
                                                <div class="IMG-card">
                                                    <img class = "card-img-top" src = "assets/images/profileICON.jpg" alt="">
                                                </div>
                                                <div class="card-body card-body2">
                                                    <div class="cardtxtdiv">
                                                        <h5 class="card-title text-danger">Sample</h5>
                                                        <p class="card-text text-dark">Sample description</p>
                                                    </div>
                                                    <div class="cardbtndiv">
                                                        <label for="select5">
                                                            <span class="btn btn-danger">Select</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Card 6 -->
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <input type="radio" id="select6" name="selected_card" value="Le masque et le corps du personnage" class="card-checkbox">
                                            <div class = "card card-selectable" style="width: 18rem; height: 50rem";>
                                                <div class="IMG-card">
                                                    <img class = "card-img-top" src = "assets/images/profileICON.jpg" alt="">
                                                </div>
                                                <div class="card-body card-body2">
                                                    <div class="cardtxtdiv">
                                                        <h5 class="card-title text-danger">Sample</h5>
                                                        <p class="card-text text-dark">Sample description</p>
                                                    </div>
                                                    <div class="cardbtndiv">
                                                        <label for="select6">
                                                            <span class="btn btn-danger">Select</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                </div>
                                
                                <div class="carousel-item align-content-center">
                                    <div class="row justify-content-center">

                                        <!-- Card 7 -->
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <input type="radio" id="select7" name="selected_card" value="Meinser Technique for Scene Development" class="card-checkbox">
                                            <div class = "card card-selectable" style="width: 18rem; height: 50rem";>
                                                <div class="IMG-card">
                                                    <img class = "card-img-top" src = "assets/images/profileICON.jpg" alt="">
                                                </div>
                                                <div class="card-body card-body2">
                                                    <div class="cardtxtdiv">
                                                        <h5 class="card-title text-danger">Sample</h5>
                                                        <p class="card-text text-dark">Sample description</p>
                                                    </div>
                                                    <div class="cardbtndiv">
                                                        <label for="select7">
                                                            <span class="btn btn-danger">Select</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Card 8 -->
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <input type="radio" id="select8" name="selected_card" value="Le masque et le corps du personnage" class="card-checkbox">
                                            <div class = "card card-selectable" style="width: 18rem; height: 50rem";>
                                                <div class="IMG-card">
                                                    <img class = "card-img-top" src = "assets/images/profileICON.jpg" alt="">
                                                </div>
                                                <div class="card-body card-body2">
                                                    <div class="cardtxtdiv">
                                                        <h5 class="card-title text-danger">Sample</h5>
                                                        <p class="card-text text-dark">Sample description</p>
                                                    </div>
                                                    <div class="cardbtndiv">
                                                        <label for="select8">
                                                            <span class="btn btn-danger">Select</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Card 9 -->
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <input type="radio" id="select9" name="selected_card" value="Le masque et le corps du personnage" class="card-checkbox">
                                            <div class = "card card-selectable" style="width: 18rem; height: 50rem";>
                                                <div class="IMG-card">
                                                    <img class = "card-img-top" src = "assets/images/profileICON.jpg" alt="">
                                                </div>
                                                <div class="card-body card-body2">
                                                    <div class="cardtxtdiv">
                                                        <h5 class="card-title text-danger">Sample</h5>
                                                        <p class="card-text text-dark">Sample description</p>
                                                    </div>
                                                    <div class="cardbtndiv">
                                                        <label for="select9">
                                                            <span class="btn btn-danger">Select</span>
                                                        </label>
                                                    </div>
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
                
                <div class="mybutton1 d-grid gap-2">
                        <button class="btn btn-danger" type="submit">Submit</button>
                        <?php if (!empty($message) && ($message != "Registered successfully!")): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <?php 
                                    echo $message; 
                                ?>
                            </div>
                        <?php elseif(!empty($message) && ($message == "Registered successfully!")) : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <?php 
                                    echo $message; 
                                ?>
                            </div>
                        <?php endif; ?>
                </div>
                    

            </form>
                          
        </div>
    </div>


    
    <!-- bootstrap js -->
    <script src = "assets/JavaScript/bootstrap.bundle.min.js"></script>
    <!-- javascript -->
    <script src = "assets/JavaScript/main.js"></script>
    

</body>
</html>
