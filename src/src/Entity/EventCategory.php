<?php

namespace Sr\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventCategory
 *
 * @ORM\Table(name="event_category", indexes={@ORM\Index(name="event_to_category_key", columns={"event_id"}), @ORM\Index(name="category_to_event_key", columns={"category_id"})})
 * @ORM\Entity
 */
class EventCategory
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var \Category
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    private $category;

    /**
     * @var \Event
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Event")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     * })
     */
    private $event;

    /**
     * @return \Category
     */
    public function getCategory(): \Category
    {
        return $this->category;
    }

    /**
     * @param \Category $category
     */
    public function setCategory(\Category $category): void
    {
        $this->category = $category;
    }

    /**
     * @return \Event
     */
    public function getEvent(): \Event
    {
        return $this->event;
    }

    /**
     * @param \Event $event
     */
    public function setEvent(\Event $event): void
    {
        $this->event = $event;
    }
}
