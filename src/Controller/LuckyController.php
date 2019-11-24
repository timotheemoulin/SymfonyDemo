<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LuckyController
 * @Route("/lucky")
 * @package App\Controller
 */
class LuckyController extends AbstractController
{
    /**
     * Return a random number.
     * Route "number" defined in config/routes.yaml
     * @return Response
     */
    public function number()
    {
        try {
            $number = random_int(0, 999999);
        } catch (\Exception $exception) {
            $number = 0;
        }
        
        return $this->render(
            'lucky/random.html.twig',
            [
                'random' => str_pad($number, 6, 0, STR_PAD_LEFT),
            ]
        );
    }
    
    /**
     * Return a random string.
     * If you want to use annotations to define your routes, you need to require the annotations package.
     *   $ composer require annotations
     * @Route("/string/{number}", methods={"GET"}, requirements={"number"="\d+"} )
     * @param int $number
     * @return Response
     */
    public function string(int $number = 5)
    {
        $strings = (function () use ($number) {
            $strings = [];
            for ($i = 0; $i < $number; $i++) {
                
                $strings[] = (function () {
                    $string = '';
                    for ($i = 0; $i < 6; $i++) {
                        $string .= substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), -1);
                    }
                    
                    return strtoupper($string);
                })();
            }
            
            return $strings;
        })();
        
        return $this->render(
            'lucky/random-loop.html.twig',
            [
                'randoms' => $strings,
                'url' => $this->generateUrl('app_lucky_number'),
            ]
        );
    }
}