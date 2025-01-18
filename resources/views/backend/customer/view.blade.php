@extends('backend.layout.app')
@section('title')
Customer's Profile
@endsection
@section('main')
<div class="bg-white rounded-lg shadow-md mt-10 mb-10 pb-7 mx-10">

    <div class="flex justify-between items-center px-8 py-5 border-b-2 border-gray-200">
        <div class="flex justify-start items-center">
            <img src="{{$customers->image}}" class="block border-4 border-white h-36 mt-10 object-cover rounded-full w-36" alt="" />
            <div class="pl-5">
                <h3 class="text-3xl font-medium text-gray-700">Profile</h3>
                <p class="text-md text-gray-500"> Customers's Information</p>
            </div>
        </div>

        
    </div>

    <div x-data="{ tab: '#tab1' }" x-init="$refs[tab].focus()" class="pl-8">

        <!-- Links here -->
        <div class="flex flex-row justify-start mx-4 ">
            <div>
                <div class="space-x-10 py-4">
                    <a x-ref="#tab1" class="px-4 py-2 text-xl font-bold  outline-none border-b-2 hover:border-green-400 focus:border-green-500 active:border-indigo-500 visited:border-indigo-500" href="#" x-on:click.prevent="tab = '#tab1'">General Information</a>

                    <a x-ref="#tab2" class="px-4 py-2 text-xl font-bold border-b-2 outline-none hover:border-green-400 focus:border-green-500 active:border-indigo-500 visited:border-indigo-500" href="#" x-on:click.prevent="tab = '#tab2'">Extra Information</a>


                </div>
            </div>
            <!-- <div class="space-x-10 py-4">
                <a class="hover:text-gray-500" href="">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </a>
            </div> -->
        </div>

        <!-- Tab Content here -->
        <div class="flex flex-row justify-start mx-4 space-x-4">
            <div>
                <div x-show="tab == '#tab1'" x-cloak>
                    <div class="py-5 ">

                    

                        <div class="pl-20 space-y-8">
                            <div class="grid grid-cols-2 gap-20">
                                <div>
                                    <p class="font-medium text-lg"> Name</p>
                                    <p class="font-normal text-sm">{{$customers->name}}  </p>
                                </div>
                                <div>
                                    <p class="font-medium text-lg"> Gender</p>
                                    <p class="font-normal text-sm">{{$customers->gender}}  </p>
                                </div>

                            </div>

                            <!-- <div class="grid grid-cols-2 gap-20">
                                <div>
                                    <p class="font-medium text-lg">Business Name</p>
                                    <p class="font-normal text-sm"> {{$customers->business_name}} </p>
                                </div>

                                <div>
                                    <p class="font-medium text-lg">Address</p>
                                    <p class="font-normal text-sm"> {{$customers->address}} </p>
                                </div>

                            </div> -->


                            <div class="grid grid-cols-2 gap-20">

                                <div>
                                    <p class="font-medium text-lg">Phone</p>
                                    <p class="font-normal text-sm">{{$customers->phone}} </p>
                                </div>
                                <div>
                                    <p class="font-medium text-lg">Remarks</p>
                                    <p class="font-normal text-sm"> {{$customers->remarks}} </p>
                                </div>
                               

                            </div>

                            <div class="grid grid-cols-2 gap-20">
                                
                            <div>
                                    <p class="font-medium text-lg">Email</p>
                                    <p class="font-normal text-sm">{{$customers->email}} </p>
                                </div>
                                <!-- <div>
                                    <p class="font-medium text-lg">Date Of Birth</p>
                                    <p class="font-normal text-sm"> {{$customers->date_of_birth}} </p>
                                </div> -->


                            </div>


                            <div class="grid grid-cols-2 gap-20">
                                <div>
                                    <p class="font-medium text-lg">Status</p>
                                    <p class="font-normal text-sm"> {{$customers->status}} </p>
                                </div>


                            </div>
                        </div>
                    
                        


                    </div>
                </div>


            </div>

        </div>

    </div>

   
    

    
</div>
 <!-- Wishlist -->
<div class="bg-white rounded-lg shadow-md mt-10 mb-10 pb-7 mx-10">

   

    <div x-data="{ tab: '#tab1' }" x-init="$refs[tab].focus()" class="pl-8">

        <!-- Links here -->
        <div class="flex flex-row justify-start mx-4 ">
            <div>
                <div class="space-x-10 py-4">
                    <a x-ref="#tab1" class="px-4 py-2 text-xl font-bold  outline-none border-b-2 hover:border-green-400 focus:border-green-500 active:border-indigo-500 visited:border-indigo-500" href="#" x-on:click.prevent="tab = '#tab1'"> Wishlist</a>

                   

                </div>
            </div>
            <!-- <div class="space-x-10 py-4">
                <a class="hover:text-gray-500" href="">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </a>
            </div> -->
        </div>

        <!-- Tab Content here -->
        <div class="flex flex-row justify-start mx-4 space-x-4">
            <div>
                <div x-show="tab == '#tab1'" x-cloak>
                    <div class="py-5 ">
                    <div class="border-b border-gray-200 shadow sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Serial
                        </th>
                        
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Image
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Product Name 
                        </th>
                        
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Action
                        </th>



                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach($wishlist as $key=>$data) 
                    <tr>
                        <td class="text-sm text-gray-900">
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                {{$key+1}}
                                </div>
                            </div>
                        </td>

                        
                       

                        <td class="text-sm text-gray-900">
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">


                                    <img width="150 px" src=" {{$data->product->image}}" class=" object-contain rounded-full h-14 w-14" alt="">
                                </div>
                            </div>
                        </td>
                        <td class="text-sm text-gray-900">
                            <a class="ml-4 underline" href="{{route('products.view',$data->product->slug)}}">
                                <div class="text-sm font-medium text-gray-900">
                                    {{$data->product->name}}
                                </div>
</a>
                        </td>

                        
                        


                        <td class="flex px-8 py-8 space-x-2 text-sm font-medium text-right whitespace-nowrap">
                            <a title="view" href="{{route('admin.product.edit',$data->product->slug)}}" class="text-indigo-600 hover:text-indigo-900">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path fill="none" d="M0 0h24v24H0z" />
                                    <path d="M12 3c5.392 0 9.878 3.88 10.819 9-.94 5.12-5.427 9-10.819 9-5.392 0-9.878-3.88-10.819-9C2.121 6.88 6.608 3 12 3zm0 16a9.005 9.005 0 0 0 8.777-7 9.005 9.005 0 0 0-17.554 0A9.005 9.005 0 0 0 12 19zm0-2.5a4.5 4.5 0 1 1 0-9 4.5 4.5 0 0 1 0 9zm0-2a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
                                </svg>
                            </a>
                          
                        </td>

                    </tr>
                   @endforeach
                    <!-- More people... -->
                </tbody>
            </table>
            
        </div>
                    
                    </div>
                </div>


            </div>

        </div>

    </div>

    <!-- Wishlist -->
    

    
</div>

@endsection