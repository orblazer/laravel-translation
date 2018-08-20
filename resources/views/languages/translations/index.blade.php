@extends('translation::layout')

@section('body')

    <form action="{{ route('languages.translations.index', ['language' => $language]) }}" method="get">

        <div class="panel">

            <div class="panel-header">

                {{ __('translation::translation.translations') }}

                <div class="flex flex-grow justify-end">

                    @include('translation::forms.search', ['name' => 'filter', 'value' => Request::get('filter')])

                    @include('translation::forms.select', ['name' => 'language', 'items' => $languages, 'submit' => true, 'selected' => $language])

                    @include('translation::forms.select', ['name' => 'group', 'items' => $groups, 'submit' => true, 'selected' => Request::get('group'), 'optional' => true])

                </div>

            </div>

            <div class="panel-body">

                @if(count($translations))

                    <table>

                        <thead>
                            <tr>
                                <th class="w-1/10 uppercase font-thin">{{ __('translation::translation.group_single') }}</th>
                                <th class="w-1/10 uppercase font-thin">{{ __('translation::translation.key') }}</th>
                                <th class="w-2/5 uppercase font-thin">{{ config('app.locale') }}</th>
                                <th class="w-2/5 uppercase font-thin">{{ $language }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($translations as $type => $items)

                                @if($type === 'group')
                                    @foreach($items as $group => $translations)
                                        @foreach($translations as $key => $value)
                                            @if(!is_array($value[config('app.locale')]))
                                                <tr>
                                                    <td>{{ $group }}</td>
                                                    <td>{{ $key }}</td>
                                                    <td>{{ $value[config('app.locale')] }}</td>
                                                    <td>
                                                        <translation-input 
                                                            initial-translation="{{ $value[$language] }}" 
                                                            language="{{ $language }}" 
                                                            group="{{ $group }}" 
                                                            translation-key="{{ $key }}" 
                                                            route="{{ config('translation.ui_url') }}">
                                                        </translation-input>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                @else
                                    @foreach($items as $key => $value)
                                        <tr>
                                            <td>{{ __('translation::translation.single') }}</td>
                                            <td>{{ $key }}</td>
                                            <td>{{ $value[config('app.locale')] }}</td>
                                            <td>
                                                <translation-input 
                                                    initial-translation="{{ $value[$language] }}" 
                                                    language="{{ $language }}" 
                                                    translation-key="{{ $key }}"
                                                    route="{{ config('translation.ui_url') }}">
                                                </translation-input>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                
                            @endforeach
                        </tbody>

                    </table>

                @endif

            </div>

        </div>

    </form>

@endsection