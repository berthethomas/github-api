<?php

namespace AppBundle\GraphQL\Query\Auteur;

use AppBundle\GraphQL\Type\AuteurType;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\AbstractType;
use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQLBundle\Field\AbstractContainerAwareField;

class AuteursField extends AbstractContainerAwareField {

    public function resolve($value, array $args, ResolveInfo $info) {
        return $this->container->get('resolver.auteur')->findAll();
    }

    /**
     * @return AbstractObjectType|AbstractType
     */
    public function getType() {
        return new ListType(new AuteurType());
    }
    
    public function getName() {
        return "auteurs";
    }

}
