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
        $course     = $request->get('course');
        $professor  = $request->get('professor');
        $area       = $request->get('area');

        $schedules  = Schedule::where('professor_id',$professor)->get();
        $hours      = array();
        foreach($schedules as $schedule){
            $hours  = array_merge(explode("-",$schedule->course()->first()->schedule),$hours);
        }

        $selectedCourseSchedule = explode("-",Course::where('id',$course)->first()->schedule);
        foreach($selectedCourseSchedule as $oneSchedule){
            if(in_array($oneSchedule,$hours)){
                return redirect()->back()->withErrors('El curso seleccionado tiene tope de horario con uno de los ya existentes.')->withInput();;
            }
        }

        if(isset($course) && isset($professor)){
                $record = new Schedule;
                $record->course_id = $course;
                $record->professor_id = $professor;
                $record->save();
        }
        return redirect("schedules/show/$area/$professor");
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
        $professorLoad      = 0;
        $arrayProfessors    = array();
        $arrayCourses       = array();

        $areaCourses        = Course::where('area',$area)->get();
        $courseSelect       = array();
        foreach($areaCourses as $oneCourse){
            if(count($oneCourse->schedule()->groupBy('professor_id')->get()) == 0){
                $courseSelect[$oneCourse->id] = $oneCourse->code."-".$oneCourse->section."-".$oneCourse->year." ".$oneCourse->branch." (".$oneCourse->schedule.")";
            }
        }
        foreach($professorFromAreas as $professorFromArea){
            $arrayProfessors[$professorFromArea->professor()->first()->id]  = $professorFromArea->professor()->first()->name;
        }
        $schedules = Schedule::where('professor_id',$professorId)->get();
        foreach($schedules as $schedule){
            $course                 = array();
            $code                   = $schedule->course()->first()->code;
            $course['name']         = $schedule->course()->first()->name;
            $course['area']         = $schedule->course()->first()->area;
            $course['section']      = $schedule->course()->first()->section;
            $course['semester']     = $schedule->course()->first()->semester;
            $course['id']           = $schedule->course()->first()->id;
            $course['year']         = $schedule->course()->first()->year;
            $course['schedule']     = explode("-",$schedule->course()->first()->schedule);
            $course['code']         = $code;
            $arrayCourses[$code."-".$course['section']]    = $course;
            $professorLoad = $professorLoad + count($course['schedule']);
            foreach ($course['schedule'] as $horario) {
                $array[$horario] = $course['code']."-".$course['section'];
            }
        }
        return view('schedules.show', compact('professor','courseSelect','arrayCourses','arrayProfessors','array','area','professorLoad'));
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
        $schedules = schedule::where('course_id',$id)->delete();
        return redirect("schedules/show/$area/$professor");
    }
}
