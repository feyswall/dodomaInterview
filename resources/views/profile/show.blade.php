@extends('cLayout.system')

@section('content')
    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session()->has("success"))
        <div class="alert alert-success">
            <span>{{ session()->get("success") }}</span>
        </div>
    @endif
    <h2 class="mb-4 text-center">Application Details</h2>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-dark mb-4" data-toggle="modal" data-target="#application-update">
        Update Application
    </button>

    <!-- Modal -->
    <div class="modal fade" id="application-update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Application Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Edit Form -->
                    <form id="updateProfile" method="POST" action="{{ route('profiles.update', $profile->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Full Name -->
                        <div class="form-group">
                            <label for="full_name">Full Name</label>
                            <input type="text" name="full_name" id="full_name" class="form-control"
                                value="{{ old('full_name', $profile->full_name) }}" required>
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ old('email', $profile->email) }}" required>
                        </div>

                        <!-- Phone -->
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" name="phone" id="phone" class="form-control"
                                value="{{ old('phone', $profile->phone) }}" required>
                        </div>



                        <div id="accordion">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                            aria-expanded="true" aria-controls="collapseOne">
                                            Education History
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <!-- Education History (Multiple Entries) -->
                                        <div class="form-group mt-5 mb-5" id="education_fields">
                                            <label for="education">Education History</label>
                                            @foreach ($profile->education as $index => $education)
                                                <div class="education-entry">
                                                    <input type="text"
                                                        name="education[{{ $index }}][institution_name]"
                                                        class="form-control mb-2" placeholder="Institution Name"
                                                        value="{{ old('education.' . $index . '.institution_name', $education['institution_name']) }}"
                                                        required>
                                                    <input type="text" name="education[{{ $index }}][degree]"
                                                        class="form-control mb-2" placeholder="Degree"
                                                        value="{{ old('education.' . $index . '.degree', $education['degree']) }}"
                                                        required>
                                                    <input type="text"
                                                        name="education[{{ $index }}][year_of_completion]"
                                                        class="form-control mb-2" placeholder="Year of Completion"
                                                        value="{{ old('education.' . $index . '.year_of_completion', $education['year_of_completion']) }}"
                                                        required>
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm remove-education">Remove</button>
                                                </div>
                                            @endforeach
                                            <button type="button" class="btn btn-primary btn-sm mt-2" id="add_education">Add
                                                Education</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                        <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Work Experience
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <!-- Work Experience (Multiple Entries) -->
                                        <div class="form-group" id="work_experience_fields">
                                            <label for="work_experience">Work Experience</label>
                                            @foreach ($profile->works as $index => $experience)
                                                <div class="work-experience-entry">
                                                    <input type="text"
                                                        name="work_experience[{{ $index }}][company_name]"
                                                        class="form-control mb-2" placeholder="Company Name"
                                                        value="{{ old('work_experience.' . $index . '.company_name', $experience['company_name']) }}"
                                                        required>
                                                    <input type="text"
                                                        name="work_experience[{{ $index }}][role]"
                                                        class="form-control mb-2" placeholder="Role"
                                                        value="{{ old('work_experience.' . $index . '.role', $experience['role']) }}"
                                                        required>
                                                    <input type="text"
                                                        name="work_experience[{{ $index }}][duration]"
                                                        class="form-control mb-2" placeholder="Duration"
                                                        value="{{ old('work_experience.' . $index . '.duration', $experience['duration']) }}"
                                                        required>
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm remove-work-experience">Remove</button>
                                                </div>
                                            @endforeach
                                            <button type="button" class="btn btn-primary btn-sm mt-2"
                                                id="add_work_experience">Add Work
                                                Experience</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h5 class="mb-0">
                                        <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">
                                            Skills
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <!-- Skills -->
                                        <div class="form-group">
                                            <label for="skills">Skills</label>
                                            @foreach ($profile->skills as $index => $skill)
                                                <div class="skill-entry mb-2">
                                                    <input type="text" name="skills[{{ $index }}]"
                                                        class="form-control mb-2" value="{{ $skill['name'] }}"
                                                        placeholder="{{ $skill['name'] }}" required>
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm remove-skill">Remove</button>
                                                </div>
                                            @endforeach
                                            <button type="button"
                                            class="btn btn-primary btn-sm mt-2" id="add_skill">Add
                                                Skill</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group text-center">
                            <button type="submit"
                                id="editApplication"
                                class="btn btn-success">Update Application</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Personal Information Card -->
    <div class="card mb-4">
        <div class="card-header">
            <h4>Personal Information</h4>
        </div>
        <div class="card-body">
            <p><strong>Full Name:</strong> {{ $profile->full_name }}</p>
            <p><strong>Email:</strong> {{ $profile->email }}</p>
            <p><strong>Phone:</strong> {{ $profile->phone }}</p>
        </div>
    </div>

    <!-- Education History Card -->
    <div class="card mb-4">
        <div class="card-header">
            <h4>Education History</h4>
        </div>
        <div class="card-body">
            @forelse($profile->education as $education)
                <div class="mb-3">
                    <h5>{{ $education['institution_name'] }}</h5>
                    <p><strong>Degree:</strong> {{ $education['degree'] }}</p>
                    <p><strong>Year of Completion:</strong> {{ $education['year_of_completion'] }}</p>
                </div>
                <hr>
            @empty
                <p>No education history available.</p>
            @endforelse
        </div>
    </div>

    <!-- Work Experience Card -->
    <div class="card mb-4">
        <div class="card-header">
            <h4>Work Experience</h4>
        </div>
        <div class="card-body">
            @forelse($profile->works as $experience)
                <div class="mb-3">
                    <h5>{{ $experience['company_name'] }}</h5>
                    <p><strong>Role:</strong> {{ $experience['role'] }}</p>
                    <p><strong>Duration:</strong> {{ $experience['duration'] }}</p>
                </div>
                <hr>
            @empty
                <p>No work experience available.</p>
            @endforelse
        </div>
    </div>

    <!-- Skills Card -->
    <div class="card mb-4">
        <div class="card-header">
            <h4>Skills</h4>
        </div>
        <div class="card-body">
            @if ($profile->skills)
                <ul class="list-group">
                    @foreach ($profile->skills as $skill)
                        <li class="list-group-item">{{ $skill->name }}</li>
                    @endforeach
                </ul>
            @else
                <p>No skills available.</p>
            @endif
        </div>
    </div>

    <!-- Back Button -->
    <div class="text-center">
        <a href="{{ route('profiles.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to
            Applications</a>
    </div>
    </div>

    @section('script')
        <script>
            // Add education entry
            $('#add_education').click(function() {
                var educationHtml = `<div class="education-entry">
            <input type="text" name="education[][institution_name]" class="form-control mb-2" placeholder="Institution Name" required>
            <input type="text" name="education[][degree]" class="form-control mb-2" placeholder="Degree" required>
            <input type="text" name="education[][year_of_completion]" class="form-control mb-2" placeholder="Year of Completion" required>
            <button type="button" class="btn btn-danger remove-education">Remove</button>
        </div>`;
                $('#education_fields').append(educationHtml);
            });

            // Remove education entry
            $(document).on('click', '.remove-education', function() {
                $(this).closest('.education-entry').remove();
            });

            // Add work experience entry
            $('#add_work_experience').click(function() {
                var workExperienceHtml = `<div class="work-experience-entry">
            <input type="text" name="work_experience[][company_name]" class="form-control mb-2" placeholder="Company Name" required>
            <input type="text" name="work_experience[][role]" class="form-control mb-2" placeholder="Role" required>
            <input type="text" name="work_experience[][duration]" class="form-control mb-2" placeholder="Duration" required>
            <button type="button" class="btn btn-danger remove-work-experience">Remove</button>
        </div>`;
                $('#work_experience_fields').append(workExperienceHtml);
            });

            // Remove work experience entry
            $(document).on('click', '.remove-work-experience', function() {
                $(this).closest('.work-experience-entry').remove();
            });


            // Add new skill input
            $('#add_skill').click(function() {
                var skillHtml = `
            <div class="skill-entry mb-2">
                <input type="text" name="skills[]" class="form-control mb-2" placeholder="Skill" required>
                <button type="button" class="btn btn-danger remove-skill">Remove</button>
            </div>
        `;
                $(this).before(skillHtml);
            });

            // Remove a skill input
            $(document).on('click', '.remove-skill', function() {
                $(this).closest('.skill-entry').remove();
            });


        </script>
    @endsection
@endsection
