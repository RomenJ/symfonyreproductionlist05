<?php

namespace App\Controller;

use App\Entity\Listareproduccion;
use App\Form\ListareproduccionType;
use App\Repository\ListareproduccionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/listareproduccion')]
class ListareproduccionController extends AbstractController
{
    #[Route('/todaslaslistas', name: 'app_listareproduccion_index', methods: ['GET'])]
    public function index(ListareproduccionRepository $listareproduccionRepository): Response
    {


        
        return $this->render('listareproduccion/index.html.twig', [
            'listareproduccions' => $listareproduccionRepository->findAll(),
        ]);
    }


    /*mis listas*/



    #[Route('/', name: 'app_listareproduccion_mislistas', methods: ['GET'])]
    public function mislistas(ListareproduccionRepository $listareproduccionRepository,PaginatorInterface $paginator, Request $request): Response
    {


        $query=$listareproduccionRepository->findMyListas($this->getUser());
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            3 /*limit per page*/
        );
    
     
        return $this->render('listareproduccion/index.html.twig', [
            'pagination' => $pagination,
            'comentarios' => $query,
            'Todasmislistas'=>$listareproduccionRepository->findMyListas($this->getUser())

        ]);

/*
    
        return $this->render('listareproduccion/index.html.twig', [
          'listareproduccions' => $listareproduccionRepository->findByUserEj1($this->getUser()),

        ]);*/

        
    }



    /*Reproducir listas*/

    #[Route('/repro', name: 'app_listareproduccion_reproducirlistas', methods: ['GET'])]
    public function reproducirlistas(ListareproduccionRepository $listareproduccionRepository): Response
    {



        return $this->render('listareproduccion/reprolist.html.twig', [
          'listareproduccions' => $listareproduccionRepository->findByUserEj1($this->getUser()),
       
        ]);
    }




    #[Route('/new', name: 'app_listareproduccion_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ListareproduccionRepository $listareproduccionRepository): Response
    {
        $listareproduccion = new Listareproduccion();
        $form = $this->createForm(ListareproduccionType::class, $listareproduccion);
        $form->handleRequest($request);
  
        if ($form->isSubmitted() && $form->isValid()) {
    
            $listareproduccion-> setUser($this->getUser());
            $listareproduccionRepository->save($listareproduccion, true);     
            return $this->redirectToRoute('app_listareproduccion_mislistas', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('listareproduccion/new.html.twig', [
            'listareproduccion' => $listareproduccion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_listareproduccion_show', methods: ['GET'])]
    public function show(Listareproduccion $listareproduccion): Response
    {
        return $this->render('listareproduccion/show.html.twig', [
            'listareproduccion' => $listareproduccion,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_listareproduccion_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Listareproduccion $listareproduccion, ListareproduccionRepository $listareproduccionRepository): Response
    {
        $form = $this->createForm(ListareproduccionType::class, $listareproduccion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $listareproduccionRepository->save($listareproduccion, true);
            return $this->redirectToRoute('app_listareproduccion_mislistas', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('listareproduccion/edit.html.twig', [
            'listareproduccion' => $listareproduccion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_listareproduccion_delete', methods: ['POST'])]
    public function delete(Request $request, Listareproduccion $listareproduccion, ListareproduccionRepository $listareproduccionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$listareproduccion->getId(), $request->request->get('_token'))) {
            $listareproduccionRepository->remove($listareproduccion, true);
        }
        return $this->redirectToRoute('app_listareproduccion_mislistas', [], Response::HTTP_SEE_OTHER);
    }
}
