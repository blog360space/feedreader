@extends('layout.master')

@section('content')
    <div class="col-12">
        <h1 class="clearfix">Edit Feed</h1>

    <!-- Display Validation Errors -->
    @include('layout.errors')

    <!-- New Task Form -->
        <form action="{{ url('/feed/update') }}" method="POST">
            <input type="hidden" name="id" value="{{ $feed->id }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="feed-title" class="col-sm-3 control-label">Title</label>
                <div class="col-sm-12">
                    <input type="text" name="title" id="feed-title" class="form-control"
                           value="@if (isset($feed->title)) {{$feed->title}} @else {{old('title')}} @endif">
                </div>
            </div>

            <div class="form-group clearfix">
                <label for="feed-description" class="col-sm-3 control-label">Description</label>
                <div class="col-sm-12">
                            <textarea name="description" id="feed-description"
                                      rows="10"
                                      class="form-control">@if (isset($feed->description)) {{$feed->description}} @else {{old('description')}} @endif</textarea>
                </div>
            </div>
            <div class="form-group clearfix">
                <label for="feed-category_id" class="col-sm-3 control-label">Category</label>
                <div class="col-sm-12">
                    <select name="category_id">
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}"
                                    @if ($feed->category_id == $cat->id) selected="selected" @endif>
                                {{ $cat->name  }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Add Task Button -->
            <div class="form-group">
                <div class="col-sm-offset-5 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-plus"></i>Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection