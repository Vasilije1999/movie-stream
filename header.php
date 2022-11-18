<?php
session_start();
require_once "functions.php";
$con = connection();
if(!$con) exit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    
 

    <title>Movies</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body style="background:#1C1C1C;">
    <section  class="wrapper">
       <header>  
            <nav class="navbar navbar-expand-lg navbar-dark p-0" style="background:#090909;">
                <div class="container-fluid ">
                <a class="navbar-brand" href="#"><img src="images/logo.png" alt="Logo" width="150px" height="90px" class="d-inline-block align-text-top"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav text-light me-auto  mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="movies.php">Movies</a>
                            </li>
                            <?php
                                if(login()){
                                    if($_SESSION['status']=='User'){

                                    echo "<li class='nav-item dropdown'>
                                            <a class='nav-link dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' >
                                                <span class='bi bi-person-circle h5'></span>
                                            </a>
                                            <ul class='dropdown-menu dropdown-menu-dark'>
                                                <li><a class='dropdown-item' href='watchlist.php'><i class='bi bi-bookmark text-primary'>  Watch List</i></a></li>
                                                <li><a class='dropdown-item' href='logout.php'><i class='bi bi-box-arrow-right text-primary'>  Logout</i></a></li>
                                            </ul>
                                        </li>";
                                    }
                                    else if($_SESSION['status']=='Administrator'){
                                        echo "<li class='nav-item dropdown '>
                                            <a class='nav-link dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' >
                                                <span class='bi bi-person-circle h5'> {$_SESSION['name']} ({$_SESSION['status']})</span>
                                            </a>
                                            <ul class='dropdown-menu dropdown-menu-dark'>
                                                <li><a class='dropdown-item' href='addmovie.php'><i class='bi bi-camera-reels text-primary'>  Add a Movie</i></a></li>
                                                <li><a class='dropdown-item' href='logout.php'><i class='bi bi-box-arrow-right text-primary'>  Logout</i></a></li>
                                            </ul>
                                        </li>";        
                                    }
                                    else if($_SESSION['status']=='Editor'){
                                        echo "<li class='nav-item dropdown '>
                                            <a class='nav-link dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' >
                                                <span class='bi bi-person-circle h5'> {$_SESSION['name']} ({$_SESSION['status']})</span>
                                            </a>
                                            <ul class='dropdown-menu dropdown-menu-dark'>
                                                <li><a class='dropdown-item' href='addmovie.php'><i class='bi bi-camera-reels text-primary'>  Add a Movie</i></a></li>
                                                <li><a class='dropdown-item' href='logout.php'><i class='bi bi-box-arrow-right text-primary'>  Logout</i></a></li>
                                            </ul>
                                        </li>";
                                    }
                                }
                                
                            ?>
                                                    
                            <?php
                                if(!login()){
                                    echo "<li class='nav-item'><a class='nav-link' href='login.php'>Log in</a></li>";
                                    echo "<li class='nav-item'><a class='nav-link' href='signup.php'>Sign up</a></li>";
                                }
                            ?>
                        </ul>
                        <form class="d-flex" role="search" action="search.php" method="POST">
                            <input class="form-control me-2" name="search" type="text" placeholder="Search">
                            <button class="btn btn-outline-success text-center" type="submit" name="submit-search"><span class="bi bi-search"></span></button>
                        </form>
                    </div>
                </div>
            </nav>