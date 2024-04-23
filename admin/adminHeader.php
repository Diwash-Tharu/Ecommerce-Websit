<?php
   // session_start();
?>
       
 <!-- nav -->
 <nav  class="navbar navbar-expand-lg navbar-light px-5" style="background-color: #DDDDDD;">  
    
    <a class="navbar-brand ml-5" href="">
    <a href='../home1.php'><img src="../dbimage/Logo2.png" width="130" height="70" alt="website logo"></a> 
    </a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0"></ul>
    
     <div class="user-cart">  
        <?php           
        if(isset($_SESSION['ID'])){
          ?>
          <a href="../logout.php" style="text-decoration:none;">
            <i class="fa fa-user mr-5" style="font-size:30px; color:#fff;" aria-hidden="true"></i>
         </a>
          <?php
        } else {
            ?>
            <a href="../logout.php" style="text-decoration:none;">
                    <i class="fa fa-sign-in mr-5" style="font-size:30px; color:#fff;" aria-hidden="true"></i>
            </a>

            <?php
        } 
        ?>
    </div> 
</nav>
