 <!-- Modal -->
 <div class="modal fade" id="signupModel" tabindex="-1" aria-labelledby="signupModelLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="signupModelLabel">Signup to I-Discuss</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">

                 <form action="part/_handleSignip.php" method="post">
                     <div class="mb-3">
                         <label for="exampleInputEmail1" class="form-label">Username</label>
                         <input type="text" class="form-control" id="signupEmail" name="signupEmail" aria-describedby="emailHelp"> 
                     </div>
                     <div class="mb-3">
                         <label for="exampleInputPassword1" class="form-label">Password</label>
                         <input type="password" class="form-control" id="signupPassword" name="signupPassword">
                     </div>

                     <div class="mb-3">
                         <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                         <input type="password" class="form-control" id="signupCpassword" name="signupCpassword">
                     </div>
                     <!-- <div class="mb-3">
                         <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                         <input type="password" class="form-control" id="exampleInputPassword1">
                     </div> -->
                     <button type="submit" class="btn btn-primary">Signup</button>
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

             </div>
             <!-- <div class="modal-footer">
             </div> -->
             </form>
         </div>
     </div>
 </div>