<div>
    <h1 class="text-xl font-bold mb-4">{{ $mode === 'create' ? 'Create New Program' : 'Edit Program' }}</h1>

    @if (session()->has('message'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="saveProgram" enctype="multipart/form-data">
        <!-- Title Input -->
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Program Title</label>
            <input type="text" id="title" wire:model="title" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Description Input -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Program Description</label>
            <textarea id="description" wire:model="description" rows="3" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Image Upload -->
        <div class="mb-4">
            <label for="photo" class="block text-sm font-medium text-gray-700">Program Image</label>
            @if ($mode === 'edit' && $program->program_image)
                <img src="{{ asset('guest/images/uploads/' . $program->program_image) }}" alt="Program Image" class="rounded mt-2 h-16">
            @endif
            <input type="file" id="post_image" wire:model="photo" class="mt-1 block w-full">
            @error('photo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Image Crop Modal -->
        @include('livewire.website-admin.crop-image-modal.image_croper')

        <!-- Submit Button -->
        <div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">{{ $mode === 'create' ? 'Create Program' : 'Update Program' }}</button>
        </div>
    </form>
</div>
