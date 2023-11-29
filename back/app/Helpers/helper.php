<?php

/**
 * Return front folder path.
 */
function frontPath(string $next = null): string
{
    return \Str::remove('back\storage\app', storage_path('app')) . "front\\$next";
}
