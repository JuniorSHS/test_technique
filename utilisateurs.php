<?php
session_start();
if(!$_SESSION['username'])
{
    header('Location: login.php');
}
$connection = mysqli_connect("localhost","root","","adminpanel");
include('includes/header.php'); 
include('includes/navbar.php'); 

if(isset($_POST['utilisateursbtn']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];

    $email_query = "SELECT * FROM utilisateurs WHERE email='$email' ";
    $email_query_run = mysqli_query($connection, $email_query);
    if(mysqli_num_rows($email_query_run) > 0)
    {
        $_SESSION['status'] = "Cette adresse email est déjà prise.";
        $_SESSION['status_code'] = "error";
        header('Location: utilisateurs.php');  
    }
    else
    {
        $query = "INSERT INTO utilisateurs (username,email) VALUES ('$username','$email')";
            $query_run = mysqli_query($connection, $query);
            
            if($query_run)
            {
                
                $_SESSION['success'] = "Utilisateur ajouté.";
                $_SESSION['status_code'] = "success";
                header('Location: utilisateurs.php');
            }
            else 
            {
                $_SESSION['status'] = "Utilisateur non ajouté.";
                $_SESSION['status_code'] = "status";
                header('Location: utilisateurs.php');
            }
    }

}



?>



<div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nouvel utilisateur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Utilisateur </label>
                <input type="text" name="username" class="form-control" placeholder="Nom et prénom" required="">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="@domain.com" required="">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            <button type="submit" name="utilisateursbtn" class="btn btn-primary">Ajouter</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary"> 
            <button style="position: relative; left: 83%;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#adduser">
            <i class="fas fa-user-plus"> </i> Ajouter un utilisateur 
            </button>
    </h6>
  </div>

  <div class="card-body">

  <?php 
  
  if(isset($_SESSION['success']) && $_SESSION['success'] !='')
  {
    echo '<div id="bloc-10"><script> setInterval(function(){ var obj = document.getElementById("bloc-10"); obj.innerHTML = "";},3000);</script>
    <h5 style="background: #1FA055; opacity: 0.40; text-align: center; padding: 7px; color: #FFF; border-radius: 5px; width: 50%; margin: 20px auto;"> '.$_SESSION['success'].' </div></h5>';
    unset($_SESSION['success']);
  }
  
  if(isset($_SESSION['status']) && $_SESSION['status'] !='')
  {
    echo '<div id="bloc-10"><script> setInterval(function(){ var obj = document.getElementById("bloc-10"); obj.innerHTML = "";},3000);</script>
    <h5 style="background: #F2DEDE; text-align: center; padding: 7px; color: #ff0000; border-radius: 10px; width: 50%; margin: 20px auto;">'.$_SESSION['status'].' </div></h5>';
    unset($_SESSION['status']);
  }
  
  ?>

    <div class="table-responsive">
    <?php
                $connection = mysqli_connect("localhost","root","","adminpanel");

              $query = "SELECT * FROM utilisateurs";
              $query2 = "SELECT o.nom_poste FROM ordi o LEFT JOIN attributs a ON o.numposte = a.numposte WHERE a.id_user != ''";
              $query_run = mysqli_query($connection, $query);
              $query_run2 = mysqli_query($connection, $query2);

            ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
          <th> <center>ID</center> </th>
            <th> <center>Utilisateur</center> </th>
            <th> <center>Adresse mail</center> </th>
            <th> <center>Nom du poste</center> </th>
            <th> <center>Modifier</center> </th>
            <th> <center>Supprimer</center> </th>
          </tr>
        </thead>
        <tbody>
           <?php
         if(mysqli_num_rows($query_run2) > 0 and mysqli_num_rows($query_run) > 0)        
          {
           while($row2 = mysqli_fetch_assoc($query_run2) and $row = mysqli_fetch_assoc($query_run))
            {
           ?>
          <tr>
          <td><center><?php  echo $row['id']; ?></center></td>
              <td><center><?php  echo $row['username']; ?></center></td>
              <td><center><?php  echo $row['email']; ?></center></td>
              <td><center><?php  echo $row2['nom_poste']; ?></center></td>
              <td>
                <form action="utilisateurs_edit.php" method="post">
                    <input type="hidden" name="edit_id" value="<?php  echo $row['id']; ?>">
                    <center><button  type="submit" name="edit_btn" class="btn btn-success"><i class="fas fa-user-edit"> </i> Modifier</button></center>
                </form>
            </td>
            <td>
                <form action="code.php" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                  <center><button type="submit" name="delete_btn" class="btn btn-danger"><i class="fas fa-trash"> </i> Supprimer </button></center>
                </form>
            </td>
          </tr>
          <?php
           } 
             }
              else {
              echo "Aucune données.";
               }
            ?>
        </tbody>
      </table>

    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->





<?php
include('includes/scripts.php');
?>