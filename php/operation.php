<?php

require_once ('db.php');
require_once ('component.php');

$con = Createdb();

// create button click
if(isset($_POST['create'])){
    createData();
}

if(isset($_POST['update'])){
    updateData();
}

if(isset($_POST['delete'])){
    deleteRecord();
}

if(isset($_POST['deleteall'])){
    deleteAll();
}

if(isset($_POST['datatest'])){
    createDataTest();
}

function createData(){
    $championName = textboxValue("champion_name");
    $championDescription = textboxValue("champion_description");
    $championPrice = textboxValue("champion_price");

    if($championName && $championDescription && $championPrice){

        $sql = "INSERT INTO champions (champion_name, champion_description, champion_price) 
                        VALUES ('$championName','$championDescription','$championPrice')";

        if(mysqli_query($GLOBALS['con'], $sql)){
            TextNode("success", "Champion Successfully Inserted...!");
        }else{
            echo "Error";
        }

    }else{
            TextNode("error", "Provide Data in the Textbox");
    }
}

function textboxValue($value){
    $textbox = mysqli_real_escape_string($GLOBALS['con'], trim($_POST[$value]));
    if(empty($textbox)){
        return false;
    }else{
        return $textbox;
    }
}


// messages
function TextNode($className, $msg){
    $element = "<h6 class='$className'>$msg</h6>";
    echo $element;
}


// get data from mysql database
function getData(){
    $sql = "SELECT * FROM champions";

    $result = mysqli_query($GLOBALS['con'], $sql);

    if(mysqli_num_rows($result) > 0){
        return $result;
    }
}

// update dat
function updateData(){
    $championId = textboxValue("champion_id");
    $championName = textboxValue("champion_name");
    $championDescription = textboxValue("champion_description");
    $championPrice = textboxValue("champion_price");

    if($championName && $championDescription && $championPrice){
        $sql = "
                    UPDATE champions SET champion_name='$championName', champion_description = '$championDescription', champion_price = '$championPrice' WHERE id='$championId';                    
        ";

        if(mysqli_query($GLOBALS['con'], $sql)){
            TextNode("success", "Champion Successfully Updated");
        }else{
            TextNode("error", "Enable to Update Data");
        }

    }else{
        TextNode("error", "Select Data Using Edit Icon");
    }
}


function deleteRecord(){
    $championId = (int)textboxValue("champion_id");

    $sql = "DELETE FROM champions WHERE id=$championId";

    if(mysqli_query($GLOBALS['con'], $sql)){
        TextNode("success","Record Deleted Successfully...!");
    }else{
        TextNode("error","Enable to Delete Record...!");
    }

}


function deleteBtn(){
    $result = getData();
    $i = 0;
    if($result){
        while ($row = mysqli_fetch_assoc($result)){
            $i++;
            if($i >= 2){
                buttonElement("btn-deleteall", "btn btn-danger" ,"<i class='fas fa-trash'></i> Delete All", "deleteall", "");
                return;
            }
        }
    }
}




function deleteAll(){
    $sql = "DROP TABLE champions";

    if(mysqli_query($GLOBALS['con'], $sql)){
        TextNode("success","All Champion Deleted Successfully...!");
        Createdb();
    }else{
        TextNode("error","Something Went Wrong Record cannot deleted...!");
    }
}


// set id to textbox
function setID(){
    $getId = getData();
    $id = 0;
    if($getId){
        while ($row = mysqli_fetch_assoc($getId)){
            $id = $row['id'];
        }
    }
    return ($id + 1);
}

function createDataTest(){

    $sql = " INSERT INTO champions (champion_name, champion_description, champion_price) 
    VALUES ('Yasuo','Auto ganh team','6300'),('Yone','Anh trai yasuo','7800'),('Lee Sin','Thay tu mu','6300');
            ";

    if(mysqli_query($GLOBALS['con'], $sql)){
            TextNode("success", "Champion Successfully Inserted...!");
    }
    else { echo "Error"; }

                       
}








