@extends('layouts.homepage')
@section('home')
<div class="container mt-3">
    <div class="row justify-content-center align-items-center">
        <div class="row mt-4 mb-5">
            <h4 class="text-secondary mb-3" style="font-weight: 400;"><i class="bi bi-bookmark-check-fill"></i> Produk Kami</h4>
            <div class="col-lg-3 mb-3">
                <div class="card mb-3">
                    <div class="card-body mx-3">
                        <p>Kategori Produk</p>
                        <div>
                            <div class="form-check">
                                <input type="checkbox" id="allCategoriesCheckbox" class="category-checkbox form-check-input" data-category="all" checked>
                                <label for="allCategoriesCheckbox" class="text-dark form-check-label">Semua Produk</label>
                            </div>
                            @foreach ($kategori as $category)
                                <div class="form-check">
                                    <input type="checkbox" id="categoryCheckbox_{{ $category->id }}" class="category-checkbox form-check-input" data-category="{{ $category->kategori_produk }}">
                                    <label for="categoryCheckbox_{{ $category->id }}" class="text-dark form-check-label">{{ $category->kategori_produk }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body mx-3">
                        <div class="form-group mt-3">
                            <label for="priceRange" class="form-label">Harga:</label>
                            <input type="range" class="form-range" id="priceRange" name="priceRange" min="0" max="{{ $maxprice }}" step="50" value="{{ $minPrice ?? 0 }}"/>
                        </div>

                        <div class="form-group mt-3">
                            <label for="minPrice" class="form-label">Harga Min:</label>
                            <input type="text" class="form-control" name="minPrice" id="minPrice" readonly value="{{ $minPrice ?? 0 }}">
                        </div>

                        <div class="form-group mt-3">
                            <label for="maxPrice" class="form-label">Harga Max:</label>
                            <input type="text" class="form-control" name="maxPrice" id="maxPrice" readonly value="{{ $maxprice }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="mb-4">
                    <form onsubmit="return false;" class="form-inline custom-search">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="px-4 py-3 form-control rounded-pill" name="search" id="liveSearchInput"
                                   placeholder="Search.." value="{{ request('search') }}">
                            <div class="input-group-text px-4" style="border-radius: 50%; z-index: 100;">
                                <i class="bi bi-search"></i>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="row" id="liveSearchResults">
                    {{-- Include the live search results partial view --}}
                    @include('data.produk')
                </div>


                <div class="d-flex justify-content-start" id="pagination-container" data-current-page="{{ $produk->currentPage() }}">
                    @if ($produk instanceof \Illuminate\Pagination\LengthAwarePaginator && $produk->lastPage() > 1)
                        {{ $produk->links('pagination::bootstrap-4') }}
                    @else
                        <!-- Hide pagination if not needed -->
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        var timeoutId;

        // Event handlers for search and pagination
        $('.category-checkbox, #liveSearchInput, #priceRange, #minPrice, #maxPrice').on('input', function () {
            triggerSearch();
        });

        // Event handler for pagination links
        $('#pagination-container').on('click', '.pagination a', function (e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            loadPaginatedData(page);
        });

        // Function to handle AJAX request for search and pagination
        function searchWithFilterHarga(searchTerm, selectedCategories, minPrice, maxPrice, page = 1) {
            $.ajax({
                url: '/search',
                method: 'GET',
                data: {
                    search: searchTerm,
                    categories: selectedCategories,
                    minPrice: minPrice,
                    maxPrice: maxPrice,
                    page: page
                },
                success: function (response) {
                    $('#liveSearchResults').html(response);

                    // Update the current page in pagination container
                    $('#pagination-container').data('current-page', page);

                    // Hide pagination if there are no results
                    if (response.trim() === "") {
                        $('#pagination-container').hide();
                    } else {
                        $('#pagination-container').show();
                    }
                },
                error: function (error) {
                    console.error('Error fetching search results:', error);
                }
            });
        }

        // Helper function to get selected categories
        function getSelectedCategories() {
            var selectedCategories = [];
            $('.category-checkbox:checked').each(function () {
                var category = $(this).data('category');
                selectedCategories.push(category);
            });

            return selectedCategories;
        }

        // Function to handle pagination without search
        function loadPaginatedData(page) {
            var searchTerm = $('#liveSearchInput').val().trim();
            var selectedCategories = getSelectedCategories();
            var minPrice = $('#minPrice').val();
            var maxPrice = $('#maxPrice').val();

            searchWithFilterHarga(searchTerm, selectedCategories, minPrice, maxPrice, page);
        }

        // Function to trigger search after user stops typing
        function triggerSearch() {
            var searchTerm = $('#liveSearchInput').val().trim();
            var selectedCategories = getSelectedCategories();
            var minPrice = $('#minPrice').val();
            var maxPrice = $('#maxPrice').val();

            // Clear the timeout if the user continues typing
            clearTimeout(timeoutId);

            // Set a timeout to wait for the user to stop typing
            timeoutId = setTimeout(function () {
                // Execute AJAX request for search
                searchWithFilterHarga(searchTerm, selectedCategories, minPrice, maxPrice);
            }, 300); // Adjust the timeout duration as needed
        }

        // Update input values when slider values change
        $('#priceRange').on('input', function () {
            var currentValue = $(this).val();
            $('#minPrice').val(currentValue);
        });

        // Initialize pagination container state on document load
        $('#pagination-container').data('current-page', {{ $produk->currentPage() }});
    });
</script>


@endsection
