<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Area;
use App\Professor;
use Illuminate\Http\Request;

use Excel;

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
		$professor = Professor::with('areas')->findOrFail($id);

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
		$professor = Professor::with('areas')->findOrFail($id);

		$areas = Area::all();

		return view('professors.edit', compact('professor', 'areas'));
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
		$professor->update($request->all());

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

	public function import(Request $request)
		{
				$file    = $request->file('excel');
				//var_dump($filename);
				Excel::load($file, function($input) {

							$results = $input->all();

							foreach ($results as $result) {

								// Search if a course exist
								$professor = Professor::where('rut', $result->rut)->first();
								// if doesn't exist we save it
								if(!isset($professor)){
									$professor              = new Professor();
									$professor->name        = $result->nombre_completo;
									$professor->type        = $result->categoria;
									$professor->rut         = $result->rut;
									$professor->sede_origen = $result->sede_origen;
									$professor->min_load    = $result->carga_docente_minima;
									$professor->max_load    = $result->carga_docente_maxima;
									$professor->save();
									

									//TODO: Pasar esto a el modelo o a una query class
									$areas = explode(',', $result->areas);

									foreach ($areas as $key => $area) {
										$areaIdArray[] = Area::where('name',$area)->first()->id;
									}

									$professor->areas()->sync($areaIdArray);
								}

							}
				});

				return redirect()->route('professors.index')->with('message', 'Cursos creados Correctamente.');


		}



}
