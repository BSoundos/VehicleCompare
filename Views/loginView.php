<?php
// Les fichiers utilisés : 


class loginView {

    public function loginDisplay(){

        echo "
        <div class='overlay' id='overlay' ></div>
        <div class='modal'  id='loginModal' >
          <h2>Authentification</h2>
          <form method = 'POST' action='index.php?action=login'>
          
            <input type='text'  name='username' placeholder='Nom utilisateur'>
            <br>
            <input type='password'   name='password' placeholder='Mot de passe'>
            <br>
            <button type='submit'>Login</button>

            <a href='' id='inscription' onclick='toggleModal(event)'>vous n'avez pas de compte?</a>
          
          </form>
        </div>

        <div class='modal'  id='inscriptionModal' >
            <h2>Inscription</h2>
            <form method = 'POST' action='index.php?action=subscribe'>
            
                <input type='text'  id='nom'  name='nom' placeholder='Nom' required>
                <br>

                <input type='text'  id='prenom'  name='prenom' placeholder='Prenom' required>
                <br>

                <select id='genre' name='genre' placeholder='Séléctionner votre sexe' required>
                    <option value='M'>Homme</option>
                    <option value='F'>Femme</option>
                </select>
                <br>

                <input type='text' id='date' name='date' placeholder='Date de naissance' required>
                <br>

                <input type='password'  id='password'  name='password' placeholder='Mot de passe' required>
                <br>

                <button type='submit' name='register'>S'inscrire</button>
            </form>
        </div>
        ";


        echo "
        <script>
  
            function openModal() {
                document.getElementById('loginModal').style.display = 'block';
                document.getElementById('overlay').style.display = 'block';
            }

            function closeModal() {
                document.getElementById('loginModal').style.display = 'none';
                document.getElementById('inscriptionModal').style.display = 'none';
                document.getElementById('overlay').style.display = 'none';
            }

            function toggleModal(event) {
                event.preventDefault(); 
                document.getElementById('loginModal').style.display = 'none';
                document.getElementById('inscriptionModal').style.display = 'block';
                document.getElementById('overlay').style.display = 'block';
            }
            
            document.getElementById('loginLink').addEventListener('click', function(event) {
                event.preventDefault(); 
                openModal(); 
            });

           
            document.getElementById('overlay').addEventListener('click', function() {
                closeModal();
            });

            
        </script>
        ";
            
    }
       
    

}


?>