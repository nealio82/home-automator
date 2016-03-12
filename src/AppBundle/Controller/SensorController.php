<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Metric;
use AppBundle\Entity\Sensor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\SensorType;

class SensorController extends Controller
{
    /**
     * @Route("/admin/configure/sensors", name="configure_sensors")
     */
    public function configureAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $sensor = new Sensor();
        $form = $this->createForm(SensorType::class, $sensor);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($sensor);
            $em->flush();
        }

        $sensors = $em->createQueryBuilder()
            ->select('s, m')
            ->from('AppBundle:Sensor', 's')
            ->innerJoin('s.metric', 'm')
            ->orderBy('s.name', 'ASC')
            ->getQuery()
            ->execute();

        return $this->render('configure/sensors.html.twig', ['sensors' => $sensors, 'form' => $form->createView()]);

    }


}
