<?php

class CatsController extends \BaseController {

	/**
	 * Display a listing of cats
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$cats = Cat::all();

		return View::make('cats.index', compact('cats'));
	}

	/**
	 * Show the form for creating a new cat
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        if (Auth::check())
        {
            return View::make('cats.create');
        } else {
            return Redirect::to('users/login')->withMessage('Please login first');
        }
	}

	/**
	 * Store a newly created cat in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
        $destinationPath = '/design/img/';

        $messages = array(
        );

		$validator = Validator::make($data = Input::all(), Cat::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

        $name = Input::file('img')->getClientOriginalName();
        Input::file('img')->move(public_path().$destinationPath, $name);

        $data['user_id'] = Auth::user()->id;
        $data['img'] = $destinationPath.$name;

        //exit(var_dump($data));

		Cat::create($data);

		return Redirect::to('cats/index');
	}

	/**
	 * Display the specified cat.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$cat = Cat::findOrFail($id);

		return View::make('cats.show', compact('cat'));
	}

	/**
	 * Show the form for editing the specified cat.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$cat = Cat::find($id);

		return View::make('cats.edit', compact('cat'));
	}

	/**
	 * Update the specified cat in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$cat = Cat::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Cat::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$cat->update($data);

		return Redirect::route('cats.index');
	}

	/**
	 * Remove the specified cat from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Cat::destroy($id);

		return Redirect::route('cats.index');
	}

}
