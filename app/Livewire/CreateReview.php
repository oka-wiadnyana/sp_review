<?php

namespace App\Livewire;

use App\Models\Review;
use App\Models\Service;
use Carbon\Carbon;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\View;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Livewire\Notifications;
use Filament\Notifications\Notification;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\VerticalAlignment;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Livewire\Component;

class CreateReview extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data=[];
    // public $name;
    // public $phone_number;
    // public $service_id;
    public $test;

    public function mount(): void
    {
        $this->form->fill();
        
    }

    public function getOptionService(){
        $services=Service::all()->toArray();
        // $services_array=Arr::keyBy($services, 'service_unit');

        $options=[];

        foreach($services as $service){
                      
            $options[$service['service_unit']][$service['id']]=$service['service_name'];
            
        }

        

        return $options;
        
    }
    
    public function form(Form $form): Form
    {

        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Data diri')
                        ->schema([
                            TextInput::make('name')
                            ->label('Nama')
                            ->required(),
                            TextInput::make('phone_number')
                            ->label('No WA')
                            ->required(),
                            Select::make('service_id')
                            ->label('No WA')
                            ->required()
                           ->afterStateUpdated(function($state){
                            $this->test=$state;
                          
                           })
                            ->options($this->getOptionService()),
                            
                        ]),
                    Wizard\Step::make('Standar Layanan')
                        ->schema([
                            View::make('filament.render_pdf')
                        ]),
                    Wizard\Step::make('Review')
                        ->schema([
                            Select::make('time_suitability')
                            ->label('Kesesuaian Waktu')
                            ->options([
                                '1'=>'Sesuai',
                                '0'=>'TidakSesuai',
                            ])
                            ->required()
                            ->live(),
                            Textarea::make('time_review')
                            ->label('Alasan Ketidaksesuaian Waktu')
                            ->hidden(function(Get $get){
                                return $get('time_suitability')!=='0';
                            })
                            ->requiredIf('time_suitability','0'),
                            Select::make('term_suitability')
                            ->label('Kesesuaian Syarat')
                            ->options([
                                '1'=>'Sesuai',
                                '0'=>'TidakSesuai',
                            ])
                            ->live()
                            ->required(),
                            Textarea::make('term_review')
                            ->label('Alasan Ketidaksesuaian Syarat')
                            ->hidden(function(Get $get){
                                return $get('term_suitability')!=='0';
                            })
                            ->requiredIf('term_suitability','0'),
                            Select::make('cost_suitability')
                            ->label('Kesesuaian Biaya')
                            ->options([
                                '1'=>'Sesuai',
                                '0'=>'TidakSesuai',
                            ])
                            ->live()
                            ->required(),
                            Textarea::make('cost_review')
                            ->label('Alasan Ketidaksesuaian Biaya')
                            ->hidden(function(Get $get){
                                return $get('cost_suitability')!=='0';
                            })
                            ->requiredIf('cost_suitability','0'),
                            Select::make('complaint_suitability')
                            ->label('Kesesuaian Sarana Pengaduan')
                            ->options([
                                '1'=>'Sesuai',
                                '0'=>'TidakSesuai',
                            ])
                            ->live()
                            ->required(),
                            Textarea::make('complaint_review`')
                            ->label('Alasan Ketidaksesuaian Sarana Pengaduan')
                            ->hidden(function(Get $get){
                                return $get('complaint_suitability')!=='0';
                            })
                            ->requiredIf('complaint_suitability','0'),
                            Select::make('service_hours_suitability')
                            ->label('Kesesuaian Sarana Pengaduan')
                            ->options([
                                '1'=>'Sesuai',
                                '0'=>'TidakSesuai',
                            ])
                            ->live()
                            ->required(),
                            Textarea::make('service_hours_review')
                            ->label('Alasan Ketidaksesuaian Sarana Pengaduan')
                            ->hidden(function(Get $get){
                                return $get('service_hours_suitability')!=='0';
                            })
                            ->requiredIf('service_hours_suitability','0'),
                            
                        ]),
                        Wizard\Step::make('Submit')
                        ->schema([
                            View::make('filament.submit-button')
                            
                        ]),
                ])
                // ->submitAction(new HtmlString(Blade::render(<<<BLADE
                //     <x-filament::button
                //         type="submit"
                //         size="sm"
                //     >
                //         Submit
                //     </x-filament::button>
                // BLADE)))
                // ->startOnStep(4)
            ])
            ->statePath('data');
    }
    
    public function create()
    {
        
        Review::create(array_merge($this->form->getState(), ['review_date'=>Carbon::now()->format('Y-m-d')]));
        $this->form->fill();
        
        Notification::make()
            ->title('Terima kasih atas review anda')
            ->success()
            ->send();
        return $this->redirect('/', navigate: true);
    }

  
    public function render()
    {
        

       
        return view('livewire.create-review');
    }

  
}
