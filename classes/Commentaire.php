<?php
    class Commentaire {
        private $_idCommentaire;
        private $_texte;
        private $_dateAjout;
        private $_estSignale;
        private $_idArticle;             

        public function __construct(array $donnees){
            $this->hydrate($donnees);
        }

	    public function hydrate(array $donnees){
            foreach ($donnees as $key => $value){
                $method = 'set'.ucfirst($key);
                
                if (method_exists($this, $method)){
                    $this->$method($value);
                }
            }
        }

        // SET ================================================================

        public function setIdCommentaire($idCommentaire){
            $this->_idCommentaire = $idCommentaire;
        }

        public function setTexte( $texte )
        {
            $this->_texte = $texte;
        }

        public function setDateAjout($dateAjout){
            $this->_dateAjout = $dateAjout;
        }

        public function setEstSignale($estSignale){
            $this->_estSignale = $estSignale;
        }

        public function setIdArticle( $idArticle )
        {
            $this->_idArticle = $idArticle;
        }

        // GET ================================================================

        public function getIdCommentaire(){
            return $this->_idCommentaire;
        }

        public function getTexte()
        {
            return $this->_texte;
        }

        public function getDateAjout(){
            return $this->_dateAjout;
        }

        public function getEstSignale(){
            return $this->_estSignale;
        }

        public function getIdArticle()
        {
            return $this->_idArticle;
        }
    }
?>