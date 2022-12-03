<?php

class commentaires
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
    public string $pseudo;

    /**
     * 
     * @var string
     */
    public string $email;

    /**
     * 
     * @var string
     */
    public string $texte;


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
     * Get the value of email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Get the value of pseudo
     *
     * @return string
     */
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    /**
     * Get the value of texte
     *
     * @return string
     */
    public function getTexte(): string
    {
        return $this->texte;
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
     * Set the value of pseudo
     *
     * @param string $pseudo
     *
     * @return self
     */
    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
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
     * Set the value of texte
     *
     * @param string $texte
     *
     * @return self
     */
    public function setTexte(string $texte): self
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * 
     * @param array $donnees
     * @return self
     */
    public function hydrate(array $donnees): self
    {

        if (!empty($donnees['pseudo'])) {
            $this->setPseudo($donnees['pseudo']);
        } else {
            $this->setPseudo('');
        }
        if (!empty($donnees['email'])) {
            $this->setEmail($donnees['email']);
        } else {
            $this->setEmail('');
        }
        if (!empty($donnees['texte'])) {
            $this->setTexte($donnees['texte']);
        } else {
            $this->setTexte('');
        }

        return $this;
    }
}
