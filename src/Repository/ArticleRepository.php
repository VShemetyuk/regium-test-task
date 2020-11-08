<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Category;
use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository
{
    public function getByCategory(Category $category): array
    {
        $qb = $this->createQueryBuilder('article');

        $qb->andWhere('article.category = :category');
        $qb->setParameter('category', $category);

        $qb->addOrderBy('article.id', 'DESC');
        $qb->setMaxResults(5);

        return $qb->getQuery()->getResult();
    }
}