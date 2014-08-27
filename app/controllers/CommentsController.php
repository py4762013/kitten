<?php

class CommentsController extends \BaseController {

    public function __construct(Comment $comment,Article $article,User $user)
    {
        parent::__construct();
        $this->comment = $comment;
        $this->article = $article;
        $this->user = $user;
    }

	/**
	 * Display a listing of comments
	 *
	 * @return Response
	 */
	public function index()
	{
		$comments = Comment::all();

		return View::make('comments.index', compact('comments'));
	}

	/**
	 * Show the form for creating a new comment
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('comments.create');
	}

	/**
	 * Store a newly created comment in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Comment::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Comment::create($data);

		return Redirect::route('comments.index');
	}

	/**
	 * Display the specified comment.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$comment = Comment::findOrFail($id);

		return View::make('comments.show', compact('comment'));
	}

	/**
	 * Show the form for editing the specified comment.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$comment = Comment::find($id);

		return View::make('comments.edit', compact('comment'));
	}

	/**
	 * Update the specified comment in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$comment = Comment::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Comment::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$comment->update($data);

		return Redirect::route('comments.index');
	}

	/**
	 * Remove the specified comment from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Comment::destroy($id);

		return Redirect::route('comments.index');
	}

    /*
     * Article comment
     *
     * @return Article View
     */
    public function postArticle()
    {
        $messages = array(
            'required' => 'The :attribute is required',
            'min' => 'The :attribute must be big than :min',
        );

        $validator = Validator::make(Input::all(), Comment::$rules, $messages);

        if ($validator->fails())
        {
            return Redirect::back()->withError($validator->messages())->withInput();
        }

        $data['user_id'] = Auth::user()->id;
        $data['article_id'] = Input::get('id');
        $data['content'] = Input::get('content');

        Comment::create($data);

        return Redirect::back()->withSuccess('Comment Success');
    }
}
