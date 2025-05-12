<?php
if(isset($_POST['submit'])){
    $title=_POST['Title'],
    $ID=_POST['ID'],
    $Author=_POST['Author'],

if($title && $ID && $Author){
    $enter="$title,$ID,$Author \n";
    file_put_contents('bookManagement.txt',$enter,FILE_APPEND);
    echo'Book has been added to the system';
} else{
    echo'fill in the form fully please';

}
}


?>