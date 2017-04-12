<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Question
 *
 * @ORM\Entity
 * @ORM\Table(name="question")
 */
class Question
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
     * @ORM\Column(name="question", type="string", length=255)
     */
    private $question;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_at", type="datetime")
     */
    private $publishedAt;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Choice", mappedBy="question", cascade={"persist","remove"})
     */
    private $choices;


    public function __construct()
    {
        $this->choices = new ArrayCollection();
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
     * Set question
     *
     * @param string $question
     * @return Question
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     * @return Question
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * Get publishedAt
     *
     * @return \DateTime 
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * Set choices
     *
     * @param ArrayCollection $choices
     * @return Question
     */
    public function setChoices($choices)
    {
        $this->choices = $choices;

        return $this;
    }

    /**
     * Add choice
     *
     * @param string $value
     * @return Question
     */
    public function addChoice($value)
    {
        $choice = new Choice();

        $choice->setValue($value)
               ->setCount(0)
               ->setQuestion($this);

        $this->choices->add($choice);

        return $this;
    }

    /**
     * Get choices
     *
     * @return ArrayCollection 
     */
    public function getChoices()
    {
        return $this->choices;
    }

    public function toArray()
    {
        $choices = [];

        foreach ($this->choices as $choice) {
            $choices[] = $choice->toArray();
        }

        return [
            'question' => $this->question,
            'published_at' => $this->publishedAt->format('c'),
            'choices' => $choices,
        ];
    }
}
