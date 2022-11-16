<?php

namespace App\Http\Livewire;

use App\Events\UpdateCoordinatesEvent;
use App\Models\Coordinate;
use Livewire\Component;

class CoordinatesForm extends Component
{
    public $latitude;
    public $longitude;

    protected $listeners = ['setLat', 'setLng'];

    protected $rules = [
        'latitude' => 'required|numeric|min:-90|max:90',
        'longitude' => 'required|numeric|min:-180|max:180',
    ];

    public function submit()
    {
        $this->validate();

        Coordinate::create([
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ]);
        session()->flash('message', 'Created!');
        $this->reset(['longitude', 'latitude']);
        event(new UpdateCoordinatesEvent());
    }

    public function setLat(float $lat)
    {
        $this->latitude = $lat;
    }

    public function setLng(float $lng)
    {
        $this->longitude = $lng;
    }
}
