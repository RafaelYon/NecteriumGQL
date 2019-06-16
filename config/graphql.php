<?php

return [
    /**
     * Todo ObjectType deve implementar o contrato App\Contracts\GraphQL\Types\ObjectType
     */
    'schema' => [
        'query' => \App\GraphQL\Types\Query::getDefinition()
    ]
];