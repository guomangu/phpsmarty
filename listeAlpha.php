<?php
    include 'includes.php';

    // Smarty (pre) ===========================================================

    // instance de Smarty
    $smarty = new Smarty();

    // création des managers ==================================================

    // Instance de connexion à la bdd
    include 'connect.php';

    // jeux
    $jeuxManager = new JeuxManager( $bdd );

    // catégorie alphabetique =================================================

    $catAlpha = "";
    
    if ( !empty( $_GET['catAlpha'] ) )
    {
        $catAlpha = htmlspecialchars( trim( $_GET['catAlpha'] ) );

        if ( $catAlpha != 'num' &&
             $catAlpha != 'nonAlphaNum' &&
             !( strlen( $catAlpha ) == 1 && preg_match( '/^[a-zA-Z]/', $catAlpha ) ) )
        {
            $catAlpha = 'A';
        }
    }
    else
    {
        $catAlpha = 'A';
    }

    // var_dump($catAlpha);

    // pagination =============================================================

    $produitsParPage = 6;
    $nombrePages = ceil( $jeuxManager->getTotalCount()/$produitsParPage );

    // determiner le nombre de pages maximum selon la catégorie
    if ( $catAlpha == 'num' )
    {
        $nombrePages = ceil( $jeuxManager->getTotalCountNum()/$produitsParPage );
    }
    else if ( $catAlpha == 'nonAlphaNum' )
    {
        $nombrePages = ceil( $jeuxManager->getTotalCountNonAlphaNum()/$produitsParPage );
    }
    else
    {
        $nombrePages = ceil( $jeuxManager->getTotalCountByString( $catAlpha )/$produitsParPage );
    }

    // determiner la page actuelle et calcul de la 1ere entrée de la bdd
    if ( isset( $_GET['page'] ) )
    {
        $pageActuelle = intval( $_GET['page'] );
        
        if ( $pageActuelle <= 0 )
        {
            $pageActuelle = 1;
        }
        else if ( $pageActuelle > $nombrePages )
        {
            $pageActuelle = $nombrePages;
        }
    }
    else
    {
        $pageActuelle = 1;
    }

    $premiereEntree = ($pageActuelle-1) * $produitsParPage;

    // recupération de la selection determinée par la premiere entrée et le nombre de
    // jeux à afficher, le tout par catégorie
    if ( $catAlpha == 'num' )
    {
        $tabJeuxDate = $jeuxManager->getNumListLimit( $premiereEntree, $produitsParPage );
    }
    else if ( $catAlpha == 'nonAlphaNum' )
    {
        $tabJeuxDate = $jeuxManager->getNonAlphaNumListLimit( $premiereEntree, $produitsParPage );
    }
    else
    {
        $tabJeuxDate = $jeuxManager->getListByStringLimit( $catAlpha, $premiereEntree, $produitsParPage );
    }

    // var_dump( $tabJeuxDate );

    // ========================================================================

    $tabValidAlphaNumList = $jeuxManager->getValidAlphaNumList();
    // var_dump( $tabValidAlphaNumList );

    // ========================================================================

    $smarty->assign( 
        array( 
            'baliseTitle' => 'aGV - Liste alphabétique',
            'nomSite' => 'aGameView',
            'nameInputRecherche' => 'titreJeu',
            'placeholderInputRecherche' => 'Titre de jeu',
            'tabValidAlphaNumList' => $tabValidAlphaNumList,
            'catAlpha' => $catAlpha,
            'messagePresentation' => 'Classement alphabétique',
            'tabProduitsDate' => $tabJeuxDate,
            'pageActuelle' => $pageActuelle,
            'produitsParPage' => $produitsParPage,
            'nombrePages' => $nombrePages,
            'link' => new Link 
        ) 
    );

    $smarty->display( 'templates/listeAlpha.tpl' );
?>