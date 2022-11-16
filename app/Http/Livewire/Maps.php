<?php

namespace App\Http\Livewire;

use App\Models\Coordinate;
use Livewire\Component;

class Maps extends Component
{
    public $markers;
    public $count;

    public $firstLat;
    public $firstLng;

    protected $listeners = ['checkCount'];
    public function mount()
    {
        $this->collectData();
    }

    public function render()
    {
        return view('livewire.maps');
    }

    public function checkCount(int $count)
    {
        if ($this->count != $count) {
            $this->collectData();
            $this->dispatchBrowserEvent('updateMarkers');
        }
    }

    private function collectData(): void
    {
        $markers = Coordinate::getLastCoordinates()->get();
        $this->firstLat = $markers->last()->latitude ?? 49.24;
        $this->firstLng = $markers->last()->longitude ?? 32.52;
        $this->count = $markers->count();
        $this->markers = json_encode($markers->map(function($marker) {
            return ['lat' => $marker->latitude, 'lng' => $marker->longitude];
        }));
    }
}
