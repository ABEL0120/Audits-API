<?php

namespace App\Traits;

use Vinkla\Hashids\Facades\Hashids;

trait HashId
{
    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        return parent::getRouteKey();
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        return parent::resolveRouteBinding($value, $field);
    }

    /**
     * Get the HashId attribute.
     *
     * @return string
     */
    public function getHashIdAttribute()
    {
        return $this->getKey();
    }

    /**
     * Get the Hashids connection name.
     *
     * @return string
     */
    protected function getHashidsConnection()
    {
        return 'main';
    }

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        return parent::toArray();
    }
}
