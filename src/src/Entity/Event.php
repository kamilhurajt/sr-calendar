<?php

namespace Sr\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event", indexes={@ORM\Index(name="start_date_key", columns={"start_date"}), @ORM\Index(name="user_password_key", columns={"user_password"})})
 * @ORM\Entity
 */
class Event
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", length=0, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="user_password", type="string", length=255, nullable=false)
     */
    private $userPassword;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetime", nullable=false)
     */
    private $startDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $updatedAt = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=false)
     */
    private $city;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getUserPassword(): string
    {
        return $this->userPassword;
    }

    /**
     * @return \DateTime
     */
    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param int $id
     */
    protected function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $name
     */
    protected function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string|null $description
     */
    protected function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param string $userPassword
     */
    protected function setUserPassword(string $userPassword): void
    {
        $this->userPassword = $userPassword;
    }

    /**
     * @param \DateTime $startDate
     */
    protected function setStartDate(\DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @param string $city
     */
    protected function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @param string $name
     * @param string $city
     * @param string $startDate
     * @param string $userPassword
     * @param string|null $description
     * @return Event
     * @throws \Exception
     */
    public static function create(
        string $name,
        string $city,
        string $startDate,
        string $userPassword,
        string $description = null
    ) {
        $entity = new self();
        $entity->setCity($city);
        $entity->setName($name);
        $entity->setStartDate(new \DateTime($startDate));
        $entity->setUserPassword($userPassword);
        $entity->setDescription($description);

        return $entity;
    }

    /**
     * @param int $id
     * @param string $name
     * @param string $city
     * @param string $startDate
     * @param string $userPassword
     * @param string|null $description
     * @return Event
     * @throws \Exception
     */
    public static function createForUpdate(
        int $id,
        string $name,
        string $city,
        string $startDate,
        string $userPassword,
        string $description = null
    ) {
        $entity = new self();
        $entity->setId($id);
        $entity->setCity($city);
        $entity->setName($name);
        $entity->setStartDate(new \DateTime($startDate));
        $entity->setUserPassword($userPassword);
        $entity->setDescription($description);

        return $entity;
    }
}
