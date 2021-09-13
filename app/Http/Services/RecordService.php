<?php

namespace App\Http\Services;

use App\Models\Record;
use Illuminate\Support\Facades\Auth;

class RecordService
{
    /**
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function getRecords()
    {
        $column = Auth::user()->is_manager ? 'manager_id' : 'id';

        return Record::with(['image', 'category', 'user:id,name'])
            ->whereRelation('user', $column, Auth::id())
            ->simplePaginate(10);
    }
}
