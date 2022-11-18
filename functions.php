<?php

function connection() {

    $con = @mysqli_connect("localhost","root","","cv");
    if(!$con){
        echo "Unsuccessfull database connetion";
        return false;
    }
    mysqli_query($con, "SET NAMES utf8");
    return $con;
}

function vaildanString($str){
    if(strpos($str, ' ')!==false)return false;
    return true;
}
function login(){
    if(isset($_SESSION['id']) and isset($_SESSION['name']) and isset($_SESSION['status'])) {
        return true;
    }
    else if(isset($_COOKIE['id']) and isset($_COOKIE['name']) and isset($_COOKIE['status'])) {
        $_SESSION['id'] = $_COOKIE['id'];
        $_SESSION['name'] = $_COOKIE['name'];
        $_SESSION['status'] = $_COOKIE['status'];
        return true;
    }
    else{
        return false;
    }
}
