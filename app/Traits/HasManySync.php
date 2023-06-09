<?php

namespace App\Traits;

use App\Relations\HasManySyncable;

trait HasManySync
{
    /**
     * Overrides the default Eloquent hasMany relationship to return a HasManySyncable.
     *
     * {@inheritDoc}
     */
    public function hasMany($related, $foreignKey = null, $localKey = null): HasManySyncable
    {
        $instance = $this->newRelatedInstance($related);

        $foreignKey = $foreignKey ?: $this->getForeignKey();

        $localKey = $localKey ?: $this->getKeyName();

        return new HasManySyncable(
            $instance->newQuery(),
            $this,
            $instance->getTable().'.'.$foreignKey,
            $localKey
        );
    }
}
