<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends AbstractController
{
    /**
     * Redirect the index to a lucky route.
     * @Route("/")
     */
    public function homepage()
    {
        return $this->redirectToRoute('app_lucky_number');
    }
}