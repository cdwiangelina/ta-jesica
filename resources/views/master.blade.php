@include('layouts.header')
@include('layouts.sidebar')

@if ($title == "Dashboard")
    @include('main.dashboard')
@elseif ($title == "Dataset")
    @include('main.dataset')
@elseif ($title == "Naive Bayes")
    @include('main.naivebayes')
@elseif ($title == "Naive  Bayes")
    @include('main.naivebayes')

@endif    
@include('layouts.footer')  