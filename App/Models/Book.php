<?php
namespace App\Models;

use App\Controllers\BorrowController;
use Illuminate\Database\Eloquent\Model ;

class Book extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'photo',
        'isbn',
        'cover',
        'gallery',
        'published',
    ];

    public  function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    public function borrows()
    {
        return $this->hasMany(BorrowController::class);
    }
}