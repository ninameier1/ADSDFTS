<?php
namespace App\View\Components;

use Illuminate\View\Component;

class FestivalCard extends Component
{
    public string $name;
    public string $image;
    public ?string $date; // Nullable
    public ?string $location; // Nullable
    public string $detailsRoute;

    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param string $image
     * @param string $detailsRoute
     * @param string|null $date
     * @param string|null $location
     */
    public function __construct(
        string $name,
        string $image,
        string $detailsRoute,
        ?string $date = null,
        ?string $location = null
    )
    {
        $this->name = $name;
        $this->image = $image;
        $this->date = $date;
        $this->location = $location;
        $this->detailsRoute = $detailsRoute;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.festival-card');
    }
}
