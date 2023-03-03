<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuditTrailModel;
use Response;
use DataTables;
use Session;
use View;
use Hash;

class AuditTrailController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  
  public function index()
  {
      $title = "Administration";
      return view('administration.audit_trail')->with('title', $title);
  }

  public function table(Request $request){
    $data = AuditTrailModel::latest()->get()->where('is_deleted', '=', '0');
    if ($request->ajax()) {
         return DataTables::of($data)
           ->setRowAttr([
             'data-id' => function($user) {
               return $user->id;
             }
           ])
           ->addColumn('action', function($row){
                $btn =
                "<div>
                  <button class='actionbtn view-user' type='button'> 
                    <i class='fas fa-eye'></i></a>                    
                  </button>
                  <button class='actionbtn update-user' type='button'>
                    <i class='fas fa-edit blue'></i>
                  </button>
                  <button class='actionbtn delete-user' type='button'>
                    <i class='fas fa-trash-alt red'></i>
                  </button>
                </div>
                ";
                  return $btn;
           })
           ->rawColumns(['action'])
           ->make(true);
     }
  }
  public function show(Request $request) {
    if($request->ajax()){
      $user = AuditTrailModel::find($request->get('user_id'));
      if($user->count()) {
        return Response::json([
          'status' => '1',
          'user' => $user
        ]);
      } else {
        return Response::json([
          'status' => '0'
        ]);
      }
    }
  }

  public function store(Request $request) {
    if ($request->ajax()) {
      $request->session()->forget('success');
      $request->session()->forget('error');

      $messages = array(
          'firstname.required' => 'The First Name field is required.',
          'lastname.required' => 'The Middle Name field is required.',
          'username.required' => 'The Username field is required.',
          'email.required' => 'The Email Address field is required.',
          'email.email' => 'The Email Address must be valid.',
          'password.required' => 'The Password Field is required.'
      );
      $v =  \Validator::make($request->all(), [
        'firstname' => ['required', 'string', 'max:255'],
        'lastname' => ['required', 'string', 'max:255'],
        'username' => ['required', 'string', 'max:255', 'unique:users'],    
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'max:255'],
      ], $messages);

      if($v->fails()){
        Session::flash('error', 'Please fill out the required fields:');
        return Response::json([
          'view' => View::make('partials/flash-messages')->withErrors($v->errors())
          ->render(),
          'status'=>'0'
        ]);
      } else {
        $user = new AuditTrailModel([
          'firstname' => $request->get('firstname'),
          'lastname' => $request->get('lastname'),
          'username' => $request->get('username'),         
          'email' => $request->get('email'),
          'password' => Hash::make($request->get('password'))
        ]);

        try {
          $user->save();
        } catch (\Exception $e) {
          dd($e);
          Session::flash('error', 'Error in inserting to database');
          return Response::json([
            'view' => View::make('partials/flash-messages')
            ->withErrors($v->errors())->with('error', 'Please check your data:')
            ->render(),
            'status'=>'0'
          ]);
        }
        Session::flash('success', 'User has been created successfully!');
      }
      return Response::json([
        'view' => View::make('partials/flash-messages')
        ->withErrors($v->errors())->with('success', 'User has been created successfully')
        ->render(),
        'status' => '1',
        'user_id' => $user->id
      ]);

    }
  }

  public function update(Request $request) {
    if ($request->ajax()) {
      $request->session()->forget('success');
      $request->session()->forget('error');

      $messages = array(
          'firstname.required' => 'The First Name field is required.',
          'lastname.required' => 'The Middle Name field is required.',
          'username.required' => 'The Username field is required.',          
          'email.required' => 'The Email Address field is required.',
          'email.email' => 'The Email Address must be valid.',
      );
      $v =  \Validator::make($request->all(), [
        'firstname' => ['required', 'string', 'max:255'],
        'lastname' => ['required', 'string', 'max:255'],
        'username' => ['required', 'string', 'max:255', 'unique:users,username,'.$request->all()['user_id']],       
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,username,'.$request->all()['user_id']]
      ], $messages);

      if($v->fails()){
        Session::flash('error', 'Please fill out the required fields:');
        return Response::json([
          'view' => View::make('partials/flash-messages')->withErrors($v->errors())
          ->render(),
          'status'=>'0'
        ]);
      } else {

        try {
          if(empty($request->get('password')) || is_null($request->get('password'))) {
            AuditTrailModel::where('is_deleted', '=', '0')
              ->where('id', '=', $request->all()['user_id'])
              ->update([
              'firstname' => $request->get('firstname'),
              'lastname' => $request->get('lastname'),
              'username' => $request->get('username'),             
              'email' => $request->get('email')
            ]);
          } else {
            AuditTrailModel::where('is_deleted', '=', '0')
              ->where('id', '=', $request->all()['user_id'])
              ->update([
              'firstname' => $request->get('firstname'),
              'lastname' => $request->get('lastname'),
              'username' => $request->get('username'),              
              'email' => $request->get('email'),
              'password' => Hash::make($request->get('password'))
            ]);

          }
        } catch (\Exception $e) {
          Session::flash('error', 'Error in updated in database');
          return Response::json([
            'view' => View::make('partials/flash-messages')
            ->withErrors($v->errors())->with('error', 'Please check your data:')
            ->render(),
            'status'=>'0'
          ]);
          dd($e);
        }
        Session::flash('success', 'User has been updated successfully!');
      }
      return Response::json([
        'view' => View::make('partials/flash-messages')
        ->withErrors($v->errors())->with('success', 'User has been updated successfully')
        ->render(),
        'status' => '1'
      ]);

    }
  }


  public function delete(Request $request){

    if($request->ajax()) {
      try {
        $user = AuditTrailModel::where('is_deleted', '=', '0')
         ->where('id', '=', $request->all()['user_id']);
        $user->update([
          'is_deleted' => '1'
        ]);


      }catch (\Exception $e) {
        return Response::json([
          'status'=>'0'
        ]);
      }
      return Response::json([
        'status'=>'1'
      ]);
    }

  }
}
