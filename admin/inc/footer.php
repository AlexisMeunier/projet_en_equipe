</main>
	<script   src="https://code.jquery.com/jquery-1.12.3.min.js"   integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ="   crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<!--Penser à mettre le script dans un fichier externe fileInput (js/fileInput.php) -->
    <!--Penser à mettre une condition ==> si page avec upload de fichier, on lie le script, sinon non -->
    <script>
            var fileInput = document.getElementById("browse");
            var textInput = document.getElementById("nomFichier");
            var fauxBouton = document.getElementById("fakeBrowse");
            
            fauxBouton.addEventListener("click", clicBrowse);
            fileInput.addEventListener("change", modifNomFichier)
            
            function clicBrowse(){
                fileInput.click();    
            }
            
            function modifNomFichier(){
                textInput.value = fileInput.value;
            }
        
    </script>
</body>
</html>