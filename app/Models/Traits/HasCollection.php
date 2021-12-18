<?php

namespace Models\Traits;

use Models\Collection;

trait HasCollection
{
    use PageableTrait, PositionableTrait;

    /**
     * Get the data based on the admin collection.
     *
     * @param  \Models\Collection  $collection
     * @param  array  $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAdminCollection(Collection $collection, $columns = ['*'])
    {
        return $this->adminCollection($collection)
            ->paginate($collection->admin_per_page, $columns);
    }

    /**
     * Get the data based on the public collection.
     *
     * @param  \Models\Collection  $collection
     * @param  array  $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPublicCollection(Collection $collection, $columns = ['*'])
    {
        return $this->publicCollection($collection)
            ->paginate($collection->web_per_page, $columns);
    }

    /**
     * Build a query based on the admin collection.
     *
     * @param  \Models\Collection  $collection
     * @return \Models\Builder\Builder
     */
    public function adminCollection(Collection $collection)
    {
        return $this->forAdmin($collection->id)
            ->orderBy($this->getTable() . '.' . $collection->admin_order_by, $collection->admin_sort);
    }

    /**
     * Build a query based on the public collection.
     *
     * @param  \Models\Collection  $collection
     * @return \Models\Builder\Builder
     */
    public function publicCollection(Collection $collection)
    {
        return $this->forPublic($collection->id)
            ->orderBy($this->getTable() . '.' . $collection->web_order_by, $collection->web_sort);
    }

    /**
     * Build an admin query.
     *
     * @param  int|null  $id
     * @param  mixed  $language
     * @param  array  $columns
     * @return \Models\Builder\Builder
     */
    public function forAdmin($id = null, $language = true, array $columns = [])
    {
        return $this->when(! is_null($id), function ($q) use ($id) {
            return $q->collectionId($id);
        })->joinLanguage($language, $columns);
    }

    /**
     * Build a public query.
     *
     * @param  int|null  $id
     * @param  mixed  $language
     * @param  array  $columns
     * @return \Models\Builder\Builder
     */
    public function forPublic($id = null, $language = true, array $columns = [])
    {
        return $this->when(! is_null($id), function ($q) use ($id) {
            return $q->collectionId($id);
        })->joinLanguage($language, $columns)->whereVisible();
    }

    /**
     * Build a query based on the slug.
     *
     * @param  string  $slug
     * @param  int|null  $id
     * @return \Models\Builder\Builder
     */
    public function bySlug($slug, $id = null)
    {
        return $this->where('slug', $slug)->forPublic($id);
    }

    /**
     * Get the same type collection instance.
     *
     * @param  string|null  $type
     * @return \Models\Builder\Builder
     */
    public function byType($type = null)
    {
        return (new Collection)->where(
            'type', is_null($type) ? static::TYPE : $type
        );
    }

    /**
     * Add a where "collection_id" clause to the query.
     *
     * @param  int  $id
     * @return \Models\Builder\Builder
     */
    public function collectionId($id)
    {
        return $this->where('collection_id', $id);
    }

    /**
     * Add a where "visible" clause to the query.
     *
     * @param  int  $value
     * @return \Models\Builder\Builder
     */
    public function whereVisible($value = 1)
    {
        return $this->where('visible', $value);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $attributes = [])
    {
        if (empty($attributes['position'])) {
            if (isset($attributes['collection_id'])) {
                $attributes['position'] = $this->collectionId($attributes['collection_id'])
                        ->max('position') + 1;
            } else {
                $attributes['position'] = $this->max('position') + 1;
            }
        }

        return parent::create($attributes);
    }
}
