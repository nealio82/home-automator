<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Device;
use AppBundle\Form\Type\DeviceType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DeviceController extends Controller
{

    /**
     * @Route("/admin/control/devices", name="control_devices")
     */
    public function indexAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        $rooms = $em->createQueryBuilder()
            ->select('r, d')
            ->from('AppBundle:Room', 'r')
            ->innerJoin('r.devices', 'd')
            ->orderBy('r.name', 'ASC')
            ->getQuery()
            ->execute();

        return $this->render('default/rooms.html.twig', ['rooms' => $rooms]);
    }


    /**
     * @Route("/admin/configure/devices", name="configure_devices")
     */
    public function configureAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $device = new Device();
        $form = $this->createForm(DeviceType::class, $device);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $device->setState(true);
            $em->persist($device);
            $em->flush();
        }

        $devices = $em->createQueryBuilder()
            ->select('d', 'r', 'c')
            ->from('AppBundle:Device', 'd')
            ->innerJoin('d.room', 'r')
            ->innerJoin('d.apiCredential', 'c')
            ->orderBy('d.name', 'ASC')
            ->getQuery()
            ->execute();

        return $this->render('configure/devices.html.twig', ['devices' => $devices, 'form' => $form->createView()]);

    }

}
