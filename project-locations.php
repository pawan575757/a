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
</head>


<style >
  .img-hover-zoom {
  height: 450px;width: 100% !important;overflow: hidden !important;position: relative;
border-radius: 10px !important;}



/* Brightness-zoom Container */
.img-hover-zoom img {
  transition: transform 2s, filter 1.5s ease-in-out;
  transform-origin: center center;
  filter: brightness(50%);
}

/* The Transformation */
.img-hover-zoom:hover img {
  filter: brightness(80%);
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
  height: 450px !important;
  width: 100% !important;
  object-fit: cover;
    object-position: center center;
}

.main-cat{
  margin-bottom: 30px !important;
}

</style>
<body>
  
<?php include 'header.php'; ?>

<section class="mt-3" style="background-color: #D7BEB5 !important;padding-top:30px; padding-bottom: 30px;">
  <h4 class="text-center" style="color: black; font-size: 38px;">Projects in Dubai</h4>
</section>


<div class="container py-3 mt-5 px-3 mx-0   mx-auto" style="box-shadow: 0 0 12px 1px #477d8a28!important;">
  
  <h3 class="py-3">Search Projects</h3>

<div class="form">
  <form class="form">
    
    <div class="row mx-auto">

      <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-3 ">

        <div>
          <input type="text" name="" class="form-control" placeholder="Property Type">
        </div>

      </div><!----------col---------------->


      <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-3 ">

        <div>
          <input type="text" name="" class="form-control" placeholder="Developer">
        </div>

      </div><!----------col---------------->


      <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-3 ">

        <div>
          <input type="text" name="" class="form-control" placeholder="Area">
        </div>

      </div><!----------col---------------->


      <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-3 ">

        <div>
          <input type="text" name="" class="form-control" placeholder="Project">
        </div>

      </div><!----------col---------------->
      
    </div><!---row---------->

  </form>
</div>
</div>

<div class="container mt-3">
<div class="row mx-auto">
 
 <?php include 'include/project-locations-part.php'; ?>
  

</div><!--------------------------row-------------->


</div><!-------------container---------------->

  <!------------------footer-------------------->
  <?php include 'footer.php'; ?>
</body>

</html>
