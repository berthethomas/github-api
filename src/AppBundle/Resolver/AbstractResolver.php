<?php

namespace AppBundle\Resolver;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\Container;

abstract class AbstractResolver {

    /** @var  EntityManagerInterface */
    protected $em;

    public function init(EntityManagerInterface $em, Container $container) {
        $this->em = $em;
        $this->container = $container;
    }

    protected function createNotFoundException($message = 'Entity not found') {
        return new \Exception($message, 404);
    }

    protected function createInvalidParamsException($message = 'Invalid params') {
        return new \Exception($message, 400);
    }

    protected function createAccessDeniedException($message = 'No access to this action') {
        return new \Exception($message, 403);
    }
    
    protected function createInvalidAuthentificationException($message = 'Authentification failed') {
        return new \Exception($message, 403);
    }

}
