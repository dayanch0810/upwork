<div id="myReviewsSection" style="display: none;">
    @foreach($obj->myReviews as $review)
        <div class="p-3 border rounded mb-2">
            <div class="fs-5 fw-bold text-success"><a href="{{ route('auth.clients.show', $review->client_id) }}" class="text-decoration-none text-success">{{ $review->client?->first_name }} {{ $review->client->last_name }}</a></div>
            <div class="row g-2">
                <div class="col-auto">
                    @foreach(range(1, 5) as $i)
                        @if(($review->rating) >= $i)
                            <i class="bi-star-fill text-warning"></i>
                        @else
                            <i class="bi-star text-warning"></i>
                        @endif
                    @endforeach
                </div>
                <div class="text-secondary">{{ $review->comment }}</div>
            </div>
        </div>
    @endforeach
</div>

<div id="clientReviewsSection" style="display: none;">
    @foreach($obj->clientReviews as $review)
        <div class="p-3 border rounded mb-2">
            <div class="fs-5 fw-bold text-success"><a href="{{ route('auth.clients.show', $review->client_id) }}" class="text-decoration-none text-success">{{ $review->client?->first_name }} {{ $review->client->last_name }}</a></div>
            <div class="row g-2">
                <div class="col-auto">
                    @foreach(range(1, 5) as $i)
                        @if(($review->rating) >= $i)
                            <i class="bi-star-fill text-warning"></i>
                        @else
                            <i class="bi-star text-warning"></i>
                        @endif
                    @endforeach
                </div>
                <div class="text-secondary">{{ $review->comment }}</div>
            </div>
        </div>
    @endforeach
</div>
