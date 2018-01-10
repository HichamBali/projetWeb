<!--<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
    <link rel='stylesheet prefetch' href='http://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css'>

</head>

<body>-->
<div>
<?php
include 'home.php';
?>
<!-- formlaire-->
 <div id="add_data_Modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Ajouter un médecin</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="insert_form" action="ajouterMedecin.php">

                    <label>Nom</label>
                    <input type="text" name="nom_m" id="nom" class="form-control" />
                    <br/>

                    <label>Prénom</label>
                    <input type="text" name="prenom_m" id="prenom" class="form-control" />
                    <br/>

                    <label>Adresse</label>
                    <textarea name="adresse_m" id="adresse" class="form-control"></textarea>
                    <br/>

                    <label>Grade</label>
                    <input type="text" name="grade_m" id="grade" class="form-control" />
                    <br/>

                    <label>Spécialité</label>
                    <select name="specialite_m" id="specialite" class="form-control">
                        <option value="Cardiologue">Cardiologue</option>
                        <option value="Interniste">Interniste</option>
                        <option value="Hémathologue">Hémathologue</option>
                        <option value="Généraliste">Généraliste</option>
                    </select>
                    <br/>

                    <label>Téléphone</label>
                    <input type="text" name="numTel_m" id="numTel" class="form-control" />
                    <br/>

                    <label>Nom d'utilisateur</label>
                    <input type="text" name="user" id="user" class="form-control"/>
                    <br/>

                    <label>Mot de passe</label>
                    <input type="password" name="password" id="password" class="form-control"/>
                    <br/>


                    <input type="submit" name="Ajouter" id="ajouter" value="Valider" class="btn btn-primary" />
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>

            </div>
        </div>
    </div>
 </div>

</div>
<!-- ici on affiche le tableau -->
<div align="center">
 <h2>Liste Médecin</h2>
</div>
<div align="right">
 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_data_Modal">
    <i class="fa fa-plus"></i>Ajouter</button>
</div>
<br/>
<div class="table-responsive" id="table_medecin">

    <table id="autoGeneratedID" role="grid" class="table table-striped table-bordered">
        <caption class="sr-only">Liste des médecins.</caption>
        <!-- le head du tableau-->
        <thead>
        <tr>
            <th id="idMEDECIN" role="gridcell">ID</th>
            <th id="nom_m" role="gridcell">Nom</th>
            <th id="prenom_m" role="gridcell">Prénom</th>
            <th id="adresse_m" role="gridcell">Adresse</th>
            <th id="grade_m" role="gridcell">Grade</th>
            <th id="specialite_m" role="gridcell">Spécialité</th>
            <th id="numTel_m" role="gridcell">Téléphone</th>
            <th> id=</th>


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

        $r=$bdd->query('SELECT * FROM medecin');
        $row_count = 1;
        while($donne=$r->fetch()){
            ?>
            <tr>

                <td id="ids" role="gridcell"><?php echo $donne['idMEDECIN'];?></td>
                <td id="nom_m" role="gridcell"><?php echo $donne['nom_m'];?></td>
                <td id="prenom_m" role="gridcell"><?php echo $donne['prenom_m'];?></td>
                <td id="adresse_m" role="gridcell"><?php echo $donne['adresse_m'];?></td>
                <td id="grade_m" role="gridcell"><?php echo $donne['grade_m'];?></td>
                <td id="specialite_m" role="gridcell"><?php echo $donne['specialite_m'];?></td>
                <td id="numTel_m" role="gridcell"><?php echo $donne['numTel_m'];?></td>

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

    $(document).ready(function() {
        $('#autoGeneratedID').Tabledit({
            url: 'modifierMed.php',
            columns: {
                identifier: [0, "idMEDECIN"],
                editable: [[1, 'nom_m'], [2, 'prenom_m'], [3, 'adresse_m'], [4, 'grade_m'], [5, 'specialite_m'], [6, 'numTel_m']]
            },
            restoreButton: false,
            onSuccess: function (data, textStatus, jqXHR) {
                if (data.action == 'delete') {
                    $('#' + data.id).remove();
                }
            }
        });


        /* ici c'est le script de dataTable au lieu de faire appelle à index.js on l'a copié ici pour que ça fonctionne*/

        $('#autoGeneratedID').dataTable({
            "columnDefs": [
                {"orderable": false, "targets": 0}/*il y'avait 3 pour le double clique et modifier*/
            ]
        });
        $('#autoGeneratedID td').attr('role', 'gridcell');
        $('#autoGeneratedID tr').attr('role', 'row');
        $('#autoGeneratedID th').attr('role', 'gridcell');
        $('#autoGeneratedID table').attr('role', 'grid');
        // $('#autoGeneratedID td:nth-of-type(-n+3)').attr('contenteditable', 'true');


    });

// le script du formulaire ajouter..
</script>
<!--pour afficher les btn delete et edit-->
<script src="js/jquery/jquery.tabledit.js"></script>
<!--
<script>
    $(document).ready(function(){
        $('#insert_form').on("submit", function(event){
            event.preventDefault();
            if($('#nom').val() == "")
            {
                alert("Name is required");
            }
            else if($('#prenom').val() == '')
            {
                alert("prenom is required");
            }
            else if($('#grade').val() == '')
            {
                alert("grade is required");
            }

            else
            {
                //faire appelle directement à ajouterMedecin.php
                $.ajax({
                    url:"ajouterMedecin.php",
                    method:"POST",
                    data:$('#insert_form').serialize(),
                    beforeSend:function(){
                        $('#insert').val("Inserting");
                    },
                    success:function(data){
                        $('#insert_form')[0].reset();
                        $('#add_data_Modal').modal('hide');
                        $('#table_medecin').html(data);
                    }
                });
            }
        });
    });
</script>











