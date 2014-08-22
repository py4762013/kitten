<?php

class Breed extends \Eloquent {
	protected $fillable = [];

    /*
     * Get the Cat
     *
     * @return cat
     */
    public function cats()
    {
        $this->hasMany('Cat');
    }
}