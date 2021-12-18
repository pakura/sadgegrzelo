<?php

namespace Models;

use Models\Abstracts\Model;
use Models\Traits\FileableTrait;
use Models\Traits\HasCollection;
use Models\Traits\LanguageTrait;

class SadgegrzeloCategory extends Model
{
    /**
     * Type of the collection.
     *
     * @var string
     */
    const TYPE = 'sadgegrzelo_category';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sadgegrzelo_category';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sadgegrzeloebi_id', 'category_id', 'created_at'
    ];

    /**
     * The attributes that are not updatable.
     *
     * @var array
     */
    protected $notUpdatable = [];

}
