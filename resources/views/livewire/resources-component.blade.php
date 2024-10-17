<div>
    <h1>Resources</h1>

    <input type="text" wire:model="searchTerm" placeholder="Search Resources...">
    <button wire:click="clearSearch">Clear Search</button>

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($resources as $resource)
                <tr>
                    <td>{{ $resource->title }}</td>
                    <td>{{ $resource->description }}</td>
                    <td>
                        <button wire:click="setResource({{ $resource->id }})">Edit</button>
                        <button wire:click="setActionId({{ $resource->id }})" wire:click.prevent="$emit('openDeleteConfirmation')">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $resources->links() }} <!-- Pagination links -->
    @if (session()->has('feedback'))
        <div class="alert alert-success">{{ session('feedback') }}</div>
    @endif
</div>
