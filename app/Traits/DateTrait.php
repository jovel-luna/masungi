<?php

namespace App\Traits;

use App\Helpers\ObjectHelpers;

trait DateTrait 
{
    public function renderDate($column = 'created_at', $format = 'M d, Y (H:i:s)') {
        $date = null;

        if (isset($this->$column) && $this->$column) {
            $date = $this->$column->format($format);
        }

        return $date;
    }

        public function renderDateNews($column = 'created_at', $format = 'M d, Y') {
        $date = null;

        if (isset($this->$column) && $this->$column) {
            $date = $this->$column->format($format);
        }

        return $date;
    }
}