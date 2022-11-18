<?php
include_once "header.php";
if($_SESSION['status']!='User'){
    header("location: index.php");
    exit();
}
?>
    <section class="kontakt">
            <?php
        $vw_watchlist="SELECT movies.*, korisnici.*, watchlist.* FROM movies INNER JOIN watchlist ON movies.id=watchlist.idMovie INNER JOIN korisnici ON watchlist.idUser=korisnici.id;";
        $upit="SELECT * FROM $vw_watchlist WHERE idKorisnika={$_SESSION['id']}";
        $rez = mysqli_query($con, $upit);
        if(mysqli_num_rows($rez)>0)
        {    
        echo "<div class='container'>";
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
        }
        else
            "Niste postavili ni jedno pitanje!!!!";
        ?>
            
                
          
    </section>
<?php
include_once "footer.php";
?>
