<?php
// Les fichiers utilisés : 
require_once('Controller/acceuilController.php');
require_once('Controller/adminController.php');
require_once('Controller/utilisateurController.php');


class UserAdminView {

    private $acceuil_controller ;
    private $admin_controller ;
    private $vehicule_controller;
    private $userController;

    public function __construct() {
        $this->acceuil_controller = new acceuilController();
        $this->admin_controller = new adminController();
        $this->vehicule_controller = new Vehicule_controller();
        $this->userController = new userController();
    }

    public function usersDisplay(){
        echo"<!DOCTYPE html>
        <html>";

        $this->acceuil_controller->head();
        $this->acceuil_controller->header();

        $this->admin_controller->manageLinksGenerate();

      


        $this->displayTable();


        
        $this->acceuil_controller->footer();

        echo "</div></body></html>";
    }


    public function filter(){

        $r = $this->userController->get_nonAdmin_users_controller(); 
        $r = $r->fetchAll(PDO::FETCH_ASSOC);

        $htmlContent = '';

        if (isset($_POST['statusFilter']) && !empty($_POST['statusFilter'])) {
            $selectedStatus = $_POST['statusFilter'];
            $filteredRows = array_filter($r, function($row) use ($selectedStatus) {
                return $row['statut'] == $selectedStatus;
            });
        
            foreach ($filteredRows as $row) {
                $htmlContent .= "
                <tr>
                        <td>".$row['id']."</td>
                        <td>".$row['nom']."</td>
                        <td>".$row['prenom']."</td>
                        <td>".$row['sexe']."</td>
                        <td>".$row['date_de_naissance']."</td>
                        <td>".$row['nom_utilisateur']."</td>
                        <td>".$row['statut']."</td>
                        <td>
                        <a href='index.php' >Voir profile</a>
                        </td>

                        <td>" ;
                        if($row['statut'] === 'valide'){

                        }
                        else {
                            $htmlContent .="<a href='index.php?action=admin&page=user&tache=valide&id=".$row['id']."' ><img src='img/validate.png'></a>";
                        }
                      
                        $htmlContent .="<a href='index.php?action=admin&page=user&tache=bloque&id=".$row['id']."' ><img src='img/block.png'></a>
                        </td>
                       
                    </tr>";
            }
        } else {
            // If no filter is applied, return the original table content
            foreach ($r as $row) {
                $htmlContent .= "
                <tr>
                        <td>".$row['id']."</td>
                        <td>".$row['nom']."</td>
                        <td>".$row['prenom']."</td>
                        <td>".$row['sexe']."</td>
                        <td>".$row['date_de_naissance']."</td>
                        <td>".$row['nom_utilisateur']."</td>
                        <td>".$row['statut']."</td>
                        <td>
                        <a href='index.php' >Voir profile</a>
                        </td>

                        <td>" ;
                        if($row['statut'] === 'valide'){

                        }
                        else {
                            $htmlContent .= "<a href='index.php?action=admin&page=user&tache=valide&id=".$row['id']."' ><img src='img/validate.png'></a>";
                        }
                      
                        $htmlContent .="<a href='index.php?action=admin&page=user&tache=bloque&id=".$row['id']."' ><img src='img/block.png'></a>
                        </td>
                       
                    </tr>";
            }
        }

        echo "$htmlContent";
    }



    public function displayTable(){

        // only the vehicules 
        $r = $this->userController->get_nonAdmin_users_controller(); 
        $r = $r->fetchAll(PDO::FETCH_ASSOC);
    
        // Get unique statuses from the result
        $statuses = array_unique(array_column($r, 'statut'));
    
        // the table 
       echo "
       <div class='table-responsive table-admin'>
            <form method='post' action=''>
                <div class='form'>
                    <label for='statusFilter'>Filter by Status:</label>
                    <select name='statusFilter' id='statusFilter'>
                        <option value=''>All</option>";
    
        
        foreach ($statuses as $status) {
            echo "<option value='$status'>$status</option>";
        }
    
        echo "</select>
                </div>
                
            </form>

            <table id='myTable' class='table'>
            <thead>
                <tr>
                    <th>Utilisateur ID</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Sexe</th>
                    <th>Date de naissance</th>
                    <th>Nom utilisateur</th>
                    <th>Statut</th>
                    <th>Profile</th>
                    <th>Gestion</th>
                </tr>
            </thead>
            <tbody>";
    
            // Filter based on selected status
            $filteredRows = $r;
    
            foreach ($filteredRows as $row) {
                echo "
                    <tr>
                        <td>".$row['id']."</td>
                        <td>".$row['nom']."</td>
                        <td>".$row['prenom']."</td>
                        <td>".$row['sexe']."</td>
                        <td>".$row['date_de_naissance']."</td>
                        <td>".$row['nom_utilisateur']."</td>
                        <td>".$row['statut']."</td>
                        <td>
                        <a href='index.php' >Voir profile</a>
                        </td>

                        <td>" ;
                        if($row['statut'] !== 'valide'){
                            echo "<a href='index.php?action=admin&page=user&tache=valide&id=".$row['id']."' ><img src='img/validate.png'></a>";
                        }

                        echo"<a href='index.php?action=admin&page=user&tache=bloque&id=".$row['id']."' ><img src='img/block.png'></a>
                        </td>
                       
                    </tr>";
            }
                
            echo "
            </tbody>
            </table></div>";

            echo "
            <script>
                $(document).ready(function () {
                    
                    $('#myTable').DataTable();

                    $('#statusFilter').on('change', function () {
                        var selectedStatus = $(this).val();

                        $.ajax({
                            type: 'POST',
                            url: 'index.php?action=admin&page=user&tache=filter', 
                            data: { statusFilter: selectedStatus },
                            success: function (data) {
                                $('#myTable').DataTable().destroy();
                                $('#myTable').DataTable();
                                $('#myTable tbody').html(data);
                            },
                            error: function (xhr, status, error) {
                                console.error('AJAX Error: ' + status + ' - ' + error);
                            }
                        });
                    });
                });
            </script>
            ";
            
            
    }
    

   

}

?>