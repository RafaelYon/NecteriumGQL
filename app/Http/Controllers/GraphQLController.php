<?php

namespace App\Http\Controllers;

use Exception;

use GraphQL\GraphQL;
use GraphQL\Type\Schema;

use App\Http\Controllers\Controller;
use App\Http\Request;

class GraphQLController extends Controller
{
    /**
     * Obtem o valor root da Query do GraphQL.
     * Rescreva este método para adicionar sua lógica personalizada.
     */
    protected function getRootValue(Request $request, string $query, $variableValues)
    {
        return null;
    }

    /**
     * Obtem o Context da Query do GraphQL.
     * Rescreva este método para adicionar sua lógica personalizada.
     */
    protected function getContext(Request $request, string $query, $variableValues)
    {
        return null;
    }

    /**
     * Obtem a Schema para Query do GraphQL.
     * Rescreva este método para adicionar sua lógica personalizada.
     */
    protected function createSchema(Request $request) : Schema
    {
        return new Schema(config('graphql.schema'));
    }

    /**
     * Obtem a Query para o GraphQL processar
     * Rescreva este método para adicionar sua lógica personalizada.
     */
    protected function prepareQuery(Request $request, string $query, $variableValues) : string
    {
        return $query;
    }

    /**
     * Obtem os Valores da Variaveis para Query do GraphQL.
     * Rescreva este método para adicionar sua lógica personalizada.
     */
    protected function prepareVariableValues(Request $request, string $query, $variableValues)
    {
        return $variableValues;
    }

    protected function handler(Request $request)
    {
        $output = [];
        
        try
        {        
            $input = json_decode($request->getRawInput(), true);

            $query = $input['query'];
            $variableValues = !empty($input['variables']) ? $input['variables'] : null;

            $result = GraphQL::executeQuery(
                $this->createSchema($request),
                $this->prepareQuery($request, $query, $variableValues),
                $this->getRootValue($request, $query, $variableValues),
                $this->getContext($request, $query, $variableValues),
                $this->prepareVariableValues($request, $query, $variableValues)
            );

            $output = $result->toArray();
        } 
        catch (Exception $e)
        {
            $output = [
                'errors' => [
                    [
                        'message' => $e->getMessage()
                    ]
                ]
            ];
        }

        return $output;
    }

    public function response(Request $request)
    {
        return response($this->handler($request))->json();
    }
}