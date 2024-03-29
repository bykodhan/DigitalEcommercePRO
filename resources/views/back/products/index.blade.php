@extends('back.layouts.app')
@push('title', __('All Products'))
@push('css')
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" />
@endpush
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white d-flex justify-content-between">
                {{ __('All Products') }}
                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.products.create') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus-lg" viewBox="0 1 16 16">
                        <path fill-rule="evenodd"
                            d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                    </svg>
                    {{ __('Add New Product') }}
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm align-middle table-bordered" id="myTable">
                        <thead class="table-light sticky-top">
                            <tr>
                                <th scope="col">#ID</th>
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('Category') }}</th>
                                <th scope="col">{{ __('Stocks') }}</th>
                                <th scope="col">{{ __('Price') }}</th>
                                <th scope="col">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                        <path
                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                    </svg>
                                </th>
                                <th scope="col" data-sort="sales_count">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-bag-check-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zm-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z" />
                                    </svg>

                                </th>
                                <th scope="col">{{ __('Updated At') }}</th>
                                <th>

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    <a target="_blank" href="{{route('product',['slug'=>$product->slug])}}">
                                        {{ $product->name }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('category',['slug'=>$product->category->slug])}}"
                                        target="_blank">
                                        {{ $product->category->name }}
                                    </a>
                                </td>
                                <td>{{ $product->stocks->count() }}</td>
                                <td class="price">
                                    {{config('app.currency_symbol')}}{{ money($product->price) }}
                                </td>
                                <td>{{ $product->views_count }}</td>
                                <td>{{ $product->sales_count }}</td>
                                <td>
                                    {{ $product->updated_at->diffForHumans() }}
                                </td>
                                <td>
                                    <div class="d-flex alig-items-center justify-content-center gap-2">
                                        <a href="{{ route('admin.products.edit', ['id' => $product->id]) }}"
                                            class="btn btn-sm btn-outline-primary border-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </a>
                                        <button onclick="destroy({{ $product->id }})"
                                            class="btn btn-sm btn-outline-danger border-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                <path
                                                    d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
<form method="POST" id="deleteForm" action="{{ route('admin.products.delete') }}">
    @csrf
    <input type="hidden" name="id" id="id">
</form>
@endsection
@push('js')
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let table = new DataTable('#myTable', {
            paging: false,
            info: false,
            fixedHeader: true,
            responsive: true,
            order : []
        });
});
</script>
<script>
    function destroy(id) {
            Swal.fire({
                title: "{{ __('Are you sure? This action cannot be undone') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ __('Yes, delete it!') }}",
                cancelButtonText: "{{ __('No, cancel!') }}"

            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('id').value = id;
                    document.getElementById('deleteForm').submit();
                }
            });
        }
</script>
@endpush
