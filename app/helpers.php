<?php

use Illuminate\Support\Str;

function createSlug($string, $model)
{
    $slug = Str::slug($string);
    $original = $slug;
    $count = 1;

    while ($model::where('slug', $slug)->exists()) {
        $slug = "{$original}-{$count}";
        $count++;
    }

    return $slug;
}
