<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="\App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public int $id;

    /**
     * @Groups({"default"})
     * @ORM\Column()
     */
    public string $title;

    /**
     * @Groups({"default"})
     * @ORM\Column(type="text")
     */
    public string $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category")
     * @ORM\JoinColumn(nullable = false)
     */
    public Category $category;

    /**
     * @Groups({"default"})
     * @ORM\Column()
     */
    public string $image;
}