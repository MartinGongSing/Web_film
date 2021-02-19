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
            'title' => 'Title Page',
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        return $this->render('title/home.html.twig',[
            'title' => "Home Page",
        ]);
    }

    /**
     * @Route("/theme", name="theme")
     */
    public function theme(): Response
    {
        return $this->render('title/theme.html.twig', [
            'title' => "Theme Page"
        ]);
    }
}
