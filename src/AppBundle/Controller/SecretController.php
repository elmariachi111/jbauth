<?php

namespace AppBundle\Controller;

use AppBundle\Entity\OAuth\AccessToken;
use FOS\OAuthServerBundle\Security\Authentication\Token\OAuthToken;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Authentication\Token\JWTUserToken;
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
        /** @var OAuthToken $token */
        $token = $this->get('security.token_storage')->getToken();

        /** @var AccessToken $accessToken */
        $accessToken = $this->getDoctrine()->getRepository(AccessToken::class)->findOneBy(
            ['token' => $token->getToken()]
        );

        return $this->render('secret/oauth.html.twig', [
            'accessToken' => $accessToken
        ]);
    }

    /**
     * @Route("/jwt", name="secret_jwt")
     */
    public function jwtAction() {
        /** @var JWTUserToken $token */
        $token = $this->get('security.token_storage')->getToken();
        return $this->render('secret/jwt.html.twig', [
            'payload' => $token->getAttributes()
        ]);
    }
}
