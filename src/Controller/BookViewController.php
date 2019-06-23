<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BookViewController extends AbstractController
{
    /**
     * @Route("/bookview", name="book_view")
     */
    public function index()
    {
        $current_date = new \DateTime();

        $em = $this->getDoctrine()->getManager();
        $booking = $em->getRepository('App:Booking')->findBy(['start_time' => $current_date]);
        $endtime = $em->getRepository('App:Booking')->findBy(['end_time' => $current_date]);
        $all = $em->getRepository('App:Booking')->findAll();

        return $this->render('book_view/index.html.twig', [
            'booking' => $booking,
            'endtime' => $endtime,
            'yeet' => $all,
            'controller_name' => 'BookViewController',
        ]);
    }
}
