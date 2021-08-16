<?php

namespace App\Controller;

use App\Entity\Chaussure;
use App\Repository\LacetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class LacetController extends AbstractController
{
    /**
     * @Route("/lacet", name="lacet")
     */
    public function index(LacetRepository $lacetRepo ): Response
    {
        $lacet =$lacetRepo->findAll();
        return $this->json($lacet , 200, [] , ['groups' => 'lacetApi']);

    }

    /**
     * @Route("lacet/create/{id}", name="create_lacet" , methods={"POST"})
     */
    public function create(Request $requete ,  SerializerInterface $serializer , EntityManagerInterface  $manager , Chaussure $chaussure): Response
    {
        $lacet = $requete->getContent();

        $lacet = $serializer->deserialize($lacet , Lacet::class , 'json');



        $manager->persist($lacet);
        $lacet->setChaussure($chaussure);
        $manager->flush();
        return $this->json($lacet);
    }
}
