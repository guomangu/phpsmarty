<?php
    class Administrateur {
        private $_id;
        private $_mdp;
        private $_adresseMail;
        private $_nom;
        private $_prenom;
        private $_dateModifMdp;

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

        public function setId($id){
            $this->_id = $id;
        }

        public function setMdp($mdp){
            $this->_mdp = $mdp;
        }

        public function setAdresseMail($adresseMail){
            $this->_adresseMail = $adresseMail;
        }

        public function setNom($nom){
            $this->_nom = $nom;
        }

        public function setPrenom($prenom){
            $this->_prenom = $prenom;
        }

        public function setDateModifMdp($dateModifMdp){
            $this->_dateModifMdp = $dateModifMdp;
        }

        // GET ================================================================

        public function getId(){
            return $this->_id;
        }

        public function getMdp(){
            return $this->_mdp;
        }

        public function getAdresseMail(){
            return $this->_adresseMail;
        }

        public function getNom(){
            return $this->_nom;
        }

        public function getPrenom(){
            return $this->_prenom;
        }

        public function getDateModifMdp(){
            return $this->_dateModifMdp;
        }
    }
?>