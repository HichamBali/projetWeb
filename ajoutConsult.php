<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 03/01/2018
 * Time: 14:49
 */

//ajouter consultation.
$rapport = $_POST['rapport'];
$ordonnance = $_POST['ordonnance'];
$certificat = $_POST['certificat'];
$orientation = $_POST['orientation'];
$dateCons = $_POST['dateCons'];
$idPATIENT = $_POST['id'];

$ajouter = $_POST['ajouter'];



try {
    //on insère d'abord ds la table consultation

    $connexionDB = new PDO('mysql:host=localhost;dbname=service', 'root', '');
    $insert = $connexionDB->query("INSERT INTO consultation(rapport, ordonnance, orientation, certificat,dateCons, idPatient )
         VALUES ('" . $rapport . "','" . $ordonnance . "','" . $orientation . "','" . $certificat . "','" . $dateCons . "','" . $idPATIENT . "')");
    $connexionDB->exec($insert);

    //le id Patient!

    header("location:listePatient.php");
} catch
(PDOException $e) {
    die("Erreur: " . $e->getMessage());
}
