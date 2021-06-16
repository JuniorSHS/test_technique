<?php
session_start();
if(!$_SESSION['username'])
{
    header('Location: login.php');
}
$connection = mysqli_connect("localhost","root","","adminpanel");
include('includes/header.php'); 
include('includes/navbar.php');

if(isset($_POST['postebtn']))
{
    $nom_poste = $_POST['nom_poste'];
    $nom_poste_query = "SELECT * FROM ordi WHERE nom_poste='$nom_poste'";
    $nom_poste_query_run = mysqli_query($connection, $nom_poste_query);
    if(mysqli_num_rows($nom_poste_query_run) > 0)
    {
        $_SESSION['status'] = "Ce nom de poste existe déjà.";
        $_SESSION['status_code'] = "status";
    }
    else
    {
        $query = "INSERT INTO `ordi`(nom_poste) VALUES ('$nom_poste')";
            $query_run = mysqli_query($connection, $query);

        if($query_run)
        {
        $_SESSION['success'] = "Poste Ajouté !";
        $_SESSION['status_code'] = "success";
        //header('Location: poste.php'); 
        }
    }

}

?>

<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary"> 
    <h1 class="h3 mb-0 text-gray-800">Ajouter un ordinateur</h1>
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
  
  <br><br><br>
  <form method="POST">
    <center><input style="width: 500px;" type="text" name="nom_poste" class="form-control" placeholder="Nom de l'ordinateur" required=""><br>
    <button style="width: 250px;" type="submit" name="postebtn" class="btn btn-primary">
    <i class="fas fa-laptop"><sup>+</sup></i></button>
    </center>
    </form>
            <br><br><br><br><br>


    <div class="table-responsive">
    <?php
                $connection = mysqli_connect("localhost","root","","adminpanel");
                $query = "SELECT * FROM `ordi` ORDER BY `ordi`.`numposte` ASC";
                $query_run = mysqli_query($connection, $query);
            ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
          <th> <center>Numero de poste</center> </th>
            <th> <center>Nom du poste</center> </th>
            <th> <center>Modifier</center> </th>
            <th> <center>Supprimer</center> </th>
          </tr>
        </thead>
        <tbody>
        <?php
         if(mysqli_num_rows($query_run) > 0)        
          {
           while($row = mysqli_fetch_assoc($query_run))
            {
           ?>
          <tr>
          <td><center><?php  echo $row['numposte']; ?></center></td>
              <td><center><?php  echo $row['nom_poste']; ?></center></td>
              <td>
                <form action="poste_edit.php" method="post">
                    <input type="hidden" name="numposte" value="<?php  echo $row['numposte']; ?>">
                    <center><button  type="submit" name="edit_btn" class="btn btn-success"><i class="fas fa-user-edit"> </i> Modifier</button></center>
                </form>
            </td>
            <td>
                <form action="code.php" method="post">
                  <input type="hidden" name="numposte" value="<?php echo $row['numposte']; ?>">
                  <center><button type="submit" name="delete_poste_btn" class="btn btn-danger"><i class="fas fa-trash"> </i> Supprimer </button></center>
                </form>
            </td>
          </tr>
          <?php
           } 
             }
              else {
              echo "Pas d'ordinateur.";
               }
            ?>
        </tbody>
      </table>

    </div>
   </div>
 </div>
    

  </div>

</div>

<?php
include('includes/scripts.php');
?>