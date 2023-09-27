<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Produits;
use App\Entity\User;
use App\Form\RechercheType;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\HttpFoundation\Request;

class PageController extends AbstractController
{
  private  $entityManager;
  public function __construct(EntityManagerInterface $entityManager)
  {
    $this->entityManager = $entityManager;
  }
  /**
   * @Route("/", name="app_page")
   */
  public function index(Request  $request): Response
  {
    $Produits = new Produits();

    $form = $this->createForm(RechercheType::class, $Produits);

    $form->handleRequest($request);

    $produits = [];

    if ($form->isSubmitted() && $form->isValid()) {

      $ariver = $Produits->getAriver();

      $depart = $Produits->getDepart();

      if ($ariver != "") {

        $produits = $this->entityManager->getRepository(Produits::class)->findBy(['ariver' => $ariver],);
      } elseif ($depart != '') {

        $produits = $this->entityManager->getRepository(Produits::class)->findBy(['depart' => $depart],);
      } else {
        $produits = $this->entityManager->getRepository(Produits::class)->findall();
      }
    }




    return $this->render(
      'page/accueil.html.twig',
      [
        'produits' => $produits,
        'form' => $form->createView()

      ]
    );
  }

  /**
   * @Route("/produits", name="app_produits")
   */

  public function i(): Response
  {


    $produits = $this->entityManager->getRepository(Produits::class)->findall();



    return $this->render(
      'contact/contact.html.twig',
      [
        'produits' => $produits,


      ]
    );
  }




  /**
   * @Route("/about", name="app")
   */
  public function about(): Response
  {
    return $this->render(
      'page/about.html.twig',
    );
  }


  /**
   * @Route("/show/{id}", name="ap")
   */
  public function show($id): Response
  {

    $repo = $this->entityManager->getRepository(Produits::class);
    $produits = $repo->find($id);











    return $this->render(
      'page/show.html.twig',
      [
        "produits" => $produits,


      ]
    );
  }




  /**
   * @Route("/contact2", name="produits")
   */

  public function l(): Response
  {






    return $this->render(
      'contact/contact2.html.twig',
      []
    );
  }

  /**
   * @Route("/cgu", name="cgu")
   */

  public function cgu(): Response
  {






    return $this->render(
      'security/cgu.html.twig',
      []
    );
  }

  /**
   * @Route("/politique", name="politique")
   */
  public function politique(): Response
  {






    return $this->render(
      'security/politique.html.twig',
      []
    );
  }
}
