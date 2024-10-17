<!-- resources/views/layouts/partials/counselor-sidebar.blade.php -->
<div class="list-group">
    <a href="{{ route('counselor.dashboard') }}" class="list-group-item list-group-item-action">Dashboard</a>
    <a href="{{ route('counselor.appointments.index') }}" class="list-group-item list-group-item-action">My Appointments</a>
    <a href="{{ route('counselor.reports.index') }}" class="list-group-item list-group-item-action">Reports</a>
</div>
