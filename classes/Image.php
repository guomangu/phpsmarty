<?php
    class Image {
        private $_idImage;
        private $_nomImage;
        private $_dateAjout;
        private $_estSignale;

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

        public function setIdImage($idImage){
            $this->_idImage = $idImage;
        }

        public function setNomImage($nomImage){
            $this->_nomImage = $nomImage;
        }

        public function setDateAjout($dateAjout){
            $this->_dateAjout = $dateAjout;
        }

        public function setEstSignale($estSignale){
            $this->_estSignale = $estSignale;
        }

        // GET ================================================================

        public function getIdImage(){
            return $this->_idImage;
        }

        public function getNomImage(){
            return $this->_nomImage;
        }

        public function getDateAjout(){
            return $this->_dateAjout;
        }

        public function getEstSignale(){
            return $this->_estSignale;
        }
    }
?>