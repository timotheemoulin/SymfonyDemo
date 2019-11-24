<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class ArticleController
 * @Route("/articles")
 * @package App\Controller
 */
class ArticleController extends AbstractController
{
    /**
     * Fetch all the articles and return them as a JSON collection.
     * Serialization is done thanks to the symfony/serializer.
     * @Route("/")
     */
    public function c_get()
    {
        $articlesCollection = $this->getDoctrine()->getRepository(Article::class)->findAll();
    
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getId();
            },
        ];
        
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer(null, null, null, null, null, null, $defaultContext)];
        $serializer = new Serializer($normalizers, $encoders);
        
        $articles = (function () use ($articlesCollection, $serializer)
        {
            $articles = [];
            foreach ($articlesCollection as $article)
            {
                $articles[] = $serializer->normalize($article, 'json');
            }
            
            return $articles;
        })();
        
        return new JsonResponse($articles);
    }
}