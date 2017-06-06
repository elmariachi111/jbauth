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
    public function secretAction() {
        return $this->render('secret/basic_auth.html.twig');
    }
}
