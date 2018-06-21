<?php

namespace Franklin\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Blog
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
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
     * @ORM\Column(name="keywords", type="text", nullable=true)
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
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text", nullable=true)
     */
    private $text;

    /**
     * @var string
     *
     * @ORM\Column(name="append_text", type="text", nullable=true)
     */
    private $appendText;

    /**
     * @ORM\Column(name="cover", type="string", nullable=true)
     *
     * @Assert\File(mimeTypes={ "image/jpg", "image/jpeg", "image/png" })
     * @Assert\File(maxSize="6000000")
     */
    private $cover;

    /**
     * @var string
     *
     * @ORM\Column(name="alt_cover", type="string", length=255, nullable=true)
     */
    private $altCover;

    /**
     * @ORM\Column(name="background", type="string", nullable=true)
     *
     * @Assert\File(mimeTypes={ "image/jpg", "image/jpeg", "image/png" })
     * @Assert\File(maxSize="6000000")
     */
    private $background;

    /**
     * @var string
     *
     * @ORM\Column(name="alt_background", type="string", length=255, nullable=true)
     */
    private $altBackground;

    /**
     * @ORM\Column(name="first", type="string", nullable=true)
     *
     * @Assert\File(mimeTypes={ "image/jpg", "image/jpeg", "image/png" })
     * @Assert\File(maxSize="6000000")
     */
    private $first;

    /**
     * @var string
     *
     * @ORM\Column(name="alt_first", type="string", length=255, nullable=true)
     */
    private $altFirst;

    /**
     * @ORM\Column(name="second", type="string", nullable=true)
     *
     * @Assert\File(mimeTypes={ "image/jpg", "image/jpeg", "image/png" })
     * @Assert\File(maxSize="6000000")
     */
    private $second;

    /**
     * @var string
     *
     * @ORM\Column(name="alt_second", type="string", length=255, nullable=true)
     */
    private $altSecond;

    /**
     * @ORM\Column(name="third", type="string", nullable=true)
     *
     * @Assert\File(mimeTypes={ "image/jpg", "image/jpeg", "image/png" })
     * @Assert\File(maxSize="6000000")
     */
    private $third;

    /**
     * @var string
     *
     * @ORM\Column(name="alt_third", type="string", length=255, nullable=true)
     */
    private $altThird;

    /**
     * @var string
     *
     * @ORM\Column(name="youtube_video_link", type="string", length=255, nullable=true)
     */
    private $youtubeVideoLink;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="datetime")
     */
    private $fechaCreacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_actualizacion", type="datetime", nullable=true, nullable=true)
     */
    private $fechaActualizacion;


    public function removeFiles($folder, $file)
    {
        $file_path = __DIR__.'/../../../../web/uploads/posts/'.$folder.'/'.$file;
        if(file_exists($file_path)) unlink($file_path);
    }

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
     * Set cover
     *
     * @param string $cover
     *
     * @return Blog
     */
    public function setCover($cover)
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * Get cover
     *
     * @return string
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * Set altCover
     *
     * @param string $altCover
     *
     * @return Blog
     */
    public function setAltCover($altCover)
    {
        $this->altCover = $altCover;

        return $this;
    }

    /**
     * Get altCover
     *
     * @return string
     */
    public function getAltCover()
    {
        return $this->altCover;
    }

    /**
     * Set background
     *
     * @param string $background
     *
     * @return Blog
     */
    public function setBackground($background)
    {
        $this->background = $background;

        return $this;
    }

    /**
     * Get background
     *
     * @return string
     */
    public function getBackground()
    {
        return $this->background;
    }

    /**
     * Set altBackground
     *
     * @param string $altBackground
     *
     * @return Blog
     */
    public function setAltBackground($altBackground)
    {
        $this->altBackground = $altBackground;

        return $this;
    }

    /**
     * Get altBackground
     *
     * @return string
     */
    public function getAltBackground()
    {
        return $this->altBackground;
    }

    /**
     * Set first
     *
     * @param string $first
     *
     * @return Blog
     */
    public function setFirst($first)
    {
        $this->first = $first;

        return $this;
    }

    /**
     * Get first
     *
     * @return string
     */
    public function getFirst()
    {
        return $this->first;
    }

    /**
     * Set altFirst
     *
     * @param string $altFirst
     *
     * @return Blog
     */
    public function setAltFirst($altFirst)
    {
        $this->altFirst = $altFirst;

        return $this;
    }

    /**
     * Get altFirst
     *
     * @return string
     */
    public function getAltFirst()
    {
        return $this->altFirst;
    }

    /**
     * Set second
     *
     * @param string $second
     *
     * @return Blog
     */
    public function setSecond($second)
    {
        $this->second = $second;

        return $this;
    }

    /**
     * Get second
     *
     * @return string
     */
    public function getSecond()
    {
        return $this->second;
    }

    /**
     * Set altSecond
     *
     * @param string $altSecond
     *
     * @return Blog
     */
    public function setAltSecond($altSecond)
    {
        $this->altSecond = $altSecond;

        return $this;
    }

    /**
     * Get altSecond
     *
     * @return string
     */
    public function getAltSecond()
    {
        return $this->altSecond;
    }

    /**
     * Set third
     *
     * @param string $third
     *
     * @return Blog
     */
    public function setThird($third)
    {
        $this->third = $third;

        return $this;
    }

    /**
     * Get third
     *
     * @return string
     */
    public function getThird()
    {
        return $this->third;
    }

    /**
     * Set altThird
     *
     * @param string $altThird
     *
     * @return Blog
     */
    public function setAltThird($altThird)
    {
        $this->altThird = $altThird;

        return $this;
    }

    /**
     * Get altThird
     *
     * @return string
     */
    public function getAltThird()
    {
        return $this->altThird;
    }

    /**
     * Set youtubeVideoLink
     *
     * @param string $youtubeVideoLink
     *
     * @return Blog
     */
    public function setYoutubeVideoLink($youtubeVideoLink)
    {
        $this->youtubeVideoLink = $youtubeVideoLink;

        return $this;
    }

    /**
     * Get youtubeVideoLink
     *
     * @return string
     */
    public function getYoutubeVideoLink()
    {
        return $this->youtubeVideoLink;
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

