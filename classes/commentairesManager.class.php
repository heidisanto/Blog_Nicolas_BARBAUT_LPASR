<?php

class commentairesManager
{

    // DECLARATIONS ET INSTANCIATIONS
    private PDO $bdd; // Instance de PDO.
    private ?bool $_result;
    private commentaires $_commentaires; // Instance de utilisateurs.
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
     * Get the value of _commentaires
     *
     * @return commentaires
     */
    public function get_commentaires(): commentaires
    {
        return $this->_commentaires;
    }

    /**
     * Set the value of _commentaires
     *
     * @param commentaires $_commentaires
     *
     * @return self
     */
    public function set_commentaires(commentaires $_commentaires): self
    {
        $this->_commentaires = $_commentaires;

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
     * @param commentaires $commentaires
     * @return $this
     */
    public function add(commentaires $commentaires)
    {
        $sql = "INSERT INTO commentaires "
            . "(pseudo, email, texte) "
            . "VALUES (:pseudo, :email, :texte)";
        $req = $this->bdd->prepare($sql);
        //Sécurisation des variables
        $req->bindValue(':pseudo', $commentaires->getPseudo(), PDO::PARAM_STR);
        $req->bindValue(':email', $commentaires->getEmail(), PDO::PARAM_STR);
        $req->bindValue(':texte', $commentaires->getTexte(), PDO::PARAM_STR);
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
}
