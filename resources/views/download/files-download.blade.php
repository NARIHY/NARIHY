<div class="flex items-center space-x-2">
    {{-- Icons of extension --}}
    @php
        $extension = pathinfo($getRecord()->paths, PATHINFO_EXTENSION);
    @endphp

    @if (in_array($extension, ['pdf']))
        <x-icon name="heroicon-o-document-text" class="text-red-500 w-5 h-5"/>
        <p>{{$extension}}</p>
    @elseif (in_array($extension, ['doc', 'docx']))
        <x-icon name="heroicon-o-document" class="text-green-500 w-5 h-5"/>
        <p>{{$extension}}</p>
    @else
        <x-icon name="heroicon-o-folder" class="text-gray-500 w-5 h-5"/>
        <p>{{$extension}}</p>
    @endif


    <a href="{{route('Donwload.Files.Download', ['id' => $getRecord()->id])}}" class="text-blue-500 hover:underline">
        <x-icon name="heroicon-c-arrow-down-tray" class="text-gray-500 w-5 h-5"/>
    </a>
</div>
