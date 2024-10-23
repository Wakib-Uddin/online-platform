<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{

    public function create(){
        return view('department.create');
    }
    public function store(Request $request){
        $obj = new Department();

        $request->validate([
            "dept_name"       => 'required',
            "established" => 'required',
            'code'   => 'required',
        ]);

        $obj->name = $request->dept_name;
        $obj->code = $request->code;
        $obj->established_at = $request->established;
        if($obj->save()){
            echo "Data Inserted Successfully";
        }
        else{
            echo "Bodda! Vul Gori Aissu";
        }
        }

        public function all(){
            //select * from departments
            $departments=Department::all();
            //dd($departments);
            return view('department.all',compact('departments'));
        }

        public function edit($id){
            echo $id;
            //select * from departments
            $departments=Department::find($id);
            //dd($departments);
            return view('department.edit',compact('departments'));
        }

        public function update(Request $request,$id){
            $obj =Department::find($id);
            $obj->name = $request->dept_name;
            $obj->code = $request->code;
            $obj->established_at = $request->established;
            if($obj->save()){
                return redirect('department/all');


            }

            //return view('department.edit',compact('departments'));
        }

        public function delete($id){
            if(Department::find($id)->delete()){
                return redirect('department/all');
            }
            



        }

    



}
