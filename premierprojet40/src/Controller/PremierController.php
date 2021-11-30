<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PremierController {
    /**
     * @Route("/index", name="index")
     */
    public function index() {
        return new Response($coontent= 'Bonjour mon premier contrôleur');
    }
}
