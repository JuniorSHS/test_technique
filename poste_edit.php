<?php
session_start();
$connection = mysqli_connect("localhost","root","","adminpanel");
//include('security.php');
include('includes/header.php'); 
include('includes/navbar.php');
?>


<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Mise à jour de l'ordinateur. </h6>
        </div>
        <div class="card-body">
        <?php
            $connection = mysqli_connect("localhost","root","","adminpanel");
            if(isset($_POST['edit_btn']))
            {
                $numposte = $_POST['numposte'];
                $query = "SELECT * FROM ordi WHERE numposte=$numposte";
                $query_run = mysqli_query($connection, $query);
                foreach($query_run as $row)
                {
 		?>

            <form action="code.php" method="POST">
            <div class="form-group">
                <input type="hidden" name="numposte" value="<?php echo $row['numposte'] ?>" class="form-control">
            </div>
            <div class="form-group">
                <label>Nom de l'ordinateur</label>
                <input type="text" name="nom_poste" value="<?php echo $row['nom_poste'] ?>" class="form-control">
            </div>
                <center><a href="poste.php" class="btn btn-danger"><i class="fas fa-ban"> </i> Abandonner </a>
                    <button type="submit" name="postebtn" class="btn btn-primary">
                        <i class="fas fa-user-edit"> </i> Enregistrer </button></center>
                    </form>
          
     <?php
          }
            }
          ?>
        </div>
    </div>
 </div>

</div>



<?php
include('includes/scripts.php');
?>