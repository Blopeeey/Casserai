<?php

namespace App\Controller;
use App\Entity\Booking;
use App\Repository\RoomRepository;
use App\Repository\BookingRepository;
use App\Form\CheckDatesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ViewController extends AbstractController
{
    /**
     * @Route("/view", name="view")
     */
    public function index(RoomRepository $roomRepository, Request $request)
    {
        $form = $this->createForm(CheckDatesType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $begindate= $form->getData()->GetStartTime();
            $enddate = $form->getData()->GetEndTime();

            return $this->render('booking/index.html.twig', [
                'rooms' => $roomRepository->RoomFinder($begindate, $enddate),
            ]);
        }
        return $this->render('view/index.html.twig', [
            'form' => $form->createview(),
        ]);
    }
}

