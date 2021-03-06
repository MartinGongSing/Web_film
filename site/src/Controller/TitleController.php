<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Film;
use App\Entity\Thema;
use App\Repository\FilmRepository;
use App\Repository\ThemaRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
            'title' => "Bienvenue",
        ]);
    }

    /**
     * @Route("/thema", name="thema")
     */
    public function theme(ThemaRepository $reposi): Response
    {
        $themas=$reposi->findAll();

        return $this->render('title/theme.html.twig', [
            'title' => "Theme Page",
            'themas' => $themas
        ]);
    }

    /**
     * @Route("/title/new", name="title_create")
     * @Route("/title/{id}/edit", name="film_edit")
     */
    public function form(Film $film = null, Request $request, ManagerRegistry $manager) {         //, ObjectManager $manager
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
                    ->add('Thema', EntityType::class, [
                        'class' => Thema ::class,
                        'choice_label' => 'name',
                    ])
                    ->getForm();
        $form->handleRequest($request); 

        // dump($film);
        if($form->isSubmitted() && $form->isValid()){

            // $manager->persist($film);
            // $manager->flush();

            $em = $manager->getManager();
            $em->persist($film);
            $em->flush();

            return $this->redirectToRoute('title');
        }


        return $this->render('title/create.html.twig', [
            'formFilm' => $form ->createView(),
            'editMode' => $film->getId() !== null
        ]);

    }







    /**
     * @Route("/thema/newth", name="thema_create")
     * @Route("/thema/{id}/edit", name="thema_edit")
     */
    public function Tform(Thema $thema = null, Request $request, ManagerRegistry $manager) {         //
        if(!$thema){
              $thema = new thema();
        }
      
        $Tform = $this->createFormBuilder($thema)
        // rajouter les attributs (ce qui est dans les cases en grisé)    
                    ->add('name', TextType::class,[
                        'attr' => [
                            'placeholder' => "Nom du thème",
                        ]
                    ])
                    ->getForm();
        $Tform->handleRequest($request); 

        // dump($thema);
        if($Tform->isSubmitted() && $Tform->isValid()){

            // $manager->persist($thema);
            // $manager->flush();

            $em = $manager->getManager();
            $em->persist($thema);
            $em->flush();

            return $this->redirectToRoute('thema');
        }


        return $this->render('thema/newth.html.twig', [
            'formThema' => $Tform ->createView(),
            'editModeT' => $thema->getId() !== null
        ]);

    }



    /**
     * @Route("/search", name="search")
     */
    public function search(){
        $formSea = $this -> createFormBuilder(null)
            ->add('Recherche', TextType::class)
            ->add('search', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
        ->getForm();

      

        return $this->render('search/searchBar.html.twig', [
            'formSearch' => $formSea->createView()
        ]);
    }



    /**
     * @Route("/search2", name="handleSearch")
     */
    public function handleSearch(Request $requestSea)
    {
        var_dump($requestSea->request);
        die();

        // $formSea->handleRequest($requestSea); 
    }
    

}
