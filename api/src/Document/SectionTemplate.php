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
#[ODM\Document(collection: 'section_templates')]
#[ODM\HasLifecycleCallbacks]
class SectionTemplate
{
    #[ODM\Id]
    public ?string $id = null;

    #[ODM\Field(type: 'string')]
    public string $name;

	#[ODM\Field(type: 'string')]
	public string $description;

	#[ODM\Field(type: 'string')]
	public ?string $template_file = null;

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

	public function getDescription(): string {
		return $this->description;
	}

	public function setDescription( string $description ): void {
		$this->description = $description;
	}

	public function getTemplateFile(): ?string {
		return $this->template_file;
	}

	public function setTemplateFile( ?string $template_file ): void {
		$this->template_file = $template_file;
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
