<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DemoController extends Controller
{
    /**
     * @Route("/api/demo", name="api_demo")
     */
    public function articlesAction()
    {
        $articles = array('article1', 'article2', 'article3');
        return new JsonResponse($articles);
    }

    /**
     * @Route("/api/users", name="api_users")
     */
    public function userAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if($user) {
            return new JsonResponse(array(
                'id' => $user->getId(),
                'username' => $user->getUsername()
            ));
        }

        return new JsonResponse(array(
            'message' => 'User is not identified'
        ));

    }
}
