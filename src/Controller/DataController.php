<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Entity\Category;
use App\Repository\CategoryRepository;

class DataController extends AbstractController
{

    #[Route('/category', name: 'category')]
    public function category()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(Category::class)->findAll();

        $datas = array();
        foreach ($categories as $key => $categorie){
            $datas[$key]['id'] = $categorie->getId();
            $datas[$key]['name'] = $categorie->getName();
            $datas[$key]['image'] = $categorie->getImage();
            $datas[$key]['description'] = $categorie->getDescription();
            $datas[$key]['objectiv'] = $categorie->getObjectiveValue();
        }
   
        return new JsonResponse($datas);
    }

    #[Route('/category/{id}', name: 'category_id')]
    public function categoryUnique(int $id, CategoryRepository $categoryRepository)
    {
        $categorie = $categoryRepository->findOneBy(['id' => $id]);
   
        return new JsonResponse($categorie);
    }


    /** Affiche les catégories active **/
    #[Route('/category_unable', name: 'category_unable')]
    public function categoryUnable()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(Category::class)->findBy(array('unable' => true));

        $datas = array();
        foreach ($categories as $key => $categorie){
            $datas[$key]['id'] = $categorie->getId();
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
            $datas[$key]['id'] = $categorie->getId();
            $datas[$key]['name'] = $categorie->getName();
            $datas[$key]['image'] = $categorie->getImage();
            $datas[$key]['description'] = $categorie->getDescription();
            $datas[$key]['objectiv'] = $categorie->getObjectiveValue();
        }
   
        return new JsonResponse($datas);
    }

}
