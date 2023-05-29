<?php
    class AdministrateursManager{
        private $_bdd;

        public function __construct($bdd){
            $this->setBdd($bdd);
        }

        public function setBdd(PDO $bdd){
            $this->_bdd = $bdd;
        }

        // METHOD =============================================================

        public function getList(){
            $tabAdmins = [];

            $reqList = $this->_bdd->query( 'SELECT * FROM Administrateurs' );
            
            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) ){
                $tabAdmins[] = new Administrateur( $tabDonnees );
            }
            return $tabAdmins;
        }

        public function delJeuById($id){
            $reqDelete = $this->_bdd->prepare( 'DELETE FROM Jeux WHERE idJeu LIKE :idJeu' );

            $reqDelete->bindValue( ':idJeu', $id, PDO::PARAM_INT );

            $reqDelete->execute();
            $reqDelete->closeCursor();
        }
        
        public function delArtById($id){
            $reqDelete = $this->_bdd->prepare( 'DELETE FROM Articles WHERE idArticle LIKE :idArticle' );

            $reqDelete->bindValue( ':idArticle', $id, PDO::PARAM_INT );

            $reqDelete->execute();
            $reqDelete->closeCursor();
        }

        public function delComById($id){
            $reqDelete = $this->_bdd->prepare( 'DELETE FROM Commentaires WHERE idCommentaire LIKE :idCommentaire' );

            $reqDelete->bindValue( ':idCommentaire', $id, PDO::PARAM_INT );

            $reqDelete->execute();
            $reqDelete->closeCursor();
        }

        public function delImgById($id){
            $reqDelete = $this->_bdd->prepare( 'DELETE FROM Images WHERE idImage LIKE :idImage' );

            $reqDelete->bindValue( ':idImage', $id, PDO::PARAM_INT );

            $reqDelete->execute();
            $reqDelete->closeCursor();
        }

        public function afficherNomComplet($id){
            $sql = $this->_bdd->prepare('SELECT prenom, nom FROM Administrateurs WHERE id LIKE "'.$id.'"');
            $sql->execute();
            $donnees = $sql->fetch(PDO::FETCH_ASSOC);
            $sql->closeCursor();

            return $donnees['prenom'].' '.$donnees['nom'];
        }

        public function valider($id,$type){
            if ($type=="jeu"){
                $reqModif = $this->_bdd->prepare( 'UPDATE Jeux SET estSignale = 0 WHERE idJeu LIKE '.$id );
                $reqModif->execute();
                $reqModif->closeCursor();
            }elseif ($type=="article"){
                $reqModif = $this->_bdd->prepare( 'UPDATE Articles SET estSignale = 0 WHERE idArticle LIKE '.$id );
                $reqModif->execute();
                $reqModif->closeCursor();
            }elseif ($type=="commentaire"){
                $reqModif = $this->_bdd->prepare( 'UPDATE Commentaires SET estSignale = 0 WHERE idCommentaire LIKE '.$id );
                $reqModif->execute();
                $reqModif->closeCursor();
            }elseif ($type=="image"){
                $reqModif = $this->_bdd->prepare( 'UPDATE Images SET estSignale = 0 WHERE idImage LIKE '.$id );
                $reqModif->execute();
                $reqModif->closeCursor();
            }else{
                echo "des erreurs ont ete commise";
            }
        }

        public function afficherSignale($table){
            $tabSignale = [];

            $reqList = $this->_bdd->query( 'SELECT * FROM '.$table.' where estSignale = 1' );
            
            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) ){
                $tabSignale[] = new Jeu( $tabDonnees );
            }
            return $tabSignale;
        }
    }
?>