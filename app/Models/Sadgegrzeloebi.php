<?php

namespace Models;

use Models\Abstracts\Model;
use Models\Traits\FileableTrait;
use Models\Traits\HasCollection;
use Models\Traits\LanguageTrait;

class Sadgegrzeloebi extends Model
{
    use HasCollection, LanguageTrait, FileableTrait;

    /**
     * Type of the collection.
     *
     * @var string
     */
    const TYPE = 'sadgegrzeloebi';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sadgegrzeloebi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'collection_id', 'slug', 'position', 'visible', 'image', 'tags', 'created_at'
    ];

    /**
     * The attributes that are not updatable.
     *
     * @var array
     */
    protected $notUpdatable = [];

    /**
     * Related database table name used by the Language model.
     *
     * @var string
     */
    protected $languageTable = 'sadgegrzeloebi_languages';

    /**
     * The attributes that are mass assignable for the Language model.
     *
     * @var array
     */
    protected $languageFillable = [
        'sadgegrzeloebi_id', 'language', 'title', 'description', 'content'
    ];

    /**
     * The attributes that are not updatable for the Language model.
     *
     * @var array
     */
    protected $languageNotUpdatable = [
        'sadgegrzeloebi_id', 'language'
    ];


    public function categories(){
        return $this->belongsToMany(Category::class, SadgegrzeloCategory::class);
    }

    public function getCategoriesAttribute(){
        return $this->categories()->pluck('categories.id')->toArray();
    }
}
