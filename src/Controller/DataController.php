<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Entity\Category;

class DataController extends AbstractController
{

    /** Affiche les catégories active **/
    #[Route('/category_unable', name: 'category_unable')]
    public function category()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(Category::class)->findBy(array('unable' => true));

        $datas = array();
        foreach ($categories as $key => $categorie){
            $datas[$key]['name'] = $categorie->getName();
            $datas[$key]['image'] = $categorie->getImage();
            $datas[$key]['description'] = $categorie->getDescription();
            $datas[$key]['objectiv'] = $categorie->getObjectiveValue();
        }
   
        return new JsonResponse($datas);
    }

    /** Affiche les catégories désactivé **/
    #[Route('/category_disable', name: 'category_disable')]
    public function categoryDisabel()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(Category::class)->findBy(array('unable' => false));

        $datas = array();
        foreach ($categories as $key => $categorie){
            $datas[$key]['name'] = $categorie->getName();
            $datas[$key]['image'] = $categorie->getImage();
            $datas[$key]['description'] = $categorie->getDescription();
            $datas[$key]['objectiv'] = $categorie->getObjectiveValue();
        }
   
        return new JsonResponse($datas);
    }

}
