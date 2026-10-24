<div>
    <x-slot name="title">Customers &amp; Users</x-slot>
    <div class="page-content">
        <div class="page-title-box"><h1 class="h4">Customers &amp; Users</h1><p class="text-muted">View registered accounts and their selected service or program.</p></div>
        <div class="card"><div class="card-body">
            <div class="row g-3 mb-4">
                <div class="col-md-8">
                    <label for="user-search">Search by name, email or phone</label>
                    <input id="user-search" type="search" wire:model.live.debounce.300ms="search" maxlength="255" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="user-type">Account type</label>
                    <select id="user-type" wire:model.live="type" class="form-select">
                        <option value="Client">Customers</option><option value="">All users</option>
                        <option value="Website Admin">Website administrators</option><option value="Super Admin">Super administrators</option>
                    </select>
                </div>
            </div>
            <p role="status" wire:loading>Loading users...</p>
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <caption class="visually-hidden">Registered users and account status</caption>
                    <thead><tr><th scope="col">Name</th><th scope="col">Contact</th><th scope="col">Role / status</th><th scope="col">Email / setup</th><th scope="col">Selected interest</th><th scope="col">Registered</th></tr></thead>
                    <tbody>
                    @forelse($users as $user)
                        <tr wire:key="user-{{ $user->id }}">
                            <td>{{ $user->surname }} {{ $user->othernames }}</td>
                            <td>{{ $user->email }}<br>{{ $user->phoneno }}</td>
                            <td>{{ $user->user_type }}<br>{{ $user->status }}</td>
                            <td>{{ $user->hasVerifiedEmail() ? 'Verified' : 'Unverified' }}<br>{{ $user->password_setup_required ? 'Password setup pending' : 'Password set' }}</td>
                            <td>{{ $user->preferredProgram?->program_title ?? $user->preferredService?->service_title ?? 'Not selected' }}</td>
                            <td>{{ $user->created_at?->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-4">No users match your search.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            {{ $users->links() }}
        </div></div>
    </div>
</div>
