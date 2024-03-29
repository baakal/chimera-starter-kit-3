<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Translatable\HasTranslations;

class Questionnaire extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $guarded = ['id'];
    protected $dates = ['start_date', 'end_date'];
    public $translatable = ['title'];

    public function getHomepageStatsAttribute()
    {
        return Stat::published()
            ->whereQuestionnaire($this->name)
            ->get();
    }

    public function scopeActive($query)
    {
        return $query->where('connection_active', true);
    }

    public function scopeShowOnHomePage($query)
    {
        return $query->where('show_on_home_page', true);
    }

    private function testCanConnect()
    {
        try {
            DB::connection($this->name)->getPdo();
            return ['passes' => true, 'message' => ''];
        } catch (\Exception $exception) {
            return ['passes' => false, 'message' => $exception->getMessage()];
        }
    }

    private function hasNecessaryTables()
    {
        try {
            $tables = array_map('reset', DB::connection($this->name)->select('SHOW TABLES'));
            if (count(array_intersect($tables, ['cases', 'cspro_jobs', 'level-1'])) === 3) {
                return ['passes' => true, 'message' => ''];
            } else {
                return ['passes' => false, 'message' => 'Some required tables are missing from the database'];
            }
        } catch (\Exception $exception) {
            return ['passes' => false, 'message' => $exception->getMessage()];
        }
    }

    public function test()
    {
        $result = collect([]);
        $result->add($this->testCanConnect());
        //$result->add($this->hasNecessaryTables());
        return $result;
    }
}
