<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ListareproduccionRepository;
use App\Entity\Temazo;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Listareproduccion;
use Knp\Component\Pager\PaginatorInterface;


class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ListareproduccionRepository $listareproduccionRepository,PaginatorInterface $paginator, Request $request): Response
    {
        $query=$listareproduccionRepository->findMyListas($this->getUser());
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            3 /*limit per page*/
        );
    
     
        return $this->render('home/index.html.twig', [
            'pagination' => $pagination,
            'comentarios' => $query,
            'Todasmislistas'=>$listareproduccionRepository->findMyListas($this->getUser())

        ]);


/*

 
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'listareproduccions' => $listareproduccionRepository->findByUserEj1($this->getUser()),
           
        ]);

        */
    }
}
