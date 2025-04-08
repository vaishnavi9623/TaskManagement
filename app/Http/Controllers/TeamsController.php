<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Team;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class TeamsController extends Controller
{
    
    public function index(Request $request)
    {
        //dd($request);
        if ($request->ajax()) {
            $UserId = Auth::id();
            return DataTables::of(Team::with(['members:id,name'])) // Fetch only needed columns
            ->addColumn('members', function ($row) {
                $memberIds = json_decode($row->members, true);
                $members = User::whereIn('id', $memberIds)->get(['name', 'photo']);

                $html = '<div class="d-flex align-items-center">';
                $maxToShow = 4;
                $shownCount = 0;
            
                foreach ($members as $member) {
                    if ($shownCount >= $maxToShow) break;
            
                    $imageUrl = asset('storage/uploads/employees/' . $member->photo);
                    $html .= '<div class="position-relative me-n2" style="z-index: '.(100 - $shownCount).'">
                                <img src="' . $imageUrl . '" title="' . $member->name . '" 
                                    class="rounded-circle border border-white" width="30" height="30" 
                                    data-bs-toggle="tooltip" data-bs-placement="top" />
                             </div>';
                    $shownCount++;
                }
                // If more than 4 members
                $remaining = count($members) - $maxToShow;
                if ($remaining > 0) {
                    $html .= '<div class="position-relative me-n2" style="z-index: 1;">
                                <div class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center border border-white"
                                     style="width: 30px; height: 30px;" 
                                     title="' . $remaining . ' more members"
                                     data-bs-toggle="tooltip" data-bs-placement="top">
                                     +'. $remaining .'
                                </div>
                             </div>';
                }
            
                $html .= '</div>';

                return $html;
            })
            ->addColumn('lead', function ($row) {
                $html = '<div class="d-flex align-items-center">';
                $lead = User::find($row->lead, ['name', 'photo']);

                if ($lead) {
                    $imageUrl = asset('storage/uploads/employees/' . $lead->photo);
                    $html .= '<div class="position-relative me-n2">
                                <img src="' . $imageUrl . '" title="' . $lead->name . '" 
                                    class="rounded-circle border border-white" width="30" height="30" 
                                    data-bs-toggle="tooltip" data-bs-placement="top" />
                            </div>';
                } else {
                    $html .= '<span class="text-muted">N/A</span>';
                }

                $html .= '</div>';
                return $html;
            })
            ->addColumn('action', function ($row) use ($UserId) {
                return '<a href="#" class="viewTeam" data-id="' . $row->id . '"><i class="fa-regular fa-eye"></i></a>
                <a href="' . route('getteamdataforedit', ['id' => $row->id]) . '" class="editTeam" data-id="' . $row->id . '"><i class="fa-solid fa-pen-to-square text-warning"></i></a>
                <a href="' . route('deleteteam', ['id' => $row->id]) . '"  data-id="' . $row->id . '" class="deleteTeam" data-id="' . $row->id . '"><i class="fa-solid fa-trash text-danger"></i></a>
                ';
            })
            ->rawColumns(['members','lead','action']) // Allow HTML in columns
            ->make(true);

        }
    return view('Teams/team');
    }

    public function addnewteam(Request $request)
    {
            $UserId = Auth::id();
            $validate = $request->validate([
                "team_name"=>'required|string',
                "description"=>'required|string',
                "members"=>'required',
                "team_lead"=>'required'
            ]);

            $members = json_encode($validate['members']);
            $Team = Team::create([
                'name'=>$validate['team_name'],
                'description'=>$validate['description'],
                'members'=>$members,
                'lead'=>$validate['team_lead'],
                'status'=>'Active',
            ]);

            if($Team)
            {
                return redirect()->route('team')->with('success', 'Teams added successfully!');
            } else {
                return response()->json(['error' => 'Team creation failed'], 500);
            }
                
    }
    public function getteamdetails($id)
    {
        $team = Team::findOrFail($id);

        $memberIds = json_decode($team->members, true);
        $members = User::whereIn('id', $memberIds)->pluck('name')->toArray();
    
        $leadName = User::where('id', $team->lead)->value('name');
    
        return response()->json([
            'name' => $team->name,
            'description' => $team->description,
            'lead' => $leadName,
            'members' => $members
        ]);
    }
    
    public function getteamdataforedit($id)
    {
        $team = Team::findOrFail($id);
        $users = User::all(); 
        return view('Teams.updateteam', compact('team','users'));

    }
    public function deleteteam($id)
    {
        $team = Team::findorFail($id);
        $team->delete();
        return response()->json(['message'=>'Team deleted successfully']);
    }

    public function updateteam($id, Request $request)
    {
        $UserId = Auth::id();
        $validate = $request->validate([
            "team_name"=>'required|string',
            "description"=>'required|string',
            "members"=>'required',
            "team_lead"=>'required'
        ]);

        $members = json_encode($validate['members']);
        $teamData = [
            'name'=>$validate['team_name'],
            'description'=>$validate['description'],
            'members'=>$members,
            'lead'=>$validate['team_lead'],
            'status'=>'Active',
        ];
        $team = Team::Where('id',$id)->update($teamData);
        return redirect()->route('team')->with('success', 'Team updated successfully!');

    }
}
