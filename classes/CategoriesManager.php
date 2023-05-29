<?php
    class CategoriesManager{
        private $_bdd;

        public function __construct($bdd){
            $this->setBdd($bdd);
        }

        public function setBdd(PDO $bdd){
            $this->_bdd = $bdd;
        }

        // METHOD =============================================================

        public function getCatById($id){
            $sql = $this->_bdd->prepare("SELECT * FROM Categories WHERE idCategorie=".$id);
            $sql->bindValue( ':idCategorie', $id, PDO::PARAM_INT );

            $sql->execute();
            $donnees = $sql->fetch(PDO::FETCH_ASSOC);
            $sql->closeCursor();

            return new Categorie( $donnees );  
        }

        public function getList(){
            $tabCommentaires = [];

            $reqList = $this->_bdd->query( 'SELECT * FROM Categories' );
            
            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) ){
                $tabCommentaires[] = new Categorie( $tabDonnees );
            }
            return $tabCommentaires;   
        }

        public function getIdList()
        {
            $tabIdCategories = [];

            $reqList = $this->_bdd->query( 'SELECT idCategorie FROM Categories ORDER BY idCategorie ASC' );
            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) )
            {
                $tabIdCategories[] = (int)$tabDonnees['idCategorie'];
            }

            return $tabIdCategories;
        }

        public function addCat(Categorie $cat){

            $sql = $this->_bdd->prepare('INSERT INTO Categories(idCategorie, libelle) VALUES(:idCategorie, :libelle)');
 
            $sql->bindValue(':idCategorie', $cat->getIdCategorie(), PDO::PARAM_INT);
            $sql->bindValue(':libelle', $cat->getLibelle());
    
            $sql->execute();
            $sql->closeCursor();
        }

        public function deleteById( $id ){
            $reqDelete = $this->_bdd->prepare( 'DELETE FROM Categories WHERE idCategorie LIKE :idCategorie' );

            $reqDelete->bindValue( ':idCategorie', $id, PDO::PARAM_INT );

            $reqDelete->execute();
            $reqDelete->closeCursor();
        }

        public function update( Categorie $categorie )
        {
            $reqModif = $this->_bdd->prepare( 'UPDATE Categories SET libelle = :libelle, idCategorie = :idCategorie WHERE idCategorie LIKE :idCategorie' );

            $reqModif->bindValue( ':idCategorie', $categorie->getIdCategorie(), PDO::PARAM_INT );
            $reqModif->bindValue( ':libelle', $categorie->getLibelle(), PDO::PARAM_STR );

            $reqModif->execute();
            $reqModif->closeCursor();
        }
    }
?>