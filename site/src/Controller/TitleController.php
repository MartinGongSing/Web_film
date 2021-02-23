<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Film;
use App\Repository\FilmRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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

    /**
     * @Route("/title/new", name="title_create")
     * @Route("/title/{id}/edit", name="film_edit")
     */
    public function form(Film $film = null, Request $request) {         //, ObjectManager $manager
        if(!$film){
              $film = new Film();
        }
      
        $form = $this->createFormBuilder($film)
        // rajouter les attributs (ce qui est dans les cases en grisé)
                    ->add('Number', NumberType::class, [
                        'attr' => [
                            'placeholder' => "Numéro de classement",
                        ]
                    ])            
                    ->add('Title', TextType::class,[
                        'attr' => [
                            'placeholder' => "Titre du film",
                        ]
                    ])
                    ->add('Theme', ChoiceType::class,[
                        'choices' => [ 
                            'Acteurs Français' => 'Acteurs Français',
                            'Acteurs Etrangers' => 'Acteurs Etrangers',
                            'Musical' => 'Musical',
                            'Documentaire' => 'Documentaire',
                            'Western' => 'Western',
                            'AUTRE' => 'Autre',
                        ]
                    ],
                    )
                    ->add('Actor', TextType::class,[
                        'attr' => [
                            'placeholder' => "Acteur principal",
                        ]
                    ])
                    ->add('Year', NumberType::class, [
                        'attr' => [
                            'placeholder' => "Année de sortie",
                        ]
                    ])
                    ->add('Prop', TextType::class,[
                        'attr' => [
                            'placeholder' => "Propriétaire du film",
                        ]
                    ])
                    ->add('Info', TextareaType::class,[
                        'attr' => [
                            'placeholder' => "Information sur le film",
                        ]
                    ])
                    ->getForm();
        $form->handleRequest($request); 

        // dump($film);
        if($form->isSubmitted() && $form->isValid()){

            // $manager->persist($film);
            // $manager->flush();

            return $this->redirectToRoute('title');
        }


        return $this->render('title/create.html.twig', [
            'formFilm' => $form ->createView(),
            'editMode' => $film->getId() !== null
        ]);

    }
}
