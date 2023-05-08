<?php

namespace App\Controller;

use App\Entity\Temazo;
use App\Form\TemazoType;
use App\Repository\TemazoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/temazo')]
class TemazoController extends AbstractController
{
    #[Route('/', name: 'app_temazo_index', methods: ['GET'])]
    public function index(TemazoRepository $temazoRepository,PaginatorInterface $paginator, Request $request): Response
    {

        $query=$temazoRepository->findMytTemazos();
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            4 /*limit per page*/
        );
    
     
        return $this->render('temazo/index.html.twig', [
            'pagination' => $pagination,
            'comentarios' => $query,
            'Todoslostemazos'=>$temazoRepository->findMytTemazos()

        ]);

        /*
        return $this->render('temazo/index.html.twig', [
            'temazos' => $temazoRepository->findAll(),
        ]);*/
    }

    #[Route('/new', name: 'app_temazo_new', methods: ['GET', 'POST'])]
    public function new(SluggerInterface $slugger,Request $request, TemazoRepository $temazoRepository): Response
    {
        $temazo = new Temazo();
        $form = $this->createForm(TemazoType::class, $temazo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $Mp3File = $form->get('archivenamesong')->getData();
        
         if ( $Mp3File) {
            $originalFilename = pathinfo($Mp3File->getClientOriginalName(), PATHINFO_FILENAME);
            // this is needed to safely include the file name as part of the URL
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'. $Mp3File->guessExtension();

            // Move the file to the directory 
            try {

                $temazo->setArchivenamesong($newFilename);
                $Mp3File->move(
                    $this->getParameter('mp3_path_directory'),
                    $newFilename
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }

          
        }  



            $temazoRepository->save($temazo, true);

            return $this->redirectToRoute('app_temazo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('temazo/new.html.twig', [
            'temazo' => $temazo,
            'form' => $form,
        ]);
    }
    #[Route('/finden', name: 'app_temazo_findgen', methods: ['GET','POST'])]
    public function findgen(Request $request ): Response
    {
    
        return $this->renderForm('temazo/buscador.html.twig', [
 
        ]);
    }
    
    //Buscar por título y autor de canción 
    #[Route('/findsong2', name: 'app_temazo_findsong2', methods: ['GET','POST'])]
    public function findsong2(Request $request,TemazoRepository $temazoRepository ): Response
    {
        //Extrae el valor del formulario html 
        $nombre=$request->get('nombresong2');
        //consulta exitosa:
        //SELECT * FROM `temazo` WHERE temazo.titulo like ('%Mr%') or temazo.autor like ('%Oz%');
        $busquedaCanciones= $temazoRepository->findByTitleAuthor($nombre);
        return $this->renderForm('temazo/resultadosBusqueda.html.twig', [
            'busquedaConaciones'=>$busquedaCanciones,
            'nombre'=>$nombre,
           
        ]);
    }




    
    
    
    //Buscar por canción 
    #[Route('/findsong', name: 'app_temazo_findsong', methods: ['GET','POST'])]
    public function findsong(Request $request,TemazoRepository $temazoRepository ): Response
    {
        //Extrae el valor del formulario html 
        $nombre=$request->get('nombresong');
        //consulta exitosa:
        //SELECT * FROM `temazo` WHERE titulo like '%Bra%';
        $busquedaCanciones= $temazoRepository->findByTitle($nombre);
        return $this->renderForm('temazo/resultadosBusqueda.html.twig', [
            'busquedaConaciones'=>$busquedaCanciones,
            'nombre'=>$nombre,
           
        ]);
    }



    //findsongbyauth


    #[Route('/findsongbyauth', name: 'app_temazo_findsongbyauth', methods: ['GET','POST'])]
    public function findsongbyauth(Request $request,TemazoRepository $temazoRepository ): Response
    {
        //Extrae el valor del formulario html 
        $nombre=$request->get('nombreauth');
        //consulta exitosa:
        //SELECT * FROM `temazo` WHERE titulo like '%Bra%';
        $busquedaCanciones= $temazoRepository->findSongByAuth($nombre);
        return $this->renderForm('temazo/resultadosBusqueda.html.twig', [
            'busquedaConaciones'=>$busquedaCanciones,
            'nombre'=>$nombre,
           
        ]);
    }




    #[Route('/{id}', name: 'app_temazo_show', methods: ['GET'])]
    public function show(Temazo $temazo): Response
    {
        return $this->render('temazo/show.html.twig', [
            'temazo' => $temazo,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_temazo_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Temazo $temazo, TemazoRepository $temazoRepository): Response
    {
        $form = $this->createForm(TemazoType::class, $temazo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $temazoRepository->save($temazo, true);

            return $this->redirectToRoute('app_temazo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('temazo/edit.html.twig', [
            'temazo' => $temazo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_temazo_delete', methods: ['POST'])]
    public function delete(Request $request, Temazo $temazo, TemazoRepository $temazoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$temazo->getId(), $request->request->get('_token'))) {
            $temazoRepository->remove($temazo, true);
        }

        return $this->redirectToRoute('app_temazo_index', [], Response::HTTP_SEE_OTHER);
    }
}
