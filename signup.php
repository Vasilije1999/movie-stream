<?php
require_once "functions.php";
$con = connection();
if(!$con) exit();
include_once "header.php";
?>
<section >
    <div class="row justify-content-center text-light">
        <div class="col-xl-3"> 
            <form action="signup.php" method="post">
                <h1>Sign up</h1>
                <input type="text" name="name" placeholder="Enter Name"><br><br>
                <input type="text" name="lastname" placeholder="Enter Lastname"><br><br>
                <input type="email" name="email" placeholder="Enter Email"><br><br>
                <input type="password" name="password" placeholder="Enter Password"><br><br>
                <button name="submit">Sign up</button>
            </form>
            <hr>
            <?php
                if(isset($_POST['submit'])){

                    $name = $_POST['name'];
                    $lastname = $_POST['lastname'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    
                    if($name!="" and $lastname!="" and $email!="" and $password!=""){
                        $query = "INSERT INTO korisnici (name, lastname, email, password, status) VALUES ('{$name}', '{$lastname }', '{$email}', '{$password}', 3)";
                        mysqli_query($con, $query);
                        if(mysqli_error($con)){
                            echo "Error while executin query";
                            echo mysqli_error($con);
                        }
                        else{
                            echo "Succesful sign up";
                        }
                    }
                    else{
                        echo "<p>All data is needed</p>";
                    }
                }
            ?>
        </div>
    </div>
</section>

<?php
include_once "footer.php";
?>