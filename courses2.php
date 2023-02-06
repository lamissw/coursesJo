<?php
        
  require_once 'login.php';
  session_start();
  $user_id = $_SESSION['user_id'];

  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);
  
  $query = "SELECT * FROM courses";
  $result = $conn->query($query);
  
  $rows = $result->num_rows;
  
  
   //print_r($_POST['id']);
   
if(isset($_POST['insert'])) 

{
    //print_r("HELLO");
    $id = $_POST['insert'];
    
    $query2 = "INSERT INTO purchases(cust_id,course_id) VALUES($user_id, $id)";
    
    $result2 = $conn->query($query2);
    
}

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

        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
          <a class="navbar-brand" href="#">CoursesJo</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
    
          <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item ">
                <a class="nav-link" href="#">Home </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="courses2.php"><span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="cart.php">Cart</a>
              </li>
             
              <li class="nav-item ">
                <a class="nav-link" href="info.php">Account</a>
              </li>
              
              <li class="nav-item ">
                <a class="nav-link" href="LoginPage.php">Log out</a>
              </li>
              
            </ul>
          </div>
        </nav>

<form action = "courses2.php" method="post">
    <div class="album py-5 bg-light mt-5">

       <div class="container">

          <div class="row">
           
_END;
        for($i=0; $i<$rows; ++$i){
          $result->data_seek($i);
          $row = $result->fetch_array(MYSQLI_NUM);
        
          echo <<<_END
           <div class="col-lg-4 col-md-6 col-sm-6">
               <div class="card mb-4 box-shadow">
               <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="$row[6]" data-holder-rendered="true">
                 
                <div class="card-body">
                      <h3 style="text-align:center">$row[1]</h3>
                      <h4>$$row[4]</h4>
                      <p>"$row[2]"</p>
                      <p>Given by <span style="font-weight:itallic">$row[3]</span></p>
                      <p>$row[5] hours</p>
                  <div class="d-flex  align-items-center">
                    <div class="btn-group ">
                      <button type="submit" class="btn btn-info btn-lg btn-block"style="background-color:#274472; " id ="addToBasket" value = "$row[0]" name = "insert">
                         <span style="color: white;">Add to cart</span>
                       </button>
                    </div>
                    
                  </div>
                </div>
              </div>
             </div>
           
_END;
}
echo <<<_END
 
           </div>
         </div>
       </div>
    </form> 
_END;

?>