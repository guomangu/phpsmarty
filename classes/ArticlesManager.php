<?php
    date_default_timezone_set('Europe/Paris');

    class ArticlesManager{
        private $_bdd;
        private $_commentManager;

        public function __construct($bdd){
            $this->setBdd($bdd);
            $this->_commentManager = new CommentairesManager( $bdd );
        }

        public function setBdd(PDO $bdd){
            $this->_bdd = $bdd;
        }

        // METHOD =============================================================

        public function getTotalCount()
        {
            $sql = $this->_bdd->prepare( "SELECT count(*) AS 'total' FROM Articles" );
            $sql->execute();
            $donnees = $sql->fetch(PDO::FETCH_ASSOC);
            $sql->closeCursor();
            
            return (int)$donnees['total'];
        }

        public function getArtById($id){
            $sql = $this->_bdd->prepare("SELECT * FROM Articles WHERE idArticle=".$id);
            $sql->execute();
            $donnees = $sql->fetch(PDO::FETCH_ASSOC);
            $sql->closeCursor();

            return $this->creerArticle( $donnees );
        }

        public function getArtByIdJeuAndByCategorie( $id, $catArticle )
        {
            $sql = $this->_bdd->prepare(
                "SELECT * 
                FROM Articles 
                WHERE idJeu=".$id." AND idCategorie = ".$catArticle."
                ORDER BY RAND()
                LIMIT 1" 
            );

            $sql->execute();
            $donnees = $sql->fetch(PDO::FETCH_ASSOC);
            $sql->closeCursor();

            if ( $donnees )
            {
                return $this->creerArticle( $donnees );
            }
            else
            {
                return$this->creerArticle( array() );
            }
        }

        public function getList(){
            $tabArticles = [];

            $reqList = $this->_bdd->query( 'SELECT * FROM Articles' );
            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) ){
                $tabArticles[] = $this->creerArticle( $tabDonnees );
            }
            $reqList->closeCursor();

            return $tabArticles;
        }

        public function getIdList()
        {
            $tabIdArticles = [];

            $reqList = $this->_bdd->query( 'SELECT idArticle FROM Articles ORDER BY idArticle ASC' );
            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) )
            {
                $tabIdArticles[] = (int)$tabDonnees['idArticle'];
            }

            return $tabIdArticles;
        }

        public function getDataListLimit( $start = 0, $range = 1 )
        {
            $tabDonneesArticles = [];

            $reqList = $this->_bdd->query( 'SELECT * FROM Articles LIMIT '.$start.', '.$range );
            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) ){
                $tabDonneesArticles[] = $tabDonnees;
            }
            $reqList->closeCursor();

            return $tabDonneesArticles;
        }

        public function addArt(Article $art){
            $sql = $this->_bdd->prepare('INSERT INTO Articles( texte, dateAjout, estSignale, idJeu, idCategorie) VALUES( :texte, :dateAjout, :estSignale, :idJeu, :idCategorie)');
 
            $sql->bindValue(':texte', $art->getTexte(), PDO::PARAM_STR);
            $sql->bindValue(':dateAjout', $art->getDateAjout());
            $sql->bindValue(':estSignale', $art->getEstSignale(), PDO::PARAM_BOOL );
            $sql->bindValue(':idJeu', $art->getIdJeu());
            $sql->bindValue(':idCategorie', $art->getIdCategorie());
    
            $sql->execute();
            // if ($sql) {
            //     echo "\nPDO::errorInfo():\n";
            //     print_r($sql->errorInfo());
            // }
            $sql->closeCursor();
        }

        public function deleteById( $id ){
            $this->_commentManager->deleteByIdArticle( $id );

            $reqDelete = $this->_bdd->prepare( 'DELETE FROM Articles WHERE idArticle = '.$id );

            $reqDelete->execute();
            $reqDelete->closeCursor();
        }

        public function deleteByIdJeu( $idJeu )
        {
            $reqDelete = $this->_bdd->prepare( 'DELETE FROM Articles WHERE idJeu LIKE :idJeu' );

            $reqDelete->bindValue( ':idJeu', $idJeu, PDO::PARAM_INT );

            $reqDelete->execute();
            $reqDelete->closeCursor();
        }

        public function update( Article $article )
        {
            $reqModif = $this->_bdd->prepare( 'UPDATE Articles SET texte = :texte, dateAjout = :dateAjout, estSignale = :estSignale, idJeu = :idJeu, idCategorie = :idCategorie WHERE idArticle LIKE :idArticle' );

            $reqModif->bindValue( ':idArticle', $article->getIdArticle(), PDO::PARAM_INT );
            $reqModif->bindValue( ':texte', $article->getTexte(), PDO::PARAM_STR );
            $reqModif->bindValue( ':dateAjout', $article->getDateAjout());
            $reqModif->bindValue( ':estSignale', $article->getEstSignale(), PDO::PARAM_BOOL );
            $reqModif->bindValue( ':idJeu', $article->getIdJeu());
            $reqModif->bindValue( ':idCategorie', $article->getIdCategorie());

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
            $set = substr($set, 0, -1);

            $reqModif = $this->_bdd->prepare( 'UPDATE Articles SET '.$set.' WHERE idArticle LIKE :idArticle' );

            $reqModif->bindValue( ':idArticle', $id, PDO::PARAM_INT );

            $reqModif->execute();
            $reqModif->closeCursor();
        }

        public function getListIdjeuByDateAjoutArticle()
        {
            $tabIdJeux = [];

            $reqList = $this->_bdd->query( 
                'SELECT idJeu
                 FROM articles
                 GROUP BY idjeu
                 ORDER BY MAX(dateAjout) DESC
                 LIMIT 3' 
            );
            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) )
            {
                $tabIdJeux[] = $tabDonnees['idJeu'];
            }
            $reqList->closeCursor();

            return $tabIdJeux;
        }

        // METHOD ALEATOIRE ===================================================

        public function getArtByCat($type){
            if ($type== Article::CATEGORIE_1){
                $sql = $this->_bdd->prepare( "SELECT * FROM Articles WHERE idCategorie = 1 ORDER BY RAND()" );
                $sql->execute();
                $donnees = $sql->fetch(PDO::FETCH_ASSOC);
                $sql->closeCursor();
            }elseif ($type== Article::CATEGORIE_2){
                $sql = $this->_bdd->prepare( "SELECT * FROM Articles WHERE idCategorie = 2 ORDER BY RAND()" );
                $sql->execute();
                $donnees = $sql->fetch(PDO::FETCH_ASSOC);
                $sql->closeCursor();
            }elseif ($type== Article::CATEGORIE_3){
                $sql = $this->_bdd->prepare( "SELECT * FROM Articles WHERE idCategorie = 3 ORDER BY RAND()" );
                $sql->execute();
                $donnees = $sql->fetch(PDO::FETCH_ASSOC);
                $sql->closeCursor();
            }else{
                echo "des erreurs ont ete commise";
            }
            return $this->creerArticle( $donnees );
        }

        public function getRandArtByCatLimit( $type, $limit )
        {
            $tabArticles = [];

            if ( $type == Article::CATEGORIE_1 )
            {
                $sql = $this->_bdd->prepare( "SELECT * FROM Articles WHERE idCategorie = 1 ORDER BY RAND() LIMIT ".$limit );
            }
            else if ( $type == Article::CATEGORIE_2 )
            {
                $sql = $this->_bdd->prepare( "SELECT * FROM Articles WHERE idCategorie = 2 ORDER BY RAND() LIMIT ".$limit );
            }
            else if ( $type == Article::CATEGORIE_3 )
            {
                $sql = $this->_bdd->prepare( "SELECT * FROM Articles WHERE idCategorie = 3 ORDER BY RAND() LIMIT ".$limit );
            } 
            else
            {
                return 'La catégorie donnée est invalide';
            }

            $sql->execute();
            while ( $tabDonnees = $sql->fetch( PDO::FETCH_ASSOC ) )
            {
                $tabArticles[] = $this->creerArticle( $tabDonnees );
            }
            $sql->closeCursor();

            return $tabArticles;
        }

        // PRIVATE METHODS ====================================================

        private function creerArticle( array $donnees )
        {
            // créer la base de l'objet Article
            $article = new Article( $donnees );
            // donner à l'article ses commentaires
            $article->setTabCommentaires( $this->_commentManager->getListByIdArticle( $article->getIdArticle() ) );

            return $article;
        }
    }
?>