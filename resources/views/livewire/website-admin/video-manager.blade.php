<div>
    <form wire:submit.prevent="saveVideo">
        <!-- Video Link Input -->
        <div>
            <label for="videoLink">Video Link:</label>
            <input type="url" id="videoLink" wire:model="videoLink" placeholder="Enter video URL">
            @error('videoLink') <span class="error">{{ $message }}</span> @enderror
        </div>

        <!-- Description Input -->
        <div>
            <label for="description">Description:</label>
            <textarea id="description" wire:model="description" placeholder="Enter video description"></textarea>
            @error('description') <span class="error">{{ $message }}</span> @enderror
        </div>

        <!-- Thumbnail Upload -->
        <div>
            <label for="thumbnail">Thumbnail:</label>
            <input type="file" id="thumbnail" wire:model="thumbnail">
            @error('thumbnail') <span class="error">{{ $message }}</span> @enderror

            <!-- Preview Thumbnail -->
            @if ($thumbnail)
                <div style="margin-top: 10px;">
                    <p>Thumbnail Preview:</p>
                    <img src="{{ $thumbnail->temporaryUrl() }}" alt="Thumbnail Preview" style="max-width: 200px;">
                </div>
            @endif
        </div>

        <!-- Submit Button -->
        <button type="submit">Save Video</button>
    </form>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div style="color: green; margin-top: 10px;">{{ session('message') }}</div>
    @endif

    <!-- Display Video Details -->
    @if ($videoLink && $description)
        <div style="margin-top: 20px;">
            <p><strong>Video Link:</strong> <a href="{{ $videoLink }}" target="_blank">{{ $videoLink }}</a></p>
            <p><strong>Description:</strong> {{ $description }}</p>
            
            @if ($thumbnail)
                <p><strong>Thumbnail:</strong></p>
                <img src="{{ asset('storage/' . $thumbnail) }}" alt="Uploaded Thumbnail" style="max-width: 200px;">
            @endif
        </div>
    @endif
</div>
