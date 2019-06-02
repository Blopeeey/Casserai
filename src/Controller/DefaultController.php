<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $room = $em->getRepository('App:Room')->findAll();

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'room' => $room
        ]);
    }
}
