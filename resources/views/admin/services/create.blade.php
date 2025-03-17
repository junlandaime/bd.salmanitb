@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Create New Service</h1>
                <a href="{{ route('admin.services.index') }}" class="text-gray-600 hover:text-gray-900">
                    Back to Services
                </a>
            </div>

            <div class="bg-white shadow-md rounded-lg p-6">
                <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                    @include('admin.services.form')

                    <div class="mt-6">
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                            Create Service
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
