<?php

namespace App\Http\Controllers;

use App\Models\Profile;

use Illuminate\Http\Request;
use App\Models\Application; // Assuming you have an Application model
use App\Models\Education;
use App\Models\Skill;
use Illuminate\Support\Facades\Validator;

class ProfilesController extends Controller
{
    public function index() {
        $profiles = Profile::all();
        return view("profile.index")
            ->with('profiles', $profiles);
    }

    public function create() {
        return view("profile.create");
    }

    public function store(Request $request)
    {
        // Step 1: Validate input
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:profiles,email',
            'phone' => 'nullable|string|max:15',

            // Validate education fields
            'education' => 'array',
            'education.*.institution_name' => 'required|string|max:255',
            'education.*.degree' => 'required|string|max:255',
            'education.*.year_of_completion' => 'required|digits:4',

            // Validate work experience fields
            'work_experience' => 'array',
            'work_experience.*.company_name' => 'required|string|max:255',
            'work_experience.*.role' => 'required|string|max:255',
            'work_experience.*.duration' => 'required|string|max:100',

            // Validate skills fields
            'skills' => 'array|min:1',
            'skills.*' => 'required|string|max:255'
        ]);

        // Step 2: Create the Application
        $profile = Profile::create([
            'full_name' => $validatedData['full_name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
        ]);

        // Step 3: Create Education records if provided
        if (!empty($validatedData['education'])) {
            foreach ($validatedData['education'] as $educationData) {
                $profile->education()->create([
                    'institution_name' => $educationData['institution_name'],
                    'degree' => $educationData['degree'],
                    'year_of_completion' => $educationData['year_of_completion'],
                ]);
            }
        }

        // Step 4: Create Work Experience records if provided
        if (!empty($validatedData['work_experience'])) {
            foreach ($validatedData['work_experience'] as $experienceData) {
                $profile->works()->create([
                    'company_name' => $experienceData['company_name'],
                    'role' => $experienceData['role'],
                    'duration' => $experienceData['duration'],
                ]);
            }
        }

        // Step 5: Create Skills records if provided
        if (!empty($validatedData['skills'])) {
            foreach ($validatedData['skills'] as $skillName) {
                $profile->skills()->create(['name' => $skillName]);
            }
        }

        // Redirect back with success message
        return redirect()->route('profiles.index')
            ->with('success', 'Application created successfully.');
    }

    public function getProfile(Profile $profile) {
        return view("profile.show")
            ->with("profile", $profile);
    }

    public function update(Request $request, $id)
    {
        // Validation
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'education.*.institution_name' => 'required|string|max:255',
            'education.*.degree' => 'required|string|max:255',
            'education.*.year_of_completion' => 'required|integer',
            'work_experience.*.company_name' => 'required|string|max:255',
            'work_experience.*.role' => 'required|string|max:255',
            'work_experience.*.duration' => 'required|string|max:255',
            'skills.*' => 'nullable|string|max:255',
        ]);

        $profile = Profile::where("id", $id)->first();
        $profile->full_name = $validated['full_name'];
        $profile->email = $validated['email'];
        $profile->phone = $validated['phone'];

        $profile->save();

        $profile->education()->delete();
        $profile->works()->delete();
        $profile->skills()->delete();

        // Update education, work experience, and skills
        foreach ($validated['education'] as $postData) {
            $profile->education()->create($postData);
        }
        foreach ($validated['work_experience'] as $postData) {
            $profile->works()->create($postData);
        }
        foreach ($validated['skills'] as $postData) {
            $profile->skills()->create(['name' => $postData]);
        }

        return redirect()->route('profiles.show', $profile->id)->with('success', 'Application updated successfully!');
    }
}
