<?php

namespace Domain\Catalog\Builders;

use Illuminate\Database\Eloquent\Builder;

final class CategoryBuilder extends Builder
{
   public function homePage(): Builder
   {
       return $this->select(['id', 'title', 'slug'])
           ->where('on_home_page', true)
           ->orderBy('sorting')
           ->limit(6);
   }
}
