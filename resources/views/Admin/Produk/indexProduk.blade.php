@extends('layouts.base')

@section('title', 'Dashboard Produk')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/prismjs/themes/prism.min.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard Produk</h1>
        </div>

        <div>
            <div class="card">
                <div class="card-header">
                    <h4>Data Produk</h4>
                    <div class="card-header-action">
                        <a href="{{ route('dataProduk.form') }}" class="btn btn-primary">Add Data</a>
                    </div>

                    <!-- Search -->
                    <div class="card-tools pl-3">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <form action="{{ route('dataProduk.search') }}" method="get">
                                <div class="input-group-append">
                                    <input type="search" name="search" class="form-control float-right" placeholder="Search">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <!-- Alert Create -->
                        @if(Session::get('Create'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('Create')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <!-- End Alert Create -->
                        <!-- Alert Delete -->
                        @if(Session::get('Delete'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('Delete')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <!-- End Alert Delete -->
                        <table class="table-striped mb-0 table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Produk</th>
                                    <th>Kategori Produk</th>
                                    <th width="5%">Image</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Tanggal Input</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produk as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->category }}</td>
                                    <td> <img src="{{ asset('storage/products/'.$row->image) }}" alt="" class="img-fluid"></td>
                                    <td>{{ $row->price }}</td>
                                    <td>{{ $row->stock }}</td>
                                    <td>{{ $row->created_at }}</td>
                                    <td>
                                        <a href="{{ route('dataProduk.form.edit', $row->id) }}" class="btn btn-primary btn-action mr-1" title="Edit data">
                                            <i class="fas fa-pencil"></i>
                                        </a>

                                        <!-- Delete -->
                                        <form action="{{ route('dataProduk.delete') }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $row->id }}">
                                            <button type="submit" href="#" class="btn btn-danger btn-action" title="Delete data">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        <!-- End Delete -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->

</div>

@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
<script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
<script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
<script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/index-0.js') }}"></script>

<!-- JS Libraies -->
<script src="{{ asset('library/prismjs/prism.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/bootstrap-modal.js') }}"></script>
@endpush

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/prismjs/prism.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/bootstrap-modal.js') }}"></script>
@endpush