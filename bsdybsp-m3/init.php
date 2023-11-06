<?php
session_start();

$title = 'Главная';
const DATABASE = 'dgaesjkj_m3';
const HOST = 'localhost';
const USER = 'dgaesjkj';
const PASSWORD = 'KH3jzi';


// const HOST = "localhost";
// const USER = "root";
// const PASSWORD = "";
// const DATABASE = "dgaesjkj_m3";
$con = mysqli_connect(HOST, USER, PASSWORD,DATABASE);
mysqli_set_charset($con, "utf8");
