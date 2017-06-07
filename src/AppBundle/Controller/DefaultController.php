<?php

namespace AppBundle\Controller;

use AppBundle\Entity\OAuth\Client;
use AppBundle\Form\JwtCredentialFormType;
use AppBundle\Form\OAuth2CredentialFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $oauthClient = $this->getDoctrine()->getRepository(Client::class)->findOneBy([]);

        $oauthForm = $this->createForm(OAuth2CredentialFormType::class, null, [
            'action' => $this->generateUrl('fos_oauth_server_token'),
            'method' => Request::METHOD_POST,
            'client' => $oauthClient
        ]);

        $jwtForm = $this->createForm(JwtCredentialFormType::class, null, [
            'action' => $this->generateUrl('jwt_login_check'),
            'method' => Request::METHOD_POST,
        ]);

        return $this->render('default/index.html.twig', [
            'oauthForm' => $oauthForm->createView(),
            'jwtForm' => $jwtForm->createView()
        ]);
    }

}
