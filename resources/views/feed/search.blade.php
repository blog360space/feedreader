@extends('layout.master')

@section('content')
    <div class="col-12">
        <h1 class="clearfix">Feed</h1>
        <div class="row">
            <div class="col-lg-9">
                <form method="get" id="filterForm">
                    <select name="category_id" onchange="javascript:$('#filterForm').submit()">

                        <option value="0"> All </option>

                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}"
                                    @if(request()->get('category_id') == $cat->id) selected="selected" @endif>
                                {{ $cat->name  }}
                            </option>
                        @endforeach

                    </select>
                </form>
            </div>
            <div class="col-lg-3">
                <a class="btn btn-primary btn-sm " href="{{ url('/feed/create') }}">New Item</a>
            </div>
        </div>
        <!-- Display Validation Errors -->
        @include('layout.errors')

        <div class="row">
            @if ($feeds->count())
                @foreach ($feeds as $feed)
                <div class="article-container col-lg-6">
                    <article class="card">
                        <div class="card-body">
                            <h4><a {{$feed->id}} title="{{ $feed->title  }}"
                                    href="{{ $feed->link }}" target="_blank">{{ $feed->title  }}</a></h4>
                            <p>Published on {{ date('Y-m-d H:i:s', $feed->pub_date) }}</p>
                            <div>{!! $feed->description  !!}</div>

                            <form method="post" action="{{ url('feed/destroy') }}" id="form-destroy-{{ $feed->id }}">
                                <input type="hidden" name="id" value="{{ $feed->id }}">
                                {{ csrf_field() }}
                            </form>
                            <p class="text-right"><a href="{{ url('feed/edit/' . $feed->id) }}">Edit</a>
                                <a href="javascript:submitDeleteFeed({{ $feed->id }});" class="text-danger">Delete</a></p>
                        </div>
                    </article>
                </div>
                @endforeach
            @else
                <br/>
                <div class="alert alert-dark">No feed data </div>
            @endif
        </div>
        <div class="paging">{{ $paging_links }}</div>
    </div>
<script type="text/javascript">
    function submitDeleteFeed(id) {
        if (confirm("Are you sure you want to delete?"))  {
            return $('#form-destroy-' + id).submit();
        }
        else {
            return false
        }
    }
</script>
@endsection
