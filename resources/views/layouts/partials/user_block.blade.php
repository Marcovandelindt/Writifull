<div class="col-md-3">
    <div class="card custom-card d-md-block d-sm-none d-xs-none">
        <img class="card-img-top" src="{{ $user->image ? asset('images/profile-pictures/' . $user->image) : '' }}">
        <div class="card-body">
            <h4><strong>{{ $user->name }}</strong></h4>
            <div class="d-flex justify-content-center">
                <div class="p-2">
                    {{ isset($entries[0]) ? count($entries[0]) : 0 }} Entries
                </div>
                <div class="p-2">
                    12 Friends
                </div>
                <div class="p-2">
                    62 Likes
                </div>
            </div>
        </div>
    </div>
</div>