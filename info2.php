<?php
session_start();
$user_id = $_SESSION['user_id'];

echo <<<_END
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<link href="css/info.css" rel="stylesheet">
_END;
//<script src="javascript/info.js"></script>

require_once 'login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);
  
  
/// UPDATE
if (isset($_POST['first_name'])   &&
      isset($_POST['last_name'])    &&
      isset($_POST['email']) &&
      isset($_POST['address'])     &&
      isset($_POST['city']) &&
      isset($_POST['state']) &&
      isset($_POST['zip']))
  {
    $fname = get_post($conn, 'first_name');
    $lname  = get_post($conn, 'last_name');
    $email = get_post($conn, 'email');
    $address = get_post($conn, 'address');
    $city = get_post($conn, 'city');
    $state = get_post($conn, 'state');
    $zip = get_post($conn, 'zip');
    
    
    $query    = "update customers set first_name = '$fname', last_name = '$lname', email = '$email', address = '$address', city = '$city', state = '$state', zip = '$zip' where id = $user_id";
    $result   = $conn->query($query);

  	if (!$result) echo "update failed: $query<br>" . $conn->error . "<br><br>";
  	
  	


}

//DELETION
  if (isset($_POST['delete']))
  {
      
      //print_r($_POST['delete']);

    foreach ($_POST['delete'] as $course_id)
    {   
        
        $query  = "DELETE FROM purchases WHERE course_id = $course_id and cust_id=$user_id";
        $result = $conn->query($query);
        
        if (!$result) echo "DELETE failed: $query<br>" . $conn->error . "<br><br>";
        
    }
    
    echo "<script> window.location.href = 'info.php'; </script>";
    
  }


  
  $query  = "SELECT * FROM customers where id=$user_id";
  $result = $conn->query($query);
  if (!$result) die ("Database access failed: " . $conn->error);

  $result->data_seek(0);
  $row = $result->fetch_array(MYSQLI_NUM);
  

echo <<<_END
<head>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
          <script type="text/javascript" src="../public_html/yara/homepage.js"></script>
          <link src="StyleSheet.css"/>
         
</head>
<body>
     <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
          <a class="navbar-brand" href="#">CoursesJo</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
         <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto" style="color:white">
              <li class="nav-item ">
                <a class="nav-link" href="HomePage.php">Home </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="courses2.php"></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="cart.php">Cart</a>
              </li>
             
              <li class="nav-item " style="margin-left:995px">
                <a class="nav-link" href="info.php"><span class="sr-only">(current)</span></a>
              </li>
<li class="nav-item ">
                <a class="nav-link" href="LoginPage.php">Log out</a>
              </li>
              
            </ul>
          </div>
        </nav>
        
  <div class="main-content">
    
    <!-- Header -->
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url(https://raw.githubusercontent.com/creativetimofficial/argon-dashboard/gh-pages/assets-old/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h1 class="display-2 text-white">Hello $row[1]</h1>
            <h5 class="text-white mt-0 mb-5"style="font-weight:normal">This is your profile page. You can see the courses you've purchased and your personal information.</h5>
          
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
        
        <form action="info2.php" method="post">
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">My account</h3>
                </div>
                <div class="col-4 text-right">
                  <input value="Save" type="button" class="btn btn-info btn-lg btn-block" onclick="submitForm(event)" style="background-color:#274472; "><span style="color: white;">Save</span></a>
                </div>
              </div>
            </div>
            <div class="card-body bg-light">
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-username">User ID</label>
                        <input type="text" id="input-username" class="form-control form-control-alternative" placeholder="Username" value="$row[0]" readonly>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email address</label>
                        <input type="email" id="input-email" class="form-control form-control-alternative" value="$row[3]" name="email"  placeholder="Email address">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">First name</label>
                        <input type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="First name" value="$row[1]" name="first_name">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-last-name">Last name</label>
                        <input type="text" id="input-last-name" class="form-control form-control-alternative" placeholder="Last name" value="$row[2]" name="last_name">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4">
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Contact information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-address">Address</label>
                        <input id="input-address" class="form-control form-control-alternative" placeholder="Home Address" value="$row[4]" type="text" name="address">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-city">City</label>
                        <input type="text" id="input-city" class="form-control form-control-alternative" placeholder="City" value="$row[5]" name="city">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-country">Country</label>
                        <input type="text" id="input-country" class="form-control form-control-alternative" placeholder="Country" value="$row[6]" name="state">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Postal code</label>
                        <input type="text" id="input-postal-code" class="form-control form-control-alternative" placeholder="Postal code" value="$row[7]" name="zip">
                      </div>
                    </div>
                  </div>
                </div>
                </form>
                <hr class="my-4">
                <!-- Description -->
                <h6 class="heading-small text-muted mb-4">Courses</h6>
                <div class="pl-lg-4">
                  <div class="form-group focused">
                    
_END;
                    $query  = "SELECT id, course_name, instructor, length FROM purchases, courses where id=course_id and cust_id=$user_id";
					$result = $conn->query($query);
					if (!$result) die ("Database access failed: " . $conn->error);

					$rows = $result->num_rows;
echo <<<_END
					
						<input type="submit" value="DELETE" class="small-button" >
                        <br><br>
						<table>
							<thead style="background-color: #274472; text-align: center;"><tr>
								<th style="color: #fff;">Course-ID</th>
								<th style="color: #fff;">Title</th>
								<th style="color: #fff;">Instructor</th>
								<th style="color: #fff;">Duration</th>
								<th style="color: #fff;"> <input type="checkbox" onclick="check_all()"></th>
							</tr><thead/>
_END;
					
					for ($j = 0 ; $j < $rows ; ++$j)
					{
						$result->data_seek($j);
						$row = $result->fetch_array(MYSQLI_NUM);
    
echo <<<_END
						<tbody>
						<tr>
						<td> $row[0]</td>
						<td> $row[1]</td>
						<td> $row[2]</td>
						<td> $row[3] hrs</td>
						<td> <input type="checkbox" name="delete[]" value="$row[0]"></td>
						</tr>
						
_END;
					}

                            echo "</tbody>";
						echo "</table>";
					
echo <<<_END
                    
                  </div>
                </div>
             
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="footer">
    <div class="row align-items-center justify-content-xl-between">
      <div class="col-xl-6 m-auto text-center">
        
      </div>
    </div>
  </footer>
</body>
_END;

$result->close();
$conn->close();

function get_post($conn, $var)
  {
    return $conn->real_escape_string($_POST[$var]);
  }
?>

<script>

function check_all() {
      // Get a reference to the main checkbox
  var checkbox = document.querySelector('input[type="checkbox"]');

  // Get a reference to the table
  var table = document.querySelector('table');

  // Get a list of all the checkboxes in the table
  var checkboxes = table.querySelectorAll('input[type="checkbox"]');

  // Iterate through the list of checkboxes
  for (var i = 0; i < checkboxes.length; i++) {
    // Set the checked property of each checkbox to the checked property of the main checkbox
    checkboxes[i].checked = checkbox.checked;
  }
}

  function submitForm(event) {
    event.preventDefault();
    document.forms[0].submit();
    
  }
  
 
  
</script>