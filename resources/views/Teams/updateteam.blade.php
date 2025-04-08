@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg rounded">
        <div class="card-body">
            <div class="card-title mb-4 text-dark p-2 text-center" style="background-color: #f8f9fa; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div style="display: flex; justify-content: center; align-items: center;">
                    <span style="font-weight: bold; color: #333;">
                        <h3>Create New Team</h3>
                        <p class="mb-1 text-danger"><strong>Organize and manage your team efficiently for better collaboration</strong></p>
                    </span>
                </div>
                <hr style="border-top: 2px solid #007bff; width: 50%; margin: 10px auto;">
            </div>
            
            <form id="create-team-form" action="{{ route('team.update', $team->id) }}" enctype="application/x-www-form-urlencoded" method="POST">
                @csrf
                @method('PUT')
                <!-- Team Name -->
                <div class="row mb-4">
                    <div class="col-12">
                        <label for="team-name" class="form-label fw-bold" style="color: #333;">Team Name</label>
                        <input type="text" class="form-control" id="team-name" name="team_name" required value="{{old('name',$team->name)}}">
                        @error('team_name')
                        <div class="text-danger fw-bold"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                </div>

                <!-- Team Description -->
                <div class="row mb-4">
                    <div class="col-12">
                        <label for="team-description" class="form-label fw-bold" style="color: #333;">Description</label>
                        <textarea class="form-control" id="team-description" name="description" rows="4" required >{{old('description',$team->description)}}</textarea>
                    </div>
                </div>

                <!-- Team Members -->
                <div class="row mb-4">
                    <div class="col-12">
                        <label for="team-members" class="form-label fw-bold" style="color: #333;">Add Members</label>
                        <select class="form-control" id="team-members" name="members[]" multiple required>
                        @php
                            $selectedMembers = json_decode($team->members, true) ?? [];
                        @endphp
                        
                        @foreach($users as $user)
                            <option value="{{ $user->id }}"
                                {{ in_array((int)$user->id, $selectedMembers) ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                        </select>
                    </div>
                </div>

                <!-- Team Lead -->
                <div class="row mb-4">
                    <div class="col-12">
                        <label for="team-lead" class="form-label fw-bold" style="color: #333;">Team Lead</label>
                        <select class="form-control" id="team_lead" name="team_lead" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}"{{ $team->lead == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn text-white fw-bold px-4 py-2" id="save-team-btn" style="font-weight: bold;background-color:#4dbfba;">Update Team</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
