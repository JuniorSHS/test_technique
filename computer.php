<?php
session_start();
if(!$_SESSION['username'])
{
    header('Location: login.php');
}
$connection = mysqli_connect("localhost","root","","adminpanel");
include('includes/header.php'); 
include('includes/navbar.php');

if(isset($_POST['attribtn']))
{
    $numposte = $_POST['numposte'];
    $numposte_query = "SELECT * FROM attributs WHERE numposte='$numposte'";
    $numposte_query_run = mysqli_query($connection, $numposte_query);
    if(mysqli_num_rows($numposte_query_run) > 0)
    {
        $_SESSION['status'] = "Ce poste est déjà attribué à un utilisateur.";
        $_SESSION['status_code'] = "status";
    }
    else
    {
        $query = "INSERT INTO `attributs`('id_user','numposte','date','heure') VALUES ('$numposte','$id_user','$date','$heure')";
            $query_run = mysqli_query($connection, $query);
        if($query_run)
        {
        $_SESSION['success'] = "Poste Attribué !";
        $_SESSION['status_code'] = "success";
        header('Location: poste.php'); 
        }
    }

}


?>

<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary"> 
    <h1 class="h3 mb-0 text-gray-800">Attribution d'un ordinateur</h1>
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
  
  <br>
  <center>
  <form method="POST">
    <div class="form-group">
    <label for="formGroupExampleInput">Numero de poste</label>
    <input style="width: 300px;" name="numposte" type="text" class="form-control" id="formGroupExampleInput" placeholder="Numero de poste" required="">
    </div>
    <div class="form-group">
    <label for="formGroupExampleInput2">utilisateurs</label>
    <input style="width: 300px;" name="id_user"  type="text" class="form-control" id="formGroupExampleInput2" placeholder="ID utilisateur" required="">
    </div>
    <div class="form-group">
    <label for="formGroupExampleInput2">Date</label>
    <div class="col-10">
    <input style="width: 300px;" name="date"  class="form-control" type="date" value="2011-08-19" id="example-date-input" required="">
    </div><br>
    <label for="formGroupExampleInput2">Heure</label>
    <div class="col-10">
    <input style="width: 300px;" name="heure" class="form-control" type="time" value="13:45:00" id="example-time-input" required="">
    </div><br>
    <button style="width: 200px;" type="submit" name="attribtn" class="btn btn-primary"><i class="fas fa-address-card"><sup>+</sup></i></button>
  </form>
  </center>
   <br><br><br>


    <div class="table-responsive">
    <?php
                $connection = mysqli_connect("localhost","root","","adminpanel");
                $query = "SELECT * FROM attributs";
                $query_run = mysqli_query($connection, $query);
            ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
          <th> <center>Nom de poste</center> </th>
            <th> <center>utilisateurs</center> </th>
            <th> <center>Date</center> </th>
            <th> <center>Heure</center> </th>
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
              <td><center><?php  echo $row['id_user']; ?></center></td>
              <td><center><?php  echo $row['date']; ?></center></td>
              <td><center><?php  echo $row['heure']; ?></center></td>
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