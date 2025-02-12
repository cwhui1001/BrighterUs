<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\University;
use App\Models\Field;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'field_id', 'university_id', 'location', 'budget', 'ranking'];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function location() {
        return $this->belongsTo(Location::class);
    }

    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }

    public function ranking()
    {
        return $this->belongsTo(Ranking::class);
    }

    public function category()
    {
        return $this->belongsTo(CourseCategory::class);
    }
}
