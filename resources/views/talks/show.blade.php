@extends('layout')

@section('content')
    <div class="container body">
        <div class="row">
            <div class="col-md-8 col-md-push-2">
                <div class="pull-right page-meta-buttons">
                @if ($showingRevision)
                    <a href="/talks/{{ $talk->id }}" class="btn btn-default">Return to talk &nbsp;<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span></a><br>
                    <p style="text-align: right">REVISION:<br>
                    {{ $current->created_at }}</p>
                @else
                    <a href="/talks/{{ $talk->id }}?revision={{ $talk->current()->id }}" class="btn btn-default">Revisions &nbsp;<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></a><br>
                    <a href="/talks/{{ $talk->id }}/edit" class="btn btn-primary">Edit &nbsp;<span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a><br>
                    <a href="/talks/{{ $talk->id }}/delete" class="btn btn-danger">Delete &nbsp;<span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                @endif
                </div>

                @if ($current === null)
                    <p>No revisions yet. @todo Throw exception etc.</p>
                @else

                <h1 class="page-title">{{ $current->title }}</h1>

                <p style="font-style: italic;">
                    {{ $current->length }} minute {{ $current->level }} {{ $current->type }}
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-push-2">
                <h3>Description/Proposal</h3>
                {{ $current->getHtmledDescription() }}

                <h3>Organizer Notes</h3>
                {{ $current->getHtmledOrganizerNotes() }}

                @if ($current->slides)
                <h3>Slides</h3>
                <a href="{{ $current->slides }}">{{ $current->slides }}</a>
                @endif

                @if ($showingRevision)
                    <h3>Revisions</h3>
                    <ul>
                        @foreach ($talk->revisions as $revision)
                            <li {{ $revision->id == $current->id ? 'style="font-weight: bold;"' : '' }}>
                                <a href="/talks/{{ $talk->id }}?revision={{ $revision->id }}">{{ $revision->created_at }}</a> {{ $talk->current()->id == $revision->id ? '<i>(current)</i>' : '' }}
                            </li>
                        @endforeach
                    </ul>
                @endif
                @endif
            </div>
            <div class="col-md-4 col-md-push-2">
                <h3>Conferences</h3>
                @forelse ($talk->submissions as $submission)
                    BOOP
                @empty
                    None
                @endforelse
            </div>
        </div>
            </div>
        </div>
    </div>
@stop
