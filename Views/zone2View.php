<?php
// Les fichiers utilisés : 
require_once('Controller/marqueController.php');
require_once 'Controller/versionController.php';
require_once 'Controller/modeleController.php';

class zone2View {

    public function Zone2Display($i){

        $marque_controller = new marqueController();
        $marques = $marque_controller->get_Marques_controller()->fetchAll(PDO::FETCH_ASSOC);

        $modele_controller = new Modele_controller();
       
        $version_controller = new Version_controller();
       

        echo "<div class='zone2'>
        <div class='title'><h3>Comparaison</h3></div>
        <form id='vehicule-form' action='index.php?action=comparateur' method='post'>
        <div class='fildsets'>" ;

        while($i<4){
            $j = $i+1;
            echo "<fieldset id ='fieldset$j' >
            <legend>Véhicule $j</legend>";

            echo "<select class='marque' name='marque$j'  >
            <option value class='select-element' disabled selected>Marque</option>";

            foreach($marques as $row){
                echo '<option value='.$row['id'].'>'.$row['nom'].'</option>';
            }

            echo "</select>" ;


            echo "<select class='modele' name='modele$j' disabled>
            <option value class='select-element' disabled selected>Modele</option></select>" ;

            echo "<select class='version' name='version$j'  disabled>
            <option value class='select-element' disabled selected>Version</option></select>" ;

            echo "<select class='annee' name='annee$j'  disabled>
            <option value class='select-element' disabled selected>Année</option></select>" ;


            echo "</fieldset>";
            $i++;
        }
    


        
        echo "</div><div class='comparer-button' >
            <button name='submit' disabled type='submit'>Comparer</button>
        </div>
        </form>";
        
        echo "</div>";




        
        echo "<script>
        let models = [];  
        let versions = []; 
        let versionContent ;  
        " ; 


        $modeles = $modele_controller->get_Modeles_controller();
        $result = $modeles->fetchAll(PDO::FETCH_ASSOC);

        echo " models.push(".json_encode($result)."); ";

        $versions = $version_controller->get_versions_controller();
        $result = $versions->fetchAll(PDO::FETCH_ASSOC);

        echo " versions.push(".json_encode($result)."); ";

        echo "

    
        function enableComparerButton() {
            const fieldsets = [
                $('#fieldset1'),
                $('#fieldset2'),
                $('#fieldset3'),
                $('#fieldset4')
            ];
        
            const selectedFieldsets = fieldsets.filter(fieldset => {
                return (
                    fieldset.find('.marque').val() &&
                    fieldset.find('.modele').val() &&
                    fieldset.find('.version').val() &&
                    fieldset.find('.annee').val()
                );
            });
        
            const uniqueFieldsets = Array.from(new Set(selectedFieldsets));
        
            if (uniqueFieldsets.length >= 2 && !areFieldsetsEqual(uniqueFieldsets)) {
                $('.comparer-button button').prop('disabled', false);
            } else {
                $('.comparer-button button').prop('disabled', true);
            }
        }
        
        function areFieldsetsEqual(fieldsets) {
            const [firstFieldset, ...restFieldsets] = fieldsets;
        
            return restFieldsets.every(fieldset => {
                return (
                    firstFieldset.find('.marque').val() === fieldset.find('.marque').val() &&
                    firstFieldset.find('.modele').val() === fieldset.find('.modele').val() &&
                    firstFieldset.find('.version').val() === fieldset.find('.version').val() &&
                    firstFieldset.find('.annee').val() === fieldset.find('.annee').val()
                );
            });
        }
        
        function setupFieldsetEvents(fieldsetSelector, models, versions) {
            const fieldset = $(fieldsetSelector);
            console.log('fieldset',fieldset);
            const marqueSelect = fieldset.find('.marque');
            console.log('marqueSelect',marqueSelect);
            const modeleSelect = fieldset.find('.modele');
            const versionSelect = fieldset.find('.version');
            const anneeSelect = fieldset.find('.annee');
        
            marqueSelect.on('change', function () {
                console.log('marqueSelect on change');
                let marqueId = $(this).val();
                console.log('marqueSelect on change',marqueId);

                let modeleContent = models[0].filter(entry => String(entry.marque_id) === String(marqueId));
        
                modeleSelect.prop('disabled', false);
                modeleSelect.empty().append('<option value disabled selected>Modele</option>');
                versionSelect.empty().append('<option value disabled selected>Version</option>');
                anneeSelect.empty().append('<option value disabled selected>Année</option>');
        
                for (let i = 0; i < modeleContent.length; i++) {
                    modeleSelect.append('<option value=' + modeleContent[i]['id'] + '>' + modeleContent[i]['nom'] + '</option>');
                }
            });
        
            modeleSelect.on('change', function () {
                let modeleId = $(this).val();
                versionContent = versions[0].filter(entry => String(entry.modele_id) === String(modeleId));
        
                versionSelect.prop('disabled', false);
                versionSelect.empty().append('<option value disabled selected>Version</option>');
                anneeSelect.empty().append('<option value disabled selected>Année</option>');
        
                const uniqueNomsSet = new Set();
                for (let i = 0; i < versionContent.length; i++) {
                    if (!uniqueNomsSet.has(versionContent[i]['nom'])) {
                        uniqueNomsSet.add(versionContent[i]['nom']);
                        versionSelect.append('<option value=' + versionContent[i]['id'] + '>' + versionContent[i]['nom'] + '</option>');
                    }
                }
            });
        
            versionSelect.on('change', function () {
                anneeSelect.prop('disabled', false);
                anneeSelect.empty().append('<option value disabled selected>Année</option>');
        
                for (let i = 0; i < versionContent.length; i++) {
                    anneeSelect.append('<option value=' + versionContent[i]['id'] + '>' + versionContent[i]['annee'] + '</option>');
                }
            });
            
            fieldset.find('.marque, .modele, .version, .annee').on('change', function () {
                enableComparerButton();
            });
        }
        
        setupFieldsetEvents('#fieldset1', models, versions);
        setupFieldsetEvents('#fieldset2', models, versions);
        setupFieldsetEvents('#fieldset3', models, versions);
        setupFieldsetEvents('#fieldset4', models, versions);
       

    
        
        </script>
        ";


   

     
    }
       
    

}


?>