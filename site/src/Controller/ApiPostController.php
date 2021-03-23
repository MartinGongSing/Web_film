<?php

namespace App\Controller;

use App\Repository\FilmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ApiPostController extends AbstractController
{
    /**
     * @Route("/api/post", name="api_post_index", methods={"GET"})
     */
    public function index(FilmRepository $repo): Response
    {

        return $this->json($repo->findAll(), 200,[],['groups'=> 'post:read']);
        // $films=$repo->findAll();

        //dd($film);

        // $filmsNormalises = $normalizer->normalize($films, null, ['groups' => 'film:read']);
        // $json = json_encode($filmsNormalises);

        // // dd($json, $films);

        // $response = new Response($json, 200, [
        //     "Content-Type" => "application/json"
        // ]);

        // return $response;

    }

    /**
     * @Route("/api/post", name="stor", methods={"POST"})
     */
    public function store(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $validator)//: Response
    {
        $jsonRecu = $request->getContent();

        // dd($jsonRecu)

        try{
            $post = $serializer->deserialize($jsonRecu, Post::class, 'json');
            $post->setCreatedAt(new \DateTime());
            $errors =$validator->validate($post);

            if (count($errors) > 0){
                return $this->json($errors, 400)
            }

            $em->persist($post);
            $em->flush();

            return $this->json($post, 201, [], ['groups'=>'post:read']);

        } catch(NotEncodableValueException $e){ 
            return $this->json([
                'status'=>400,
                'message'=>$e->getMessage()
            ],400);
        }
    }
}