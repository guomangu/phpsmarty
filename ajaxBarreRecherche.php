<?php
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\"?>\n";
    echo "<barreRecherche>\n";

    if ( !empty( $_GET['input'] ) )
    {
        // Connection à la base de données
        include 'connect.php';

        $reqList = $bdd->prepare( 'SELECT titre FROM Jeux WHERE titre LIKE \''.$_GET['input'].'%\'' );
        $reqList->execute();

        while ( $donnees = $reqList->fetch() )
        {
            $text = preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $donnees['titre']);
            echo "<donnee>".$text."</donnee>\n";
            echo "lol";
        }
        $reqList->closeCursor();
    }
    
    echo "</barreRecherche>\n";
?>