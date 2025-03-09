@extends('layouts.admin')

@section('content')
    <h2 style="background-color: orange; padding: 20px; color: white; border-radius: 15px">Add Scholarship</h2>

    <form style="padding: 30px;" action="{{ route('admin.financial.scholarships.store') }}" method="POST">
        @csrf

        <label>Type:</label>
        <input type="text" name="type" class="form-control" required>
        <br>

        <label>Name:</label>
        <input type="text" name="name" class="form-control" required>
        <br>

        <label>Participating Programmes:</label>
        <div id="participating_programmes" style="height: 200px;"></div>
        <textarea name="participating_programmes" style="display:none;"></textarea>
        <br>

        <label>Eligibility Criteria:</label>
        <div id="eligibility_criteria" style="height: 200px;"></div>
        <textarea name="eligibility_criteria" style="display:none;"></textarea>
        <br>

        <label>Scholarship Value:</label>
        <div id="scholarship_value" style="height: 200px;"></div>
        <textarea name="scholarship_value" style="display:none;"></textarea>
        <br>

        <label>Documents Required:</label>
        <div id="documents_required" style="height: 200px;"></div>
        <textarea name="documents_required" style="display:none;"></textarea>
        <br>

        <label>Application Procedure:</label>
        <div id="application_procedure" style="height: 200px;"></div>
        <textarea name="application_procedure" style="display:none;"></textarea>
        <br>

        <label>Application Deadline:</label>
        <input type="date" name="application_deadline" class="form-control" required>
        <br>

        <button type="submit" class="btn btn-success">Submit</button>
    </form>

    {{-- Quill Script and Styles --}}
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        // Initialize Quill for each editor
        const editors = [
            'participating_programmes',
            'eligibility_criteria',
            'scholarship_value',
            'documents_required',
            'application_procedure',
        ];

        editors.forEach((editorId) => {
            const quill = new Quill(`#${editorId}`, {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        ['link', 'image'],
                        ['clean']
                    ],
                },
            });

            // Update the hidden textarea with Quill's content before form submission
            const textarea = document.querySelector(`textarea[name="${editorId}"]`);
            quill.on('text-change', () => {
                textarea.value = quill.root.innerHTML;
            });
        });
    </script>
@endsection
