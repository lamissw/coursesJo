<?php
session_start();

        echo <<<_END
    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
            integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
            crossorigin="anonymous"></script>
    
  
_END;
        
        require_once 'login.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) 
            die($conn->connect_error);
        
        
        if(isset($_POST['username'])&& isset($_POST['password'])){
             $username = get_post($conn, 'username');
             $password = get_post($conn, 'password'); 
             
        
        $query  = "SELECT * FROM customers WHERE email='$username' and password='$password'";
        $result = $conn->query($query);
        $count=$result->num_rows;
        echo $count;
        if($count==1){
            
            /// TO OBTAIN THE ID
            $result->data_seek(0);
            $row = $result->fetch_array(MYSQLI_NUM);
            $_SESSION['user_id'] = $row[0];
            
             echo '<script> window.location.href = "HomePage.php" </script>';
            exit();
        }
        else{
            echo "Login has failed, retry";
        }
         if (!$result) 
             die ( "Login has failed: " . $conn->error);
        }
        
        echo <<<_END
 
    <body>
        <section class="vh-100 mt-3">
            <div class="container py-5 " style=" border: 3px solid #f1f1f1; border-radius:25px; box-shadow:10px 10px 10px 0px">
              <div class="row  d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-7 col-xl-6 ">
                 <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
          class="img-fluid" alt="Phone image">
                </div>

                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1" style="margin-left:20px;margin-right:20px;">
                    
                    <div class="row">
                        <h2 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>
                      </div>
                    <form action = "LoginPage.php" method="post">
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form1Example13" >Enter your email</label>
                        <input type="email" id="form1Example13" name="username" required placeholder="Email Address" class="form-control form-control-lg" />
                    </div>
          
                    <!-- Password input -->
                    <div class="form-outline mb-4">
                     <label class="form-label" for="form1Example23">Enter your password</label>
                      <input type="password" id="form1Example23" required name="password" placeholder="Password" class="form-control form-control-lg" />
                      
                    </div>
          
                    <div class="pt-1 mb-4">
                        <button class="btn btn-info btn-lg btn-block" style="background-color:#274472" type="submit">Login</button>
                    </div>
                    <div class="pt-1 mb-4">
                      <p><a href="RegisterPage.php">Don't have an account? <span style="font-style: italic;">Sign Up</span></a></p>
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </section>
    </body>
_END;

 
  function get_post($conn, $var)  {    
     return $conn->real_escape_string($_POST[$var]);  } 
?>
