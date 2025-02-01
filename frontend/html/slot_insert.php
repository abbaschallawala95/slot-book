    <?php
    include("connection.php");
   if(isset($_POST))
    {
        extract($_POST);

    //   $Folder = "img/";
    //   $OrderImage1 =$_FILES['image']['name'];
    //   $Photo1=rand(999,1000).$_FILES['image']['name'];
    //   $PhotoTemp1=$_FILES['image']['tmp_name'];
    //   $UploadFile1=$Folder.$Photo1;

    $sdate = $_POST['date'];
    $stime = $_POST['time'];
    $count = $_POST['count'];
    $sdate = $_POST['date'];


   
    if(mysqli_query($con,"INSERT INTO booking (s_date, s_time, count, category) VALUES ('$sdate','$stime', '$count','$category')"))
    {
        echo 1;
    }
    else {
        echo mysqli_error($con);
    }
    }
    ?>
