<?php

class ArticlesController extends \BaseController {

    public function __construct(Article $article, User $user)
    {
        parent::__construct();
        $this->article = $article;
        $this->user = $user;
    }

	/**
	 * Display a listing of articles
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$articles = $this->article->orderby('created_at')->paginate(5);

		return View::make('articles.index', compact('articles'));
	}

	/**
	 * Show the form for creating a new article
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        if(Auth::check()){
		    return View::make('articles.create');
        }else{
            return Redirect::to('users/login')->withInfo('Please login first');
        }
	}

	/**
	 * Store a newly created article in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
        //$destinationPath = $_SERVER['DOCUMENT_ROOT'] ."/design/img/";
        $destinationPath = public_path().'/design/img';

        $messages = array(
            'required'  => 'The :attribute field is required.',
            'between'   => 'The :attribute must be between :min - :max',
            'min'        => 'The :attribute must be big than :min',
            'mimes'     => 'The :attribute must be jpeg,bmp,png',
        );

		$validator = Validator::make($data = Input::all(), Article::$rules, $messages);

		if ($validator->fails())
		{
			return Redirect::back()->withError($validator->messages())->withInput();
		}

        $name = Input::file('img')->getClientOriginalName();
        $data['img'] = $name;
        $data['user_id'] = Auth::user()->id;

        Input::file('img')->move($destinationPath, $name);

		Article::create($data);

		return Redirect::to('articles/index');
	}

	/**
	 * Display the specified article.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{
		$article = Article::findOrFail($id);

		return View::make('articles.show', compact('article'));
	}

	/**
	 * Show the form for editing the specified article.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		$article = Article::find($id);

		return View::make('articles.edit', compact('article'));
	}

	/**
	 * Update the specified article in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postUpdate($id)
	{
        //$destinationPath = $_SERVER['DOCUMENT_ROOT'] ."/design/img/";
        $destinationPath = public_path() . '/design/img';

		$article = Article::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Article::$rules);

		if ($validator->fails())
		{
	        return Redirect::back()->withErrors($validator)->withInput();
		}

        if (Input::hasFile('img')){
            $name = Input::file('img')->getClientOriginalName();
            $data['img'] = $name;
            Input::file('img')->move($destinationPath, $name);
        }

		$article->update($data);

		return Redirect::to('articles/index');
	}

	/**
	 * Remove the specified article from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getDelete($id)
	{
		Article::destroy($id);

		return Redirect::to('articles/index')->withSuccess("Article $id is Success Delete");
	}

}
