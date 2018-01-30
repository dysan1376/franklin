<?php

namespace Franklin\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Blog
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Blog
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="slug_es", type="string", length=255, nullable=true)
     */
    private $slugEs;

    /**
     * @var string
     *
     * @ORM\Column(name="slug_en", type="string", length=255, nullable=true)
     */
    private $slugEn;

    /**
     * @var string
     *
     * @ORM\Column(name="slug_pt", type="string", length=255, nullable=true)
     */
    private $slugPt;

    /**
     * @var string
     *
     * @ORM\Column(name="slug_it", type="string", length=255, nullable=true)
     */
    private $slugIt;

    /**
     * @var string
     *
     * @ORM\Column(name="locale", type="string", length=5)
     */
    private $locale;

    /**
     * @var string
     *
     * @ORM\Column(name="keywords", type="text")
     */
    private $keywords;

    /**
     * @var string
     *
     * @ORM\Column(name="tag", type="string", length=255)
     */
    private $tag;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="subtitle", type="string", length=255, nullable=true)
     */
    private $subtitle;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text")
     */
    private $text;

    /**
     * @var string
     *
     * @ORM\Column(name="append_text", type="text", nullable=true)
     */
    private $appendText;

    /**
     * @var string
     *
     * @ORM\Column(name="image_url_one", type="string", length=255, nullable=true)
     */
    private $imageUrlOne;

    /**
     * @var string
     *
     * @ORM\Column(name="image_alt_one", type="string", length=255, nullable=true)
     */
    private $imageAltOne;

    /**
     * @var string
     *
     * @ORM\Column(name="image_url_two", type="string", length=255, nullable=true)
     */
    private $imageUrlTwo;

    /**
     * @var string
     *
     * @ORM\Column(name="image_alt_two", type="string", length=255, nullable=true)
     */
    private $imageAltTwo;

    /**
     * @var string
     *
     * @ORM\Column(name="image_url_three", type="string", length=255, nullable=true)
     */
    private $imageUrlThree;

    /**
     * @var string
     *
     * @ORM\Column(name="image_alt_three", type="string", length=255, nullable=true)
     */
    private $imageAltThree;

    /**
     * @var string
     *
     * @ORM\Column(name="image_url_four", type="string", length=255, nullable=true)
     */
    private $imageUrlFour;

    /**
     * @var string
     *
     * @ORM\Column(name="image_alt_four", type="string", length=255, nullable=true)
     */
    private $imageAltFour;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="datetime")
     */
    private $fechaCreacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_actualizacion", type="datetime", nullable=true)
     */
    private $fechaActualizacion;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Blog
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
     * Set slugEs
     *
     * @param string $slugEs
     *
     * @return Blog
     */
    public function setSlugEs($slugEs)
    {
        $this->slugEs = $slugEs;

        return $this;
    }

    /**
     * Get slugEs
     *
     * @return string
     */
    public function getSlugEs()
    {
        return $this->slugEs;
    }

    /**
     * Set slugEn
     *
     * @param string $slugEn
     *
     * @return Blog
     */
    public function setSlugEn($slugEn)
    {
        $this->slugEn = $slugEn;

        return $this;
    }

    /**
     * Get slugEn
     *
     * @return string
     */
    public function getSlugEn()
    {
        return $this->slugEn;
    }

    /**
     * Set slugPt
     *
     * @param string $slugPt
     *
     * @return Blog
     */
    public function setSlugPt($slugPt)
    {
        $this->slugPt = $slugPt;

        return $this;
    }

    /**
     * Get slugPt
     *
     * @return string
     */
    public function getSlugPt()
    {
        return $this->slugPt;
    }

    /**
     * Set slugIt
     *
     * @param string $slugIt
     *
     * @return Blog
     */
    public function setSlugIt($slugIt)
    {
        $this->slugIt = $slugIt;

        return $this;
    }

    /**
     * Get slugIt
     *
     * @return string
     */
    public function getSlugIt()
    {
        return $this->slugIt;
    }

    /**
     * Set locale
     *
     * @param string $locale
     *
     * @return Blog
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set keywords
     *
     * @param string $keywords
     *
     * @return Blog
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;

        return $this;
    }

    /**
     * Get keywords
     *
     * @return string
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Set tag
     *
     * @param string $tag
     *
     * @return Blog
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Blog
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Blog
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set subtitle
     *
     * @param string $subtitle
     *
     * @return Blog
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Get subtitle
     *
     * @return string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Blog
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
     * Set text
     *
     * @param string $text
     *
     * @return Blog
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set appendText
     *
     * @param string $appendText
     *
     * @return Blog
     */
    public function setAppendText($appendText)
    {
        $this->appendText = $appendText;

        return $this;
    }

    /**
     * Get appendText
     *
     * @return string
     */
    public function getAppendText()
    {
        return $this->appendText;
    }

    /**
     * Set imageUrlOne
     *
     * @param string $imageUrlOne
     *
     * @return Blog
     */
    public function setImageUrlOne($imageUrlOne)
    {
        $this->imageUrlOne = $imageUrlOne;

        return $this;
    }

    /**
     * Get imageUrlOne
     *
     * @return string
     */
    public function getImageUrlOne()
    {
        return $this->imageUrlOne;
    }

    /**
     * Set imageAltOne
     *
     * @param string $imageAltOne
     *
     * @return Blog
     */
    public function setImageAltOne($imageAltOne)
    {
        $this->imageAltOne = $imageAltOne;

        return $this;
    }

    /**
     * Get imageAltOne
     *
     * @return string
     */
    public function getImageAltOne()
    {
        return $this->imageAltOne;
    }

    /**
     * Set imageUrlTwo
     *
     * @param string $imageUrlTwo
     *
     * @return Blog
     */
    public function setImageUrlTwo($imageUrlTwo)
    {
        $this->imageUrlTwo = $imageUrlTwo;

        return $this;
    }

    /**
     * Get imageUrlTwo
     *
     * @return string
     */
    public function getImageUrlTwo()
    {
        return $this->imageUrlTwo;
    }

    /**
     * Set imageAltTwo
     *
     * @param string $imageAltTwo
     *
     * @return Blog
     */
    public function setImageAltTwo($imageAltTwo)
    {
        $this->imageAltTwo = $imageAltTwo;

        return $this;
    }

    /**
     * Get imageAltTwo
     *
     * @return string
     */
    public function getImageAltTwo()
    {
        return $this->imageAltTwo;
    }

    /**
     * Set imageUrlThree
     *
     * @param string $imageUrlThree
     *
     * @return Blog
     */
    public function setImageUrlThree($imageUrlThree)
    {
        $this->imageUrlThree = $imageUrlThree;

        return $this;
    }

    /**
     * Get imageUrlThree
     *
     * @return string
     */
    public function getImageUrlThree()
    {
        return $this->imageUrlThree;
    }

    /**
     * Set imageAltThree
     *
     * @param string $imageAltThree
     *
     * @return Blog
     */
    public function setImageAltThree($imageAltThree)
    {
        $this->imageAltThree = $imageAltThree;

        return $this;
    }

    /**
     * Get imageAltThree
     *
     * @return string
     */
    public function getImageAltThree()
    {
        return $this->imageAltThree;
    }

    /**
     * Set imageUrlFour
     *
     * @param string $imageUrlFour
     *
     * @return Blog
     */
    public function setImageUrlFour($imageUrlFour)
    {
        $this->imageUrlFour = $imageUrlFour;

        return $this;
    }

    /**
     * Get imageUrlFour
     *
     * @return string
     */
    public function getImageUrlFour()
    {
        return $this->imageUrlFour;
    }

    /**
     * Set imageAltFour
     *
     * @param string $imageAltFour
     *
     * @return Blog
     */
    public function setImageAltFour($imageAltFour)
    {
        $this->imageAltFour = $imageAltFour;

        return $this;
    }

    /**
     * Get imageAltFour
     *
     * @return string
     */
    public function getImageAltFour()
    {
        return $this->imageAltFour;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return Blog
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set fechaActualizacion
     *
     * @param \DateTime $fechaActualizacion
     *
     * @return Blog
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;

        return $this;
    }

    /**
     * Get fechaActualizacion
     *
     * @return \DateTime
     */
    public function getFechaActualizacion()
    {
        return $this->fechaActualizacion;
    }
}

