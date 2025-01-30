<?php

declare(strict_types=1);

namespace App\Document;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;

#[ApiResource]
#[ODM\EmbeddedDocument()]
#[ODM\HasLifecycleCallbacks]
class Section
{
    #[ODM\Id]
    public ?string $id = null;

	#[ReferenceOne(Report::class)]
	public ?Report $report = null;

    #[ODM\Field(type: 'string')]
    public string $name;

	#[ODM\Field(type: 'string')]
	public string $template;

	#[ODM\Field(type: 'string')]
	public string $description;

    #[ODM\Field(type: 'integer')]
    public int $order;

	#[ODM\Field(type: 'string')]
	public ?string $content = null;

	#[ODM\Field(type: 'collection')]
	public Collection $images;

	#[ODM\Field(type: 'date')]
	private \DateTime $createdAt;

	#[ODM\Field(type: 'date')]
	private \DateTime $updatedAt;

	public function getId(): ?string {
		return $this->id;
	}

	public function getName(): string {
		return $this->name;
	}

	public function setName( string $name ): void {
		$this->name = $name;
	}

	public function getTemplate(): string {
		return $this->template;
	}

	public function setTemplate( string $template ): void {
		$this->template = $template;
	}

	public function getDescription(): string {
		return $this->description;
	}

	public function setDescription( string $description ): void {
		$this->description = $description;
	}

	public function getOrder(): int {
		return $this->order;
	}

	public function setOrder( int $order ): void {
		$this->order = $order;
	}

	public function getContent(): ?string {
		return $this->content;
	}

	public function setContent( ?string $content ): void {
		$this->content = $content;
	}

	public function getImages(): Collection {
		return $this->images;
	}

	public function setImages( Collection $images ): void {
		$this->images = $images;
	}

	public function getCreatedAt(): \DateTime {
		return $this->createdAt;
	}

	public function getUpdatedAt(): \DateTime {
		return $this->updatedAt;
	}

	#[ODM\PrePersist]
	public function prePersist(): void {
		$this->createdAt = new \DateTime();
	}

	#[ODM\PreUpdate]
	public function preUpdate(): void {
		$this->updatedAt = new \DateTime();
	}
}
