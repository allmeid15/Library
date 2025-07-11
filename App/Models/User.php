<?php
namespace App\Models;

use App\Controllers\BorrowController;
use Illuminate\Database\Eloquent\Model ;

class User extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'country',
        'city',
        'address',
        'phone',
        'status',
        'email',
        'password',
    ];

    public function borrows()
    {
        return $this->hasMany(BorrowController::class);
    }
}