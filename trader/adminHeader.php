
       

 <nav  class="navbar navbar-expand-lg navbar-light px-5" style="background-color: #e8e8e9;">
    
    <a class="navbar-brand ml-5" href="../home1.php">
    <img src="../dbimage/Logo2.png" width="110" height="90" alt="wesite logo"> 
    </a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0"></ul>
    
    <div class="user-cart">  
        <?php           
        if(isset($_SESSION['user_id'])){
          ?>
          <a href="" style="text-decoration:none;">
            <i class="fa fa-user mr-5" style="font-size:30px; color:#fff;" aria-hidden="true"></i>
         </a>
          <?php
        } else {
            ?>
            <a href="../home1.php" style="text-decoration:none;">
                    <i class="fa fa-sign-in mr-5" style="font-size:30px; color:#fff;" aria-hidden="true"></i>
            </a>

            <?php
        } ?>
    </div>  
</nav>
