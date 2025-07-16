<?php
    session_start();
    include("database.php");

    $error = "";
    
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
            $wrkshp_ID = 4;
        }
        elseif($workshop == "Le masque et le corps du personnage"){
            $wrkshp_ID = 5;
        }
        elseif($workshop == "Le voyage du personnage"){
            $wrkshp_ID = 6;
        }
        elseif($workshop == "Art of transformation"){
            $wrkshp_ID = 7;
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
            
            <form class="w-50" action="index.php" method="post">
                <div class="row d-flex align-items-center">
                    <div class="col">
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
                    <div class="col d-flex justify-self-center">
                        <div id = "c1" class = "carousel slide">
                            <div class="carousel-inner">

                                <div class="carousel-item active">
                                    <div class="row justify-content-center">
                                        <div class="col-12 col-sm-6 col-md-3">
                                            <input type="checkbox" id="select1" name="selected_card" value="Art of transformation" class="card-checkbox">
                                            <div class = "card card-selectable" style="width: 20rem; height: 50rem";>
                                                <img class = "card-img-top" src = "assets/images/Ronald_Rand_asHC.jpg" alt="">
                                                <div class="card-body">
                                                    <h5 class="card-title text-danger">Art of transformation - فن التحول</h5>
                                                    <p class="card-text text-dark">Ronald Rand - Cultural Ambassador and Professor of Theater (USA) - رونالد راند - سفير  ثقافي وأستاذ المسرح _الولايات المتحدة الأمريكية </p>
                                                    <label for="select1">
                                                        <span class="btn btn-danger">Select</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="row justify-content-center">
                                        <div class="col-12 col-sm-6 col-md-3">
                                            <input type="checkbox" id="select2" name="selected_card" value="Le masque et le corps du personnage" class="card-checkbox">
                                            <div class = "card card-selectable" style="width: 18rem; height: 50rem";>
                                                <img class = "card-img-top" src = "assets/images/de-maglio-2-scaled.jpg" alt="">

                                                <div class="card-body">
                                                    <h5 class="card-title text-danger">Le masque et le corps du personnage -  القناع و جسد الشخصية</h5>
                                                    <p class="card-text text-dark">Claudio de Maglio - Professor of Theater (Italy) - كلوديو دي ماجليو - أستاذ المسرح (إيطاليا)</p>

                                                    <label for="select2">
                                                        <span class="btn btn-danger">Select</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                </div>

                                <div class="carousel-item">
                                    <div class="row justify-content-center">
                                        <div class="col-12 col-sm-6 col-md-3">
                                            <input type="checkbox" id="select3" name="selected_card" value="Le voyage du personnage" class="card-checkbox">
                                            <div class = "card card-selectable" style="width: 18rem; height: 50rem";>
                                                <img class = "card-img-top" src = "assets/images/PhilippeMertz.jpg" alt="">

                                                <div class="card-body">
                                                    <h5 class="card-title text-danger">Le voyage du personnage - رحلة الشخصية </h5>
                                                    <p class="card-text text-dark">Philippe Mertz - Theater writing coach (France) - فيليب ميرتز – كاتب ومدرب كتابة مسرحية (فرنسا)</p>

                                                    <label for="select3">
                                                        <span class="btn btn-danger">Select</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                </div>

                                <div class="carousel-item">
                                    <div class="row justify-content-center">
                                        <div class="col-12 col-sm-6 col-md-3">
                                            <input type="checkbox" id="select4" name="selected_card" value="Meinser Technique for Scene Development" class="card-checkbox">
                                            <div class = "card card-selectable" style="width: 18rem; height: 50rem";>
                                                <img class = "card-img-top" src = "assets/images/jhonfreeman.jpg" alt="">

                                                <div class="card-body">
                                                    <h5 class="card-title text-danger">Meinser Technique for Scene Development - تقنية مايسنر لتطوير المشهد</h5>
                                                    <p class="card-text text-dark">Jhon Freeman - Professor of Theater (Australia) - جون فريمان -أستاذ المسرح( أستراليا) </p>

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
                </div>
                <div class="mybutton">
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
