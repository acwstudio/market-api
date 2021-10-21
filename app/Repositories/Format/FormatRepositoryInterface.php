<?php

declare(strict_types=1);

namespace App\Repositories\Format;

use App\Http\Requests\Format\DetailRequest;
use App\Http\Requests\Format\ListRequest;
use App\Http\Resources\FormatCollection;
use App\Http\Resources\FormatResource;

interface FormatRepositoryInterface
{
    public function getFormatsByFilters(ListRequest $request): FormatCollection;

    public function getFormatDetailByFilters(DetailRequest $request): FormatResource;
}
