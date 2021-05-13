<?php

namespace App\Controller;

use App\Entity\Film;
use App\Repository\FilmRepository;
use App\Repository\ThemaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;











class ApiPostController extends AbstractController
{
    /**
     * @Route("/api/film", name="api_post_index", methods={"GET"})
     */
    public function index(FilmRepository $repo): Response
    {

        return $this->json($repo->findAll(), 200,['Access-Control-Allow-Origin'=> '*'],['groups'=> 'post:read']);
    }

    /**
     * @Route("/api/thema", name="api_thema_index", methods={"GET"})
     */
    public function indexa(ThemaRepository $reposi): Response
    {

        return $this->json($reposi->findAll(), 200,['Access-Control-Allow-Origin'=> '*'],['groups'=> 'post:read']);
    }




    // /**
    //  * @Route("/api/newfilm", name="api_post_store", methods={"POST"})
    //  */
    // public function store(Request $request,  EntityManagerInterface $em, SerializerInterface $serializer, ValidatorInterface $validator)//: Response     
    // {
    //     $jsonRecu = $request->getContent();
    //     // dd($jsonRecu);


    //     $encoders = array(new JsonEncoder());
    //     $normalizers = array(new ObjectNormalizer());
    //     $serializer = new Serializer($normalizers, $encoders);
        

    //     try{
    //         $post = $serializer->deserialize($jsonRecu, Post::class, 'json');
    //     //     // $post->setCreatedAt(new \DateTime());
    //         dd($post);

    //         $errors =$validator->validate($post);

    //         if (count($errors) > 0){
    //             return $this->json($errors, 400);
    //         }

    //         $em->persist($post);
    //         $em->flush();

    //         dd($jsonRecu);
    //         return $this->json($post, 201, [], ['groups'=>'post:read']);

    //     } catch(NotEncodableValueException $e){ 
    //         return $this->json([
    //             'status'=>400,
    //             'message'=>$e->getMessage()
    //         ],400);
    //     } 
    // }


    /**
     * @Route("/api/new/film", name="api_new_film", methods={"POST","OPTIONS"})
     */
    public function filmNew(Request $request, ManagerRegistry $manager,  EntityManagerInterface $em2, SerializerInterface $serializer, ValidatorInterface $validator)//: Response     
    {

        // if ($request->isMethod('OPTIONS')) {
        //     return $this->json([], 200, ["Access-Control-Allow-Origin" => "*", "Access-Control-Allow-Headers" => "*", "Access-Control-Allow-Methods" => "*"]);
        // }

        try{
            $json = $request->getContent();
            $newFilm = json_decode($json);

            $dbOrder = new Film();
            $dbOrder->setNumber($newFilm->Number);
            $dbOrder->setTitle($newFilm->Title);
            $dbOrder->setActor($newFilm->Actor);
            $dbOrder->setYear($newFilm->Year);
            $dbOrder->setProp($newFilm->Prop);
            $dbOrder->setInfo($newFilm->Info);


            $errors = $validator->validate($dbOrder);
            if(count($errors)>0){
                return $this->json($errors, 400,["Access-Control-Allow-Origin" => "*", "Access-Control-Allow-Headers" => "*", "Access-Control-Allow-Methods" => "*"],['groups'=>'post:read']);
            }

            // ERROR DE DOCTRINE : NO PERSISTENCE IN THE DB

            // $em = $manager->getManager();
            // $em->persist($newFilm);
            // $em->flush();
            
            return $this->json($dbOrder,201,["Access-Control-Allow-Origin" => "*", "Access-Control-Allow-Headers" => "*", "Access-Control-Allow-Methods" => "*"],['groups'=>'post:read']);


        }catch(NotEncodableValueException $e){
            return $this->json([
                'status'=>400 ,
                'message'=> $e->getMessage()
            ], 400, ["Access-Control-Allow-Origin" => "*", "Access-Control-Allow-Headers" => "*", "Access-Control-Allow-Methods" => "*"],['groups'=>'product:read']);
        }

    }



}
