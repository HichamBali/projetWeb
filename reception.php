<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 06/01/2018
 * Time: 02:54
 */

if ($_FILES['icone']['error'] > 0) $erreur = "Erreur lors du transfert";
$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );

$extension_upload = strtolower(  substr(  strrchr($_FILES['icone']['name'], '.')  ,1)  );
if ( in_array($extension_upload,$extensions_valides) ) echo "Extension correcte";