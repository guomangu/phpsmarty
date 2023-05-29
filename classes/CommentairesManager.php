<?php
    date_default_timezone_set('Europe/Paris');

    class CommentairesManager
    {
        private $_bdd;

        public function __construct( PDO $bdd )
        {
            $this->setBdd( $bdd );
        }
        
        // SET ================================================================

        public function setBdd( PDO $bdd )
        {
            $this->_bdd = $bdd;
        }

        // METHODES ===========================================================

        
        public function getById( $id )
        {
            $req = $this->_bdd->prepare( 'SELECT * FROM Commentaires WHERE idCommentaire = :idCommentaire' );
            $req->bindValue( ':idCommentaire', $id, PDO::PARAM_INT );
            $req->execute();

            $donnees = $req->fetch(PDO::FETCH_ASSOC);

            $req->closeCursor();

            return new Commentaire( $donnees );
        }

        public function getList()
        {
            $tabCommentaires = [];

            $reqList = $this->_bdd->query( 'SELECT * FROM Commentaires' );
            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) )
            {
                $tabCommentaires[] = new Commentaire( $tabDonnees );
            }

            return $tabCommentaires;
        }

        public function getListByIdArticle( $id )
        {
            $tabCommentaires = [];

            $reqList = $this->_bdd->prepare( 
                'SELECT * 
                FROM Commentaires 
                WHERE idArticle LIKE :idArticle
                ORDER BY dateAjout DESC' );
            $reqList->bindValue( ':idArticle', $id, PDO::PARAM_INT );
            $reqList->execute();

            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) )
            {
                $tabCommentaires[] = new Commentaire( $tabDonnees );
            }

            $reqList->closeCursor();

            return $tabCommentaires;
        }

        public function getIdList()
        {
            $tabIdCommentaires = [];

            $reqList = $this->_bdd->query( 
                'SELECT idCommentaire 
                FROM Commentaires 
                ORDER BY idCommentaire ASC' );
            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) )
            {
                $tabIdCommentaires[] = (int)$tabDonnees['idCommentaire'];
            }

            return $tabIdCommentaires;
        }

        public function add( Commentaire $commentaire )
        {
            if ( $commentaire->getIdCommentaire() == null )
            {
                $reqAdd = $this->_bdd->prepare( 'INSERT INTO Commentaires(texte, dateAjout, idArticle) VALUES (:texte, :dateAjout, :idArticle)' );

                $reqAdd->bindValue(':texte', $commentaire->getTexte());
                $reqAdd->bindValue(':dateAjout', $commentaire->getDateAjout());
                $reqAdd->bindValue(':idArticle', $commentaire->getIdArticle(), PDO::PARAM_INT);

                $reqAdd->execute();
                $reqAdd->closeCursor();
            }
        }

        public function deleteById( $id )
        {
            $reqDelete = $this->_bdd->prepare( 'DELETE FROM Commentaires WHERE idCommentaire LIKE :idCommentaire' );

            $reqDelete->bindValue( ':idCommentaire', $id, PDO::PARAM_INT );

            $reqDelete->execute();
            $reqDelete->closeCursor();
        }

        public function deleteByIdArticle( $id )
        {
            $reqDelete = $this->_bdd->prepare( 'DELETE FROM Commentaires WHERE idArticle LIKE '.$id );

            $reqDelete->execute();
            $reqDelete->closeCursor();
        }

        public function update( Commentaire $commentaire )
        {
            $reqModif = $this->_bdd->prepare( 'UPDATE Commentaires SET texte = :texte, estSignale = :estSignale, idArticle = :idArticle WHERE idCommentaire LIKE :idCommentaire' );

            $reqModif->bindValue( ':idCommentaire', $commentaire->getIdCommentaire(), PDO::PARAM_INT );
            $reqModif->bindValue( ':texte', $commentaire->getTexte(), PDO::PARAM_STR );
            $reqModif->bindValue( ':estSignale', $commentaire->getEstSignale(), PDO::PARAM_BOOL );
            $reqModif->bindValue( ':idArticle', $commentaire->getIdArticle(), PDO::PARAM_INT );

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

            $reqModif = $this->_bdd->prepare( 'UPDATE Commentaires SET '.$set.' WHERE idCommentaire LIKE :idCommentaire' );

            $reqModif->bindValue( ':idCommentaire', $id, PDO::PARAM_INT );
            
            $reqModif->execute();
            $reqModif->closeCursor();
        }
    }
?>