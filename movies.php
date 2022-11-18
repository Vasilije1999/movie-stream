<?php
include_once "header.php";
?>

           
<section class="p-4">
    <div class="dropdown row ">
        <div class="col-md ">
            <a class="btn btn-secondary dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown">
                Categories
            </a>
            <ul class="dropdown-menu " >
                <?php
                        $querry="SELECT * FROM categories_m";
                        $rez=mysqli_query($con,$querry);
                        while($row=mysqli_fetch_assoc($rez))
                        echo " <li value='movies.php?kategorija={$row['id']}'><a class='dropdown-item' href='movies.php?kategorija={$row['id']}'>{$row['category']}</a></li>";
                    ?>
            
            </ul>
        </div>
    </div>



    <div class="container">
        <?php
   
            if(isset($_GET['page'])){
                $page = $_GET['page'];
            }
            else{
                $page = 1;
            }
            $num_per_page = 10;
            $start_from = ($page-1)*5;
            $querry = "SELECT * FROM movies limit $start_from,$num_per_page";
            $result = mysqli_query($con,$querry); 
        
            $querry = "SELECT * FROM movies WHERE deleted = 0";
            if(isset($_GET['id']))$querry = "SELECT * FROM movies WHERE deleted = 0 AND id=".$_GET['id'];
            
            if(isset($_GET['category']))$querry = "SELECT * FROM movies WHERE deleted = 0 AND category='".$_GET['category']."'";
            $rez = mysqli_query($con,$querry);
            if(mysqli_error($con)) {
                echo "Erorr while executing the statement<br>";
                echo mysqli_error($con)." (".mysqli_errno($con).")";
                exit();
            }
            echo "<hr>";
            echo "<div class='row row-cols-1 row-cols-md-3'>";
            while($row = mysqli_fetch_assoc($rez)){
                $img = "images/noimage.jpg";
                if(file_exists("images/".$row['id'].".jpg")){
                    $img = "images/".$row['id'].".jpg";
                }


                
                echo"<div class='col-lg-4 mb-3 d-flex align-items-stretch'>";
                    echo "<div class='card' style='max-width: 18rem; max-height:50rem'>
                        <img src='$img' class='card-img-top' alt=''>
                        <div class='card-body d-flex flex-column text-center'>";
                            echo"<h5 class='card-title '><a href='movie.php?id=".$row['id']."'>".$row['title']."</a></h5>
                        </div>
                    </div>
                </div>";
                    
            };
           echo"</div>";
    echo "</div>";
        echo "<br>";
        echo "<br>";
    $pr_query = "SELECT * FROM movies";
    $pr_result = mysqli_query($con,$pr_query);
    $total_record = mysqli_num_rows($pr_result);

    $total_page = ceil($total_record/$num_per_page);
    echo"<ul id='ul-movies' class='pagination justify-content-center'>";
    if($page>1){
        echo "<li id='previous' class='page-item'><a class='page-link' href='movies.php?page=".($page-1)."'>Previous</a></li>";
    }

    for($i=1;$i<$total_page;$i++){
    
        echo "<li class='page-item'><a class='page-link' href='movies.php?page=".$i."'>$i</a></li>";
    }


    echo"</ul>";
        
    
    ?>    
</section>


<?php
include_once "footer.php";
?>