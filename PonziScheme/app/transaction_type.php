<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaction_type extends Model
{
    public $fillable = ['type'];

    public function  ColumnListing()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
