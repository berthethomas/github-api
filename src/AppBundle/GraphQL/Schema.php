<?php

/**
 * This class was automatically generated by GraphQL Schema generator
 */

namespace AppBundle\GraphQL;

use Youshido\GraphQL\Schema\AbstractSchema;
use Youshido\GraphQL\Config\Schema\SchemaConfig;
use Youshido\GraphQL\Type\Scalar\StringType;
use AppBundle\GraphQL\Query\QueryType;

class Schema extends AbstractSchema {

    public function build(SchemaConfig $config) {
        $config->setQuery(new QueryType());
    }

}
