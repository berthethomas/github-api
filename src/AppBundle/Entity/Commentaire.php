<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommentaireRepository")
 */
class Commentaire {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="text")
     */
    private $texte;

    /**
     * @var float
     *
     * @ORM\Column(name="note", type="float")
     */
    private $note;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Livre", cascade={"remove", "persist"}, inversedBy="commentaires")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL");
     */
    private $livre;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set texte
     *
     * @param string $texte
     *
     * @return Commentaire
     */
    public function setTexte($texte) {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return string
     */
    public function getTexte() {
        return $this->texte;
    }

    /**
     * Set livre
     *
     * @param \AppBundle\Entity\Livre $livre
     *
     * @return Commentaire
     */
    public function setLivre(\AppBundle\Entity\Livre $livre = null) {
        $this->livre = $livre;

        return $this;
    }

    /**
     * Get livre
     *
     * @return \AppBundle\Entity\Livre
     */
    public function getLivre() {
        return $this->livre;
    }

    /**
     * Set note
     *
     * @param float $note
     *
     * @return Commentaire
     */
    public function setNote($note) {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return float
     */
    public function getNote() {
        return $this->note;
    }

}
