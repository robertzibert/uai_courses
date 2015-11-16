<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Area;
use Illuminate\Http\Request;

class AreaController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$areas = Area::orderBy('id', 'desc')->paginate(10);

		return view('areas.index', compact('areas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('areas.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$area = new Area();

		

		$area->save();

		return redirect()->route('areas.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$area = Area::findOrFail($id);

		return view('areas.show', compact('area'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$area = Area::findOrFail($id);

		return view('areas.edit', compact('area'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$area = Area::findOrFail($id);

		

		$area->save();

		return redirect()->route('areas.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$area = Area::findOrFail($id);
		$area->delete();

		return redirect()->route('areas.index')->with('message', 'Item deleted successfully.');
	}

}
