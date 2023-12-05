<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\StaticVar;

class UserReadModel extends Model
{
    use HasFactory;
    protected $table = 'userread';
    protected $fillable = ['user_id', "news_id"];
    public $timestamps = false;

    public static function findOrCreate($user_id, $new_id): void
    {
        $item = UserReadModel::where('user_id', $user_id)->where('news_id', $new_id)->first();
        if (!$item) {
            UserReadModel::create([
                'user_id' => $user_id,
                'news_id' => $new_id
            ]);
        }
    }
}
