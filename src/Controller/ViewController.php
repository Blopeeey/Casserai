<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ViewController extends AbstractController
{
    /**
     * @Route("/view/{slug}", name="view")
     */
    public function index($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $room = $em->getRepository('App:Room')->findBy(array("room_number" => $slug));

        return $this->render('view/index.html.twig', [
            'controller_name' => 'ViewController',
            'room' => $room
        ]);
    }
}
