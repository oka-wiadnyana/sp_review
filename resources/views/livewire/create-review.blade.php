<div class=" h-screen flex justify-center items-center">
    <div >
        <div class="flex flex-col text-center justify-center mb-3">

            <img src="{{ asset('img/logo negara.png') }}" alt="" class="object-scale-down h-24 w-54 me-2 ">
            <span class="text-4xl hidden md:block font-sans font-bold my-auto">RESPATI</span>
            
            <span class="text-2xl hidden md:block font-sans font-bold my-auto">Review Standar Pelayanan berbasis TI</span>
            
        </div>
        <div class="  ">
            <form wire:submit="create" class="w-full">
                {{ $this->form }}
                
              
            </form>
        </div>
    </div>
    
    
    
    <x-filament-actions::modals />
</div>
