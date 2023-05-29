<?php
    // var_dump( $_POST );
    // var_dump( $_FILES );

    if ( !empty( $_POST['titreProduit'] ) && !empty( $_FILES['imageJeu'] ) ) 
    {
        $titreJeu = htmlspecialchars( trim( $_POST['titreProduit'] ) );
        // var_dump( $titreJeu );
        
        if ( $_FILES['imageJeu']['error'] == 0 && !empty( $titreJeu ) )
        {
            function chargerClass($classe)
            {
                require 'classes/'.$classe.'.php';
            }

            spl_autoload_register('chargerClass');

            // ================================================================

            // instance de la base de données
            include 'connect.php';

            $jeuxManager = new JeuxManager( $bdd );
            $imgManager = new ImagesManager( $bdd );
            $compoImgJeu = new CompoImageManager( $bdd );

            $imgResizer = new ImageResizer();

            // ================================================================

            $extensionsValides = array( 'jpg', 'jpeg', 'png' );
            $extensionUpload = strtolower( substr( strrchr( $_FILES['imageJeu']['name'], '.' ), 1 ) );
            $extImage = $imgResizer->extensionImage( $extensionUpload, $extensionsValides );

            // var_dump($extensionsValides);
            // var_dump($extensionUpload);
            // var_dump($extImage);

            if ( $extImage !== false )
            {
                $imageSource = $imgResizer->moveImage( $extensionUpload, $_FILES['imageJeu']['tmp_name'], 'originales' );
                $imageSource['emplacementRedim'] = $imgResizer->resizeImageY( 
                    $imageSource['emplacementOriginale'],
                    350,
                    $imageSource['idUnique'],
                    'redim' 
                );

                // var_dump( $imageSource );
            }

            // ================================================================

            $idImage = $imgManager->addImg( 
                new Image( 
                    array(
                        'nomImage' => $imageSource['nomCompletOriginale'],
                        'dateAjout' => date("Y-m-d H:i:s"),
                        'estSignale' => false
                    )
                )
            );

            // var_dump( $idImage );

            $compoImgJeu->addCompoImgJeu( 
                $idImage,
                $jeuxManager->getIdJeuByTitre( $titreJeu )
            );
        }
    }
?>