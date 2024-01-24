<?php

namespace Tests\Unit;

use Illuminate\Routing\UrlGenerator;
use Livewire\Component;
use Livewire\Livewire;
use Tests\TestCase;

class ShowBugTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_a_null_enum_value_can_be_past(): void
    {
        Livewire::test(ComponentWithEnumMountInjections::class, [
            'foo',
            'enum' => null,
        ])->assertSeeText('http://localhost/some-url:foo');
    }
}

enum EnumToBeBound: string
{
    case FIRST = 'enum-first';
}

class ComponentWithEnumMountInjections extends Component
{
    public $name;

    public function mount(UrlGenerator $generator, ?EnumToBeBound $enum, $param = 'param-default')
    {
        $this->name = collect([$generator->to('/some-url'), $enum?->value, $param])->filter(fn($value) => !is_null($value))->join(':');
    }

    public function render()
    {
        return app('view')->make('show-name-with-this');
    }
}
