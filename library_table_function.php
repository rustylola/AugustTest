<?php

// Default
session_start();
include('database.php');


if(isset($_POST['deleteselectedid'])){
    $query = "SELECT * FROM `aug_library` WHERE id='".$_POST['deleteselectedid']."'";
    $result = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}

if(isset($_POST['deleteselectids'])){
    $query = "DELETE FROM `aug_library` WHERE `aug_library`.`id` = '".$_POST['deleteselectids']."'";
    $result = mysqli_query($mysqli,$query);
    if($result){
        $_SESSION['message'] = "Delete Success.";
        $_SESSION['type'] = "success";
    }else{
        $_SESSION['message'] = "Delete failed.";
        $_SESSION['type'] = "warning";
    }
}

if(isset($_POST['selectedID']) && $_POST['selectedID']){

    $query = "SELECT * FROM `aug_library` WHERE id='".$_POST['selectedID']."'";
    $result = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);

}

if(isset($_POST['Title']) && isset($_POST['ISBN']) && isset($_POST['Author']) && isset($_POST['Publisher'])){

    $selectedID = mysqli_real_escape_string($mysqli, $_POST['selectid']);
    $Title = mysqli_real_escape_string($mysqli, $_POST['Title']);
    $ISBN = mysqli_real_escape_string($mysqli, $_POST['ISBN']);
    $Author = mysqli_real_escape_string($mysqli, $_POST['Author']);
    $Publisher = mysqli_real_escape_string($mysqli, $_POST['Publisher']);
    $Year = mysqli_real_escape_string($mysqli, $_POST['Year_Published']);
    $Category = mysqli_real_escape_string($mysqli, $_POST['Category']);
    $Year_Published = strtotime($Year);
    // var_dump($_POST);die;
    if(!empty($_POST['selectid'])){
        $query = "UPDATE `aug_library` 
                        SET `Title` = '".$Title."', `ISBN` = '".$ISBN."',`Author` = '".$Author."',`Publisher` = '".$Publisher."',`Year_Published` = '".$Year_Published."', `Category` = '".$Category."'
                        WHERE `aug_library`.`id` = '".$selectedID."'";

        $result = mysqli_query($mysqli,$query);

        if($result){
            $_SESSION['message'] = "Update Success.";
            $_SESSION['type'] = "success";
        }else{
            $_SESSION['message'] = "Update failed.";
            $_SESSION['type'] = "warning";
        }
    }else{
        $query = "INSERT INTO `aug_library` (`Title`, `ISBN`, `Author`, `Publisher`, `Year_Published`, `Category`) 
                         VALUES ('".$Title."', '".$ISBN."', '".$Author."', '".$Publisher."', '".$Year_Published."', '".$Category."')";

        $result = mysqli_query($mysqli,$query);
        if($result){
            $_SESSION['message'] = "Add Success.";
            $_SESSION['type'] = "success";
        }else{
            $_SESSION['message'] = "Add failed.";
            $_SESSION['type'] = "warning";
        }
    }
}

?>