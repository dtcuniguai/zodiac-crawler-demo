<?php

namespace App\Repository;


use App\Model\DailyZodiac;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class DailyZodiacRepository
{
    private $zodiac;

    public function __construct(DailyZodiac $dailyZodiac)
    {
        $this->zodiac = $dailyZodiac;
    }

    public function newDailyZodiac($form)
    {
        return $this->zodiac->create($form);
    }

    public function getEachZodiacID($condition): Builder
    {
        $query = "MAX(id) as id, zodiac, MAX(created_at) as created_at";
        $builder = $this->zodiac->select(DB::raw($query));

        if ($condition && isset($condition['zodiac'])) {
            $builder = $builder->where('zodiac', $condition['zodiac']);
        }
        if ($condition && isset($condition['time'])) {
            $builder = $builder->havingRaw('created_at < "'.$condition['time']. '"');
        }

        return $builder->groupBy('zodiac');
    }

    public function getZodiacByIDs($ids) : Builder
    {
        $zodiacs = $this->zodiac;
        return $zodiacs->whereIn('id', $ids);
    }
}