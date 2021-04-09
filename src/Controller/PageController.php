<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class PageController extends AbstractController
{
    /**
     * @Route("/home", name="homepage")
     */
    public function home()
    {
        return $this->render('home.html.twig');
    }

    /**
     * @Route("/apropos", name="about")
     */
    public function about()
    {
        return $this->render('apropos.html.twig');
    }

}