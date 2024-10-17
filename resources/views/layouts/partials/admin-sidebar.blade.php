<!-- resources/views/layouts/partials/admin-sidebar.blade.php -->
<div class="list-group">
    <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action">Dashboard</a>
    <a href="{{ route('admin.services.index') }}" class="list-group-item list-group-item-action">Services</a>
    <a href="{{ route('admin.appointments.index') }}" class="list-group-item list-group-item-action">Appointments</a>
    <a href="{{ route('admin.programs.index') }}" class="list-group-item list-group-item-action">Programs</a>
</div>
