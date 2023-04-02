<?php

namespace App\Controller;


use App\Entity\Commande;
use App\Repository\CommandeRepository;
use App\Form\AddFormType;
use App\Form\EditCommandeType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CommandeController extends AbstractController
{
    #[Route('/commande', name: 'app_commande')]
    public function index(): Response
    {
        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }

    #[Route('commande/add', name: 'app_add')]
    public function add(Request $request,  EntityManagerInterface $entityManager): Response
    {
        $commande = new Commande();
        $form = $this->createForm(AddFormType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            
            
            // set the confirmation status to false
            $entityManager->persist($commande);
            $entityManager->flush();

            
            return $this->redirectToRoute('commande_list');
        }
   
            return $this->render('commande/add.html.twig', [
                'commandeForm' => $form->createView(),
            ]);
        }

        #[Route('commande/list', name: 'commande_list')]
    public function commandelist(Request $request,CommandeRepository $commandeRepository): Response
{
    $commandes = $commandeRepository->findAll();
   
    return $this->render('commande/list.html.twig', [
        'commandes' => $commandes,
    ]);
}


   #[Route('{id}/delete', name: 'commande_delete')]
public function delete(ManagerRegistry $doctrine, int $id): Response
{
    $em = $doctrine->getManager();
    $commande = $em->getRepository(Commande::class)->find($id);

    if (!$commande) {
        throw $this->createNotFoundException('The commande was not found');
    }

    $em->remove($commande);
    $em->flush();

    return $this->redirectToRoute('commande_list');
}

#[Route('commande/update/{id}', name: 'commande_update')]
    public function update(ManagerRegistry $doctrine, Request $request, $id): Response
{
    $em = $doctrine->getManager();
    $commande = $em->getRepository( Commande::class)->find($id);

    if (!$commande) {
        throw new NotFoundHttpException('commande not found');
    }

    $form = $this->createForm(EditCommandeType::class, $commande);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($commande);
        $em->flush();
           
        return $this->redirectToRoute('commande_list');
    }

    return $this->render('commande/update.html.twig', [
        'commande' => $commande,
        'commandeForm' => $form->createView(),
    ]);
}



}
