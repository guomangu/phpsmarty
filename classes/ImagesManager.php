<?php
    date_default_timezone_set('Europe/Paris');

    class ImagesManager{
        private $_bdd;
        private $_compoImgManager;

        public function __construct($bdd){
            $this->setBdd($bdd);
            $this->_compoImgManager = new CompoImageManager( $bdd );
        }

        public function setBdd(PDO $bdd){
            $this->_bdd = $bdd;
        }

        // METHOD =============================================================
        
        public function getImgById($id){
            $sql = $this->_bdd->prepare( "SELECT * FROM Images WHERE idImage=".$id );
            $sql->execute();
            $donnees = $sql->fetch(PDO::FETCH_ASSOC);
            $sql->closeCursor();

            return new Image( $donnees );
        }

        public function getRandImgListLimitByIdJeu( $idJeu, $limit = 3 )
        {
            $tabImages = [];
            // on récupère les identifiants d'images correspondant
            // au jeu via CompoImageManager
            $tabIdImages = $this->_compoImgManager->getRandIdImgListLimitByIdJeu( $idJeu, $limit );

            foreach ( $tabIdImages as $idImage) 
            {
                $tabImages[] = $this->getImgById( $idImage );
            }

            return $tabImages;
        }

        public function getList(){
            $tabImages = [];

            $reqList = $this->_bdd->query( 'SELECT * FROM Images' );
            
            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) ){
                $tabImages[] = new Image( $tabDonnees );
            }
            return $tabImages;
        }

        public function getIdList()
        {
            $tabIdImages = [];

            $reqList = $this->_bdd->query( 'SELECT idImage FROM Images ORDER BY idImage ASC' );
            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) )
            {
                $tabIdImages[] = (int)$tabDonnees['idImage'];
            }

            return $tabIdImages;
        }

        public function addImg(Image $img){

            $sql = $this->_bdd->prepare('INSERT INTO Images(idImage, nomImage ,dateAjout ,estSignale) VALUES(:idImage, :nomImage ,:dateAjout ,:estSignale)');
 
            $sql->bindValue(':idImage', $img->getIdImage(), PDO::PARAM_INT);
            $sql->bindValue(':nomImage', $img->getNomImage(), PDO::PARAM_STR);
            $sql->bindValue(':dateAjout', $img->getDateAjout());
            $sql->bindValue(':estSignale', $img->getEstSignale(), PDO::PARAM_BOOL);
    
            $sql->execute();
            $sql->closeCursor();

            return $this->_bdd->lastInsertId();
        }

        public function deleteById( $id ){
            // on efface les fichiers images du serveur
            $link = new Link;
            $nomImg = $this->getImgById( $id )->getNomImage();
            unlink( $link->getUrlImagejeuOriginale( $nomImg ) );
            unlink( $link->getUrlImagejeuRedim( $nomImg ) );

            // on efface toutes les references de cette image
            $this->_compoImgManager->deleteByIdImage( $id );

            // puis on efface l'image elle-même
            $reqDelete = $this->_bdd->prepare( 'DELETE FROM Images WHERE idImage = '.$id );
            $reqDelete->execute();
            $reqDelete->closeCursor();
        }

        public function deleteByIdJeu( $id ){
            $this->_compoImgManager->deleteByIdImage( $id );

            $reqDelete = $this->_bdd->prepare( 'DELETE FROM Images WHERE idJeu = '.$id );

            $reqDelete->execute();

            $reqDelete->closeCursor();
        }

        public function update( Image $image ){
            $reqModif = $this->_bdd->prepare( 
                'UPDATE Images 
                SET idImage = :idImage, 
                    urlImage = :urlImage, 
                    dateAjout = :dateAjout, 
                    estSignale = :estSignale 
                WHERE idImage LIKE :idImage' );

            $reqModif->bindValue( ':idImage', $image->getIdImage(), PDO::PARAM_INT );
            $reqModif->bindValue( ':urlImage', $image->getUrlImage(), PDO::PARAM_STR );
            $reqModif->bindValue( ':dateAjout', $image->getDateAjout() );
            $reqModif->bindValue( ':estSignale', $image->getEstSignale(), PDO::PARAM_BOOL );

            $reqModif->execute();
            $reqModif->closeCursor();
        }

        public function updateByChamps( $id, array $tabChamps, array $tabValues )
        {   
            $set = "";
            for ( $i = 0; $i != count( $tabChamps ); ++$i )
            {
                $set .= $tabChamps[$i].' = "'.$tabValues[$i].'",';
            }
            $set= substr($set, 0, -1);

            $reqModif = $this->_bdd->prepare( 'UPDATE Images SET '.$set.' WHERE idImage LIKE :idImage' );

            $reqModif->bindValue( ':idImage', $id, PDO::PARAM_INT );
            
            $reqModif->execute();
            $reqModif->closeCursor();
        }
    }
?>