@extends('backend.layout.app')
@section('title')
Slider Edit 
@endsection
@section('main')
<form action="{{route('slider.update',$sliders->id)}}" method="post" class=" px-6 py-6 rounded-md space-y-7" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="bg-white py-12 rounded-lg shadow-md">
        <div class="px-10">
            <label for="title" class="block text-sm leading-5 font-medium text-gray-700">
            Title<span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="title" value="{{$sliders->title}}" name="title" type="text" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" placeholder="Enter type " />
            </div>
            @error('title')
            <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>

        <div class="px-10">
            <label for="subtitle" class="block text-sm leading-5 font-medium text-gray-700">
            Subtitle<span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="subtitle" value="{{$sliders->subtitle}}" name="subtitle" type="text" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" placeholder="Enter type " />
            </div>
            @error('subtitle')
            <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>
        

        <div class="px-10">
            <label for="image" class="block text-sm leading-5 font-medium text-gray-700">
                Image <span class="text-red-600"> * </span> <a class="text-blue-600 underline" href="https://squoosh.app/" target="_blank">Resize here</a> <br>
                <span class="text-black"> The size of height and width should be the same for 1:1 ratio </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="image" value="{{$sliders->image}}" name="image" type="file" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" placeholder="Enter category image" />
            </div>
            @error('image')
            <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="px-10">
            <label for="name" class="block text-sm leading-5 font-medium text-gray-700">
                Button Text 
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="button_text" value="{{$sliders->button_text}}"  name="button_text" type="text"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none"
                    placeholder="Enter Button text" />
            </div>
            @error('button_text')<p class="text-red-600 mt-5">{{$message}}</p>@enderror
        </div>

        <div class="px-10">
            <label for="name" class="block text-sm leading-5 font-medium text-gray-700">
                Button URL 
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="button_url" value="{{$sliders->button_url}}" name="button_url" type="text"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none"
                    placeholder="Enter Button URL" />
            </div>
            @error('button_url')<p class="text-red-600 mt-5">{{$message}}</p>@enderror
        </div>

        <div class="px-10">
            <label for="name" class="block text-sm leading-5 font-medium text-gray-700">
                Button 
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <select required name="is_has_button" class="form-select appearance-none
                            block
                            w-full
                            px-3
                            py-1.5
                            text-base
                            font-normal
                            text-gray-700
                            bg-white bg-clip-padding bg-no-repeat
                            border border-solid border-gray-300
                            rounded
                            transition
                            ease-in-out
                            m-0
                            focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    aria-label="Default select example">
                   
                    <option @if($sliders->is_has_button =='0') selected @endif value="0"> False </option>
                    <option @if($sliders->is_has_button =='1') selected @endif value="1"> True </option>
                   
                  

                </select>
            </div>

        </div>
        
        <div class="mt-8 pt-5">
            <div class="flex justify-end">
                <span class="inline-flex rounded-md shadow-sm">
                    <a href="{{route('slider.list')}}" class="py-2 px-4 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                        Cancel
                    </a>
                </span>
                <span class="ml-3 inline-flex rounded-md shadow-sm">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                        Save
                    </button>
                </span>
            </div>
        </div>
</form>


@endsection