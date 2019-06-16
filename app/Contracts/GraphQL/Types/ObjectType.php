<?php

namespace App\Contracts\GraphQL\Types;

use GraphQL\Type\Definition\ObjectType as VendorObjectType;

interface ObjectType
{
    public static function getDefinition() : VendorObjectType;
}