<?php

$contra = 'hola';

$pass_cifrada = password_hash($contra,PASSWORD_DEFAULT,array("cost"=>12));

echo $pass_cifrada."<br>";

if (password_verify('hola',$pass_cifrada)) {
   
}else{
    echo "No";
}