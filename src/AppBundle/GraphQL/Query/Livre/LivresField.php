<?php

namespace AppBundle\GraphQL\Query\Livre;

use AppBundle\GraphQL\Type\LivreType;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\AbstractType;
use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQLBundle\Field\AbstractContainerAwareField;

class LivresField extends AbstractContainerAwareField {

    public function resolve($value, array $args, ResolveInfo $info) {
        return $this->container->get('resolver.livre')->findAll();
    }

    /**
     * @return AbstractObjectType|AbstractType
     */
    public function getType() {
        return new ListType(new LivreType());
    }
    
    public function getName() {
        return "livres";
    }

}
