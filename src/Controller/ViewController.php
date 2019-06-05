<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ViewController extends AbstractController
{
    /**
     * @Route("/view", name="view")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $room = $em->getRepository('App:Room')->findAll();

        return $this->render('view/index.html.twig', [
            'controller_name' => 'ViewController',
            'room' => $room
        ]);
    }
}
