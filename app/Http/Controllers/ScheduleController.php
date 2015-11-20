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

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user      = Auth::user()->with('role')->first();
      $split     = explode(" ", $user->role->name);
      $role_area = $split[count($split)-1];

      return view('schedules.index');

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
        $course     = Course::where('id',$request->get('course'))->first();
        $professor     = Professor::where('id',$request->get('professor'))->first();
        $area       = $request->get('area');
        $schedulesYear =Schedule::join('courses', 'courses.id', '=', 'schedules.course_id')
                        ->where('schedules.professor_id',$professor->id)
                        ->where('courses.year',$course->year)
                        ->get();
        $professorLoad=0;
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
                    $hours  = array_merge(explode("-",$courseSchedule->schedule),$hours);
                    foreach($hours as $h){
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
            }elseif($days[$oneSchedule[0]]!=$course->branch && $days[$oneSchedule[0]]!=null){ 
                return redirect()->back()->withErrors('No es posible asignar dos cursos con distintas sedes el mismo día.')->withInput();;
            }elseif($professorLoad + count($selectedCourseSchedule)*22.5 > $professor->max_load){
                return redirect()->back()->withErrors('Añadir este curso excede la carga máxima del profesor seleccionado.')->withInput();;
            }
        }
        if(isset($course) && isset($professor)){
                $record = new Schedule;
                $record->course_id = $course->id;
                $record->professor_id = $professor->id;
                $record->save();
        }
        return redirect("schedules/$course->year-$course->semester/$area/$professor->id");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($date,$area,$professorId)
    {
        $dateExp    = explode("-",$date);
        $year       = $dateExp[0];
        $semester   = $dateExp[1];
        $professor          = Professor::FindOrFail($professorId);
        $professorFromAreas = Area::where('name', $area)->first()->professors()->get();
        $professorLoad      = 0;
        $arrayProfessors    = array();
        $arrayCourses       = array();

        $areaCourses        = Course::where('area',$area)->where('year',$year)->where('semester',$semester)->get();
        $courseSelect       = array();
        foreach($areaCourses as $oneCourse){
            if(count($oneCourse->schedule()->groupBy('professor_id')->get()) == 0){
                $courseSelect[$oneCourse->id] = $oneCourse->code."-".$oneCourse->section."-".$oneCourse->year."-".$oneCourse->semester." ".$oneCourse->branch." (".$oneCourse->schedule.")";
            }
        }
        foreach($professorFromAreas as $professorFromArea){
            $arrayProfessors[$professorFromArea->id]  = $professorFromArea->name;
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
            $course['area']         = $schedule->course()->first()->area;
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
        return view('schedules.show', compact('year','semester','urlAnterior','urlSiguiente','professor','courseSelect','arrayCourses','arrayProfessors','array','area','professorLoad'));
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
        $schedules = schedule::where('course_id',$id)->delete();
        return redirect("schedules/$course->year-$course->semester/$area/$professor");
    }
}
