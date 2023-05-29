<?php
    class ImageResizer
    {
        public function extensionImage( $extensionUpload, $extensionsValides )
        {
            if ( !in_array( $extensionUpload, $extensionsValides ) )
            {
                return false;
            }

            return true;
        }

        public function moveImage( $extension, $emplacementTemporaire, $categorie )
        {
            $idUniq = uniqid( rand(), true );
            $nomComplet = $idUniq.".".$extension;
            $emplacement = "templates/assets/img/".$categorie."/".$nomComplet;

            $resultat = move_uploaded_file( $emplacementTemporaire, $emplacement);   
            if ( $resultat )
            {
                return array( 
                    'idUnique' => $idUniq,
                    'nomCompletOriginale' => $nomComplet,
                    'emplacementOriginale' => $emplacement
                );
            }
        }

        public function resizeImageX( $imageSource, $largeur, $idUnique, $categorie )
        {
            $largeur = (int)$largeur;

            $source = imagecreatefromjpeg( $imageSource );

            $reduction = ( ( $largeur * 100 ) / imagesx( $source ) );
            $hauteur = ( ( imagesy( $source ) * $reduction ) / 100 );

            $imageDestination = imagecreatetruecolor( $largeur, $hauteur );

            imagecopyresampled( 
                $imageDestination,
                $source,
                0,
                0,
                0,
                0,
                imagesx( $imageDestination ),
                imagesy( $imageDestination ),
                imagesx( $source ),
                imagesy( $source ) );

            $idUnique = str_replace( " ", "-", $idUnique );
            $urlImgRedim = "templates/assets/img/".$categorie."/W".$largeur."-".$idUnique.".jpg";

            $nouvelleImage = imagejpeg( 
                $imageDestination,
                $urlImgRedim
            );

            return $urlImgRedim;
        }

        public function resizeImageY( $imageSource, $hauteur, $idUnique, $categorie )
        {
            $hauteur = (int)$hauteur;

            $source = imagecreatefromjpeg( $imageSource );

            $reduction = ( ( $hauteur * 100 ) / imagesy( $source ) );
            $largeur = ( ( imagesx( $source ) * $reduction ) / 100 );

            $imageDestination = imagecreatetruecolor( $largeur, $hauteur );

            imagecopyresampled( 
                $imageDestination,
                $source,
                0,
                0,
                0,
                0,
                imagesx( $imageDestination ),
                imagesy( $imageDestination ),
                imagesx( $source ),
                imagesy( $source ) );

            $idUnique = str_replace( " ", "-", $idUnique );
            $urlImgRedim = "templates/assets/img/".$categorie."/H".$hauteur."-".$idUnique.".jpg";

            $nouvelleImage = imagejpeg( 
                $imageDestination,
                $urlImgRedim
            );

            return $urlImgRedim;
        }
    }
?>