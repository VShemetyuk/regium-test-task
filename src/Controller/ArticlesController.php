<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route(path="/articles/list", name="articles.list", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function list(Request $request): Response
    {
        $categoryId = (int) $request->get('category');
        $category = $this->em->getRepository(Category::class)->find($categoryId);
        if (!$category) {
            return new Response('category is not found', 404);
        }

        $articles = $this->em->getRepository(Article::class)->getByCategory($category);
        if (!$articles) {
            return new Response('end');
        }

        return $this->json($articles, 200, [], [
            'groups' => ['default']
        ]);
    }
}
