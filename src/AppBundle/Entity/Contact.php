<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AppAssert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContactRepository")
 * @UniqueEntity(fields="mail", message="Ce mail existe déjà en base de données.")
 * @UniqueEntity(fields="phone", message="Ce numéro de téléphone existe déjà en base de données.")
 */
class Contact
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
     * @var int
     *
     * @ORM\Column(name="gender", type="string")
     * @Assert\Choice(choices = {"miss", "madam", "mister"}, message = "Genre invalide.")
     * @Assert\NotBlank(message="La civilité est obligatoire.")
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     * @Assert\NotBlank(message="Le nom de famille est obligatoire.")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255)
     * @Assert\NotBlank(message="Le prénom est obligatoire.")
     */
    private $firstName;

    /**
     * @var int
     *
     * @ORM\Column(name="postal_code", type="integer")
     * @AppAssert\PostalCode(message="Le code postal est incorrect.")
     * @Assert\NotBlank(message="Le code postal est obligatoire.")
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * @Assert\Email(message="Email invalide.")
     * @Assert\NotBlank(message="L'email est obligatoire.")
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, unique=true)
     * @Assert\Regex("/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}/")
     * @Assert\NotBlank(message="Le numéro de téléphone est obligatoire.")
     */
    private $phone;

    /**
     * @var bool
     *
     * @ORM\Column(name="actuality", type="boolean", nullable=true)
     */
    private $actuality;

    /**
     * @var bool
     *
     * @ORM\Column(name="offer", type="boolean", nullable=true)
     */
    private $offer;


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
     * Set gender
     *
     * @param integer $gender
     *
     * @return Contact
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return int
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Contact
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Contact
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set postalCode
     *
     * @param integer $postalCode
     *
     * @return Contact
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * @return int
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     *
     * @return Contact
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     *
     * @return Contact
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return bool
     */
    public function isActuality()
    {
        return $this->actuality;
    }

    /**
     * @param bool $actuality
     *
     * @return Contact
     */
    public function setActuality($actuality)
    {
        $this->actuality = $actuality;

        return $this;
    }

    /**
     * @return bool
     */
    public function isOffer()
    {
        return $this->offer;
    }

    /**
     * @param bool $offer
     *
     * @return Contact
     */
    public function setOffer($offer)
    {
        $this->offer = $offer;

        return $this;
    }
}

