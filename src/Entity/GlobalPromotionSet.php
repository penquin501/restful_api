<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GlobalPromotionSet
 *
 * @ORM\Table(name="global_promotion_set")
 * @ORM\Entity
 */
class GlobalPromotionSet
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=250, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    public function getId(): ?string
    {
        return $this->id;
    }


}
