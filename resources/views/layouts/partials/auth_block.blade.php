<div class="col-md-3">
    <div class="card custom-card d-md-block d-sm-none d-xs-none">
        <img class="card-img-top" src="{{ Auth::user()->getProfilePicture() }}">
        <div class="card-body">
            <h4><strong>{{ Auth::user()->name }}</strong></h4>
            <div class="d-flex justify-content-center">
                <div class="p-2">
                    23 Entries
                </div>
                <div class="p-2">
                    <a href="{{ route('friends') }}">
                        {{ Auth::user()->friends()->count() }} Friends
                    </a>
                </div>
                <div class="p-2">
                    62 Likes
                </div>
            </div>
        </div>
    </div>
</div>