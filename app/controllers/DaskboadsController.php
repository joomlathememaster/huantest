<?php

class DaskboadsController extends \BaseController {

	/**
	 * Display a listing of daskboads
	 *
	 * @return Response
	 */
	public function index()
	{
		$daskboads = Daskboad::all();

		return View::make('daskboads.index', compact('daskboads'));
	}

	/**
	 * Show the form for creating a new daskboad
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('daskboads.create');
	}

	/**
	 * Store a newly created daskboad in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Daskboad::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Daskboad::create($data);

		return Redirect::route('daskboads.index');
	}

	/**
	 * Display the specified daskboad.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$daskboad = Daskboad::findOrFail($id);

		return View::make('daskboads.show', compact('daskboad'));
	}

	/**
	 * Show the form for editing the specified daskboad.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$daskboad = Daskboad::find($id);

		return View::make('daskboads.edit', compact('daskboad'));
	}

	/**
	 * Update the specified daskboad in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$daskboad = Daskboad::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Daskboad::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$daskboad->update($data);

		return Redirect::route('daskboads.index');
	}

	/**
	 * Remove the specified daskboad from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Daskboad::destroy($id);

		return Redirect::route('daskboads.index');
	}

}
