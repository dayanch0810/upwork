@push('scripts')
    <script>
        const tabWorks = document.getElementById('tabWorks');
        const tabProfiles = document.getElementById('tabProfiles');
        const tabProposalsAll = document.getElementById('tabProposalsAll');
        const tabMyReviews = document.getElementById('tabMyReviews');
        const tabClientReviews = document.getElementById('tabClientReviews');

        const proposalsDropdown = document.getElementById('proposalsDropdown');
        const reviewsDropdown = document.getElementById('reviewsDropdown');

        const worksSection = document.getElementById('worksSection');
        const profilesSection = document.getElementById('profilesSection');
        const proposalsSectionAll = document.getElementById('proposalsSectionAll');
        const myReviewsSection = document.getElementById('myReviewsSection');
        const clientReviewsSection = document.getElementById('clientReviewsSection');

        // For Profile->Proposals
        const allProposalSections = [];
        @foreach($obj->profiles as $profile)
        const tabProposalsProfile{{ $profile->id }} = document.getElementById('tabProposalsProfile{{ $profile->id }}');
        const proposalsSectionProfile{{ $profile->id }} = document.getElementById('proposalsSectionProfile{{ $profile->id }}');
        allProposalSections.push(proposalsSectionProfile{{ $profile->id }});
        @endforeach

        function hideAllSections() {
            worksSection.style.display = 'none';
            profilesSection.style.display = 'none';
            proposalsSectionAll.style.display = 'none';
            allProposalSections.forEach(section => {
                if (section) section.style.display = 'none';
            });
            myReviewsSection.style.display = 'none';
            clientReviewsSection.style.display = 'none';
        }

        function removeAllBorders() {
            tabWorks.classList.remove('border-bottom', 'border-success', 'border-4');
            tabProfiles.classList.remove('border-bottom', 'border-success', 'border-4');
            proposalsDropdown.classList.remove('border-bottom', 'border-success', 'border-4');
            reviewsDropdown.classList.remove('border-bottom', 'border-success', 'border-4');
        }

        tabWorks.addEventListener('click', () => {
            hideAllSections();
            worksSection.style.display = 'block';
            removeAllBorders();
            tabWorks.classList.add('border-bottom', 'border-success', 'border-4');
            proposalsDropdown.innerText = 'Proposals';
            reviewsDropdown.innerText = 'Reviews';
        });

        tabProfiles.addEventListener('click', () => {
            hideAllSections();
            profilesSection.style.display = 'block';
            removeAllBorders();
            tabProfiles.classList.add('border-bottom', 'border-success', 'border-4');
            proposalsDropdown.innerText = 'Proposals';
            reviewsDropdown.innerText = 'Reviews';
        });

        @if($obj->profiles && count($obj->profiles) > 0)
        tabProposalsAll.addEventListener('click', () => {
            hideAllSections();
            proposalsSectionAll.style.display = 'block';
            removeAllBorders();
            proposalsDropdown.classList.add('border-bottom', 'border-success', 'border-4');
            proposalsDropdown.innerText = 'All Proposals ({{ $obj->proposals_count }})';
            reviewsDropdown.innerText = 'Reviews';
        });
        @endif

        @foreach($obj->profiles as $profile)
        if (tabProposalsProfile{{ $profile->id }}) {
            tabProposalsProfile{{ $profile->id }}.addEventListener('click', () => {
                hideAllSections();
                proposalsSectionProfile{{ $profile->id }}.style.display = 'block';
                removeAllBorders();
                proposalsDropdown.classList.add('border-bottom', 'border-success', 'border-4');
                proposalsDropdown.innerText = 'Profile {{ $profile->id }} ({{ $profile->proposals_count }})';
                reviewsDropdown.innerText = 'Reviews';
            });
        }
        @endforeach

        tabMyReviews.addEventListener('click', () => {
            hideAllSections();
            myReviewsSection.style.display = 'block';
            removeAllBorders();
            reviewsDropdown.classList.add('border-bottom', 'border-success', 'border-4');
            reviewsDropdown.innerText = 'My Reviews ({{ $obj->my_reviews_count }})';
            proposalsDropdown.innerText = 'Proposals';
        });

        tabClientReviews.addEventListener('click', () => {
            hideAllSections();
            clientReviewsSection.style.display = 'block';
            removeAllBorders();
            reviewsDropdown.classList.add('border-bottom', 'border-success', 'border-4');
            reviewsDropdown.innerText = 'Client Reviews ({{ $obj->client_reviews_count }})';
            proposalsDropdown.innerText = 'Proposals';
        });
    </script>
@endpush
