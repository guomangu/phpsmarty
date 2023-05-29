<?php
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\"?>\n";
    echo "<etape2>";

    if ( !empty( $_GET['table'] ) && !empty( $_GET['page'] ) && !empty( $_GET['maxLignes'] ) )
    {
        // Connection à la base de données
        include 'connect.php';

        $donneesParPage = intval( $_GET['maxLignes'] );

        $sql = $bdd->prepare( "SELECT count(*) AS 'total' FROM ".$_GET['table'] );
        $sql->execute();
        $donnees = $sql->fetch( PDO::FETCH_ASSOC );
        $sql->closeCursor();
            
        $totalDonnees = (int)$donnees['total'];
        $nombreDePages = ceil( $totalDonnees/$donneesParPage );

        $pageActuelle = intval( $_GET['page'] );
        if ( $pageActuelle > $nombreDePages )
        {
            $pageActuelle=$nombreDePages;
        }

        $donneesStart = ($pageActuelle - 1) * $donneesParPage;

        $reqList = $bdd->query( 'SELECT * FROM '.$_GET['table'].' LIMIT '.$donneesStart.', '.$donneesParPage.'' );
        while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) )
        {
            echo "<corpsTableau>";
            foreach ( $tabDonnees as $key => $value )
            {
                $value = preg_replace( '/&(?!#?[a-z0-9]+;)/', '&amp;', $value );
                echo "<".$key.">".$value."</".$key.">";
            }
            echo "</corpsTableau>"; 
        }
        $reqList->closeCursor();
    }
    
    echo "</etape2>";
?>