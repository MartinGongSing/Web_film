<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Film;
use App\Repository\FilmRepository;

class TitleController extends AbstractController
{
    /**
     * @Route("/title", name="title")
     */
    public function index(FilmRepository $repo ): Response
    {
        $films=$repo->findAll();

        return $this->render('title/index.html.twig', [
            'title' => 'Title Page',
            'films' => $films
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
