<?php
    class Link 
    {
        public function getPageJeuAcceuilLink( $id, $tab )
        {
            return './pageJeu.php?id='.$id.'&tab='.$tab;
        }

        public function getPageJeuByIdLink( $id )
        {
            return './pageJeu.php?id='.$id;
        }

        public function getUrlImagejeuRedim( $nomImage )
        {
            $nomSansExtension = substr( $nomImage, 0, strrpos( $nomImage, "." ) );
            return 'templates/assets/img/redim/H350-'.$nomSansExtension.'.jpg';
        }

        public function getUrlImagejeuOriginale( $nomImage )
        {
            return 'templates/assets/img/originales/'.$nomImage;
        }
    }
?>