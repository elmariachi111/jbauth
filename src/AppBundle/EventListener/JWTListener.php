<?php

namespace AppBundle\EventListener;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTAuthenticatedEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Wheeler\Fortune\Fortune;

class JWTListener
{
    /**
     * @param JWTCreatedEvent $event
     *
     * @return void
     */
    public function onJWTCreated(JWTCreatedEvent $event)
    {
        $payload       = $event->getData();
        $payload['fortune'] = Fortune::make();
        $event->setData($payload);
    }

    /**
     * @param JWTAuthenticatedEvent $event
     *
     * @return void
     */
    public function onJWTAuthenticated(JWTAuthenticatedEvent $event)
    {
        $token = $event->getToken();
        $payload = $event->getPayload();
        $token->setAttribute('fortune', $payload['fortune']);
        $token->setAttribute('expires', new \DateTime('@' . $payload['exp']));
        $token->setAttribute('issued', new \DateTime('@' . $payload['iat']));
    }
}