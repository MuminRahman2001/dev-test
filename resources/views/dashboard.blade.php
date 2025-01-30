@extends('layouts.app')

@section('title', 'Home')

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
    </style>
@endpush

@section('content')
    <h3 class="typewriter mb-4">
        <span id="typewriterText">What pet are you looking for?</span>
    </h3>

    <form id="searchForm" class="d-flex justify-content-center w-100" style="max-width: 800px;">
        <div class="position-relative w-100">
            <input id="searchInput" class="form-control me-2 rounded-5 form-control-lg" type="search" placeholder="Search" aria-label="Search">
            <i class="ph ph-magnifying-glass position-absolute searchInput-icon"></i>
        </div>
    </form>

    <table id="breedTable">
        <thead>
            <tr>
                <th>Breed</th>
                <th>origin</th>
                <th>life_span</th>
                <th>weight</th>
                <th>select</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            let form = document.getElementById('searchForm');
            let searchInput = document.getElementById('searchInput');

            searchInput.focus();

            // get all breeds
            $.ajax({
                url: "{{ route('get.breeds')  }}",
                method: 'GET',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    if(response.data) {
                        populateBreedsTable(response.data);
                    }
                },
                error: function (error) {
                    console.log(error.responseText)
                }
            });

            $.ajax({
                url: "{{ route('get.breeds')  }}",
                method: 'GET',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    if(response.data) {
                        populateBreedsTable(response.data);
                    }
                },
                error: function (error) {
                    console.log(error.responseText)
                }
            });

            form.addEventListener('submit', function (event) {
                event.preventDefault();

                $.ajax({
                    url: "{{ route('search.breed') }}",  // Correct route for the search-breed method
                    method: 'GET',
                    data: {
                        _token: "{{ csrf_token() }}",
                        breed: searchInput.value
                    },
                    success: function (response) {
                        if(response.data) {
                            populateBreedsTable(response.data);
                        }
                    },
                    error: function (error) {
                        console.log(error.responseText);
                    }
                });
            });

            function populateBreedsTable(data) {
                // Assuming you have a table with id `breed-table`
                var tableBody = $('#breedTable tbody'); // Use jQuery to find the table body

                // Clear existing table rows
                tableBody.empty();

                // Loop through the data and populate the table rows
                data.forEach(function(breed) {
                    // Create a new row for each breed
                    var row = '<tr>';
                    row += '<td>' + breed.name + '</td>';
                    row += '<td>' + breed.origin + '</td>';
                    row += '<td>' + breed.life_span + ' years</td>';
                    row += '<td>' + breed.weight.metric + ' KG</td>';
                    row += '<td><button class="select-btn" data-breed-id="' + breed.id + '">Select</button></td>';
                    row += '</tr>';

                    // Append the row to the table body
                    tableBody.append(row);
                });
            }

            $(document).on('click', '.select-btn', function() {
                let breedId = $(this).data('breed-id');

                window.location.href = '/breed-details/' + breedId;
            });

            const titles = [
                "Searching for a Cat Breed?",
                "Find Your Perfect Feline Companion",
                "Explore Cat Breeds by Trait",
                "Which Breed is Right for Your Family?",
                "Find Cat Breeds with Unique Traits",
            ];

            const randomTitle = titles[Math.floor(Math.random() * titles.length)];
            document.getElementById('typewriterText').textContent = randomTitle;
        });
    </script>
@endpush
