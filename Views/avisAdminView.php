<?php
// Les fichiers utilisés : 
require_once('Controller/acceuilController.php');
require_once('Controller/adminController.php');
require_once('Controller/vehiculeController.php');
require_once('Controller/avisController.php');


class AvisAdminView {

    private $acceuil_controller ;
    private $admin_controller ;
    private $vehicule_controller;
    private $avisController;

    public function __construct() {
        $this->acceuil_controller = new acceuilController();
        $this->admin_controller = new adminController();
        $this->vehicule_controller = new Vehicule_controller();
        $this->avisController = new avisController();
    }

    public function avisDisplay(){
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

        $r = $this->avisController->get_avis_vehicule_controller(); 
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
                    <td>".$row['utilisateur_id']."</td>
                    <td>".$row['target_id']."</td>
                    <td>".$row['commentaire']."</td>
                    <td>".$row['statut']."</td>
                    <td> 
                        <a href='index.php?action=admin&page=avis&tache=refus&id=".$row['id']."'><img src='img/refuse.png'></a>
                        <a href='index.php?action=admin&page=avis&tache=bloque&id=".$row['utilisateur_id']."'><img src='img/block.png'></a>
                        <a href='index.php?action=admin&page=avis&tache=valide&id=".$row['id']."' ><img src='img/validate.png'></a>
                    </td>
                    <td> 
                        <a href='index.php?action=admin&page=avis&tache=supp&id=".$row['id']."'><img src='img/delete.png'></a>
                    </td>
                </tr>";
            }
        } else {
            // If no filter is applied, return the original table content
            foreach ($r as $row) {
                $htmlContent .= "
                    <tr>
                        <td>".$row['utilisateur_id']."</td>
                        <td>".$row['target_id']."</td>
                        <td>".$row['commentaire']."</td>
                        <td>".$row['statut']."</td>
                        <td> 
                        <a href='index.php?action=admin&page=avis&tache=refus&id=".$row['id']."'><img src='img/refuse.png'></a>
                        <a href='index.php?action=admin&page=avis&tache=bloque&id=".$row['utilisateur_id']."'><img src='img/block.png'></a>
                        <a href='index.php?action=admin&page=avis&tache=valide&id=".$row['id']."' ><img src='img/validate.png'></a>
                    </td>
                    <td> 
                        <a href='index.php?action=admin&page=avis&tache=supp&id=".$row['id']."'><img src='img/delete.png'></a>
                    </td>
                    </tr>";
            }
        }

        echo "$htmlContent";
    }



    public function displayTable(){

        // only the vehicules 
        $r = $this->avisController->get_avis_vehicule_controller(); 
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
                    <th>Cible ID</th>
                    <th>Commentaire</th>
                    <th>Statut</th>
                    <th>Actions</th>
                    <th>Gestion</th>
                </tr>
            </thead>
            <tbody>";
    
            // Filter based on selected status
            $filteredRows = $r;
    
            foreach ($filteredRows as $row) {
                echo "
                    <tr>
                        <td>".$row['utilisateur_id']."</td>
                        <td>".$row['target_id']."</td>
                        <td>".$row['commentaire']."</td>
                        <td>".$row['statut']."</td>
                        <td> 
                        <a href='index.php?action=admin&page=avis&tache=refus&id=".$row['id']."'><img src='img/refuse.png'></a>
                        <a href='index.php?action=admin&page=avis&tache=bloque&id=".$row['utilisateur_id']."'><img src='img/block.png'></a>
                        <a href='index.php?action=admin&page=avis&tache=valide&id=".$row['id']."' ><img src='img/validate.png'></a>
                    </td>
                    <td> 
                        <a href='index.php?action=admin&page=avis&tache=supp&id=".$row['id']."'><img src='img/delete.png'></a>
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
                            url: 'index.php?action=admin&page=avis&tache=filter', 
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