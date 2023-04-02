<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PaiementRepository;
use App\Form\AddPaiementFormType;
use App\Form\EditPaiementType;
use App\Entity\Paiement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PaiementController extends AbstractController
{
    #[Route('/paiement', name: 'app_paiement')]
    public function index(): Response
    {
        return $this->render('paiement/index.html.twig', [
            'controller_name' => 'PaiementController',
        ]);
    }

    #[Route('paiement/add', name: 'paiement_add')]
    public function addPaiement(Request $request,  EntityManagerInterface $entityManager): Response
    {
        $paiement = new Paiement();
        $form = $this->createForm(AddPaiementFormType::class, $paiement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            
            
            // set the confirmation status to false
            $entityManager->persist($paiement);
            $entityManager->flush();

            
            return $this->redirectToRoute('paiement_list');
        }
   
            return $this->render('paiement/add.html.twig', [
                'paiementForm' => $form->createView(),
            ]);
        }

        #[Route('paiement/list', name: 'paiement_list')]
    public function paiementlist(Request $request,paiementRepository $paiementRepository): Response
{
    $paiements = $paiementRepository->findAll();
   
    return $this->render('paiement/list.html.twig', [
        'paiements' => $paiements,
    ]);
}


   #[Route('{id}/delete', name: 'paiement_delete')]
public function deletePaiement(ManagerRegistry $doctrine, int $id): Response
{
    $em = $doctrine->getManager();
    $paiement = $em->getRepository(Paiement::class)->find($id);

    if (!$paiement) {
        throw $this->createNotFoundException('The paiement was not found');
    }

    $em->remove($paiement);
    $em->flush();

    return $this->redirectToRoute('paiement_list');
}

#[Route('paiement/update/{id}', name: 'paiement_update')]
    public function updatePaiement(ManagerRegistry $doctrine, Request $request, $id): Response
{
    $em = $doctrine->getManager();
    $paiement = $em->getRepository( Paiement::class)->find($id);

    if (!$paiement) {
        throw new NotFoundHttpException('paiement not found');
    }

    $form = $this->createForm(EditPaiementType::class, $paiement);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($paiement);
        $em->flush();
           
        return $this->redirectToRoute('paiement_list');
    }

    return $this->render('paiement/update.html.twig', [
        'paiement' => $paiement,
        'paiementForm' => $form->createView(),
    ]);
}
}
