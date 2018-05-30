<?php

namespace AppBundle\GraphQL\Query\Livre;

use AppBundle\GraphQL\Type\LivreType;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\AbstractType;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQLBundle\Field\AbstractContainerAwareField;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Type\Scalar\IntType;
use Youshido\GraphQL\Type\NonNullType;

class FindLivreField extends AbstractContainerAwareField {

    public function resolve($value, array $args, ResolveInfo $info) {
        $this->container->get('resolver.security')->checkTokenAuthentification();
        
        return $this->container->get('resolver.livre')->find($args['id']);
    }

    public function build(FieldConfig $config) {
        $config->addArgument('id', new NonNullType(new IntType()));
    }

    /**
     * @return AbstractObjectType|AbstractType
     */
    public function getType() {
        return new LivreType();
    }

    public function getName() {
        return "livre";
    }

}
