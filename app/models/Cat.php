<?php

class Cat extends \Eloquent {
	protected $fillable = ['name', 'img', 'birthday', 'user_id', 'breed_id'];

    public static $rules = array(
        'name' => 'required',
        'img' => 'mimes:jpeg,bmp,png',
        'birthday' => 'required'
    );

    /*
     * Get the Cat's host
     *
     * @return User
     */
    public function host()
    {
       return $this->belongsTo('User', 'user_id');
    }

    /*
     * Get the Cat's breed()
     *
     * @return Breed
     */
    public function breed()
    {
        return $this->belongsTo('Breed', 'breed_id');
    }
}