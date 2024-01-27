<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassSubjectConroller;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SubjectConroller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AssignClassTeacherController;
use App\Http\Controllers\ClassTimetableController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\CalenderController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/





Route::get('/',[AuthController::class,'login'])->name('auth/login');
Route::post('/login',[AuthController::class,'authlogin'])->name('authlogin');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');
Route::get('/forgot',[AuthController::class,'forgotpassword'])->name('forgot');
Route::post('/forgotmail',[AuthController::class,'ForgotPasswordMail'])->name('forgotloginPassword');

Route::group(['middleware' => 'admin'],function(){
    Route::get('admin/dashboard',[DashController::class,'dashboard']);
    Route::get('admin/admin/list',[AdminController::class,'add_list'])->name('admin.add_list');
    Route::get('admin/admin/add',[AdminController::class,'add_admin'])->name('admin.add_admin');
    Route::post('admin/admin/add',[AdminController::class,'add_insert'])->name('admin.adinsert');
    Route::get('admin/admin/edit/{id}',[AdminController::class,'edit'])->name('admin.edit');
    Route::post('admin/admin/update/{id}',[AdminController::class,'update'])->name('admin.update');
    Route::get('admin/admin/delete/{id}',[AdminController::class,'delete'])->name('admin.delete');
//Teacher
Route::get('admin/teacher/list',[TeacherController::class,'list'])->name('admin.added_list');
Route::get('admin/teacher/add',[TeacherController::class,'add'])->name('admin.add_admin');
Route::post('admin/teacher/add',[TeacherController::class,'insert'])->name('admin.add_insert');
Route::get('admin/teacher/edit/{id}',[TeacherController::class,'edit'])->name('admin.edit');
Route::post('admin/teacher/edit/{id}',[TeacherController::class,'update'])->name('admin.update');
Route::get('admin/teacher/delete/{id}',[TeacherController::class,'delete'])->name('admin.delete');
//student
Route::get('admin/student/list',[StudentController::class,'list_student'])->name('admin.list_student');
Route::get('admin/student/add',[StudentController::class,'add_student'])->name('admin.add_admin');
Route::post('admin/student/add',[StudentController::class,'insert'])->name('admin.add_insert');
Route::get('admin/student/edit/{id}',[StudentController::class,'edit'])->name('admin.edit');
Route::post('admin/student/edit/{id}',[StudentController::class,'update'])->name('admin.add_update');
Route::get('admin/student/delete/{id}',[StudentController::class,'delete'])->name('admin.delete');

    //parent
 Route::get('admin/parent/list',[ParentController::class,'list'])->name('parent_list');
 Route::get('admin/parent/add',[ParentController::class,'add'])->name('admin.add');
 Route::post('admin/parent/add',[ParentController::class,'insert'])->name('admin.insert');
 Route::get('admin/parent/edit/{id}',[ParentController::class,'edit'])->name('admin.edit');
Route::post('admin/parent/edit/{id}',[ParentController::class,'update'])->name('admin.update');
Route::get('admin/parent/delete/{id}',[ParentController::class,'delete'])->name('admin.delete');
Route::get('admin/parent/my_student/{id}',[ParentController::class,'myStudent'])->name('admin.my_student');
Route::get('admin/parent/assign_student_parent/{student_id}/{parent_id}',[ParentController::class,'AssignStudentParent'])->name('admin.my_student');
Route::get('admin/parent/assign_student_parent_delete/{student_id}',[ParentController::class,'AssignStudentParentDelete'])->name('admin.my_student');


// class
    Route::get('admin/class/list',[ClassController::class,'add_list'])->name('add_list');
    Route::get('admin/class/add',[ClassController::class,'add_class'])->name('add_class');
    Route::post('admin/class/add',[ClassController::class,'add_insert'])->name('add_insert');
    Route::get('admin/class/edit/{id}',[ClassController::class,'edit'])->name('edit');
    Route::post('admin/class/update/{id}',[ClassController::class,'update'])->name('update');
    Route::get('admin/class/delete/{id}',[ClassController::class,'delete'])->name('delete');

    //Subjects
    Route::get('admin/subject/list',[SubjectConroller::class,'list'])->name('subject.list');
    Route::get('admin/subject/add',[SubjectConroller::class,'add'])->name('add');
    Route::post('admin/subject/add',[SubjectConroller::class,'insert'])->name('subject.insert');
    Route::get('admin/subject/edit/{id}',[SubjectConroller::class,'edit'])->name('edit');
    Route::post('admin/subject/update/{id}',[SubjectConroller::class,'update'])->name('update');
    Route::get('admin/subject/delete/{id}',[SubjectConroller::class,'delete'])->name('delete');

    //Assign Subject
    Route::get('admin/assign_subject/list',[ClassSubjectConroller::class,'list'])->name('assign_subject.list');
    Route::get('admin/assign_subject/add',[ClassSubjectConroller::class,'add'])->name('add');
    Route::post('admin/assign_subject/add',[ClassSubjectConroller::class,'insert'])->name('assign_subject.insert');
    Route::get('admin/assign_subject/edit/{id}',[ClassSubjectConroller::class,'edit'])->name('assign_subject.edit');
    Route::post('admin/assign_subject/update/{id}',[ClassSubjectConroller::class,'update'])->name('assign_subject.update');
    Route::get('admin/assign_subject/delete/{id}',[ClassSubjectConroller::class,'delete'])->name('assign_subject.delete');
    Route::get('admin/assign_subject/single_edit/{id}',[ClassSubjectConroller::class,'single_edit'])->name('assign_subject.single_edit');
    Route::post('admin/assign_subject/single_update/{id}',[ClassSubjectConroller::class,'single_update'])->name('assign_subject.single_update');
    //TimeTableController
    Route::get('admin/class_timetable/list',[ClassTimetableController::class,'list'])->name('class_timetable.list');
    Route::post('admin/class_timetable/get_subject',[ClassTimetableController::class,'get_subject'])->name('class_timetable.get_subject');
   Route::post('admin/class_timetable/add',[ClassTimetableController::class,'insert_update'])->name('class_timetable.insert_update');




    Route::get('admin/account',[UserController::class,'myAccount']);
     Route::post('admin/account',[UserController::class,'UpdatemyAccountAdmin']);
    // Change Password
    Route::get('admin/change_password', [UserController::class, 'change_password'])->name('admin.c_password');
    Route::post('admin/change_password', [UserController::class, 'update_password'])->name('admin.update_password');

    //assignclassTeacher
  Route::get('admin/assign_class_teacher/list',[AssignClassTeacherController::class,'list'])->name('assign_class.list');
    Route::get('admin/assign_class_teacher/add',[AssignClassTeacherController::class,'add'])->name('assign_class.add');
     Route::post('admin/assign_class_teacher/add',[AssignClassTeacherController::class,'insert'])->name('assign_class.insert');
       Route::get('admin/assign_class_teacher/edit/{id}',[AssignClassTeacherController::class,'edit'])->name('assign_class.edit');
       Route::post('admin/assign_class_teacher/edit/{id}',[AssignClassTeacherController::class,'edit'])->name('assign_class.update');
         Route::get('admin/assign_class_teacher/edit_single/{id}',[AssignClassTeacherController::class,'edit_single'])->name('assign_class_teacher.edit_single');


//Examination

    Route::get('admin/examination/exam/list',[ExaminationController::class,'list'])->name('examlist');
    Route::get('admin/examination/exam/add',[ExaminationController::class,'add'])->name('admin.add');
     Route::post('admin/examination/exam/add',[ExaminationController::class,'insert'])->name('insert');
     Route::get('admin/examination/exam/edit/{id}',[ExaminationController::class,'edit'])->name('edit');
     Route::post('admin/examination/exam/edit/{id}',[ExaminationController::class,'update'])->name('update');
     Route::get('admin/examination/exam/delete/{id}',[ExaminationController::class,'delete'])->name('delete');
      Route::get('admin/examination/exam_schedule',[ExaminationController::class,'exam_schedule'])->name('exam_schedule');
      Route::post('admin/examination/insert_schedule',[ExaminationController::class,'insert_schedule'])->name('insert_schedule');
      Route::get('admin/examination/marks_register',[ExaminationController::class,'MarksRegister'])->name('MarksRegister');
      Route::post('admin/examination/submit_mark_register',[ExaminationController::class,'SubmitMarksRegister'])->name('SubmitMarksRegister');
      Route::post('admin/examination/singlesubmit_mark_register',[ExaminationController::class,'SingleSubmitMarksRegister'])->name('SingleSubmitMarksRegister');




});
Route::group(['middleware' => 'teacher'],function(){
    Route::get('teacher/dashboard',[DashController::class,'dashboard']);
    //teacheraccount 
    Route::get('teacher/account',[UserController::class,'myAccount']);
    Route::post('teacher/account',[UserController::class,'UpdatemyAccountTeacher']);
    // Change Password
    Route::get('teacher/change_password',[UserController::class,'change_password'])->name('teacher.c_password');
    Route::post('teacher/change_password',[UserController::class,'update_password'])->name('teacher.update_password');

    Route::get('teacher/my_class_subject',[AssignClassTeacherController::class,'MyClassSubject'])->name('teacher.MyClassSubject ');

    Route::get('teacher/my_student',[StudentController::class,'myStudent'])->name('teacher.myStudent');
    Route::get('teacher/my_class_subject/class_timetable/{class_id}/{subject_id}',[ClassTimetableController::class,'MyTimetableTeacher'])->name('teacher.MyTimetableTeacher');
     Route::get('teacher/my_exam_timetable',[ExaminationController::class,'MyExamTimetable']);
     Route::get('teacher/calendar',[CalenderController::class,'TCalendar'])->name('teacher.TCalendar');
      Route::get('teacher/marks_register',[ExaminationController::class,'TeacherMarksRegister'])->name('TeacheRMarksRegister');
       Route::post('teacher/submit_mark_register',[ExaminationController::class,'SubmitMarksRegister'])->name('SubmitMarksRegister');
      Route::post('teacher/singlesubmit_mark_register',[ExaminationController::class,'SingleSubmitMarksRegister'])->name('SingleSubmitMarksRegister');




});

Route::group(['middleware' => 'student'],function(){
     Route::get('student/dashboard',[DashController::class,'dashboard']);
     Route::get('student/my_account',[UserController::class,'myAccount']);
     Route::get('student/account',[UserController::class,'UpdatemyAccountStudent']);
     Route::get('student/my_subject',[SubjectConroller::class,'mySubject']);
     Route::get('student/my_timetable',[ClassTimetableController::class,'MyTimetable']);
     Route::get('student/my_exam_schedule',[ExaminationController::class,'MyExamSchedule']);

    // Change Password
    Route::get('student/change_password',[UserController::class,'change_password'])->name('student.c_password');
    Route::post('student/change_password',[UserController::class,'update_password'])->name('student.update_password');
    Route::get('student/my_calendar',[CalenderController::class,'MyCalendar'])->name('student.MyCalendar');
    Route::get('student/my_exam_results',[ExaminationController::class,'MyExamResults'])->name('student.MyExamResults');


});
Route::group(['middleware' => 'parent'],function(){
    Route::get('parent/dashboard',[DashController::class,'dashboard']);
 Route::get('parent/account',[UserController::class,'myAccount']);
     Route::post('parent/account',[UserController::class,'UpdatemyAccountParent']);
     Route::get('parent/my_student',[ParentController::class,'myStudentParent']);
     Route::get('parent/my_student/exam_timetable/{student_id}',[ExaminationController::class,'myStudentExam']);

    // Change Password
    Route::get('parent/change_password', [UserController::class, 'change_password'])->name('parent.c_password');
    Route::post('parent/change_password', [UserController::class, 'update_password'])->name('parent.update_password');
     Route::get('parent/my_student/calendar/{student_id}',[CalenderController::class,'StudentsParentCalendar']);


});