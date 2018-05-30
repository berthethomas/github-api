<?php

namespace AppBundle\GraphQL\Query\Auteur;

use AppBundle\GraphQL\Type\AuteurType;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\AbstractType;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQLBundle\Field\AbstractContainerAwareField;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Type\Scalar\IntType;
use Youshido\GraphQL\Type\NonNullType;

class FindAuteurField extends AbstractContainerAwareField {

    public function resolve($value, array $args, ResolveInfo $info) {
        return $this->container->get('resolver.auteur')->find($args['id']);
    }

    public function build(FieldConfig $config) {
        $config->addArgument('id', new NonNullType(new IntType()));
    }

    /**
     * @return AbstractObjectType|AbstractType
     */
    public function getType() {
        return new AuteurType();
    }

    public function getName() {
        return "auteur";
    }

}
