@extends('layouts.master')

@section('styles')
    <style>
        th, td {
            vertical-align: middle;
        }
    </style>
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger mt-5 mb-0">
            <ul class="m-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <table class="table table-bordered border-primary mt-5">
        <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Title</th>
            <th>Description</th>
            <th class="text-end">
                <button type="button" class="btn btn-primary"
                        data-bs-toggle="modal"
                        data-bs-get-method="post"
                        data-bs-form-action="{{route('post.store')}}"
                        data-bs-target="#postModal"
                        data-bs-header-text="Add new post"
                        data-bs-button-text="Save"
                >
                    Add Post
                </button>
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td class="text-center">{{ $loop->index + 1 }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->description }}</td>
                <td class="text-center">
                    <div class="btn btn-group">
                        <a href="{{route('post.show', $post->id)}}" class="btn btn-info">Show</a>
                        <div class="btn btn-warning"
                             data-bs-toggle="modal"
                             data-bs-target="#postModal"
                             data-bs-title="{{ $post->title }}"
                             data-bs-description="{{ $post->description }}"
                             data-bs-get-method="put"
                             data-bs-form-action="{{route('post.update', $post->id)}}"
                             data-bs-header-text="Update post #{{$post->id}}"
                             data-bs-button-text="Update"
                        >
                            Edit
                        </div>
                        <div class="btn btn-danger"
                             data-bs-toggle="modal"
                             data-bs-target="#postModal"
                             data-bs-get-method="delete"
                             data-bs-form-action="{{route('post.destroy', $post->id)}}"
                             data-bs-header-text="Deleting post #{{$post->id}}"
                             data-bs-button-text="Delete"
                        >
                            Delete
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('post.index')}}" id="postForm" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="postModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    @csrf
                    <input type="hidden" name="_method" id="set-method" value="">
                    <div class="modal-body" id="addUpdateModal">
                        <div class="form-group mb-3">
                            <label class="w-100" for="title">
                                Title<input class="form-control" type="text" name="title" id="title">
                            </label>
                        </div>
                        <div class="form-group mb-3">
                            <label class="w-100" for="description">
                                Description<textarea class="form-control" name="description"
                                                     id="description"></textarea>
                            </label>
                        </div>
                    </div>
                    <div class="modal-body" style="display: none" id="deleteModal">
                        Are you sure?
                    </div>
                    <div class="modal-footer" id="addUpdateModalButtons">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    <div class="modal-footer" style="display: none" id="deleteModalButtons">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let exampleModal = document.getElementById('postModal')
        exampleModal.addEventListener('show.bs.modal', (event) => {
            // Button that triggered the modal
            let button = event.relatedTarget
            // Extract info from data-bs-* attributes
            //let buttonText  = button.getAttribute('data-bs-button-text')
            let getMethod   = button.getAttribute('data-bs-get-method')
            let headerText  = button.getAttribute('data-bs-header-text')
            let formAction  = button.getAttribute('data-bs-form-action')
            let title       = button.getAttribute('data-bs-title')
            let description = button.getAttribute('data-bs-description')
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            let setMethod            = exampleModal.querySelector('#set-method')
            let formSelector         = exampleModal.querySelector('#postForm')
            let modalTitle           = exampleModal.querySelector('.modal-title')
            let modalBodyTitle       = exampleModal.querySelector('.modal-body [for="title"] input')
            let modalBodyDescription = exampleModal.querySelector('.modal-body [for="description"] textarea')

            if (getMethod === 'delete') {
                document.querySelector('#deleteModal').style.display           = ''
                document.querySelector('#deleteModalButtons').style.display    = ''
                document.querySelector('#addUpdateModal').style.display        = 'none'
                document.querySelector('#addUpdateModalButtons').style.display = 'none'
            } else {
                document.querySelector('#deleteModal').style.display           = 'none'
                document.querySelector('#deleteModalButtons').style.display    = 'none'
                document.querySelector('#addUpdateModal').style.display        = ''
                document.querySelector('#addUpdateModalButtons').style.display = ''
            }

            formSelector.setAttribute('action', formAction)

            modalTitle.textContent     = headerText
            setMethod.value            = getMethod
            modalBodyTitle.value       = title
            modalBodyDescription.value = description
        })
    </script>
@endsection


