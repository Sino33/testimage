<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Panier;
use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository(Article::class)->findAll();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/shop", name="shop")
     */
    public function shop()
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository(Article::class)->findAll();

        return $this->render('shop.html.twig', [
            'articles' => $articles
        ]);
    }
    
    /**
     * @Route("/panier", name="panier")
     */
    public function panier()
    {

        $repository = $this->getDoctrine()->getManager()->getRepository(Panier::class);
        $user = $this->getUser();

        $listPanier = $repository->findByUser($user);

        return $this->render('panier.html.twig', [

            'user' => $user,
            'listPanier' => $listPanier
        ]);
    }

    /**
     * @Route("/achat/{id}", name="achat")
     */
    public function acheter(RegistryInterface $doctrine, Request $request, $id){

        $em = $this->getDoctrine()->getManager();  
        $user = $this->getUser(); //Récupére l'id de l'utilisateur connecté
    
        $article = $em->getRepository(Article::class)->find($id); //Recupére l'id de l'article


        $achat = new Panier;  //Creation d'un nouvel objet reservation pour l'insertion en base de donnée.
        $achat->setCommande($article);  
        $achat->setUser($user);
        $em->persist($achat);
        $em->flush();
        
        return new Response('achat enregistré ' .$user);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
       
        return $this->render('contact.html.twig');
    }


    /**
     * @Route("/ajout", name="ajout")
     */
    public function addArticle(Request $request, RegistryInterface $doctrine)
   {
     
       //Création de mon objet Article//
       $article = new Article();

       //On récupére le formulaire
       $form = $this->createform(ArticleType::class,$article);

       $form->handleRequest($request);
       //Si le formulaire a été soumis
       if($form->IsSubmitted() && $form->isValid()){

           $em = $this->getDoctrine()->getManager();
           $em->persist($article);
           $em->flush();
           
     
       return $this->redirectToRoute('home');
       }

       //On génére le HTML du formulaire crée
       $formView = $form->createView();

       //On rend la vue
       return $this->render('articleForm.html.twig',[
           'form' => $formView
       ]);
   }

}

