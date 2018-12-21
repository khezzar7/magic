<?php

namespace App\Controller;

use App\Entity\Magic;
use App\Form\MagicType;
use App\Repository\MagicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/magic")
 */
class MagicController extends AbstractController
{
    /**
     * @Route("/", name="magic_index", methods={"GET"})
     */
    public function index(MagicRepository $magicRepository): Response
    {
        return $this->render('magic/index.html.twig', ['magics' => $magicRepository->findAll()]);
    }
          /**
       * @Route("/json", name="magic_json")
       */
      public function index_json(MagicRepository $magicRepository): JsonResponse
      {
          return new JsonResponse($magicRepository->findAllCard());
      }
    /**
     * @Route("/new", name="magic_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $file='';
        $magic = new Magic();
        $form = $this->createForm(MagicType::class, $magic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file= $form->get('image')->getData();
            $fileName = $file->getClientOriginalName();

            try{
              $file->move(
                $this->getParameter('cards_folder'),
                $fileName);
            }catch(FileException $e){
              echo 'error';
            }
            $magic->setImage($fileName);
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager= $this->getDoctrine()->getManager();

            $entityManager->persist($magic);
            $entityManager->flush();

            return $this->redirectToRoute('magic_index');
        }

        return $this->render('magic/new.html.twig', [
            'magic' => $magic,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="magic_show", methods={"GET"})
     */
    public function show(Magic $magic): Response
    {
        return $this->render('magic/show.html.twig', ['magic' => $magic]);
    }

    /**
     * @Route("/{id}/edit", name="magic_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Magic $magic): Response
    {
        $form = $this->createForm(MagicType::class, $magic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('magic_index', ['id' => $magic->getId()]);
        }

        return $this->render('magic/edit.html.twig', [
            'magic' => $magic,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="magic_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Magic $magic): Response
    {
        if ($this->isCsrfTokenValid('delete'.$magic->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($magic);
            $entityManager->flush();
        }

        return $this->redirectToRoute('magic_index');
    }
}
