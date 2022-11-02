<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeacherController extends AbstractController
{
    /**
     * @return Response
     * @Route ("/teacher", name="teacher")
     */

    public function index(): Response
    {
        return $this->render('teacher/index.html.twig', [
            'controller_name' => 'TeacherController',
        ]);
    }

    /**
     * @param $name
     * @return Response
     * @Route ("/showTeacherN/{name}", name="showTeacherN")
     */

    public function showTeacher($name){
        return $this->render('Teacher/showTeacher.html.twig',
            ['m'=>$name]);
    }

    /**
     * @return RedirectResponse
     * @Route ("/goToIndex", name="goToIndex")
     */
    public function goToIndex(): RedirectResponse{
        return $this->redirectToRoute('student');
    }
}
