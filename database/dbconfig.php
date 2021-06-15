<link href="../css/sb-admin-2.min.css" rel="stylesheet">
<?php

$server_name = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "adminpanel";

$connection = mysqli_connect($server_name,$db_username,$db_password);
$dbconfig = mysqli_select_db($connection,$db_name);

if($dbconfig)
{
    //echo "Base de données connectée";
}
else
{

    echo '
        <div class="container">
            <div class="row">
                <div class="col-md-8 mr-auto ml-auto text-center py-5 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 style="background: #F2DEDE; color: #A94442; padding: 10px; width: 95%; text-align: center; 
                            border-radius: 20px; margin: 20px auto;"> 404 not found. </h1>
                            <h2 class="card-title"> Base de données manquante</h2>
                            <p class="card-text"> Veuillez vérifier l\'importation de la
                            base de données ou son orthographe.</p>
                            <a href="../login.php" class="btn btn-primary">Connexion</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    ';

}

?>