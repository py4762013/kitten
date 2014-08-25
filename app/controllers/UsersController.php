<?php

class UsersController extends \BaseController {

    /*
     * User Modle
     * @var User
     */
    protected $user;

    /*
     * Inject the models
     * @param user $user
     */
    public function __construct(User $user, Article $article, Cat $cat)
    {
        parent::__construct();
        $this->user = $user;
        $this->article = $article;
        $this->cat = $cat;
    }

	/**
	 * Display a listing of users
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::all();

		return View::make('users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new user
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('users.create');
	}

	/**
	 * Store a newly created user in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $this->user->username = Input::get('username');
        $this->user->email = Input::get('email');
        $password = Input::get('password');
        $passwordConfirmation = Input::get('password_confirmation');

        if(!empty($password)){
            if($password === $passwordConfirmation){
                $this->user->password = Hash::make($password);
                $this->user->password_confirmation = $passwordConfirmation;
            }else{
                return Redirect::to('user/create')->withInput(Input::except('password','password_confirmation'))->with('error',Lang::get('Password does not match'));
            }
        }else{
            unset($this->user->password);
            unset($this->user->password_confirmation);
        }

        $this->user->save();

        if ($this->user->id){
            return Redirect::to('users/login')->with('success',Lang::get('You Account Successfully Created,Please Login Now'));
        }else{
            $error = $this->user->errors()->all();
            return Redirect::to('users/create')->withInput(Input::except('password', 'password_confirmation'))->with('error', Lang::get('error',$error));
        }


	}

    /*
     * Display the login form
     */
    public function login()
    {
        if(Auth::check()){
            return Redirect::to('/');
        }
        return View::make('users.login');
    }

    /*
     * Do Auth check
     */
    public function doLogin()
    {
        $input = array(
            'email'      => Input::get('email'),
            'password'  => Input::get('password'),
        );
        $remember = Input::get('remember');
        if (Auth::attempt($input, $remember))
        {
            return Redirect::intended('/');
        }else{
            return Redirect::to('users/login')->withInput(Input::except('password', 'password_confirmation'))->with('error', Lang::get('Please Check You Input'));
        }
    }

	/**
	 * Display the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::findOrFail($id);

		return View::make('users.show', compact('user'));
	}

	/**
	 * Show the form for editing the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::find($id);

		return View::make('users.edit', compact('user'));
	}

	/**
	 * Update the specified user in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::findOrFail($id);

		$validator = Validator::make($data = Input::all(), User::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$user->update($data);

		return Redirect::route('users.index');
	}

	/**
	 * Remove the specified user from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		User::destroy($id);

		return Redirect::route('users.index');
	}

    /*
     * Logout
     *
     */
    public function logout()
    {
        Auth::logout();

        return Redirect::to('home');
    }

    /*
     * Own Cat
     * @return Response
     */
    public function getCat()
    {
        $owncat = $this->cat->where('user_id', Auth::user()->id);

        if($owncat->count() == 0)
        {
            return Redirect::to('cats/create')->withInfo('You did not have cat,Please Add your cat first');
        }else{
            $cats = $owncat->orderBy('created_at', 'desc')->paginate(5);

            return View::make('cats.index', compact('cats'));
        }
    }

    /*
     * Own Article
     * @return Response
     */
    public function getArticle()
    {
        $ownarticle = $this->article->where('user_id', Auth::user()->id);

        if($ownarticle->count() == 0)
        {
            return Redirect::to('articles/create')->withInfo('You did not have article,Please Add you article first');
        }else{
            $articles = $ownarticle->orderBy('created_at', 'desc')->paginate(5);

            return View::make('article.index', compact('articles'));
        }
    }
}
