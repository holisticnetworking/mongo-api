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
#[ODM\Document(collection: 'states')]
#[ODM\HasLifecycleCallbacks]
class State
{
	#[ODM\Id]
	public ?string $id = null;

	#[ODM\Field(type: 'string')]
	public string $name;

	#[ODM\Field(type: 'string')]
	public string $abbr;

	#[ODM\Field(type: 'string')]
	public string $img;

	#[ODM\Field(type: 'date')]
	private \DateTime $createdAt;

	#[ODM\Field(type: 'date')]
	private \DateTime $updatedAt;

	public function getName(): string {
		return $this->name;
	}

	public function setName( string $name ): void {
		$this->name = $name;
	}

	public function getAbbr(): string {
		return $this->abbr;
	}

	public function setAbbr( string $abbr ): void {
		$this->abbr = $abbr;
	}

	public function getImg(): string {
		return $this->img;
	}

	public function setImg( string $img ): void {
		$this->img = $img;
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
