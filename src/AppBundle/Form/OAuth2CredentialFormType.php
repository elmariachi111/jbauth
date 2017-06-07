<?php

namespace AppBundle\Form;

use AppBundle\Entity\OAuth\Client;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OAuth2CredentialFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var Client $client */
        $client = $options['client'];

        $builder
            ->add('grant_type', HiddenType::class, ['data' => 'password'])
            ->add('client_id', HiddenType::class, [
                'data' => $client->getPublicId()
            ])
            ->add('client_secret', HiddenType::class, [
                'data' => $client->getSecret() //this obviously is a security leak ;)
            ])
            ->add('username', TextType::class)
            ->add('password', PasswordType::class)
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-default'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'client' => null
        ]);
    }

    public function getBlockPrefix()
    {
        return null;
    }
}
