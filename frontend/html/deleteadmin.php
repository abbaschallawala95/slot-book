<?php
session_start();
include 'connection.php';
include 'function.php';

deleteAdmin($con, $_GET['id']); ?>