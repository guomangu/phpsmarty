<?php
    if ( isset( $_POST['texteArticle'] ) )
    {
        $texteArticle = htmlspecialchars( trim( $_POST['texteArticle'] ) );
        $idProduit = (int)htmlspecialchars( trim( $_POST['idProduit'] ) );;
        $idCategorie = (int)htmlspecialchars( trim( $_POST['idCategorie'] ) );;

        $envoiBDD = true;

        if ( empty( $texteArticle ) )
        {
            $envoiBDD = false;
        }

        if ( empty( $idProduit ) )
        {
            $envoiBDD = false;
        }

        if ( empty( $idCategorie ) )
        {
            $envoiBDD = false;
        }

        if ( $envoiBDD )
        {
            function chargerClasse( $classe )
            {
                require_once 'classes/'.$classe.'.php';
            }

            spl_autoload_register( 'chargerClasse' );

            // Instance de connexion à la bdd
            include 'connect.php';

            $artManager = new ArticlesManager( $bdd );
            $artManager->addArt( 
                new Article( 
                    array(
                        'texte' => $texteArticle,
                        'dateAjout' => date("Y-m-d H:i:s"),
                        'idJeu' => $idProduit,
                        'idCategorie' => $idCategorie
                    )
                )
            );
        }
    }
?>