<?php

namespace App\Controller;

use App\Entity\Chaussure;
use App\Repository\ChaussureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ChaussureController extends AbstractController
{
    /**
     * @Route("/chaussure", name="chaussure")
     */
    public function index(ChaussureRepository $chaussureRepo): Response
    {
       $chaussures = $chaussureRepo->findAll();


       return $this->json($chaussures , 200 , [] , ['groups' => 'chaussureApi']);
    }

    /**
     * @Route("/chaussure/create", name="create_chaussure" , methods={"POST"})
     */
    public function create(Request $requete , EntityManagerInterface $manager , SerializerInterface $serializer):Response
    {


        $chaussure = $requete->getContent();

        $chaussure = $serializer->deserialize($chaussure , Chaussure::class , 'json');

        $manager->persist($chaussure);
        $manager->flush();
        return $this->json($chaussure);
    }
}
