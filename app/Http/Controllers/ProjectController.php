<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Member;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{

    public function ProjectIdea(){
        return view('admin.pages.projectcreate');
    }
    
    public function ProjectSubmit(Request $request){
        // Validate member IDs
        $memberIds = $request->input('member_id');
        foreach ($memberIds as $key => $value) {
            if (!empty($value)) { // Skip empty member ids
                $duplicateMember = Member::where('member_id', $value)->first();
                if ($duplicateMember && $duplicateMember->project_id != null) {
                    $existingProject = Project::find($duplicateMember->project_id);
                    $this->$request->session()->flash('error', 'Member ID ' . $value . ' is already assigned to another project ('.$existingProject->title.')!');
                    return redirect()->back();
                }
            }
        }
    
        // Create new project
        $project = new Project;
        $project->title = $request->input('title');
        $project->description = $request->input('description');        
        $project->save();
    
        // Create members and associate with project
        $memberNames = $request->input('member_name');
        foreach ($memberIds as $key => $value) {
            if (!empty($value)) { // Skip empty member ids
                $member = new Member;
                $member->member_id = $value;
                $member->member_name = $memberNames[$key];
                $project->members()->save($member);
            }
        }
    
        return redirect()->back()->with('success', 'Project added successfully!');
    }
    
    public function projects(){
        $projects = Project::all();
        return view('admin.pages.projects', compact('projects'));
    }

    public function show($project_id)
    {
        $project = Project::findOrFail($project_id);
        $members = $project->members;
        return view('admin.pages.project-details', compact('project', 'members'));
    }

    public function index()
    {
        $projects = DB::table('projects')
                    ->join('members', 'members.project_id', '=', 'projects.id') 
                    ->select('projects.id', 'projects.title', 'projects.description', 'members.member_id','members.member_name', 'projects.is_approved')
                    ->get();

        return view('admin.pages.projects', compact('projects'));
    }

    // public function approve($projectId, $memberId){

    //     $member = Member::find($memberId);

    //     if(!$member){
    //         // handle case where member is not found
    //         return redirect()->back();
    //     }

    //     if($member->is_approved == 1){
    //         // handle case where member is already approved
    //         return redirect()->back();
    //     }

    //     $member->is_approved = 1;

    //     if($member->save()){

    //         return redirect()->back();

    //     }
    // }

    // public function approveProjectMember($projectId, $memberId)
    // {
    //     // Update the approval status in the database
    //     DB::table('members')->where('id', $memberId)->update(['is_approved' => 1]);

    //     // Check if all members for this project have been approved
    //     $allMembersApproved = true;
    //     $project = Project::find($projectId);
    //     foreach ($project->members as $member) {
    //         if (!$member->is_approved) {
    //             $allMembersApproved = false;
    //             break;
    //         }
    //     }

    //     // If all members have been approved, update the project status as well
    //     if ($allMembersApproved) {
    //         DB::table('projects')->where('id', $projectId)->update(['is_approved' => 1]);
    //     }

    //     return redirect()->back();
    // }

    // public function approveProject($projectId)
    // {
    //     // Find the project
    //     $project = Project::find($projectId);
    
    //     if (!$project) {
    //         // Handle case when project is not found
    //         return redirect()->route('projects.index')->withErrors(['Project not found']);
    //     }
    
    //     // Check if all members for this project have been approved
    //     $allMembersApproved = true;
    //     foreach ($project->members as $member) {
    //         if (!$member->is_approved) {
    //             $allMembersApproved = false;
    //             break;
    //         }
    //     }
    
    //     // Approve the project if all members have been approved
    //     if ($allMembersApproved) {
    //         $project->is_approved = 1;
    //         $project->save();
    
    //         return redirect()->route('projects.index')->with('success', 'Project approved successfully');
            
    //     } else {
    //         return redirect()->back()->withErrors(['All members for this project must be approved before the project can be approved.']);
    //     }
    // }
    public function approve($projectId){
        $project = Project::find($projectId);
        $project->is_approved = 1;
        if($project->save()){
            return redirect()->back();
        }
    }
    




}
