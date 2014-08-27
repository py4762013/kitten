<?php

class Article extends \Eloquent {
	protected $fillable = array('title', 'img', 'description', 'user_id');

    public static $rules = array(
        'title' => 'required|between:1,36',
        'description' => 'required|min:3',
        'img' => 'required|mimes:jpeg,bmp,png'
    );

    /*
     * Get the article's author
     *
     * @return User
     */
    public function author()
    {
        return $this->belongsTo('User', 'user_id');
    }
}