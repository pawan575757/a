<?php include_once 'include/config.php'; ?>


<style>
  .navbar-nav .nav-item .nav-link {
    padding: 0px 16px !important;
    font-size: 18px;
    font-weight: 600;
  }
  @media only screen and (max-width: 1176px) {
.navbar-nav .nav-item .nav-link {
    padding: 0px 12px !important;
    font-size: 16px;
    font-weight: 600;

}

#navbarNav{
  margin-left: 5% !important;
}
}

 @media only screen and (max-width: 1046px) {
.navbar-nav .nav-item .nav-link {
    padding: 0px 10px !important;
    font-size: 15px;
    font-weight: 600;

}
|
</style>

<header class="d-none d-lg-block d-xl-block d-md-block">
<nav class="navbar navbar-expand-md navbar-light  " style=" box-shadow: 0 2px 2px -2px rgba(0,0,0,.4);
">
    <a class="navbar-brand" href="index.php" > <img src="logo.png" width="160px" height="90px"> </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse nkl " id="navbarNav" style="margin-left: 9%;margin-top: -2%;">
      <ul class="navbar-nav ">
       
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Rent
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

            <?php  $sel_cat = "SELECT * FROM `cat_master` order By name asc";
                        $res_cat = mysqli_query($conn,$sel_cat);
                        

                  ?>

                  <?php foreach ($res_cat as $key => $value) {
                    $key = $key + 1;
                ?>

            <li><a class="dropdown-item" href="rent-property.php?catid=<?php echo $value['catid']; ?>">Dubai <?php echo $value['name']; ?></a></li>

          <?php } ?>
            
          </ul>
        </li>
 <li class="nav-item active dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Buy
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
           <?php  $sel_cat = "SELECT * FROM `cat_master` order By name asc";
                        $res_cat = mysqli_query($conn,$sel_cat);
                        

                  ?>

                  <?php foreach ($res_cat as $key => $value) {
                    $key = $key + 1;
                ?>

            <li><a class="dropdown-item" href="sale-property.php?catid=<?php echo $value['catid']; ?>">Dubai <?php echo $value['name']; ?></a></li>

          <?php } ?>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="project.php">Project</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Sell</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Areas</a>
        </li>
                <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Developers
          </a>
           <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
           <?php  $sel_developer = "SELECT * FROM `developer_master` order By name asc";
                        $res_developer = mysqli_query($conn,$sel_developer);
                        

                  ?>

                  <?php foreach ($res_developer as $key => $value) {
                    $key = $key + 1;
                ?>

            <li><a class="dropdown-item" href="developer-projects.php?did=<?php echo $value['developerid']; ?>"> <?php echo $value['name']; ?></a></li>

          <?php } ?>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            New Homes
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Market-performance 2020</a></li>
            <li><a class="dropdown-item" href="#">Off-plan properties plan</a></li>
            <li><a class="dropdown-item" href="#">Buy Off-plan apartment in Dubai</a></li>
            <li><a class="dropdown-item" href="#">Buy Off-plan villa in Dubai</a></li>
            <li><a class="dropdown-item" href="#">Buy Off-plan townhouse in Dubai</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Blog</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           Others
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Tools</a></li>
            <li><a class="dropdown-item" href="#">Dubai-Estate</a></li>
            <li><a class="dropdown-item" href="#">Property management</a></li>
            <li><a class="dropdown-item" href="#">Dubai Real estate</a></li>
          </ul>
        </li>
        <li style=""><a style="margin-top: 13% !important;color: white;"  data-toggle="modal" data-target="#myModal" class ="btn btn-info nav-btn btn-block form-control" type="button" name="button" >Enquire Now</a></li>
      </ul>
    </div>
  </nav>
</header>



<!-------------------phone --------------------->

<header class="d-block d-lg-none d-xl-none d-md-none">
<nav class="navbar navbar-expand-md navbar-light  " style=" box-shadow: 0 2px 2px -2px rgba(0,0,0,.4);
">
    <a class="navbar-brand" href="index.php" > <img src="logo.png" width="190px" height="110px"> </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" style="margin-right:15px !important;">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Buy
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
             <?php  $sel_cat = "SELECT * FROM `cat_master` order By name asc";
                        $res_cat = mysqli_query($conn,$sel_cat);
                        

                  ?>

                  <?php foreach ($res_cat as $key => $value) {
                    $key = $key + 1;
                ?>

            <li><a class="dropdown-item" href="sale-property.php?catid=<?php echo $value['catid']; ?>">Dubai <?php echo $value['name']; ?></a></li>

          <?php } ?>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Rent
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php  $sel_cat = "SELECT * FROM `cat_master` order By name asc";
                        $res_cat = mysqli_query($conn,$sel_cat);
                        

                  ?>

                  <?php foreach ($res_cat as $key => $value) {
                    $key = $key + 1;
                ?>

            <li><a class="dropdown-item" href="rent-property.php?catid=<?php echo $value['catid']; ?>">Dubai <?php echo $value['name']; ?></a></li>

          <?php } ?>
          </ul>
        </li>

       <li class="nav-item ">
          <a class="nav-link " href="sale.php" >
            Sale
          </a>
         
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Areas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="project.php">Project</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Developers
          </a>
           <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
           <?php  $sel_developer = "SELECT * FROM `developer_master` order By name asc";
                        $res_developer = mysqli_query($conn,$sel_developer);
                        

                  ?>

                  <?php foreach ($res_developer as $key => $value) {
                    $key = $key + 1;
                ?>

            <li><a class="dropdown-item" href="developer-projects.php?did=<?php echo $value['developerid']; ?>"> <?php echo $value['name']; ?></a></li>

          <?php } ?>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            New Homes
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Market-performance 2020</a></li>
            <li><a class="dropdown-item" href="#">Off-plan properties plan</a></li>
            <li><a class="dropdown-item" href="#">Buy Off-plan apartment in Dubai</a></li>
            <li><a class="dropdown-item" href="#">Buy Off-plan villa in Dubai</a></li>
            <li><a class="dropdown-item" href="#">Buy Off-plan townhouse in Dubai</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Blog</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           Others
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Tools</a></li>
            <li><a class="dropdown-item" href="#">Dubai-Estate</a></li>
            <li><a class="dropdown-item" href="#">Property management</a></li>
            <li><a class="dropdown-item" href="#">Dubai Real estate</a></li>
          </ul>
        </li>
        <li class="text-left"><button  data-toggle="modal" data-target="#myModal" class ="btn btn-danger" type="button" name="button">Enquire Now</button></li>
      </ul>
    </div>
  </nav>
</header>



<!---------------modal---------------------->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Enquire Now</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
              
              <div class="form">
                <form class="form">
                  <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Name" value="">
                  </div>

                  <div class="form-group">
                    <input type="text" name="email" class="form-control" placeholder="Email" value="">
                  </div>

                  <div class="form-group">
                    <input type="text" name="phone" class="form-control" placeholder="Phone" value="">
                  </div>

                  <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Message" value="">
                  </div>

                  <div class="form-group mx-auto text-center">
                    <input type="button" name="submit" class="btn btn-warning" class="form-control" placeholder="Name" value="Send Enquiry">
                  </div>
                </form>
              </div>

        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  
</div>
