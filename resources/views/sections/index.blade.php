@extends('layouts.app')

@section('content')
    <h1>Sections</h1>
    <a href="{{ route('sections.create') }}" class="btn btn-primary">Create New Section</a>

    <table>
        <thead>
            <tr>
                <th>Heading</th>
                <th>Sub Heading</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sections as $section)
                <tr>
                    <td>{{ $section->heading }}</td>
                    <td>{{ $section->sub_heading }}</td>
                    <td>
                        <a href="{{ route('sections.edit', $section->id) }}">Edit</a>
                        <form action="{{ route('sections.destroy', $section->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
