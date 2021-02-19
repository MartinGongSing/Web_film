<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TitleController extends AbstractController
{
    /**
     * @Route("/title", name="title")
     */
    public function index(): Response
    {
        return $this->render('title/index.html.twig', [
            'controller_name' => 'TitleController',
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home(){
        return $this->render('title/home.html.twig');
    }
}
