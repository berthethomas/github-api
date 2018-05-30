<?php

namespace AppBundle\GraphQL\Mutation\Commentaire;

use AppBundle\GraphQL\Type\LivreType;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\AbstractType;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Type\Scalar\StringType;
use Youshido\GraphQL\Type\Scalar\FloatType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQLBundle\Field\AbstractContainerAwareField;

class AddCommentaireField extends AbstractContainerAwareField {

    public function build(FieldConfig $config) {
        $config->addArguments([
            'texte' => new NonNullType(new StringType()),
            'note' => new NonNullType(new FloatType()),
            'livre_id' => new NonNullType(new IdType())
        ]);
    }

    public function resolve($value, array $args, ResolveInfo $info) {
        $this->container->get('resolver.security')->checkTokenAuthentification();
        
        return $this->container->get('resolver.commentaire')->add($args['texte'], $args['note'], $args['livre_id']);
    }

    /**
     * @return AbstractObjectType|AbstractType
     */
    public function getType() {
        return new LivreType();
    }

    public function getName() {
        return 'addCommentaire';
    }

}
