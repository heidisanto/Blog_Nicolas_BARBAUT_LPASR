<?php

class utilisateurs
{

    /**
     * 
     * @var int
     */
    public ?int $id;

    /**
     * 
     * @var string
     */
    public string $nom;

    /**
     * 
     * @var string
     */
    public string $prenom;

    /**
     * 
     * @var string
     */
    public string $email;

    /**
     * 
     * @var string
     */
    public string $mdp;

    /**
     * 
     * @var string
     */
    public string $sid;

    /**
     * Get the value of id
     *
     * @return ?int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param ?int $id
     *
     * @return self
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nom
     *
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @param string $nom
     *
     * @return self
     */
    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of prenom
     *
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @param string $prenom
     *
     * @return self
     */
    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param string $email
     *
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of mdp
     *
     * @return string
     */
    public function getMdp(): string
    {
        return $this->mdp;
    }

    /**
     * Set the value of mdp
     *
     * @param string $mdp
     *
     * @return self
     */
    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * Get the value of sid
     *
     * @return string
     */
    public function getSid(): string
    {
        return $this->sid;
    }

    /**
     * Set the value of sid
     *
     * @param string $sid
     *
     * @return self
     */
    public function setSid(string $sid): self
    {
        $this->sid = $sid;

        return $this;
    }


    /**
     * 
     * @param array $donnees
     * @return self
     */
    public function hydrate(array $donnees): self
    {

        if (!empty($donnees['id'])) {
            $this->setId($donnees['id']);
        } else {
            $this->setId(null);
        }

        if (!empty($donnees['nom'])) {
            $this->setNom($donnees['nom']);
        } else {
            $this->setNom('');
        }
        if (!empty($donnees['prenom'])) {
            $this->setPrenom($donnees['prenom']);
        } else {
            $this->setPrenom('');
        }
        if (!empty($donnees['email'])) {
            $this->setEmail($donnees['email']);
        } else {
            $this->setEmail('');
        }
        if (!empty($donnees['mdp'])) {
            $this->setMdp($donnees['mdp']);
        } else {
            $this->setMdp('');
        }
        if (!empty($donnees['sid'])) {
            $this->setSid($donnees['sid']);
        } else {
            $this->setSid('');
        }

        return $this;
    }
}
