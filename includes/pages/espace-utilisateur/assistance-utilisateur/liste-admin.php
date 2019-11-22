
                <?php
                $query = "SELECT * FROM kioui_tickets WHERE assigned = " . $_SESSION['Data']['id'] . " OR assigned = 0 ORDER BY `date` DESC";
                $results = mysqli_query($connection, $query);
                $openedTicketCount = 0;
                $table = "";
                $status = "";
                $priority = "";
                $assigned = "";
                //Suppression des fichiers
                while ($ticket = mysqli_fetch_assoc($results)) {
                    
                    switch ($ticket['status']) {
                        case "OPEN":
                            $status = "<span class='badge badge-info'>Reponse de l'utilisateur</span>";
                            break;
                        case "CLOSED_BY_USER":
                            $status = "<span class='badge badge-danger'>Fermée par l'utilisateur</span>";
                            break;
                        case "CLOSED_BY_SUPPORT":
                            $status = "<span class='badge badge-danger'>Fermée par le support</span>";
                            break;
                        case "EXPIRED":
                            $status = "<span class='badge badge-danger'>Expirée</span>";
                            break;
                        case "RESPONDED":
                            $status = "<span class='badge badge-success'>Reponse du support</span>";
                            break;
                        default:
                            $status = "<span class='badge badge-danger'>Erreur</span>";
                            break;
                    }
                    
                    switch ($ticket['priority']) {
                        case "LOW":
                            $priority = "<span class='badge badge-success'>Faible</span>";
                            break;
                        case "MEDIUM":
                            $priority = "<span class='badge badge-warning'>Moyenne</span>";
                            break;
                        case "HIGH":
                            $priority = "<span class='badge badge-danger'>Haute</span>";
                            break;
                        case "HIGHEST":
                            $priority = "<span class='badge badge-danger'>Prioritaire</span>";
                            break;
                        default:
                            $priority = "<span class='badge badge-danger'>Erreur</span>";
                            break;
                    }

                    $assigned = ($ticket['assigned'] == 0) ? "<span class='badge badge-danger'>Non</span>" : "<span class='badge badge-success'>Oui</span>";

                    $subject = (strlen($ticket["subject"]) > 80) ? substr($ticket["subject"], 0, 77) . "..." : $ticket["subject"];
                    //Colonne Sujet
                    $table .=  "<tr><td><a href='/espace-utilisateur/assistance/" . $ticket['id'] . "/' class='link' style='font-weight: bold; color: #212529;'><span title='" . htmlspecialchars($ticket["subject"]) . "'>" . htmlspecialchars($subject) . "</span></a></td>\n";
                    //Colonne Date
                    $table .=  "<td>" . date("d/m/Y", $ticket["date"]) . "&nbsp;&nbsp;&nbsp;" . date("H:i:s", $ticket["date"]) . "</td>\n";
                    //Colonne Priorité
                    $table .=  "<td>" . $priority . "</td>\n";
                    //Colonne Assigné ?
                    $table .=  "<td>" . $assigned . "</td>\n";
                    //Colonne Statut
                    $table .=  "<td>" . $status . "</td>\n";
                    //Colonne Action
                    $table .=  "<td>" . "<a href='/espace-utilisateur/assistance/" . $ticket['id'] . "/' title='Visualiser'><i class='fas fa-eye edit'></i></a>" . "</td></tr>\n";
                }
                ?>



                <div class="col panel-outline">
                    <h4 class="panel-title">Mes demandes assignées / Demandes en attente d'assignation</h4>


                    <table class="table">
                        <thead class="thead">
                            <th style="width:35%;">Sujet</th>
                            <th style="width:19%;">Date</th>
                            <th style="width:10%;">Priorité</th>
                            <th style="width:10%;">Assigné ?</th>
                            <th style="width:16%;">Statut</th>
                            <th style="width:10%;">Actions</th>
                        </thead>

                        <?php echo($table); ?>

                    </table>

                </div>


                <div class="col-lg-3 panel-outline">
                    <h4 class="panel-title">Incidents en cours</h4>

                    <ul style="list-style-type: none;">
                        <li><i class="fas fa-exclamation-circle warning"></i> &nbsp; &nbsp; Maintenances<br /><b>├</b> &nbsp; &nbsp; &nbsp; Fonctionnalités en cours de developpement<br /><b>└</b> &nbsp; &nbsp; &nbsp; Site en cours de developpement</li>
                        <li><i class="fas fa-check success"></i> &nbsp; &nbsp; Serveur web en ligne</li>
                        <li><i class="fas fa-check success"></i> &nbsp; &nbsp; Serveur de stockage en ligne</li>
                    </ul>
                
                    <h4 class="panel-title">Ressources</h4>

                    <ul style="list-style-type: none;">

                        <li><a href="#" class="link">Comment mes données sont chiffrées ?</a></li>
                        <li><a href="#" class="link">Comment controler mes données ?</a></li>

                    </ul>

                </div>
