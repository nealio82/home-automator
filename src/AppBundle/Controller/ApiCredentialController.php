<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ApiCredential;
use AppBundle\Form\Type\ApiCredentialType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\SensorType;

class ApiCredentialController extends Controller
{
    /**
     * @Route("/admin/configure/api_credentials", name="configure_api_credentials")
     */
    public function configureAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $credential = new ApiCredential();
        $form = $this->createForm(ApiCredentialType::class, $credential);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($credential);
            $em->flush();
        }

        $credentials = $em->createQueryBuilder()
            ->select('c, p')
            ->from('AppBundle:ApiCredential', 'c')
            ->innerJoin('c.apiProvider', 'p')
            ->orderBy('p.name', 'ASC')
            ->getQuery()
            ->execute();

        return $this->render('configure/api_credentials.html.twig', ['credentials' => $credentials, 'form' => $form->createView()]);

    }


}
