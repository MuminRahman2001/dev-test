@extends('layouts.app')

@section('title', $breedData['name'])

@push('style')
    <style>
        #searchInput {
            padding: 10px 22px;
            border-color: var(--primary-bg-color-dark);
            min-width: 350px;
        }

        .searchInput-icon {
            right: 22px;
            top: 50%;
            transform: translateY(-50%);
        }

        .profile-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-top: 30px;
        }

        .profile-section img {
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .back-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .back-btn:hover {
            background-color: #2980b9;
        }
    </style>
@endpush

@section('content')
    <div class="profile-section">
        <h3 class="typewriter mb-4">
            <span id="typewriterText">{{$breedData['name']}}</span>
        </h3>

        <img src="{{$imageUrl}}" style="width: 150px; height: 150px;" alt="{{ $breedData['name'] }}">

        <p><strong>Origin:</strong> {{$breedData['origin']}}</p>
        <p><strong>Life Span:</strong> {{$breedData['life_span']}} years</p>
        <p><strong>Description:</strong> {{$breedData['description']}}</p>
        <p><strong>Temperament:</strong> {{$breedData['temperament']}}</p>

        <!-- Back Button -->
        <a href="{{ route('home') }}" class="back-btn">Back to Home</a>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // You can add any additional JS here if needed
        });
    </script>
@endpush
