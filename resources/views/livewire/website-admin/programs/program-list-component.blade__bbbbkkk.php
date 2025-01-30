<div>
    <x-slot name="title">Program List</x-slot>

    <div class="page-content">
        <!-- Page Title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">Programs</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Programs</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4">All Programs</h4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Program Name</th>
                                    <th>Description</th>
                                    <th>Detailed Content</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($programs as $program)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $program->program_title }}</td>
                                        <td>{!! Str::limit($program->program_description, 50) !!}</td>
                                        <td>{!! Str::limit($program->program_content, 50) !!}</td>
                                        <td>
                                            @if ($program->program_image)
                                                <img src="{{ asset('guest/images/uploads/' . $program->program_image) }}" alt="Program Image" height="40">
                                            @else
                                                <span>No Image</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('programs.edit', $program->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <button wire:click="deleteProgram({{ $program->id }})" class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No programs found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <!-- Pagination Links -->
                        <div class="mt-4">
                            {{ $programs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
