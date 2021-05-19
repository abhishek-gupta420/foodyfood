<?php if(isset($_SESSION['msg'])){?>
           
           <div class="alert alert-warning alert-dismissible fade show" role="alert">
                   <strong> <?php echo $_SESSION['msg']?></strong> 
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
                   
           </div>
           <?php
           unset($_SESSION['msg']);
       }
       ?>