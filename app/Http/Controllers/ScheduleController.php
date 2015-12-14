<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Course;
use App\Professor;
use App\Schedule;
use App\Area;
use App\Professorsarea;
use App\Insert_control;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($semester = null, $year = null)
    {
      $user         = Auth::user();
      $split        = explode(" ", $user->role->name);
      $role_area    = $split[count($split)-1];
      $areas           = Area::with('professors')->get()->toArray();
      $profe           = Professor::with('areas')->get()->toArray();
      $prof_areas = array();
      foreach($profe as $prof){
        $prof_areas[$prof['id']] = $prof['areas'];
      }
      $collection      = collect($areas);
      $area_professors = $collection->keyBy('name')->toArray();
      // TODO: Pasar esto a un Helper
      if($semester == null) \Carbon\Carbon::now()->month >= 5 ? $semester = 2 : $semester = 1;
      $year == null ? $year = \Carbon\Carbon::now()->year : $year = $year;

      $courses      = Course::with('area')->get()->toArray();
      if($role_area == "Administrador"){
          $professors   = Professor::all()->toArray();
          //TODO: Pasar esto a un scope
          $unasigned_courses = Course::with('area')->where('taken',0)->where('semester', $semester)->where('year', $year)->get();
          $asigned_courses   = Course::with('area')->where('taken',1)->where('semester', $semester)->where('year', $year)->get();
      }
      else{
      $professors   = Area::with('professors')->where('name',$role_area)->get()->toArray()[0]["professors"];
        $area = Area::where('name',$role_area)->first();
        $unasigned_courses = Course::where('taken', 0)->where('area_id', $area->id)->where('semester', $semester)->where('year', $year)->get();
        $asigned_courses   = Course::where('taken', 1)->where('area_id', $area->id)->where('semester', $semester)->where('year', $year)->get();
      }
      $professorCourse = array();
      foreach ($courses as $course) {
        if(Schedule::where('course_id',$course['id'])->first() != null){
            $professorId = Schedule::where('course_id',$course['id'])->first()->professor_id;
            $professorCourse[$course['id']]=Professor::where('id',$professorId)->first()->name;
        }
      }
      return view('schedules.index',compact('area_professors','prof_areas','professors', 'courses', 'professorCourse','unasigned_courses','asigned_courses', 'year', 'semester'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userRole = Auth::user()->role()->first()->name;

        $course         = Course::where('id',$request->get('course'))->first();
        $professor      = Professor::where('id',$request->get('professor'))->first();
        $area           = $request->get('area');
        $schedulesYear  =Schedule::join('courses', 'courses.id', '=', 'schedules.course_id')
                        ->where('schedules.professor_id',$professor->id)
                        ->where('courses.year',$course->year)
                        ->get();
        $professorLoad  = 0;
        foreach($schedulesYear as $sche){
            $professorLoad = $professorLoad + count(explode("-",$sche->course()->first()->schedule))*22.5;
        }
        $conflictHours = array(
            "L1A"=>"L1B",
            "M1A"=>"M1B",
            "W1A"=>"W1B",
            "J1A"=>"J1B",
            "V1A"=>"V1B",
            "L4A"=>"L4B",
            "M4A"=>"M4B",
            "W4A"=>"W4B",
            "J4A"=>"J4B",
            "V4A"=>"V4B",
            );
        $days=array(
            "L"=>null,
            "M"=>null,
            "W"=>null,
            "J"=>null,
            "V"=>null,
            );

        $schedules          = array();
        $courseSchedules    = Course::where('year',$course->year)->where('semester',$course->semester)->get();
        $hours      = array();
        foreach($courseSchedules as $courseSchedule){
            if($courseSchedule->schedule()->first() !=null){
                if($courseSchedule->schedule()->first()->professor_id == $professor->id){
                    $hours2 = explode("-",$courseSchedule->schedule);
                    $hours  = array_merge(explode("-",$courseSchedule->schedule),$hours);
                    foreach($hours2 as $h){
                        $days[$h[0]]=$courseSchedule->branch;
                    }
                }
            }
        }
        foreach($conflictHours as $oneConflict => $otherOne){
            if(in_array($oneConflict,$hours) || in_array($otherOne,$hours)){
                array_push($hours, $otherOne);
                array_push($hours, $oneConflict);
            }
        }
        $selectedCourseSchedule = explode("-",$course->schedule);
        foreach($selectedCourseSchedule as $oneSchedule){
            if(in_array($oneSchedule,$hours)){
                return redirect()->back()->withErrors('El curso seleccionado tiene tope de horario con otro curso ya asignado.')->withInput();;
            }elseif($days[$oneSchedule[0]]!=$course->branch && $days[$oneSchedule[0]]!=null && $userRole != "Administrador"){
                return redirect()->back()->withErrors('No es posible asignar dos cursos con distintas sedes el mismo día.')->withInput();;
            }elseif($professorLoad + count($selectedCourseSchedule)*22.5 > $professor->max_load && $userRole != "Administrador"){
                return redirect()->back()->withErrors('Añadir este curso excede la carga máxima del profesor seleccionado.')->withInput();;
            }
        }
        if(isset($course) && isset($professor)){

                $professorLoad = $professorLoad + count($selectedCourseSchedule)*22.5;
                $record = new Schedule;
                $record->course_id = $course->id;
                $record->professor_id = $professor->id;
                $record->save();

                $prof = Professor::findOrFail($professor->id);
                $prof->current_load = $professorLoad;
                $prof->save();

                $course = Course::findOrFail($course->id);
                $course->taken = 1;
                $course->save();
        }
        return redirect("schedules/$course->year-$course->semester/$area/$professor->id");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($date,$area,$professorId = null)
    {
        if($professorId == null){

        }
        $insert_control = Insert_control::where('period',$date)->first();
        if($insert_control == null){
          $insert_control = 0;
        }
        else{
        $insert_control = $insert_control->available;
        }
        $userRole = Auth::user()->role()->first()->name;
        $dateExp    = explode("-",$date);
        $year       = $dateExp[0];
        $semester   = $dateExp[1];
        $professor          = Professor::find($professorId);        

        $professorFromAreas = Area::where('name', $area)->first()->professors()->get();
        $arrayProfessors    = array();
        
        foreach($professorFromAreas as $professorFromArea){
            $arrayProfessors[$professorFromArea->id]  = $professorFromArea->name;
        }
        
        if(!isset($professor)){
          $status = 1;
          $arrayProfessorss=$arrayProfessors;
          $arrayProfessorss[""]="";
          return view('schedules.show', compact("status","year","semester","arrayProfessorss"));
        }

        $todasAreas         = Area::all()->toArray();
        $arrayAreas         = array();
        foreach($todasAreas as $unArea){
          $arrayAreas[$unArea['id']] = $unArea['name'];
        }
        $professorLoad      = 0;
        $arrayCourses       = array();

        $areaCourses        = Course::join('areas', 'areas.id', '=', 'courses.area_id')->where('areas.name',$area)->where('courses.year',$year)->where('courses.semester',$semester)->get();
        $courseSelect       = array();
        foreach($areaCourses as $oneCourse){
            if(count($oneCourse->schedule()->groupBy('professor_id')->get()) == 0){
                $courseSelect[$oneCourse->id] = $oneCourse->code."-".$oneCourse->section."-".$oneCourse->year."-".$oneCourse->semester." ".$oneCourse->branch." (".$oneCourse->schedule.")";
            }
        }
        $schedules =    Schedule::join('courses', 'courses.id', '=', 'schedules.course_id')
                        ->where('schedules.professor_id',$professorId)
                        ->where('courses.year',$year)
                        ->where('courses.semester',$semester)
                        ->get();
        foreach($schedules as $schedule){
            $course                 = array();
            $code                   = $schedule->course()->first()->code;
            $course['name']         = $schedule->course()->first()->name;
            $course['area']         = $arrayAreas[$schedule->course()->first()->area_id];
            $course['branch']       = $schedule->course()->first()->branch;
            $course['section']      = $schedule->course()->first()->section;
            $course['semester']     = $schedule->course()->first()->semester;
            $course['id']           = $schedule->course()->first()->id;
            $course['year']         = $schedule->course()->first()->year;
            $course['schedule']     = explode("-",$schedule->course()->first()->schedule);
            $course['code']         = $code;
            $arrayCourses[$code."-".$course['section']]    = $course;
           // $professorLoad = $professorLoad + count($course['schedule'])*22.5;
            foreach ($course['schedule'] as $horario) {
                $array[$horario] = $course['code']."-".$course['section'];
            }
        }
        $schedulesYear =Schedule::join('courses', 'courses.id', '=', 'schedules.course_id')
                        ->where('schedules.professor_id',$professorId)
                        ->where('courses.year',$year)
                        ->get();
        foreach($schedulesYear as $sche){
            $professorLoad = $professorLoad + count(explode("-",$sche->course()->first()->schedule))*22.5;
        }
        if($semester == 1){
            $nextSemester = 2;
            $nextYear     = $year;
            $previewsYear = $year-1;
        }else{
            $nextSemester = 1;
            $nextYear     = $year+1;
            $previewsYear = $year;
        }
        $nextDate = $nextYear."-".$nextSemester;
        $previewsDate = $previewsYear."-".$nextSemester;
        $urlAnterior = "schedules/$previewsDate/$area/$professor->id";
        $urlSiguiente = "schedules/$nextDate/$area/$professor->id";
        return view('schedules.show', compact('year','semester','urlAnterior','urlSiguiente','professor','courseSelect','arrayCourses','arrayProfessors','array','area','professorLoad', 'userRole', 'insert_control' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$area,$professor)
    {
        $course     = Course::where('id',$id)->first();
                $course = Course::findOrFail($id);
                $course->taken = 0;
                $course->save();


        $prof = Professor::findOrFail($professor);
        $selectedCourseSchedule = explode("-",$course->schedule);
        $professorLoad = $prof->current_load - count($selectedCourseSchedule)*22.5;
        $prof->current_load = $professorLoad;
        $prof->save();

        $schedules = schedule::where('course_id',$id)->delete();
        return redirect("schedules/$course->year-$course->semester/$area/$professor");
    }


    public function insert_control(Request $request)
    {
        $professor      = Professor::where('id',$request->get('professor'))->first();
        $area           = $request->get('area');
        $period         = $request->get('period');
        //dd($period);
        $insert_control = Insert_control::where('period', $period)->first();
        if($insert_control != null){    
          $record = $insert_control;
          $record->available = !$record->available;
          $record->save();
        }
        else{
          $record = new Insert_control;
          $record->period = $period;
          $record->available = 1;
          $record->save();
        }

        return redirect("schedules/$period/$area/$professor->id");
    }
}
