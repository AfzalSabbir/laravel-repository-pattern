<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use stdClass;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $fillable = ['title', 'description'];

    /**
     * @return stdClass
     */
    public
    function format(): stdClass
    {
        $post               = new stdClass();
        $post->id           = $this->id;
        $post->title        = $this->title;
        $post->description  = $this->description;
        $post->created      = Carbon::parse($this->created_at)->diffForHumans();
        $post->last_updated = Carbon::parse($this->updated_at)->diffForHumans();

        return $post;
    }
}
