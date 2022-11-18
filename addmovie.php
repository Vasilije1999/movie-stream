<?php
require_once "functions.php";
$con = connection();
if(!$con) exit();
include_once "header.php";
if($_SESSION['status']!='Administrator' and $_SESSION['status']!='Editor'){
    header("location: index.php");
    exit();
}
?>
<!----------------------------------Vjezbe---------------------->

<section class="text-light">
    
    <div class="row">              
        <div class="col-xl-5">
            <h2>Add Movie</h2>
            <form action="addmovie.php" method="post" enctype="multipart/form-data">
                <input type="text" name="title" placeholder="Enter Title"><br><br>
                <textarea name="description" id="description" cols="30" rows="10" placeholder="Enter Description"></textarea><br><br>
                <select name="category" id="category">
                    <option value="0">---Category---</option>
                    <?php
                        $querry="SELECT * FROM categories_m";
                        $rez=mysqli_query($con, $querry);
                        while($row=mysqli_fetch_object($rez))
                            echo "<option value='{$row->id}'>{$row->category}</option>";
                        ?>
                </select>
                    <label for="formFile" class="form-label">Image</label>
                    <input class="form-control" type="file" id="img" name="img">
                    <input class="form-control" type="file" id="video" name="video">
                <button name="submit">Submit</button><br><br>
            </form>
        </div>

        <?php
            if(isset($_POST['submit'])){

                $title = $_POST['title'];
                $description = $_POST['description'];
                $category = $_POST['category'];
                
                if($title!="" and $description!="" and $category!="0"){
                    $querry = "INSERT INTO movies (title, description, category) VALUES ('{$title}','{$description}', {$category})";
                    mysqli_query($con, $querry);
                    if(mysqli_error($con)){
                        echo "Error while connecting";
                        echo mysqli_error($con);
                    }
                    else{
                        $id = mysqli_insert_id($con);
                        echo "Uspjesno dodata vjezba '$title' sa id: ".$id."<br><br>";
                        if($_FILES['img']['name']!="" and $_FILES['video']['name']!=""){

                            $namev = "videos/".$id.".mp4";
                            $tmpv = $_FILES['video']['tmp_name'];
                            $allowedv = array("mp4", "webm", "avi");
                            if(in_array(pathinfo($namev, PATHINFO_EXTENSION), $allowedv)){
                                if(@move_uploaded_file($tmpv, $namev)){
                                    echo "Video uploaded";
                                }
                                else{
                                    echo "Error while uploading video";
                                }
                            }

                            $name = "slike/".$id.".jpg";
                            $tmp = $_FILES['img']['tmp_name'];
                            $allowed = array("jpg", "jpeg", "png");
                            if(in_array(pathinfo($name, PATHINFO_EXTENSION), $allowed)){
                                if(@move_uploaded_file($tmp, $name)){
                                    echo "Image uploaded";
                                }
                                else{
                                    echo "Error while uploading image";
                                }
                            }
                        }
                        
                    }
                }
                else{
                    echo "All data must be filled";
                }
            }
        ?>

            <!--Izmjena vjezbe-->
            <div class="col-xl-4">
                <h1>Change movie data</h1>
                <form action="addmovie.php" method="post">
                    <select name="movie" id="movie">
                        <option value="0">--Choose a movie--</option>
                        <?php
                        $querry="SELECT * FROM movies WHERE deleted=0 ORDER BY id DESC";
                        $rez=mysqli_query($con, $querry);
                        while($row=mysqli_fetch_object($rez))
                            echo "<option value='{$row->id}'>{$row->id} :{$row->title}</option>";
                        ?>
                    </select><br><br>
                    <input type="text" name='title' placeholder="Enter new Title"><br><br>
                    <textarea name="description" id="description" cols="30" rows="10" placeholder="Enter new Description"></textarea><br><br>
                    <select name="category" id="category">
                            <option value="0">--Choose new Category--</option>
                            <?php
                            $querry="SELECT * FROM categories_m";
                            $rez=mysqli_query($con, $querry);
                            while($row=mysqli_fetch_object($rez))
                                echo "<option value='{$row->id}'>{$row->title}</option>";
                            ?>
                        </select><br><br>
                    <button class="change">Submit</button><br><br>
                </form>
                <?php
                    if(isset($_POST['change']) and isset($_POST['movie']) and isset($_POST['title']) and isset($_POST['description']) and isset($_POST['category']))
                    {
                        $title=$_POST['title'];
                        $description=$_POST['description'];
                        $category=$_POST['category'];
                        $movie=$_POST['movie'];
                        if($title!='' and $description!='' and $category!='0' and $movie!='0')
                        {
                            $querry="UPDATE movies SET title='{$title}',description='{$description}',category={$category} WHERE id={$vjezba}";
                            mysqli_query($con, $querry);
                            if(mysqli_error($con))
                            {
                                echo mysqli_error($con);
                                echo "Error while changing data for {$title}";
                            } 
                            else
                            {
                                echo "Changed data for {$title}";
                            }
                                
                        }
                        else
                            echo "All data must be filled";
                    }
                    
                ?>
            </div>

            <!--Izbrisi vjezbu-->

            <div class="col-xl-4">
            <?php
                if(isset($_POST['movie']) and isset($_POST['delete'])){
                    $movie=$_POST['movie'];
                    if($movie!="0")
                    {
                        $querry="UPDATE movies SET deleted=1 WHERE id={$movie}";
                        mysqli_query($con, $querry);
                        if(mysqli_error($con))
                        {
                            echo "Error while deleting!!!!";
                        } 
                        else
                        {
                            echo "Movie deleted";
                        }
                    }
                    else
                        echo "You didnt choose a movie for deleting!!!<br><br>";
                }
                ?>
                <h1>Delete movie</h1>
                <form action="addmove.php" method="post">
                    <select name="movie" id="movie">
                        <option value="0">--Choose Movie--</option>
                        <?php
                            $querry="SELECT * FROM movies WHERE deleted=0 ORDER BY id DESC";
                            $rez=mysqli_query($con, $querry);
                            while($row=mysqli_fetch_object($rez))
                                echo "<option value='{$row->id}'>{$row->id} :{$row->title}</option>";
                        ?>
                    </select><br><br>
                    <button name="delete">Delete movie</button><br><br>
                </form>
                
            </div>
            
        </div>
</section>    
<?php
include_once "footer.php";
?>