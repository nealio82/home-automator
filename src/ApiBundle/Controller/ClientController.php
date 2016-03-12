<?php

namespace ApiBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\SensorType;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ClientController extends Controller
{
    /**
     * @Route("/admin/api_client", name="configure_api_client")
     */
    public function configureAction(Request $request)
    {

        $clientManager = $this->get('fos_oauth_server.client_manager.default');
        $client = $clientManager->createClient();
        $client->setRedirectUris(array(
            $this->generateUrl('configure_sensors', array(), UrlGeneratorInterface::ABSOLUTE_URL)
        ));
        $client->setAllowedGrantTypes(array('token', 'authorization_code'));
        $clientManager->updateClient($client);

        return $this->redirect($this->generateUrl('fos_oauth_server_authorize', array(
            'client_id' => $client->getPublicId(),
            'redirect_uri' => $this->generateUrl('configure_sensors', array(), UrlGeneratorInterface::ABSOLUTE_URL),
            'response_type' => 'code'
        )));

    }

}
