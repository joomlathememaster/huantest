<?php

class PostsController extends \BaseController {

	/**
	 * Display a listing of posts
	 *
	 * @return Response
	 */
	public function index()
	{
		$posts = Post::all();

		return View::make('posts.index', compact('posts'));
	}

	/**
	 * Show the form for creating a new post
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('posts.create');
	}

	/**
	 * Store a newly created post in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $rules = array(
            'title'       => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('posts/create')
                ->withErrors($validator);
        } else {
            // store
            $post = new Post;
            $post->title       = Input::get('title');
            $post->alias       = Input::get('alias');
            $post->category_id       = Input::get('category_id');
            $post->username       = Input::get('username');
            $post->author       = Input::get('author');
            $post->content     = Input::get('content');
            $post->tags       = Input::get('tags');
            $post->timestamps = false;
            $post->save();

            // redirect
            Session::flash('message', 'Successfully created nerd!');
            return Redirect::to('posts');
        }
		/*$validator = Validator::make($data = Input::all(), Post::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Post::create($data);

		return Redirect::route('posts.index');*/
	}

	/**
	 * Display the specified post.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$post = Post::findOrFail($id);

		return View::make('posts.show', compact('post'));

	}

	/**
	 * Show the form for editing the specified post.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$post = Post::find($id);

		return View::make('posts.edit', compact('post'));
	}

	/**
	 * Update the specified post in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $rules = array(
            'title'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('post/' . $id . '/edit')
                ->withErrors($validator);
        } else {
            // store
            $post = Post::find($id);
            $post->title       = Input::get('title');
            $post->alias       = Input::get('alias');
            $post->category_id       = Input::get('category_id');
            $post->username       = Input::get('username');
            $post->author       = Input::get('author');
            $post->content     = Input::get('content');
            $post->tags       = Input::get('tags');
            $post->timestamps = false;
            $post->save();

            // redirect
            Session::flash('message', 'Successfully updated post!');
            return Redirect::to('posts');
        }
		/*$post = Post::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Post::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$post->update($data);

		return Redirect::route('posts.index');*/
	}

	/**
	 * Remove the specified post from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Post::destroy($id);

		return Redirect::route('posts.index');
	}

}
