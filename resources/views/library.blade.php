<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Booking') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <b>Filter by: </b><select name="category" id="category">
                        <option value="">Category</option>
                        @if (count($categories) > 0)
                            @foreach ( $categories as $category)
                            <option value={{$category->id}}>{{$category->name}}</option>
                            @endforeach
                        @endif
                    </select>

                    @if (session('status'))
                        <div class="alert alert-success w-50 p-3" role="alert">
                            {{session('status')}}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="books" class="table table-sm  table-bordered table-hover table-striped mt-4">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">N. Pag</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="books_tbody">
                                @foreach ($books as $book)
                                <tr>
                                    <td>{{$book->title}}</td>
                                    <td>{{$book->author}}</td>
                                    <td>{{$book->pag}}</td>
                                    <td>
                                        <button type='button' class='btn btn-warning btn-sm text-right' onclick='reserve({{$book->id}})'>Reserve</button>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>

                        <!-- Modal Reservar -->
                        <div class="modal fade" id="reserveModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            <div class="modal-body">
                                <h3><b>Book Title: </b><label for="title" id="title"></label></h3>
                                <h3><b>Author: </b><label for="author" id="author"></label></h3>
                                <hr><br>

                                <div class="card mb-3 user" style="max-width: 540px;">
                                <div class="row g-0">
                                    <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>Description</b></h5>
                                        <p class="card-text" id="description"></p>
                                        <p class="card-text"><small class="text-muted" id="page"></small></p>
                                    </div>
                                    </div>
                                    <div class="col-md-4">
                                    <img src="" id="imgBook" class="img-fluid rounded-start" alt="...">
                                    </div>
                                </div>
                                </div>

                            </div>
                            <form action="{{ route('homes.store') }}" method="POST">
                                @csrf
                                <div  id="reserve" class="modal-footer">
                                <input type="hidden" name="id" id="id">
                                Days: <input class="day" type="number" min="1" max="30" value="1" name="days">
                                <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary reserve">Reserve</button>
                                </div>
                            </form>
                            </div>
                        </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
