<!-- resources/views/layouts/partials/user-sidebar.blade.php -->
<div class="list-group">
    <a href="{{ route('user.dashboard') }}" class="list-group-item list-group-item-action">Dashboard</a>
    <a href="{{ route('user.appointments.index') }}" class="list-group-item list-group-item-action">My Appointments</a>
    <a href="{{ route('user.profile') }}" class="list-group-item list-group-item-action">Profile</a>
</div>
