<?php

namespace App\Traits;

trait HelperTrait
{
    public function getValidOrderDirection($orderDirection, $orderDirectionDefault = 'desc')
    {
        if (!in_array($orderDirection, ['asc', 'desc'])) {
            $orderDirection = $orderDirectionDefault;
        }
        return $orderDirection;
    }
}
