<?php
    class Categorie {
        private $_idCategorie;
        private $_libelle;

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

        public function setIdCategorie($idCategorie){
            $this->_idCategorie = $idCategorie;
        }

        public function setLibelle($libelle){
            $this->_libelle = $libelle;
        }

        // GET ================================================================

        public function getIdCategorie(){
            return $this->_idCategorie;
        }

        public function getLibelle(){
            return $this->_libelle;
        }
    }
?>