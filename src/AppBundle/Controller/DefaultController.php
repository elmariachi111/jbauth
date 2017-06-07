<?php

namespace AppBundle\Controller;

use AppBundle\Entity\OAuth\Client;
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
    public function indexAction(Request $request)
    {
        $oauthClient = $this->getDoctrine()->getRepository(Client::class)->findOneBy([]);

        $oauthForm = $this->createForm(OAuth2CredentialFormType::class, null, [
            'action' => $this->generateUrl('fos_oauth_server_token'),
            'method' => Request::METHOD_POST,
            'client' => $oauthClient
        ]);

        return $this->render('default/index.html.twig', [
            'oauthForm' => $oauthForm->createView()
        ]);
    }

}
