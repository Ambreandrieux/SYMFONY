<?php

namespace App\Entity;

use App\Repository\BrandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

// "#" attribu
// entity : déclare la structure de la table
// repository : déclare des requêtes
#[ORM\Entity(repositoryClass: BrandRepository::class)]
// j'ai besoin d'un cycle de vie
// action sur type brand effectuer action entité brand (pré updated, pré presiste, post presiste)
// vérifier dans le code car il y a une fonction
// automatisation createdAt & updatedAt
#[ORM\HasLifecycleCallbacks]
class Brand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\Length(min: 3, max: 50)]
    private ?string $name = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'brand', targetEntity: Product::class, orphanRemoval: true)]
    private Collection $products;
	
	// avant d'insérer
	// définir les valeurs date de création, date de mise à jour
	// AUTOMATISATION
    #[ORM\PrePersist]
    // ": void" = renvoie rien
    public function prePersist(): void
    {
	    // "DateTimeImmutable" = changera jamais, avoir un référenciel unique (fuseau horaire)
	    // EX : toutes les heures stocké dans les heures de Paris
	    $now = new \DateTimeImmutable();
        $this
            ->setCreatedAt($now)
            ->setUpdatedAt($now);
    }

    #[ORM\PreUpdate]
    public function preUpdate(): void
    {
        $this->setUpdatedAt(new \DateTimeImmutable());
    }
	// AUTOMATISATION
	
    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): static
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->setBrand($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): static
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getBrand() === $this) {
                $product->setBrand(null);
            }
        }

        return $this;
    }
}
