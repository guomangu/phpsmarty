<?php
    include 'includes.php';

    session_start();

    // création des managers ==================================================

    // Instance de connexion à la bdd
    include 'connect.php';

    // jeux
    $jeuxManager = new JeuxManager( $bdd );
    // articles
    $artManager = new ArticlesManager( $bdd );
    // commentaires
    $commentManager = new CommentairesManager( $bdd );
    // images
    $imgManager = new ImagesManager( $bdd );
    // compoImageJeu
    $compoImgJeuManager = new CompoImageManager( $bdd );
    // catégories
    $catManager = new CategoriesManager( $bdd );

    // var_dump( $jeuxManager->getIdList() );
    // var_dump( $artManager->getIdList() );
    // var_dump( $commentManager->getIdList() );
    // var_dump( $imgManager->getIdList() );
    
    // jeux ===================================================================
    
    // modifier
    if ( isset( $_POST['modifierJeu'] ) )
    {
        $idJeu = (int)htmlspecialchars( trim( $_POST['idJeu'] ) );
        $dateAjoutJeu = htmlspecialchars( trim( $_POST['dateAjoutJeu'] ) );
        $signaleJeu = htmlspecialchars( trim( $_POST['signaleJeu'] ) );
        $titreJeu = htmlspecialchars( trim( $_POST['titreJeu'] ) );

        // var_dump( $idJeu );
        // var_dump( $dateAjoutJeu );
        // var_dump( $signaleJeu );
        // var_dump( $titreJeu );

        if ( !empty( $idJeu ) )
        {
            $tabChamps = [];
            $tabValeurs = [];

            if ( !empty( $dateAjoutJeu ) )
            {
                $tabChamps[] = 'dateAjout';
                $tabValeurs[] = $dateAjoutJeu;
            }

            if ( !empty( $signaleJeu ) )
            {
                $tabChamps[] = 'estSignale';
                $tabValeurs[] = $signaleJeu;
            }

            if ( !empty( $titreJeu ) )
            {
                $tabChamps[] = 'titre';
                $tabValeurs[] = $titreJeu;
            }

            if ( count( $tabChamps ) > 0 && count( $tabValeurs ) > 0 && count( $tabChamps ) == count( $tabValeurs ) )
            {
                $jeuxManager->updateByChamps( $idJeu, $tabChamps, $tabValeurs );
            }
        }
    }

    // supprimer
    if ( isset( $_POST['supprimerJeux'] ) )
    {
        $idJeu = (int)htmlspecialchars( trim( $_POST['idSupprJeux'] ) );

        if ( !empty( $idJeu ) )
        {
            $jeuxManager->deletebyId( $idJeu );
        } 
    }

    // articles ===================================================================
    
    // modifier
    if ( isset( $_POST['modifierArticle'] ) )
    {
        $idArticle = (int)htmlspecialchars( trim( $_POST['idArticle'] ) );
        $dateAjoutArticle = htmlspecialchars( trim( $_POST['dateAjoutArticle'] ) );
        $signaleArticle = htmlspecialchars( trim( $_POST['signaleArticle'] ) );
        $idArticleJeux = (int)htmlspecialchars( trim( $_POST['idArticleJeux'] ) );
        $idArticleCategories = (int)htmlspecialchars( trim( $_POST['idArticleCategories'] ) );
        $texteArticle = htmlspecialchars( trim( $_POST['texteArticle'] ) );

        if ( !empty( $idArticle ) )
        {
            $tabChamps = [];
            $tabValeurs = [];

            if ( !empty( $dateAjoutArticle ) )
            {
                $tabChamps[] = 'dateAjout';
                $tabValeurs[] = $dateAjoutArticle;
            }

            if ( !empty( $signaleArticle ) )
            {
                $tabChamps[] = 'estSignale';
                $tabValeurs[] = $signaleArticle;
            }

            if ( !empty( $idArticleJeux ) )
            {
                $tabChamps[] = 'idJeu';
                $tabValeurs[] = $idArticleJeux;
            }

            if ( !empty( $idArticleCategories ) )
            {
                $tabChamps[] = 'idCategorie';
                $tabValeurs[] = $idArticleCategories;
            }

            if ( !empty( $texteArticle ) )
            {
                $tabChamps[] = 'texte';
                $tabValeurs[] = $texteArticle;
            }

            if ( count( $tabChamps ) > 0 && count( $tabValeurs ) > 0 && count( $tabChamps ) == count( $tabValeurs ) )
            {
                $artManager->updateByChamps( $idArticle, $tabChamps, $tabValeurs );
            }
        }
    }

    // supprimer
    if ( isset( $_POST['supprimerArticles'] ) )
    {
        $idArticle = (int)htmlspecialchars( trim( $_POST['idSupprArticles'] ) );

        if ( !empty( $idArticle ) )
        {
            $artManager->deleteById( $idArticle );
        }
    }

    // commentaires ===================================================================
    
    // modifier
    if ( isset( $_POST['modifierCommentaire'] ) )
    {
        $idCommentaire = (int)htmlspecialchars( trim( $_POST['idCommentaire'] ) );
        $dateAjoutCommentaire = htmlspecialchars( trim( $_POST['dateAjoutCommentaire'] ) );
        $signaleCommentaire = htmlspecialchars( trim( $_POST['signaleCommentaire'] ) );
        $idArticleCommentaire = (int)htmlspecialchars( trim( $_POST['idArticleCommentaire'] ) );
        $texteCommentaire = htmlspecialchars( trim( $_POST['texteCommentaire'] ) );

        if ( !empty( $idCommentaire ) )
        {
            $tabChamps = [];
            $tabValeurs = [];

            if ( !empty( $dateAjoutCommentaire ) )
            {
                $tabChamps[] = 'dateAjout';
                $tabValeurs[] = $dateAjoutCommentaire;
            }

            if ( !empty( $signaleCommentaire ) )
            {
                $tabChamps[] = 'estSignale';
                $tabValeurs[] = $signaleCommentaire;
            }

            if ( !empty( $idArticleCommentaire ) )
            {
                $tabChamps[] = 'idArticle';
                $tabValeurs[] = $idArticleCommentaire;
            }

            if ( !empty( $texteCommentaire ) )
            {
                $tabChamps[] = 'texte';
                $tabValeurs[] = $texteCommentaire;
            }

            if ( count( $tabChamps ) > 0 && count( $tabValeurs ) > 0 && count( $tabChamps ) == count( $tabValeurs ) )
            {
                // var_dump( 'test modifier commentaire' );
                // var_dump( $tabChamps );
                // var_dump( $tabValeurs );
                $commentManager->updateByChamps( $idCommentaire, $tabChamps, $tabValeurs );
            }
        }
    }

    // supprimer
    if ( isset( $_POST['supprimerCommentaires'] ) )
    {
        $idCommentaire = (int)htmlspecialchars( trim( $_POST['idSupprCommentaires'] ) );

        if ( !empty( $idCommentaire ) )
        {
            $commentManager->deleteById( $idCommentaire );
        }
    }

    // images ===================================================================
    
    // modifier
    if ( isset( $_POST['modifierImage'] ) )
    {
        $idImage = (int)htmlspecialchars( trim( $_POST['idImage'] ) );
        $dateAjoutImage = htmlspecialchars( trim( $_POST['dateAjoutImage'] ) );
        $signaleImage = htmlspecialchars( trim( $_POST['signaleImage'] ) );
        $urlImage = htmlspecialchars( trim( $_POST['urlImage'] ) );


        if ( !empty( $idImage ) )
        {
            $tabChamps = [];
            $tabValeurs = [];

            if ( !empty( $dateAjoutImage ) )
            {
                $tabChamps[] = 'dateAjout';
                $tabValeurs[] = $dateAjoutImage;
            }

            if ( !empty( $signaleImage ) )
            {
                $tabChamps[] = 'estSignale';
                $tabValeurs[] = $signaleImage;
            }

            if ( !empty( $urlImage ) )
            {
                $tabChamps[] = 'urlImage';
                $tabValeurs[] = $urlImage;
            }

            if ( count( $tabChamps ) > 0 && count( $tabValeurs ) > 0 && count( $tabChamps ) == count( $tabValeurs ) )
            {
                // var_dump( 'test modifier jeu' );
                // var_dump( $tabChamps );
                // var_dump( $tabValeurs );
                $imgManager->updateByChamps( $idImage, $tabChamps, $tabValeurs );
            }
        }
    }

    // supprimer
    if ( isset( $_POST['supprimerImages'] ) )
    {
        $idImage = (int)htmlspecialchars( trim( $_POST['idSupprImages'] ) );

        if ( !empty( $idImage ) )
        {
            $imgManager->deleteById( $idImage );
        }
    }

    // Smarty (pre) ===========================================================

    // instance de Smarty
    $smarty = new Smarty();

    $smarty->assign( 
        array( 
            'customStyle' => 'templates/assets/css/accueil.css',
            'baliseTitle' => 'aGV - Administration',
            'nomSite' => 'aGameView',
            'nomTableJeux' =>  "Jeux",
            'nomTableArticles' => "Articles",
            'nomTableCommentaires' => "Commentaires",
            'nomTableImages' => "Images",
            'urlModifierJeux' => "templates/formulaireAdminModifierJeux.tpl",
            'urlModifierArticles' => "templates/formulaireAdminModifierArticles.tpl",
            'urlModifierCommentaires' => 'templates/formulaireAdminModifierCommentaires.tpl',
            'urlModifierImages' => "templates/formulaireAdminModifierImages.tpl",
            'urlSupprimerCommentaires' => 'templates/formulaireAdminSupprimer.tpl',
            'tabTabId' => array( 
                'Jeux' => $jeuxManager->getIdList(),
                'Articles' => $artManager->getIdList(),
                'Commentaires' => $commentManager->getIdList(),
                'Images' => $imgManager->getIdList(),
                'CatArticles' => $catManager->getIdList()
            ),
        ) 
    );

    $smarty->display( 'templates/admin.tpl' );
?>