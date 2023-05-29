<?php
    if ( isset( $_POST['texteCommentaire'] ) )
    {
        $texteCommentaire = htmlspecialchars( trim( $_POST['texteCommentaire'] ) );
        $idArticle = (int)htmlspecialchars( trim( $_POST['idArticle'] ) );

        $envoiBDD = true;

        if ( empty( $texteCommentaire ) )
        {
            $envoiBDD = false;
        }

        if ( empty( $idArticle ) )
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

            $commentManager = new CommentairesManager( $bdd );
            $commentManager->add( 
                new Commentaire( 
                    array(
                        'texte' => $texteCommentaire,
                        'dateAjout' => date("Y-m-d H:i:s"),
                        'idArticle' => $idArticle
                    )
                )
            );
        }
    }
?>