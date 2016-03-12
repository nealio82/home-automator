<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\RoomType;
use AppBundle\Entity\Room;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RoomController extends Controller
{

//    /**
//     * @Route("/admin/control/devices", name="control_devices")
//     */
//    public function indexAction(Request $request) {
//
//        $em = $this->getDoctrine()->getManager();
//
//        $rooms = $em->createQueryBuilder()
//            ->select('r, d')
//            ->from('AppBundle:Room', 'r')
//            ->innerJoin('r.devices', 'd')
//            ->orderBy('r.name', 'ASC')
//            ->getQuery()
//            ->execute();
//
//        return $this->render('default/rooms.html.twig', ['rooms' => $rooms]);
//    }


    /**
     * @Route("/admin/configure/rooms", name="configure_rooms")
     */
    public function configureAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $room = new Room();
        $form = $this->createForm(RoomType::class, $room);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($room);
            $em->flush();
        }

        $rooms = $em->createQueryBuilder()
            ->select('r')
            ->from('AppBundle:Room', 'r')
            ->orderBy('r.name', 'ASC')
            ->getQuery()
            ->execute();

        return $this->render('configure/rooms.html.twig', ['rooms' => $rooms, 'form' => $form->createView()]);

    }

}
