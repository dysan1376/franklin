<?php

namespace Franklin\PortadaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Servicio
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Servicio
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
     * @ORM\Column(name="slug_es", type="string", length=255)
     */
    private $slugEs;

    /**
     * @var string
     *
     * @ORM\Column(name="slug_en", type="string", length=255)
     */
    private $slugEn;

    /**
     * @var string
     *
     * @ORM\Column(name="slug_pt", type="string", length=255)
     */
    private $slugPt;

    /**
     * @var string
     *
     * @ORM\Column(name="slug_it", type="string", length=255)
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="subtitle", type="string", length=255)
     */
    private $subtitle;

    /**
     * @var string
     *
     * @ORM\Column(name="keywords", type="text")
     */
    private $keywords;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="paragraph_one", type="text")
     */
    private $paragraphOne;

    /**
     * @var string
     *
     * @ORM\Column(name="paragraph_two", type="text")
     */
    private $paragraphTwo;

    /**
     * @var string
     *
     * @ORM\Column(name="paragraph_three", type="text")
     */
    private $paragraphThree;

    /**
     * @var string
     *
     * @ORM\Column(name="paragraph_four", type="text")
     */
    private $paragraphFour;

    /**
     * @var string
     *
     * @ORM\Column(name="image_url_main", type="string", length=255)
     */
    private $imageUrlMain;

    /**
     * @var string
     *
     * @ORM\Column(name="image_alt_main", type="string", length=255)
     */
    private $imageAltMain;

    /**
     * @var string
     *
     * @ORM\Column(name="image_url_secondary", type="string", length=255)
     */
    private $imageUrlSecondary;

    /**
     * @var string
     *
     * @ORM\Column(name="image_alt_secondary", type="string", length=255)
     */
    private $imageAltSecondary;

    /**
     * @var string
     *
     * @ORM\Column(name="append_text", type="text")
     */
    private $appendText;

    /**
     * @var string
     *
     * @ORM\Column(name="mpn", type="string", length=255)
     */
    private $mpn;

    /**
     * @var string
     *
     * @ORM\Column(name="rating_value", type="string", length=10)
     */
    private $ratingValue;

    /**
     * @var string
     *
     * @ORM\Column(name="review_count", type="string", length=255)
     */
    private $reviewCount;

    /**
     * @var string
     *
     * @ORM\Column(name="price_min", type="string", length=255)
     */
    private $priceMin;

    /**
     * @var string
     *
     * @ORM\Column(name="price_max", type="string", length=255)
     */
    private $priceMax;

    /**
     * @var string
     *
     * @ORM\Column(name="currency", type="string", length=255)
     */
    private $currency;

    /**
     * @var string
     *
     * @ORM\Column(name="honorarios", type="string", length=255)
     */
    private $honorarios;


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
     * @return Servicio
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
     * @return Servicio
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
     * @return Servicio
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
     * @return Servicio
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
     * @return Servicio
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
     * @return Servicio
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
     * Set title
     *
     * @param string $title
     *
     * @return Servicio
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
     * @return Servicio
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
     * Set keywords
     *
     * @param string $keywords
     *
     * @return Servicio
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
     * Set description
     *
     * @param string $description
     *
     * @return Servicio
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
     * Set paragraphOne
     *
     * @param string $paragraphOne
     *
     * @return Servicio
     */
    public function setParagraphOne($paragraphOne)
    {
        $this->paragraphOne = $paragraphOne;

        return $this;
    }

    /**
     * Get paragraphOne
     *
     * @return string
     */
    public function getParagraphOne()
    {
        return $this->paragraphOne;
    }

    /**
     * Set paragraphTwo
     *
     * @param string $paragraphTwo
     *
     * @return Servicio
     */
    public function setParagraphTwo($paragraphTwo)
    {
        $this->paragraphTwo = $paragraphTwo;

        return $this;
    }

    /**
     * Get paragraphTwo
     *
     * @return string
     */
    public function getParagraphTwo()
    {
        return $this->paragraphTwo;
    }

    /**
     * Set paragraphThree
     *
     * @param string $paragraphThree
     *
     * @return Servicio
     */
    public function setParagraphThree($paragraphThree)
    {
        $this->paragraphThree = $paragraphThree;

        return $this;
    }

    /**
     * Get paragraphThree
     *
     * @return string
     */
    public function getParagraphThree()
    {
        return $this->paragraphThree;
    }

    /**
     * Set paragraphFour
     *
     * @param string $paragraphFour
     *
     * @return Servicio
     */
    public function setParagraphFour($paragraphFour)
    {
        $this->paragraphFour = $paragraphFour;

        return $this;
    }

    /**
     * Get paragraphFour
     *
     * @return string
     */
    public function getParagraphFour()
    {
        return $this->paragraphFour;
    }

    /**
     * Set imageUrlMain
     *
     * @param string $imageUrlMain
     *
     * @return Servicio
     */
    public function setImageUrlMain($imageUrlMain)
    {
        $this->imageUrlMain = $imageUrlMain;

        return $this;
    }

    /**
     * Get imageUrlMain
     *
     * @return string
     */
    public function getImageUrlMain()
    {
        return $this->imageUrlMain;
    }

    /**
     * Set imageAltMain
     *
     * @param string $imageAltMain
     *
     * @return Servicio
     */
    public function setImageAltMain($imageAltMain)
    {
        $this->imageAltMain = $imageAltMain;

        return $this;
    }

    /**
     * Get imageAltMain
     *
     * @return string
     */
    public function getImageAltMain()
    {
        return $this->imageAltMain;
    }

    /**
     * Set imageUrlSecondary
     *
     * @param string $imageUrlSecondary
     *
     * @return Servicio
     */
    public function setImageUrlSecondary($imageUrlSecondary)
    {
        $this->imageUrlSecondary = $imageUrlSecondary;

        return $this;
    }

    /**
     * Get imageUrlSecondary
     *
     * @return string
     */
    public function getImageUrlSecondary()
    {
        return $this->imageUrlSecondary;
    }

    /**
     * Set imageAltSecondary
     *
     * @param string $imageAltSecondary
     *
     * @return Servicio
     */
    public function setImageAltSecondary($imageAltSecondary)
    {
        $this->imageAltSecondary = $imageAltSecondary;

        return $this;
    }

    /**
     * Get imageAltSecondary
     *
     * @return string
     */
    public function getImageAltSecondary()
    {
        return $this->imageAltSecondary;
    }

    /**
     * Set appendText
     *
     * @param string $appendText
     *
     * @return Servicio
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
     * Set mpn
     *
     * @param string $mpn
     *
     * @return Servicio
     */
    public function setMpn($mpn)
    {
        $this->mpn = $mpn;

        return $this;
    }

    /**
     * Get mpn
     *
     * @return string
     */
    public function getMpn()
    {
        return $this->mpn;
    }

    /**
     * Set ratingValue
     *
     * @param string $ratingValue
     *
     * @return Servicio
     */
    public function setRatingValue($ratingValue)
    {
        $this->ratingValue = $ratingValue;

        return $this;
    }

    /**
     * Get ratingValue
     *
     * @return string
     */
    public function getRatingValue()
    {
        return $this->ratingValue;
    }

    /**
     * Set reviewCount
     *
     * @param string $reviewCount
     *
     * @return Servicio
     */
    public function setReviewCount($reviewCount)
    {
        $this->reviewCount = $reviewCount;

        return $this;
    }

    /**
     * Get reviewCount
     *
     * @return string
     */
    public function getReviewCount()
    {
        return $this->reviewCount;
    }

    /**
     * Set priceMin
     *
     * @param string $priceMin
     *
     * @return Servicio
     */
    public function setPriceMin($priceMin)
    {
        $this->priceMin = $priceMin;

        return $this;
    }

    /**
     * Get priceMin
     *
     * @return string
     */
    public function getPriceMin()
    {
        return $this->priceMin;
    }

    /**
     * Set priceMax
     *
     * @param string $priceMax
     *
     * @return Servicio
     */
    public function setPriceMax($priceMax)
    {
        $this->priceMax = $priceMax;

        return $this;
    }

    /**
     * Get priceMax
     *
     * @return string
     */
    public function getPriceMax()
    {
        return $this->priceMax;
    }

    /**
     * Set currency
     *
     * @param string $currency
     *
     * @return Servicio
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set honorarios
     *
     * @param string $honorarios
     *
     * @return Servicio
     */
    public function setHonorarios($honorarios)
    {
        $this->honorarios = $honorarios;

        return $this;
    }

    /**
     * Get honorarios
     *
     * @return string
     */
    public function getHonorarios()
    {
        return $this->honorarios;
    }
}

