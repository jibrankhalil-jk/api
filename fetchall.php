<?php
function fetchall($conn){
    $sql = "SELECT * FROM students";

    $results = mysqli_query($conn, $sql) or die("SQL query failed");
    if(mysqli_num_rows($results) > 0 ){
        $output = mysqli_fetch_all($results, MYSQLI_ASSOC);
        echo json_encode($output);
    }else{
        echo json_encode(array('message'=> 'No Record Found', 'status'=> false));

    }
}

?>