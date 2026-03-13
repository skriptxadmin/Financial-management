<?php
    use CodeIgniter\Model;

// app/Helpers/SlugHelper.php

if (!function_exists('generateUniqueSlug')) {


    /**
     * Generate a unique slug for a table.
     *
     * @param string $name
     * @param Model $model
     * @param string $field
     * @return string
     */
    function generateUniqueSlug(string $name, Model $model, string $field = 'slug'): string
    {
        // Convert name to basic slug
        $slug = url_title($name, '-', true);
        $originalSlug = $slug;

        // Check for uniqueness
        $count = 1;
        while ($model->where($field, $slug)->first()) {
            $randomString = substr(md5(uniqid()), 0, 6);
            $slug = $originalSlug . '-' . $randomString;
            $count++;
            if ($count > 10) break; // prevent infinite loop
        }

        return $slug;
    }
}