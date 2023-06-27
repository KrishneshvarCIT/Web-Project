<?php
session_start();


$outputTable = '';  
if(isset($_POST['cart1_id'])){

            if($_POST['action'] == 'add'){
                $outputTable = '';
                $total = 0;

                if(isset($_SESSION['cart1'])){
                    $isalreadyExist = 0;
                    foreach($_SESSION['cart1'] as $key => $value){
                        
                        if($_SESSION['cart1'][$key]['p_id'] == $_POST['cart1_id']){
                            $isalreadyExist++;
                            $_SESSION['cart1'][$key]['p_quantity'] =  $_SESSION['cart1'][$key]['p_quantity'] + $_POST['cart1_quantity'];
                        }
                    }
                    if($isalreadyExist < 1){
                        $itemArray = array(
                            'p_id' => $_POST['cart1_id'],
                            'p_name' => $_POST['cart1_name'], 
                            'p_price' => $_POST['cart1_price'],
                            'p_quantity' => $_POST['cart1_quantity'] 
                        );
                        $_SESSION['cart1'][]  = $itemArray;
                    }



                }else{
                    $itemArray = array(
                        'p_id' => $_POST['cart1_id'],
                        'p_name' => $_POST['cart1_name'], 
                        'p_price' => $_POST['cart1_price'],
                        'p_quantity' => $_POST['cart1_quantity'] 
                    );
                    $_SESSION['cart1'][]  = $itemArray;
                }
           



           }

}



if($_POST['action'] == 'remove'){
    foreach($_SESSION['cart1'] as $key => $val){
        if( $val['p_id'] == $_POST['id_to_remove']){
            unset($_SESSION['cart1'][$key]);
        }
    }

}


if(!empty($_SESSION['cart1'])){
    $outputTable = '';
    $total = 0;
    $outputTable .= "<table class='table table-bordered'><thead><tr><td>Name</td><td>Price</td><td>Quantity</td><td>Action</td> </tr></thead>";
    foreach($_SESSION['cart1'] as $key => $value){
        $outputTable .= "<tr><td>".$value['p_name']."</td><td>".($value['p_price'] * $value['p_quantity']) ."</td><td>".$value['p_quantity']."</td><td><button id=".$value['p_id']." class='btn btn-danger normal2 delete'>Remove</button></td></tr>";  
        $total = $total + ($value['p_price'] * $value['p_quantity']);
    }
    $outputTable .= "</table>";
    $outputTable .= "<div class='text-center rightbut'><b>Total: ".$total."</b></div>";

}

echo json_encode($outputTable);

