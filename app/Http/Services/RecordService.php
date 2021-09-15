<?php

namespace App\Http\Services;

use App\Models\Image;
use App\Models\Record;
use \Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RecordService
{

    public function getRecords(): Paginator
    {
        $column = $this->getColumnByRole();

        return Record::with(['image', 'category', 'user:id,name'])
            ->whereRelation('user', $column, Auth::id())
            ->simplePaginate(10);
    }


    public function storeRecord($request): void
    {
        $imageName = Str::random(20) . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        DB::transaction(function () use($imageName, $request) {
                $image = Image::create(['url' => $imageName]);
                Record::create([
                    'title' => $request->title,
                    'category_id' => $request->category_id,
                    'image_id' => $image->id,
                    'user_id' => Auth::id()
                ]);
            });
    }

    public function getRecordsByCategory($categoryId)
    {
        $column = $this->getColumnByRole();

        return Record::with(['image', 'category', 'user:id,name'])
            ->whereRelation('user', $column, Auth::id())
            ->whereRelation('category', 'id', $categoryId)
            ->simplePaginate(10);
    }

    public function getRecordsByUser($userId)
    {
        return Record::with(['image', 'category', 'user:id,name'])
            ->whereRelation('user', 'id', $userId)
            ->simplePaginate(10);
    }

    private function getColumnByRole(): string
    {
        return Auth::user()->is_manager ? 'manager_id' : 'id';
    }
}
