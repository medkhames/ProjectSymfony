<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @param StudentRepository $repository
     * @return Response
     * @Route ("/student/Affiche",name="AfficheS")
     */

    public function AfficheS(StudentRepository $repository){
        //$repo=$this->getDoctrine()->getRepository(Classroom::class);
        $student=$repository->findAll();
        return $this->render('student/AfficheS.html.twig',
            ['student'=>$student]);
    }

    /**
     * @Route ("/AjoutS")
     */
    function Ajouter(Request $request){
        $student=new Student();
        $form=$this->createForm(StudentType::class,$student);
        $form->add('Ajouter',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($student);
            $em->flush();
            return $this->redirectToRoute('AfficheS');
        }
        return $this->render('student/AjoutS.html.twig',
            ['form'=>$form->createView()]);

    }

    /**
     * @param $id
     * @param StudentRepository $repository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route ("/student/delete/{id}", name="d")
     */
    function remove($id,StudentRepository $repository){
        $student=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($student);
        $em->flush();
        return $this->redirectToRoute('AfficheS');

    }


    /**
     * @param StudentRepository $repository
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/student/update/{id}", name="u")
     */
    function Update(StudentRepository $repository, $id,Request $request){
        $student=$repository->find($id);
        $form=$this->createForm(StudentType::class,$student);
        $form->add('Update',SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("AfficheS");
        }
        return $this->render('student/Update.html.twig',[
            'f'=>$form->createView()
        ]);


}

    /**
     * @return void
     * @Route ("student/recherche",name="recherche")
     */
function Recherche(StudentRepository $repository,Request $request ){
    $data=$request->get('search');
    $student=$repository->findBy(['nsc'=>$data]);
    return$this->render('student/AfficheS.html.twig',
        ['student'=>$student]);

}
}
