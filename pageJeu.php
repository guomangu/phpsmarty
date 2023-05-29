<?php
    include 'includes.php';

    session_start();

    $smarty = new Smarty();

    // récupération du jeu à envoyer vers pageProduit.html =====================

    // le jeu à récuperer
    $jeu = null; 

    // informations attendu par la page template
    $idJeu = null;
    $titreJeu = null;
    $tabArticles = null;
    $tabCommentairesArticles = null;
    $tabImages = null;

    if ( isset( $_GET['id'] ) )
    {
        $id = (int)htmlspecialchars( trim( $_GET['id'] ) );
        //var_dump( $id );

        // si $_GET['tab'] est définit, cela signifie que c'est un jeu en provenance de la page accueil
        // donc il faut le récupérer depuis un des tableau en session correspondant
        if ( isset( $_GET['tab'] ) )
        {
            $tab = (int)htmlspecialchars( trim( $_GET['tab'] ) );
            //var_dump( $tab );

            // les 2 tableaux sont tabJeuxHasard (1) et tabDerniersJeux (2)
            if ( $tab == 1 || $tab == 2 )
            {
                if ( $_GET['id'] >= 0 && $_GET['id'] <= 2)
                {
                    if ( $tab == 1 )
                    {
                        if ( !is_int( $id ) || $id < 0 || $id > count( $_SESSION['tabJeuxHasard'] ) )
                        {
                            // la valeur de $id est invalide
                            trigger_error( "id doit être un entier comprit entre 0 et ".count( $_SESSION['tabJeuxHasard'] ), E_USER_ERROR);
                        }
                        else
                        {
                            $jeu = $_SESSION['tabJeuxHasard'][$id];
                        }
                    }
                    else if ( $tab == 2 )
                    {
                        if ( !is_int( $id ) || $id < 0 || $id > count( $_SESSION['tabDerniersJeux'] ) )
                        {
                            // la valeur de $id est invalide
                            trigger_error( "id doit être un entier comprit entre 0 et ".count( $_SESSION['tabDerniersJeux'] ), E_USER_ERROR);
                        }
                        else
                        {
                            $jeu = $_SESSION['tabDerniersJeux'][$id];
                        }
                    }
    
                    if ( isset( $_SESSION['applyFetchTabAccueil'] ) )
                    {
                        unset( $_SESSION['applyFetchTabAccueil'] );
                    }
                    else
                    {
                        // si on arrive ici, c'est que cette page à deja chargée une premiere
                        // fois depuis la page d'accueil avec les tableaux actuels, donc on recharge
                        // le jeu avec son identifiant pour renouveller son contenu
                        include 'connect.php';
            
                        $jeuxManager = new JeuxManager( $bdd );
    
                        $jeu = $jeuxManager->getJeuById( $jeu->getIdJeu() );
                    }
                }
                else
                {
                    include 'connect.php';
            
                    $jeuxManager = new JeuxManager( $bdd );
                    $jeu = $jeuxManager->getAlea();
                }
            }
            else
            {
                // si on arrive ici c'est que $_GET['tab'] contient une valeur invalide
                // indiquant un probleme à la page accueil

                // on récupere un jeu au hasard via JeuxManager
                include 'connect.php';
        
                $jeuxManager = new JeuxManager( $bdd );
                $jeu = $jeuxManager->getAlea();
            }
        }
        else
        {
            // on récupere le jeu via l'identifiant $_GET['id'] via JeuxManager
            include 'connect.php';
            
            $jeuxManager = new JeuxManager( $bdd );
            
            if ( !$jeuxManager->checkId( $id ) )
            {
                // on récupere un jeu au hasard via JeuxManager
                include 'connect.php';
        
                $jeuxManager = new JeuxManager( $bdd );
                $jeu = $jeuxManager->getAlea();
            }
            else
            {
                $jeu = $jeuxManager->getJeuById( $id );
            }
        }
    }
    else
    {
        // on récupere un jeu au hasard via JeuxManager
        include 'connect.php';
        
        $jeuxManager = new JeuxManager( $bdd );
        $jeu = $jeuxManager->getAlea();
    }

    // une fois le jeu récuperé on transmets les différentes infos dans des
    // variables et des tableaux pour plus de modularité pour la page template
    if ( !empty( $jeu ) )
    {
        $idJeu = $jeu->getIdJeu();
        $titreJeu = $jeu->getTitre();
        $tabArticles = array(
            'Univers' => $jeu->getArtUnivers(),
            'Feeling' => $jeu->getArtFeeling(),
            'Instant' => $jeu->getArtInstant()
        );
        $tabCommentairesArticles = array(
            $jeu->getArtUnivers()->getTabCommentaires(),
            $jeu->getArtFeeling()->getTabCommentaires(),
            $jeu->getArtInstant()->getTabCommentaires()
        );
        $tabImages = $jeu->getTabImages();
    }
            
    // ========================================================================

    // var_dump( $idProduit );
    // var_dump( $titreJeu );
    // var_dump( $tabArticles );
    // var_dump( $tabImages );
    // var_dump( $tabCommentairesArticles );

    $smarty->assign( 
        array( 
            'customStyle' => 'templates/assets/css/accueil.css',
            'baliseTitle' => 'aGV - '.$titreJeu,
            'nomSite' => 'aGameView',
            'nameInputRecherche' => 'titreJeu',
            'placeholderInputRecherche' => 'Titre de jeu',
            'idProduit' => $idJeu,
            'titreProduit' => $titreJeu,
            'tabArticles' => $tabArticles,
            'tabImages' => $tabImages,
            'tabCommentairesArticles' => $tabCommentairesArticles,
            'messageArticleVide' => "Soyez le premier à ajouter un article",
            'tabIntrosAjoutArticle' => array(
                'Comment décririez-vous l\x27univers de ce jeu ?',
                'Que ressentez-vous en jouant à ce jeu ?',
                'Partagez avec nous un instant inoubliable !' 
            ),
            'link' => new Link
        ) 
    );

    $smarty->display( 'templates/pageProduit.html' );
?>