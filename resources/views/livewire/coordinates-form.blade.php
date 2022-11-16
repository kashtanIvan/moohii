<div>
    <form wire:submit.prevent="submit">
        <div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>
            <label> LAT
                <input style="border: 1px solid" id="lat" type="text" wire:model="latitude">
            </label>
            @error('latitude') <span class="error">{{ $message }}</span> @enderror
            <label>LNG
                <input style="border: 1px solid"  id="lng" type="text" wire:model="longitude">
            </label>
            @error('longitude') <span class="error">{{ $message }}</span> @enderror
        <button type="submit">Save Contact</button>
    </form>
</div>
