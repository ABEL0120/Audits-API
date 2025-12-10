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
        return Hashids::connection($this->getHashidsConnection())->encode(parent::getRouteKey());
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
        if ($field) {
            return parent::resolveRouteBinding($value, $field);
        }

        $decoded = Hashids::connection($this->getHashidsConnection())->decode($value);

        if (empty($decoded)) {
            return null;
        }

        return $this->where($this->getKeyName(), $decoded[0])->first();
    }

    /**
     * Get the HashId attribute.
     *
     * @return string
     */
    public function getHashIdAttribute()
    {
        return Hashids::connection($this->getHashidsConnection())->encode($this->getKey());
    }

    /**
     * Get the Hashids connection name.
     *
     * @return string
     */
    protected function getHashidsConnection()
    {
        return property_exists($this, 'hashidsConnection') ? $this->hashidsConnection : 'main';
    }
}
