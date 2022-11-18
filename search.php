<?php
include_once "header.php";
?>

           
<section class="p-4">
  <div class="container">
            <?php
            if(isset($_POST['submit-search'])){
                $search = mysqli_real_escape_string($con, $_POST['search']);
                $query = "SELECT * FROM movies WHERE title LIKE '%$search%'";
                $rez = mysqli_query($con, $query);
                $queryRez = mysqli_num_rows($rez);

                if($queryRez > 0){
                    while($row = mysqli_fetch_assoc($rez)){
                        echo "<div class='row row-cols-1 row-cols-md-3'>";
                                while($row = mysqli_fetch_assoc($rez)){
                                    $img = "images/noimage.jpg";
                                    if(file_exists("images/".$row['id'].".jpg")){
                                        $img = "images/".$row['id'].".jpg";
                                    } 
                                    echo"<div class='col-lg-4 mb-3 d-flex align-items-stretch'>";
                                        echo "<div class='card' style='max-width: 18rem; max-height:50rem'>
                                            <img src='$img' class='card-img-top' alt=''>
                                            <div class='card-body d-flex flex-column'>";
                                                echo"<h5 class='card-title'><a href='movie.php?id=".$row['id']."'>".$row['title']."</a></h5>";
                                                echo"<p class='card-text'>";
                                                if(isset($_GET['id'])){
                                                    echo $row['description']."<br>";
                                                }
                                                else{
                                                    $tmp = explode(" ",$row['description']);
                                                    $new = array_slice($tmp, 0, 5);
                                                    $show = implode(" ", $new);
                                                echo "<p>".$show."</p></br>";
                                                    }
                                                echo"</p>
                                            </div>
                                        </div>
                                    </div>";
                                        
                                };
                            echo"</div>";
                    }
                }else {
                    echo"There are no results";
                }
            }
            ?>

        <?php
   

            
    echo "</div>";
  
    ?>    
</section>


<?php
include_once "footer.php";
?>