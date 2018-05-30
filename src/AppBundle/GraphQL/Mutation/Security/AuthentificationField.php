<?php

namespace AppBundle\GraphQL\Mutation\Security;

use AppBundle\GraphQL\Type\LivreType;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\AbstractType;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Type\Scalar\StringType;
use Youshido\GraphQLBundle\Field\AbstractContainerAwareField;

class AuthentificationField extends AbstractContainerAwareField {

    public function build(FieldConfig $config) {
        $config->addArguments([
            'token' => new NonNullType(new StringType())
        ]);
    }

    public function resolve($value, array $args, ResolveInfo $info) {
        return $this->container->get('resolver.security')->authentificate($args['token']);
    }

    /**
     * @return AbstractObjectType|AbstractType
     */
    public function getType() {
        return new StringType();
    }

    public function getName() {
        return 'authentification';
    }

}
