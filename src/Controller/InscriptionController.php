<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class InscriptionController extends AbstractController
{
    private  $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/inscription", name="app_inscription")
     */
    public function index(Request $request, UserPasswordEncoderInterface  $encoder, SluggerInterface $slugger): Response
    {
        $user = new User();
        $form = $this->createForm(InscriptionType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $password = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $user->setRoles(array('ROLE_proprietere'));
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            return $this->redirectToRoute('app_login');
        }
        return $this->render(
            'inscription/index.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }




    /**

     * @Route("/inscriptionuser", name="app_ins")

     */

    public function inde(Request $request, UserPasswordEncoderInterface  $encoder, SluggerInterface $slugger): Response

    {

        $user = new User();

        $form = $this->createForm(InscriptionType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();

            $password = $encoder->encodePassword($user, $user->getPassword());

            $user->setPassword($password);





            // this condition is needed because the 'brochure' field is not required

            // so the PDF file must be processed only when a file is uploaded



            $this->entityManager->persist($user);

            $this->entityManager->flush();
            return $this->redirectToRoute('app_login');
        }






        return $this->render(

            'inscription/user.html.twig',

            [

                'form' => $form->createView()

            ]

        );
    }
}
