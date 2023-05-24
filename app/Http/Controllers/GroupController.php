<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\LegalPerson;
use App\Models\NaturalPerson;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    // @todo: add to group!

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $groups = Group::withCount('naturalPersons','legalPersons')->latest()->paginate(10);

        return view('group.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View {
        $natural_people = NaturalPerson::orderBy('name', 'desc')->get();
        $legal_people = LegalPerson::orderBy('name', 'desc')->get();

        return view('group.create', compact('natural_people', 'legal_people'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'natural_people.*' => 'nullable|integer|exists:legal_people,id',
            'legal_people.*' => 'nullable|integer|exists:legal_people,id',
        ]);

        DB::beginTransaction();
        try {
            $group = Group::create(['name' => $validated['name']]);
            $natural_people = $this->prepareMembersData($validated['natural_people'], $group->id, NaturalPerson::class);
            $legal_people = $this->prepareMembersData($validated['legal_people'], $group->id, LegalPerson::class);
            DB::table('groupables')->insert($natural_people);
            DB::table('groupables')->insert($legal_people);
            DB::commit();

            return back()->with([
                'status' => 'success',
                'msg' => 'Group created successfully.'
            ]); //@todo:translate
        } catch (Exception $e) {
            DB::rollback();

            return back()->with([
                'status' => 'danger',
                'msg' => 'An error has occurred! Please try later.'
            ])->withInput(); //@todo:translate
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $group = Group::with('natural_persons', 'legal_persons')->findOrFail($id);

        return view('group.show', compact('group'));
    }

    private function prepareMembersData($data, $group_id, $type){
        $members = [];
        foreach ($data as $member_id) {
            $members[] = [
                'group_id' => $group_id,
                'groupable_id' => $member_id,
                'groupable_type' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        return $members;
    }
}
