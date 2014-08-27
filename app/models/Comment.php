<?php

class Comment extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
        'content' => 'required|min:3'
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['user_id','article_id','content'];

    public  function article()
    {
        return $this->belongsTo('Article', 'article_id');
    }

    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }

}