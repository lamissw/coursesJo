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
        
        
        if(isset($_POST['first_name']) && 
        isset($_POST['last_name']) && 
        isset($_POST['email']) && 
        isset($_POST['password']) && 
        isset($_POST['address']) && 
        isset($_POST['city']) && 
        isset($_POST['state'])&&isset($_POST['zip'])){
            
            
             $first_name = get_post($conn, 'first_name');
             $last_name = get_post($conn, 'last_name'); 
             $email = get_post($conn, 'email'); 
             $password = get_post($conn, 'password'); 
             $address = get_post($conn, 'address'); 
             $city = get_post($conn, 'city'); 
             $state = get_post($conn, 'state'); 
             $zip = get_post($conn, 'zip'); 
             
        
        $query  = "INSERT INTO customers (first_name,last_name,email,password,address,city,state,zip) VALUES('$first_name','$last_name','$email','$password','$address','$city','$state','$zip')";
        $result = $conn->query($query);
            if (!$result) 
                die ( "Registering has failed: " . $conn->error);
            
              
              $query  = "SELECT id from customers where email = '$email'";
		      $result = $conn->query($query);
		      if (!$result) die ("Database access failed: " . $conn->error);

	          $rows = $result->num_rows;
              $result->data_seek(0);
              $row = $result->fetch_array(MYSQLI_NUM);
              $_SESSION['user_id'] = $row[0];
           
              echo '<script> window.location.href = "HomePage.php" </script>';
        }
       
        
        echo <<<_END
 
    <body>
        <section class="vh-100 mt-5">
            <div class="container py-5 " style=" border: 3px solid #f1f1f1; border-radius:25px; box-shadow:10px 10px 10px 0px ">
              <div class="row d-flex align-items-center justify-content-center h-100 d-inline-block">
                <div class="col-md-8 col-lg-7 col-xl-6">
                 <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
          class="img-fluid" alt="Phone image">
                </div>

                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1" style="margin-left:20px;margin-right:20px;">
                    
                    <div class="row">
                        <h2 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign Up!</h2>
                      </div>
                      <form style="width: 23rem;" action='RegisterPage.php' method='post'>

                        <div class="row ">
                        <div class="col-lg-6 col-md-4 col-sm-6">
                            <div class="form-outline mb-2">
                                <label class="form-label" for="form2Example18">First Name</label>
                                <input type="text" id="form2Example18" required name="first_name" placeholder="First Name" class="form-control form-control-lg" />
                             
                            </div>
                            </div>
                            <div class="col-lg-6 col-md-4 col-sm-6">
                            <div class="form-outline mb-2">
                                <label class="form-label" for="form2Example18">Last Name</label>
                                <input type="text" id="form2Example18" required name="last_name" placeholder="Last Name"class="form-control form-control-lg" />
                               
                            </div>
                        </div>
                     </div>
                        <div class="form-outline mb-2">
                            <label class="form-label" for="form2Example18">Email address</label>
                            <input type="email" id="form2Example18" required name="email" placeholder="Email Address" class="form-control form-control-lg" />
                            
                        </div>

                        <div class="form-outline mb-2">
                            <label class="form-label" for="form2Example28">Password</label>
                            <input type="password" id="form2Example28" required name="password" placeholder="Password" class="form-control form-control-lg" />
                           
                        </div>

                        <div class="form-outline mb-2">
                            <label class="form-label" for="form2Example28">Address</label>
                            <input type="text" id="form2Example28" required  name="address" placeholder="Address" class="form-control form-control-lg" />
                          
                        </div>

                          <div class="row ">
                        <div class="col-lg-6 col-md-4 col-sm-6">
                            <div class="form-outline mb-2">
                                <label class="form-label" for="form2Example18">City</label>
                                <input type="text" id="form2Example18" required name="city" placeholder="City" class="form-control form-control-lg" />
                             
                            </div>
                            </div>
                            <div class="col-lg-6 col-md-4 col-sm-6">
                            <div class="form-outline mb-2">
                                <label class="form-label" for="form2Example18">State</label>
                                <input type="text" id="form2Example18" required name="state" placeholder="State"class="form-control form-control-lg" />
                               
                            </div>
                            
                        </div>
                     </div>

                       <div class="form-outline mb-2">
                            <label class="form-label" for="form2Example28">Zip</label>
                            <input type="text" id="form2Example28" required name="zip" placeholder="Zip" class="form-control form-control-lg" />
                          
                        </div>
                         

                        <div class="pt-1 mb-1">
                            <button class="btn btn-info btn-lg btn-block" type="submit" style="background-color:#274472" >Sign Up!</button>
                        </div>
                        <div class="pt-1 mb-4">
                            <p><a href="LoginPage.php">Already have an account? <span style="font-style: italic;">Log In</span></a></p>
                         </div>
                    </form>

                </div>
              </div>
            </div>
          </section>
    </body>
</html>
_END;
       
        
        $conn->close();
        function get_post($conn, $var)  {    
             return $conn->real_escape_string($_POST[$var]);  } 
?>
