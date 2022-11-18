<?php
require_once "functions.php";
$con = connection();
if(!$con) exit();
include_once "header.php";
?>

          
<section>
    <div class="container">
        <div class='row align-items-center justify-content-betwee'>
            <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                if(filter_var($id, FILTER_VALIDATE_INT)){
                    $query = "SELECT * FROM movies WHERE deleted=0 AND id=".$_GET['id'];
                    $rez = mysqli_query($con,$query);
                        if(mysqli_error($con)) {
                            echo "Error while executing query<br>";
                            echo mysqli_error($con)." (".mysqli_errno($con).")";
                            exit();
                        }
                        while($row = mysqli_fetch_assoc($rez)){
                        
                            
                            $img = "slike/noimage.jpg";
                            if(file_exists("images/".$row['id'].".jpg")){
                                $img = "images/".$row['id'].".jpg";
                            }
                            
                            
                            
                                echo"<div class='col-md'>
                                    <video controls class='p-4 w-100'>
                                        <source src='videos/".$row['id'].".mp4' type='video/mp4'>
                                    </video
                                </div>";
                                
                                

                            echo"<div class='col-lg-4 mb-3 d-flex align-items-stretch'>";
                                echo "<div class='card' style='max-width: 18rem; max-height:50rem'>
                                    <img src='$img' class='card-img-top' alt=''>
                                    <div class='card-body d-flex flex-column'>";
                                        echo "<a href='movies.php?category=".$row['category']."'>".$row['category']."</a><br>";
                                        echo"<h5 class='card-title'><a href='movie.php?id=".$row['id']."'>".$row['title']."</a></h5>";
                                        echo"<p class='card-text'>";
                                            echo "<p>".$row['description']."</p></br>";
                                        echo"</p>
                                    </div>
                                </div>
                            </div>";
                        }
                        mysqli_close($con);
                }
                else{
                    echo "Movie doesnt exist";
                }
            
            }
            ?>
        </div>
    </div>
</section>


<?php
include_once "footer.php";
?>
