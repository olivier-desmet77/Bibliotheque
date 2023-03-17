<?php

namespace App\Controller\Admin;

use App\Entity\Author;
use App\Repository\AuthorRepository;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class AuthorController extends AbstractController
{
    //Créer un nouvel auteur

    #[Route('/admin/auteurs/nouveau', name: 'admin_author_new')]

    public function create(Request $request, AuthorRepository $repository): Response
    {
        //tester si le formulaire est envoyé
if ($request->isMethod('POST')) {
    //récuperer les champs du formulaire
    $name = $request->request->get('name');
    $description = $request->request->get('description');
    $imageUrl = $request->request->get('imageUrl');
    //créer l'objet autheur avec les champs du form
    $author = new author();
    $author->setName($name);
    $author->setDescription($description);
    $author->setImageUrl($imageUrl);
    //enregistrer l'auteur dans la bd via le repository
    $repository->save($author, true);

    //redirection vers la liste
}
            //affichage du form de modification
            return $this->render('admin/author/create.html.twig', [

            ]);
        
    }

         //Lister les auteurs
         #[Route('/author/liste', name:'app_author_list')]
         public function list(AuthorRepository $repository):Response
         {
             //recuperer la liste des autheurs de la bd via le repo
             $authors = $repository->findAll();
             //afficher la liste dans le twig
                 return $this->render('admin/author/list.html.twig', ['authors' => $authors]);
         }




}
