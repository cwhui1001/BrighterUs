@vite(['resources/css/compare.css', 'resources/js/compare.js'])
<x-app-layout>
    <x-slot name="header">
        <h2 class="custom-header">
            {{ __('Compare Courses') }}
        </h2>
    </x-slot>

    <div class="compare-container">
        @if(count($courses) > 0)
            <table class="compare-table">
                <thead>
                    <tr>
                        <th>Details</th>
                        @foreach ($courses as $course)
                            <th>{{ $course->name }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Category</strong></td>
                        @foreach ($courses as $course)
                            <td>{{ $course->category->name }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td><strong>Field</strong></td>
                        @foreach ($courses as $course)
                            <td>{{ $course->field->name }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td><strong>University</strong></td>
                        @foreach ($courses as $course)
                            <td>{{ $course->university->name }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td><strong>Location</strong></td>
                        @foreach ($courses as $course)
                            <td>{{ $course->location->name }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td><strong>Budget</strong></td>
                        @foreach ($courses as $course)
                            <td>RM {{ number_format($course->budget, 0) }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td><strong>Ranking</strong></td>
                        @foreach ($courses as $course)
                            <td>{{ $course->ranking }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td><strong>Description</strong></td>
                        @foreach ($courses as $course)
                            <td>{{ $course->description }}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        @else
            <p>No courses selected for comparison.</p>
        @endif
    </div>
</x-app-layout>
