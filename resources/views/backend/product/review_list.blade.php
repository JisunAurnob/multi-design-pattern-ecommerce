@extends('backend.layout.app')
@section('title')
Product List
@endsection
@section('main')
<div class="container flex flex-col px-8">
    <!-- Primary -->
    <div class="flex items-center justify-between px-9">
        
        <div>
            <form action="{{route('admin.product.list')}}" method="get" class="w-full">
                <div class="flex items-center justify-center mb-10">
                    <div class="space-x-6 w-1/8">
                        <label for="email" class="ml-5 text-sm font-medium leading-5 text-gray-700 "></label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input id="email" name="search" type="text" placeholder="Search" class="w-full py-2 form-input" value="{{ request()->query('search') }}">
                        </div>
                    </div>
                    <div class="mt-1.5">
                        <button type="submit" class="px-4 py-2 mt-5 ml-5 space-x-6 text-white bg-indigo-600 rounded-md focus:outline-none">
                            submit
                        </button>
                        @if (request()->query('search'))
                        <a href="{{route('admin.product.list')}}" class="focus:outline-none space-x-6 bg-indigo-600 text-white rounded-md px-4 py-2.5 ml-5 mt-5">
                            Reset
                        </a>
                        @endif

                    </div>
                </div>
            </form>
        </div>
    </div>



    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
        @if (request()->query('search'))
        <div class="flex mb-10 items-left">
            <p>You searched for: {{ request()->query('search') }}</p>
        </div>
        @endif
        <div class="border-b border-gray-200 shadow sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Serial
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Product Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Review
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Rate
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Customer name
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Creation Date
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Approval Status
                        </th>



                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($list as $key=>$data)
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
                                    {{$data->product->name}}
                                </div>
                            </div>
                        </td>
                        <td class="text-sm text-gray-900">
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{$data->comment}}
                                </div>
                            </div>
                        </td>

                        <td class="text-sm text-gray-900">
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{$data->rating}}
                                </div>
                            </div>
                        </td>
                        <td class="text-sm text-gray-900">
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{$data->customer->name}}
                                </div>
                            </div>
                        </td>

                        <td class="text-sm text-gray-900">
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $data->created_at->format('d F Y H:i:s') }}

                                </div>
                            </div>
                        </td>

                        <td class="text-sm text-gray-900">
                            <div class="ml-4">
                                <div class="mt-2">
                                    <select class="form-select" id="approval_status" name="approval_status">
                                        <option data-id="{{$data->id}}" value="inactive" {{$data->approval_status == 'inactive' ? 'selected' : ''}}>Inactive</option>
                                        <option data-id="{{$data->id}}" value="active" {{$data->approval_status == 'active' ? 'selected' : ''}}>Active</option>
                                    </select>
                                </div>
                            </div>
                        </td>

                    </tr>
                    @endforeach
                    <!-- More people... -->
                </tbody>
            </table>
            {{$list->links()}}
        </div>
    </div>
</div>

@push('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    $(document).ready(function(){
        $('.form-select').change(function(){
            var id = $(this).find(':selected').data('id');
            var status = $(this).val();

            $.ajax({
                url: "/admin/product/review/update/" + id,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    approval_status: status
                },
                success: function(response){
                    // Show SweetAlert notification
                    Swal.fire({
                        icon: 'success',
                        title: 'Status Updated',
                        text: 'The status has been successfully updated.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function(xhr, status, error){
                    console.error(error);
                }
            });
        });
    });
</script>



@endpush

@endsection