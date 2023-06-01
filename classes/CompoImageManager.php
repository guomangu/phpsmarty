<?php
    date_default_timezone_set('Europe/Paris');

    class CompoImageManager{
        private $_bdd;

        public function __construct($bdd){
            $this->setBdd($bdd);
        }

        public function setBdd(PDO $bdd){
            $this->_bdd = $bdd;
        }

        // METHOD =============================================================

        public function addCompoImgJeu( $idImage, $idJeu )
        {
            $reqAdd = $this->_bdd->prepare( 'INSERT INTO Compoimgjeu(idImage, idJeu) VALUES(:idImage, :idJeu)' );
            
            $reqAdd->bindValue( ':idImage', $idImage, PDO::PARAM_INT );
            $reqAdd->bindValue( ':idJeu', $idJeu, PDO::PARAM_INT );
    
            $reqAdd->execute();
            $reqAdd->closeCursor();
        }

        public function getIdImageByIdJeu($id){
            $sql = $this->_bdd->prepare("SELECT idImage FROM Compoimgjeu WHERE idJeu = :idJeu");
            $sql->bindValue( ':idJeu', $id, PDO::PARAM_INT );

            $sql->execute();
            $donnees = $sql->fetch(PDO::FETCH_ASSOC);
            $sql->closeCursor();

            return( $donnees );
        }

        public function getImageByIdImg($id){
            $sql = $this->_bdd->prepare("SELECT * FROM Images WHERE idImage = :idImage");
            $sql->bindValue( ':idImage', $id, PDO::PARAM_INT );

            $sql->execute();
            $donnees = $sql->fetch(PDO::FETCH_ASSOC);
            $sql->closeCursor();

            return new Image( $donnees );
        }

        public function getRandIdImgListLimitByIdJeu( $idJeu, $limit = 3 )
        {
            // on récupère les identifiants d'images correspondant
            // au jeu
            $tabIdImages = [];

            $reqList = $this->_bdd->prepare( 
                "SELECT idImage
                FROM Compoimgjeu
                WHERE idJeu LIKE :idJeu
                ORDER BY RAND() LIMIT :limit" 
            );
            $reqList->bindValue( ':idJeu', $idJeu, PDO::PARAM_INT );
            $reqList->bindValue( ':limit', $limit, PDO::PARAM_INT );
            $reqList->execute();

            while ( $donnees = $reqList->fetch( PDO::FETCH_ASSOC ) )
            {
                $tabIdImages[] = (int)$donnees['idImage'];
            }
            
            $reqList->closeCursor();

            return $tabIdImages;
        }

        public function deleteByIdImage( $id ){
            $reqDelete = $this->_bdd->prepare( 'DELETE FROM Compoimgjeu WHERE idImage LIKE :idImage' );
    
            $reqDelete->bindValue( ':idImage', $id, PDO::PARAM_INT );
    
            $reqDelete->execute();
            $reqDelete->closeCursor();
        }

        public function deleteByIdJeu( $id ){
            $reqDelete = $this->_bdd->prepare( 'DELETE FROM Compoimgjeu WHERE idJeu LIKE :idJeu' );
    
            $reqDelete->bindValue( ':idJeu', $id, PDO::PARAM_INT );
    
            $reqDelete->execute();
            $reqDelete->closeCursor();
        }

        public function deleteByIdImageAndIdJeu( $idImage, $idJeu ){
            $reqDelete = $this->_bdd->prepare( 'DELETE FROM Compoimgjeu WHERE idImage LIKE :idImage AND idJeu LIKE :idJeu' );
    
            $reqDelete->bindValue( ':idImage', $idImage, PDO::PARAM_INT );
            $reqDelete->bindValue( ':idJeu', $idJeu, PDO::PARAM_INT );
    
            $reqDelete->execute();
            $reqDelete->closeCursor();
        }
    }
?>