<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Area;
use App\Professor;
use Illuminate\Http\Request;

class ProfessorController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$professors = Professor::orderBy('id', 'desc')->paginate(10);
		return view('professors.index', compact('professors'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$areas = Area::all();

		return view('professors.create', compact('areas'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{

		$areas     = $request->get('area');

		$professor = Professor::create($request->except('area'));

		$professor->areas()->attach($areas);

		return redirect()->route('professors.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$professor = Professor::findOrFail($id);

		return view('professors.show', compact('professor'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$professor = Professor::findOrFail($id);

		return view('professors.edit', compact('professor'));
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
		$professor = Professor::findOrFail($id);



		$professor->save();

		return redirect()->route('professors.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$professor = Professor::findOrFail($id);
		$professor->delete();

		return redirect()->route('professors.index')->with('message', 'Item deleted successfully.');
	}

}
