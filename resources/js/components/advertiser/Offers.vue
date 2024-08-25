<template>
    <div class="container text-center">
        <div class="row align-items-start">
            <!-- @foreach ($offers as $offer) -->
            <div class="col-sm-3 m-3">
                <div class="card" style="width: 20rem;">
                    <img src="" class="card-img-top" alt="preview_image">
                    <div class="card-body">
                        <h5 class="card-title">title</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-success">Redirection award: 999 ₽</li>
                        <li class="list-group-item">Topic: name</li>
                        <!-- @switch($offer->status)
                        @case(0) -->
                        <li class="list-group-item text-black">Status: unpublished </li>
                        <!-- @break
                        @case(1) -->
                        <li class="list-group-item text-success">Status: published </li>
                        <!-- @break
                        @case(2) -->
                        <li class="list-group-item text-warning">Status: suspend (replenish the balance)</li>
                        <!-- @break
                        @endswitch -->
                        <li class="list-group-item text-primary">id: 1</li>
                    </ul>
                    <div class="card-body">
                        <a href="" class="btn btn-primary">Explore</a>
                    </div>
                </div>
            </div>
            <!-- @endforeach -->
        </div>
        <!-- {{ $offers -> links() }} -->
    </div>
</template>