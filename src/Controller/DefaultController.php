<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/defaut", name="defaut")
     */
    public function index()
    {
        return $this->render('defaut/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}