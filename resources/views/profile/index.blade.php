@extends('cLayout.system')

@section('content')
    <h2 class="mb-4">Applicant List</h2>
    <a class="btn btn-dark mb-4" href="{{ route('profiles.create') }}">Fill Apprication Form Here</a>
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Education Summary</th>
                <th>Work Experience Summary</th>
                <th>Skills</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($profiles as $index => $applicant)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $applicant->full_name }}</td>
                    <td>{{ $applicant->email }}</td>
                    <td>{{ $applicant->phone }}</td>
                    <td>
                        @foreach ($applicant->education as $education)
                            <p>{{ $education->degree }} at {{ $education->institution_name }}
                                ({{ $education->year_of_completion }})</p>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($applicant->works as $experience)
                            <p>{{ $experience->role }} at {{ $experience->company_name }} ({{ $experience->duration }})</p>
                        @endforeach
                    </td>
                    <td>
                        <ul>
                            @foreach ($applicant->skills as $skill)
                                <li>{{ $skill->name }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <a href="{{ route("profiles.show", $applicant->id) }}">view</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
