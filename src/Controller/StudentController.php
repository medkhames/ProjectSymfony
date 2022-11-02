<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function PHPUnit\Framework\returnArgument;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     */

    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }

    /**
     * @Route("/Affiche", name="affiche")
     */
    public function Affiche(){
        return new Response("Bonjour à tous");
    }

    /**
     * @param $name
     * @return Response
     * @Route ("/AfficheN/{name}", name="AfficheN")
     */
    public  function  AfficheName($name){
        return $this->render('student/affiche.html.twig',
            ['n'=>$name]);
    }
}
