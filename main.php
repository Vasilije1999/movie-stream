      
<section class=" light text-center text-sm-start">   
  <div id="carouselExampleCaptions" class="carousel slide text-start" data-bs-ride="false">
    <div class="carousel-inner">
      <?php
          $upit = "SELECT * FROM homeslider WHERE deleted=0 ";
                      
          if(isset($_GET['id']))$upit = "SELECT * FROM homeslider WHERE deleted=0 AND id=".$_GET['id'];
          
          $rez = mysqli_query($con,$upit);
          if(mysqli_error($con)) {
              echo "Erorr while executing the statement<br>";
              echo mysqli_error($con)." (".mysqli_errno($con).")";
              exit();
          }  
      
          while($row = mysqli_fetch_assoc($rez)){
              
              $img = "images/noimage.jpg";
              if(file_exists("slider/".$row['id'].".jpg")){
                  $img = "slider/".$row['id'].".jpg";
              }
            
            
            echo "<div class='carousel-item active' style=''>
              <div class='img-gradient'>
                  <img src='$img'class='d-block w-100'>
              </div>";
              echo " <div class='carousel-caption d-none d-md-block'>
                <div class='row h-100 parallaxt-details text-light'>
                  <div class='col-lg-4 r-mb-23'>
                    <div class='text-left'>
                      <a href='javascript:void(0)'>
                        <h1 class='parallax-heading'>Avengers</h1>
                      </a>
                      <div class='parallax-ratting d-flex align-items-center mt-3 mb-3'>
                        <ul
                          class='ratting-start p-o m-0 list-inline text-primary d-flex align-items-center justify-content-left'>
                          <li>
                            <a href='#' class='text-primary'><i class='bi bi-star-fill'></i></a>
                          </li>
                          <li>
                            <a href='#' class='text-primary'><i class='pl-2 bi bi-star-fill'></i></a>
                          </li>
                          <li>
                            <a href='#' class='text-primary'><i class='pl-2 bi bi-star-fill'></i></a>
                          </li>
                          <li>
                            <a href='#' class='text-primary'><i class='pl-2 bi bi-star-fill'></i></a>
                          </li>
                          <li>
                            <a href='#' class='text-primary'><i class='pl-2 bi bi-star-half'></i></a>
                          </li>
                        </ul>
                        <span class='text-white ml-3'>7.8(Imbd)</span>
                      </div>
                      <div class='movie-time d-flex align-items-center mb-3'>
                          <div class='badge badge-secondary p-1 mr-2'>9+</div>
                          <span class='text-white'>2h 42min</span>
                      </div>
                      <p>
                        A paraplegic Marine dispatched to the moon Pandora on a unique
                        mission becomes torn between following his orders and
                        protecting the world he feels is his home.
                      </p>
                      <div class='parallax-buttons'>
                        <a href='#' class='btn btn-link'>Watch now</a>
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>";
          }
              
      ?>       
             
    </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
  </div>
</section>

<section class="p-4">
  <div class="container">
    <h3 class="text-light text-center">Trending</h3>
    <?php
      if(isset($_GET['page'])){
          $page = $_GET['page'];
      }
      else{
          $page = 1;
      }
      $num_per_page = 3;
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
          echo "<div class='row row-cols-1 row-cols-md-3 '>";
            while($row = mysqli_fetch_assoc($rez)){
              $img = "images/noimage.jpg";
              if(file_exists("images/".$row['id'].".jpg")){
                  $img = "images/".$row['id'].".jpg";
              }
              echo"<div class='col-lg-2 mb-3 d-flex align-items-stretch align-items-center justify-content-betwee'>";
                echo "<div class='card' style='max-width: 10rem;'>
                  <img src='$img' class='card-img-top' alt=''>
                  <div class='card-body d-flex flex-column text-center p-1'>";
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
  </div>
</section>
<section id="parallex" class="parallax-window p-3" style="background: url(
            <?php
                $upit = "SELECT * FROM homeslider WHERE deleted=0 ";
                
                if(isset($_GET['id']))$upit = "SELECT * FROM homeslider WHERE deleted=0 AND id=".$_GET['id'];
                
                $rez = mysqli_query($con,$upit);
                if(mysqli_error($con)) {
                    echo "Erorr while executing the statement<br>";
                    echo mysqli_error($con)." (".mysqli_errno($con).")";
                    exit();
                }  
            
                if($red = mysqli_fetch_assoc($rez)){
                    
                    $slika = "images/noimage.jpg";
                    if(file_exists("slider/".$red['id'].".jpg")){
                        $slika = "slider/".$red['id'].".jpg";
                    }
                    echo $slika;
                }
                    
            ?>) center center;height: 100%;
            padding: 100px 0;
            position: relative;background-size: cover;
            background-attachment: fixed ;">
      <div class="container-fluid h-100">
        <div class="row align-items-center justify-content-center h-100 parallaxt-details text-light">
          <div class="col-lg-4 r-mb-23">
            <div class="text-left">
              <a href="javascript:void(0)">
                <h1 class="parallax-heading">Avengers</h1>
              </a>
              <div class="parallax-ratting d-flex align-items-center mt-3 mb-3">
                <ul
                  class="ratting-start p-o m-0 list-inline text-primary d-flex align-items-center justify-content-left">
                  <li>
                    <a href="#" class="text-primary"><i class="bi bi-star-fill"></i></a>
                  </li>
                  <li>
                    <a href="#" class="text-primary"><i class="pl-2 bi bi-star-fill"></i></a>
                  </li>
                  <li>
                    <a href="#" class="text-primary"><i class="pl-2 bi bi-star-fill"></i></a>
                  </li>
                  <li>
                    <a href="#" class="text-primary"><i class="pl-2 bi bi-star-fill"></i></a>
                  </li>
                  <li>
                    <a href="#" class="text-primary"><i class="pl-2 bi bi-star-half"></i></a>
                  </li>
                </ul>
                <span class="text-white ml-3">7.8(Imbd)</span>
              </div>
              <div class="movie-time d-flex align-items-center mb-3">
                <div class="badge badge-secondary p-1 mr-2">9+</div>
                <span class="text-white">2h 42min</span>
              </div>
              <p>
                A paraplegic Marine dispatched to the moon Pandora on a unique
                mission becomes torn between following his orders and
                protecting the world he feels is his home.
              </p>
              <div class="parallax-buttons">
                <a href="#" class="btn btn-hover">Play Now</a>
                <a href="#" class="btn btn-link">More Details</a>
              </div>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="parallax-img">
              <a href="#"><img src="slider/1.jpg" alt="" class="img-fluid w-100" /></a>
            </div>
          </div>
        </div>
      </div>
</section>
