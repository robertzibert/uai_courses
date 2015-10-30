<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Course;
use App\Professor;
use App\Schedule;
use App\Professorsarea;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($professorId)
    {
        return('asd');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($area,$professorId)
    {
        $professor          = Professor::FindOrFail($professorId);
        $professorFromAreas = Professorsarea::where('area',$area)->get();
        $professorLoad      = schedule::where('professor_id',$professorId)->count();
        $arrayProfessors    = array();
        $arrayCourses       = array();
        $areaCourses        = Course::where('area',$area)->get();
        foreach($professorFromAreas as $professorFromArea){
            $arrayProfessors[$professorFromArea->professor()->first()->id]  = $professorFromArea->professor()->first()->name;
        }
        $schedules = Schedule::where('professor_id',$professorId)->get();
        foreach($schedules as $schedule){
            $course                 = array();
            $code                   = $schedule->course()->first()->code;
            $scheduleArray = (isset($arrayCourses[$code]['schedule']))?$arrayCourses[$code]['schedule']:'';
            $scheduleArray[]        = $schedule->schedule;
            $array[$schedule->schedule]=$schedule->course()->first()->code." semestre".$schedule->course()->first()->semester."<br><small>".$schedule->course()->first()->branch."</small>";
            $course['name']         = $schedule->course()->first()->name;
            $course['area']         = $schedule->course()->first()->area;
            $course['schedule']     = $scheduleArray;
            $course['code']         = $code;
            $arrayCourses[$code]    = $course;
        }
        $courseSelect = array();
        foreach($areaCourses as $oneCourse){
            if(count($oneCourse->schedule()->groupBy('professor_id')->get()) == 0){
                $courseSelect[$oneCourse->id] = $oneCourse->code."  ".$oneCourse->name." semestre".$oneCourse->semester." ".$oneCourse->branch;
            }
        }
        foreach($areaCourses as $otherCourse){
            $courseJson[$otherCourse->id] = $otherCourse->load;
        }
        return view('schedules.create', compact('professor','arrayCourses','arrayProfessors','array','area','courseSelect','areaCourses','courseJson','professorLoad'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $schedules = $request->get('schedules');
        $course = $request->get('course');
        $professor = $request->get('professor');
        $area = $request->get('area');
        if(isset($schedules)){
            foreach($schedules as $schedule){
                $record = new Schedule;
                $record->course_id = $course;
                $record->schedule = $schedule;
                $record->professor_id = $professor;
                $record->save();
            }
        }
        return redirect("schedules/show/$area/$professor/");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($area,$professorId)
    {
        $professor          = Professor::FindOrFail($professorId);
        $professorFromAreas = Professorsarea::where('area',$area)->get();
        $professorLoad      = schedule::where('professor_id',$professorId)->count();
        $arrayProfessors    = array();
        $arrayCourses       = array();
        foreach($professorFromAreas as $professorFromArea){
            $arrayProfessors[$professorFromArea->professor()->first()->id]  = $professorFromArea->professor()->first()->name;
        }
        $schedules = Schedule::where('professor_id',$professorId)->get();
        foreach($schedules as $schedule){
            $course                 = array();
            $code                   = $schedule->course()->first()->code;
            $scheduleArray = (isset($arrayCourses[$code]['schedule']))?$arrayCourses[$code]['schedule']:'';
            $scheduleArray[]        = $schedule->schedule;
            $array[$schedule->schedule]=$schedule->course()->first()->code;
            $course['name']         = $schedule->course()->first()->name;
            $course['area']         = $schedule->course()->first()->area;
            $course['schedule']     = $scheduleArray;
            $course['code']         = $code;
            $arrayCourses[$code]    = $course;
        }
        return view('schedules.show', compact('professor','arrayCourses','arrayProfessors','array','area','professorLoad'));
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
    public function destroy($id)
    {
        //
    }
}
