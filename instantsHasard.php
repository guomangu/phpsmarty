<?php
    include 'includes.php';

    // Smarty (pre) ===========================================================

    // instance de Smarty
    $smarty = new Smarty();

    // création des managers ==================================================

    // Instance de connexion à la bdd
    include 'connect.php';

    // articles
    $artManager = new ArticlesManager( $bdd );

    // variables ==============================================================

    $tabArticles = $artManager->getRandArtByCatLimit( Article::CATEGORIE_3, 6 );

    // Smarty (post) ==========================================================

    $smarty->assign( 
        array( 
            'baliseTitle' => 'aGV - Instants',
            'nomSite' => 'aGameView',
            'nameInputRecherche' => 'titreJeu',
            'placeholderInputRecherche' => 'Titre de jeu',
            'messagePresentation' => 'Devinerez-vous de quel jeu il s\'agit ?',
            'tabArticles' => $tabArticles,
            'link' => new Link
        ) 
    );

    $smarty->display( 'templates/articlesHasard.html' );
?>