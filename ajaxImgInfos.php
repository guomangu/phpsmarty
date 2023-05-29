<?php
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\"?>\n";
    echo "<imgInfos>";

    if ( !empty( $_GET['table'] ) )
    {
        // Connection à la base de données
        include 'connect.php';

        $donneesParPage = 5;

        $sql = $bdd->prepare( "SELECT count(*) AS 'total' FROM ".$_GET['table'] );
        $sql->execute();
        $donnees = $sql->fetch( PDO::FETCH_ASSOC );
        $sql->closeCursor();
            
        $totalDonnees = (int)$donnees['total'];
        $nombreDePages = ceil( $totalDonnees/$donneesParPage );
        
        echo "<nbPages>".$nombreDePages."</nbPages>";

        $sql = $bdd->prepare( "SELECT * FROM ".$_GET['table']." LIMIT 1" );
        $sql->execute();
        $donnees = $sql->fetch( PDO::FETCH_ASSOC );
        $sql->closeCursor();
        foreach ( $donnees as $key => $value )
        {
            echo "<enteteTableau>".$key."</enteteTableau>";
        }
    }
    
    echo "</imgInfos>";
    sleep(0.2);
?>