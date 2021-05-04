 <!-- Modal -->
 <div class="modal fade" id="loginModel" tabindex="-1" aria-labelledby="loginModelLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="loginModelLabel">Login to I-Discuss</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">

                 <form action="/forum/part/_handleLogin.php" method="post">
                     <div class="mb-3">
                         <label for="loginEmail" class="form-label">Username</label>
                         <input type="text" class="form-control" id="loginEmail" name="loginEmail" aria-describedby="emailHelp">
                     </div>
                     <div class="mb-3">
                         <label for="loginPass" class="form-label">Password</label>
                         <input type="password" class="form-control" id="loginPass" name="loginPass">
                     </div>
                     <button type="submit" class="btn btn-primary">Submit</button>
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> 

             </div>
             </form>
         </div>
     </div>
 </div>