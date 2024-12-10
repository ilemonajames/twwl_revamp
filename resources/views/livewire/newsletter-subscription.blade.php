<div>
    <p>Subscribe to our newsletter.</p>
    <x-feedback-alert />
    <div class="mailchimp-widget-wrap">
        <form wire:submit.prevent="subscribe">
            <div class="input-group add-on" >
                <input type="text" wire:model="email" class="form-control" name="email" id="email" placeholder="Email Address">

                <div class="input-group-btn" wire:ignore>
                    <button class="btn btn-success subscribe-btn" style="padding: 12px" type="submit">Sign  Up</button>
                </div>
            </div>
            @error('email') <p class="text-danger">{{$message}}</p>@enderror

        </form>
    </div>
</div>
