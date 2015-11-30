<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Course;
use App\Area;
use Excel;
use Illuminate\Http\Request;

class CourseController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$courses = Course::with('area')->get();

		return view('courses.index', compact('courses'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$areas = Area::lists('name','id');
		return view('courses.create', compact('areas'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		Course::create($request->all());

		return redirect()->route('courses.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$course = Course::findOrFail($id);

		return view('courses.show', compact('course'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$areas = Area::lists('name','id');

		$course = Course::findOrFail($id);

		return view('courses.edit', compact('course','areas'));
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
		$course = Course::findOrFail($id);

		$course->save();

		return redirect()->route('courses.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$course = Course::findOrFail($id);
		$course->delete();

		return redirect()->route('courses.index')->with('message', 'Item deleted successfully.');
	}

	public function dashboard(){
		$courses = Course::all();
		return view('courses.dashboard', compact('courses'));
	}

	public function import(Request $request)
		{
				$file    = $request->file('excel');
				//var_dump($filename);
				Excel::load($file, function($input) {
							$results = $input->all();

							foreach ($results as $result) {
								// Search if a course exist
								$course = Course::where('code', $result->codigo)->get();
								// if doesn't exist we save it
								if(!isset($course)){
									$area   = Area::where('name',$result->area)->get();

									$course           = new Course();
									$course->area_id  = $area->id;
									$course->code     = $area->codigo;
									$course->section  = $area->seccion;
									$course->year     = $area->year;
									$course->semester = $area->semestre;
									$course->branch   = $area->sucursal;
									$course->schedule = $area->horario;
									$course->save();

								}
							}
				});

				return redirect()->route('courses.index')->with('message', 'Cursos creados Correctamente.');


		}

}
