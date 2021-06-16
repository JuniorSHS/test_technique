<?php
include('security.php');
include('includes/header.php'); 
include('includes/navbar.php');
?>


<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Mise à jour d'un ordinateur. </h6>
        </div>
        <div class="card-body">
        <?php
            $connection = mysqli_connect("localhost","root","","adminpanel");

            if(isset($_POST['edit_btn']))
            {
                $id = $_POST['edit_id'];
                
                $query = "SELECT * FROM utilisateurs WHERE id='$id' ";
                $query_run = mysqli_query($connection, $query);

                foreach($query_run as $row)
                {
                    ?>

                        <form action="code.php" method="POST">

                            <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">

                            <div class="form-group">
                                <label> Utilisateur </label>
                                <input type="text" name="edit_username" value="<?php echo $row['username'] ?>" class="form-control"
                                    placeholder="Nom d'utilisateur">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="edit_date_debut" value="<?php echo $row['email'] ?>" class="form-control"
                                    placeholder="Adresse email">
                            </div>
                        <div class="form-group">
                            <label> Numero de Poste </label>
                                <select class="form-control" name="edit_date_fin" id="exampleSelect1" value="<?php echo $row['numposte'] ?>">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                                </select>
                        </div>
                            <!-- <div class="form-group">
                                <label>Numero de Poste</label>
                                <input type="text" name="edit_numposte" value="<?php echo $row['numposte'] ?>"
                                    class="form-control" placeholder="Numero de poste">
                            </div> -->

                            <center><a href="utilisateurs.php" class="btn btn-danger"><i class="fas fa-ban"> </i> Abandonner </a>
                            <button type="submit" name="updatebtn" class="btn btn-primary">
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