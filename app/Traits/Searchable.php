<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    /**
     * Scope for searching on fields with full text search index
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $value
     * @param  array  $fields
     * @return $this
     */
    public function scopeSearch(Builder $query, string $value, array $fields = [])
    {
        $value = $this->prepareSearchValue($value);
        $fields = $this->searchable ?: $fields;
        $fieldsString = $this->prepareSearchFields($fields);

        return $query->where(function ($query) use ($fieldsString, $fields, $value) {
            $query->whereRaw('match('.$fieldsString.') against (? in boolean mode)', [$value]);
            foreach ($fields as $field) {
                $query->orWhere($field, 'LIKE', '%'.$value.'%');
            }
        });
    }

    /**
     * Scope for searching on fields with full text search index
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $value
     * @param  array  $fields
     * @return $this
     */
    public function scopeOrSearch(Builder $query, string $value, array $fields = [])
    {
        $value = $this->prepareSearchValue($value);
        $fields = $this->searchable ?: $fields;
        $fieldsString = $this->prepareSearchFields($fields);

        return $query->orWhere(function ($query) use ($fieldsString, $fields, $value) {
            $query->whereRaw('match('.$fieldsString.') against (? in boolean mode)', [$value]);
            foreach ($fields as $field) {
                $query->orWhere($field, 'LIKE', '%'.$value.'%');
            }
        });
    }

    /**
     * Scope for searching translations on fields with full text search index
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $value
     * @param  array  $fields
     * @param  string|null  $locale
     * @return $this
     */
    public function scopeSearchTranslation(Builder $query, string $value, array $fields = [], $locale = null)
    {
        return $query->whereHas('translations', function (Builder $q) use ($value, $fields, $locale) {
            if ($locale) {
                $q->where($this->getLocaleKey(), '=', $locale);
            }

            $q->search($value, $fields);
        });
    }

    /**
     * Scope for searching translations on fields with full text search index
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $value
     * @param  array  $fields
     * @param  string|null  $locale
     * @return $this
     */
    public function scopeOrSearchTranslation(Builder $query, string $value, array $fields = [], $locale = null)
    {
        return $query->orWhereHas('translations', function (Builder $q) use ($value, $fields, $locale) {
            if ($locale) {
                $q->where($this->getLocaleKey(), '=', $locale);
            }

            $q->search($value, $fields);
        });
    }

    /**
     * Prepare values for search
     *
     * @param  string  $value
     * @return string
     */
    protected function prepareSearchValue(string $value) : string
    {
        $valueArray = explode(' ', str_slug($value, ' '));

        $value = '';
        foreach ($valueArray as $q) {
            $value .= '+'.$q.'* ';
        }

        return trim($value);
    }

    /**
     * Prepare fields for search
     *
     * @param  array  $fields
     * @return string
     */
    protected function prepareSearchFields(array $fields = []) : string
    {
        return implode(', ', $this->searchable ?: $fields);
    }
}

