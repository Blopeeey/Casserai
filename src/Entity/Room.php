<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoomRepository")
 * @Vich\Uploadable
 */
class Room
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    public $id;
    public function __toString()
    {
        return (string) $this->getId();
    }
    /**
     * @ORM\Column(type="string", length=255)
     */
    public $room_name;

    /**
     * @ORM\Column(type="float")
     */
    public $room_price;

    /**
     * @ORM\Column(type="integer")
     */
    public $room_person_amount;

    /**
     * @ORM\Column(type="boolean")
     */
    private $availability;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoomName(): ?string
    {
        return $this->room_name;
    }

    public function setRoomName(string $room_name): self
    {
        $this->room_name = $room_name;

        return $this;
    }

    public function getRoomPrice(): ?float
    {
        return $this->room_price;
    }

    public function setRoomPrice(float $room_price): self
    {
        $this->room_price = $room_price;

        return $this;
    }

    public function getRoomPersonAmount(): ?int
    {
        return $this->room_person_amount;
    }

    public function setRoomPersonAmount(int $room_person_amount): self
    {
        $this->room_person_amount = $room_person_amount;

        return $this;
    }

    public function getAvailability(): ?bool
    {
        return $this->availability;
    }

    public function setAvailability(bool $availability): self
    {
        $this->availability = $availability;

        return $this;
    }
    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="room", fileNameProperty="imageName", size="imageSize")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    private $imageSize;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="integer")
     */
    public $room_number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $room_description;

    /**
     * @ORM\Column(type="boolean")
     */
    public $is_popular;
    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

//    public function __toString()
//    {
//        return $this->id;
//    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

    public function getRoomNumber(): ?int
    {
        return $this->room_number;
    }

    public function setRoomNumber(int $room_number): self
    {
        $this->room_number = $room_number;

        return $this;
    }

    public function getRoomDescription(): ?string
    {
        return $this->room_description;
    }

    public function setRoomDescription(string $room_description): self
    {
        $this->room_description = $room_description;

        return $this;
    }

    public function getIsPopular(): ?bool
    {
        return $this->is_popular;
    }

    public function setIsPopular(bool $is_popular): self
    {
        $this->is_popular = $is_popular;

        return $this;
    }
}
