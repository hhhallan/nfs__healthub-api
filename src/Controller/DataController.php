<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Entity\Category;
use App\Entity\User;
use App\Entity\Achievement;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use App\Repository\AchievementRepository;

class DataController extends AbstractController
{

    /* Route des Achievements */
    #[Route('/achievements', name: 'achievements')]
    public function achievements()
    {
        $em = $this->getDoctrine()->getManager();
        $achievements = $em->getRepository(Achievement::class)->findAll();

        $datas = array();
        foreach ($achievements as $key => $achievement){
            $datas[$key]['id'] = $achievement->getId();
            $datas[$key]['name'] = $achievement->getName();
            $datas[$key]['image'] = $achievement->getImage();
            $datas[$key]['description'] = $achievement->getDescription();
            $datas[$key]['beginDate'] = $achievement->getBeginDate();
            $datas[$key]['endDate'] = $achievement->getEndDate();
            $datas[$key]['operateurComp'] = $achievement->getOperateurComp();
            $datas[$key]['valeurComp'] = $achievement->getValeurComp();
            $datas[$key]['periode'] = $achievement->getPeriode();
        }
   
        return new JsonResponse($datas);
    }

    #[Route('/achievements/{id}', name: 'achievements_id')]
    public function achievementUnique(int $id, AchievementRepository $achievementRepository)
    {
        $achievement = $achievementRepository->findOneBy(['id' => $id]);
   
        return new JsonResponse($achievement);
    }

    /* Route des Utilisateurs */
    #[Route('/users', name: 'users')]
    public function users()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository(User::class)->findAll();

        $datas = array();
        foreach ($users as $key => $user){
            $datas[$key]['id'] = $user->getId();
            $datas[$key]['pseudo'] = $user->getPseudo();
            $datas[$key]['mail'] = $user->getMail();
            $datas[$key]['age'] = $user->getAge();
            $datas[$key]['gender'] = $user->getGender();
            $datas[$key]['createdAt'] = $user->getCreatedAt();
            $datas[$key]['loginLastTime'] = $user->getLoginLastTime();
        }
   
        return new JsonResponse($datas);
    }

    #[Route('/users/{id}', name: 'user_id')]
    public function userUnique(int $id, UserRepository $userRepository)
    {
        $user = $userRepository->findOneBy(['id' => $id]);
   
        return new JsonResponse($user);
    }

    /* Route des catégories */
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
