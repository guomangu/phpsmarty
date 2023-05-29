<?php
    class Article {
        private $_idArticle;
        private $_texte;
        private $_dateAjout;
        private $_estSignale = false;
        private $_idJeu;
        private $_idCategorie;

        // un tableau contenant tout les commentaires en rapport avec cet article
        private $_tabCommentaires;

        const CATEGORIE_1 = 'univers';
        const CATEGORIE_2 = 'feeling';
        const CATEGORIE_3 = 'instant';

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

        public function setIdArticle($idArticle){
            $this->_idArticle = $idArticle;
        }

        public function setTexte($texte){
            $this->_texte = $texte;
        }

        public function setDateAjout($dateAjout){
            $this->_dateAjout = $dateAjout;
        }

        public function setEstSignale($estSignale){
            $this->_estSignale = $estSignale;
        }

        public function setIdJeu($idJeu){
            $this->_idJeu = $idJeu;
        }

        public function setIdCategorie($idCategorie){
            $this->_idCategorie = $idCategorie;
        }

        public function setTabCommentaires( array $tabCommentaires )
        {
            $this->_tabCommentaires = $tabCommentaires;
        }

        // GET ================================================================

        public function getIdArticle(){
            return $this->_idArticle;
        }

        public function getTexte(){
            return $this->_texte;
        }

        public function getDateAjout(){
            return $this->_dateAjout;
        }

        public function getEstSignale(){
            return $this->_estSignale;
        }

        public function getIdJeu(){
            return $this->_idJeu;
        }

        public function getIdCategorie(){
            return $this->_idCategorie;
        }

        public function getTabCommentaires()
        {
            return $this->_tabCommentaires;
        }
    }
?>