<?php

namespace App\Traits;

use Vinkla\Hashids\Facades\Hashids;

trait DecodesHashIds
{
    protected function prepareForValidation()
    {
        $this->merge($this->decodeHashIds($this->all()));
    }

    protected function decodeHashIds(array $input)
    {
        // If the request defines specific keys to decode
        if (property_exists($this, 'hashKeys')) {
            foreach ($this->hashKeys as $key) {
                if (isset($input[$key])) {
                    if (is_string($input[$key])) {
                        $decoded = Hashids::decode($input[$key]);
                        if (!empty($decoded)) {
                            $input[$key] = $decoded[0];
                        }
                    } elseif (is_array($input[$key])) {
                        foreach ($input[$key] as $index => $val) {
                            if (is_string($val)) {
                                $decoded = Hashids::decode($val);
                                if (!empty($decoded)) {
                                    $input[$key][$index] = $decoded[0];
                                }
                            }
                        }
                    }
                }
            }
        }

        return $input;
    }
}
