<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/secret")
 */
class SecretController extends Controller
{
    /**
     * @Route("/basic_auth", name="secret_basic_auth")
     */
    public function basicAuthAction() {
        return $this->render('secret/basic_auth.html.twig');
    }

    /**
     * @Route("/oauth", name="secret_oauth")
     */
    public function oauthAction() {
        return $this->render('secret/oauth.html.twig');
    }
}
