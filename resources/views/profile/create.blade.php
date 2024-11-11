@extends('cLayout.system')

@section('content')
    <a class="btn btn-dark mb-4" href="{{ route('profiles.index') }}">All Applications</a>

    <h2 class="mb-4">Register New Application</h2>
    <form action="{{ route('profiles.store') }}" method="POST">
        @csrf

        <!-- Personal Information Section -->
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" class="form-control" id="full_name" name="full_name" required>
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone">
        </div>

        <!-- Education History Section -->
        <h4>Education History</h4>
        <div id="education-fields">
            <div class="education-entry form-row mb-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="education[0][institution_name]"
                        placeholder="Institution Name" required>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="education[0][degree]" placeholder="Degree" required>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="education[0][year_of_completion]"
                        placeholder="Year of Completion" required>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-secondary mb-3" id="add-education">Add More Education</button>

        <!-- Work Experience Section -->
        <h4>Work Experience</h4>
        <div id="experience-fields">
            <div class="experience-entry form-row mb-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="work_experience[0][company_name]"
                        placeholder="Company Name" required>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="work_experience[0][role]" placeholder="Role" required>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="work_experience[0][duration]" placeholder="Duration"
                        required>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-secondary mb-3" id="add-experience">Add More Experience</button>

        <!-- Skills Section -->
        <h4>Skills</h4>
        <div id="skills-fields">
            <div class="form-group">
                <input type="text" class="form-control" name="skills[]" placeholder="Skill" required>
            </div>
        </div>
        <button type="button" class="btn btn-secondary mb-3" id="add-skill">Add More Skill</button>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Submit Application</button>
    </form>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            let educationIndex = 1;
            $('#add-education').click(function() {
                $('#education-fields').append(`
                <div class="education-entry form-row mb-3">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="education[${educationIndex}][institution_name]" placeholder="Institution Name" required>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="education[${educationIndex}][degree]" placeholder="Degree" required>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="education[${educationIndex}][year_of_completion]" placeholder="Year of Completion" required>
                    </div>
                </div>
            `);
                educationIndex++;
            });

            let experienceIndex = 1;
            $('#add-experience').click(function() {
                $('#experience-fields').append(`
                <div class="experience-entry form-row mb-3">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="work_experience[${experienceIndex}][company_name]" placeholder="Company Name" required>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="work_experience[${experienceIndex}][role]" placeholder="Role" required>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="work_experience[${experienceIndex}][duration]" placeholder="Duration" required>
                    </div>
                </div>
            `);
                experienceIndex++;
            });

            $('#add-skill').click(function() {
                $('#skills-fields').append(`
                <div class="form-group">
                    <input type="text" class="form-control" name="skills[]" placeholder="Skill" required>
                </div>
            `);
            });
        });
    </script>
@endsection
