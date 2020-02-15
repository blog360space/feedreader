@extends('layout.master')

@section('content')
    <div class="col-12">
        <h1 class="clearfix">Create Feed</h1>

        <!-- Display Validation Errors -->
        @include('layout.errors')

        <!-- New Task Form -->
        <form action="{{ url('/feed/store') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="feed-title" class="col-sm-3 control-label">Title</label>
                <div class="col-sm-12">
                    <input type="text" name="title" id="feed-title" class="form-control"
                           value="{{old('title')}}">
                </div>
            </div>

            <div class="form-group clearfix">
                <label for="feed-description" class="col-sm-3 control-label">Description</label>
                <div class="col-sm-12">
                            <textarea name="description" id="feed-description"
                                      rows="10"
                                      class="form-control">{{old('description')}}</textarea>
                </div>
            </div>
            <div class="form-group clearfix">
                <label for="feed-category_id" class="col-sm-3 control-label">Category</label>
                <div class="col-sm-12">
                    <select name="category_id"">
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}"
                                    @if(old('category_id') == $cat->id) selected="selected" @endif>
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
                        <i class="fa fa-btn fa-plus"></i>Add</button>
                </div>
            </div>
        </form>
    </div>
@endsection