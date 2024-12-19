<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportLike extends Model
{
    use HasFactory;
    protected $table = 'likes';
    protected $fillable = ['user_id', 'report_id'];
    public function report()
    {
        $this->belongsTo(Report::class);
    }
    
    public function user()
    {
        $this->belongsTo(User::class);
    }
}
