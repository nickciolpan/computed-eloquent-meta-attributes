<?php
namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class AttributeScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        // We leave this empty as we're manipulating attribute retrieval in the model itself, not altering the SQL query
    }
}
