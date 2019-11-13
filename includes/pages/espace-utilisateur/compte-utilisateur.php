<div class="container-fluid">
    <div class="row">
        <?php include("./includes/pages/espace-utilisateur/nav-utilisateur.php"); ?>

        
        <section class="col-lg-10">


                
        
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" style="width: 50%;">INFORMATIONS</th>
                        <th scope="col" style="width: 40%;"></th>
                        <th scope="col" style="width: auto;"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row"> Adresse e-mail</th>
                        <td><?php echo(htmlspecialchars($_SESSION['Data']['email'])); ?></td>
                        <td><i class="fas fa-pen edit"></i></td>
                    </tr>
                    <tr>
                        <th scope="row"> Nom d'utilisateur</th>
                        <td><?php echo(htmlspecialchars($_SESSION['Data']['username'])); ?></td>
                        <td><i class="fas fa-pen edit"></i></td>
                    </tr>
                <thead class="thead-light">
                    <tr>
                        <th scope="col" style="width: 50%;">SÉCURITÉ</th>
                        <th scope="col" style="width: 40%;"></th>
                        <th scope="col" style="width: auto;"></th>
                    </tr>
                </thead>
                    <tr>
                        <th scope="row"> Mot de passe</th>
                        <td>****************</td>
                        <td><i class="fas fa-pen edit"></i></td>
                    </tr>
                    <tr>
                        <th scope="row"> Double authentification</th>
                        <td>Désactivée &nbsp; <i class="fas fa-exclamation-triangle warning" title="Conseillé d'activer"></i></td>
                        <td>Btns</td>
                    </tr>
                    <tr>
                        <th scope="row"> Clé de secours</th>
                        <td><?php if ($_SESSION['Data']['backup_password'] != "") { echo("Créée"); } else { echo("Non générée &nbsp; <i class='fas fa-exclamation-triangle error' title='Fortement conseillé de recuperer'></i>"); } ?></td>
                        <td><a href="#" data-toggle="modal" data-target="#modalBackupKey"><?php if ($_SESSION['Data']['backup_password'] != "") { echo("<i class='fas fa-sync edit' title='Créer une nouvelle clé de secours'></i>"); } else { echo("<i class='fas fa-plus-square edit' title='Créer une clé de secours'></i>"); } ?></a></td>
                    </tr>
                <thead class="thead-light">
                    <tr>
                        <th scope="col" style="width: 50%;">PRÉFÉRENCES</th>
                        <th scope="col" style="width: 40%;"></th>
                        <th scope="col" style="width: auto;"></th>
                    </tr>
                </thead>
                    <tr>
                        <th scope="row"> Recevoir des notifications par e-mail</th>
                        <td></td>
                        <td><i class="fas fa-toggle-on enabled"></i></td>
                    </tr>
                </tbody>
            </table>



        </section>

    </div>

</div>

<?php
$backupKey = randomString(16); 
include("./includes/pages/modals/backup-key.php");
?>