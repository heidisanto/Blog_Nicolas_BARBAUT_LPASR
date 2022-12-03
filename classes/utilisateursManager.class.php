<?php

class utilisateursManager
{

    // DECLARATIONS ET INSTANCIATIONS
    private PDO $bdd; // Instance de PDO.
    private ?bool $_result;
    private utilisateurs $_utilisateurs; // Instance de utilisateurs.
    private int $_getLastInsertId;

    public function __construct(PDO $bdd)
    {
        $this->setBdd($bdd);
    }

    /**
     * Get the value of bdd
     *
     * @return PDO
     */
    public function getBdd(): PDO
    {
        return $this->bdd;
    }

    /**
     * Set the value of bdd
     *
     * @param PDO $bdd
     *
     * @return self
     */
    public function setBdd(PDO $bdd): self
    {
        $this->bdd = $bdd;

        return $this;
    }

    /**
     * Get the value of _result
     *
     * @return ?bool
     */
    public function get_result(): ?bool
    {
        return $this->_result;
    }

    /**
     * Set the value of _result
     *
     * @param ?bool $_result
     *
     * @return self
     */
    public function set_result(?bool $_result): self
    {
        $this->_result = $_result;

        return $this;
    }

    /**
     * Get the value of _utilisateurs
     *
     * @return utilisateurs
     */
    public function get_utilisateurs(): utilisateurs
    {
        return $this->_utilisateurs;
    }

    /**
     * Set the value of _utilisateurs
     *
     * @param utilisateurs $_utilisateurs
     *
     * @return self
     */
    public function set_utilisateurs(utilisateurs $_utilisateurs): self
    {
        $this->_utilisateurs = $_utilisateurs;

        return $this;
    }

    /**
     * Get the value of _getLastInsertId
     *
     * @return int
     */
    public function get_getLastInsertId(): int
    {
        return $this->_getLastInsertId;
    }

    /**
     * Set the value of _getLastInsertId
     *
     * @param int $_getLastInsertId
     *
     * @return self
     */
    public function set_getLastInsertId(int $_getLastInsertId): self
    {
        $this->_getLastInsertId = $_getLastInsertId;

        return $this;
    }

    /**
     * 
     * @param utilisateurs $utilisateurs
     * @return $this
     */
    public function add(utilisateurs $utilisateurs)
    {
        $sql = "INSERT INTO utilisateurs "
            . "(nom, prenom, email, mdp, sid) "
            . "VALUES (:nom, :prenom, :email, :mdp, :sid)";
        $req = $this->bdd->prepare($sql);
        //Sécurisation les variables
        $req->bindValue(':nom', $utilisateurs->getNom(), PDO::PARAM_STR);
        $req->bindValue(':prenom', $utilisateurs->getPrenom(), PDO::PARAM_STR);
        $req->bindValue(':email', $utilisateurs->getEmail(), PDO::PARAM_STR);
        $req->bindValue(':mdp', $utilisateurs->getMdp(), PDO::PARAM_STR);
        $req->bindValue(':sid', $utilisateurs->getSid(), PDO::PARAM_STR);
        //Exécuter la requête
        $req->execute();
        if ($req->errorCode() == 00000) {
            $this->_result = true;
            $this->_getLastInsertId = $this->bdd->lastInsertId();
        } else {
            $this->_result = false;
        }
        return $this;
    }

    /**
     * 
     * @param string $email
     * @return utilisateurs
     */
    public function getByEmail(string $email): utilisateurs
    {
        // Prépare une requête de type SELECT avec une clause WHERE selon l'id.
        $sql = 'SELECT * FROM utilisateurs WHERE email = :email';
        $req = $this->bdd->prepare($sql);

        // Exécution de la requête avec attribution des valeurs aux marqueurs nominatifs.
        $req->bindValue(':email', $email, PDO::PARAM_STR);
        $req->execute();

        // On stocke les données obtenues dans un tableau.
        $donnees = $req->fetch(PDO::FETCH_ASSOC);

        $donnees = !$donnees ? [] : $donnees;

        $utilisateurs = new utilisateurs();
        $utilisateurs->hydrate($donnees);
        //print_r2($utilisateurs);
        return $utilisateurs;
    }

    /**
     * 
     * @param utilisateurs $utilisateurs
     * @return self
     */
    public function updateByEmail(utilisateurs $utilisateurs): self
    {
        $sql = "UPDATE utilisateurs SET sid = :sid WHERE email = :email";
        $req = $this->bdd->prepare($sql);
        //Sécurisation les variables
        $req->bindValue(':email', $utilisateurs->getEmail(), PDO::PARAM_STR);
        $req->bindValue(':sid', $utilisateurs->getSid(), PDO::PARAM_STR);
        //Exécuter la requête
        $req->execute();
        if ($req->errorCode() == 00000) {
            $this->_result = true;
        } else {
            $this->_result = false;
        }
        return $this;
    }

    /**
     * 
     * @param string $sid
     * @return utilisateurs
     */
    public function getBySid(string $sid): utilisateurs
    {
        // Prépare une requête de type SELECT avec une clause WHERE selon l'id.
        $sql = 'SELECT * FROM utilisateurs WHERE sid = :sid';
        $req = $this->bdd->prepare($sql);

        // Exécution de la requête avec attribution des valeurs aux marqueurs nominatifs.
        $req->bindValue(':sid', $sid, PDO::PARAM_STR);
        $req->execute();

        // On stocke les données obtenues dans un tableau.
        $donnees = $req->fetch(PDO::FETCH_ASSOC);

        $donnees = !$donnees ? [] : $donnees;

        $utilisateurs = new utilisateurs();
        $utilisateurs->hydrate($donnees);
        //print_r2($utilisateurs);
        return $utilisateurs;
    }
}
