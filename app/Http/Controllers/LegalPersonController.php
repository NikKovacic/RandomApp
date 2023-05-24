<?php

namespace App\Http\Controllers;

use App\Models\LegalPerson;
use App\Rules\TINValidation;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LegalPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $people = LegalPerson::latest()->paginate(10);

        return view('legal_person.index', compact('people'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View {
        return view('legal_person.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email:rfc,dns|unique:legal_people',
            'phone' => 'required|string|max:255|phone|unique:legal_people',
            'tin' => ['required', 'string', 'max:255', new TINValidation, 'unique:legal_people'],
        ]);

        try {
            LegalPerson::create($validated);
            return back()->with([
                'status' => 'success',
                'msg' => 'Person created successfully.'
            ]); //@todo:translate
        } catch (Exception $e) {
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
        $person = LegalPerson::findOrFail($id);

        return view('legal_person.show', compact('person'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $person = LegalPerson::findOrFail($id);

        return view('legal_person.edit', compact('person'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email:rfc,dns|unique:legal_people,email,'.$id,
            'phone' => 'required|string|max:255|phone|unique:legal_people,phone,'.$id,
            'tin' => ['required', 'string', 'max:255', new TINValidation, 'unique:legal_people,tin,'.$id],
        ]);

        try {
            $person = LegalPerson::findOrFail($id);
            $person->update($validated);
            return back()->with([
                'status' => 'success',
                'msg' => 'Person updated successfully.'
            ]); //@todo:translate
        } catch (Exception $e) {
            return back()->with([
                'status' => 'danger',
                'msg' => 'An error has occurred! Please try later.'
            ])->withInput(); //@todo:translate
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $person = LegalPerson::findOrFail($id);
            $person->delete();
            return response()->json([
                'success' => true,
                'path' => route('legal-person.index')
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => 'An error has occurred! Please try later.'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function notify(Request $request, string $id): JsonResponse
    {
        //@todo: get text user entered and notify user with created RandomNotification (SMS logic can be implemented in new service and used here).
    }
}
