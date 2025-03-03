<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\University;
use App\Models\Field;

class Course extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $fillable = ['name', 'description', 'category_id', 'field_id', 'university_id', 'location_id', 'budget', 'ranking_id', 'link'];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function location() {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }

    public function ranking()
    {
        return $this->belongsTo(Ranking::class, 'ranking_id');
    }

    public function category()
    {
        return $this->belongsTo(CourseCategory::class);
    }
}
