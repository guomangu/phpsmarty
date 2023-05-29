<?php
    require_once 'smarty/libs/Smarty.class.php';
    
    function chargerClasse($classe)
    {
        require_once 'classes/'.$classe.'.php';
    }

    spl_autoload_register('chargerClasse');

    session_start();

    // Smarty (pre) ===========================================================

    // instance de Smarty
    $smarty = new Smarty();

    // création des managers ==================================================

    // Instance de connexion à la bdd
    include 'connect.php';

    // aricles
    $artManager = new ArticlesManager( $bdd );
    // jeux
    $jeuxManager = new JeuxManager( $bdd );

    // variables ==============================================================

    // formulaire==============================================================

    if( isset( $_POST['ajouterJeu'] ) )
    {
        $nomJeu = htmlspecialchars( ucwords( strtolower( trim( $_POST['nomJeu'] ) ) ) );
        $articleUnivers = htmlspecialchars( trim( $_POST['articleUnivers'] ) );
        $articleFeeling = htmlspecialchars( trim( $_POST['articleFeeling'] ) );
        $articleInstant = htmlspecialchars( trim( $_POST['articleInstant'] ) );

        if ( !empty( $nomJeu ) )
        {
            $idJeu = $jeuxManager->addJeu( new Jeu(
                array(
                    "dateAjout" => date("Y-m-d H:i:s"),
                    "titre" => $nomJeu,
                    "estSignale" => 0
                )
            ));

            if ( !empty( $articleUnivers) )
            {
                $artManager->addArt( new Article(
                    array(
                        'texte' => $articleUnivers,
                        "dateAjout" => date("Y-m-d H:i:s"),
                        "estSignale" => 0,
                        "idJeu" => $idJeu,
                        'idCategorie' => 1
                    )
                ));
            }

            if ( !empty( $articleFeeling) )
            {
                $artManager->addArt( new Article(
                    array(
                        'texte' => $articleFeeling,
                        "dateAjout" => date("Y-m-d H:i:s"),
                        "estSignale" => 0,
                        "idJeu" => $idJeu,
                        'idCategorie' => 2
                    )
                ));
            }

            if ( !empty( $articleInstant) )
            {
                $artManager->addArt( new Article(
                    array(
                        'texte' => $articleInstant,
                        "dateAjout" => date("Y-m-d H:i:s"),
                        "estSignale" => 0,
                        "idJeu" => $idJeu,
                        'idCategorie' => 3
                    )
                ));
            }
        }
    }

    // Smarty (post) ==========================================================

    $smarty->assign( 
        array( 
            'baliseTitle' => 'aGV - Ajout jeu',
            'nomSite' => 'aGameView',
        ) 
    );

    $smarty->display( 'templates/ajoutJeu.html' );
