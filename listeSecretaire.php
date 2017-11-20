
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 19/11/2017
 * Time: 22:02
 */
<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">


    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
    <link rel='stylesheet prefetch' href='http://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css'>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>
<?php
include 'home.html';
?>
<!-- ici on affiche le tableau -->
<div class="table-responsive" id="table_medecin">

    <table id="autoGeneratedID" role="grid" class="table table-striped table-bordered">
        <caption class="sr-only">Liste des médecins.</caption>
        <!-- le head du tableau-->
        <thead>
        <tr>
            <th id="idSECRETAIRE" role="gridcell">ID</th>
            <th id="nom_s" role="gridcell">Nom</th>
            <th id="prenom_s" role="gridcell">Prénom</th>
            <th id="numTel_s" role="gridcell">Téléphone</th>
            <th id="niveau_s" role="gridcell">Niveau</th>
            <th id="adresse_s" role="gridcell">Adresse</th>


        </tr>
        </thead>
        <tbody>
        <!--ici on recupere les donnee du tab de la bdd -->
        <?php
        try{
            $bdd = new PDO('mysql:host=localhost;dbname=service;charset=utf8','root','') ;
        }catch(Exception $e){
            echo "errreur" ;
        }

        $r=$bdd->query('SELECT * FROM secretaire');
        $row_count = 1;
        while($donne=$r->fetch()){
            ?>
            <tr>

                <td id="ids" role="gridcell"><?php echo $donne['idSECRETAIRE'];?></td>
                <td id="nom_m" role="gridcell"><?php echo $donne['nom_s'];?></td>
                <td id="prenom_m" role="gridcell"><?php echo $donne['prenom_s'];?></td>
                <td id="numTel_m" role="gridcell"><?php echo $donne['numTel_s'];?></td>
                <td id="niveau_m" role="gridcell"><?php echo $donne['niveau_s'];?></td>
                <td id="adresse_m" role="gridcell"><?php echo $donne['adresse_s'];?></td>

            </tr>
            <?php
            $row_count ++ ;
        }
        ?>

        <tbody>
    </table>

</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js'></script>
<script src='http://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js'></script>

<!--ce script pour le fonctionnement des deux btn delete & edit il prend en parametre #idDuTABLEAU et fait appelle à modifier.php-->
<script>

    $(document).ready(function(){
        $('#autoGeneratedID').Tabledit({
            url:'modifierSec.php',
            columns:{
                identifier:[0, "idSECRETAIRE"],
                editable:[[1, 'nom_s'], [2, 'prenom_s'],[3, 'numTel_s'], [4, 'niveau_s'],[5, 'adresse_s']]
            },
            restoreButton:false,
            onSuccess:function(data, textStatus, jqXHR)
            {
                if(data.action == 'delete')
                {
                    $('#'+data.id).remove();
                }
            }
        });


        /* ici c'est le script de dataTable au lieu de faire appelle à index.js on l'a copié ici pour que ça fonctionne*/

        $('#autoGeneratedID').dataTable({
            "columnDefs": [
                { "orderable": false, "targets": 0 }/*il y'avait 3 pour le double clique et modifier*/
            ]
        } );
        $('#autoGeneratedID td').attr('role', 'gridcell');
        $('#autoGeneratedID tr').attr('role', 'row');
        $('#autoGeneratedID th').attr('role', 'gridcell');
        $('#autoGeneratedID table').attr('role', 'grid');
        // $('#autoGeneratedID td:nth-of-type(-n+3)').attr('contenteditable', 'true');

    });

</script>
<!--pour afficher les btn delete et edit-->
<script src="js/jquery/jquery.tabledit.js"></script>

</body>

</html>