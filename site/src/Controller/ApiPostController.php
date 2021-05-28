<?php

namespace App\Controller;

use App\Entity\Film;
use App\Entity\Thema;
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




    /**
     * @Route("/api/new/film", name="api_new_filmaa", methods={"POST","OPTIONS"})
     */
    public function filmNew(Request $request, ManagerRegistry $manager,  EntityManagerInterface $em2, SerializerInterface $serializer, ValidatorInterface $validator)//: Response     
    {

        if ($request->isMethod('OPTIONS')) {
            return $this->json([], 200, ["Access-Control-Allow-Origin" => "*", "Access-Control-Allow-Headers" => "*", "Access-Control-Allow-Methods" => "*"]);
        }

        try{
            $json = $request->getContent();
            $newFilm = json_decode($json);

            $newThema = new Thema();

            $dbOrder = new Film();
            $dbOrder->setNumber($newFilm->Number);
            $dbOrder->setTitle($newFilm->Title);
            $dbOrder->setActor($newFilm->Actor);
            $dbOrder->setYear($newFilm->Year);
            $dbOrder->setProp($newFilm->Prop);
            $dbOrder->setInfo($newFilm->Info);
            

            $newThema->setName($newFilm->thema->name);
            $dbOrder->setThema($newThema);


            $errors = $validator->validate($dbOrder);
            if(count($errors)>0){
                return $this->json($errors, 400,["Access-Control-Allow-Origin" => "*", "Access-Control-Allow-Headers" => "*", "Access-Control-Allow-Methods" => "*"],['groups'=>'post:read']);
            }

            

            $em = $manager->getManager();
            $em->persist($dbOrder);
            $em->flush();
            
            return $this->json($dbOrder,201,["Access-Control-Allow-Origin" => "*", "Access-Control-Allow-Headers" => "*", "Access-Control-Allow-Methods" => "*"],['groups'=>'post:read']);


        }catch(NotEncodableValueException $e){
            return $this->json([
                'status'=>400 ,
                'message'=> $e->getMessage()
            ], 400, ["Access-Control-Allow-Origin" => "*", "Access-Control-Allow-Headers" => "*", "Access-Control-Allow-Methods" => "*"],['groups'=>'product:read']);
        }

    }




    

    /**
     * @Route("/api/new/thema", name="api_new_thema", methods={"POST","OPTIONS"})
     */
    public function themaNew(Request $request, ManagerRegistry $manager,  EntityManagerInterface $em2, SerializerInterface $serializer, ValidatorInterface $validator)//: Response     
    {

        if ($request->isMethod('OPTIONS')) {
            return $this->json([], 200, ["Access-Control-Allow-Origin" => "*", "Access-Control-Allow-Headers" => "*", "Access-Control-Allow-Methods" => "*"]);
        }

        try{
            $json = $request->getContent();
            $newThema = json_decode($json);

          

            $dbOrder = new Thema();
            $dbOrder->setName($newThema->name);

        

            $errors = $validator->validate($dbOrder);
            if(count($errors)>0){
                return $this->json($errors, 400,["Access-Control-Allow-Origin" => "*", "Access-Control-Allow-Headers" => "*", "Access-Control-Allow-Methods" => "*"],['groups'=>'post:read']);
            }

            

            $em = $manager->getManager();
            $em->persist($dbOrder);
            $em->flush();
            
            return $this->json($dbOrder,201,["Access-Control-Allow-Origin" => "*", "Access-Control-Allow-Headers" => "*", "Access-Control-Allow-Methods" => "*"],['groups'=>'post:read']);


        }catch(NotEncodableValueException $e){
            return $this->json([
                'status'=>400 ,
                'message'=> $e->getMessage()
            ], 400, ["Access-Control-Allow-Origin" => "*", "Access-Control-Allow-Headers" => "*", "Access-Control-Allow-Methods" => "*"],['groups'=>'product:read']);
        }

    }




    



}
