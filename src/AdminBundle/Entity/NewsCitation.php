<?php

namespace AdminBundle\Entity;

use AdminBundle\Repository\NewsCitationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * NewsCitation
 *
 * @ORM\Table(name="news_citation")
 * @ORM\Entity(repositoryClass="NewsCitationRepository")
 */
class NewsCitation
{
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
     * @ORM\Column(name="citation", type="string", length=255)
     */
    private $citation;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=255)
     */
    private $auteur;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set citation
     *
     * @param string $citation
     *
     * @return NewsCitation
     */
    public function setCitation($citation)
    {
        $this->citation = $citation;

        return $this;
    }

    /**
     * Get citation
     *
     * @return string
     */
    public function getCitation()
    {
        return $this->citation;
    }

    /**
     * Set auteur
     *
     * @param string $auteur
     *
     * @return NewsCitation
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }
    public function __toString() {
        return $this->getAuteur();
    }

}

