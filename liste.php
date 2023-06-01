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

    // pagination =============================================================

    $produitsParPage = 6;
    $nombrePages = ceil( $jeuxManager->getTotalCount()/$produitsParPage );

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

    $tabJeuxDate = $jeuxManager->getListByDateAjoutLimit( $premiereEntree, $produitsParPage );
    // var_dump( $tabJeuxDate );

    // ========================================================================

    $smarty->assign( 
        array( 
            'baliseTitle' => 'aGV - Liste complète',
            'nomSite' => 'aGameView',
            'nameInputRecherche' => 'titreJeu',
            'placeholderInputRecherche' => 'Titre de jeu',
            'messagePresentation' => 'Liste Complète par date d\'ajout',
            'tabProduitsDate' => $tabJeuxDate,
            'pageActuelle' => $pageActuelle,
            'produitsParPage' => $produitsParPage,
            'nombrePages' => $nombrePages,
            'link' => new Link 
        ) 
    );

    $smarty->display( 'templates/liste.tpl' );
?>