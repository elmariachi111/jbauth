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
     * @Route("/sshhh", name="secret")
     */
    public function secretAction() {
        return $this->render('secret/sshhh.html.twig');
    }
}
