<?php

namespace App\Controller;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Employe;
use App\Entity\Lieu;

class PrincipalController extends AbstractController
{
    /**
     * @Route("/principal", name="principal")
     */
    public function index(): Response
    {
        return $this->render('principal/index.html.twig', [
            'controller_name' => 'Symfony c\'est super',
        ]);
    }
    
    /**
     * @Route("/welcome/{nom}", name="welcome")
     */
    public function welcome(string $nom){
        return $this->render('principal/welcome.html.twig', array(
            "nom" => $nom
        ));
    }
    
    /**
     * @Route("/message/{departement}&{sexe}", name="message")
     */
    public function message(string $departement, string $sexe){
        if($sexe == "garçon"){
            $sexe = "un garçon ";
        } 
        elseif ($sexe == "fille") 
        {
            $sexe = "une fille ";
        }
        else {
            $sexe = "de sexe inconnu !";
        }
        return $this->render('principal/message.html.twig', array(
            "departement" => $departement,
            "sexe" => $sexe,
        ));
    }
    
    /**
     * @Route("/employes", name="employes")
     * @param ManagerRegistry $doctrine
     */
    public function afficheEmployes(ManagerRegistry $doctrine) : Response {
        $employes = $doctrine->getRepository(Employe::class)->findAll();
        $titre = "Liste des employés";
        return $this->render('principal/employes.html.twig', compact('titre', 'employes'));
    }
    
    /**
     * @Route("/employe/{id}", name="unemploye", requirements={"id":"\d+"})
     * @param ManagerRegistry $doctrine
     */
    public function afficheUnEmploye(ManagerRegistry $doctrine, int $id) : Response {
        $employe = $doctrine->getRepository(Employe::class)->find($id);
        $titre = "Employé n° " . $id;
        return $this->render('principal/unemploye.html.twig', compact('titre', 'employe'));
    }
    
    /**
     * @Route("/employetout/{id}", name="employetout", requirements={"id":"\d+"})
     * @param ManagerRegistry $doctrine
     */
    public function afficherUnEmployeTout(ManagerRegistry $doctrine, int $id) {
        $employe = $doctrine->getRepository(Employe::class)->find($id);
        $titre = "Employé n° " . $id;
        return $this->render('principal/unemployetout.html.twig', compact('titre', 'employe'));
    }
    
    /**
     * @Route("/lieu/{id}", name="lieu", requirements={"id":"\d+"})
     * @param ManagerRegistry $doctrine
     */
    public function afficherUnLieuTout(ManagerRegistry $doctrine, int $id) {
        $lieu = $doctrine->getRepository(Lieu::class)->find($id);
        return $this->render('principal/unlieutout.html.twig', compact('lieu'));
    }
}
