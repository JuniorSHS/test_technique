<?php
session_start();
$connection = mysqli_connect("localhost","root","","adminpanel");
include('includes/header.php'); 
?>



<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

  <div class="col-xl-6 col-lg-6 col-md-6">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Connexion</h1>
                <?php    
                

                if(isset($_POST['login_btn']))
                {
                    $email_login = $_POST['email']; 
                    $password_login = $_POST['password']; 

                    $query = "SELECT * FROM register WHERE email='$email_login' AND password='$password_login' ";
                    $query_run = mysqli_query($connection, $query);

                   if(mysqli_fetch_array($query_run))
                   {
                        $_SESSION['username'] = $email_login;
                        header('Location: index.php');
                   } 
                   else
                   {
                        $_SESSION['status'] = "Email ou mot de passe incorrect";
                        header('Location: login.php');
                   }

                }

                    if(isset($_SESSION['status']) && $_SESSION['status'] !='') 
                    {
                        echo '<h5 style="background: #F2DEDE; color: #A94442; padding: 10px; width: 95%; text-align: center; border-radius: 5px; margin: 20px auto;"> '.$_SESSION['status'].' </h5>';
                        unset($_SESSION['status']);
                    }
                ?>
              </div>

                <form class="user" method="POST">

                    <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-user" placeholder="Entrer votre adresse mail">
                    </div>
                    <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-user" placeholder="Votre mot de passe">
                    </div>
                    <button type="submit" name="login_btn" class="btn btn-primary btn-user btn-block"> Login</button>
                    <hr>
                </form>


            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>

</div>


<?php
include('includes/scripts.php'); 
?>