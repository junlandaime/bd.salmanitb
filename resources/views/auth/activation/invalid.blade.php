@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">Link Aktivasi Tidak Valid</h4>
                </div>
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="fas fa-exclamation-circle fa-5x text-danger"></i>
                    </div>
                    
                    <h5 class="mb-3">Link Aktivasi Tidak Valid atau Sudah Kadaluarsa</h5>
                    
                    <p>
                        Link aktivasi yang Anda gunakan tidak valid atau sudah kadaluarsa.
                        Silakan minta link aktivasi baru dengan memasukkan email Anda.
                    </p>
                    
                    <div class="mt-4">
                        <a href="{{ route('activation.email.form') }}" class="btn btn-primary">
                            Minta Link Aktivasi Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
