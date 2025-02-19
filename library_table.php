<?php

include('database.php');

$datestring;
$output='';
$query = "SELECT * FROM `aug_library` ORDER BY id DESC";
$result = mysqli_query($mysqli,$query);
$count = mysqli_num_rows($result);

if($count>0){

    while($row = mysqli_fetch_assoc($result)){
        $datestring = strtotime($row['Timestamp']);
        $output.='
        <tr>
            <td>'.$row['Title'].'</td>
            <td>'.$row['ISBN'].'</td>
            <td>'.$row['Author'].'</td>
            <td>'.$row['Publisher'].'</td>
            <td>'.date("Y",$row['Year_Published']).'</td>
            <td>'.$row['Category'].'</td>
            <td class="text-center"> 
                <button class="btn btn-primary m-1 edit-data" name="edit" value="Edit" id="'.$row['id'].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                <button name="delete" value="Delete" class="btn btn-danger delete-data" id="'.$row['id'].'"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
            </td>
        </tr>
        
        ';
    }

    echo $output;
}else{
    $output='';
        $output.='
        <tr>
            <td colspan="7" style="text-align: center;">No Data Found</td>
        </tr>
        ';
        echo $output;
}

?>