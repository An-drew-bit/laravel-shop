<?php

namespace App\Menu;

use Support\Traits\Makeable;

final class MenuItem
{
    use Makeable;

    const BASE_PATH = '/';

    public function __construct(
        protected string $link,
        protected string $label
    )
    {
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function isActive(): bool
    {
        $path = parse_url($this->getLink(), PHP_URL_PATH) ?? self::BASE_PATH;

        if ($path === self::BASE_PATH) {
            return request()->path() === $path;
        }

        return request()->fullUrlIs($this->getLink() . '*');
    }
}
