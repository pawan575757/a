
<?php include 'include/project-page.php';  ?> 

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="project-details.css">
</head>

<body>

  <?php include 'header.php' ?>

  <section class="py-3 " style="background-color: #f1f1f1;">
    <?php  $cat=explode('++',$res['catid']); ?>


                              
                              
    <div class="container">
      <h3 class="text-center" style="font-weight: 700;"><?php echo $res['name']; ?> <?php echo strtr($cat[0],'[]','++'); ?> at <?php echo $row_location['name'] ?> 
</h3>
    </div>

  </section>


<section class="d-none d-lg-block d-xl-block d-md-block" style="background: linear-gradient(rgba(0, 0, 0, .4), rgba(0, 0, 0, .4)), url('https://cloud.famproperties.com/project/large/tilal-al-ghaf-344333-113415.jpg');
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center center;
  color: #fff;
  object-fit: cover;
  height: 700px;
  padding-top: 20%;
  color: white;">
  <div class="container text-center mx-auto ">
   
      <h1 class="titles" style="font-size: 46px;font-weight: 700;">

       <?php echo $res['name'] ?> By <?php echo $row_developer['name'] ?>

      </h1>
      <h3> <?php if (is_null($res['tagline'])){
          echo "";

        }

        else{
          echo $res['tagline'];
        }
        ?></h3>
   
  </div>
</section>


<section class="d-block d-lg-none d-xl-none d-md-none" style="background: linear-gradient(rgba(0, 0, 0, .4), rgba(0, 0, 0, .4)), url('https://cloud.famproperties.com/project/large/tilal-al-ghaf-344333-113415.jpg');
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center center;
  color: #fff;
  height: 67vh;
  padding-top: 30%;
  color: white;">
  <div class="container text-center mx-auto ">
   
      <h1 class="titles" style="font-size: 46px;font-weight: 700;"> <?php echo $res['name'] ?> By <?php echo $row_developer['name'] ?></h1>
      <h3><?php if (is_null($res['tagline'])){
          echo "";

        }

        else{
          echo $res['tagline'];
        }
        ?></h3>
   
  </div>
</section>

  

          <div class="container mt-5 mb-5">
             <div class="row">

              <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 col-12">

                <div class="row"><!----- inner row---->

                  <div class="col-lg-4 col-md-4 col-xl-4 col-sm-12 col-12 mb-4">
                    <div>
                      <span><i class=" fa fa-key fa-2x"></i></span> &nbsp;&nbsp;&nbsp;&nbsp; 
                      <span style="font-size: 20px;font-weight: 600;"><?php echo $res['completion-date']; ?></span> &nbsp;
                      <span style="font-size: 15px;font-weight: 500;color: grey;">Completion date</span> 
                    </div>  
                  </div><!------col-lg-4-end--------------------->

                   <div class="col-lg-4 col-md-4 col-xl-4 col-sm-12 col-12 mb-4">
                    <div>
                      <span><i class=" fa fa-user fa-2x"></i></span> &nbsp;&nbsp;&nbsp;&nbsp; 
                      <span style="font-size: 20px;font-weight: 600;"><?php echo $row_developer['name']; ?></span> &nbsp;
                      <span style="font-size: 15px;font-weight: 500;color: grey;">Developer</span> 
                    </div>  
                  </div><!------col-lg-4-end--------------------->

                   <div class="col-lg-4 col-md-4 col-xl-4 col-sm-12 col-12 mb-4">
                    <div>
                      <span><i class=" fa fa-home fa-2x"></i></span> &nbsp;&nbsp;&nbsp;&nbsp; 
                      <span style="font-size: 20px;font-weight: 600;"><?php echo $res['title-type']; ?></span> &nbsp;                
                            <span style="font-size: 15px;font-weight: 500;color: grey;">Title Type </span> 
                    </div>  
                  </div><!------col-lg-4-end--------------------->

                  <div class="col-lg-4 col-md-4 col-xl-4 col-sm-12 col-12 mb-4">
                    <div>
                      <span><i class=" fa fa-diamond fa-2x"></i></span> &nbsp;&nbsp;&nbsp;&nbsp; 
                      <span style="font-size: 20px;font-weight: 600;"><?php echo $res['lifestyle']; ?></span> &nbsp;                     
                       <span style="font-size: 15px;font-weight: 500;color: grey;">Lifestyle</span> 
                    </div>  
                  </div><!------col-lg-4-end--------------------->

                  <div class="col-lg-4 col-md-4 col-xl-4 col-sm-12 col-12 mb-4">
                    <div>
                      <span><i class=" fa fa-home fa-2x"></i></span> &nbsp;&nbsp;&nbsp;&nbsp; 
                      <span style="font-size: 20px;font-weight: 600;">

                       <?php if($res['plan'] == 1){
                        echo " Yes ";

                       }
                       else{
                        echo "No";
                       }
                       ?>
                      </span>   &nbsp;            
                              <span style="font-size: 15px;font-weight: 500;color: grey;">Off-plan</span> 
                    </div>  
                  </div><!------col-lg-4-end--------------------->

                 
                  
                </div><!-----inner row end-->
                
              </div><!---col---end------------->
               
             </div><!---------row-end--->
           </div> <!--------------container-end--------------->
  <?php 
             $price_number= $res['price'];

 $number_format_vietnam = number_format($price_number, 3, ',', ',');

?>

  <div class="container-fluid text-center py-3">
    <h3 style="font-size: 20px;font-weight: 600;">Starting price</h3>
    <h1 style="font-weight: 700;color: #2e2e2e !important;">AED <?php echo $number_format_vietnam; ?></h1>
  </div>

  <section style="background-color: #fffeee !important;" class="py-5">
    <div class="container">
    <h2 class="text-center py-3" style="font-size:36px;font-weight:700;"><?php echo $res['name'] ?> Payment plans</h2>
    <div  class="container mx-auto">
<div class="col-lg-7 col-xl-7 col-12 col-sm-12 col-md-10 mx-auto">
        <div class="row">

        <div class="col-lg-6 col-sm-6 col-md-6 col-6 col-xl-6 mb-3" ;>
          <div style="box-shadow:0 0 12px 1px #477d8a28!important;border-radius: 13px;background-color: white;">
            
          <i class="far fa-power-off fa-3x"></i>
       
          <div class="card-body">
            <h2 style="font-size:45px;font-weight:700;"><?php echo $res['first-installment'] ?>%</h2>
            <h4 style="color:black;font-size: 25px;font-weight: 700;">First Installement</h4>
          </div>
        </div>
        </div>


          <div class="col-lg-6 col-sm-6 col-md-6 col-6 col-xl-6 mb-3" ;>
          <div style="box-shadow:0 0 12px 1px #477d8a28!important;border-radius: 13px;background-color: white;">
          <i class="far fa-cog fa-3x"></i>
          <div class="card-body">
            <h2 style="font-size:45px;font-weight:700;"><?php echo $res['under-construction'] ?>%</h2>
            <h4 style="color:black;font-size: 25px;font-weight: 700;">Under Construction</h4>
          </div>
        </div>
        </div>


<div class="col-lg-6 col-sm-6 col-md-6 col-6 col-xl-6 mb-3" ;>
          <div style="box-shadow:0 0 12px 1px #477d8a28!important;border-radius: 13px;background-color: white;">
          <i class="fal fa-check-circle fa-3x"></i>
          <div class="card-body">
           <h2 style="font-size:45px;font-weight:700;"><?php echo $res['handover'] ?>%</h2>
            <h4 style="color:black;font-size: 25px;font-weight: 700;">Handover</h4>
          </div>
        </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-6 col-xl-6 mb-3" ;>
          <div style="box-shadow:0 0 12px 1px #477d8a28!important;border-radius: 13px;background-color: white;">
          <i class="fal fa-handshake fa-3x"></i>
          <div class="card-body">
             <h2 style="font-size:45px;font-weight:700;"><?php echo $res['post-handover'] ?>%</h2>
            <h4 style="color:black;font-size: 25px;font-weight: 700;">Post Handover</h4>
          </div>
        </div>
        </div>
      
          </div>
        </div>
        </div>
      </div>
    </div>

  
</section>


<div class="container py-5 mt-4">
    
      <h3 class="text-center" style="font-size: 32px;font-weight: 600;">Video virtual tour</h3>
      <div class="col-lg-12 col-md-12 col-12 col-sm-12 mx-auto py-3">
      <iframe src="https://www.youtube.com/embed/TwjKXiCsTH4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="height: 80vh;width: 100%;"></iframe>
    </div>
    </div>


<section class="mb-5">
   
   <div class="container mt-1">
    <h3 class="text-center" style="font-size: 29px;font-weight: 600;">We accept all types of payments</h3>

    <div  class="col-lg-10 col-md-12 col-sm-12 col-12 py-4 mx-auto">
      <div class="row">

        <div class="col-6 col-sm-6 col-lg-3 col-md-3 ">
          <li><span class="fab fa-bitcoin fa-2x"></span>
            <div style="padding-top:10px;">
              Bitcoin
            </div>
          </li>
        </div>

         <div class="col-6 col-sm-6 col-lg-3 col-md-3 ">
          <li><span class="fa fa-money fa-2x"></span>
            <div style="padding-top:10px;">
              Cheque
            </div>
          </li>
        </div>

 <div class="col-6 col-sm-6 col-lg-3 col-md-3 ">
          <li><span class="fa fa-university fa-2x"></span>
            <div style="padding-top:10px;">
              Bank Transfer
            </div>
          </li>
        </div>

 <div class="col-6 col-sm-6 col-lg-3 col-md-3 ">
          <li><span class="fa fa-road fa-2x"></span>
            <div style="padding-top:10px;">
              Credit card
            </div>
          </li>
        </div>


        
      </div>
    </div>
    
  </div>


</section>



  

  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active" data-bs-interval="1000">
        <img src="https://cloud.famproperties.com/project/large/tilal-al-ghaf-344372-193648.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item" data-bs-interval="2000">
        <img src="https://cloud.famproperties.com/project/large/tilal-al-ghaf-344367-193639.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item" data-bs-interval="3000">
        <img src="https://cloud.famproperties.com/project/large/tilal-al-ghaf-344314-121100.jpg" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>


 <?php  $features=explode('++',$res['features']); 

        $view=explode('++',$res['view']);

        $nearby=explode('++',$res['nearby']);

$agents=explode('++',$res['agent']);

        ?>      
 
 

  <section style="background-color:#FFFEEE;" class="pt-5 pb-5">

    <div  class="container">
      <h1 class="pt-4 pb-3">Amenities</h1>
      <div class="row">

        <?php foreach ($features as $item) {
   

                            ?>

                   <div class="col-sm-12 col-md-6 col-lg-3 mb-3 col-12">
          <span class="gray-para"><i class="fa fa-check"></i> <?php echo $item; ?></span>
        </div>          

                          <?php } ?>
       
        
      </div>

    </div>
  </section>

  <div class="container pb-3 pt-5 mt-1">
   
   <?php include 'project-form.php'; ?>
     

    </div>
    
  



  <div class="container pb-3">
    <div class="text-center">
      <button type="button" class="btn btn-dark"><i class="fas fa-th"></i> Sell your property</button>
    </div>
  </div>


   <div class="container mt-4 pb-5 mb-5">
        


<!-------------map start---------------------------->


<div class="mapouter"><div class="gmap_canvas"><iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=<?php echo $row_location['name'] ?> &amp;t=&amp;z=10&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://www.fridaynightfunkin.net/friday-night-funkin-mods-fnf-play-online/">FNF Mods</a></div><style>.mapouter{position:relative;text-align:right;width:100%;height:400px;}.gmap_canvas {overflow:hidden;background:none!important;width:100%;height:460px;}.gmap_iframe {height:400px!important;}</style></div>

</div>


 

 <section>
    <div id="paragraph" class="container">
      <h3 style="font-size:42px;font-weight:700;"><?php echo $res['name'] ?>  Overview</h3>
      <p><?php echo $res['description'] ?></p>
    </div>
 </section>


  <section style="background-color: #fffeee;" class="pt-5 pb-4">
    <div class="container">
      <h3 style="font-weight: 700;font-size: 37px;">Views</h3>
      <div class="row">

         <?php foreach ($view as $view_list) {
   

                            ?>     

 <div class="col-md-6 col-lg-4 col-sm-12 col-12 mb-2">
        <div class="p-2" style="border:1px solid #ececec; margin-bottom:10px;background-color: #f3f3f3;" >
          <h5 style="font-size:16px !important;"><?php echo $view_list; ?></h5>
        </div>
      </div>
                          <?php } ?>

     <!-------col--->

      </div><!--row------------>
</div><!------------container---------->
</section>



    <section class="py-5">
      <div class="container">
        <h3 class="mb-3" style="font-weight: 700;font-size: 37px;">Nearby Places</h3>
        <div class="row ">

            <?php foreach ($nearby as $nearby_list) {
   

                            ?>
<div class="col-lg-4 col-md-4 col-sm-12 col-12 mb-3">
            <div class="p-2 " style="border:1px solid #ececec;"> 
              <h5 style="font-size:16px !important;"><?php echo $nearby_list; ?></h5>
            </div>
          </div>
                          <?php } ?>
          
        </div>
      </div>
</section>



   <?php include 'include/project-agents.php' ?>


<?php // include 'include/property-table.php' ?>

  <section class="py-3 mb-3" style="">
           
           <div class="container mt-3 py-3" style="box-shadow: 0 0 12px 1px #477d8a28!important;border-radius:14px;">
             
             <h4 style="color:black;font-size: 31px;">Browse Projects By Dubai Areas</h4>

             <div class="mt-4">


<?php

  $sel_location = "SELECT * FROM `location_master` order By name asc";
  $res_location = mysqli_query($conn,$sel_location);

                      foreach ($res_location as $key => $value){
                    ?>

                <a class="btn btn-light mb-2" href="project-locations.php?locid=<?php echo $value['locationid']; ?>" style="border:1px solid grey;border-radius: 25px;color: black;text-decoration: none;font-weight: 600;"> <?php echo ucfirst($value['name']);?></a>
                       
                             



                           <?php } ?>
                              

               
             </div><!-----------urls-------->

           </div>

         </section>


<?php include 'footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

</body>

</html>
