<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Payment;
use App\Form\BookFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ToBookingController extends AbstractController
{
    /**
     * @Route("/tobooking/{slug}", name="to_booking")
     */
    public function index($slug, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $room = $em->getRepository('App:Room')->findBy(array("id" => $slug));
        $room_id = $em->getRepository('App:Room')->find($slug);


        $book_room = new Booking();
        $pay_room = new Payment();
        $form = $this->createForm(BookFormType::class, $book_room);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user_id = $this->getUser()->getId();
            $user = $em->getRepository('App:User')->find($user_id);
            $book_room->setUser($user);
            $book_room->setRoom($room_id);
//            $book_room->setBetaal($yeet);

            $em->persist($book_room);
            $em->flush();

            return $this->redirectToRoute('default');
        }

        return $this->render('to_booking/index.html.twig', [
            'controller_name' => 'BookingController',
            'room' => $room,
            'form' => $form->createView()
        ]);
    }
}
