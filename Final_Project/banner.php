<?php
print '
                <span id="button"><button id="quicksearch">Search Site</button>
                </span>                
                <div id="dropdownsearch">
                    <form action="search.php" method="post"> 
                        <br> Search 
                        <select name ="searchbar" required>
                            <option value="all">Entire Site</option>
                            <option value="reps">SAAC Members</option>
                            <option value="albums">Albums</option>                        
                        </select>
                        for :
                        <input type="text" name="searchterm" required>
                        <input type="submit" value="search" name="search"> <br>
                        Need More Fields? -<a href="advSearch.php">Advanced Search</a>
                    </form>
                </div>
        
        <script type="text/javascript">
                    $("#quicksearch").click(function(){
                        $("#dropdownsearch").toggle("display");
                        console.log("LOL so close");
                    });
        </script>';
    
?>