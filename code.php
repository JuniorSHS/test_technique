<?php
$connection = mysqli_connect("localhost","root","","adminpanel");

//////// partie pour modifier un utilisateur //////


if(isset($_POST['updatebtn']))
{
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $email = $_POST['edit_email'];


    $query = "UPDATE utilisateurs SET username='$username', email='$email' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "L'utilisateur a été mise à jour.";
        $_SESSION['status_code'] = "success";
        header('Location: utilisateurs.php'); 
    }
    else
    {
        $_SESSION['status'] = "Oups !";
        $_SESSION['status_code'] = "error";
        header('Location: utilisateurs.php'); 
    }
}

//////// partie pour supprimer un utiliisateur //////

if(isset($_POST['delete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM utilisateurs WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "L'utilisateur a bien été supprimé.";
        $_SESSION['status_code'] = "success";
        header('Location: utilisateurs.php'); 
    }
    else
    {
        $_SESSION['status'] = "Une erreur est survenu lors de la suppression.";       
        $_SESSION['status_code'] = "error";
        header('Location: utilisateurs.php'); 
    }    
}


//////// partie pour modifier un ordinateur //////

if(isset($_POST['postebtn']))
{
    $numposte = $_POST['numposte'];
    $nom_poste = $_POST['nom_poste'];
    $query = "UPDATE ordi SET nom_poste='$nom_poste' WHERE numposte=$numposte";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "Le poste a été mise à jour.";
        $_SESSION['status_code'] = "success";
        header('Location: poste.php'); 
    }
    else
    {
        $_SESSION['status'] = "Oups, un poste à déjà ce nom.";
        $_SESSION['status_code'] = "status";
        header('Location: poste.php'); 
    }
}


//////// partie pour supprimer un ordinateur //////

if(isset($_POST['delete_poste_btn']))
{
    $numposte = $_POST['numposte'];
    $query = "DELETE FROM ordi WHERE numposte=$numposte ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "L'utilisateur a bien été supprimé.";
        $_SESSION['status_code'] = "success";
        header('Location: poste.php'); 
    }
    else
    {
        $_SESSION['status'] = "Une erreur est survenu lors de la suppression.";       
        $_SESSION['status_code'] = "error";
        header('Location: poste.php'); 
    }    
}


?>