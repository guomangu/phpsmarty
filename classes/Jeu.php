<?php
    class Jeu {
        private $_idJeu;
        private $_titre;
        private $_dateAjout;
        private $_estSignale;

        // 1 article de chaque catégories
        private $_artUnivers = null;
        private $_artFeeling = null;
        private $_artInstant = null;

        // un tableau qui contiendra jusqu'à 3 images si il y en a de disponibles
        private $_tabImages = [];

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

        public function setIdJeu($idJeu){
            $this->_idJeu = (int)$idJeu;
        }

        public function setTitre($titre){
            $this->_titre = $titre;
        }

        public function setDateAjout($dateAjout){
            $this->_dateAjout = $dateAjout;
        }

        public function setEstSignale($estSignale){
            $this->_estSignale = $estSignale;
        }

        public function setArtUnivers( Article $artUnivers )
        {
            $this->_artUnivers = $artUnivers;
        }

        public function setArtFeeling( Article $artFeeling )
        {
            $this->_artFeeling = $artFeeling;
        }

        public function setArtInstant( Article $artInstant )
        {
            $this->_artInstant = $artInstant;
        }

        public function setTabImages( array $tabImages )
        {
            $this->_tabImages = $tabImages;
        }

        // GET ================================================================

        public function getIdJeu(){
            return $this->_idJeu;
        }

        public function getTitre(){
            return $this->_titre;
        }

        public function getDateAjout(){
            return $this->_dateAjout;
        }

        public function getEstSignale(){
            return $this->_estSignale;
        }

        public function getArtUnivers()
        {
            return $this->_artUnivers;
        }

        public function getArtFeeling()
        {
            return $this->_artFeeling;
        }

        public function getArtInstant()
        {
            return $this->_artInstant;
        }

        public function getTabImages()
        {
            return $this->_tabImages;
        }

        public function getRandArticle()
        {
            $valid = !empty( $this->getArtUnivers()->getIdArticle() ) || !empty( $this->getArtFeeling()->getIdArticle() ) || !empty( $this->getArtInstant()->getIdArticle() );

            if ( $valid )
            {
                $art = new Article( array() );
                while ( empty( $art->getIdArticle() ) )
                {
                    $index = rand(0, 2);
                    switch ($index) 
                    {
                        case 0:
                            $art = $this->getArtUnivers();
                            break;
                        case 1:
                            $art = $this->getArtFeeling();
                            break;
                        case 2:
                            $art = $this->getArtInstant();
                            break;
                    }
                }

                return $art;
            }

            return false;
        }
    }
?>