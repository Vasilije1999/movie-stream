<?php
require_once "functions.php";
$con = connection();
if(!$con) exit();
include_once "header.php";
?>
<section class="login">
    <div class="row justify-content-center text-light">
        <div class="col-xl-3"> 
            <form action="login.php" method="post">
                <h1>Log in</h1>
                <input type="email" name="email" placeholder="Enter Email"><br><br>
                <input type="password" name="password" placeholder="Enter Password"><br><br>
                <input type="checkbox" name="remember"> Remember me <br><br>
                <button>Log in</button>
            </form>
            <hr>
            <?php
                if(isset($_POST['email']) and isset($_POST['password'])){
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    if ($email!="" and $password!=""){
                        if(vaildanString($email) and vaildanString($password)){
                            $query = "SELECT * FROM korisnici WHERE email='{$email}'";
                            $rez = mysqli_query($con, $query);
                            if(mysqli_num_rows($rez)==1){
                                $row = mysqli_fetch_assoc($rez);
                                if($password==$row['password']){
                                    $_SESSION['id'] = $row['id'];
                                    $_SESSION['name'] = $row['name'] . " " . $row['prezime'];
                                    $_SESSION['status'] = $row['status'];
                                    $_SESSION['email'] = $row['email'];
                                    if(isset($_POST['remember'])){
                                        setcookie("id",$_SESSION['id'], time()+86400,"/");
                                        setcookie("name", $_SESSION['name'], time()+86400,"/");
                                        setcookie("status", $_SESSION['status'], time()+86400,"/");
                                    }
                                    header("location: index.php");

                                }
                                else{
                                    echo "<p style='color:red;font: weight 100px;font: size 15px;'>Wrong password</p>";
                                }
                            }
                            else{
                                echo "<p style='color:red;font: weight 100px;font: size 15px;'>Korisnicki email '$email' nepostoji</p>";
                            }
                        }
                        else{
                            echo "<p style='color:red;font: weight 100px;font: size 15px;'>Informacije sadrze nedozvoljene karaktere</p>";
                        }
                    }
                    else{
                        echo "<p style='color:red;font: weight 100px;font: size 15px;'>Sva polja moraj biti popunjena</p>";
                    }
                }
            ?>
        </div>
    </div>
</section>

<?php
include_once "footer.php";
?>
