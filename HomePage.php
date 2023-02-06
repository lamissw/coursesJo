<?php
session_start();
$user_id = $_SESSION['user_id'];


    echo <<<_END
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
          <script type="text/javascript" src="../public_html/yara/homepage.js"></script>
          <link src="StyleSheet.css"/>
       
        <style>
            .MultiCarousel {
                float: left;
                overflow: hidden;
                padding: 15px;
                width: 100%;
                position: relative;
            }
        
            .MultiCarousel .MultiCarousel-inner {
                transition: 1s ease all;
                float: left;
            }
        
            .MultiCarousel .MultiCarousel-inner .item {
                float: left;
            }
        
            .MultiCarousel .MultiCarousel-inner .item>div {
                text-align: center;
                padding: 10px;
                margin: 10px;
                background: #f1f1f1;
                color: #666;
            }
              .MultiCarousel .leftLst,
            .MultiCarousel .rightLst {
                position: absolute;
                border-radius: 50%;
                top: calc(50% - 20px);
            }
        
            .MultiCarousel .leftLst {
                left: 0;
            }
        
            .MultiCarousel .rightLst {
                right: 0;
            }
        
            .MultiCarousel .leftLst.over,
            .MultiCarousel .rightLst.over {
                pointer-events: none;
                background: #ccc;
            }
        </style>
        </head>
_END;

        require_once 'login.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) 
            die($conn->connect_error);
            
        $query  = "SELECT * FROM  courses";
        $result = $conn->query($query);
            if (!$result) 
                die ( "Registering has failed: " . $conn->error);
        
      
    echo <<<_END
    <body>
    <script>   $(document).ready(function () {
                var itemsMainDiv = ('.MultiCarousel');
                var itemsDiv = ('.MultiCarousel-inner');
                var itemWidth = "";

                $('.leftLst, .rightLst').click(function () {
                    var condition = $(this).hasClass("leftLst");
                    if (condition)
                        click(0, this);
                    else
                        click(1, this)
                });

                ResCarouselSize();




                $(window).resize(function () {
                    ResCarouselSize();
                });

                //this function define the size of the items
                function ResCarouselSize() {
                    var incno = 0;
                    var dataItems = ("data-items");
                    var itemClass = ('.item');
                    var id = 0;
                    var btnParentSb = '';
                    var itemsSplit = '';
                    var sampwidth = $(itemsMainDiv).width();
                    var bodyWidth = $('body').width();
                    $(itemsDiv).each(function () {
                        id = id + 1;
                        var itemNumbers = $(this).find(itemClass).length;
                        btnParentSb = $(this).parent().attr(dataItems);
                        itemsSplit = btnParentSb.split(',');
                        $(this).parent().attr("id", "MultiCarousel" + id);


                        if (bodyWidth >= 1200) {
                            incno = itemsSplit[3];
                            itemWidth = sampwidth / incno;
                        }
                        else if (bodyWidth >= 992) {
                            incno = itemsSplit[2];
                            itemWidth = sampwidth / incno;
                        }
                        else if (bodyWidth >= 768) {
                            incno = itemsSplit[1];
                            itemWidth = sampwidth / incno;
                        }
                        else {
                            incno = itemsSplit[0];
                            itemWidth = sampwidth / incno;
                        }
                        $(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });
                        $(this).find(itemClass).each(function () {
                            $(this).outerWidth(itemWidth);
                        });

                        $(".leftLst").addClass("over");
                        $(".rightLst").removeClass("over");

                    });
                }

                function ResCarousel(e, el, s) {
                    var leftBtn = ('.leftLst');
                    var rightBtn = ('.rightLst');
                    var translateXval = '';
                    var divStyle = $(el + ' ' + itemsDiv).css('transform');
                    var values = divStyle.match(/-?[\d\.]+/g);
                    var xds = Math.abs(values[4]);
                    if (e == 0) {
                        translateXval = parseInt(xds) - parseInt(itemWidth * s);
                        $(el + ' ' + rightBtn).removeClass("over");

                        if (translateXval <= itemWidth / 2) {
                            translateXval = 0;
                            $(el + ' ' + leftBtn).addClass("over");
                        }
                    }
                    else if (e == 1) {
                        var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
                        translateXval = parseInt(xds) + parseInt(itemWidth * s);
                        $(el + ' ' + leftBtn).removeClass("over");

                        if (translateXval >= itemsCondition - itemWidth / 2) {
                            translateXval = itemsCondition;
                            $(el + ' ' + rightBtn).addClass("over");
                        }
                    }
                    $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
                }

           
                function click(ell, ee) {
                    var Parent = "#" + $(ee).parent().attr("id");
                    var slide = $(Parent).attr("data-slide");
                    ResCarousel(ell, Parent, slide);
                }

            });
    </script>

        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
          <a class="navbar-brand" href="#">CoursesJo</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
    
          <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#"> <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="courses2.php">Courses</a>
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
    
      
          <div class="jumbotron" style="background-color:#41729F;">
            <div class="container mt-5" >
              <h1 class="display-3"><span style="color: #F0F0F0">Welcome to CourseJo</span></h1>
              <p>Start, switch, or advance your career with more than 5,400 courses, Professional Certificates, and degrees from world-class universities and companies.</p>
              <p><a class="btn btn-primary btn-lg" href="courses2.php" role="button" style="background-color:#274472">Our Courses!</a></p>
            </div>
          </div>
     

        <div class="container">
            <div class="row" style="justify-content: center; margin-bottom: 30px;">
                <h1>Most popular courses</h1>
            </div>
            <div class="row">
            <div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000" style="margin-bottom:70px; margin-top: 20px; ">
                    
                
_END;
                    
                    for ($j=0;$j<6;++$j){
                        $result->data_seek($j);
                        $row=$result->fetch_array(MYSQLI_NUM);
                        
                   echo <<<_END
                   <div class="MultiCarousel-inner">  
                       <div class="item" style="background-color:white">
                         <div class="pad15 "style="background-color:#274472">
                            <p class="lead" style="color:#F0F0F0 ; font-size:15px">course # $row[0]</p>
                            <p style="color:white ; font-weight:bold; font-size: 25px ">$row[1]</p>
                            <p style="color:#F0F0F0">$row[3]</p>
                         </div>
                      </div>
                    </div>
                     
                      
_END;
}
                        echo <<<_END
                        
                           </div>
                 
                </div>
                </div>
          

            
          <div class="container-fluid marketing" style="background-color:#F0F0F0"  >
          <div class="container">
              <div class="row" style="justify-content: center; margin-bottom: 30px; margin-left:20px;">
            <h1>Our Founders</h1>
             </div>
           
         
            <div class="row"style="margin-bottom:150px;">
                
_END;
        
                $FoundersQuery="SELECT * FROM Founders";
                $FoundersResult= $conn->query($FoundersQuery);
                    if (!$FoundersResult) 
                        die ( "Registering has failed: " . $conn->error);
        

                    $frows=$FoundersResult->num_rows;
                    for ($j=0;$j<$frows;++$j){
                        $FoundersResult->data_seek($j);
                        $founder=$FoundersResult->fetch_array(MYSQLI_NUM);
                        
                        echo <<<_END
                    <div class="col-lg-4">
                     <img class="rounded-circle " src="$founder[3]" alt="founder images" width="210" height="210" style="border:black 2px solid; margin-left:30px;">
                     <h2 style="margin-left:40px">$founder[1]</h2>
                     <p>$founder[2]</p>
                    
                    </div>
_END;
}
            echo <<<_END
             
                </div>
                </div>
    
               </div>
           
            
    
          
    <div class="container">
    
            <div class="row featurette"style="margin-bottom:20px; margin-top:20px;">
              <div class="col-md-7 order-md-2" style="margin-top:50px">
                <h1 class="featurette-heading font-italic" style="margin-top:50px;">Begin your academic journey, <span class="text-muted">from the comforts of your own home.</span></h1>
                <h2 class="lead" style="margin-top:50px;">Start learning and expanding your knowledge at your own pace </h2>
              </div>
              <div class="col-md-5 order-md-1">
                <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto"  data-holder-rendered="true" style="width: 500px; height: 500px; "src="images/image2.jpeg"">
              </div>
            </div>
    
    
    
          
            <hr class="featurette-divider">
    
            <div class="row featurette"style="margin-bottom:20px; margin-top:20px;">
              <div class="col-md-7" style="margin-top:50px">
                <h2 class="featurette-heading  font-italic">Join study groups, <span class="text-muted">where you can help your fellow student</span> </h2>
                <h2 class="lead" style="margin-top:50px;">Share your learning experince with your friends!</h2>
              </div>
              <div class="col-md-5">
                <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto"  data-holder-rendered="true" style="width: 500px; height: 500px"; src="images/image1.webp"">
              </div>
            </div>
    
           
    
           
    </div>
          </div>
          
     
          </div>
          <!-- Footer -->
<footer class="text-center text-lg-start " style="background-color:#41729F; color:#F0F0F0";>

    </div>



  <section class="">
    <div class="container text-center text-md-start mt-5">

      <div class="row mt-3">

        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4 mt-4">

          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fas fa-gem me-3"></i>CourseJo
          </h6>
          <p>
            CourseJo is a  massive open online course provider founded in 2023 by Princess Sumaya for Technology Software Engineering Students. CourseJo works with universities and other organizations to offer online courses, certifications, and degrees in a variety of subjects.
          </p>
        </div>
       
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4 mt-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Products
          </h6>
          <p class="text-reset">Courses</p>
          <p class="text-reset">Instructors</p>
          <p class="text-reset">Offers</p>
          
        </div>
       
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4 mt-4">
  
          <h6 class="text-uppercase fw-bold mb-4">
            Useful links
          </h6>
          <p class="text-reset">Pricing</p>
          <p class="text-reset">Settings</p>
          <p class="text-reset">Purchases</p>
          <p class="text-reset">Help</p>
        </div>
        
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4 mt-4">
        
          <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
          <p><i class="fas fa-home me-3"></i> Amman, Jordan </p>
          <p>
            <i class="fas fa-envelope me-3"></i>
            info@example.com
          </p>
          <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
          <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
        </div>
       
      </div>
  
    </div>
  </section>

            <p class="text-center">© Company since 2023</p>
 
         </footer>
        
    
      
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
        <script src="../../assets/js/vendor/popper.min.js"></script>
        <script src="../../dist/js/bootstrap.min.js"></script>
      
    
    </body>

_END;

    $result->close();
    $conn->close();
    
?>