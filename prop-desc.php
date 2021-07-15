<?php include 'include/property-details.php';  ?> 


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
       <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>

<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<meta charset="utf-8">
       <link type = "image/x-icon" rel = "icon" href = "images/fc.jpg" />

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
 
  <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />

</head>
<script>
$(document).ready(function(){
  $("form").submit(function(){
    alert("Thank You! Your Details has been successfully sent to Property Owner");
  });
});
</script> 

<style >
  .img-hover-zoom {
  width: 100% !important;overflow: hidden !important;position: relative;
border-radius: 0px !important;}



/* Brightness-zoom Container */
.img-hover-zoom img {
  transition: transform 2s, filter 1.5s ease-in-out;
  transform-origin: center center;
  filter: brightness(70%);
}

/* The Transformation */
.img-hover-zoom:hover img {
  filter: brightness(90%);
  transform: scale(1.3);
}


.head-url{
  position: absolute !important;
   top: 20%;
    left: 50%;
  margin-top: -75px !important;
  margin-left: -150px !important;
  width: 300px !important;
  height: 150px !important;
}

.bottom-url{
  position: absolute !important;
   top: 95%;
    left: 50%;
  margin-top: -75px !important;
  margin-left: -150px !important;
  width: 300px !important;
  height: 200px !important;
}
.cat-img{
  width: 100% !important;
  object-fit: cover;
    object-position: center center;
}

.main-cat{
  margin-bottom: 30px !important;
}

.agent{
        position: absolute;
    bottom: 0;
    background: rgba(0,0,0,.5);
    width: 100%;
    height: 45px;
    border-radius: 0 0 0 15px;
  }

  .agent h5{
    color: #fff!important;
    padding-left: 100px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    height: 100%;
  }

   .thumb-img{
    height: 75px;
    width: 75px;
    position: absolute;
    bottom: 15px;
    background-size: 100% 100%;
    border: 3px solid #fff!important;
    left: 15px;
  }

  .big-img{
width: 100%;object-fit:cover;height: 74vh;
  }

  .small-img{
width: 100%;object-fit:cover;height: 35vh;
  }


@media only screen and (max-width: 720px) {
 
 .big-img{
width: 100%;object-fit:cover;height: 32vh !important;
  }

    .small-img{
width: 100%;object-fit:cover;height: 16vh !important;
  }
  
  .gallery-box{
    border:1px solid white;width:100% !important; padding-left: 0% !important;padding-right: 0% !important;
}

.count-img{
    position: absolute;color: white;margin-top:-56% !important;margin-left: 36% !important;font-size: 35px;font-weight: 700;
}

}

.gallery-box{
    padding-left: 5%;padding-right: 5%;border:0px solid white;
}

.count-img{
    position: absolute;color: white;margin-top:-38% ;margin-left: 42%;font-size: 35px;font-weight: 700;
}

</style>
<body>
  
<?php include 'header.php'; ?>


<!-------------------desktop-gallery----------------------->

<div class="container-fluid gallery-box mx-auto">

  <div class="row mx-auto">

    <div class="col-lg-8 col-xl-8 col-md-6 col-sm-12 col-12 mt-4">

      <div class="img-hover-zoom">

<?php 

// $name = implode('++',$_FILES['file']['name']);

$name = explode('++',$res['image']);

$total=count($name);




?>

<a href="admin/images/<?php echo strtr($name[0],'[]','++'); ?>" class="d-block figure" data-fancybox="gallery">
 <img class="big-img cat-img" src="admin/images/<?php echo strtr($name[0],'[]','++'); ?>" ></a>
      </div>
      
    </div><!------------col-lg-8-end------------->

       <div class="col-lg-4 col-md-6 col-sm-12 col-12">

        <div class="row">

     <div class="col-lg-12 col-xl-12 col-md-12 col-sm-6 col-6 mt-4">

      <div class="img-hover-zoom ">

                       
                          <a href="admin/images/<?php echo strtr($name[1],'[]','++'); ?>" class="d-block figure" data-fancybox="gallery">
  <img class="small-img cat-img" src="admin/images/<?php echo strtr($name[1],'[]','++'); ?>" style=""></a>
      </div>
      
    </div><!------------col-lg-12-end------------->


     <div class="col-lg-12 col-xl-12 col-md-12 col-sm-6 col-6 mt-4">

      <div style="position: relative;" class="img-hover-zoom">
                          <a href="admin/images/<?php echo strtr($name[2],'[]','++'); ?>" class="d-block figure" data-fancybox="gallery">
  <img class="small-img cat-img" src="admin/images/<?php echo strtr($name[2],'[]','++'); ?>" style=""></a>


<?php
 foreach ($name as $ins) {
   ?>
<div class="d-none">
    <a class="figure" data-fancybox="gallery" href="admin/images/<?php echo $ins; ?>" style="color: white;text-decoration: none;"> <img src="admin/images/<?php echo $ins; ?>" style=""></a><
</div>
                          
<?php } ?>


       <div class="count-img" style=""><a class="d-block figure" data-fancybox="gallery" href="admin/images/<?php echo strtr($name[0],'[]','++'); ?>" style="color: white;text-decoration: none;">+<?php echo $total; ?></a></div>
      </div>
      
    </div><!------------col-lg-12-end------------->


          
        </div><!-----------inner-row-end----------->
         
       </div><!------------col-lg-4-end----------->


    

  </div><!-----------row-------->
  

</div> <!--------container----------end---------->



<!-------------------desktop-gallery end----------------------->









<section style="background-color:#f6f4f2;" class="mt-5 py-4">
  <div class="container text-center">
    <h4 style="color: black;font-size: 32px;"><?php echo $row_cat['name'] ?> for <?php echo $row_type['name'] ?> in <?php echo $res['address'] ?>, <?php echo $row_location['name'] ?>, Dubai</h4>
  </div>
</section>

           
           <div class="container mt-5 mb-5">
             <div class="row">

              <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 col-12">

                <div class="row"><!----- inner row---->

                  <div class="col-lg-4 col-md-4 col-xl-4 col-sm-12 col-12 mb-4">
                    <div>
                      <span><i class=" fa fa-arrows fa-2x"></i></span> &nbsp;&nbsp;&nbsp;&nbsp; 
                      <span style="font-size: 25px;font-weight: 600;"><?php echo $res['lot_size'] ?></span> &nbsp;
                      <span style="font-size: 18px;font-weight: 500;color: grey;">Size</span> 
                    </div>  
                  </div><!------col-lg-4-end--------------------->

                   <div class="col-lg-4 col-md-4 col-xl-4 col-sm-12 col-12 mb-4">
                    <div>
                      <span><i class=" fa fa-bed fa-2x"></i></span> &nbsp;&nbsp;&nbsp;&nbsp; 
                      <span style="font-size: 25px;font-weight: 600;"><?php echo $res['bedroom'] ?></span> 
                      <span style="font-size: 18px;font-weight: 500;color: grey;">Bedroom</span> 
                    </div>  
                  </div><!------col-lg-4-end--------------------->

                   <div class="col-lg-4 col-md-4 col-xl-4 col-sm-12 col-12 mb-4">
                    <div>
                      <span><i class=" fa fa-bath fa-2x"></i></span> &nbsp;&nbsp;&nbsp;&nbsp; 
                      <span style="font-size: 25px;font-weight: 600;"><?php echo $res['bathroom'] ?></span>                       <span style="font-size: 18px;font-weight: 500;color: grey;">Bath</span> 
                    </div>  
                  </div><!------col-lg-4-end--------------------->

                  <div class="col-lg-4 col-md-4 col-xl-4 col-sm-12 col-12 mb-4">
                    <div>
                      <span><i class=" fa fa-user fa-2x"></i></span> &nbsp;&nbsp;&nbsp;&nbsp; 
                      <span style="font-size: 25px;font-weight: 600;"><?php echo $row_developer['name'] ?></span>                       <span style="font-size: 18px;font-weight: 500;color: grey;">Developer</span> 
                    </div>  
                  </div><!------col-lg-4-end--------------------->

                  <div class="col-lg-4 col-md-4 col-xl-4 col-sm-12 col-12 mb-4">
                    <div>
                      <span><i class=" fa fa-home fa-2x"></i></span> &nbsp;&nbsp;&nbsp;&nbsp; 
                      <span style="font-size: 25px;font-weight: 600;"><?php echo $row_cat['name'] ?></span>                       <span style="font-size: 18px;font-weight: 500;color: grey;">Type</span> 
                    </div>  
                  </div><!------col-lg-4-end--------------------->

                  <div class="col-lg-4 col-md-4 col-xl-4 col-sm-12 col-12 mb-4">
                    <div>
                      <span><i class=" fa fa-eye fa-2x"></i></span> &nbsp;&nbsp;&nbsp;&nbsp; 
                      <span style="font-size: 25px;font-weight: 600;"><?php echo $res['view'] ?></span>                       <span style="font-size: 18px;font-weight: 500;color: grey;">View</span> 
                    </div>  
                  </div><!------col-lg-4-end--------------------->

                  <div class="col-lg-4 col-md-4 col-xl-4 col-sm-12 col-12 mb-4">
                    <div>
                      <span><i class=" fa fa-lock fa-2x"></i></span> &nbsp;&nbsp;&nbsp;&nbsp; 
                      <span style="font-size: 25px;font-weight: 600;"><?php echo $res['permit'] ?></span>                       <span style="font-size: 18px;font-weight: 500;color: grey;">Permit No.</span> 
                    </div>  
                  </div><!------col-lg-4-end--------------------->
                  
                </div><!-----inner row end-->
                
              </div><!---col---end------------->
               
             </div><!---------row-end--->
           </div> <!--------------container-end--------------->


           <div class="container text-center">
             
             <h4 class="mb-4" style="color: #3e3e3e;font-size: 40px;font-weight: 600;"><?php echo $res['title'] ?></h4>

             <h4 class="mt-4" style="color: #2e2e2e;font-size: 40px;font-weight: 600;color: #2e2e2e !important;">Price</h4>
           <h3 class="" style="color: #3e3e3e;font-size: 48px;font-weight: 700;margin-top: -1%;">AED <?php echo $res['price'] ?></h3>


           <div class="row mt-5">

            <div class="col-lg-5 col-xl-5 col-md-8 col-10 col-sm-10 mx-auto">


              <div class="row"><!---inner row------------->

                <div class="col-lg-4 col-sm-4 col-md-4 col-4">

                  <div>
                        <a class="btn" href="tel:<?php echo $row_agent['phoneno'] ?>" style="background-color: grey;border-radius: 15px;border:1px solid #f1f1f1;padding: 15px 18px;"><i class="fa fa-phone fa-2x"></i></a>
                        <p style="font-size: 17px;font-weight: 600;">Call</p>
                  </div>
                  

                </div><!---------inner col end---------->



                <div class="col-lg-4 col-sm-4 col-md-4 col-4">

                  <div>
                        <a class="btn" href="wa.me/<?php echo $row_agent['phoneno'] ?>" style="background-color: grey;border-radius: 15px;border:1px solid #f1f1f1;padding: 15px 18px;"><i class="fa fa-whatsapp fa-2x"></i></a>
                        <p style="font-size: 17px;font-weight: 600;">Whatsapp</p>
                  </div>
                  

                </div><!---------inner col end---------->



                <div class="col-lg-4 col-sm-4 col-md-4 col-4">

                  <div>
                        <a class="btn" href="mailto:<?php echo $res['email'] ?>" style="background-color: grey;border-radius: 15px;border:1px solid #f1f1f1;padding: 15px 18px;"><i class="fa fa-envelope fa-2x"></i></a>
                        <p style="font-size: 17px;font-weight: 600;">Message</p>
                  </div>
                  

                </div><!---------inner col end---------->
                
              </div><!-----------inner-row-end------------>
              
            </div><!-------------col-end--------------->


             
           </div><!--------------button-row-end------------>

           </div>


           <section class="py-4 mt-5" style="background-color:#f0ecec;">

            <div class="container text-center">
              <p style="font-size:32px;font-weight:700;color: black;">We accept all types of payments</p>

                  
                  <div class="row py-3 pb-4">

                    <div class="col-lg-3 col-xl-3 col-md-6 col-sm-6 col-6 mb-3">

                      <div>
                        <span><i class="fa fa-university fa-2x"></i>&nbsp;&nbsp;&nbsp;<span style="font-size: 24px;font-weight:600;">Bank Transfer</span></span>
                      </div>
                      
                    </div><!------col end --------->


                    <div class="col-lg-3 col-xl-3 col-md-6 col-sm-6 col-6 mb-3">

                      <div>
                        <span><i class="fa fa-book fa-2x"></i>&nbsp;&nbsp;&nbsp;<span style="font-size: 24px;font-weight:600;">Cheques</span></span>
                      </div>
                      
                    </div><!------col end --------->


                     <div class="col-lg-3 col-xl-3 col-md-6 col-sm-6 col-6 mb-3">

                      <div>
                        <span><i class="fa fa-credit-card fa-2x"></i>&nbsp;&nbsp;&nbsp;<span style="font-size: 24px;font-weight:600;">Credit Card</span></span>
                      </div>
                      
                    </div><!------col end --------->


                     <div class="col-lg-3 col-xl-3 col-md-6 col-sm-6 col-6 mb-3">

                      <div>
                        <span><i class="fa fa-bitcoin fa-2x"></i>&nbsp;&nbsp;&nbsp;<span style="font-size: 24px;font-weight:600;">Bitcoin</span></span>
                      </div>
                      
                    </div><!------col end --------->
                    
                  </div><!---------row end----------->

            </div>
             
           </section>


           <div class="container mt-4">
             
             <h4 class="pt-5 pb-1" style="font-size:44px;color: #3e3e3e;font-weight:600;">About This Property</h4>
             <p class="pb-5" style="font-size:16px;font-weight: 500;"><?php echo $res['description'] ?></p>

           </div>


<section class="py-5" style="background-color: #f0ecec;">

  <div class="container">
                 <h4 class=" text-left pb-4" style="font-size:46px;color: black;font-weight:600;color: #3e3e3e;">Presented By</h4>

                 <div class="mx-auto mt-4" style="background-image:url('admin/img/<?php echo $row_agent['photo'] ?>');height: 162px;width: 162px;border-radius: 50%;background-size: cover;border:3px solid white;">
                   
                 </div>

                 <h4 class="text-center mt-2" style="color:black;"><?php echo $row_agent['name'] ?></h4>
                                  <h4 class="text-center pb-5" style="font-weight: 500;font-size: 19px;"><i><?php echo $row_agent['role'] ?></i></h4>


                          <?php include 'property-form.php' ?>




                           <h4 class="  pb-4" style="font-size:44px;color: #3e3e3e;font-weight:600;">Amenities</h4>

                                                      <div class="row">


                           <?php  $features=explode('++',$res['featureid']);


                                foreach ($features as $item) {
   

                            ?>

                             <div class="col-lg-3 col-sm-6 col-6 col-md-6 mb-4">

                              <div>

                                <i class="fa fa-check "></i> <span style="font-size:19px;font-weight:600;"><?php echo $item; ?></span>
                                
                              </div>
                              

                            </div><!--------col end------->

                          <?php } ?>
                             
                           </div><!-------amenities row end-------->

  </div>
  
</section>

         

         <div class="container mt-5">
        
          <h4 class="text-center  pb-4" style="font-size:42px;color: #3e3e3e;font-weight:600;"><?php echo $row_location['name'] ?> Location</h4>


<!-------------map start---------------------------->


<div class="mapouter"><div class="gmap_canvas"><iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=<?php echo $row_location['name'] ?> 1&amp;t=&amp;z=10&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://www.fridaynightfunkin.net/friday-night-funkin-mods-fnf-play-online/">FNF Mods</a></div><style>.mapouter{position:relative;text-align:right;width:100%;height:400px;}.gmap_canvas {overflow:hidden;background:none!important;width:100%;height:400px;}.gmap_iframe {height:400px!important;}</style></div>



<!---------------Map ended ------------------------------>


<!----------------------------------------------Similar property------------------->
          <h4 class=" mt-5 pt-3 pb-5" style="font-size:45px;color: black;font-weight:600;">Similar Properties in <?php echo $row_location['name'] ?> </h4>

           <div class="container mx-auto mt-4" style="margin-left: auto !important;margin-right: auto !important;">

<!---------------------------------similar property----------------------------->

         <?php include 'similar-property.php' ?>

<!--------------similar property--------------------------------->
</div ><!-----container--->

         </div>


         <section class="py-3 mb-3" style="">
           
           <div class="container mt-3 py-3" style="box-shadow: 0 0 12px 1px #477d8a28!important;border-radius:14px;">
             
             <h4 style="color:black;font-size: 31px;">Browse Properties By Dubai Areas</h4>

             <div class="mt-4">


<?php

  $sel_location = "SELECT * FROM `location_master` order By name asc";
  $res_location = mysqli_query($conn,$sel_location);

                      foreach ($res_location as $key => $value){
                    ?>

                <a class="btn btn-light mb-2" href="location-list.php?locid=<?php echo $value['locationid']; ?>" style="border:1px solid grey;border-radius: 25px;color: black;text-decoration: none;font-weight: 600;"> <?php echo ucfirst($value['name']);?></a>
                       
                             



                           <?php } ?>
                              

               
             </div><!-----------urls-------->

           </div>

         </section>


  <?php include 'footer.php'; ?>
</body>

</html>
