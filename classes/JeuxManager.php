<?php
    date_default_timezone_set('Europe/Paris');

    class JeuxManager{
        private $_bdd;
        private $_artManager;
        private $_imgManager;

        public function __construct( $bdd ){
            $this->setBdd($bdd);
            $this->_artManager = new ArticlesManager( $bdd );
            $this->_imgManager = new ImagesManager( $bdd );
        }

        public function setBdd(PDO $bdd){
            $this->_bdd = $bdd;
        }

        // METHOD =============================================================

        public function getTotalCount()
        {
            $sql = $this->_bdd->query( "SELECT count(*) AS 'total' FROM Jeux" );
            $donnees = $sql->fetch( PDO::FETCH_ASSOC );
            $sql->closeCursor();
            
            return (int)$donnees['total'];
        }

        public function getTotalCountByString( $str )
        {
            $sql = $this->_bdd->query(
                'SELECT count(*) AS "total"
                FROM Jeux
                WHERE titre LIKE "'.$str.'%"'
            );
            $donnees = $sql->fetch( PDO::FETCH_ASSOC );
            $sql->closeCursor();
            
            return (int)$donnees['total'];
        }

        public function getTotalCountAlpha()
        {
            $sql = $this->_bdd->query(
                'SELECT count(*) AS "total"
                FROM Jeux
                WHERE (titre REGEXP "^[a-zA-Z]+(.)*")'
            );
            $donnees = $sql->fetch( PDO::FETCH_ASSOC );
            $sql->closeCursor();
            
            return (int)$donnees['total'];
        }

        public function getTotalCountNum()
        {
            $sql = $this->_bdd->query(
                'SELECT count(*) AS "total"
                FROM Jeux
                WHERE (titre REGEXP "^[0-9]+(.)*")'
            );
            $donnees = $sql->fetch( PDO::FETCH_ASSOC );
            $sql->closeCursor();
            
            return (int)$donnees['total'];
        }

        public function getTotalCountNonAlphaNum()
        {
            $sql = $this->_bdd->query(
                'SELECT count(*) AS "total"
                FROM Jeux
                WHERE (titre REGEXP "^[^a-zA-Z0-9]+(.)*")'
            );
            $donnees = $sql->fetch( PDO::FETCH_ASSOC );
            $sql->closeCursor();
            
            return (int)$donnees['total'];
        }

        public function getValidAlphaNumList()
        {
            $tabAlphaNumList = [];
            $tabDonnees = [];
            
            // 1) verification pour caractères alphabetiques
            $alphabet = 'abcdefghijklmnopqrstuvwxyz';
            for ( $i = 0; $i < strlen( $alphabet ); ++$i )
            {
                $req = $this->_bdd->query(
                    'SELECT 1
                    FROM Jeux
                    WHERE titre LIKE "'.$alphabet[$i].'%"'
                );

                $tabDonnees[strtoupper( $alphabet[$i] )] = (bool)$req->fetch( PDO::FETCH_ASSOC );
                $req->closeCursor();
            }
            $tabAlphaNumList['alpha'] = $tabDonnees;

            // 2) vérification pour caractères numériques
            $req = $this->_bdd->query(
                'SELECT 1
                FROM Jeux
                WHERE (titre REGEXP "^[0-9]+(.)*")'
            );

            $tabAlphaNumList['num'] = (bool)$req->fetch( PDO::FETCH_ASSOC );
            $req->closeCursor();

            // 3) vérification pour caractères non alphanumériques
            $req = $this->_bdd->query(
                'SELECT 1
                FROM Jeux
                WHERE (titre REGEXP "^[^a-zA-Z0-9]+(.)*")'
            );

            $tabAlphaNumList['nonAlphaNum'] = (bool)$req->fetch( PDO::FETCH_ASSOC );
            $req->closeCursor();

            return $tabAlphaNumList;
        }

        public function getListByString( $str )
        {
            $tabJeux = [];

            $reqList = $this->_bdd->query(
                'SELECT *
                FROM Jeux
                WHERE titre LIKE "'.$str.'%"'
            );
            
            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) )
            {
                $tabJeux[] = $this->creerJeu( $tabDonnees );
            }
            $reqList->closeCursor();

            return $tabJeux;
        }

        public function getAlphaList()
        {
            $tabJeux = [];

            $reqList = $this->_bdd->query(
                'SELECT *
                FROM Jeux
                WHERE (titre REGEXP "^[a-zA-Z]+(.)*")'
            );
            
            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) )
            {
                $tabJeux[] = $this->creerJeu( $tabDonnees );
            }
            $reqList->closeCursor();

            return $tabJeux;
        }
        
        public function getNumList()
        {
            $tabJeux = [];

            $reqList = $this->_bdd->query(
                'SELECT *
                FROM Jeux
                WHERE (titre REGEXP "^[0-9]+(.)*")'
            );
            
            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) )
            {
                $tabJeux[] = $this->creerJeu( $tabDonnees );
            }
            $reqList->closeCursor();
            
            return $tabJeux;
        }

        public function getNonAlphaNumList()
        {
            $tabJeux = [];

            $reqList = $this->_bdd->query(
                'SELECT *
                FROM Jeux
                WHERE (titre REGEXP "^[^a-zA-Z0-9]+(.)*")'
            );
            
            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) )
            {
                $tabJeux[] = $this->creerJeu( $tabDonnees );
            }
            $reqList->closeCursor();
            
            return $tabJeux;
        }

        public function getListByStringLimit( $str, $debut, $nombre )
        {
            $tabJeux = [];

            $reqList = $this->_bdd->query(
                'SELECT *
                FROM Jeux
                WHERE titre LIKE "'.$str.'%"
                LIMIT '.$debut.', '.$nombre.''
            );
            
            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) )
            {
                $tabJeux[] = $this->creerJeu( $tabDonnees );
            }
            $reqList->closeCursor();

            return $tabJeux;
        }

        public function getAlphaListLimit( $debut, $nombre )
        {
            $tabJeux = [];

            $reqList = $this->_bdd->query(
                'SELECT *
                FROM Jeux
                WHERE (titre REGEXP "^[a-zA-Z]+(.)*")
                LIMIT '.$debut.', '.$nombre.''
            );
            
            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) )
            {
                $tabJeux[] = $this->creerJeu( $tabDonnees );
            }
            $reqList->closeCursor();

            return $tabJeux;
        }
        
        public function getNumListLimit( $debut, $nombre )
        {
            $tabJeux = [];

            $reqList = $this->_bdd->query(
                'SELECT *
                FROM Jeux
                WHERE (titre REGEXP "^[0-9]+(.)*")
                LIMIT '.$debut.', '.$nombre.''
            );
            
            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) )
            {
                $tabJeux[] = $this->creerJeu( $tabDonnees );
            }
            $reqList->closeCursor();
            
            return $tabJeux;
        }

        public function getNonAlphaNumListLimit( $debut, $nombre )
        {
            $tabJeux = [];

            $reqList = $this->_bdd->query(
                'SELECT *
                FROM Jeux
                WHERE (titre REGEXP "^[^a-zA-Z0-9]+(.)*")
                LIMIT '.$debut.', '.$nombre.''
            );
            
            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) )
            {
                $tabJeux[] = $this->creerJeu( $tabDonnees );
            }
            $reqList->closeCursor();
            
            return $tabJeux;
        } 

        public function getJeuById($id){
            $sql = $this->_bdd->prepare("SELECT * FROM Jeux WHERE idJeu = :idJeu");
            $sql->bindValue( ':idJeu', $id, PDO::PARAM_INT );

            $sql->execute();
            $donnees = $sql->fetch(PDO::FETCH_ASSOC);
            $sql->closeCursor();

            return $this->creerJeu( $donnees );
        }

        public function getIdJeuByTitre( $titre )
        {
            $sql = $this->_bdd->prepare("SELECT idJeu FROM Jeux WHERE titre = :titre");
            $sql->bindValue( ':titre', $titre, PDO::PARAM_STR );

            $sql->execute();
            $donnees = $sql->fetch(PDO::FETCH_ASSOC);
            $sql->closeCursor();

            return (int)$donnees['idJeu'];
        }

        public function getList(){
            $tabJeux = [];

            $reqList = $this->_bdd->query( 'SELECT * FROM Jeux' );
            
            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) ){
                $tabJeux[] = $this->creerJeu( $tabDonnees );
            }
            return $tabJeux;
        }

        public function getIdList()
        {
            $tabIdJeux = [];

            $reqList = $this->_bdd->query( 'SELECT idJeu FROM Jeux ORDER BY idJeu ASC' );
            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) )
            {
                $tabIdJeux[] = (int)$tabDonnees['idJeu'];
            }

            return $tabIdJeux;
        }

        public function getDataList(){
            $tabDonneesJeux = [];

            $reqList = $this->_bdd->query( 'SELECT * FROM Jeux' );
            
            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) ){
                $tabDonneesJeux[] = $tabDonnees;
            }
            return $tabDonneesJeux;
        }

        public function addJeu( Jeu $jeu ){

            $sql = $this->_bdd->prepare('INSERT INTO Jeux(idJeu, titre, dateAjout, estSignale) VALUES(:idJeu, :titre, :dateAjout, :estSignale)');
    
            $sql->bindValue(':idJeu', $jeu->getIdJeu(), PDO::PARAM_INT);
            $sql->bindValue(':titre', $jeu->getTitre());
            $sql->bindValue(':dateAjout', $jeu->getDateAjout());
            $sql->bindValue(':estSignale', $jeu->getEstSignale());
    
            $sql->execute();
            $sql->closeCursor();

            return $this->_bdd->lastInsertId();
        }

        public function deleteById( $id )
        {
            // supprimer les articles en rapport avec le jeu
            $this->_artManager->deleteByIdJeu( $id );

            // supprimer les compositions image/jeu en rapport avec le jeu
            $this->_imgManager->deleteByIdJeu( $id );

            // suppression du jeu
            $reqDelete = $this->_bdd->prepare( 'DELETE FROM Jeux WHERE idJeu LIKE :idJeu' );
    
            $reqDelete->bindValue( ':idJeu', $id, PDO::PARAM_INT );
    
            $reqDelete->execute();
            $reqDelete->closeCursor();
        }

        public function update( Jeu $jeu )
        {
            $reqModif = $this->_bdd->prepare( 'UPDATE Jeux SET titre = :titre, dateAjout = :dateAjout, estSignale = :estSignale WHERE idJeu LIKE :idJeu' );

            $reqModif->bindValue( ':idJeu', $jeu->getIdJeu(), PDO::PARAM_INT );
            $reqModif->bindValue( ':titre', $jeu->getTitre(), PDO::PARAM_STR );
            $reqModif->bindValue( ':dateAjout', $jeu->getDateAjout());
            $reqModif->bindValue( ':estSignale', $jeu->getEstSignale(), PDO::PARAM_BOOL );

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

            $reqModif = $this->_bdd->prepare( 'UPDATE Jeux SET '.$set.' WHERE idJeu LIKE :idJeu' );

            $reqModif->bindValue( ':idJeu', $id, PDO::PARAM_INT );
            
            $reqModif->execute();
            $reqModif->closeCursor();
        }

        public function checkId( $id )
        {
            $sql = $this->_bdd->prepare("SELECT 1 FROM Jeux WHERE idJeu = :idJeu");
            $sql->bindValue( ':idJeu', $id, PDO::PARAM_INT );

            $sql->execute();
            $donnees = $sql->fetch(PDO::FETCH_ASSOC);
            $sql->closeCursor();

            return (int)$donnees == 1 ? true : false;
        }

        // METHOD ALEATOIRE ET DATE ET ALPHABET ===============================

        public function getAlea(){
            $sql = $this->_bdd->prepare( "SELECT * FROM Jeux ORDER BY RAND() LIMIT 1" );
            $sql->execute();
            $donnees = $sql->fetch( PDO::FETCH_ASSOC );
            $sql->closeCursor();

            return $this->creerJeu( $donnees );;
        }

        public function get3Alea(){
            $tabJeux = [];

            $reqList = $this->_bdd->query( 'SELECT * FROM Jeux ORDER BY RAND() LIMIT 3' );
            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) ){
                $tabJeux[] = $this->creerJeu( $tabDonnees );
            }
            $reqList->closeCursor();

            return $tabJeux;
        }

        public function getListAlea(){
            $tabJeux = [];

            $reqList = $this->_bdd->query( 'SELECT * FROM Jeux ORDER BY RAND()' );
            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) ){
                $tabJeux[] = $this->creerJeu( $tabDonnees );
            }
            $reqList->closeCursor();

            return $tabJeux;
        }

        public function getListByDateAjout(){
            $tabJeux = [];

            $reqList = $this->_bdd->query( 'SELECT * FROM Jeux ORDER BY dateAjout DESC' );
            
            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) ){
                $tabJeux[] = $this->creerJeu( $tabDonnees );
            }
            return $tabJeux;
        }

        public function getListByDateAjoutLimit( $debut, $nombre )
        {
            $tabJeux = [];

            $reqList = $this->_bdd->query( 
                'SELECT * FROM Jeux 
                ORDER BY dateAjout DESC
                LIMIT '.$debut.', '.$nombre.'' );
            
            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) ){
                $tabJeux[] = $this->creerJeu( $tabDonnees );
            }
            $reqList->closeCursor();
            
            return $tabJeux;
        }

        public function get3ByDateAjout(){
            $tabJeux = [];

            $reqList = $this->_bdd->query( 'SELECT * FROM Jeux ORDER BY dateAjout DESC LIMIT 3' );
            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) ){
                $tabJeux[] = $this->creerJeu( $tabDonnees );
            }
            $reqList->closeCursor();

            return $tabJeux;
        }

        public function getListByAlphabet(){
            $tabJeux = [];

            $reqList = $this->_bdd->query( 'SELECT * FROM Jeux ORDER BY titre ASC' );
            while ( $tabDonnees = $reqList->fetch( PDO::FETCH_ASSOC ) ){
                $tabJeux[] = $this->creerJeu( $tabDonnees );
            }
            $reqList->closeCursor();

            return $tabJeux;
        }

        public function get3ByDateAjoutArticle()
        {
            $tabJeux = [];

            // récupération des identifiants des 3 derniers jeux à avoir
            // reçu un article
            $tabIdJeux = $this->_artManager->getListidJeuByDateAjoutArticle();
            for ( $i = 0; $i != 3; ++$i )
            {
                $tabJeux[] = $this->getJeuById( $tabIdJeux[$i] );
            }
            
            return $tabJeux;
        }

        // PRIVATE METHODS ====================================================

        private function creerJeu( array $donnees )
        {
            // créer la base de l'objet jeu
            $jeu = new Jeu( $donnees );
            // donner ses Jeux au jeu
            $jeu->setArtUnivers( $this->_artManager->getArtByIdJeuAndByCategorie( $jeu->getIdJeu(), 1 ) );
            $jeu->setArtFeeling( $this->_artManager->getArtByIdJeuAndByCategorie( $jeu->getIdJeu(), 2 ) );
            $jeu->setArtInstant( $this->_artManager->getArtByIdJeuAndByCategorie( $jeu->getIdJeu(), 3 ) );
            // donner ses images au jeu (si il y'en a)
            $jeu->setTabImages( $this->_imgManager->getRandImgListLimitByIdJeu( $jeu->getIdJeu() ) );

            return $jeu;
        }
    }
?>