<?php

namespace Doshibu\AfkWatchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Serie
 *
 * @ORM\Table(name="serie")
 * @ORM\Entity(repositoryClass="Doshibu\AfkWatchBundle\Repository\SerieRepository")
 */
class Serie
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="tiny_description", type="string", length=255, nullable=false)
     */
    private $tinyDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="film_maker", type="string", length=255)
     */
    private $filmMaker;

    /**
     * @var string
     *
     * @ORM\Column(name="rating", type="integer")
     */
    private $rating;

    /**
     * @var string
     *
     * @ORM\Column(name="date_release", type="date")
     */
    private $dateRelease;

    /**
     * @var string
     *
     * @ORM\Column(name="url_trailer", type="string", length=255, nullable=false)
     */
    private $urlTrailer;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="nb_views", type="integer", nullable=true)
     */
    private $nbViews;

    /**
    * @Gedmo\Slug(fields={"name"})
    * @ORM\Column(length=128, unique=true)
    */
    private $slug;

    /**
     * @ORM\Column(name="added_at", type="datetime", nullable=true)
     */
    private $addedAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
    * @ORM\OneToOne(targetEntity="Doshibu\AfkWatchBundle\Entity\Image", cascade={"persist"})
    */
    private $imageLarge;

    /**
    * @ORM\OneToOne(targetEntity="Doshibu\AfkWatchBundle\Entity\Image", cascade={"persist"})
    */
    private $imageSmall;

    /**
    * @ORM\ManyToMany(targetEntity="Doshibu\AfkWatchBundle\Entity\Genre", cascade={"persist"})
    */
    private $genders;

    /**
    * @ORM\ManyToMany(targetEntity="Doshibu\AfkWatchBundle\Entity\Pays", cascade={"persist"})
    */
    private $countries;

    public function __construct()
    {
        $this->genders = new \Doctrine\Common\Collections\ArrayCollection();
        $this->countries = new \Doctrine\Common\Collections\ArrayCollection();
        $this->addedAt = new \DateTime();
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return Serie
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
     * Set tinyDescription
     *
     * @param string $tinyDescription
     *
     * @return Serie
     */
    public function setTinyDescription($tinyDescription)
    {
        $this->tinyDescription = $tinyDescription;

        return $this;
    }

    /**
     * Get tinyDescription
     *
     * @return string
     */
    public function getTinyDescription()
    {
        return $this->tinyDescription;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Serie
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set filmMaker
     *
     * @param string $filmMaker
     *
     * @return Serie
     */
    public function setFilmMaker($filmMaker)
    {
        $this->filmMaker = $filmMaker;

        return $this;
    }

    /**
     * Get filmMaker
     *
     * @return string
     */
    public function getFilmMaker()
    {
        return $this->filmMaker;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     *
     * @return Serie
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set dateRelease
     *
     * @param \DateTime $dateRelease
     *
     * @return Serie
     */
    public function setDateRelease($dateRelease)
    {
        $this->dateRelease = $dateRelease;

        return $this;
    }

    /**
     * Get dateRelease
     *
     * @return \DateTime
     */
    public function getDateRelease()
    {
        return $this->dateRelease;
    }

    /**
     * Set urlTrailer
     *
     * @param string $urlTrailer
     *
     * @return Serie
     */
    public function setUrlTrailer($urlTrailer)
    {
        $this->urlTrailer = $urlTrailer;

        return $this;
    }

    /**
     * Get urlTrailer
     *
     * @return string
     */
    public function getUrlTrailer()
    {
        return $this->urlTrailer;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Serie
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set nbViews
     *
     * @param integer $nbViews
     *
     * @return Serie
     */
    public function setNbViews($nbViews)
    {
        $this->nbViews = $nbViews;

        return $this;
    }

    /**
     * Get nbViews
     *
     * @return integer
     */
    public function getNbViews()
    {
        return $this->nbViews;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Serie
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set addedAt
     *
     * @param \DateTime $addedAt
     *
     * @return Serie
     */
    public function setAddedAt($addedAt)
    {
        $this->addedAt = $addedAt;

        return $this;
    }

    /**
     * Get addedAt
     *
     * @return \DateTime
     */
    public function getAddedAt()
    {
        return $this->addedAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Serie
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set imageLarge
     *
     * @param \Doshibu\AfkWatchBundle\Entity\Image $imageLarge
     *
     * @return Serie
     */
    public function setImageLarge(\Doshibu\AfkWatchBundle\Entity\Image $imageLarge = null)
    {
        $this->imageLarge = $imageLarge;

        return $this;
    }

    /**
     * Get imageLarge
     *
     * @return \Doshibu\AfkWatchBundle\Entity\Image
     */
    public function getImageLarge()
    {
        return $this->imageLarge;
    }

    /**
     * Set imageSmall
     *
     * @param \Doshibu\AfkWatchBundle\Entity\Image $imageSmall
     *
     * @return Serie
     */
    public function setImageSmall(\Doshibu\AfkWatchBundle\Entity\Image $imageSmall = null)
    {
        $this->imageSmall = $imageSmall;

        return $this;
    }

    /**
     * Get imageSmall
     *
     * @return \Doshibu\AfkWatchBundle\Entity\Image
     */
    public function getImageSmall()
    {
        return $this->imageSmall;
    }

    /**
     * Add gender
     *
     * @param \Doshibu\AfkWatchBundle\Entity\Genre $gender
     *
     * @return Serie
     */
    public function addGender(\Doshibu\AfkWatchBundle\Entity\Genre $gender)
    {
        $this->genders[] = $gender;

        return $this;
    }

    /**
     * Remove gender
     *
     * @param \Doshibu\AfkWatchBundle\Entity\Genre $gender
     */
    public function removeGender(\Doshibu\AfkWatchBundle\Entity\Genre $gender)
    {
        $this->genders->removeElement($gender);
    }

    /**
     * Get genders
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGenders()
    {
        return $this->genders;
    }

    /**
     * Add country
     *
     * @param \Doshibu\AfkWatchBundle\Entity\Pays $country
     *
     * @return Serie
     */
    public function addCountry(\Doshibu\AfkWatchBundle\Entity\Pays $country)
    {
        $this->countries[] = $country;

        return $this;
    }

    /**
     * Remove country
     *
     * @param \Doshibu\AfkWatchBundle\Entity\Pays $country
     */
    public function removeCountry(\Doshibu\AfkWatchBundle\Entity\Pays $country)
    {
        $this->countries->removeElement($country);
    }

    /**
     * Get countries
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCountries()
    {
        return $this->countries;
    }
}