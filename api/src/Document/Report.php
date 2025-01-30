<?php

declare(strict_types=1);

namespace App\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use App\Document\State;
use App\Document\Partner;

#[ODM\Document(collection: 'reports')]
#[ODM\HasLifecycleCallbacks]
class Report
{
    #[ODM\Id]
    public ?string $id = null;

    #[ODM\Field(type: 'string')]
    public string $name;

    #[ODM\Field(type: 'string')]
    public string $date;

    #[ODM\Field(type: 'string')]
    public string $author;

	#[ODM\Field(type: 'string')]
	public string $report_type;

	#[ODM\Field(type: 'string')]
	public string $description;

	#[ODM\Field(type: 'string')]
	public string $dews_region;

	#[ODM\Field(type: 'string')]
	public string $climate_region;

	#[ODM\ReferenceMany(targetDocument: State::class)]
	#[ODM\Index(keys: ['name'])]

	public ArrayCollection $states;

	#[ODM\ReferenceMany(targetDocument: Partner::class)]
	public ArrayCollection $partners;

	#[ODM\EmbedMany(targetDocument: Section::class)]
	#[ODM\Index(keys: ['order'])]
	public ArrayCollection $sections;

	#[ODM\Field(type: 'date')]
	private \DateTime $createdAt;

	#[ODM\Field(type: 'date')]
	private \DateTime $updatedAt;

	public function __construct()
	{
		$this->sections = new ArrayCollection();
		$this->partners = new ArrayCollection();
		$this->states = new ArrayCollection();
	}

	public function getName(): string {
		return $this->name;
	}

	public function setName( string $name ): void {
		$this->name = $name;
	}

	public function getDate(): string {
		return $this->date;
	}

	public function setDate( string $date ): void {
		$this->date = $date;
	}

	public function getAuthor(): string {
		return $this->author;
	}

	public function setAuthor( string $author ): void {
		$this->author = $author;
	}

	public function getReportType(): string {
		return $this->report_type;
	}

	public function setReportType( string $report_type ): void {
		$this->report_type = $report_type;
	}

	public function getDescription(): string {
		return $this->description;
	}

	public function setDescription( string $description ): void {
		$this->description = $description;
	}

	public function getDewsRegion(): string {
		return $this->dews_region;
	}

	public function setDewsRegion( string $dews_region ): void {
		$this->dews_region = $dews_region;
	}

	public function getClimateRegion(): string {
		return $this->climate_region;
	}

	public function setClimateRegion( string $climate_region ): void {
		$this->climate_region = $climate_region;
	}

	public function getStates(): Collection {
		return $this->states;
	}

	public function addState(State $state): void { $this->states[] = $state; }

	public function getPartners(): Collection {
		return $this->partners;
	}

	public function addPartner(Partner $partner): void { $this->partners[] = $partner; }

	public function getSections(): Collection {
		return $this->sections;
	}

	public function addSection(Section $section): void { $this->sections[] = $section; }

	public function getCreatedAt(): \DateTime {
		return $this->createdAt;
	}

	public function getUpdatedAt(): \DateTime {
		return $this->updatedAt;
	}

	#[ODM\PrePersist]
	public function prePersist(): void {
		$this->createdAt = new \DateTime();
		for($x=0; $x<5; $x++) {
			$testSection = new Section();
			$testSection->setName('Test Section ' . $x);
			$testSection->setDescription('Test Section');
			$testSection->setContent(substr(md5(date('Y-m-d', time())), 0, 100));
			$testSection->setOrder(rand(1,5));
			$this->sections->add($testSection);
		}
	}

	#[ODM\PreUpdate]
	public function preUpdate(): void {
		$this->updatedAt = new \DateTime();
	}
}