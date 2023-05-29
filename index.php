<?php
    include 'includes.php';

    session_start();

    // Smarty (pre) ===========================================================

    // instance de Smarty
    $smarty = new Smarty();

    // création des managers ==================================================

    // Instance de connexion à la bdd
    include 'connect.php';

    // commentaires
    $commentManager = new CommentairesManager( $bdd );
    // catégories
    $catManager = new CategoriesManager( $bdd );
    // images
    $imgManager = new ImagesManager( $bdd );
    // articles
    $artManager = new ArticlesManager( $bdd );
    // compoImageJeu
    $compoImgJeuManager = new CompoImageManager( $bdd );
    // jeux
    $jeuxManager = new JeuxManager( $bdd );

    // variables ==============================================================

    // récupération de 3 jeux au hasard
    $tab3JeuxHasard = $jeuxManager->get3Alea();
    $_SESSION['tabJeuxHasard'] = $tab3JeuxHasard;

    // récupération des 3 derniers jeux à avoir reçu un nouvel article
    $tab3DerniersJeux = $jeuxManager->get3ByDateAjoutArticle();
    $_SESSION['tabDerniersJeux'] = $tab3DerniersJeux;

    // appeller le fait de récuperer le jeu parmis les 2 tableaux déclarés ci-dessus
    $_SESSION['applyFetchTabAccueil'] = true; 

    // barre de recherche =====================================================

    if ( isset( $_GET['titreJeu'] ) )
    {
        $titreJeu = htmlspecialchars( trim( $_GET['titreJeu'] ) );

        if ( !empty( $titreJeu ) )
        {
            $idJeu = $jeuxManager->getIdJeuByTitre( $titreJeu );
            if ( $idJeu )
            {
                // redirection vers pageJeu.php avec id en GET
		        header( 'location: ./pageJeu.php?id='.$idJeu ); 
            }
            else
            {
                // proposer à l'utilisateur de d'entrer un nouveau jeu dans la Bdd
                header( 'location: ./ajoutJeu.php?entree='.$titreJeu ); 
            }
        }
    }

    // Smarty (post) ==========================================================

    $smarty->assign( 
        array( 
            'baliseTitle' => 'aGV - Accueil',
            'nomSite' => 'aGameView',
            'nameInputRecherche' => 'titreJeu',
            'placeholderInputRecherche' => 'Titre de jeu',
            'tab3ProduitsHasard' => $tab3JeuxHasard,
            'tab3DerniersProduits' => $tab3DerniersJeux,
            'link' => new Link
        ) 
    );

    $smarty->display( 'templates/accueil.html' );

    // TESTS ==================================================================

    // CommentairesManager ====================================================

    // var_dump( $commentManager->getList() );
    // var_dump( $commentManager->getList() );
    // var_dump( $commentManager->getById( 5 ) );
    // $commentManager->add( new Commentaire(
    //     array(
    //         "texte" => "Perso j'aurais voulu que ça ne s'arrête jamais...",
    //         "dateAjout" => date("Y-m-d H:i:s"),
    //         "idArticle" => 4
    //     )
    // ) );
    // $commentManager->deleteById( 4 );
    // $comment = $commentManager->getById( 5 );
    // $comment->setTexte( 'Un instant inoubliable...' );
    // $comment->setEstSignale( true );
    // var_dump( $comment );
    // $commentManager->update( $comment );
    // var_dump( $commentManager->getIdList() );
    
    // categorie manager ======================================================

    // var_dump($CatManager->getCatById(1));

    // var_dump($CatManager->getList());

    // $CatManager->addCat( new Categorie(
    //     array(
    //         "libelle" => "MangerCat"
    //     )
    // ) );

    // $CatManager->deleteById(5);

    // $categorie = $CatManager->getCatById(5);
    // $categorie->setLibelle('bonjour');
    // var_dump($categorie);
    // $CatManager->update($categorie);

    // image manager ==========================================================

    // var_dump($ImgManager->getImgById(1));

    // var_dump($ImgManager->getList());

    // $ImgManager->addImg(new Image(
    //     array(
    //         "idImage" => 10,
    //         "urlImage" => "unosdostres",
    //         "dateAjout" => date("Y-m-d H:i:s"),
    //         "estSignale" => true
    //     )
    // ));

    // $ImgManager->deleteById(10);

    // $image = $ImgManager->getImgById(10);
    // $image->setEstSignale(true);
    // $ImgManager->update($image);

    // echo '<img src='.$ImgManager->getImgById( 1 )->getUrlImage().' />';

    // article manager ========================================================

    // var_dump($artManager->getArtById(1));

    //var_dump( $artManager->getTotalCount() );

    // var_dump( $artManager->getArtByIdJeuAndByCategorie( 12, 2 ) );

    // var_dump($artManager->getList());

    // $artManager->addArt(new Article(
    //     array(
    //         "texte" => "unosdostres",
    //         "dateAjout" => date("Y-m-d H:i:s"),
    //         "idJeu" => 3,
    //         "idCategorie" => 1
    //     )
    // ));

    //$artManager->deleteById(6);

    // $article = $artManager->getArtById(26);
    // $article->setEstSignale(true);
    // $artManager->update($article);

    // $art = $artManager->getArtById( 5 );
    // $art->setTexte( "Ceci est un autre test" );
    // $art->setIdJeu( 3 );
    // $artManager->update( $art );

    // $artManager->updateByChamps( 5, array( 'texte', 'idJeu'), array( 'Ceci est un test', 12 ) );

    // var_dump($artManager->getArtByCat(Article::CATEGORIE_1));

    // var_dump( $artManager->getArtByIdJeuAndByCategorie( 1, 1 ) );
    // var_dump( $artManager->getRandArtByCatLimit( Article::CATEGORIE_1, 6 ) );

    // compoimagejeu manager ==================================================

    // var_dump($CompoImageJeuManager->getImageByIdImg(1));

    // var_dump($CompoImageJeuManager->getIdImageByIdJeu(3));

    // jeux manager ===========================================================
    
    //var_dump( $jeuxManager->get3ByDateAjoutArticle() );

    // var_dump( $jeuxManager->getJeuById( 1 ) );
    // var_dump( $jeuxManager->getJeuById( 1 )->getArtUnivers() );
    // var_dump( $jeuxManager->getList() );

    // var_dump($jeuxManager->getList());

    // $jeuxManager->addJeu(new Jeu(
    //     array(
    //         "idJeu" => 11,
    //         "dateAjout" => date("Y-m-d H:i:s"),
    //         "titre" => "bonjours ceci est est un bo test",
    //         "estSignale" => 1
    //     )
    // ));

    // $jeuxManager->deleteById(11);

    // $jeu = $jeuxManager->getJeuById(11);
    // $jeu->setEstSignale(false);
    // $jeuxManager->update($jeu);

    // var_dump($jeuxManager->getAlea();
    // var_dump($jeuxManager->getListAlea());
    // var_dump($jeuxManager->getListByDateAjout());
    // var_dump($jeuxManager->get3ByDateAjout());
    // var_dump($jeuxManager->getListByAlphabet());

    //var_dump( $jeuxManager->checkId( 18 ) );

    // $jeuxManager->getValidAlphaNumList();
    // var_dump( $jeuxManager->getAlphaList() );
    // var_dump( $jeuxManager->getNumList() );
    // var_dump( $jeuxManager->getNonAlphaNumList() );
    // var_dump( $jeuxManager->getListByFirstChar( 'l' ) );

    // var_dump( $jeuxManager->getTotalCountAlpha() );
    // var_dump( $jeuxManager->getTotalCountNum() );
    // var_dump( $jeuxManager->getTotalCountNonAlphaNum() );
    // var_dump( $jeuxManager->getTotalCountByString( 'a' ) );

    // var_dump( $jeuxManager->getJeuById( 1 )->getRandArticle() );
?>
