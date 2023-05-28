@extends('admin.layout.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-ad-12">
                <h3 class="text-dark">Edit unit</h3>
                <br>
                <div class="card bg-light">
                    <div class="card-body">
                        <form method="post" action="/admin/unit/update/ {{ $unit->id }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ old('title', $unit->title) }}" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="" class="form-label">Description</label>
                                <input type="text" class="form-control" id="description"
                                    name="description"value="{{ old('description', $unit->description) }}" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="" class="form-label">Price</label>
                                <input type="number" class="form-control" id="price"
                                    name="price"value="{{ old('price', $unit->price) }}" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="" class="form-label">Status</label>
                                <select class="form-select" name="status_id[]" multiple>
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->id }}">{{ $status->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <div class="col">
                                @if ($unit->image)
                                    <img src="{{ asset('storage/' . $unit->image) }}" alt="{{ $unit->image }}"
                                        width="100">
                                @endif
                                <div class="form-group">
                                    <label for="" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                            </div>
                            <br>
                            {{-- <div class="col">
                                @if ($unit->image_2)
                                    <img src="{{ asset('storage/' . $unit->image_2) }}" alt="{{ $unit->image_2 }}"
                                        width="100">
                                @endif
                                <div class="form-group">
                                    <label for="" class="form-label">Image 2</label>
                                    <input type="file" class="form-control" id="image_2" name="image_2"
                                        value="{{ old('image_2', $unit->image_2) }}">
                                </div>
                            </div>
                            <br>
                            <div class="col">
                                @if ($unit->image_3)
                                    <img src="{{ asset('storage/' . $unit->image_3) }}" alt="{{ $unit->image_3 }}"
                                        width="100">
                                @endif
                                <div class="form-group">
                                    <label for="" class="form-label">Image 3</label>
                                    <input type="file" class="form-control" id="image_3" name="image_3">
                                </div>
                            </div>
                            <br>
                            <div class="col">
                                @if ($unit->image_4)
                                    <img src="{{ asset('storage/' . $unit->image_4) }}" alt="{{ $unit->image_4 }}"
                                        width="100">
                                @endif
                                <div class="form-group">
                                    <label for="" class="form-label">Image 4</label>
                                    <input type="file" class="form-control" id="image_4" name="image_4">
                                </div>
                            </div>
                            <br>
                            <div class="col">
                                @if ($unit->image_plan)
                                    <img src="{{ asset('storage/' . $unit->image_plan) }}" alt="{{ $unit->image_plan }}"
                                        width="100">
                                @endif
                                <div class="form-group">
                                    <label for="" class="form-label">Image plan</label>
                                    <input type="file" class="form-control" id="image_plan" name="image_plan">
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="" class="form-label">Bloc</label>
                                <input type="text" class="form-control" id="bloc"
                                    name="bloc"value="{{ old('bloc', $unit->bloc) }}" required>
                            </div>
                            <br>
                            <div class="col">
                                @if ($unit->certificate)
                                    <img src="{{ asset('storage/' . $unit->certificate) }}"
                                        alt="{{ $unit->certificate }}" width="100">
                                @endif
                                <div class="form-group">
                                    <label for="" class="form-label">Certificate</label>
                                    <input type="file" class="form-control" id="certificate" name="certificate">
                                </div>
                            </div>
                            <br> --}}
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label for="" class="form-label">bedroom</label>
                                    <input class="form-control" id="bedroom" name="bedroom" value="{{ $unit->specifications->bedroom }}" >
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="" class="form-label">bathroom</label>
                                    <input class="form-control" id="bathroom" name="bathroom" value="{{ $unit->specifications->bathroom }}" >
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="" class="form-label">surface area</label>
                                    <input class="form-control" id="surface_area" name="surface_area" value="{{ $unit->specifications->surface_area }}" >
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="" class="form-label">building area</label>
                                    <input class="form-control" id="building_area" name="building_area" value="{{ $unit->specifications->building_area }}" >
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="" class="form-label">floor</label>
                                    <input class="form-control" id="floor" name="floor" value="{{ $unit->specifications->floor }}" >
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="" class="form-label">Property</label>
                                <select class="form-control" id="property_id" name="property_id">
                                    @foreach ($property as $property)
                                        @if (old('property_id', $unit->property_id == $property->id))
                                            <option name="property_id" value="{{ $property->id }}" selected>
                                                {{ $property->property }}
                                            </option>
                                        @endif
                                        <option name="property_id" value="{{ $property->id }}">{{ $property->property }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <div class="float-end">
                                <a type="button" class="btn btn-warning"
                                    href="/admin/unit/show/{{ $unit->id }}">Back</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
