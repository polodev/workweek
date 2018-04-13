<?php

namespace App;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
  protected $guarded = [];
  public function user()
  {
    return $this->belongsTo(User::class);
  }
   public function scopeFilter($query, $filters) {
    if (isset($filters['topic'])) {
      $query->where('topic', $filters['topic']);
    }


    if (isset($filters['start']) && isset($filters['end']) && !empty($filters['start']) && !empty($filters['end'])  ) {
      $start = Carbon::parse($filters['start'])->toDateString();
      $end = Carbon::parse($filters['end'])->toDateString();
      $query->whereBetween('created_at', [$start, $end]);
    } else if (isset($filters['start']) && !empty($filters['start'])  ) {
      $start = Carbon::parse($filters['start'])->toDateString();
      $query->where('created_at', '>=', $start);
    } else if (isset($filters['end']) && !empty($filters['start'])  ) {
      $end = Carbon::parse($filters['end'])->toDateString();
      $query->where('created_at', '<=', $end);
    }
}
}
