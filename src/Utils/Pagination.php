<?php

use Illuminate\Support\Collection;

function paginate(Collection $data): array
{
    $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, ['options' => ['default' => 1, 'min_range' => 1]]);
    $perPage = filter_input(INPUT_GET, 'per_page', FILTER_VALIDATE_INT, ['options' => ['default' => 10, 'min_range' => 1, 'max_range' => 50]]);

    $total = $data->count();
    $offset = ($page - 1) * $perPage;

    return [
        'items' => $data->slice($offset, $perPage)->values(),
        'page' => $page,
        'perPage' => $perPage,
        'totalPages' => ceil($total / $perPage),
        'totalItems' => $total,
        'start' => $offset + 1,
        'end' => min($offset + $perPage, $total)
    ];
}
